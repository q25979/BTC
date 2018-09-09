<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 作者：671
 * 时间：2018年4月18日10:46:14
 * 功能：切换语言
 */
class LangController extends Controller {
    public function index() {

    }

    /**
     * 切换语言
     *
     * method: get
     * URL:/Home/Lang/change
     * @param lang  zh-tw, en-us
     */
    public function change() {
        $lang = I('get.');

        cookie('lang', $lang['lang']);

        $this->ajaxReturn(\StatusCode::code(0));
    }

    /**
     * 切换币种
     *
     * method: get
     * url: /Home/Lang/currency
     * @param type 1-twd 2-hkd 3-usd
     */
    public function currency() {
        $type = I('get.type');

        cookie('float_value', $type, 7*24*60*60);

        $this->ajaxReturn(\StatusCode::code(0));
    }
}
