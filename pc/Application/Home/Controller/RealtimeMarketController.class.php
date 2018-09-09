<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 作者：
 * 时间：
 * 功能：实时行情
 */
class RealtimeMarketController extends Controller {
    public function index() {
        $this->display();

    }

    /**
     * 比特币的实时行情价格
     * URL：/Home/RealtimeMarket/Price
     */
    public function Price(){
    	$Currency = M('show_currency_value');

    	$data=$Currency->select();

    	$result = \StatusCode::code(0);


        $result['data'] = $data;

        $this->ajaxReturn($result);
    }

   
}