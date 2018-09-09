<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"C:\phpStudy\WWW/application/index\view\login\respass.html";i:1528682834;s:48:"C:\phpStudy\WWW/application/index\view\head.html";i:1528947722;}*/ ?>
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
<script src="__HOME__/js/lk/user.js"></script>

<body ng-app="starter" ng-controller="AppCtrl" class="grade-a platform-browser platform-win32 platform-ready">
<ion-nav-bar class="bar-stable headerbar nav-bar-container hide" nav-bar-transition="ios" nav-bar-direction="none" nav-swipe="">
<div class="nav-bar-block" nav-bar="cached"><ion-header-bar class="bar-stable headerbar bar bar-header" align-title="center"><div class="title title-center header-item"></div></ion-header-bar></div><div class="nav-bar-block" nav-bar="active"><ion-header-bar class="bar-stable headerbar bar bar-header" align-title="center"><div class="title title-center header-item"></div></ion-header-bar></div></ion-nav-bar>
<ion-nav-view class="view-container" nav-view-transition="ios" nav-view-direction="none" nav-swipe=""><ion-view hide-nav-bar="true" class="signin-view pane" state="signin" nav-view="active" style="opacity: 1; transform: translate3d(0%, 0px, 0px);">

<form method="post" id="formid">
  <div class="sign_up">
      <div class="sign_up_content">
      	
          <ul class="sign_up_list">
              <!-- <li class="newinput" ng-show="show_signup_code">
                  <span class="input-text">
                      手机号码:
                  </span>
                  <input type="text" placeholder="手机号码" name="username" class="username ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" style="">
              </li>
              <li class="newinput input_iphone_code">
                  <span class="input-text">
                      验证码:
                  </span>
                  <input type="text" placeholder="短信验证码" name="phonecode" class="phonecode ng-pristine ng-valid ng-empty ng-touched" style="">
                  <span class="code_btn ng-binding"  onclick ="return get_svg();">
                      获取验证码
                  </span>
              </li> -->
              <li class="newinput">
                  <span class="input-text">
                      新密码:
                  </span>
                  <input type="password" placeholder="密码" name="upwd" required="" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" style="">
              </li>
              <li class="newinput">
                  <span class="input-text">
                      确认密码:
                  </span>
                  <input type="password" placeholder="确认密码" name="upwd2" required="" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" style="">
              </li>

          </ul>
          <button class="newbutton sign_up_btn" onclick="return checkform(this.form);" >
              重置密码
          </button>
      </div>
       </form>
       <div class="signin-footer" ng-show="if_signup">
        <a href="javascript:history.go(-1);">——&nbsp;&nbsp;返回&nbsp;&nbsp;——</a>
    </div>

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
	// var username = form.username.value;
	var upwd = form.upwd.value;
	var upwd2 = form.upwd2.value;
	// if(!username){
	// 	layer.msg('请输入手机号');
	// 	return false; 
	// }

	if (!upwd) {
		layer.msg('请输入登录密码'); 
		return false;
	}

	if (!upwd2) {
		layer.msg('请再次输入登录密码'); 
		return false;
	}

	if(upwd.length < 6 || upwd2.length < 6){
		layer.msg('密码长度大于6位'); 
		return false;
	}

	if(upwd != upwd2){
		layer.msg('两次输入密码不同'); 
		return false;
	}

	


	  var data = $('#formid').serialize();
    var formurl = "<?php echo Url('index/index/respass'); ?>";
    var locurl = "<?php echo Url('index/user/index'); ?>";

    WPpost(formurl,data,locurl);
    return false;
}
</script>