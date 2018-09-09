<?php
namespace Float\Controller;
use Think\Controller;

/**
 * 作者：亮哥
 * 时间：2018年4月16日20:43:42
 * 功能：账户管理
 */
class IndexController extends Controller {
    /**
     * 浮动设置
     *
     * method: get
     * url: /Float/Index/index
     */
    public function index() {
        set_time_limit(5);
        Vendor('phpRPC.phprpc_client');
        $client = new \PHPRPC_Client(HOST_PATH. '/Float/FloatSet');

        $result = $client->index();

        $this->ajaxReturn($result);
        // header('Location:'. HOST_PATH. '/Float/FloatSet');
    }

    /**
     * 真实数据浮动
     * 比特币
     * 莱特币
     */
    public function getdata() {
        $type = I('get.type');
        $req = new \Request();
        $exchange = M('Exchange');
        $burl = 'http://api.bitkk.com/data/v1/ticker?market=btc_usdt';  // 比特币
        $lurl = "http://api.bitkk.com/data/v1/ticker?market=ltc_usdt";  // 以太币

        // last实时价格
        $info['btc'] = json_decode($req->httpGet($burl));
        $info['ltc'] = json_decode($req->httpGet($lurl));

        // 获取汇率
        $edata = $exchange->where('id=1')->cache('exchange')->find();
        if (!isset($edata)) {
            $edata = [
                'usd' => 0,
                'twd' => 0,
                'hkd' => 0
            ];
        }

        // 返回价格
        if ($type == 'usd') {
            $fexchange = $edata['usd'];
        } elseif ($type == 'twd') {
            $fexchange = $edata['twd'];
        } else {
            $fexchange = $edata['hkd'];
        }

        $result = [
            'btc' => $info['btc']->ticker->last * $fexchange,
            'ltc' => $info['ltc']->ticker->last * $fexchange
        ];
        $this->ajaxReturn($result);
    }
}
