<?php
namespace Admin\Controller;

// +---------------------------------------------------
// | 作者：庄
// +---------------------------------------------------
// | 时间：2018年4月20日
// +---------------------------------------------------
// | 功能：修改密码与退出
// +---------------------------------------------------

class IndexController extends VerifyController {
    public function index() {
        $this->display();
    }

    // 退出/切换
    public function logout() {
        session(null);

        $result = \StatusCode::code(0);
        $result['msg'] = "注销成功";
        $this->ajaxReturn($result);
    }

    // 系统密码修改
    public function changepass(){

        $getData = I('post.');

        $update = M('Admin');

        $map['pass_word'] = $getData['pass_word'];   // 验证密码是否正确
        $map['admin_id']  = $this->adminId;

        // 验证密码是否正确
        $accCount = $update->where($map)->count();
        
        if ($accCount == 0) {
            // 表示密码错误
            $result = \StatusCode::code(1004);
            $result['msg'] = "原密码错误";
            $this->ajaxReturn($result);
        }

        $Data['pass_word'] = $getData['newpass'];
        $info = $update->where($map)->save($Data);

        if($info == 0){
            $result = \StatusCode::code(1004);
            $result['msg'] = '修改失败';
            $this->ajaxReturn($result);
        }

        $result = \StatusCode::code(0);
        $result['msg'] = '修改成功';
        $this->ajaxReturn($result);
    }
    
    // 提示信息
    public function informationHint(){

        $order = M('OrderInfo');
        $send = M('Send');

        $mapO['status'] = ORDER_STATUS_SUBMIT;   //订单状态
        $mapO['is_deleted'] = IS_NOT_DELETED;

        $mapS['status'] = SEND_STATUS_SUBMIT;    //发送状态
        $mapS['is_deleted'] = IS_NOT_DELETED;

        $orderCount = $order->where($mapO)->count();
        $sendCount = $send->where($mapS)->count();
        
        $result = \StatusCode::code(0);
        $result['countOrder'] = $orderCount;
        $result['countSend'] = $sendCount;
        $this->ajaxReturn($result);

    }

    /**
     * 初始化数据
     *
     * method: get
     * url: /Admin/Index/init
     */
    public function init() {
        $UpOrder = M('UpOrder');

        $map['is_deleted'] = IS_NOT_DELETED;
        $map['status'] = WITHDRAW_STATUS_ING;
        $count = $UpOrder->where($map)->count();

        $result = \StatusCode::code(0);
        $result['count'] = $count;
        $this->ajaxReturn($result);
    }

    /**
     * 管理员权限
     * method: post
     * url: /Admin/Index/identity
     */
    public function identity() {
        $admin = M('Admin');
        
        $map['admin_id'] = $this->adminId;
        $userIdentity = $admin->where($map)->field('identity')->select();
        foreach ($userIdentity as $identity) {}
        $result = \StatusCode::code(0);
        $result['data'] = $identity; 
        $this->ajaxReturn($result);
    }
}
