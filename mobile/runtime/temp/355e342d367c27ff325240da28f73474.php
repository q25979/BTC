<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"C:\phpStudy\WWW/application/index\view\login\login.html";i:1528685315;s:48:"C:\phpStudy\WWW/application/index\view\head.html";i:1528947722;}*/ ?>
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
<ion-nav-bar class="bar-stable headerbar nav-bar-container hide" nav-bar-transition="ios" nav-bar-direction="none" nav-swipe="">
<div class="nav-bar-block" nav-bar="cached"><ion-header-bar class="bar-stable headerbar bar bar-header" align-title="center"><div class="title title-center header-item"></div></ion-header-bar></div><div class="nav-bar-block" nav-bar="active"><ion-header-bar class="bar-stable headerbar bar bar-header" align-title="center"><div class="title title-center header-item"></div></ion-header-bar></div></ion-nav-bar>
<ion-nav-view class="view-container" nav-view-transition="ios" nav-view-direction="none" nav-swipe=""><ion-view hide-nav-bar="true" class="signin-view pane" state="signin" nav-view="active" style="opacity: 1; transform: translate3d(0%, 0px, 0px);">
<div class="signin">
    <div class="signin-header">
        <div class="system-logo" ng-show="show_system_logo">
            
             <img  alt="" src="<?php echo $conf['web_logo']; ?>"> 
        </div>
        <div class="system-name ng-binding ng-hide" ng-show="show_system_name" style="">
            
        </div>
    </div>
 <form method="post" id="formid">
    <div class="signin-content">
   
        <div class="list">
            <label class="item item-input">
                <i class="input-icon ion-android-person"></i>
                <input type="text" placeholder="用户名" name="username" required="" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" style="">
            </label>
            <label class="item item-input">
                <i class="input-icon ion-locked"></i>
                <input type="password" placeholder="密码" name="upwd" required="" ng-keydown="go_signin()" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" style="">
            </label>
        </div>
        <p>
        	<span style="display: none;">忘记密码？</span>
    		<span class="ion-android-warning ng-hide" ng-show="show_sign_in_mistake" style="">&nbsp;账号或者密码错误，请重新输入!</span>
    	</p>
        <div class="signin-action">
            <button class="newbutton sign_button" onclick="return checkform(this.form);">
                登&nbsp;&nbsp;录
            </button>
        </div>

    </div>
   </form>
   <!-- 671 -->
    <!-- <div class="signin-footer" ng-show="if_signup">
        <a href="<?php echo url('login/register'); ?>">——&nbsp;&nbsp;立即开户&nbsp;&nbsp;——</a>
    </div>
    <div class="signin-footer" ng-show="if_signup">
        <a href="<?php echo url('login/respass'); ?>">——&nbsp;&nbsp;忘记密码&nbsp;&nbsp;——</a>
    </div> -->
</div>
<div class="spinner-view hide">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
    <div class="message ng-binding" ng-class="{ 'fadein' : message }"></div>
</div>
</ion-view></ion-nav-view>


<div class="backdrop"></div><div class="ionic_toast"><div class="toast_section" ng-class="ionicToast.toastClass" ng-style="ionicToast.toastStyle" ng-click="hideToast()" style="display: none; opacity: 0;"><span class="ionic_toast_close"><i class="ion-android-close toast_close_icon"></i></span><span ng-bind-html="ionicToast.toastMessage" class="ng-binding"></span></div></div></body></html>
<script>
function checkform(form){
	var username = form.username.value;
	var upwd = form.upwd.value;
	if(!username){
		layer.msg('请输入用户名');
		return false; 
	}

	if (!upwd) {
		layer.msg('请输入密码'); 
		return false;
	}

	var data = $('#formid').serialize();
    var formurl = "<?php echo Url('login/login'); ?>";
    var locurl = "<?php echo Url('/index/index/index/token/'.$token); ?>";

    WPpost(formurl,data,locurl);
    return false;
}
</script>