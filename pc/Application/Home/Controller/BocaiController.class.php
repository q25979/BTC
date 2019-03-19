<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 作者：671
 * 时间：2018年9月29日10:23:37
 * 描述：博彩功能
 */
class BocaiController extends VerifyController 
{
	// 博彩首页
	public function index()
	{
		$this->display();
	}

	// 博彩手机端
	public function m()
	{
		$this->display();
	}

	// 初始化
	public function initial()
	{
		$this->ajaxReturn([
			'extract_balance' => M('UserAccount')
				->getFieldByUserId($this->user_id, 'extract_balance'),
			'timestamp' => time()
		]);
	}

	// 獲取餘額
	public function getbalance()
	{
		$result = M('UserAccount')
			->getFieldByUserId($this->user_id, 'extract_balance');
		$this->ajaxReturn($result);
	}

	// 获取服务器时间戳
	public function timestamp()
    {
        $this->ajaxReturn(time());
    }

	// 买
	public function deal()
	{
		$type = I('get.type');
		$title = $type == 1 ? "買漲" : "買跌";

		$this->assign(['title' => $title]);
		$this->display();
	}

	// 获取历史交易记录
	public function historylog()
	{
		$get = I('get.');
		$date = date('Y-m-d');

		// 今天
		if ($get['day'] == 0) {
			$map['create_time'] = array(
				array('EGT', strtotime($date)+30),
				array('LT', strtotime($date.' 23:59:59')+31)
			);
		} elseif ($get['day'] == 1) {
			$map['create_time'] = array(
				array('EGT', strtotime($date)-86400+30),
				array('LT', strtotime($date)+30)
			);
		} elseif ($get['day'] == 2) {
			$map['create_time'] = array(
				array('EGT', strtotime($date)-86400*2+30),
				array('LT', strtotime($date)-86400+30)
			);
		}

		$list = M('WOpenlog')
			->where($map)
			->page($get['page'], $get['limit'])
			->order('create_time desc')
			->select();

		// 转换可视数据
		foreach ($list as $k => $v) {
			if ($v['last_direction'] == 0) $list[$k]['last_direction_name'] = '漲';
			if ($v['last_direction'] == 1) $list[$k]['last_direction_name'] = '跌';
			if ($v['last_direction'] == -1) $list[$k]['last_direction_name'] = '未開盤';

			$list[$k]['create_time'] = date('Y/m/d H:i:s', $v['create_time']);
		}

		$this->ajaxReturn([
			'code' => 0,
			'msg'  => '',
			'count' => M('WOpenlog')->where($map)->count(),
			'data' => $list
		]);
	}

	// 确认下单
	public function okorder()
	{
		if ($this->closeverify() == '1')
			$this->ajaxReturn(['code' => -1, 'msg' => '休市中，不能購買']);
		$result = ['code' => -1, 'msg' => '購買失敗'];
		$post = I('post.');
		$account = M('UserAccount');
		// 判斷金額是否正確
		if ($post['money'] < 1 || is_nan($post['money']) || empty($post['money'])) 
			$this->ajaxReturn($result);

		// 时间
		$time = time();
		$m = 5-((int)date('i', $time)%5)-1; 
		if ($m == 0)
			$this->ajaxReturn(['code' => 1, 'msg' => '最後一分鐘禁止購買']);

		// 扣除餘額
		$balance = $account->getFieldByUserId($this->user_id, 'extract_balance');
		$lastbalance = $balance - $post['money'];	// 最终剩余余额
		if ($lastbalance < 0)
			$this->ajaxReturn(['code' => -1, 'msg' => '您的餘額不足']);
		$account->startTrans();
		$accountinfo = $account->where(['user_id' => $this->user_id])
			->save(['extract_balance' => $lastbalance]);
		if ($accountinfo == 0) $this->ajaxReturn($result);

		// 生成订单号
		$letter = ['X', 'K', 'V', 'B', 'N', 'M', 'Z', 'D', 'O'];
		$stime  = $time;
		$order  = $letter[rand(0,count($letter)-1)].$time;
		$post['uid'] = $this->user_id;
		$post['create_time'] = $post['buy_time'] = $stime;
		$post['order_id'] = $order;

		$h = (int)date('H', $time); $mm = (int)date('i', $time); $s = (int)date('s', $time);
		$post['buy_number'] = (int)(($h*60+$mm)/5+1);	// 购买期数
		$info = M('WMinlog')->add($post);
		if ($info == 0) {
			$account->rollback();
			$this->ajaxReturn($result);
		}
		$account->commit();
		M('WMinlog')->commit();
		$this->ajaxReturn(['code' => 0, 'msg' => '下單成功']);
	}

	// 获取记录
	public function getrecord()
	{
		$WOpenlog = M('WOpenlog');
		$get = I('get.');
		$list = $WOpenlog
			->page($get['page'], $get['limit'])
			->order('create_time desc')
			->select();

		// 转换可视数据
		foreach ($list as $k => $v) {
			if ($v['last_direction'] == 0) $list[$k]['last_direction_name'] = '漲';
			if ($v['last_direction'] == 1) $list[$k]['last_direction_name'] = '跌';
			if ($v['last_direction'] == -1) $list[$k]['last_direction_name'] = '未開盤';

			$list[$k]['create_time'] = date('Y/m/d H:i:s', $v['create_time']);
		}
		$this->ajaxReturn([
			'code' => 0,
			'msg'  => '',
			'count' => $WOpenlog->count(),
			'data' => $list
		]);
	}

	// 获取交易记录
	public function getdeallog()
	{
		$map['uid'] = $this->user_id;
		$list = M('WMinlog')
			->where($map)
			->page(1, 3)
			->field('buy_number,money,last_money')
			->order('buy_time desc')
			->select();
		foreach ($list as $k => $v) {
			if ($v['last_money']==0) $list[$k]['last_money']='未中獎';
			if ($v['last_money']<0) $list[$k]['last_money']='等待開獎';
		}
		$this->ajaxReturn([
			'code' => 0,
			'msg'  => '',
			'data' => $list,
			'count' => 3
		]);
	}

	// 获取成交价和执行价
	public function getprice()
	{
		//$data['execute_price'] = session('price.execute');
		//$data['last_price'] = session('price.last');
		$this->ajaxReturn($data);
	}

	// 休市验证0-开盘 1-休市
	private function closeverify()
	{
		$set = M('WSet')->getFieldById(1, 'set');
		return $set;
	}

	// 获取记录
	public function getlog()
	{
		if (IS_AJAX) {
			$get = I('get.');
			$map['uid'] = $this->user_id;
			$list = M('WMinlog')
				->page($get['page'], $get['limit'])
				->order('buy_time desc')
				->where($map)
				->select();

			// 转换可视数据
			foreach ($list as $k => $v) {
				if ($v['buy_direction'] == 0) $list[$k]['buy_direction_name'] = '漲';
				if ($v['buy_direction'] == 1) $list[$k]['buy_direction_name'] = '跌';
				if ($v['last_direction'] == 0) $list[$k]['last_direction_name'] = '漲';
				if ($v['last_direction'] == 1) $list[$k]['last_direction_name'] = '跌';
				if ($v['last_direction'] == -1) $list[$k]['last_direction_name'] = '等待開獎';
				$list[$k]['buy_time'] = date('Y/m/d H:i', $v['buy_time']);
				$hour  = (int)(((int)$v['buy_number']*5)/60);
				$minue = (int)(((int)$v['buy_number']*5)%60);
				$hour  = $hour < 10 ? '0'.$hour : $hour;
				$minue = $minue < 10 ? '0'.$minue : $minue;
				$list[$k]['last_time'] = date('Y/m/d', $v['buy_time']).' '.$hour.':'.$minue;
				if ($v['last_money'] < 0) $list[$k]['last_money'] = '等待開獎';
				if ($v['last_money'] == 0) $list[$k]['last_money'] = '未中獎';
			}
			$this->ajaxReturn([
				'code' => 0,
				'msg'  => '',
				'data' => $list,
				'count' => M('WMinlog')->where($map)->count()
			]);
		}
		$this->display();
	}
}