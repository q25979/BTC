<?php
namespace Admin\Controller;

/**
 * 作者：671
 * 时间：2018年10月23日
 * 功能：博彩管理
 */
class BocaiController extends VerifyController {
    // 开盘设置
    public function set()
    { 
    	$wopenset = M('WOpenset');
    	if (IS_AJAX) {
	    	$get = I('get.');
	    	$list = $wopenset->page($get['page'], $get['limit'])->select();	// 获取数据
	    	
	    	foreach ($list as $key => $value) {
	    		// 1-00:00
	    		$temp = ($value['number']-1)*5+5;
	    		$hour = $temp/60;	// 取整就是小时
	    		$temp = $temp%60;
	    		$minue = $temp < 10 ? '0'.$temp : $temp;
	    		$hour = $hour < 10 ? '0'.(int)$hour : (int)$hour;
	    		$list[$key]['time'] = $hour.':'.$minue;
                if ($list[$key]['time'] == '24:00') $list[$key]['time'] = '00:00';
	    	}

			$this->ajaxReturn([
				'code' => 0,
				'msg' => '',
				'count' => $wopenset->count(),
				'data' => $list
			]);
    	}

    	$this->display();
    }

    // 开盘设置-赔率设置
    public function odds()
    {
        $wset = M('WSet');
        if (IS_POST) {
            $post = I('post.');
            $info = $wset->where('id=1')->save($post);
            if ($info > 0) {
                $this->ajaxReturn([
                    'code' => 0,
                    'msg'  => '更新成功'
                ]);
            }

            $this->ajaxReturn([
                'code' => -1,
                'msg'  => '更新失败'
            ]);
        }

        $get = $wset->where('id=1')->field('odds_set')->find();
        $this->ajaxReturn($get);
    }

    // 盘市还原
    public function restore()
    {
    	$wopenset = M('WOpenset');
    	// 说明有数据,先清空
    	if ($wopenset->count() > 0) $wopenset->where('1')->delete();
    	$data = [];
    	for ($i=0; $i<288; $i++) {
    		$data[] = array('number' => $i+1);
    	}
    	$info = $wopenset->addAll($data);
    	$this->ajaxReturn($info);
    }

    // 统计设置的开盘数据
    public function init()
    {
    	$rise = M('WOpenset')->where(['set' => 0])->count();
    	$this->ajaxReturn([
    		'rise'	=> $rise,
    		'fall'	=> 288-$rise,
    		'state'	=> M('WSet')->getFieldById('1', 'set')
    	]);
    }

    // 盘市控制
    public function control()
    {
    	$wopenset = M('WOpenset');
    	$post = I('post.');
    	$info = $wopenset->where(['number' => $post['number']])->save($post);
    	$info > 0
    		? $this->ajaxReturn(['code' => 0, 'msg' => '切换成功'])
    		: $this->ajaxReturn(['code' => -1, 'msg' => '切换失败']);
    }

    // 设置开/关
    public function closeset()
    {
    	$wcloseset = M('WSet');
    	$post = I('post.');
    	$info = $wcloseset->where(['id' => 1])->save($post);
    	$info > 0
    		? $this->ajaxReturn(['code' => 0, 'msg' => '切换成功'])
    		: $this->ajaxReturn(['code' => -1, 'msg' => '切换失败']);
    }

    // 信息统计
    public function msgtotal()
    {
        $this->display();
    }

    // 交易数据
    public function sealdata()
    {
        $result = [];
        $map['number'] = (int)(((int)date('H')*60+(int)date('i'))/5)+1; // 设置要开的期数
        $map['create_time'] = array('lt', date('Y-m-d'));
        $result['number'] = $map['number'];
        $result['count'] = M('WSet')->where($map)->count();

        $this->ajaxReturn($result);
    }

    // 下注记录
    public function betslog()
    {
        // 获取初始化数据
        $useraccount = M('UserAccount');
        $wminlog = M('WMinlog');

        if (IS_AJAX) {
            $get = I('get.');
            $list = $wminlog
                ->page($get['page'], $page['limit'])
                ->join('btc_user ON btc_w_minlog.uid = btc_user.user_id')
                ->field('btc_user.user_name, btc_w_minlog.*')
                ->select();

            $this->ajaxReturn([
                'code' => 0,
                'msg'  => '',
                'count' => $wminlog->count(),
                'data'  => $this->betslogstatus($list)
            ]);
        }
            
        $data['balance'] = $useraccount->sum('extract_balance');
        $data['bets'] = count($wminlog->distinct(true)->field('uid')->select());
        // 利润
        $data['profit'] = $wminlog->sum('money') - $wminlog->where('last_money>=0')->sum('last_money');
        
        $this->assign('data', $data);
        $this->display();
    }

    // 下注记录搜索
    public function betslogsearch()
    {
        $get = I('get.');
        $wminlog = M('WMinlog');

        // 按名字搜索
        if ($get['type'] == 0) {
            $map['btc_user.user_name'] = array('LIKE', '%'.$get['user_name'].'%');

        } elseif ($get['type'] == 1) {
            // 按开奖状态搜索
            if ($get['last_direction'] == 1) {
                // 开奖
                $map['last_money'] = array('EGT', 0);
            } elseif ($get['last_direction'] == 2) {
                // 已中奖
                $map['last_money'] = array('GT', 0);
            } elseif ($get['last_direction'] == 3) {
                // 未中奖
                $map['last_money'] = array('EQ', 0);
            } elseif ($get['last_direction'] == -1) {
                // 未开奖
                $map['last_money'] = array('LT', 0);
            } else {
                $map = "";
            }
        }

        $list = $wminlog
            ->where($map)
            ->page($get['page'], $get['limit'])
            ->join('btc_user ON btc_w_minlog.uid = btc_user.user_id')
            ->field('btc_user.user_name, btc_w_minlog.*')
            ->select();

        $this->ajaxReturn([
            'code' => 0,
            'msg'  => '',
            'count' => $wminlog->where($map)->join('btc_user ON btc_w_minlog.uid = btc_user.user_id')->count(),
            'data'  => $this->betslogstatus($list)
        ]);
    }

    // 下注记录状态更改
    private function betslogstatus($data)
    {
        foreach ($data as $k => $v) {
            // 设置时间
            $data[$k]['buy_time'] = date('Y-m-d H:i:s', $v['buy_time']);
            $hour  = (int)(((int)$v['buy_number']*5)/60);
            $minue = (int)(((int)$v['buy_number']*5)%60);
            $hour  = $hour < 10 ? '0'.$hour : $hour;
            $minue = $minue < 10 ? '0'.$minue : $minue;
            $data[$k]['last_time'] = date('Y-m-d', $v['buy_time']).' '.$hour.':'.$minue;

            // 设置涨跌
            if ($v['buy_direction'] == 0) $data[$k]['buy_direction_name'] = '涨';
            if ($v['buy_direction'] == 1) $data[$k]['buy_direction_name'] = '跌';
            if ($v['last_direction'] == 0) $data[$k]['last_direction_name'] = '涨';
            if ($v['last_direction'] == 1) $data[$k]['last_direction_name'] = '跌';
            if ($v['last_direction'] == -1) $data[$k]['last_direction_name'] = '未开盘';

            // 中奖金额
            if ($v['last_money'] < 0) $data[$k]['last_money'] = "未开盘";
            if ($v['last_money'] == 0) $data[$k]['last_money'] = "未中奖";
        }

        return $data;
    }
}
