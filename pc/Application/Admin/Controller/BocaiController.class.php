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

    // 手动开奖
    public function manualLottery()
    {
        $result = [ 'code' => -1, 'msg' => '开奖失败' ];
        $wminlog = M('WMinlog');
        $wopenlog = M('WOpenlog');

        $post = I('post.');
        $info = $wminlog->getByOrderId($post['order_id']);
        if ((int)$info['last_direction'] != -1) {
            $result['msg'] = '该订单已经开过奖，不需要复充提交';
            $this->ajaxReturn($result);
        }

        // 获取开奖数据
        $logmap['number'] = $info['buy_number'];
        $date = date("Y-m-d", $info['buy_time']);
        $starttime = strtotime($date)+30;
        $endtime = strtotime($date)+24*60*60+30;
        $logmap['create_time'] = array(
            array('EGT', $starttime),
            array('ELT', $endtime)
        );
        $openlog = $wopenlog->where($logmap)->find();
        if (empty($openlog)) {
            $result['msg'] = '该期尚未开将，不能操作';
            $this->ajaxReturn($result);
        }

        // $info['buy_dirction']  $openlog['last_dirction']
        // 需要更新的数据
        $update = [
            'last_direction' => $openlog['last_direction'],
            'last_money' => 0,
            'execute_price' => $openlog['execute_price'],
            'last_price' => $openlog['last_price']
        ];
        if ((int)$info['buy_direction'] == (int)$openlog['last_direction']) {
            // 购买对了
            // 获取赔率
            $odds = M('WSet')->getFieldById('1', 'odds_set');
            $update['last_money'] = (float)$odds * (float)$info['money'];

            // 给用户加钱
            $UMap['user_id'] = $info['uid'];
            M('UserAccount')->where($UMap)
                ->setInc('extract_balance', (float)$update['last_money']);
        }
        $wminmap['order_id'] = $post['order_id'];
        $saveinfo = $wminlog->where($wminmap)->save($update);

        if ($saveinfo > 0) {
            $result['code'] = 0;
            $result['msg']  = '开奖成功';
            $this->ajaxReturn($result);
        }
        else {
            $result['msg'] = '更新失败';
            $this->ajaxReturn($result);
        }
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
                ->order('create_time desc')
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
            ->order('create_time desc')
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

    // 全部手动开奖
    public function manualLotteryAll()
    {
        $post = I('post.');
        $WOpenlog = M('WOpenlog');

        // 判断不能开超过当前时间
        if ($post['create_time'] > time()) {
            $this->ajaxReturn([
                'code' => -1,
                'msg'  => '不能开比当前时间高的'
            ]);
        }

        if ((float)$post['execute_price'] > (float)$post['last_price'])
            $post['last_direction'] = 1;
        else
            $post['last_direction'] = 0;

        // 判断该期数是否已经存在
        $date = date("Y-m-d", $post['create_time']);
        $starttime = strtotime($date)+1;
        $endtime = strtotime($date)+24*60*60+1;
        $map['number'] = $post['number'];
        $map['create_time'] = array(
            array('EGT', $starttime),
            array('ELT', $endtime)
        );
        $count = $WOpenlog->where($map)->count();
        if ($count > 0) {
            $this->ajaxReturn([
                'code' => -1,
                'msg'  => '该期已经开过奖，如个人未开奖请直接点击个人'
            ]);
        }

        // 添加记录
        if ($WOpenlog->add($post) <= 0) {
            $this->ajaxReturn([
                'code' => -1,
                'msg'  => '手动开奖失败'
            ]);
        }

        // 查询购买本期的人
        $buymap['number'] = $post['number'];
        $buymap['buy_time'] = array(
            array('EGT', $starttime),
            array('ELT', $endtime)
        );
        $buylist = M('WMinlog')->where($buymap)->select();
        foreach ($buylist as $k => $v) {
            // 状态更改
            $wmindata['last_direction'] = $post['last_direction'];
            $wmindata['last_money'] = 0;
            $wmindata['execute_price'] = $post['execute_price'];
            $wmindata['last_price'] = $post['last_price'];

            if ((int)$post['last_direction'] == (int)$v['buy_direction']) {
                // 获取倍率
                $odds = M('WSet')->getFieldById('1', 'odds_set');
                $wmindata['last_money'] = $v['money'] * $odds;

                // 给用户余额价钱
                $usermap['user_id'] = $v['uid'];
                M('UserAccount')->where($usermap)
                    ->setInc('extract_balance', (float)$wmindata['last_money']);
            }
            $wminmap['order_id'] = $v['order_id'];
            M('WMinlog')->where($wminmap)->save($wmindata);
        }

        $this->ajaxReturn([
            'code' => 0,
            'msg' => '开奖成功,请手动开刷新'
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
