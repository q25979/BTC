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

	// 獲取餘額
	public function getbalance()
	{
		$result = M('UserAccount')->getFieldByUserId($this->user_id, 'extract_balance');
		$this->ajaxReturn($result);
	}

	// 买
	public function deal()
	{
		$type = I('get.type');
		$title = $type == 1 ? "買漲" : "買跌";

		$this->assign([
			'title'	=> $title
		]);
		$this->display();
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
		if ($post['time'] == 0)
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
		$stime  = time();
		$order  = $letter[rand(0,count($letter)-1)].time();
		$post['uid'] = $this->user_id;
		$post['create_time'] = $post['buy_time'] = $stime;
		$post['order_id'] = $order;
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
		$limit = I('get.limit');

		// 获取两天前时间戳
		$list = $WOpenlog
			->page('1,'.$limit)
			->order('create_time desc')
			->select();

		// 转换可视数据
		foreach ($list as $k => $v) {
			if ($v['last_direction'] == 0) $list[$k]['last_direction_name'] = '漲';
			if ($v['last_direction'] == 1) $list[$k]['last_direction_name'] = '跌';
			if ($v['last_direction'] == -1) $list[$k]['last_direction_name'] = '未開盤';

			$list[$k]['create_time'] = date('Y/m/d H:i:s');
		}
		$this->ajaxReturn([
			'code' => 0,
			'msg'  => '',
			'count' => $WOpenlog->page('1,'.$limit)->count(),
			'data' => $list
		]);
	}

	// 开盘
	public function open()
	{
		$WMinlog  = M('WMinlog');
		$WOpenset = M('WOpenset');
		$UserAccount = M('UserAccount');

		// 获取未开盘期数
		if ((int)date('i')[1] < 5) {
			$time = strtotime(date('Y-m-d H').':'.(string)((int)date('i')-(int)date('i')[1]));
		} else {
			$time = strtotime(date('Y-m-d H').':'.(string)((int)date('i')-((int)date('i')[1])+5));
		}
		$map['last_direction'] = -1;
		$map['buy_time'] = array('lt', $time);
		$noopenli = $WMinlog
			->where($map)
			->field('id,buy_number')
			->group('buy_number')
			->select();
		foreach ($noopenli as $k => $v) {
			$set = $WOpenset->getFieldByNumber($v['buy_number'], 'set');
			$numbermap['buy_number'] = $v['buy_number'];	// 期数条件
			$save['last_direction']  = $set;	// 需要更改状态的数据
			if ($set == 0) {
				// 涨，获取最高购买价格
				$max = $WMinlog->where($numbermap)->max('buy_price');
				$save['last_price'] = $max+(rand(1,1000)/10000);
			} 
			if ($set == 1) {
				// 跌，获取最低购买价格
				$min = $WMinlog->where($numbermap)->min('buy_price');
				$save['last_price'] = $min-(rand(1,1000)/10000);
			}
			$save['number'] = $v['buy_number'];

			// 更改数据状态
			$WMinlog->where($numbermap)->save($save);
			// 查询本期买对方向的人
			$buymap['buy_direction'] = $set;
			$buymap['buy_number'] = $v['buy_number'];
			$lastlist = $WMinlog->where($buymap)->field('id,uid,money')->select();
			foreach ($lastlist as $key => $value) {
				// 给本期买对的人账户加钱
				$account = $UserAccount
					->where(['user_id' => $value['uid']])
					->setInc('extract_balance', $value['money']*2);
			}
		}
		$this->ajaxReturn(['code' => 0, 'msg' => '操作完成', 'timestamp' => time()]);
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
		// 只获取最近3天数据
		$time = time()-(3*24*60*60);
		$map['create_time'] = array('gt', $time);
		$map['uid'] = $this->user_id;
		$list = M('WMinlog')->where($map)->select();

		// 转换可视数据
		foreach ($list as $k => $v) {
			if ($v['buy_direction'] == 0) $list[$k]['buy_direction_name'] = '漲';
			if ($v['buy_direction'] == 1) $list[$k]['buy_direction_name'] = '跌';
			if ($v['last_direction'] == 0) $list[$k]['last_direction_name'] = '漲';
			if ($v['last_direction'] == 1) $list[$k]['last_direction_name'] = '跌';
			if ($v['last_direction'] == -1) $list[$k]['last_direction_name'] = '未開盤';
			$list[$k]['buy_time'] = date('Y/m/d H:i', $v['buy_time']);
			$hour  = (int)(((int)$v['buy_number']*5)/60);
			$minue = (int)(((int)$v['buy_number']*5)%60);
			$hour  = $hour < 10 ? '0'.$hour : $hour;
			$minue = $minue < 10 ? '0'.$minue : $minue;
			$list[$k]['last_time'] = date('Y/m/d', $v['buy_time']).' '.$hour.':'.$minue;
		}
		$this->assign('list', $list);
		$this->display();
	}
}