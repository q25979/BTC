<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"D:\phpStudy\WWW\btc\mobile/application/index\view\index\index.html";i:1528683456;s:59:"D:\phpStudy\WWW\btc\mobile/application/index\view\head.html";i:1528947722;}*/ ?>
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

<body ng-app="starter" ng-controller="AppCtrl" class="grade-a platform-browser platform-win32 platform-ready">


<ion-nav-bar class="bar-stable headerbar nav-bar-container" nav-bar-transition="ios" nav-bar-direction="none" nav-swipe="">
<div class="nav-bar-block" nav-bar="cached"><ion-header-bar class="bar-stable headerbar bar bar-header" align-title="center"><div class="title title-center hangqing header-item" style="transition-duration: 0ms; transform: translate3d(-176.414px, 0px, 0px); opacity: 0;"></div><div class="buttons buttons-right" style="transition-duration: 0ms; opacity: 0;"></div></ion-header-bar></div><div class="nav-bar-block" nav-bar="active"><ion-header-bar class="bar-stable headerbar bar bar-header" align-title="center"><div class="buttons buttons-left" style="transition-duration: 0ms;"></div><div class="title hangqing title-center header-item" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);"></div></ion-header-bar></div></ion-nav-bar>
<ion-nav-view class="view-container" nav-view-transition="ios" nav-view-direction="enter" nav-swipe=""><ion-tabs class="tabs-icon-top navbar pane tabs-bottom tabs-standard" abstract="true" nav-view="active" style="opacity: 1; transform: translate3d(0%, 0px, 0px);"><div class="tab-nav tabs">

  <ion-tab href="#/tab/qoute" class="iconfont icon--6 tabnone"></ion-tab>

  <ion-tab href="#/tab/history/0" class="iconfont icon--7 tabnone"></ion-tab>

  <ion-tab href="#/tab/profile" class="iconfont icon--8 tabnone"></ion-tab>

<a href="<?php echo Url('/index/index/index/token/'.$token); ?>"  class="iconfont icon--6 tabnone tab-item tab-item-active" style=""><span class="tab-title ng-binding hangqing" ></span></a>
<a href="<?php echo url('/index/order/hold/token/'.$token); ?>" class="iconfont icon--7 tabnone tab-item" style=""><span class="tab-title ng-binding jiaoyijilu" ></span></a>
<a href="<?php echo url('/index/user/index/token/'.$token); ?>"  class="iconfont icon--8 tabnone tab-item" style=""><span class="tab-title ng-binding" >个人账户</span></a>

</div>
<ion-nav-view name="tab-qoute" class="view-container tab-content" nav-view="active" nav-view-transition="ios" nav-view-direction="none" nav-swipe="">
    <ion-view view-title="" hide-nav-bar="false" class="pane" state="tab.qoute" nav-view="active" style="opacity: 1; transform: translate3d(0%, 0px, 0px);">
    <ion-content style="top: 0px;" class="content-background scroll-content ionic-scroll scroll-content-false  has-header has-tabs" scroll="false">

        <div class="slide-qoute slider" delegate-handle="slide-qoute" on-slide-changed="slide_change($index)" show-pager="false" style="visibility: visible;"><div class="slider-slides" ng-transclude="" style="width: 100%;">
            <!-- ngRepeat: c in category_list --><ion-slide ng-repeat="c in category_list" class="slider-slide" data-index="0" style="width: 100%; left: 0px; transition-duration: 300ms; transform: translate(0px, 0px) translateZ(0px);">
                <div class="qoute-view">
                    <div class="qoute-view-header">
                        <ul>
                            <li class="shangpinmingcheng"></li>
                            <li class="xianjia"></li>
                            <li class="zuidi"></li>
                            <li class="zuigao"></li>
                        </ul>
                    </div>
                    <div class="qoute-view-content">
                        <ion-scroll class="scroll-view ionic-scroll scroll-y"><div class="scroll" style="transform: translate3d(0px, 0px, 0px) scale(1);">
                            
						<!-- <?php if(is_array($pro) || $pro instanceof \think\Collection || $pro instanceof \think\Paginator): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?> -->
                            <ul onclick="parent.location='<?php echo url('goods/goods',array('pid'=>$vo['pid'],'token'=>$token)); ?>';"  id="pid<?php echo $vo['pid']; ?>">
                                <li>
                                    <a href="javascript:;" class="ng-binding prtitle"></a>
                                </li>
                                <li>
                                    <a  href="javascript:;" class="ng-binding rise-value now-value">
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="ng-binding rise rise-low">
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="ng-binding rise rise-high">
                                        
                                    </a>
                                </li>
                            </ul>
						<!-- <?php endforeach; endif; else: echo "" ;endif; ?> -->

                        </div>
                        
						<div class="order-p" id="J_order" style="display:none;">
							<div class="order-item">
								<i class="iconfont icon--5 rujin" style="color:#ecb540"></i> <span class="order-phone" style="color:#999"></span> &nbsp;<span class="order-rs" style="color:red"></span>
							</div>
						</div>
						
						<script>
						var order_list;
						var order_index = 0;
						var max_rand = 50;
						function order_show(){
							if(order_list != null && $("#J_order").is(":hidden")){
								if(order_index>=max_rand){
									order_index = 0;
								}
								$("#J_order").find(".order-phone").html(order_list[order_index]['phone']);
								$("#J_order").find(".order-rs").html('赢利+'+order_list[order_index]['price']*5+' ');
								$("#J_order").show();
								window.setTimeout(function(){
									$("#J_order").hide();
								},1500);
								order_index++;
							}
						}
						function order_start(){
							var rand = Math.ceil(Math.random()*100);
							if(rand>=80){
								if(order_list!=null){
									order_show();
								}
							}
						}
						$(document).ready(function(){
							$.ajax({
								type: "GET",
								contentType: "application/json;charset=utf-8",
								url: "/index/index/ajax_order",
								data: null,
								dataType: "json",
								complete: function () { },
								success: function (result) {
									order_list = result;
								},
								error: function (result, status) { }
							});
							/*
							$.get("/index/index/ajax_order",null,function(data){
								order_list = data;
							});
							*/
							window.setInterval(order_start,1000);
						});
						</script>

                        </ion-scroll>
                    </div>
                </div>
            </ion-slide>

        </div>
        </div>
    </ion-content>
</ion-view></ion-nav-view></ion-tabs></ion-nav-view>

<script>

var charturl = '<?php echo url("getchart"); ?>';
$.get(charturl,function(_res){


    var res = jQuery.parseJSON(Base64.decode(_res)); 

    $.each(res,function(k,v){
        $('.'+k).html(v);
    })
})
</script>
</body></html>

<script src="__HOME__/js/lk/index.js">ajaxpro()</script>