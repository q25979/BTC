<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"C:\phpStudy\WWW/application/index\view\user\index.html";i:1528947759;s:48:"C:\phpStudy\WWW/application/index\view\head.html";i:1528947722;}*/ ?>
<html style="font-size: 120px;">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
<!-- 是否启用全屏模式 -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- 全屏时状态颜色设置 -->
<meta name="apple-mobile-web-status-bar-style" content="white">
<!-- 禁用电话号码自动识别 -->
<meta name="format-detection" content="telephone=no">
<!--禁止读取本地缓存模板-->
<meta http-equiv="Pragma" contect="no-cache">
<!-- iPhone 启动图标 -->
<link rel="apple-touch-icon" href="img/logo.png">
<!-- Android 启动图标 -->
<link rel="shortcut icon" href="img/logo.png">
<!-- 添加 favicon icon -->
<link rel="shortcut icon" type="image/ico" href="img/favicon.ico">
 <title><?php echo !empty($conf['web_name'])?$conf['web_name']:'众赢'; ?></title> 
<script type="text/javascript">
window.onload=function(){
//设置适配rem
var change_rem = ((window.screen.width > 450) ? 450 : window.screen.width)/375*100;
document.getElementsByTagName("html")[0].style.fontSize=change_rem+"px";
window.onresize = function(){
change_rem = ((window.screen.width > 450) ? 450 : window.screen.width)/375*100;
document.getElementsByTagName("html")[0].style.fontSize=change_rem+"px";
}
}
</script>

<link href="__HOME__/css/ionic.css" rel="stylesheet">
<link href="__HOME__/css/style.css" rel="stylesheet">
<!-- <script src="__HOME__/js/jquery-3.2.1.min.js"></script> -->
<script src="__HOME__/js/jquery-1.9.1.min.js"></script>
<style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
<style>
.ionic_toast {
  z-index: 9999;
}

.toast_section {
  color: #FFF;
  cursor: default;
  font-size: 1em;
  display: none;
  border-radius: 5px;
  opacity: 1;
  padding: 10px 30px 10px 10px;
  margin: 10px;
  position: fixed;
  left: 0;
  right: 0;
  text-align: center;
  z-index: 9999;
  background-color: rgba(0, 0, 0, 0.75);
}

.ionic_toast_top {
  top: 10px;
}

.ionic_toast_middle {
  top: 40%;
}

.ionic_toast_bottom {
  bottom: 10px;
}

.ionic_toast_close {
  border-radius: 2px;
  color: #CCCCCC;
  cursor: pointer;
  display: none;
  position: absolute;
  right: 4px;
  top: 4px;
  width: 20px;
  height: 20px;
}

.toast_close_icon {
  position: relative;
  top: 1px;
}

.ionic_toast_sticky .ionic_toast_close {
  display: block;
}

.ionic_toast_close:active {

}

/**
 * 作者：671
 * 时间：2018年6月14日11:18:18
 * 功能：图标更换
 */
.sg-icon {
  width: 0.3rem;
  height: 0.3rem;
}
.sg-icon.sg-icon-my>img {
  width: 85%;
  height: 85%;
  position: relative;
  left: 0.5rem;
}
.sg-icon.sg-icon-deal {
  height: 0.2rem;
  width: 0.2rem;
}
.sg-icon.sg-icon-deal.sg-icon-look>img {
  left: 0.65rem;
}
.sg-icon.sg-icon-deal>img {
  width: 100%;
  height: 100%;
  position: relative;
  left: 0.46rem;
}

</style>


<script src="__HOME__/js/lk/order.js"></script>

<!-- <script type="text/javascript" src="__HOME__/js/lk/echarts-all-3.js"></script>
<script type="text/javascript" src="__HOME__/js/lk/ecStat.min.js"></script>
<script type="text/javascript" src="__HOME__/js/lk/dataTool.min.js"></script>
<script type="text/javascript" src="__HOME__/js/lk/china.js"></script>
<script type="text/javascript" src="__HOME__/js/lk/world.js"></script>
<script type="text/javascript" src="__HOME__/js/lk/api"></script>
<script type="text/javascript" src="__HOME__/js/lk/getscript"></script>
<script type="text/javascript" src="__HOME__/js/lk/bmap.min.js"></script> -->
<!-- 弹框插件 -->
<script src="/static/layer/layer.js"></script>
<!-- 公共函数 -->
<script src="/static/public/js/function.js"></script>
<script src="/static/public/js/base64.js"></script>
<script type="text/javascript">
  var Base64 = new Base64();

  
</script>
</head>

<script>
var pay_type = '';
var wxpay_info = '';
var returnrul = "<?php echo url('user/index'); ?>";
</script>

<style>
.scroll-content{
    overflow: scroll
}
</style>

<body ng-app="starter" ng-controller="AppCtrl" class="grade-a platform-browser platform-ios platform-ios9 platform-ios9_1 platform-ready">

<ion-nav-bar class="bar-stable headerbar nav-bar-container" nav-bar-transition="ios" nav-bar-direction="swap" nav-swipe="">

	<div class="nav-bar-block" nav-bar="active">
		<ion-header-bar class="bar-stable headerbar bar bar-header" align-title="center">
			<div class="title title-center header-item" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">个人中心</div>
		</ion-header-bar>
	</div>
</ion-nav-bar>


<ion-nav-view class="view-container" nav-view-transition="ios" nav-view-direction="none" nav-swipe=""><ion-tabs class="tabs-icon-top navbar pane tabs-bottom tabs-standard" abstract="true" nav-view="active" style="opacity: 1; transform: translate3d(0%, 0px, 0px);"><div class="tab-nav tabs">


<a href="<?php echo Url('/index/index/index/token/'.$token); ?>"  class="iconfont icon--6 tabnone tab-item " style=""><span class="tab-title ng-binding hangqing" >商品行情</span></a>
<a href="<?php echo url('/index/order/hold/token/'.$token); ?>" class="iconfont icon--7 tabnone tab-item " style=""><span class="tab-title ng-binding jiaoyijilu" >交易记录</span></a>
<a href="<?php echo url('/index/user/index/token/'.$token); ?>"  class="iconfont icon--8 tabnone tab-item tab-item-active" style=""><span class="tab-title ng-binding" >个人账户</span></a>

</div>

<ion-nav-view name="tab-profile" class="view-container tab-content" nav-view="active" nav-view-transition="ios" nav-view-direction="swap" nav-swipe=""><ion-view view-title="个人中心" hide-nav-bar="false" class="pane" state="tab.profile" nav-view="active" style="opacity: 1; transform: translate3d(0%, 0px, 0px);">
    <ion-content class="personalbg scroll-content ionic-scroll scroll-content-false  has-header has-tabs" scroll="false">
		<header>
			<i onclick="app_exit()" class="iconfont icon--9"></i>
			<article>
				<img src="<?php echo !empty($userinfo['portrait'])?$userinfo['portrait']:'__HOME__/img/logobg.jpg'; ?>">
			</article>
			<p class="ng-binding"><?php echo !empty($userinfo['nickname'])?$userinfo['nickname']:$userinfo['username']; if($userinfo['otype'] == 101): ?> (代理商 邀请码：<?php echo $userinfo['uid']; ?>) <?php endif; ?><span class="iconfont icon--3" onclick="respass()"></span></p>
			<p class="ng-binding"><?php echo $userinfo['usermoney']; if($userinfo['otype'] == 101): ?> (保证金：<?php echo !empty($userinfo['minprice'])?$userinfo['minprice']:'0'; ?>) <?php endif; ?></p>
		</header>

        <!-- 671 公告 -->
		<!-- <marquee scrollAmount=5 width=100% style="color:#FFF">公告：众盈云购1.0正式上线，外汇期货酒品虚拟货币各大交易产品，充返活动上线，充3万送1万，5万送2万，出金时间周一到周五10:00-15:00，T+1。客服QQ257132182</marquee> -->

		<ul>
			<!-- <li>
				<section onclick="show_user_modal('modal-bank')" class="">
					<i class="iconfont icon--19 qianyue"></i>
					<p>签约</p>
				</section>
			</li> -->
			<li ng-show="is_get_pay_list" class="" style="">
                <!-- 671 充值 -->
				<!-- <section onclick="show_user_modal('modal-deposit')" class="">
                    <i class="iconfont icon--5 rujin"></i>
                    <p>充值</p>
                </section> -->

                <section onclick="showTips()" class="">
                    <!-- <i class="iconfont icon--5 rujin"></i> -->
                    <div class="sg-icon sg-icon-my">
                        <img src="/static/index/img/g_chong.png">
                    </div>
                    <p>充值</p>
                </section>
			</li>

			<li>
                <!-- 671 提现 -->
				<!-- <section onclick="show_user_modal('modal-withdraw')" class="">
					<i class="iconfont icon--4 chujin"></i>
					<p>提现</p>
				</section> -->
                <section onclick="showTips()" class="">
                    <!-- <i class="iconfont icon--4 chujin"></i> -->
                    <div class="sg-icon sg-icon-my">
                        <img src="/static/index/img/g_ti.png">
                    </div>
                    <p>提现</p>
                </section>
			</li>
			<li>
				<section onclick="show_user_modal('modal-olist')" class="">
					<i class="iconfont icon--- zijin"></i>
					<p>资金流水</p>
				</section>
			</li>
		</ul>
		
			<!-- <div class="erwema_img">
            	<img alt="我的二维码" src="http://pan.baidu.com/share/qrcode?w=165&h=165&url=<?php echo $oid_url; ?>">
        	</div>
        	<p>
        		<span>扫描二维码注册</span>
        		<span style="display: none;">分享<i class="iconfont"></i></span>
        	</p> -->

            <!-- 671 隐藏 -->
            <!-- <div class="user_btn">
                <a href="<?php echo url('cashlist'); ?>">
                    <p class="user_btn_p">
                        <i style="color:#1fc65b;font-size:0.25rem" class="iconfont icon--4 chujin"></i>　提现记录
                        <span class="right">></span>
                    </p>
                </a>
            </div> -->
            
            <!-- 671 隐藏 -->
            <!-- <div class="user_btn">
                <a href="<?php echo url('reglist'); ?>">
                    <p class="user_btn_p">
                        <i style="color:#eb3445;font-size:0.25rem" class="iconfont icon--5 rujin"></i>　充值记录
                        <span class="right">></span>
                    </p>
                </a>
            </div> -->

            <div class="user_btn">
                <a href="<?php echo url('order/hold'); ?>">
                    <p class="user_btn_p">
                        <i style="color:#ebac34;font-size:0.25rem" class="iconfont icon--2 zijin"></i>　历史订单
                        <span class="right">></span>
                    </p>
                </a>
            </div>
 
            <div class="user_btn">
                <a href="javascript:;" onclick="respass()">
                    <p class="user_btn_p">
                        <i style="color:#42FFEE;font-size:0.25rem" class="iconfont icon--3 zijin"></i>　修改信息
                        <span class="right">></span>
                    </p>
                </a>
            </div>
            <div class="user_btn">
                <a href="javascript:;" onclick="app_exit()">
                    <p class="user_btn_p">
                        <i style="color:#6EFF00;font-size:0.25rem" class="iconfont icon--9 zijin"></i>　退出
                        <span class="right">></span>
                    </p>
                </a>
            </div>

		
    </ion-content>
</ion-view></ion-nav-view></ion-tabs></ion-nav-view>



<div class="modal-backdrop hide modal-bank"><div class="modal-wrapper" ng-transclude=""><ion-modal-view class="order-modal bank-info-modal modal slide-in-up ng-leave ng-leave-active">
    <ion-header-bar class="order-modal-header bar bar-header">
        <h1 class="title" style="left: 54px; right: 54px;">银行资料</h1>
        <div class="close" onclick="hide_user_modal('modal-bank')">
            <i class="icon ion-ios-arrow-left"></i>
        </div>
    </ion-header-bar>
    <ul>
    	<li>
    		<span>银行名称</span>
	    	<select name="bankno" class=" bankno">

	    		<?php if(is_array($banks) || $banks instanceof \think\Collection || $banks instanceof \think\Paginator): $i = 0; $__LIST__ = $banks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

	    		<option label="<?php echo $vo['bank_nm']; ?>" value="<?php echo $vo['id']; ?>" <?php if(isset($mybank) && $mybank['bankno'] == $vo['id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['bank_nm']; ?></option>

	    		<?php endforeach; endif; else: echo "" ;endif; ?>

	    	</select>
    	</li>
        <li>
            <span>省份</span>
            <select id="province" class="province" name="province" style="">
				<option value="">请选择</option>
            	<?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

	    		<option  value="<?php echo $vo['id']; ?>" <?php if(isset($mybank) && $mybank['provinceid'] == $vo['id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['name']; ?></option>

	    		<?php endforeach; endif; else: echo "" ;endif; ?>

            </select>
        </li>
        <li>
            <span>市名</span>
            <select id="city" name="cityno" class="city">
            	<?php if(isset($mybank)): ?>
            	<option value="<?php echo $mybank['cityno']; ?>"><?php echo getarea($mybank['cityno']); ?></option>
            	<?php else: ?>
				<option value="">请选择</option>
				<?php endif; ?>
            </select>
        </li>
        <li>
            <span>开户支行</span>
            <input type="text" placeholder="支行地址" name="address" class="address" value="<?php echo isset($mybank)?$mybank['address']:''; ?>">
        </li>
        <li>
            <span>开户名</span>
            <input type="text" placeholder="持卡人姓名" name="accntnm"  class="accntnm" value="<?php echo isset($mybank)?$mybank['accntnm']:''; ?>">
        </li>
        <li>
            <span>卡号</span>
            <input type="text" placeholder="银行卡号" name="accntno" class="accntno" value="<?php echo isset($mybank)?$mybank['accntno']:''; ?>">
        </li>
        <li>
            <span>身份证号</span>
            <input type="text" placeholder="身份证号" name="scard" class=" scard" value="<?php echo isset($mybank)?$mybank['scard']:''; ?>">
        </li>
        <li>
            <span>预留手机号</span>
            <input type="text" placeholder="预留手机号" name="phone"  class="phone" value="<?php echo isset($mybank)?$mybank['phone']:''; ?>">
        </li>

        <?php if(isset($mybank)): ?>
        	<input type="hidden" class="id" name="id" value="<?php echo $mybank['id']; ?>">
        <?php endif; ?>
    </ul>
    <div class="button-bar">
        <a class="button button-balanced" onclick="update_user()">确定</a>
        <a class="button button-dark" onclick="hide_user_modal('modal-bank')">关闭</a>
    </div>

</ion-modal-view></div></div>

<div class="modal-backdrop hide modal-deposit">
<div class="modal-backdrop-bg"></div>
<div class="modal-wrapper" ng-transclude="">
<ion-modal-view class="order-modal modal slide-in-up ng-leave ng-leave-active model-bank-tab">
    <ion-header-bar class="order-modal-header bar bar-header">
        <h1 class="title" style="left: 54px; right: 54px;">用户入金</h1>
        <div class="close" onclick="hide_user_modal('modal-deposit')">
            <i class="icon ion-ios-arrow-left"></i>
        </div>
    </ion-header-bar>
     <div class="pay_code_area" style="display: none">
        <div>
            <div class="pay_code_img">
                
            </div>
            
            <p>扫描二维码支付</p>
            <p><a href="">充值成功点击刷新</a></p>
            <p><a href="javascript:;" onclick="pay_code_area(0)">关闭</a></p>
            
        </div>
    </div>
    <ion-content id="in_money_content" class="scroll-content ionic-scroll  has-header"><div class="scroll" style="transform: translate3d(0px, 0px, 0px) scale(1);">
    	<header>
    		<ul>

    			<?php if(is_array($payment) || $payment instanceof \think\Collection || $payment instanceof \think\Paginator): $i = 0; $__LIST__ = $payment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    			 <li class="pay_channel" >

					<label class="pay_weixin item item-radio item item-radio" name="pay_type" onclick="check_payid('<?php echo $vo['pay_conf_arr']['name']; ?>')"  value="<?php echo $vo['pay_conf_arr']['name']; ?>">
						<input type="radio" name="pay_type" class="ng-pristine ng-untouched ng-valid ng-not-empty" value="<?php echo $vo['pay_conf_arr']['name']; ?>">
						<div class="radio-content">
							<div class="item-content disable-pointer-events" >
							<div class="pay_bank_list_header">
								<div class="kuang"></div>
                                
                                <?php if($vo['pay_conf_arr']['name'] == 'alipay' || $vo['pay_conf_arr']['name'] == 'qtb_alipay' || $vo['pay_conf_arr']['name'] == 'ysy_alwap' || $vo['pay_conf_arr']['name'] == 'AlipayPAZH'|| $vo['pay_conf_arr']['name'] == 'codepay_alipay'): ?>
								<i class="pay_alipay_bg"></i>
								<article>
								<p class="pay_alipay">
                                <span class="iconfont icon-zhifubao">
                                <?php elseif($vo['pay_conf_arr']['name'] == 'wxpay' || $vo['pay_conf_arr']['name'] == 'ysy_wxwap' ||  $vo['pay_conf_arr']['name'] == 'qbt_pay_wxpay' ||  $vo['pay_conf_arr']['name'] == 'ysy_wxcode' ||  $vo['pay_conf_arr']['name'] == 'zypay_wx'||  $vo['pay_conf_arr']['name'] == 'codepay'): ?>
                                <i class="pay_green_bg"></i>
                                <article>
                                <p class="pay_green">
                                <span class="iconfont icon-weixin">
                                <?php else: ?>
                                <i class="pay_yinlian_bg"></i>
                                <article>
                                <p class="pay_yinlian">
                                <span class="iconfont icon--19">
                                <?php endif; ?>


                                    </span><span class="ng-binding"><?php echo $vo['pay_name']; ?></span></p>

									<p  class="ng-hide"><span class="iconfont "></span><span class="ng-binding"></span></p>
                                    
								</article>

							</div>

			        		</div>
                            
			        		<i class="radio-icon disable-pointer-events icon ion-checkmark"></i>
			        	</div>
			        </label>

			        <div  class="pay_bank_list_content ng-hide">
						<ion-scroll style="height: 100%;" scrollbar-y="true" scrollbar-x="false" class="scroll-view ionic-scroll scroll-y">
							<div class="scroll">
								<ul>
								</ul>
							</div>
							<div class="scroll-bar scroll-bar-v">
								<div class="scroll-bar-indicator scroll-bar-fade-out"></div>
							</div>
						</ion-scroll>
					</div>

    			</li> 
                <?php endforeach; endif; else: echo "" ;endif; ?>

    		</ul>
    	</header>
    	<div class="out_money_content">
    		<article>
	        	<span>
	        		<i class="iconfont icon--5"></i>
	        		充值金额：
	        	</span>
	        	<input type="number" placeholder="请输入金额" required="" value="100}" class="ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required bpprice">
	        </article>
            <br>
<!-- value="100.<?php echo rand(0,100); ?>" -->
	        <section class="ng-binding"><!-- 单次充值至少99起，最多20000 --></section>
	        <footer>
	        	<ul class="reg_push">
                <?php $_rand = rand(0,100);if(is_array($reg_push) || $reg_push instanceof \think\Collection || $reg_push instanceof \think\Paginator): $i = 0; $__LIST__ = $reg_push;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li onclick="reg_push(<?php echo $vo; ?>)"><?php echo $vo; ?></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

	        </footer>
	        <button class="newbutton outmoneybtn reg_btn"  onclick="submit_deposit()">确认充值</button>
    	</div>
	</div><div class="scroll-bar scroll-bar-v"><div class="scroll-bar-indicator scroll-bar-fade-out" style="transform: translate3d(0px, 0px, 0px) scaleY(1); height: 0px;"></div></div></ion-content>
</ion-modal-view></div></div><div class="modal-backdrop hide modal-withdraw"><div class="modal-backdrop-bg"></div><div class="modal-wrapper" ng-transclude=""><ion-modal-view class="order-modal modal slide-in-up ng-leave ng-leave-active">
    <ion-header-bar class="order-modal-header bar bar-header">
        <h1 class="title" style="left: 54px; right: 54px;">用户出金</h1>
        <div class="close" onclick="hide_user_modal('modal-withdraw')">
            <i class="icon ion-ios-arrow-left"></i>
        </div>
    </ion-header-bar>
<ion-content class="out_money_content scroll-content ionic-scroll  has-header"><div class="scroll" style="transform: translate3d(0px, 0px, 0px) scale(1);">
    	
		<?php if(!isset($mybank)): ?>
    	<header class="ifnone_add_bank"  onclick="go_add_bank()">
        	<p>+</p>
        	<p>添加银行卡</p>
        </header>
        <div class="scroll" style="transform: translate3d(0px, 0px, 0px) scale(1);">
		<?php else: ?>
        <div  class="cash">
	        <header class="coldbg hotbg"  style="">
	        	<p class="ng-binding"><?php echo $mybank['bank_nm']; ?> </p><span class="editc" onclick="go_add_bank()">修改</span>
	        	<p class="ng-binding">**** **** **** <?php echo $sub_bankno; ?></p>
	        	<i class="iconfont red"><?php echo substr($mybank['bank_nm'],0,3); ?></i>
	        </header>
	
	        <article>
	        	<span>
	        		<i class="iconfont icon--4"></i>
	        		提现金额：
	        	</span>
	        	<input type="number" placeholder="请输入出金金额" ng-model="outAmount.outamount"  class="cash-price ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required">
	        </article>
	        <section  class="ng-binding">单次提现金额至少<span class="cash_min" attrmax="<?php echo $conf['cash_max']; ?>"><?php echo $conf['cash_min']; ?></span></section>
	        <footer>
	        	余额：<span class="ng-binding"><?php echo $userinfo['usermoney']; ?></span>
	        	手续费：<span  class="ng-binding reg_par" attrdata="<?php echo $conf['reg_par']; ?>"><?php echo $conf['reg_par']; ?>%</span>
	        	实际到账：<span  class="ng-binding true_price" style="display:none"></span>
	        </footer>
	        <button class="newbutton outmoneybtn"  onclick="out_withdraw()">确认出金</button>
        </div>
		<?php endif; ?>
    </div>

    </div><div class="scroll-bar scroll-bar-v"><div class="scroll-bar-indicator scroll-bar-fade-out" style="transform: translate3d(0px, 0px, 0px) scaleY(1); height: 0px;"></div></div></ion-content>
</ion-modal-view></div></div><div class="modal-backdrop hide modal-olist"><div class="modal-backdrop-bg"></div><div class="modal-wrapper" ng-transclude=""><ion-modal-view class="order-modal modal slide-in-up ng-leave ng-leave-active">
    <ion-header-bar class="order-modal-header bar bar-header">
        <h1 class="title" style="left: 54px; right: 54px;">资金流水</h1>
        <div class="close" onclick="hide_user_modal('modal-olist')">
            <i class="icon ion-ios-arrow-left"></i>
        </div>
    </ion-header-bar>
    <ion-content class="person_money_list scroll-content ionic-scroll  has-header"><div class="scroll" style="transform: translate3d(0px, 0px, 0px) scale(1);">
		<ion-scroll style="height:100%" class="scroll-view ionic-scroll scroll-y"><div class="scroll" style="transform: translate3d(0px, -10px, 0px) scale(1);">
			
      <ul class="price_list">
                <?php if(is_array($order_list) || $order_list instanceof \think\Collection || $order_list instanceof \think\Paginator): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li ng-repeat="c in moneyList" class="" isshow="0">
                	<div class="money_list_header" >
                		<section class="other_money_bg">

                		</section><section>
                			<p  class="ng-binding other_money"><?php echo $vo['title']; ?></p>
                			<p>
                				<i class="iconfont icon--1 " ></i>
                				<i class="iconfont icon-30 ng-hide" ></i>
                				<span class="ng-binding"><?php echo $vo['nowmoney']; ?></span></p>
                			<p>
                				<i class="iconfont icon--2 pay_blue"></i>
                				<span class="ng-binding"><?php echo date('Y-m-d H:i:s',$vo['time']); ?></span>
                				<!-- <span class="ng-binding">14:13:04</span> -->
                			</p>
                		</section><section  class="ng-binding other_money">
                			<?php echo $vo['account']; ?>
                		</section><section class="icon clickshow ion-ios-arrow-up">
                		</section>
                	</div>
                	<article class="today_list_footer" style="display: none;">
                		<p class="ng-binding">详情：<?php echo $vo['content']; ?></p>
                	</article>
                </li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<!-- ngIf: has_more_money_order.if_has_more_money_order -->
		</div><div class="scroll-bar scroll-bar-v"><div class="scroll-bar-indicator scroll-bar-fade-out" style="height: 631px; transform: translate3d(0px, 10px, 0px) scaleY(1);"></div></div></ion-scroll>
    </div><div class="scroll-bar scroll-bar-v"><div class="scroll-bar-indicator scroll-bar-fade-out" style="transform: translate3d(0px, 0px, 0px) scaleY(1); height: 0px;"></div></div></ion-content>
    <div class="button-bar">
        <a class="button button-dark" onclick="hide_user_modal('modal-olist')">关闭</a>
    </div>
</ion-modal-view></div></div>










<!-- 


<div class="modal-backdrop active"><div class="modal-backdrop-bg"></div><div class="modal-wrapper" ng-transclude=""><ion-modal-view class="order-modal qrcode-modal modal slide-in-up ng-enter active ng-enter-active">
    <ion-header-bar class="order-modal-header bar bar-header">
        <h1 class="title" style="left: 50px; right: 50px;">移动支付</h1>
        <div class="close" ng-click="pay_qrcode_modal.hide()">
            <i class="icon ion-ios-close-empty"></i>
        </div>
    </ion-header-bar>
    <ion-content scroll="false" class="scroll-content ionic-scroll scroll-content-false  has-header">
        <div class="pay_weixin_code">
            <header>
            <p>支付金额：
                <span class="ng-binding">100</span>
            </p>
            </header>
            <section ng-show="distinguishQrcode" class="">长按识别</section>
            <footer ng-show="distinguishQrcode" class="">
                使用其它手机，打开微信或者支付宝，扫一扫也可以支付
            </footer>
            <footer ng-show="!distinguishQrcode" class="ng-hide">
                使用手机截图保存至相册，再微信或者支付宝识别图片可进行支付，也可使用其它手机扫一扫进行支付
            </footer>
            <div ng-show="!distinguishQrcode" class="no-erweima ng-hide"></div>
        </div>
    </ion-content>
    <article>
        <img ng-src="http://weixin.fxgogogo.com/qrcode?text=weixin%3A//wxpay/bizpayurl%3Fpr%3D8tJpkmg" src="http://weixin.fxgogogo.com/qrcode?text=weixin%3A//wxpay/bizpayurl%3Fpr%3D8tJpkmg">
    </article>
</ion-modal-view></div></div>



 -->






</body></html>
<div id="zypay_post"></div>
<script src="__HOME__/js/lk/user.js?s=<?php echo time(); ?>"></script>
<script src="__HOME__/js/lk/jquery.qrcode.js"></script>
<script src="__HOME__/js/lk/utf.js"></script>
<script>
$('#province').change(function(){
    var pid = $(this).val();
    if(pid != ''){
        var url = "<?php echo url('getarea'); ?>"+"?id="+pid;
        $.get(url,function(data){
          $("#city").html(data);
        });
    }else{
        $("#city").html('<option value="">请选择城市</option>');
    }

    
  });
function respass(){
    location.href="<?php echo url('login/respass'); ?>"
}

/**
 * 作者：671
 * 时间：2018年6月11日09:34:16
 * 描述：弹出提示框功能
 */
function showTips() {
    layer.open({
        title: '提示'
        ,content: '请联系币淘客服'
    });
}

</script>