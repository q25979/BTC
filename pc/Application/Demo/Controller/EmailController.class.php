<?php
namespace Demo\Controller;
use Think\Controller;

class EmailController extends Controller {
    public function index() {
        // 发送邮件
        $mail = new \SendEmail('iam671@outlook.com', '包装类', '<p>html内容</p>');

        $this->ajaxReturn($mail->send());
	}
}
