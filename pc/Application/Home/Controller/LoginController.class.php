<?php
namespace Home\Controller;
use League\Flysystem\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Think\Controller;

/**
 * 作者：671
 * 时间：2018年4月16日16:51:07
 * 功能：登录
 */
class LoginController extends Controller {
    public $lang;

    public function __construct() {
        parent::__construct();
        $lang = cookie('lang') ? cookie('lang') : 'zh-tw';
        $this->lang = $lang;
    }

    /**
     * 登录渲染页面
     */
    public function index() {
        $this->display();
    }

    /**
     * 获取联系我们
     * method GET
     * URL:/Home/Login/getContactUs
     */
    public function getContactUs() {
        $HomeInfo = M('HomeInfo');
        $I18nId = M('I18n');

        $map['id'] = HOME_INFO_ID;
        $result = $HomeInfo->field('i18n_id, company_tel, company_email')->where($map)->find();
        $result['service_time'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($result['i18n_id'], 'TW_content')
            : $I18nId->getFieldByI18nId($result['i18n_id'], 'EN_content');

        $this->ajaxReturn($result);
    }

    /**
     * 注册
     *
     * method:POST
     * URL:/Home/Login/register
     * @param email
     * @param nonce_ste
     * @param sign
     */
    public function register() {
        $data = I('post.');
        $User = M('User');

        if (!\Common::verifyMd5($data['sign'], $data['email'] . $data['nonce_str'])) {
            $this->ajaxReturn(\StatusCode::code(-100));
        }

        // 判断用户是否有注册过
        $map['email'] = $data['email'];
        $count = $User->where($map)->count();
        (int)$count !== 0
            ? $this->ajaxReturn(\StatusCode::code(1001))
            : $count=0;

        // 判断token是否生成过，没有生成过就插入token
        $Token = M('Token');
        $tMap['token'] = md5(base64_encode(base64_encode($data['email'])));
        $tCount = $Token->where($tMap)->count();
        (int)$tCount !== 0
            ? $tCount = 0
            : $Token->add($tMap);

        $result = $this->sendEmail($data['email']);
        $this->ajaxReturn($result);
    }

    /**
     * 重置密码
     *
     * method: post
     * URL: /Home/Login/reset
     * @param email
     * @param nonce_str
     * @param sign
     */
    public function reset() {
        $data = I('post.');
        $User = M('User');
        $map['email'] = $data['email'];

        if (!\Common::verifyMd5($data['sign'], $data['email'] . $data['nonce_str'])) {
            $this->ajaxReturn(\StatusCode::code(-100));
        }

        // 判断账户是否存在，存在就发送邮箱
        $count = $User->where($map)->count();
        $result = $count <= 0
            ? \StatusCode::code(0)
            : $this->sendEmail($data['email']);

        $this->ajaxReturn($result);
    }

    /**
     * 获取基本信息
     * method: get
     * URL: /Home/Login/getBasics
     */
    public function getBasics() {
        $this->ajaxReturn(EmailController::receive());
    }
    /**
     * 获得logo管理数据(操作home_info表)
     * 方式：GET
     * 参数：无
     */
    public function getupdateLogo(){
        $logo = M('Home_info');
        $map['id'] = HOME_INFO_ID;

        $info = $logo->where($map)->cache('logo')->field('background_url,logo_url,name')->select();

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4002);
        }

        $result['data'] = $info;
        $this->ajaxReturn($result);
    }

    /**
     * 发送邮件
     *
     * @param $email 邮箱
     * @return array 状态
     */
    private function sendEmail($email) {
        $HomeInfo = M('HomeInfo');
        $info = $HomeInfo
            ->field('name, email_type, email_account, email_password')
            ->where('id='. HOME_INFO_ID)
            ->find();

        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $this->setEmailType($info['email_type']);
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';

        $mail->FromName = $info['name'];
        $mail->Username = $info['email_account'];
        $mail->Password = base64_decode($info['email_password']);
        $mail->From = $info['email_account'];
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = '歡迎使用'. $info['name'] .'!';

        // 渲染发送邮件页面
        $token    = base64_encode(base64_encode($email));
        $username = explode('@', $email)[0];
        $url   = HOST_PATH . '/Home/Email/index/token/'. $token;

        $data['url']      = $url;
        $data['username'] = $username;
        $mail->Body = $this->html($data);

        return $mail->send() ? \StatusCode::code(0) : \StatusCode::code(-1);
    }

    /**
     * 设置邮箱类型
     *
     * @type 类型
     *
     * @return type_host
     */
    private function setEmailType($type) {
        if ($type == EMAIL_TYPE_QQ)     return 'smtp.qq.com';
        if ($type == EMAIL_TYPE_163)    return 'smtp.163.com';
        if ($type == EMAIL_TYPE_YAHOO)  return 'smtp.mail.yahoo.com';
    }

    /**
     * 登录
     * method:POST
     * URL:/Home/Login/login
     * @param email
     * @param password
     * @param nonce_str
     * @param sign
     */
    public function login() {
        $data = I('post.');
        $user = M('User');

        // md5校验
        $md5String = $data['email'] . $data['nonce_str'] . $data['password'];
        if (!\Common::verifyMd5($data['sign'], $md5String)) $this->ajaxReturn(\StatusCode::code(-100));

        $map['email'] = $data['email'];
        $count = $user->where($map)->count();
        if ($count <= 0) $this->ajaxReturn(\StatusCode::code(1002));

        $map['password'] = $data['password'];
        $count = $user->where($map)->count();
        if ($count <= 0) $this->ajaxReturn(\StatusCode::code(1004));

        // 判断账号是否被锁定
        $status = $user->getFIeldByEmail($data['email'], 'status');
        $status == USER_STATUS_LOCK ? $this->ajaxReturn(\StatusCode::code(1007)) : $cookie = array();

        // 登录成功
        $cookie['email'] = base64_encode($data['email']);
        $cookie['password'] = base64_encode($data['password']);
        cookie('identification', $cookie);

        //更新登录ip
        $rule['login_ip'] = \Common::getIP();
        $userId['user_id'] = $user->getFieldByEmail($data['email'],'user_id');
        $user->where($userId)->save($rule);

        //如果有设置登录提醒的用户要发送邮件
        $userSet = M('UserSet');

        $param['user_id'] = $user->getFieldByEmail($data['email'],'user_id');
        $setParam = $userSet->where($param)->field("
            email_login
            ")->select();

        if ($setParam[0]['email_login'] == USER_SET_EMAIL_LOGIN_YES) {

            $userInfo = $user->where($param)->select();
            //发送邮件
            $userInfo[0]['time'] = time();
            $userInfo[0]['time'] = date('Y-m-d', $userInfo[0]['time']);
            $mail = new \SendEmail($data['email'], '登錄提示', $this->hintHtml($userInfo[0]));
            $mail->send();
        }
        
        $this->ajaxReturn(\StatusCode::code(0));
    }

    /**
     * 登出
     * method: GET
     * URL: /Home/Login/logout
     */
    public function logout() {
        cookie('identification', null);
        header('Location: '. HOST_PATH);
    }

    /**
     * html
     */
    private function html($data) {
        $rece = EmailController::receive();

        $html  = '';
        $html .= '<!DOCTYPE html>';
        $html .= '<html lang="en">';
        $html .= '<head>';
        $html .= '<meta charset="UTF-8" />';
        $html .= '<style>'. $this->style() .'</style>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<block name="receive">';
        $html .= '<div class="receive-container">';
        $html .= '<div class="receive-content">';
        $html .= '<div class="receive-content-hd"></div>';
        $html .= '<div class="receive-content-bd">';
        $html .= '<div class="receive-logo">';
        $html .= '<img src="'. $rece['logo_url'] .'" class="receive-logo-img page-logo" />';
        $html .= '<h3 class="receive-logo-title">'. $rece['name'] .'</h3>';
        $html .= '</div>';
        $html .= '<div class="receive-text-content">';
        $html .= '<p>親愛的 '. $data['username'] .' :</p>';
        $html .= '<p>感謝您使用'. $rece['name'] .'，請點擊以下鏈接完成操作流程。</p>';
        $html .= '<a href="'. $data['url'] .'" class="receive-website" target="_blank">'. $data['url'] .'</a>';
        $html .= '<p>若有任何疑問，請寫信至<a href="javascript:">'. $rece['company_email'] .'</a>';
        $html .= '，或撥打客服專線<span class="receive-phone">'. $rece['company_tel'] .'</span></p>';
        $html .= '<p>感謝您選擇 '. $rece['name'] .'</p>';
        $html .= '<p>'. $rece['name'] .' 敬上</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="receive-content-fd">';
        $html .= '<p>關於本訊息</p>';
        $html .= '<p>本服務訊息是寄給 '. $rece['name'] .'客戶，以提供您賬戶最新資料。您的個人資料受到 ';
        $html .= $rece['name'].' 技術的保護。</p>';
        $html .= '<ul><li><a href="javascript:;" target="_blank">取消訂閱</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">使用條款</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">隱私權政策</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">常見問題</a></li></ul></div></div></div>';
        $html .= '</block>';
        $html .= '</body>';
        $html .= '</html>';

        return $html;
    }

    /**
     * css
     */
    private function style() {
        $css  = '.receive-container{margin-top: 50px; width: 100%; height: 500px;background-color: #fff;}';
        $css .= '.receive-content{width: 580px;height: 500px;background-color: #fff;margin: 0 auto;}';
        $css .= '.receive-content-hd{width: 580px;height: 10px;background-color: #3388BB;}';
        $css .= '.receive-content-bd{width: 580px;height: 370px;background-color: #fff;}';
        $css .= '.receive-logo{width: 580px;height: 140px;display: flex;flex-direction: column;align-items: center;}';
        $css .= '.receive-logo-img{margin-top: 20px;width: 50px;height: 50px;margin-bottom: 15px;}';
        $css .= '.receive-logo-title{color: #3388BB;margin: 0;}';
        $css .= '.receive-text-content{width: 580px;height: 220px;padding: 0 16px}';
        $css .= '.receive-text-content p{margin-bottom: 14px;font-size: 14px;}';
        $css .= '.receive-website{font-size: 14px;width: 380px;display: inline-block;color: #53AFD2;margin-bottom: 14px;text-decoration: underline;}';
        $css .= '.receive-website:hover{color: #EF5356;}';
        $css .= '.receive-email{color: #558DB5;}';
        $css .= '.receive-phone{color: #383838;border-bottom: 1.5px #D9E0DB dashed !important;}';
        $css .= '.receive-content-fd{width: 580px;height: 120px;background-color: #F3F3F3;padding: 10px 12px;}';
        $css .= '.receive-content-fd p{color: #9E9E9E;margin-bottom: 10px;}';
        $css .= '.receive-content-fd ul{list-style: none;}';
        $css .= '.receive-content-fd li{float: left;text-decoration: underline;margin-right: 44px;}';
        $css .= '.receive-content-fd a{color: #949597;font-size: 14px;}';
        $css .= '.receive {width: 100%;margin-top: 3px;box-shadow: 0 -2px 2px #E0E0E0;}';

        return $css;
    }

    /**
     * 货币价值
     * URL： /Home/Login/getFloat
     * method: post
     * 参数： currency_type 币种类型 1：twd 2：hkd 3:usd
     */
    public function getFloat() {
        
        $currency = M('ShowCurrencyValue');
        $info = I('post.');
        $data = $currency->select();
        
        foreach ($data as $k => $v) {
            $btc_twd = $data[$k]['btc_value_twd'];
            $btc_hkd = $data[$k]['btc_value_hkd'];
            $btc_usd = $data[$k]['btc_value_usd'];
            $eth_twd = $data[$k]['eth_value_twd'];
            $eth_hkd = $data[$k]['eth_value_hkd'];
            $eth_usd = $data[$k]['eth_value_usd'];
            }
        $result = \StatusCode::code(0);
        if($info['currency_type'] == 1) {
            $result['btc_twd'] = $btc_twd;
            $result['eth_twd'] = $eth_twd;
            $result['code'] = 1;
            $this->ajaxReturn($result);
        }
        
        if($info['currency_type'] == 2) {
            $result['btc_hkd'] = $btc_hkd;
            $result['eth_hkd'] = $eth_hkd;
            $result['code'] = 2;
            $this->ajaxReturn($result);
        }
        if($info['currency_type'] == 3) {
            $result['btc_usd'] = $btc_usd;
            $result['eth_usd'] = $eth_usd;
            $result['code'] = 3;
            $this->ajaxReturn($result);
        }
        
    }
    /**
     * hintHtml(提示的HTML)
     */
    private function hintHtml($data) {
        $rece = EmailController::receive();

        $html  = '';
        $html .= '<!DOCTYPE html>';
        $html .= '<html lang="en">';
        $html .= '<head>';
        $html .= '<meta charset="UTF-8" />';
        $html .= '<style>'. $this->hintStyle() .'</style>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<block name="receive">';
        $html .= '<div class="receive-container">';
        $html .= '<div class="receive-content">';
        $html .= '<div class="receive-content-hd"></div>';
        $html .= '<div class="receive-content-bd">';
        $html .= '<div class="receive-logo">';
        $html .= '<h3 class="receive-logo-title">'. $rece['name'] .'</h3>';
        $html .= '</div>';

        $html .= '<div class="receive-text-content">';
        $html .= '<p>親愛的 '. $data['user_name'] .' :</p>';
        $html .= '<p>您與'. $data['time'] .'，登錄成功！若非本人操作請及時更換密碼。</p>';

        $html .= '<p>若有任何疑問，請寫信至<a href="javascript:">'. $rece['company_email'] .'</a>';
        $html .= '，或撥打客服專線<span class="receive-phone">'. $rece['company_tel'] .'</span></p>';
        $html .= '<p>感謝您選擇 '. $rece['name'] .'</p>';
        $html .= '<p>'. $rece['name'] .' 敬上</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="receive-content-fd">';
        $html .= '<p>關於本訊息</p>';
        $html .= '<p>本服務訊息是寄給 '. $rece['name'] .'客戶，以提供您賬戶最新資料。您的個人資料受到 ';
        $html .= $rece['name'].' 技術的保護。</p>';
        $html .= '<ul><li><a href="javascript:;" target="_blank">取消訂閱</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">使用條款</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">隱私權政策</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">常見問題</a></li></ul></div></div></div>';
        $html .= '</block>';
        $html .= '</body>';
        $html .= '</html>';

        return $html;
    }
    /**
     * css（提示的CSS）
     */
    private function hintStyle() {
        $css  = '.receive-container{margin-top: 50px; width: 100%; height: 500px;background-color: #fff;}';
        $css .= '.receive-content{width: 580px;height: 500px;background-color: #fff;margin: 0 auto;}';
        $css .= '.receive-content-hd{width: 580px;height: 10px;background-color: #3388BB;}';
        $css .= '.receive-content-bd{width: 580px;height: 370px;background-color: #fff;}';
        $css .= '.receive-logo{width: 580px;height: 140px;display: flex;flex-direction: column;align-items: center;}';
        $css .= '.receive-logo-img{margin-top: 20px;width: 50px;height: 50px;margin-bottom: 15px;}';
        $css .= '.receive-logo-title{color: #3388BB;margin: 0;}';
        $css .= '.receive-text-content{width: 580px;height: 220px;padding: 0 16px}';
        $css .= '.receive-text-content p{margin-bottom: 14px;font-size: 14px;}';
        $css .= '.receive-website{font-size: 14px;width: 380px;display: inline-block;color: #53AFD2;margin-bottom: 14px;text-decoration: underline;}';
        $css .= '.receive-website:hover{color: #EF5356;}';
        $css .= '.receive-email{color: #558DB5;}';
        $css .= '.receive-phone{color: #383838;border-bottom: 1.5px #D9E0DB dashed !important;}';
        $css .= '.receive-content-fd{width: 580px;height: 120px;background-color: #F3F3F3;padding: 10px 12px;}';
        $css .= '.receive-content-fd p{color: #9E9E9E;margin-bottom: 10px;}';
        $css .= '.receive-content-fd ul{list-style: none;}';
        $css .= '.receive-content-fd li{float: left;text-decoration: underline;margin-right: 44px;}';
        $css .= '.receive-content-fd a{color: #949597;font-size: 14px;}';
        $css .= '.receive {width: 100%;margin-top: 3px;box-shadow: 0 -2px 2px #E0E0E0;}';

        return $css;
    }
}
