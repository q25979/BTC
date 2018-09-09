<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 作者：671
 * 时间：2018年4月16日16:51:07
 * 功能：验证
 */
class VerifyController extends Controller {
    public $user_id;
    public $lang;

    public function __construct() {
        parent::__construct();

        $this->isLang();
        $this->isExist();
    }

    /**
     * 账号是存在的
     */
    public function isExist() {
        $cookie = cookie('identification');
        $user = M('User');

        if (!empty($cookie)) {
            $data['email'] = base64_decode($cookie['email']);
            $data['password'] = base64_decode($cookie['password']);

            $info = $user->where($data)->field('user_id')->find();
            if (!empty($info)) {
                $this->user_id = $info['user_id'];
                return true;
            }
        }

        header('Location: '. HOST_PATH . '/Home/Login/index');
        return false;
    }

    /**
     * URL是有语言参数的
     */
    public function isLang() {
        if (!IS_POST) {
            $lang = cookie('lang') ? cookie('lang') : 'zh-tw';
            $this->lang = $lang;
        }

        return true;
    }
}