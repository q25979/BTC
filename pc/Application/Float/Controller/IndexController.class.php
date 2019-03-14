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
        $lurl = "http://api.bitkk.com/data/v1/ticker?market=ltc_usdt";  // 莱特币

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
     * 更新设置
     */
    public function updatebtc()
    {
        $req  = new \Request();
        $burl = 'http://api.bitkk.com/data/v1/ticker?market=btc_usdt';
        $info = json_decode($req->httpGet($burl));

        $data = [
            'last' => $info->ticker->last + $this->frand(),
            'open' => $info->ticker->sell,
            'low'  => $info->ticker->low,
            'high' => $info->ticker->high,
            'execute' => $info->ticker->last,
            'update_time' => time()
        ];
        M('WSet')->where('id=1')->save($data);

        return $data;
    }

    /**
     * 獲取比特幣價格
     */
    public function getbtc()
    {
        $info = M('WSet')->field('id,set', true)->where('id=1')->find();
        $info = [
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
        $data['k'] = \Request::httpGet($url);
        $data['timestamp'] = time();

        $this->ajaxReturn($data);
    }

    /**
     * 获取K最后一期数据 
     * 时间： 2019年3月9日
     */
    public function ticker()
    {
        $req  = new \Request();
        $burl = 'http://api.bitkk.com/data/v1/ticker?market=btc_usdt';
        $info = json_decode($req->httpGet($burl));

        $this->ajaxReturn($info);
    }

    // 随机数
    private function frand() 
    {
        return mt_rand(0, 1000)/10000;
    }

    // 微平台运行,开奖,统计
    public function wrun()
    {
        // 渲染
        if (!IS_AJAX) return $this->display();

        $data = $this->updatebtc(); // 设置数据
        $h = (int)date('H');
        $m = (int)date('i');
        $s = (int)date('s');
        $number = (int)(($h*60+$m)/5+1);    // 当前期数
        $starttime = strtotime(date('Y-m-d').' '.'00:00:00');   // 今日开始时间
        $endtime   = strtotime(date('Y-m-d').' '.'23:59:59');   // 今日结束时间
        $step = 0;      // 进行的步骤
        $stepdata = []; // 进行的步骤数据

        if ($m%5 == 4 && $s >= 30 && $s < 55) {
            // 设置当前期数执行价和成交价  0-涨   1-跌
            $execute = $data['execute'] + $this->frand();    // 执行价
            $set = M("WOpenset")->getFieldByNumber($number, 'set'); // 当前期数涨或跌
            $last = $set == 0   // 成交价
                ? $execute + $this->frand()
                : $execute - $this->frand();

            $datafile = fopen('./datafile.txt', 'w+');
            fwrite($datafile, 'this a File');
            fclose();

            // 保存session
            session('price.execute', $execute); // 执行价
            session('price.last', $last);       // 成交价
            session('price.set', $set);         // 开奖方向
            $step = 1;
            $stepdata = ['execute_price' => $execute, 'last_price' => $last];

        } elseif ($m%5 == 4 && $s >= 55 && $s < 60) {
            // 保存开奖记录
            $map['number'] = $number;
            $map['create_time'] = array(array('EGT', $starttime), array('ELT', $endtime));
            $openlogcount = M('WOpenlog')->where($map)->count();
            if ($openlogcount <= 0) {
                // 说明没有保存过数据
                if (session('?price.execute')) {
                    $priceset = session('price.set');
                    $priceexecute = session('price.execute');
                    $pricelast = session('price.last');
                    $openlogdata = [
                        'number' => $number,
                        'last_direction' => $priceset,
                        'execute_price'  => $priceexecute,
                        'last_price'     => $pricelast,
                        'create_time'    => time()
                    ];
                    // 保存
                    M('WSet')->where('id=1')->save($openlogdata);
                    $info = M('WOpenlog')->add($openlogdata);
                    if ($info > 0) {
                        $oddsset = M('WSet')->getFieldById('1', 'odds_set'); // 获取赔率
                        // 保存成功，开奖
                        $openmap['buy_number'] = $number;
                        $openmap['buy_time'] = array(array('EGT', $starttime), array('ELT', $endtime));
                        $openmap['last_direction'] = array('LT', 0);
                        
                        // 查询购买本期的人
                        $openlist = M('WMinlog')
                            ->where($openmap)
                            ->field('id,uid,money,buy_direction')
                            ->select();
                        $opendata['last_direction'] = $priceset;
                        $opendata['execute_price']  = $priceexecute;
                        $opendata['last_price']     = $pricelast;
                        foreach ($openlist as $k => $v) {
                            // 更新数据
                            $openmap['id'] = $v['id'];
                            if ($v['buy_direction'] == $priceset) {
                                $opendata['last_money'] = $v['money']*$oddsset;
                            } else {
                                $opendata['last_money'] = 0;
                            }
                            
                            M('WMinlog')->where($openmap)->save($opendata); // 更新记录
                            M('UserAccount')->where(['user_id'=>$v['uid']])->setInc('extract_balance', $opendata['last_money']); // 账户余额加钱
                        }
                        $step = 2;
                        $stepdata = ['execute_price' => $priceexecute, 'last_price' => $pricelast];
                    }
                }
            }
        }

        $this->ajaxReturn([
            'code' => 0,
            'msg'  => 'Success',
            'step' => $step,
            'data' => $stepdata,
            'number' => $number
        ]);
    }
}
