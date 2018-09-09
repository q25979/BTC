<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Controller\AlismsController;
class MsgController extends Controller{
    
    public function messageVerify() {
		$this->display();
	}

	/**
	 *短信验证
	 *method: post
	 *url: /Admin/Msg/sendCode
	 * 
	 */
    public function sendCode(){
    	$phone = '18159850901';
        $code = new AlismsController(); //此类存放在Common\Controller\
        $code->code($phone,$msg);
       	$this->ajaxReturn($msg);
    }
}
?>