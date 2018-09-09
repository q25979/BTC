<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Cookie;

use wxpay\database\WxPayUnifiedOrder;
use wxpay\JsApiPay;
use wxpay\NativePay;
use wxpay\PayNotifyCallBack;
use think\Log;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;

use alipay\wappay\buildermodel\AlipayTradeWapPayContentBuilder;
use alipay\wappay\service\AlipayTradeService;

use pinganpay\Webapp;




use pufapay\ConfigUtil;
use pufapay\HttpUtils;
use pufapay\SignUtil;
use pufapay\TDESUtil;



class Pay extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->parter1 = 1729;
        $this->key1 = '3177204082c74e4db0f24ae2d5290617';
        $this->parter2 = 2865;
        $this->key2 = '57a599aafd1342f8be3b31417883186f';
    }
public function codepay_notify()
    {
		$isPost=true;
	if(empty($_POST)){
		$_POST=$_GET;
		$isPost=false;
	}	
	ksort($_POST); //排序post参数
	reset($_POST); //内部指针指向数组中的第一个元素
	$codepay_key="qB3ZwwrTkyhHN0EuDRwF3rOEZRfGmmoi"; //这是您的密钥
	$sign = '';//初始化
	foreach ($_POST AS $key => $val) { //遍历POST参数
		if ($val == '' || $key == 'sign') continue; //跳过这些不签名
		if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
		$sign .= "$key=$val"; //拼接为url参数形式
	}
	if (!$_POST['pay_no'] || md5($sign . $codepay_key) != $_POST['sign']) { //不合法的数据
		exit('fail');  //返回失败 继续补单
	} else { //合法的数据
		//业务处理
		$pay_id = $_POST['pay_id']; //需要充值的ID 或订单号 或用户名
		$money = (float)$_POST['money']; //实际付款金额
		$price = (float)$_POST['price']; //订单的原价
		$param = $_POST['param']; //自定义参数
		$this->notify_ok_dopay($param,$price);
		if($isPost)exit('success'); //返回成功 不要删除哦
		header("Location: /index/user/index.html"); 
	} }
	
	public function codepay($data,$pay_type){
			
		


		$param = $data['balance_sn'];
		$pay_id = $data['uid'];
        //付款金额，必填
        $price = $data['bpprice'];
		if($pay_type=='codepay_alipay'){
			$pay_type=1;
			$type=1;
		}else if($pay_type=='codepay_qqpay'){
			$pay_type=2;
			$type=2;
		}else{
			$pay_type=3;
			$type=3;
		}
			
		return "/codepay/codepay.php?type={$pay_type}&order_id={$param}";
    }
    /**
     * 微信支付
     * @return [type] [description]
     */
    public function wxpay($data)
    {


        if (!empty($data)) {
            //获取用户openid
            $tools = new JsApiPay();
            $openId = Db::name('userinfo')->where(array('uid'=>$data['uid']))->value('openid');

            if(!$openId){
                return WPreturn('openId不存在',-1);
            }
            //统一下单
            $input = new WxPayUnifiedOrder();
            $input->setBody("会员余额充值");
            $input->setAttach("web_user_pay_ing");

            $input->setOutTradeNo($data['balance_sn']);
            $input->setTotalFee($data['bpprice'] * 100);
            $input->setTimeStart(date("YmdHis"));
            $input->setTimeExpire(date("YmdHis", time() + 600));
            $input->setGoodsTag("goods");
            $input->setNotifyUrl("http://".$_SERVER['SERVER_NAME']."/index/wechat/notifyurl/bpid/".$data['bpid']);
            $input->setTradeType("JSAPI");
            $input->setOpenid($openId);

            $order = WxPayApi::unifiedOrder($input);

            $jsApiParameters = $tools->getJsApiParameters($order);

            /*
            $this->assign('order',$order);
            $this->assign('jsApiParameters',$jsApiParameters);
            return $this->fetch('jsapi');
            */
           return $jsApiParameters;
        }

    }

    /**
     * 中云支付
     * @return [type] [description]
     */
    public function zypay($data,$type)
    {
        

    $pay_memberid = "12849";   //商户ID
    $pay_orderid = $data['balance_sn'];    //订单号
    $pay_amount = $data['bpprice'];    //交易金额
    $pay_applydate = date("Y-m-d H:i:s");  //订单时间
	if($type == 'zypay_wx'){
		$pay_bankcode = "WXZF";   //银行编码
		$tongdao = 'JiuXiaoWxSm';
	}elseif($type == 'zypay_qq'){
		$pay_bankcode = "QQPAY";   //银行编码
		$tongdao = 'JiuXiaoQQSm';
	}
    
    $pay_notifyurl = "http://".$_SERVER['SERVER_NAME']."/index/pay/zypay_notify.html";   //服务端返回地址
    $pay_callbackurl = "http://".$_SERVER['SERVER_NAME']."/index/user/index.html";  //页面跳转返回地址
    
    $Md5key = "BRbRQQLPBDimpdVhs5ynSN3pSIySEd";   //密钥
    
    $tjurl = "http://zy.cnzypay.com/Pay_Index.html";   //提交地址,如有变动请到官网下载最新接口文档
    
    $requestarray = array(
            "pay_memberid" => $pay_memberid,
            "pay_orderid" => $pay_orderid,
            "pay_amount" => $pay_amount,
            "pay_applydate" => $pay_applydate,
            "pay_bankcode" => $pay_bankcode,
            "pay_notifyurl" => $pay_notifyurl,
            "pay_callbackurl" => $pay_callbackurl
        );
        
        ksort($requestarray);
        reset($requestarray);
        $md5str = "";
        foreach ($requestarray as $key => $val) {
            $md5str = $md5str . $key . "=>" . $val . "&";
        }
        
        $sign = strtoupper(md5($md5str . "key=" . $Md5key)); 
        $requestarray["pay_md5sign"] = $sign;
        $requestarray["tongdao"] = $tongdao;
		
		$api = controller('Api');
		$res = $api->curlfun( $tjurl,$requestarray,'POST');
		
		$arr = explode('<img src="',$res);
		if(isset($arr[1])){
			$arr2 = explode('"',$arr[1]);
			if(isset($arr2[0])){
				return "http://zy.cnzypay.com/".$arr2[0];
			}
		}
		
        $str = '<form id="Form1" name="Form1" method="post" action="' . $tjurl . '">';
        foreach ($requestarray as $key => $val) {
            $str = $str . '<input type="hidden" name="' . $key . '" value="' . $val . '">';
        }
        $str = $str . '<input type="submit" value="提交">';
        $str = $str . '</form>';
        $str = $str . '<script>';
        $str = $str . 'document.Form1.submit();';
        $str = $str . '</script>';
        
        return $str;
        

    }


    public function zypay_notify()
    {
        
        $ReturnArray = array( // 返回字段
            "memberid" => $_REQUEST["memberid"], // 商户ID
            "orderid" =>  $_REQUEST["orderid"], // 订单号
            "amount" =>  $_REQUEST["amount"], // 交易金额
            "datetime" =>  $_REQUEST["datetime"], // 交易时间
            "returncode" => $_REQUEST["returncode"]
        );
		
		
      
        $Md5key = "BRbRQQLPBDimpdVhs5ynSN3pSIySEd";
        //$sign = $this->md5sign($Md5key, $ReturnArray);
        
        ///////////////////////////////////////////////////////
        ksort($ReturnArray);
        reset($ReturnArray);
        $md5str = "";
        foreach ($ReturnArray as $key => $val) {
            $md5str = $md5str . $key . "=>" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $Md5key)); 
        ///////////////////////////////////////////////////////
        if ($sign == $_REQUEST["sign"]) {
            if ($_REQUEST["returncode"] == "00") {
                   $this->notify_ok_dopay($ReturnArray['orderid'],$ReturnArray['amount']);
                   exit("ok");
            }
        }

       
    }
    public function cardpay(){
		$merchant_id		= '8032'; //填写自己的
		//通信密钥
		$merchant_key		= '1539f98fe5e444a0b20aaf826b88d4f6';//填写自己的
		//==========================卡类支付配置=============================
		//支付的区域 0代表全国通用	
		$restrict			= '0';
		//接收下行数据的地址, 该地址必须是可以再互联网上访问的网址
		$callback_url		= "http://m.bfdee.cn/index/pay/cardpay";   
		$callback_url_muti  = "http://m.bfdee.cn";
		header('Content-Type:text/html;charset=GB2312');
		$orderid        = $_GET['orderid'];
		$opstate        = $_GET['opstate'];
		$ovalue         = $_GET['ovalue'];
		$sign           = $_GET['sign'];
		file_put_contents("getpayssss.txt",$_GET['orderid']);
		if(empty($orderid)){
			die("opstate=-1");		//签名不正确，则按照协议返回数据
		}
		$sign_text	= "orderid=$orderid&opstate=$opstate&ovalue=$ovalue".$merchant_key;
		$sign_md5 = md5($sign_text);
		if($sign_md5 != $sign){
			die("opstate=-2");		//签名不正确，则按照协议返回数据
		}
	
		$balance = db('balance')->where('balance_sn',$orderid)->find();
		
		//余额
		$user_money = db('userinfo')->where('uid',$balance['uid'])->value('usermoney');
		$_edit['bptype'] = 1;
		$_edit['bptype'] = 1;
		$_edit['isverified'] = 1;
		$_edit['cltime'] = time();
		//$_edit['bpbalance'] = $balance['bpbalance']+$balance['bpprice'];
		$_edit['bpbalance'] = $balance['bpprice']+$user_money;
	
		db('balance')->where('balance_sn',$orderid)->update($_edit);
		
		$_ids=db('userinfo')->where('uid',$balance['uid'])->setInc('usermoney',$balance['bpprice']);
		
		//set_price_log($balance['uid'],1,$balance['bpprice'],'充值','用户充值',$_edit['bpid'],$_edit['bpbalance']);
		
		set_price_log($balance['uid'],1,$balance['bpprice'],'充值','用户充值',$balance['bpid'],$_edit['bpbalance']);
		
		die("opstate=0");
		
	}



    public function qianbaotong($data,$pay_type,$type=0)
    {
        
        
        /*
        * 商户id，由平台分配
        */
        $parter = 1729;
        $key = '3177204082c74e4db0f24ae2d5290617';
        
        /*
        * 准备使用网银支付的银行
        */
        $type = $pay_type;
        
        /*
        * 支付金额
        */
        $value = $data['bpprice'];
        
        /*
        * 请求发起方自己的订单号，该订单号将作为平台的返回数据
        */
        $orderid = $data['balance_sn'];
        
        /*
        * 在下行过程中返回结果的地址，需要以http://开头。
        */
        $callbackurl = "http://".$_SERVER['SERVER_NAME']."/index/pay/qdb_notify.html";;
        
        /*
        * 支付完成之后平台会自动跳转回到的页面
        */
        $hrefbackurl = "http://".$_SERVER['SERVER_NAME']."/index/user/index.html";;
        
        /*
        * 商户密钥
        */
        
        

        $shidai_bank_url   = 'http://gateway.qpabc.com/bank/index.aspx';

        $url = "parter=". $parter ."&type=". $type ."&value=". $value. "&orderid=". $orderid ."&callbackurl=". $callbackurl;
        //签名
        $sign   = md5($url. $key);
        
        //最终url
        $url    = $shidai_bank_url . "?" . $url . "&sign=" .$sign. "&hrefbackurl=". $hrefbackurl;

        if(in_array($pay_type,array(1005,1006,1007))){
            return $url;
        }else{
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 500);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_URL, $url);
         
            $res = curl_exec($curl);
            curl_close($curl);
            
            $res_arr = json_decode($res,1);
            if(isset($res_arr["retCode"]) && $res_arr["retCode"] == '0000'){
                return $res_arr["codeUrl"];
            }else{
                return false;
            }

            
        }
        

    }





    public function qdb_notify()
    {
        cache('qdb_test',$_GET);
        //$_GET = cache('qdb_test');
        //获取返回的下行数据
        
        //$sysorderid     = trim($_GET['sysorderid']);
        //$completiontime     = trim($_GET['systime']);

        //进行爱扬签名认证
        $key = '3177204082c74e4db0f24ae2d5290617';
        header('Content-Type:text/html;charset=GB2312');
        $orderid        = trim($_GET['orderid']);
        $opstate        = trim($_GET['opstate']);
        $ovalue         = trim($_GET['ovalue']);
        $sign           = trim($_GET['sign']);
        
        //订单号为必须接收的参数，若没有该参数，则返回错误
        if(empty($orderid)){
            die("opstate=-1");      //签名不正确，则按照协议返回数据
        }
        
        $sign_text  = "orderid=$orderid&opstate=$opstate&ovalue=$ovalue".$key;
        $sign_md5 = md5($sign_text);
        if($sign_md5 != $sign){
            die("opstate=-2");      //签名不正确，则按照协议返回数据
        }
        $this->notify_ok_dopay($orderid,$ovalue);
        die("opstate=0");       

    }

    
    public function alipay($data){

        $config = array (   
        //应用ID,您的APPID。
        'app_id' => "2017022705923867",

        //商户私钥，您的原始格式RSA私钥
        'merchant_private_key' => "MIIEowIBAAKCAQEA4SvhwaggPK6YcT9KFcWatlWzmPOGuinPibsSuQOKOzIdndmsobx8gxYsL40SBJZJ7gUzLW53WUPJiu1Cn2K6b1m/PsOQNl6WRQD7fD62fCO5z3Wqitx9bts/LoUbX7vb4Dxpplw7KKVikUCBwe75hOTuhAfQ7dqGzbE0xfKjO2ugRBDceCy5InBK/xfvVbNRk+1DZyexLSUJx7pm5nUCkVj81URlnQYzcW06OBjvSSecTpmAktbvruZE450vhxkfDzxp47R0qba4c8ALRrDlnrUb29EPD4TFmXWGxteZQBQWKbEJWte7tV/sGW9ed/6QeC8A9N3CalnzXpqIF4hpcQIDAQABAoIBAFOUPDnrs/uSOxdeDJvEO0cOzJkrW4jiWByhibOO8tJCKegbkg5+riDiLAiCbnuxZUOqPnLQnBBQLxEYPDB5LwaB45DiejcUKOb4FGDrzkSJ5kBxRppAeXaafvs/gQep7VVwVy7e8T6HFO0haoiXsZp4d2gelpiTEpJrAlGvXJODDzMJPoEcpeHEDUUroH1+PXCGmZL8mB5a+ZzcP14IRsxWEygTy64MADa5RQ3U7qpSKSSiCRvTp1CUIMTEzgcYDziWCpWwdDEjrmyoQy3sUpdxwFrShQ0gwxgFgfawlR31d1rJxarF1/ZOsEa3RbbDdJWS4MwgMbYi70gB4UFTDLkCgYEA9bsfRblnK44C0oWTVxemxtuP96JPpqFj+jtcUMSBDZvnXyV5TKMWiP+agefWgQ5Gz5z6yBEicXvMcC9qcYf2nNnZYeTiCJmSof8dqWg5Uah3l+GBBJ13AVcrhJv/pm1Gkm3+WubREQBEXq3l9F/cRyEMzF2XWFCdrjX7R1JufssCgYEA6pTPTrIxufboxtJJXusdSSueqxN5see4TiqKXizRMuUaEF9h0iHd1fvxHWSMo3zlLt8s4LrR3PlKGXo88RnScNvRE3KyvznLkRhwdaFvTQjSUrMe+wV+OIRJm9UnV2ysqrB3w8+GP6iZPdiRN/AW4rkoPf0SMo2IGYR1/JsLlTMCgYBJxXqW+RlDFyg7wYRBYkVcb/AhvOXCtbMJHacSTFweFM76Xoqy+kc6q9nb5Bket4WEsLENPS+k+DChAWsoWFQuNKyxWgCN6mT+I1PpVvPWUwhMXZPZKdjfWycicZ7nfOjx7vmsmpzrSLQ95GEj41+DLyXjeLmF9vXPpj8g41tuzwKBgQCK31nzDs8ddqzLt4Y0KSCHRsmCId9zkOitbcXIhuO6K6NIeg8hJWd83NAbRIF17+SF4R1iVXcUSIizmIgne8/3fErEJqznREHdPgilutJ3WneY+e2nUdMthjNFi+TkfrOhwSLFyz+AxEEkOeeOpBYIVvEZ8Y4qW1ttL9vhlbA/vQKBgGrC0rchgbdL9Ehd8lG5yDYce1N2ZAxDLLGzyxbp76OExGQMj6vBJZeGp1S6ICNLSbbVWD3Wflk1d0o1o47GgF9p+PXJyeKes2ZTOByH0R+8M92fjVXmOxNUvC0oiqVTlFLd18cH4Yd9d6DaA+msmnkJY62tyZgceJcAmTwRVHkJ",
        
        //异步通知地址
        'notify_url' => "http://".$_SERVER['SERVER_NAME']."/index/pay/alipay_notify.html",
        
        //同步跳转
        'return_url' => "http://".$_SERVER['SERVER_NAME']."/index/user/index.html",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4SvhwaggPK6YcT9KFcWatlWzmPOGuinPibsSuQOKOzIdndmsobx8gxYsL40SBJZJ7gUzLW53WUPJiu1Cn2K6b1m/PsOQNl6WRQD7fD62fCO5z3Wqitx9bts/LoUbX7vb4Dxpplw7KKVikUCBwe75hOTuhAfQ7dqGzbE0xfKjO2ugRBDceCy5InBK/xfvVbNRk+1DZyexLSUJx7pm5nUCkVj81URlnQYzcW06OBjvSSecTpmAktbvruZE450vhxkfDzxp47R0qba4c8ALRrDlnrUb29EPD4TFmXWGxteZQBQWKbEJWte7tV/sGW9ed/6QeC8A9N3CalnzXpqIF4hpcQIDAQAB",
        
    
);


        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $data['balance_sn'];

        //订单名称，必填
        $subject = '用户充值';

        //付款金额，必填
        $total_amount = $data['bpprice'];

        //商品描述，可空
        $body = '';

        //超时时间
        $timeout_express="1m";

        $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setTimeExpress($timeout_express);
        
        $payResponse = new AlipayTradeService($config);

        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        return $result;

    }


    /**
     * izpay
     * @author lukui  2017-08-16
     * @return [type] [description]
     */
    public function izpay_wx($data)
    {
        
        header("Access-Control-Allow-Origin: *");

        $url = 'http://www.izpay.cn:9002/thirdsync_server/third_pay_server';
        
        $para['out_trade_no'] = $data['balance_sn'];
        $para['mer_id'] = 'pay177';
        $para['goods_name'] = 'userpay';
        $para['total_fee'] = $data['bpprice']*100;
        $para['callback_url'] =  "http://".$_SERVER['SERVER_NAME']."/index/user/index.html";
        $para['notify_url'] = "http://".$_SERVER['SERVER_NAME']."/index/pay/izpay_wx_notify.html";
       
        $para['attach'] =  '709';
        $para['nonce_str'] = mt_rand(time(),time()+rand());
        $para['pay_type'] = '003';
        $key = "c71elu2cq25b5m8ks99fxhqteljugo6m";
        
        
        
        
        $sign_str = 'mer_id='.$para['mer_id'].'&nonce_str='.$para['nonce_str'].'&out_trade_no='.$para['out_trade_no'].'&total_fee='.$para['total_fee'].'&key='.$key;
        
        //echo $sign_str;
        
        $para['sign'] = md5($sign_str); 
        
        
        $str = "";
        foreach($para as $key=>$val){
        $str .= $key.'='.$val.'&';
        }
        $newstr = substr($str,0,strlen($str)-1); 
        
        $pay_url = $url.'?'.$newstr;
        
        
        $temp_data = file_get_contents($pay_url);
        $result = json_decode($temp_data,true);
        
        
        return $temp_data;
    }

    public function izpay_alipay($data)
    {
        
        header("Access-Control-Allow-Origin: *");

        $url = 'http://www.izpay.cn:9002/thirdsync_server/third_pay_server';
        
        $para['out_trade_no'] = $data['balance_sn'];
        $para['mer_id'] = 'pay177';
        $para['goods_name'] = 'userpay';
        $para['total_fee'] = $data['bpprice']*100;
        $para['callback_url'] =  "http://".$_SERVER['SERVER_NAME']."/index/user/index.html";
        $para['notify_url'] = "http://".$_SERVER['SERVER_NAME']."/index/pay/izpay_wx_notify.html";
       
        $para['attach'] =  '709';
        $para['nonce_str'] = mt_rand(time(),time()+rand());
        $para['pay_type'] = '006';
        $key = "c71elu2cq25b5m8ks99fxhqteljugo6m";
        
        
        
        
        $sign_str = 'mer_id='.$para['mer_id'].'&nonce_str='.$para['nonce_str'].'&out_trade_no='.$para['out_trade_no'].'&total_fee='.$para['total_fee'].'&key='.$key;
        
        //echo $sign_str;
        
        $para['sign'] = md5($sign_str); 
        
        
        $str = "";
        foreach($para as $key=>$val){
        $str .= $key.'='.$val.'&';
        }
        $newstr = substr($str,0,strlen($str)-1); 
        
        $pay_url = $url.'?'.$newstr;
        
        
        $temp_data = file_get_contents($pay_url);
        $result = json_decode($temp_data,true);
        
        
        return $temp_data;
    }
    
    
    public function izpay_wx_notify(){
        $data = input('');
        if(!isset($data['out_trade_no'])){
            return false;
        }
        $this->notify_ok_dopay($data['out_trade_no'],$data['total_fee']/100);
        return true;
        
    }





    /**
     * 平安微信扫码支付
     * @author lukui  2017-08-17
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function pingan_code($balance,$code)
    {
        $papay = new Webapp();

        $data['out_no'] = $balance['balance_sn'];
        $data['pmt_tag'] = $code;
        $data['original_amount'] = $balance['bpprice']*100;
        $data['trade_amount'] = $balance['bpprice']*100;
        $data['ord_name'] = 'userpay';
        $data['auth_code'] = "";
        $data['jump_url'] = "http://".$_SERVER['SERVER_NAME']."/index/user/index.html";;
        $data['notify_url'] = "http://".$_SERVER['SERVER_NAME']."/index/pay/panotify.html";;
        $result = $papay->api("payorder",$data);
        return $result;
    }

    public function panotify()
    {
        
        $data = $_REQUEST;

        if(isset($data['amount']) && isset($data['out_no'])){
            $this->notify_ok_dopay($data['out_no'],$data['amount']/100);
        }
        

    }




    //钱通支付
    public function qiantong_pay($data)
    {
        $gateway_url = "https://123.56.119.177:8443/pay/pay.htm";
        
        $str = '<?xml version="1.0" encoding="utf-8" standalone="no"?>
                <message application="WeiXinScanOrder" version="1.0.1"
                    timestamp="20160210111111"
                    merchantId="1002207"
                    merchantOrderId="'.$data['balance_sn'].'"
                    merchantOrderAmt="'.($data['bpprice']*100).'"
                    merchantOrderDesc="用户充值"
                    userName=""
                    payerId="'.$data['uid'].'"
                    salerId=""
                    guaranteeAmt="0"
                    merchantPayNotifyUrl="'."http://".$_SERVER['SERVER_NAME']."/index/pay/qiantong_notify.html".'"/>';


        /*****生成请求内容**开始*****/
        $strMD5 =  MD5($str,true);  
        $strsign =  $this->qt_sign($strMD5);
        $base64_src=base64_encode($str);
        $msg = $base64_src."|".$strsign;
        /*****生成请求内容**结束*****/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $gateway_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $tmp = explode("|", $result);
        $resp_xml = base64_decode($tmp[0]);
        
        $resp_sign = $tmp[1];
        if($this->qt_verity(MD5($resp_xml,true),$resp_sign) && $_SESSION['uid'] != 1017){//验签
            
            
            $res_arr = xml_to_array($resp_xml);
            $res_arr = $res_arr['@attributes'];
            
            if(isset($res_arr['respCode']) && $res_arr['respCode'] == 000 && isset($res_arr['codeUrl'])){
                return $res_arr['codeUrl'];
            }
        } else return WPreturn('渠道不可用',-1);
    }

    /**
     * 签名  生成签名串  基于sha1withRSA
     * @param string $data 签名前的字符串
     * @return string 签名串
     */
    public function qt_sign($data) {
        $certs = array();
        $_file = file_get_contents($_SERVER['DOCUMENT_ROOT']."/weixin/qiantong/merchant_cert.pfx");
        
        openssl_pkcs12_read($_file,$certs,"11111111"); //其中password为你的证书密码
        if(!$certs) return ;
        $signature = '';  
        openssl_sign($data, $signature, $certs['pkey']);
        return base64_encode($signature);
    }
    /**
     * 验证签名： 
     * @param data：原文 
     * @param signature：签名 
     * @return bool 返回：签名结果，true为验签成功，false为验签失败 
     */  
    public function qt_verity($data,$signature)  
    {  
        $pubKey = file_get_contents($_SERVER['DOCUMENT_ROOT']."/weixin/qiantong/server_cert.cer");  
        $res = openssl_get_publickey($pubKey);  
        $result = (bool)openssl_verify($data, base64_decode($signature), $res);  
        openssl_free_key($res);
        return $result;  
    }

    public function qiantong_kuaijie($data)
    {
        $gateway_url = "https://123.56.119.177:8443/pay/pay.htm";

        $str = '<?xml version="1.0" encoding="utf-8" standalone="no"?>
        <message application="CertPayOrderH5" guaranteeAmt="0"
            merchantFrontEndUrl="http://'.$_SERVER['SERVER_NAME'].'/index/user/index.html"
            merchantId="1002207" merchantName=""
            merchantOrderAmt="'.($data['bpprice']*100).'" merchantOrderDesc="用户充值" merchantOrderId="'.$data['balance_sn'].'"
            merchantPayNotifyUrl="'."http://".$_SERVER['SERVER_NAME']."/index/pay/qiantong_notify.html".'"
            payerId="'.$data['uid'].'" salerId="" version="1.0.1" />';



        
        /*****生成请求内容**开始*****/
        $strMD5 =  MD5($str,true);  
        $strsign =  $this->qt_sign($strMD5);
        $base64_src=base64_encode($str);
        $msg = $base64_src."|".$strsign;

        /*****生成请求内容**结束*****/
        $def_url = '<form name="ipspay" action="'.$gateway_url.'" method="post">';
        $def_url .= '<input name="msg" type="text" value="'.$msg.'" />';
        $def_url .= '</form>';

        return $def_url;

    }


    public function qiantong_notify(){
        
        
        
        /******异步通知******/
        $result=file_get_contents('php://input', 'r');
        
        $tmp = explode("|", $result);
        $resp_xml = base64_decode($tmp[0]);
        
        $resp_sign = $tmp[1];
        if($this->qt_verity(MD5($resp_xml,true),$resp_sign)){//验签
        
            $resp_arr = xml_to_array($resp_xml);
        
            if(isset($resp_arr["deductList"]["item"]["@attributes"])){
                $item = $resp_arr["deductList"]["item"]["@attributes"];
                $info = $resp_arr["@attributes"];
                if(isset($item["payStatus"]) && $item["payStatus"] == '01' && isset($info["merchantOrderId"]) && isset($item["payAmt"])){
                    $this->notify_ok_dopay($info["merchantOrderId"],round($item["payAmt"]/100,2));
                }
            }
            
        } else echo '验签失败';
        
    }
    

    public function wx_wap_2($data)
    {
        

        date_default_timezone_set('PRC');
        error_reporting(0);
        set_time_limit(0);
        
        $ary = array(
            'token'=>'670b4dc044bd939552228fe114e218b7',//填写用户TOKEN
            'mod'=>'pay',//模式,pay:支付模式,list:返回所有订单信息
            'index'=>1,//模式为list的时候使用,用来指定订单当前页,订单信息每页显示10条
            'oid'=>$data['balance_sn'],//模式为list的时候使用,用来指定查询某个订单的信息
            'title'=>'用户充值',//商品名称
            'price'=>$data['bpprice']*100,//商品价格,请填写整数,以分为单位,例:1元,就填写100
            'curl'=>"http://".$_SERVER['SERVER_NAME']."/index/pay/wxwap2n.html",
            'cip'=>$_SERVER["REMOTE_ADDR"]//用户的支付IP,不可更改
        );
        
        $url = 'http://api.btjson.com/weixinpay';

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($ary));
        $content = curl_exec($ch);
        curl_close($ch);
        
        

        if($ary['mod'] == 'pay'){
            $json = json_decode($content,true);
            $oid = $json['data']['oid'];//返回的订单号,可存在自己的数据库中
            $_data['bpid'] = $data['bpid'];
            $_data['pay_type'] = $oid;
            db('balance')->update($_data);
            if(iswechat()){
                return $json['data']['h5url'];
            }else{
                return $json['data']['pcurl'];
            }
            /*
            if($json['data']['img'] != ''){
                header('Content-Type:image/png');
                echo base64_decode($json['data']['img']);
            }else{
                echo $json['data'];
            }*/
        }
        if($ary['mod'] == 'list'){
            return WPreturn('渠道不可用',-1);
        }
    }



    /**
     * 浦发银行
     * @author lukui  2017-09-12
     * @return [type] [description]
     */ 
    public function pfpay($data=null,$paytype=null)
    {
       
        $param['tradeType'] = 'cs.pay.submit';
        $param['version'] = '1.0';
        $param['channel'] = $paytype;
        $param['mchId'] = '000070037000000013';
        $param["body"]= 'userpay';
        $param["outTradeNo"] = $data['balance_sn'];
        $param["amount"] = $data['bpprice'];
        $param["currency"] = 'CNY';
        $param["notifyUrl"] = "http://".$_SERVER['SERVER_NAME']."/index/pay/pfrefund.html";
        $param["callbackUrl"] = "http://".$_SERVER['SERVER_NAME']."/index/user/index.html";
        
        if((ceil($param["amount"])==$param["amount"])){
            return WPreturn('充值金额请输入小数，如：100.12',-1);
        }
        
        $oriUrl = 'https://mch.one2pay.cn/cloud/cloudplatform/api/trade.html';
        
        
        $unSignKeyList = array ("sign");

        //echo  $_POST["currency"];
//      $desKey = ConfigUtil::get_val_by_key("desKey");
        $sign = SignUtil::signMD5($param, $unSignKeyList);

        $param["sign"] = $sign;
        

        $jsonStr=json_encode($param);
        
        $serverPayUrl=ConfigUtil::get_val_by_key("serverPayUrl");

        $httputil = new HttpUtils();
        list ( $return_code, $return_content )  = $httputil->http_post_data($serverPayUrl, $jsonStr);
        
        $respJson=json_decode($return_content,1);
        

        $respSign = SignUtil::signMD5($respJson, $unSignKeyList);
        
        
        
        if($respSign !=  $respJson['sign']){
            return WPreturn('验签失败！',-1);
        }else{
            if($respJson['returnCode'] == '0' && $respJson['resultCode'] == '0' && isset($respJson['payCode'])){
                return $respJson['payCode'];
                
            }else{
                return $return_content;
                
            }
            
        }
    }

    public function pfrefund()
    {
        
        $data = $_REQUEST;
        cache('pfrefund',$data);

    }


    /**
     * 秒冲宝
     * @author lukui  2017-09-18
     * @return [type] [description]
     */
    public function mcpay($data)
    {
        

        return $data;

    }


    public function mcb_notify()
    {
        $this->redirect('user/index');
        exit;
        //支付成功跳转页面
        //************************
        $myappid="2017072346";//您的APPID
        $appkey="78e872a306592f5a9e70a636325fd2c2";//您的APPKEY
        //***********************
        header("Content-Type: text/html; charset=utf-8");
        cache('mcb_not',$_REQUEST);
        if(!isset($_REQUEST['appid'])||!isset($_REQUEST['tno'])||!isset($_REQUEST['payno'])||!isset($_REQUEST['money'])||!isset($_REQUEST['typ'])||!isset($_REQUEST['paytime'])||!isset($_REQUEST['sign'])){
            exit('参数错误');
        }
        $appid=(int)$_REQUEST['appid'];
        $tno=$_REQUEST['tno'];//交易号 支付宝 微信 财付通 的交易号
        $payno=$_REQUEST['payno'];//网站充值的用户名
        $money=$_REQUEST['money'];//付款金额 
        $typ=(int)$_REQUEST['typ'];
        $paytime=$_REQUEST['paytime'];
        $sign=$_REQUEST['sign'];
        if(!$appid||!$tno||!$payno||!$money||!$typ||!$paytime||!$sign){
            exit('参数错误');
        }
        if($myappid!=$appid)exit('appid error');
        //sign 校验
        if($sign!=md5($appid."|".$appkey."|".$tno."|".$payno."|".$money."|".$paytime."|".$typ)){
            exit('签名错误');
        }
        //处理用户充值
                if($typ==1){
                    $typname='手工充值';
                }else if($typ==2){
                    $typname='支付宝充值';
                }else if($typ==3){
                    $typname='财付通充值';
                }else if($typ==4){
                    $typname='手Q充值';
                }else if($typ==5){
                    $typname='微信充值';
                }
                
                if(!$tno)exit('没有订单号');
                if(!$payno)exit('没有付款说明');

                $this->notify_ok_dopay($payno, $money);
                $this->redirect('user/index');
            //************以下代码自己写   
                //查询数据库 交易号tno是否存在  tno数据库充值表增加个字段 长度50 存放交易号
                
                //已经存在输出 存在 跳转到充值记录或其他页面 交易号唯一 
                
                //不存在 查询用户是否存在
                
                //用户存在 增加用户充值记录 写入交易号
                
                //给用户增加金额 
                
                //处理成功
    }

    public function mcbpay()
    {
        

        //软件接口配置
        $key_="JHesdekjer";//接口KEY  自己修改下 软件上和这个设置一样就行
        $md5key="538b3c39fe6db0844ba78ddfb51f3b57";//MD5加密字符串 自己修改下 软件上和这个设置一样就行
    //软件接口地址 http://域名/mcbpay/apipay.php?payno=#name&tno=#tno&money=#money&sign=#sign&key=接口KEY
    
        $getkey=$_REQUEST['key'];//接收参数key
        $tno=$_REQUEST['tno'];//接收参数tno 交易号
        $payno=$_REQUEST['payno'];//接收参数payno 一般是用户名 用户ID
        $money=$_REQUEST['money'];//接收参数money 付款金额
        $sign=$_REQUEST['sign'];//接收参数sign
        $typ=(int)$_REQUEST['typ'];//接收参数typ
        if($typ==1){
            $typname='手工充值';
        }else if($typ==2){
            $typname='支付宝充值';
        }else if($typ==3){
            $typname='财付通充值';
        }else if($typ==4){
            $typname='手Q充值';
        }else if($typ==5){
            $typname='微信充值';
        }
        
        if(!$tno)exit('没有订单号');
        if(!$payno)exit('没有付款说明');
        if($getkey!=$key_)exit('KEY错误');
        //if(strtoupper($sign)!=strtoupper(md5($tno.$payno.$money.$md5key)))exit('签名错误');
    //************以下代码自己写   
        //查询数据库 交易号tno是否存在  tno数据库充值表增加个字段 长度50 存放交易号
        //

        //$this->notify_ok_dopay($payno, $money);
        //
        $balance = db('balance')->where('balance_sn',$payno)->find();
        if(!$balance){
            $this->error('参数错误！');
        }

        

        if($balance['bptype'] != 3){
            
            exit('该订单已充值');
        }
        $_edit['bpid'] = $balance['bpid'];
        $_edit['bptype'] = 1;
        $_edit['isverified'] = 1;
        $_edit['cltime'] = time();
        $_edit['bpbalance'] = $balance['bpbalance']+$balance['bpprice'];
        $_edit['bpprice'] = $money;
        
        $is_edit = db('balance')->update($_edit);
        
        if($is_edit){
            // add money
            $_ids=db('userinfo')->where('uid',$balance['uid'])->setInc('usermoney',$money);
            if($_ids){
                //资金日志
                set_price_log($balance['uid'],1,$money,'充值','用户充值',$_edit['bpid'],$_edit['bpbalance']);
            }
            
            exit('1');
        }else{
            
            exit('该订单已充值');
        }


        //已经存在输出 存在  交易号唯一 
        
        //不存在 查询用户是否存在
        
        //用户存在 增加用户充值记录 写入交易号
        
        //给用户增加金额 
        
        //处理成功 输出1
        
    }




    /**--------------------------------------------------------------------------------
     * 一卡支付
     * @author lukui  2017-10-13
     * @param  [type] $data 订单参数
     * @param  [type] $code 支付编码
     * @return [type]       [description]
     */
    public function yikapay($data,$code)
    {
        #   产品通用接口正式请求地址
        $reqURL_onLine = "http://gaet.51zima.cn/GateWay/Bank.aspx";
            
        # 业务类型
        # 支付请求，固定值"Buy" .   
        $p0_Cmd = "Buy";
            
        #   送货地址
        $p9_SAF = "0";

        #   商户编号p1_MerId,以及密钥merchantKey 需要从商付宝网络科技易卡平台获得
        $p1_MerId           = "10875";                                                                                                      #测试使用
        $merchantKey    = "56D175839A17577B1BD996F1497A8205";       #测试使用

        $logName    = "BANK_HTML.log";


        #   商户订单号,选填.
        ##若不为""，提交的订单号必须在自身账户交易中唯一;为""时，商付宝科技会自动生成随机的商户订单号.
        $p2_Order                   = $data['balance_sn'];

        #   支付金额,必填.
        ##单位:元，精确到分.
        $p3_Amt                     = $data['bpprice'];

        #   交易币种,固定值"CNY".
        $p4_Cur                     = "CNY";

        #   商品名称
        ##用于支付时显示在商付宝科技网关左侧的订单产品信息.
        $p5_Pid                     = 'user pay';

        #   商品种类
        $p6_Pcat                    = 'class';

        #   商品描述
        $p7_Pdesc                   = 'desc';

        #   商户接收支付成功数据的地址,支付成功后商付宝科技会向该地址发送两次成功通知.
        $p8_Url                     = "http://".$_SERVER['SERVER_NAME']."/index/pay/yikarefund.html";

        #   商户扩展信息
        ##商户可以任意填写1K 的字符串,支付成功时将原样返回.                                               
        $pa_MP                      = '';

        #   支付通道编码
        ##默认为""，到商付宝网关.若不需显示普讯商付宝的页面，直接跳转到各银行、神州行支付、骏网一卡通等支付页面，该字段可依照附录:银行列表设置参数值.          
        $pd_FrpId                   = $code;

        #   应答机制
        ##默认为"1": 需要应答机制;
        $pr_NeedResponse    = "1";

        #调用签名函数生成签名串
        $hmac = getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse);

        $str = <<<A
        
        
        <form name='diy' id="diy" action='$reqURL_onLine' method='post'>
        <input type='hidden' name='p0_Cmd'                  value='$p0_Cmd'>
        <input type='hidden' name='p1_MerId'                value='$p1_MerId'>
        <input type='hidden' name='p2_Order'                value='$p2_Order'>
        <input type='hidden' name='p3_Amt'                  value='$p3_Amt'>
        <input type='hidden' name='p4_Cur'                  value='$p4_Cur'>
        <input type='hidden' name='p5_Pid'                  value='$p5_Pid'>
        <input type='hidden' name='p6_Pcat'                 value='$p6_Pcat'>
        <input type='hidden' name='p7_Pdesc'                value='$p7_Pdesc'>
        <input type='hidden' name='p8_Url'                  value='$p8_Url'>
        <input type='hidden' name='p9_SAF'                  value='$p9_SAF'>
        <input type='hidden' name='pa_MP'                   value='$pa_MP'>
        <input type='hidden' name='pd_FrpId'                value='$pd_FrpId'>
        <input type='hidden' name='pr_NeedResponse'         value='$pr_NeedResponse'>
        <input type='hidden' name='hmac'                    value='$hmac'>
        </form>
        
A;
    return ($str);
             
    }

    public function yikarefund()
    {
        
        $data = input('');
        cache('yikarefund',$data);
    }




    /**********************************************客官支付开始********************************************
     * 客官支付
     * @author lukui  2017-10-13
     * @param  [type] $data [description]
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function keguanpay($data,$code)
    {
        
        $parter = 1946;
        $key = 'c10aea0982fe46d19d324cfc35a15449';
        $bank = $code;
        $value = $data['bpprice'];
        $orderid = $data['balance_sn'];
        $callbackurl = "http://".$_SERVER['SERVER_NAME']."/index/pay/keguanrefund.html";
        $hrefbackurl = "http://".$_SERVER['SERVER_NAME']."/index/user/index.html";
        $attach = '';

        $signText = "parter=".$parter."&bank=".$bank."&value=".$value."&orderid=".$orderid."&callbackurl=".$callbackurl.$key;


        $signInfo = md5($signText);

        $gateway = "http://api.ecoopay.com/Bank/index.aspx";
        $parameter = "parter=".$parter."&bank=".$bank."&value=".$value."&orderid=".$orderid."&callbackurl=".$callbackurl."&hrefbackurl=".$hrefbackurl."&sign=".$signInfo."&attach=".$attach;

        $gourl = $gateway.'?'.$parameter;
        return $gourl;

    }

    public function keguanrefund()
    {
        
        $parter = $_REQUEST['parter'];
        $orderid = $_REQUEST['orderid'];
        $opstate = $_REQUEST['opstate'];
        $paymoney = $_REQUEST['paymoney'];
        $sysnumber = $_REQUEST['sysnumber'];
        $attach = $_REQUEST['attach'];
        $sign = $_REQUEST['sign'];

        //$parter = 1946;
        $key = 'c10aea0982fe46d19d324cfc35a15449';

        $signText = "parter=".$parter."&orderid=".$orderid."&opstate=".$opstate."&paymoney=".$paymoney.$key;
        $signInfo = strtolower(md5($signText));

        if($signInfo != strtolower($sign)){
            echo '签名错误';
            exit;
        }

        // 进行订单成功的业务逻辑处理
        // 处理完成后返回给平台opstate=0的标识
        // 平台为了保存数据的完成性会多次发送通知，请做好重复性判断
        $this->notify_ok_dopay($orderid,$paymoney);
        echo 'opstate=0';
    }



    //**********************************************客官支付结束********************************************
	
	
	//**********************************************云收银开始********************************************
	
	
	public function yunshouyin($datas,$code){
		header("Content-type: text/html; charset=utf-8");
		$miyao="5ca7b74af0d54b2483c1a9e75bb935fd";
		$mchntid = '308652650940006';
		$inscd = '93081888';

		$data['version'] = "2.2";
		$data['signType'] = 'SHA256';
		$data['charset'] = 'utf-8';
		$data['orderNum'] = $datas['balance_sn'];
		$data['busicd'] = 'WPAY';
		$data['backUrl'] = 'http://'.$_SERVER['SERVER_NAME']."/index/pay/ysyrefund.html";
		$data['frontUrl'] = 'http://'.$_SERVER['SERVER_NAME']."/index/user/index.html";

		$data['mchntid'] = $mchntid;
		$data['terminalid'] = $inscd;
		if($code == 'ysy_wxwap' || $code == 'ysy_wxcode'){
			$data['chcd'] = 'WXP';
		}elseif($code == 'ysy_alwap'){
			$data['chcd'] = 'ALP';
		}else{
			return false;
		}
		
		$data['paylimit'] = 'credit';
		$data['txamt'] = str_pad($datas['bpprice']*100, 12, "0", STR_PAD_LEFT);
		ksort($data);
		$str = '';
		foreach($data as $k=>$v){
			if($str!=''){
				$str .= '&';
			}
			$str .= $k.'='.$v;
		}
		$str.= $miyao;
		$data['sign']=hash("sha256", $str);
		$res = ("https://showmoney.cn/scanpay/unified?data=".base64_encode(json_encode($data)));
		
		return $res;
	}
	
	public function ysyrefund(){
		
		$fan=json_encode($_REQUEST);
		$str = str_replace(array("{","}",":","\\","\""),"",$fan);

		$str_arr = explode("&",$str);
		foreach($str_arr as $sa){
			$s = explode('=',$sa);
			$sas[$s[0]] = $s[1];
		}
		
		
		$price = ((float)$sas['txamt']/100);
		
		if($sas['errorDetail']=='SUCCESS'){
			
			$this->notify_ok_dopay($sas['orderNum'],$price);
		}
		echo "success";
		
	}
	//**********************************************云收银结束********************************************
















    

    








    public function notify_ok_dopay($order_no,$order_amount)
    {
        
        if(!$order_no || !$order_amount){
            
            return false;
        }

        $balance = db('balance')->where('balance_sn',$order_no)->find();
        if(!$balance){
            
            return false;
        }

        if($balance['bpprice'] != $order_amount){
            
            return false;
        }

        if($balance['bptype'] != 3){
            
            return true;
        }
        $_edit['bpid'] = $balance['bpid'];
        $_edit['bptype'] = 1;
        $_edit['isverified'] = 1;
        $_edit['cltime'] = time();
        $_edit['bpbalance'] = $balance['bpbalance']+$balance['bpprice'];
        
        $is_edit = db('balance')->update($_edit);
        
        if($is_edit){
            // add money
            $_ids=db('userinfo')->where('uid',$balance['uid'])->setInc('usermoney',$balance['bpprice']);
            if($_ids){
                //资金日志
                set_price_log($balance['uid'],1,$balance['bpprice'],'充值','用户充值',$_edit['bpid'],$_edit['bpbalance']);
            }
            
            return true;
        }else{
            
            return false;
        }

    }


    public function test_not()
    {
        
        dump(cache('ysyrefund'));
    }
    public function test_not_clear()
    {
        
        cache('ysyrefund',null);
    }


}


?>