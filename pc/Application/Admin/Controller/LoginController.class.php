<?php
namespace Admin\Controller;
use Think\Controller;

// +---------------------------------------------------
// | 作者：庄
// +---------------------------------------------------
// | 时间：2018年4月20日
// +---------------------------------------------------
// | 功能：登录后台
// +---------------------------------------------------

class LoginController extends Controller {
    public function index(){
        $key = I('get.key');
        if ($key != 'ajKTowXwmOoapxtD') {
            echo "nginx 2.10.2/404";
            return false;
        }

        $this->display();
    }

    // 登录后台
    public function getAccount() {
        // 获取数据 user, pass
        $data = I('post.');
        $admin = M('Admin');
        $verify = new \Think\Verify();

        // 查询用户是否存在
        $userMap['user_name'] = $data['user_name'];
        $userInfo = $admin->where($userMap)->count();
        
        // 判断是否为空
        if ($userInfo == 0) {
            $this->ajaxReturn(\StatusCode::code(1002));
        }
        $passInfo = $admin->where($data)->count();
        // 判断密码是否正确
        if ($passInfo == 0) {
            $this->ajaxReturn(\StatusCode::code(1004));
        }
        // 验证验证码
        if (!$verify->check($data['code'])) {
            $this->ajaxReturn(\StatusCode::code(1006));
        }

        // 设置账号密码缓存
        $account['user_name'] = $data['user_name'];
        $account['pass_word'] = $data['pass_word'];

        cookie('admin_account', $account);

        $result = \StatusCode::code(0);
        $result['msg'] = "登录成功";
        $this->ajaxReturn($result);
    }

    // 验证码
    public function verify() {
		ob_clean();
    	$Verify = new \Think\Verify();

    	$Verify->length = 4;
    	$Verify->entry();
    }
}