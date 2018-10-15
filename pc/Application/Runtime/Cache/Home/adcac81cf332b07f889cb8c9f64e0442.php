<?php if (!defined('THINK_PATH')) exit();?><!-- 忘记密码 -->
<head>
	<meta charset="UTF-8">
	<title>Blnance幣淘 港臺數位資產交易平臺</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/base.css" />

	<script type="text/javascript" src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://localhost:8081/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/base64.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/config.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/function.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/jquery.bday-picker.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/plug-in/layui/layui.js"></script>


    <!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>


<style>

    /* 外边样式 */
    .forget { background: #FCFDFF; height: 550px; padding-top: 50px; box-sizing: border-box; position: relative; box-shadow: 0 -1px 1px #D6DADD; }
    /* 内部样式 */
    .forget .forget-content { width: 350px; height: 400px; margin: 0 auto; }
    .forget .forget-content .form-group { width: 95%; margin: 0 auto; }
    .forget .forget-content .password { margin-top: 20px; }
    .forget .forget-content .forget-hint { display: block; margin: 15px auto; width: 95%; padding: 8px 12px; border-radius: 2px;font-size: 12px; }
    .forget .forget-content .forget-hint {  /*display: none;*/ }
    /* 提示背景色 */
    .forget .forget-content .bgRed { background: #F9E8E8; color: #C30; }
    .forget .forget-content .bgAsh { background: #EEEEEE; color: #666666; }
    /* 输入框标题 */
    .forget .form-group span { display: inline-block; margin-bottom: 15px; }
    /* 输入框高度 */
    .forget .form-group input { height: 45px; }
    /* 按钮 */
    .forget .resetPass { display: block; background: #5AC; color: #FFF; box-shadow: inset 0 -3px 0 #18A; margin: 0 auto; margin-top: 30px; }
    /* 底部图片 */
    .forget .forget-img { height: 49px; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); }
    /* 当屏幕最大宽度小于 770 底部图片宽度缩短 */
    @media all and (max-width: 770px) {
        .forget .forget-img img { width: 350px; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); }
    }

</style>

<div class="">
    <!-- top start -->
    

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <div id="top">
    	<div id="wrapper">
	        <!-- 侧边栏 -->
	        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
	            <ul class="nav sidebar-nav warpp">
	                <li class="img-login">
	                    <img src="/Public/images/customerService.png" class="get_imglogo">
						<a id="login-href" href="http://localhost:8081/Home/Login/index"><?php echo (L("_LOGIN_LOGIN_")); ?></a>
                        <a id="logout-href" href="http://localhost:8081/Home/Login/logout" style="display: none;"><?php echo (L("_ACCOUNT_LOGOUT_")); ?></a>
                        <li @click='jumpMessage()' id="login-bell" style="display: none;">
                            <span class="glyphicon glyphicon-bell"></span>
                            <span id="xy-top-messageminwidth"></span>
                        </li>
	                </li>
	                <li><a href="http://localhost:8081/Home/index/index" id="minwidth1-act"><?php echo (L("_LOGIN_WALLET_")); ?></a></li>
	                <li><a href="http://localhost:8081/Home/RealtimeMarket/index" id="minwidth2-act"><?php echo (L("_LOGIN_CHART_")); ?></a></li>
	                <li><a href="http://localhost:8081/Home/ContactUs/index" id="minwidth3-act"><?php echo (L("_LOGIN_CONTACT_US_")); ?></a></li>
	                <li><a href="http://localhost:8081/Home/Question/index" id="minwidth4-act"><?php echo (L("_LOGIN_FAQ_")); ?></a></li>
	                <li class="top-language-radio">
	                    <span>语言</span>
	                    <div class="radio-language">
                            <div class="radio_width" @click="getLangType(1)">
                                <input class="radio-pointer" type="radio" name="optionsRadios" id="optionsRadios1" value="繁体中文" checked>
                                <span>繁体中文</span>
                            </div>
                            <div class="radio_width" @click="getLangType(2)">
                                <input class="radio-pointer" type="radio" name="optionsRadios" id="optionsRadios2" value="English">
                                <span>English</span>
                            </div>
	                    </div>
	                </li>
	            </ul>
	        </nav>
	        <!-- 滑动按钮 -->
	        <div id="page-content-wrapper">
	            <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
	                <span class="hamb-top"></span>
	                <span class="hamb-middle"></span>
	                <span class="hamb-bottom"></span>
	            </button>
	        </div>
	    </div>
	
	    <div class="top-red navbar-fixed-top">
	        <div class="header container-fixed">
	            <!--顶部导航栏-->
	            <div class="header-list">
	                <!--导航栏左侧-->
	                <ul class="header-list-left col-xs-6">
	                    <li><a href="http://localhost:8081/Home/Index/index" id="indexAct" class="active"><?php echo (L("_LOGIN_WALLET_")); ?></a></li>
	                    <li><a href="http://localhost:8081/Home/RealtimeMarket/index" id="realtimeAct"><?php echo (L("_LOGIN_CHART_")); ?></a></li>
	                    <li>
	                        <div class="dropdown">
	                            <div class="dropdown-toggle drop-more" id="dropdownMenu" data-toggle="dropdown">
	                                <?php echo (L("_LOGIN_MORE_")); ?>
	                                <span class="caret"></span>
	                            </div>
	                            <ul class="dropdown-menu dropdown-menu-left toplist-a" aria-labelledby="dropdownMenu">
	                                <li><a href="#" @click = "goRelation()"><?php echo (L("_LOGIN_CONTACT_US_")); ?></a></li>
	                                <br>
	                                <li><a href="#" @click = "goCommonProblem()"><?php echo (L("_LOGIN_FAQ_")); ?></a></li>
	                            </ul>
	                        </div>
	                    </li>
	                </ul>
	
	                <!--导航栏右侧-->
	                <ul class="header-list-right col-xs-6">
	                    <li>
	                        <div class="dropdown dropTick2">
	                            <div class="dropdown-toggle drop-more" id="dropdownMenu2" data-toggle="dropdown">
	                                <img src="/Public/images/earth.png">
	                                <span class="caret"></span>
	                            </div>
	                            <ul class="dropdown-menu dropdown-menu-right toplist-b toplist-c font-white" aria-labelledby="dropdownMenu2">
	                                <li @click="getLangType(1)">
	                                    <span class="traChinese">繁体中文</span>
	                                    <span class="glyphicon glyphicon-ok glyphicon-ok-2"></span>
	                                </li>
	                                <li @click="getLangType(2)">
	                                    <span class="english">English</span>
	                                </li>
	                            </ul>
	                        </div>
	                    </li>

						<li>
							<ul class="login-register">
								<li>
									<a href="http://localhost:8081">
										<?php echo (L("_LOGIN_LOGIN_")); ?>
									</a>
								</li>
								<li>
									<a href="http://localhost:8081">
										<?php echo (L("_LOGIN_SIGN_UP_")); ?>
									</a>
								</li>
							</ul>
							<ul class="user-Logout">
								<li>
									<a href="http://localhost:8081/Home/Login/logout">
										<?php echo (L("_ACCOUNT_LOGOUT_")); ?>
									</a>
								</li>
								<li @click='jumpMessage()' style="padding: 0 5px;">
									<span class="glyphicon glyphicon-bell"></span>
									<span id="xy-top-message"></span>
								</li>
								<li style="padding: 0 5px;"></li>

							</ul>
						</li>

						<li>
							<div class="dropdown dropTick1">
								<div class="dropdown-toggle drop-more" id="dropdownMenu1" data-toggle="dropdown">
									{{currencyTypeName}}
									<span class="caret"></span>
								</div>
								<ul class="dropdown-menu dropdown-menu-right toplist-b" aria-labelledby="dropdownMenu1">
									<li @click="getCurrencyType(1)" class="clickTWD">
										<img src="/Public/images/taiwan.png">
										<span class="TWD">TWD</span>
										<span class="glyphicon glyphicon-ok glyphicon-ok-1"></span>
									</li>
									<br>
									<li @click="getCurrencyType(2)" class="clickHKD">
										<img src="/Public/images/HK.png">
										<span class="HKD">HKD</span>

									</li>
									<li @click="getCurrencyType(3)" class="clickUSD">
										<img src="/Public/images/USA.png">
										<span class="USD">USD</span>
									</li>
								</ul>
							</div>
						</li>
						<li>LTC:{{ ETH }}</li>
						<li>BTC:{{ BTC }}&nbsp;&nbsp;</li>
					</ul>
	            </div>
	
	            <!--宽度过低时的导航栏-->
	            <div class="top-low-width">
	                <div class="top-money-country">
	                    <p>BTC:{{ BTC }}</p>
	                    <p>LTC:{{ ETH }}</p>
	                </div>
	                <div class="dropdown dropTick3" id="TWD">
	                    <div class="dropdown-toggle drop-more" id="dropdownMenu3" data-toggle="dropdown">
	                        {{currencyTypeName}}
	                        <span class="caret"></span>
	                    </div>
	                    <ul class="dropdown-menu dropdown-menu-right toplist-b font-white" aria-labelledby="dropdownMenu3">
	                        <li @click="getCurrencyType(1)" class="clickTWD">
	                            <img src="/Public/images/taiwan.png">
	                            <span class="TWD">TWD</span>
	                            <span class="glyphicon glyphicon-ok glyphicon-ok-1"></span>
	                        </li>
	                        <li @click="getCurrencyType(2)" class="clickHKD">
	                            <img src="/Public/images/HK.png">
	                            <span class="HKD">HKD</span>
	                        </li>
	                        <li @click="getCurrencyType(3)" class="clickUSD">
	                            <img src="/Public/images/USA.png">
	                            <span class="USD">USD</span>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	
	        </div>
	    </div>
    </div>


<script type="text/javascript">

	var vm = new Vue({
		el: '#top',
		data: {
			BTC: '',
			ETH: '',
            count: '',
			currencyTypeName : 'TWD',
			currencyType : 2
		},

		/**
		 * init
		 */
		created: function() {
			var index = $.cookie('btc_float_value') ? $.cookie('btc_float_value') : 1;
			var _this = this;

			this.getCurrencyType(index); //设置货币类型
			// 实时获取
			setInterval(function() {
				_this.getFloat(_this.currencyType);

			}, 1000*3); //1分钟刷新一次

			// 设置语言样式
			var btcLang = $.cookie('btc_lang');
			iLangTop =  btcLang == 'en-us' ? 40 : 0;
			$('.glyphicon-ok-2').css({'top': iLangTop + 'px'});

            //手机端语言样式
            mLangTop = btcLang == 'en-us' ? '#optionsRadios2': '#optionsRadios1';
            $(mLangTop).attr('checked', 'checked');


			// 登录登出状态	
			this.isLogin();

		},
		methods: {
			getFloat:function(id){
			    var type = '';
			    var c = '';
				var _this = this;

			    if (id == 1) {
			        type = 'twd'
					c = 'NT$'
			    } else if (id == 2) {
			        type = 'hkd'
					c = 'HK$'
			    } else {
			        type = 'usd'
					c = '$'
			    }
				var u = 'http://localhost:8081/Float/Index/getdata';
				var	d = { type: type };
				$.get(u,d,function(res){
					_this.BTC = c + res.btc
					_this.ETH = c + res.ltc

					// 设置cookie
					$.cookie('btc_btc_value', res.btc);
					$.cookie('btc_eth_value', res.ltc);
				});
			},

			/**
			 * 是登入进去的页面
			 */
			isLogin: function() {
				var u = 'http://localhost:8081/Home/Index/getTopInfo';
				if (sg.isEmpty($.cookie('btc_identification'))) return false;
				$.get(u, function(res) {
					var username = res.data.username;
					if (res.code == 0) {
						$('.user-Logout').css({ 'display': 'inline' });
						$('.login-register').css({ 'display': 'none' });
                        $('#logout-href').css({ 'display': 'inline' });
                        $('#login-bell').css({ 'display': 'inline' });
                        $('#login-href').css({ 'display': 'none' });
                    } else {
						$('.user-Logout').css({ 'display': 'none' });
						$('.login-register').css({ 'display': 'inline' });
                        $('#login-href').css({ 'display': 'inline' });
                        $('#logout-href').css({ 'display': 'none' });
                        $('#login-bell').css({ 'display': 'none' });
					}

					if (username.length > 5)
						username = username.substring(0, 5) + '...';
					$('.user-Logout>li:nth-child(3)').text(username);
					$('#xy-top-message').text(res.data.message);
                    $('#xy-top-messageminwidth').text(res.data.message);
                });
			},

			/**
			 * 设置切换top浮动值
			 */
			switchFloat: function(index) {
				$.cookie('btc_float_value', index, { expires: 7, path: '/' });
			},

			/**
			 * 进入消息页
			 */
			jumpMessage: function() {
				sg.jump('http://localhost:8081/Home/MessageTip/index');
			},
			
			getCurrencyType: function(index){
				var vm = this;

				// 设置cookie
				this.switchFloat(index);
				if (index == 1) {
		            $('.glyphicon-ok-1').css({'top':'0px'});
		            $('.TWD').css({'display':'none'});
		            $('.HKD').css({'display':'inline-block'});
		            $('.USD').css({'display':'inline-block'});
		            vm.currencyTypeName = "TWD";
		            vm.currencyType = 1;
					vm.getFloat(1);
		        }else if (index == 2){
		            $('.glyphicon-ok-1').css({'top':'40px'});
		            $('.TWD').css({'display':'inline-block'});
		            $('.HKD').css({'display':'none'});
		            $('.USD').css({'display':'inline-block'});
		            vm.currencyTypeName = "HKD";
		            vm.currencyType = 2;
		            vm.getFloat(2);
		        }else {
		            $('.glyphicon-ok-1').css({'top':'80px'});
		            $('.TWD').css({'display':'inline-block'});
		            $('.HKD').css({'display':'inline-block'});
		            $('.USD').css({'display':'none'});
		            vm.currencyTypeName = "USD";
		            vm.currencyType = 3;
		            vm.getFloat(3);
		        }
			},

			/**
			 * 设置语言
			 */
			getLangType: function(index){
				var vm = this;
				if (index == 1) {
					vm.changUrl("zh-tw");
		        }else {
		            vm.changUrl("en-us");
		        }
		    },
			goCommonProblem : function(){//跳转到常见问题
				window.location.href="http://localhost:8081/Home/Question/index";
			},
			goRelation : function(){//跳转到联系我们
				window.location.href="http://localhost:8081/Home/ContactUs/index";
			},
			changUrl:function(zt){
				var url = "http://localhost:8081/Home/Lang/change";
				var data = {
					lang : zt
				};
	            
	            $.get(url, data, function(){
	            	sg.reload();
	            });
			}
		}
	});

	$(document).ready(function () {
        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

        trigger.click(function () {
            hamburger_cross();
        });
        
        function hamburger_cross() {
            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
//              $('.top-red').animate({'margin-left':'0px'},200);
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
//              $('.top-red').animate({'margin-left':'250px'},450);
            }
        }
        $('[data-toggle="offcanvas"]').click(function () {
            $('#wrapper').toggleClass('toggled');
        });
    });

    //PC端TWD下拉菜单切换
    $('.dropTick1 ul li').click(function(){
        var that = $('.dropTick1 ul li').index(this);

        if (that == 0) {
            $('.glyphicon-ok-1').css({'top':'0px'});
            $('.TWD').css({'display':'none'});
            $('.HKD').css({'display':'inline-block'});
            $('.USD').css({'display':'inline-block'});
			$('.drop-language').text('TWD');

        }else if (that == 1){
            $('.glyphicon-ok-1').css({'top':'40px'});
            $('.TWD').css({'display':'inline-block'});
            $('.HKD').css({'display':'none'});
            $('.USD').css({'display':'inline-block'});
			$('.drop-language').text('HKD');

        }else {
            $('.glyphicon-ok-1').css({'top':'80px'});
            $('.TWD').css({'display':'inline-block'});
            $('.HKD').css({'display':'inline-block'});
            $('.USD').css({'display':'none'});
			$('.drop-language').text('USD');
        }
    });

    //PC端语言下拉菜单切换
    $('.dropTick2 ul li').click(function(){
        var that = $('.dropTick2 ul li').index(this);

        if (that == 0) {
            $('.glyphicon-ok-2').css({'top':'0px'});
        }else {
            $('.glyphicon-ok-2').css({'top':'40px'});
        }
    });

    //手机端TWD下拉菜单切换
    $('.dropTick3 ul li').click(function(){
        var that = $('.dropTick3 ul li').index(this);

        if (that == 0) {
            $('.glyphicon-ok-1').css({'top':'0px'});
            $('.TWD').css({'display':'none'});
            $('.HKD').css({'display':'inline-block'});
            $('.USD').css({'display':'inline-block'});
            $('.drop-language').text('TWD');

        }else if (that == 1) {
            $('.glyphicon-ok-1').css({'top':'40px'});
            $('.TWD').css({'display':'inline-block'});
            $('.HKD').css({'display':'none'});
            $('.USD').css({'display':'inline-block'});
            $('.drop-language').text('HKD');
        }else {
            $('.glyphicon-ok-1').css({'top':'80px'});
            $('.TWD').css({'display':'inline-block'});
            $('.HKD').css({'display':'inline-block'});
            $('.USD').css({'display':'none'});
            $('.drop-language').text('USD');
        }
    });

    $('#optionsRadios2').click(function(){
        $(this).attr("checked",true);
    });

	getLogo();
	/**
	 * 获取logo
	 */
	function getLogo () {
		var logoUrl = "http://localhost:8081/Home/Login/getupdateLogo";

		$.ajax({
			url: logoUrl,
			type: 'get',
			success: function (res) {
				$('.get_imglogo').attr('src', res.data[0].logo_url);
			}
		});
	}

</script>





    <!-- top end-->
    <!-- nav start-->
    <!--
    <nav>nav</nav>
-->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<block name = "nav">
	
	<!--导航条容器-->
	<div class="menu-container">
		<!--导航条头部隐藏提示-->
		<div class="nav-hd">
			<!-- 输入框为空 -->
			<span class="hint" v-if=" status == 1 ">
				<?php echo (L("_HINT_LOGIN_EMAIL_EMPTY_")); ?>
			</span>

			<!-- 输入框不为空 -->
			<span class="hint" v-if=" status == 2 ">
				<?php echo (L("_HINT_LOGIN_ERROR_")); ?>
			</span>

			<!-- 成功登入 -->
			<span class="hint" v-if=" status == 3 ">
				<?php echo (L("_HINT_LOGIN_SUCCESSFUL_")); ?>
			</span>

			<!-- 登出 -->
			<span class="hint" v-if=" status == 4 ">
				<?php echo (L("_HINT_LOGOUT_")); ?>
			</span>

			<!-- 邮箱地址被人使用 -->
			<span class="hint" v-if=" status == 5 ">
				<?php echo (L("_HINT_EMAIL_IS_EXIST_")); ?>
			</span>

			<!-- 邮箱未知错误 -->
			<span class="hint" v-if=" status == 6 ">
				<?php echo (L("_HINT_EMAIL_ERROR_")); ?>
			</span>

			<!-- 请求超时 -->
			<span class="hint" v-if=" status == 7 ">
				<?php echo (L("_HINT_TIMEOUT_")); ?>
			</span>

			<!-- 忘记密码 -->
			<span class="hint" v-if=" status == 8 ">
				<?php echo (L("_LOGIN_FORGOT_PSW_TIPS_")); ?>
			</span>

			<spane class="hint" v-if= " status == 9 ">
				<?php echo (L("_HINT_WRONG_PWD_")); ?>
			</spane>

			<!-- 邀请码无效 -->
			<span class="hint" v-if=" status == 'Invalid' ">
				<?php echo (L("_HINT_INVALID_")); ?>
			</span>
			<span class="glyphicon glyphicon-remove close"></span>
		</div>
		
		<div class="content-container">
			<!--导航条内容-->
			<div class="nav-bd">
				<!--logo-->
				<div class="logo col-md-3 col-sm-3  col-xs-0">
					<!--图片-->
					<img class="logo-img"/>
					<!--文字-->
					<h3 class="logo-text"></h3>
				</div>
				
				<!--导航条-->
				<style>
					.gambling { color: red !important; font-weight: bold; }
					.gambling:hover { color: red; }
				</style>
				<div class="nav-container col-md-9 col-sm-9 col-xs-12" id="navCo">
					<ul class="nav-ul" id="xy-nav-ul">
						<li class="nav-li">
							<div class="li-content">
								<a href="http://localhost:8081/Home/Index/index" class="nav-a nav-a-first"><?php echo (L("_ACCOUNT_MY_WALLET_")); ?></a>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://localhost:8081/Home/Send/index" class="nav-a"><?php echo (L("_ACCOUNT_SEND_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://localhost:8081/Home/Send/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://localhost:8081/Home/Send/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://localhost:8081/Home/WalletAddr/receive" class="nav-a"><?php echo (L("_ACCOUNT_RECEIVE_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://localhost:8081/Home/WalletAddr/receive">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://localhost:8081/Home/WalletAddr/receive?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://localhost:8081/Home/DealDetails/index" class="nav-a"><?php echo (L("_ACCOUNT_TRANSACTIONS_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://localhost:8081/Home/DealDetails/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://localhost:8081/Home/DealDetails/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://localhost:8081/Home/Buy/index" class="nav-a"><?php echo (L("_ACCOUNT_BUY_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://localhost:8081/Home/Buy/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://localhost:8081/Home/Buy/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://localhost:8081/Home/Sell/index" class="nav-a"><?php echo (L("_ACCOUNT_SELL_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://localhost:8081/Home/Sell/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://localhost:8081/Home/Sell/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li">
							<div class="li-content">
								<a href="http://localhost:8081/Home/Bocai/index" class="nav-a gambling">微平台</a>
							</div>
						</li>
					</ul>
					
					<div class="logo-phone col-md-3 col-sm-3  col-xs-3">
						<!--图片-->
						<img src="/Public/images/logo.png" class="logo-img-phone"/>
						<!--文字-->
						<h3 class="logo-text-phone"><?php echo (L("_LOGIN_TITLE_")); ?></h3>
					</div>
					
					<div class="dropdown dropdown-List ">
		                <a href="#" class="dropdown-toggle dropdown-List-a" data-toggle="dropdown">
	                  		 <span class="text-content"><?php echo (L("_LOGIN_WALLET_")); ?>&nbsp;</span><span class="glyphicon glyphicon-triangle-bottom dropdown-List-span"></span>
		                </a>
		                <ul class="dropdown-menu dropdown-ul">
		                    <li><a href="http://localhost:8081/Home/Index/index" class="dropdown-a"><?php echo (L("_LOGIN_WALLET_")); ?>&nbsp;</a></li>
		                    <li><a href="http://localhost:8081/Home/Buy/index" class="dropdown-a"><?php echo (L("_ACCOUNT_BUY_")); ?>&nbsp;</a></li>
		                    <li><a href="http://localhost:8081/Home/Sell/index" class="dropdown-a"><?php echo (L("_ACCOUNT_SELL_")); ?>&nbsp;</a></li>
		                    <li><a href="http://localhost:8081/Home/Send/index" class="dropdown-a"><?php echo (L("_ACCOUNT_SEND_")); ?>&nbsp;</a></li>
		                    <li><a href="http://localhost:8081/Home/WalletAddr/receive" class="dropdown-a"><?php echo (L("_ACCOUNT_RECEIVE_")); ?>&nbsp;</a></li>
		                    <li><a href="http://localhost:8081/Home/DealDetails/index" class="dropdown-a"><?php echo (L("_ACCOUNT_TRANSACTIONS_")); ?>&nbsp;</a></li>
		                    <li><a href="http://localhost:8081/Home/Bocai/index" class="dropdown-a gambling">微平台&nbsp;</a></li>
		                </ul>
		            </div>
					
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(function(){
			var time;
			//关闭按钮
			$(".close").click(function(){
				$(".nav-hd").css({
					transition:"height 0.5s",
					height:"0px"
				});
				clearTimeout(time);
			})
			function hint() {
				if(true){
					//显示提示
					$(".nav-hd").css({
						transition:"height 0.5s",
						height:"40px"
					});
					//定时自动关闭提示
					var time = setTimeout(function(){
						$(".nav-hd").css({
							transition:"height 0.5s",
							height:"0px"
						});
					}, 8000);
				}else{
					//显示提示
					$(".nav-hd").css({
						transition:"height 0.5s",
						height:"40px"
					});
					//修改提示内容
					clearTimeout(time);
					//定时自动关闭提示
					time = setTimeout(function(){
						$(".nav-hd").css({
							transition:"height 0.5s",
							height:"0px"
						});
					}, 8000);
				}
			}
			//移入显示下拉菜单
			$(".li-content").mouseover(function(){
				$(".Spinner").css("display","none");
				$(this).children().eq(2).css("display","block");
			});
			//移出隐藏下拉菜单
			$(".li-content").mouseout(function(){
				$(".Spinner").css("display","none");
			})
			//删除a的下划线
			$(".nav-a").click(function(){
				$(".nav-a").css("text-decoration","none");
			})
			//修改点击账户的默认样式
			$(".dropdown-List-a").click(function(){
				$(this).css({
					textDecoration:"none",
					color:"#1A1A1A"
				});
			})
			setNav();
			getLogo();
		});

		var setNav = function() {
			// 设置导航
	        var navUrl = window.location.href;	// 获取URL
	        // 表达式
	        var aExp = [ 
	        	/Home\/Login/i, 
	        	/Home\/Email/i, 
	        	/Home\/RealtimeMarket/i,
				/Home\/Question/i
	        ]; 		

	        for (var i=0; i<aExp.length; i++) {
	        	if (aExp[i].test(navUrl)) {
	        		// 登出（如登录界面）
	        		$('#xy-nav-ul').css({ 'display': 'none' });
	        		break;
	        	} else {
	        		// 登录成功（如首页）
	        		$('#xy-nav-ul').css({ 'display': 'block' });
	        	}
	        }

	        // 点击logo跳回首页
	        $(".logo").click(function () {
	        	sg.jump('http://localhost:8081/Home/Index');
	        });
		}
	
		/**
		 * 获取logo
		 */
		function getLogo () {
			var logoUrl = "http://localhost:8081/Home/Login/getupdateLogo";
			$.ajax({
				url: logoUrl,
				type: 'get',
				success: function (res) {
					$('.logo-img').attr('src', res.data[0].logo_url);
					$('.logo-text').text(res.data[0].name);
				}
			});
		}
	</script>
</block>



    <div class="forget" id="sh_forget">
        <div class="forget-content">
            <h4><?php echo (L("_ACCOUNT_SECURITY_CHANGE_PWD_")); ?></h4>
            <div class="form-group">
                <span><?php echo (L("_HINT_NEW_PWD_")); ?>:</span>
                <input type="password" class="form-control" id="sh_forgetNew" oninput="functionPass(0)" placeholder="<?php echo (L("_LOGIN_PASSWORD_")); ?>">
                <!--<img src="{{ newImg }}" alt="" v-if="imgStatus == 1" />-->
            </div>

            <span class="forget-hint" :class=" classStatus ? 'bgAsh' : 'bgRed' " v-if="disStatus == 1">
                <?php echo (L("_HINT_PWD_CHECK_")); ?>
            </span>

            <div class="form-group password">
                <span><?php echo (L("_HINT_NEW_PWD_CONFIRM_")); ?>:</span>
                <input type="password" class="form-control" id="sh_confirmPass" oninput="functionPass(1)" placeholder="<?php echo (L("_HINT_PWD_CONFIRM_")); ?>" >
                <!--<img src="{{ confirmImg }}" alt="" v-if="imgStatus == 2">-->
            </div>

            <span class="forget-hint bgAsh" v-if="passStatus == 1"><?php echo (L("_HINT_PWD_DIFFERENT_")); ?></span>
            <span class="forget-hint bgRed" v-if="passStatus == 2"><?php echo (L("_HINT_PWD_TWICE_DIFFERENT_")); ?></span>

            <button class="btn btn-lg resetPass" @click="resetPass" ><?php echo (L("_HINT_PWD_RESET_")); ?></button>
        </div>
        <div class="forget-img">
            <img src="/Public/images/register-background.png" alt="">
        </div>
    </div>

    <!-- footer start-->
    <!-- 底部开始 -->
	
    <footer>
    	<!--二维码-->
		<div id="QR-code-phone">
			<p style="font-size: 16px;color: #EE5544;"><?php echo (L("__QRCODE_TIPS_1__")); ?></p>
			<p style="font-size: 16px;color: #EE5544;"><?php echo (L("__QRCODE_TIPS_2__")); ?></p>
			<!--<p style="font-size: 16px;color: #EE5544;"><?php echo (L("__QRCODE_TIPS_3__")); ?></p>-->
			<div id="QR-code" style="width: 200px;height: 200px;border: 5px solid #3388bb;">
				<img src="/Public/images/QR-code.png" width="100%" height="100%"/>
			</div>
		</div>
    	
    	<div class="footer-main">
    		<div class="col-lg-2 col-sm-2">	</div>
    		<div class="ft col-lg-8 col-sm-8 ">
    			<!-- <a href="#"><?php echo (L("_CAREERS_")); ?></a><span>|</span> -->
    			<a href="http://localhost:8081/Home/PDF/index/type/termsOfUse">
                    <?php echo (L("_LOGIN_TERMS_FOR_USAGE_")); ?>
                </a><span>|</span>
    			<a href="http://localhost:8081/Home/PDF/index/type/privacy">
                    <?php echo (L("_LOGIN_PRIVACY_POLICY_")); ?>
                </a><span>|</span>
    			<a href="http://localhost:8081/Home/Question">
                    <?php echo (L("_FAQ_")); ?></a><span>|</span>
    			<!-- <a href="#">
                    <?php echo (L("_LOGIN_TRANSPARENCY_REPORT_")); ?>
                </a><span>|</span> -->
    			<a href="http://localhost:8081/Home/ContactUs">
                    <?php echo (L("_CONTACT_US_")); ?>
                </a>
    			<div class="footer-logo">
    			<a href=""><img src="/Public/images/footerlogo.png"/></a>
    		</div>
    		</div>
    	</div>
    </footer>


<!-- 底部结束
    <!-- footer end-->
</div>

<script>

    var forgetvm = new Vue({
        el: '#sh_forget',
        data: {
            passworldVer: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/,        // 正则判断

            classStatus: true,      // 新密码样式状态 true->提示样式  false->警告样式
            disStatus: 0,           // 新密码提示是否显示  1->提示
            passStatus: 0,          // 确认密码提示  1->输入时提示 2->不相等提示

            newImg: '',             // 新密码图片
            confirmImg: '',         // 确认密码图片
            imgStatus: 1,           // 图片显示状态
            imgStatus: 2,
        },
        methods: {
            resetPass: function () {
                var newPass = $('#sh_forgetNew').val();
                var confirmPass = $("#sh_confirmPass").val();

                /* 判断是否为空 */
                if( newPass == '' || confirmPass == '' ) {
                    forgetvm.disStatus = 1;
                    forgetvm.classStatus = false;
                    return false;
                }
                /* 正则判断 */
                if (!this.passworldVer.test(newPass)) {
                    this.disStatus = 1;
                    this.classStatus = false;
                    return false;
                } else {
                    this.disStatus = 0;
                }

                if ( $('#sh_forgetNew').val() != $('#sh_confirmPass').val() ) {
                    forgetvm.passStatus = 1;
                    return false;

                } 
                forgetvm.passStatus = 0;
                var password = hex_md5(config.verify_str + $('#sh_forgetNew').val());
                this.changePass(password);
            },

            /**
             * 更改密码
             * 
             * @param  string password 
             */
            changePass: function(password) {
                var nstr = nonceStr();
                var sign = config.verify_str + '<?php echo ($email); ?>' + password + nstr;

                var u = 'http://localhost:8081/Home/Email/changePassword';
                var d = {
                    email: '<?php echo ($email); ?>',
                    password : password,
                    nonce_str: nstr,
                    sign : hex_md5(sign)
                };

                $('.resetPass').attr('disabled', 'true');
                $('.resetPass').text('<?php echo (L("_HINT_ALTER_")); ?>');
                $.post(u, d, function(res) {
                    $('.resetPass').removeAttr('disabled');
                    $('.resetPass').text('<?php echo (L("_LOGIN_RESET_PSW_")); ?>');
                    console.log(res)

                    if (res.code == 0) {
                        alert('<?php echo (L("_HINT_AMEND_SUCCESS_")); ?>');
                        sg.jump('http://localhost:8081');

                    } else {
                        alert('<?php echo (L("_HINT_AMEND_DEFEAT_")); ?>');
                    }
                });
            }
        }
    });
</script>

<script>
        /* 新密码焦点事件 */
        $('#sh_forgetNew').blur(function () {
            
            if ( !forgetvm.passworldVer.test($(this).val()) ){
                forgetvm.disStatus = 1;
                forgetvm.classStatus = false;

                return;
            } else {
                forgetvm.disStatus = 0;
            }
        });

        /* 确认密码 */
        $('#sh_confirmPass').blur(function (){

            forgetvm.passStatus = 2;

            if($('#sh_forgetNew').val() == $('#sh_confirmPass').val() ) {
                forgetvm.passStatus = 0;
            }
        });

        /* 监听input的值变化 */
        function functionPass(id) {

            id ? confirmPass() : newPass();

            /* 输入新密码 */
            function newPass() {
                if ( !forgetvm.passworldVer.test($('#sh_forgetNew').val()) ) {
                    forgetvm.disStatus = 1;
                    forgetvm.classStatus = true;

                    return;
                } else {
                    forgetvm.disStatus = 0;
                }
            };

            /* 确认密码 */
            function confirmPass () {
                if ( $('#sh_forgetNew').val() != $('#sh_confirmPass').val() ) {
                    forgetvm.passStatus = 1;
                } else {
                    forgetvm.passStatus = 0;
                }
            };
        }

</script>