<?php
namespace Demo\Controller;
use Think\Controller;

class LoginController extends Controller {
    public function index() {
        // 登录成功
        $cookie['email'] = base64_encode('455445@qq.com');
        $cookie['password'] = base64_encode('2187989');
        cookie('identification', $cookie);
	}
}
