<?php
namespace Float\Controller;
use Think\Controller;

/**
 * 作者：亮哥
 * 时间：2018年4月16日20:43:42
 * 功能：账户管理
 */
class FloatSetController extends Controller {
    /**
     * liunx浮动设置
     *
     * method: get
     * url: /Float/FloatSet
     */
    public function index() {
        $HomeInfo = M('HomeInfo');

        $map['home_info_id'] = HOME_INFO_ID;
        $info = $HomeInfo->where($map)->find();

        ignore_user_abort(true);
        set_time_limit(0);
        ob_end_clean();
        ob_start();
        while ((int)$info['float_status']) {
            echo str_repeat(" ", 1024); //写满IE有默认的1k buffer
            ob_flush();                 //将缓存中的数据压入队列
            flush();

            echo "time: ". date('Y-m-d H:i:s', time()) ." success!";
            echo "<br />";

            $info = $HomeInfo->where($map)->find();

            // 执行浮动
            $cv  = M('CurrencyValue');      // 基础浮动值
            $scv = M('ShowCurrencyValue');  // 显示浮动值
            $cvMap['id'] = CURRENCY_VALUE_ID;
            $cvInfo = $cv->where($cvMap)->find();

            $btcMin = (float)$cvInfo['btc_float_min'] * 10000;
            $btcMax = (float)$cvInfo['btc_float_max'] * 10000;
            $etcMin = (float)$cvInfo['etc_float_min'] * 10000;
            $etcMax = (float)$cvInfo['etc_float_max'] * 10000;

            $btcRange = (float)rand($btcMin, $btcMax) / 10000;    // btc浮动值
            $etcRange = (float)rand($etcMin, $etcMax) / 10000;    // etc浮动值

            $btcValueTwd = (float)$cvInfo['btc_value_twd'] * $btcRange;     // btc新台币
            $btcValueHkd = (float)$cvInfo['btc_value_hkd'] * $btcRange;     // btc港币
            $btcValueUsd = (float)$cvInfo['btc_value_usd'] * $btcRange;     // btc美元

            $etcValueTwd = (float)$cvInfo['eth_value_twd'] * $etcRange;     // etc新台币
            $etcValueHkd = (float)$cvInfo['eth_value_hkd'] * $etcRange;     // etc港币
            $etcValueUsd = (float)$cvInfo['eth_value_usd'] * $etcRange;     // etc美元

            // 设置数据
            $scvData = array(
                'btc_value_twd' => (float)$cvInfo['btc_value_twd'] + $btcValueTwd,
                'btc_value_hkd' => (float)$cvInfo['btc_value_hkd'] + $btcValueHkd,
                'btc_value_usd' => (float)$cvInfo['btc_value_usd'] + $btcValueUsd,
                'eth_value_twd' => (float)$cvInfo['eth_value_twd'] + $etcValueTwd,
                'eth_value_hkd' => (float)$cvInfo['eth_value_hkd'] + $etcValueHkd,
                'eth_value_usd' => (float)$cvInfo['eth_value_usd'] + $etcValueUsd
            );

            $scvMap['id'] = SHOW_CURRENCY_VALUE_ID;
            $scv->where($scvMap)->save($scvData);

            usleep(1000000 * 2 * 60); // 3m
        }
    }

    /**
     * window浮动设置
     *
     * method: get
     * url: /Float/FloatSet/window
     */
    public function window() {
        $HomeInfo = M('HomeInfo');

        $map['home_info_id'] = HOME_INFO_ID;
        $info = $HomeInfo->where($map)->find();

        if((int)$info['float_status'] == 1) {

            $info = $HomeInfo->where($map)->find();

            // 执行浮动
            $cv  = M('CurrencyValue');      // 基础浮动值
            $scv = M('ShowCurrencyValue');  // 显示浮动值
            $cvMap['id'] = CURRENCY_VALUE_ID;
            $cvInfo = $cv->where($cvMap)->find();

            $btcMin = (float)$cvInfo['btc_float_min'] * 10000;
            $btcMax = (float)$cvInfo['btc_float_max'] * 10000;
            $etcMin = (float)$cvInfo['etc_float_min'] * 10000;
            $etcMax = (float)$cvInfo['etc_float_max'] * 10000;

            $btcRange = (float)rand($btcMin, $btcMax) / 10000;    // btc浮动值
            $etcRange = (float)rand($etcMin, $etcMax) / 10000;    // etc浮动值

            $btcValueTwd = (float)$cvInfo['btc_value_twd'] * $btcRange;     // btc新台币
            $btcValueHkd = (float)$cvInfo['btc_value_hkd'] * $btcRange;     // btc港币
            $btcValueUsd = (float)$cvInfo['btc_value_usd'] * $btcRange;     // btc美元

            $etcValueTwd = (float)$cvInfo['eth_value_twd'] * $etcRange;     // etc新台币
            $etcValueHkd = (float)$cvInfo['eth_value_hkd'] * $etcRange;     // etc港币
            $etcValueUsd = (float)$cvInfo['eth_value_usd'] * $etcRange;     // etc美元

            // 设置数据
            $scvData = array(
                'btc_value_twd' => (float)$cvInfo['btc_value_twd'] + $btcValueTwd,
                'btc_value_hkd' => (float)$cvInfo['btc_value_hkd'] + $btcValueHkd,
                'btc_value_usd' => (float)$cvInfo['btc_value_usd'] + $btcValueUsd,
                'eth_value_twd' => (float)$cvInfo['eth_value_twd'] + $etcValueTwd,
                'eth_value_hkd' => (float)$cvInfo['eth_value_hkd'] + $etcValueHkd,
                'eth_value_usd' => (float)$cvInfo['eth_value_usd'] + $etcValueUsd
            );

            $scvMap['id'] = SHOW_CURRENCY_VALUE_ID;
            $floatInfo = $scv->where($scvMap)->save($scvData);

            if ($floatInfo > 0) {
                echo "time: ". date('Y-m-d H:i:s', time()) ." success!";
                echo "<br />";

            } else {
                echo "time: ". date('Y-m-d H:i:s', time()) ." failed!";
                echo "<br />";
            }
        }
    }
}
