<?php
/**
 * 功能：基于PHPMailer发送邮件
 * 时间：2018年5月3日14:51:06
 * 作者：@671
 */

use PHPMailer\PHPMailer\PHPMailer;

require_once VENDOR_PATH.'PHPMailer/src/Exception.php';
require_once VENDOR_PATH.'PHPMailer/src/PHPMailer.php';
require_once VENDOR_PATH.'PHPMailer/src/SMTP.php';

class SendEmail {
    public $email;      // 接收的email
    public $subject;    // email标题
    public $html;       // html的内容

    public function __construct($email, $subject, $html) {
        $this->email   = $email;
        $this->subject = $subject;
        $this->html    = $html;
    }

    /**
     * 发送邮件
     *
     * @return json code为0时发送成功
     */
    public function send() {
        $c = $this->config();

        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $this->type($c['email_type']);
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';

        $mail->FromName = $c['email_account'];
        $mail->Username = $c['email_account'];
        $mail->Password = base64_decode($c['email_password']);
        $mail->From = $c['email_account'];
        $mail->addAddress($this->email);

        $mail->isHTML(true);
        $mail->Subject = $this->subject;

        $mail->Body = $this->html;

        return $mail->send() ? \StatusCode::code(0) : \StatusCode::code(-1);
    }

    /**
     * 配置发送邮件信息
     *
     * @return json 返回配置基本信息
     */
    public function config() {
        $HomeInfo = M('HomeInfo');

        $map['home_info_id'] = HOME_INFO_ID;
        $info = $HomeInfo
            ->where($map)
            ->field('email_type, email_account, email_password')
            ->find();

        return $info;
    }

    /**
     * 设置邮箱类型
     *
     * @param  $type     类型
     * @return string   服务器
     */
    public function type($type) {
        if ($type == EMAIL_TYPE_QQ)     return 'smtp.qq.com';
        if ($type == EMAIL_TYPE_163)    return 'smtp.163.com';
        if ($type == EMAIL_TYPE_YAHOO)  return 'smtp.mail.yahoo.com';
    }
}