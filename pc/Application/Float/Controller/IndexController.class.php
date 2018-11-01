<?php
namespace Float\Controller;
use Think\Controller;

/**
 * 作者：亮哥
 * 时间：2018年4月16日20:43:42
 * 功能：账户管理
 */
class IndexController extends Controller 
{
    /**
     * 浮动设置
     *
     * method: get
     * url: /Float/Index/index
     */
    public function index() 
    {
        set_time_limit(5);
        Vendor('phpRPC.phprpc_client');
        $client = new \PHPRPC_Client(HOST_PATH. '/Float/FloatSet');

        $result = $client->index();

        $this->ajaxReturn($result);
    }

    /**
     * 真实数据浮动
     * 比特币
     * 莱特币
     */
    public function getdata() 
    {
        $type = I('get.type');
        $req  = new \Request();
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

    /**
     * 获取货币汇率
     */
    public function exchange() 
    {
        $exchange = M('Exchange');
        $edata = $exchange->where('id=1')->cache('exchange')->find();

        $this->ajaxReturn($edata);
    }

    /**
     * 更新比特币价格
     */
    public function updatebtc() 
    {
        $req  = new \Request();
        $burl = 'http://api.bitkk.com/data/v1/ticker?market=btc_usdt';
        $info = json_decode($req->httpGet($burl));

        M('WCloseset')->where('id=1')->save([
            'last' => $info->ticker->last,
            'open' => $info->ticker->sell,
            'low'  => $info->ticker->low,
            'high' => $info->ticker->high,
            'update_time' => time()
        ]);
    }

    /**
     * 獲取比特幣價格
     */
    public function getbtc()
    {
        $info = M('WCloseset')->field('id,set', true)->where('id=1')->find();
        $info = [
            'time' => date("H:i:s"),
            'last' => $info['last']+$this->frand(),
            'open' => $info['open'],
            'low'  => $info['low'],
            'high' => $info['high']
        ];

        $this->ajaxReturn($info);
    }

    /**
     * 获取K线图数据
     */
    public function getkdata()
    {
        $type = I('get.type');
        $url  = "http://api.bitkk.com/data/v1/kline?market=btc_usdt&type=".$type."&size=200";
        $data = \Request::httpGet($url);

        $this->ajaxReturn($data);
    }

    // 随机数
    private function frand() 
    {
        return mt_rand(0, 1000)/10000;
    }
}
