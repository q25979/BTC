<?php
namespace Demo\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use Think\Controller;

class IndexController extends Controller {
    public function index() {
        // 获取8位随机数
		
        $e = '277161542@163.com';
        echo base64_encode($e);

        echo base64_decode(base64_encode($e));
	}

	public function t() {
        var_dump(\Common::generateId());
        var_dump(\Common::sGenerateId());
    }

	public function base64() {
        $r = "277161542@qq.com";

        var_dump('email:'. explode('@', $r)[0]);
        echo "<br />";

        var_dump("1. ". base64_encode($r));
        echo "<br />";
        var_dump(md5(base64_encode(base64_encode($r))));
        echo "<br />";

        $s = base64_encode(base64_encode($r));

        var_dump("1.1: ". base64_decode($s));
        echo "<br />";
        var_dump("1.2: ". base64_decode(base64_decode($s)));
        echo "<br />";
    }

    public function empass() {
        echo base64_encode('qegtpbilkixdbich');
    }

	// 获取html
    public function html() {
//        echo T('Index/index');

        $result = $this->fetch(T('Index/index'));
        $result .= '<div style="display: none;" id="email">277161542</div>';

        echo $result;

          // $this->display(T('Index/index'));
        return ;
    }

    // 发送邮箱
    public function sendEmail() {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 1;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.163.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        $mail->FromName = '111';
        $mail->Username = 'binance8856@163.com';
        $mail->Password = 'Aa102030';
        $mail->From = 'binance8856@163.com';
        $mail->isHTML = true;
        $mail->addAddress('iam67@outlook.com');
        $mail->Subject = '主题啊';
        $mail->Body = '<h1>我是一个验证码！验证点击<a href="http://localhost">链接</a></h1>';
        $status = $mail->send();

        print_r($status);
    }

    public function getGet() {
        $get = I('get.');

        $this->ajaxReturn($get);
    }

    public function test1() {
        $this->_test2();

        echo '2222';
    }

    public function _test2() {
        $this->ajaxReturn(1111111111);
    }
}
