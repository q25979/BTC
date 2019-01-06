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
    		'state'	=> M('WCloseset')->getFieldById('1', 'set')
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
    	$wcloseset = M('WCloseset');
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
        $result['count'] = M('WCloseset')->where($map)->count();

        $this->ajaxReturn($result);
    }
}
