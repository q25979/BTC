<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 作者：671
 * 时间：2018年4月16日16:51:07
 * 功能：公告
 */
class WithdrawalDetailController extends VerifyController {
    public function index() {
        $this->display();
    }

    /**
     * 提现明细
     * method: post 
     * url: /Home/WithdrawalDetail/lookUpOrder
     * page 第几页
     */
    public function lookUpOrder() {
        $info = I('post.');

        $upOrder = M('Up_order');
        $map['user_id'] = $this->user_id; 
        $map['is_deleted'] = IS_NOT_DELETED; 
        $data = $upOrder
            ->where($map)
            ->field('up_order_id,up_price,status,create_time')
            ->order('create_time desc')
            ->page($info['page'],LIMIT)
            ->select();
        $res = $this->updateTime($data);
        $result = \StatusCode::code(0);
        $result['count'] = $upOrder
            ->where($map)
            ->count();
        $result['data'] = $res;
        $this->ajaxReturn($result);            
    }

    public function updateTime($data) {
        foreach ($data as $k => $v) {
            $data[$k]['create_time'] = date('Y-m-d H:m:s',$v['create_time']);
        }
        return $data;
    }
}
