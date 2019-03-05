<?php if (!defined('THINK_PATH')) exit();?><head>
	<meta charset="UTF-8">
	<title>Blnance幣淘 港臺數位資產交易平臺</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://192.168.0.100:8081/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://192.168.0.100:8081/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="http://192.168.0.100:8081/Public/css/base.css" />

	<script type="text/javascript" src="http://192.168.0.100:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://192.168.0.100:8081/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://192.168.0.100:8081/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://192.168.0.100:8081/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://192.168.0.100:8081/Public/js/base64.js"></script>
    <script type="text/javascript" src="http://192.168.0.100:8081/Public/js/config.js"></script>
    <script type="text/javascript" src="http://192.168.0.100:8081/Public/js/function.js"></script>
    <script type="text/javascript" src="http://192.168.0.100:8081/Public/js/jquery.bday-picker.js"></script>
    <script type="text/javascript" src="http://192.168.0.100:8081/Public/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="http://192.168.0.100:8081/Public/plug-in/layui/layui.js"></script>

    <!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>

<link rel="stylesheet" type="text/css" href="/Public/home/css/login.min.css" />

<body>
    <!-- top start -->
    

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <div id="top">
    	<div id="wrapper">
	        <!-- 侧边栏 -->
	        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
	            <ul class="nav sidebar-nav warpp">
	                <li class="img-login">
	                    <img src="/Public/images/customerService.png" class="get_imglogo">
						<a id="login-href" href="http://192.168.0.100:8081/Home/Login/index"><?php echo (L("_LOGIN_LOGIN_")); ?></a>
                        <a id="logout-href" href="http://192.168.0.100:8081/Home/Login/logout" style="display: none;"><?php echo (L("_ACCOUNT_LOGOUT_")); ?></a>
                        <li @click='jumpMessage()' id="login-bell" style="display: none;">
                            <span class="glyphicon glyphicon-bell"></span>
                            <span id="xy-top-messageminwidth"></span>
                        </li>
	                </li>
	                <li><a href="http://192.168.0.100:8081/Home/index/index" id="minwidth1-act"><?php echo (L("_LOGIN_WALLET_")); ?></a></li>
	                <li><a href="http://192.168.0.100:8081/Home/RealtimeMarket/index" id="minwidth2-act"><?php echo (L("_LOGIN_CHART_")); ?></a></li>
	                <li><a href="http://192.168.0.100:8081/Home/ContactUs/index" id="minwidth3-act"><?php echo (L("_LOGIN_CONTACT_US_")); ?></a></li>
	                <li><a href="http://192.168.0.100:8081/Home/Question/index" id="minwidth4-act"><?php echo (L("_LOGIN_FAQ_")); ?></a></li>
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
	                    <li><a href="http://192.168.0.100:8081/Home/Index/index" id="indexAct" class="active"><?php echo (L("_LOGIN_WALLET_")); ?></a></li>
	                    <li><a href="http://192.168.0.100:8081/Home/RealtimeMarket/index" id="realtimeAct"><?php echo (L("_LOGIN_CHART_")); ?></a></li>
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
									<a href="http://192.168.0.100:8081">
										<?php echo (L("_LOGIN_LOGIN_")); ?>
									</a>
								</li>
								<li>
									<a href="http://192.168.0.100:8081">
										<?php echo (L("_LOGIN_SIGN_UP_")); ?>
									</a>
								</li>
							</ul>
							<ul class="user-Logout">
								<li>
									<a href="http://192.168.0.100:8081/Home/Login/logout">
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
				var u = 'http://192.168.0.100:8081/Float/Index/getdata';
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
				var u = 'http://192.168.0.100:8081/Home/Index/getTopInfo';
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
				sg.jump('http://192.168.0.100:8081/Home/MessageTip/index');
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
				window.location.href="http://192.168.0.100:8081/Home/Question/index";
			},
			goRelation : function(){//跳转到联系我们
				window.location.href="http://192.168.0.100:8081/Home/ContactUs/index";
			},
			changUrl:function(zt){
				var url = "http://192.168.0.100:8081/Home/Lang/change";
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
		var logoUrl = "http://192.168.0.100:8081/Home/Login/getupdateLogo";

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
    <div id="index-box">
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
								<a href="http://192.168.0.100:8081/Home/Index/index" class="nav-a nav-a-first"><?php echo (L("_ACCOUNT_MY_WALLET_")); ?></a>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.100:8081/Home/Send/index" class="nav-a"><?php echo (L("_ACCOUNT_SEND_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.100:8081/Home/Send/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.100:8081/Home/Send/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.100:8081/Home/WalletAddr/receive" class="nav-a"><?php echo (L("_ACCOUNT_RECEIVE_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.100:8081/Home/WalletAddr/receive">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.100:8081/Home/WalletAddr/receive?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.100:8081/Home/DealDetails/index" class="nav-a"><?php echo (L("_ACCOUNT_TRANSACTIONS_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.100:8081/Home/DealDetails/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.100:8081/Home/DealDetails/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.100:8081/Home/Buy/index" class="nav-a"><?php echo (L("_ACCOUNT_BUY_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.100:8081/Home/Buy/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.100:8081/Home/Buy/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.100:8081/Home/Sell/index" class="nav-a"><?php echo (L("_ACCOUNT_SELL_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.100:8081/Home/Sell/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.100:8081/Home/Sell/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li">
							<div class="li-content">
								<a href="http://192.168.0.100:8081/Home/Bocai/index" class="nav-a gambling">微平台</a>
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
		                    <li><a href="http://192.168.0.100:8081/Home/Index/index" class="dropdown-a"><?php echo (L("_LOGIN_WALLET_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.100:8081/Home/Buy/index" class="dropdown-a"><?php echo (L("_ACCOUNT_BUY_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.100:8081/Home/Sell/index" class="dropdown-a"><?php echo (L("_ACCOUNT_SELL_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.100:8081/Home/Send/index" class="dropdown-a"><?php echo (L("_ACCOUNT_SEND_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.100:8081/Home/WalletAddr/receive" class="dropdown-a"><?php echo (L("_ACCOUNT_RECEIVE_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.100:8081/Home/DealDetails/index" class="dropdown-a"><?php echo (L("_ACCOUNT_TRANSACTIONS_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.100:8081/Home/Bocai/index" class="dropdown-a gambling">微平台&nbsp;</a></li>
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
	        	sg.jump('http://192.168.0.100:8081/Home/Index');
	        });
		}
	
		/**
		 * 获取logo
		 */
		function getLogo () {
			var logoUrl = "http://192.168.0.100:8081/Home/Login/getupdateLogo";
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


        <!-- nav end-->
        <!-- login start -->
        <div class="container-login" id="container-login">
            <div class="banner max-width">
                <div class="login">
                    <div id="sh_tab">
                        <ul class="tab_menu">
                            <li><?php echo (L("_LOGIN_SIGN_UP_")); ?></li>
                            <li class="selected"><?php echo (L("_LOGIN_LOGIN_")); ?></li>
                        </ul>
                        <div class="tab_box">
                            <!-- 注册 -->
                            <div class="sh_hide">
                                <div class="stu_login_error"  style="position: relative">

                                    <div class="input-group">
                                        <span>
                                            <?php echo (L("_LOGIN_SIGN_UP_TIPS_TOP_")); ?>
                                            <span class="company-name">{{ companyName }}</span>
                                            <?php echo (L("_LOGIN_SIGN_UP_TIPS_DOWN_")); ?>
                                        </span>
                                    </div>

                                    <div class="input-group" style="position: relative">
                                        <div class="sh-hint"><?php echo (L("_HINT_RES_EMAIL_EMPTY_")); ?></div>
                                        <input type="text" id="rename" name="rename" placeholder="<?php echo (L("_LOGIN_SIGN_UP_EMAIL_")); ?>" />

                                    </div>

                                    <div>
                                        <button 
                                            type="button" 
                                            class="btn xy-login-register" 
                                            @click="register()"
                                        >
                                            <?php echo (L("_LOGIN_SIGN_UP_")); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- 登录 -->
                            <div>
                                <div class="tea_login_error">
                                    <div class="input-group">
                                        <input type="text" id="emailName" name="emailName" placeholder="<?php echo (L("_LOGIN_SIGN_UP_EMAIL_")); ?>" />
                                    </div>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" placeholder="<?php echo (L("_LOGIN_PASSWORD_")); ?>" />
                                    </div>

                                    <div>
                                        <button type="button"
                                                class="btn xy-login-login"
                                                v-on:click="BTCLogin()"
                                        ><?php echo (L("_LOGIN_LOGIN_")); ?>
                                        </button>
                                    </div>
                                    <div class="input-group" style="position: relative; width: 100%;">
                                        <a href="javascript:;" class="forget"><?php echo (L("_LOGIN_FORGOT_PASSWORD_")); ?></a>
                                        <a href="http://192.168.0.100:8081/Home/Email/lockout" class="lock"><?php echo (L("_LOGIN_ACCOUNT_LOCKED_")); ?></a>
                                    </div>
                                </div>

                                <!-- 忘记密码 -->
                                <div class="forget-pwd">
                                    <div class="stu_login_error">

                                        <div class="input-group">
                                            <span><?php echo (L("_LOGIN_FORGOT_PSW_TIPS_")); ?></span>
                                        </div>

                                        <div class="input-group">
                                            <input 
                                                type="text"  
                                                name="pc-forget-email" 
                                                value="" 
                                                placeholder="<?php echo (L("_LOGIN_SIGN_UP_EMAIL_")); ?>" 
                                            />
                                        </div>

                                        <div>
                                            <button 
                                                class="reset-btn btn forgetBtn" 
                                                @click="resetPass('pc')"
                                            >
                                                <?php echo (L("_LOGIN_RESET_PSW_")); ?>
                                            </button>
                                        </div>

                                        <div>
                                            <a class="gologin" href="JavaScript:;"><?php echo (L("_LOGIN_BACK_LOGIN_")); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 手机端登录 -->
                <div class="login-small">
                    <div class="login-small-input">
                        <div class="input-group" style="width: 100%;">
                            <input type="text" class="input form-control" name="emailPhone" placeholder="<?php echo (L("_LOGIN_SIGN_UP_EMAIL_")); ?>" />
                        </div>
                        <div class="input-group" style="width: 100%;">
                            <input type="password" class="input" name="passPhome" placeholder="<?php echo (L("_LOGIN_PASSWORD_")); ?>" />
                        </div>

                        <div class="login-btn">
                            <button type="button" class="btn xy-login-login" @click="PhoneLogin()" ><?php echo (L("_LOGIN_LOGIN_")); ?></button>
                        </div>

                        <div class="input-group" style="position: relative; width: 100%;">
                            <a href="javascript:;" class="forget forget-small"><?php echo (L("_LOGIN_FORGOT_PASSWORD_")); ?></a>
                            <a href="http://192.168.0.100:8081/Home/Email/lockout" class="lock"><?php echo (L("_LOGIN_ACCOUNT_LOCKED_")); ?></a>
                        </div>

                        <div id="login-re" class="login-btn-re">
                            <?php echo (L("_LOGIN_SIGN_UP_")); ?>
                        </div>
                    </div>

                    <!-- 手机端注册 -->
                    <div class="re-small">
                        <div class="input-group">
                            <span>
                                <?php echo (L("_LOGIN_SIGN_UP_TIPS_TOP_")); ?>
                                <span class="company-name">{{ companyName }}</span>
                                <?php echo (L("_LOGIN_SIGN_UP_TIPS_DOWN_")); ?>
                            </span>
                        </div>

                        <div class="input-group" style="width: 100%; margin-top: 5px;">
                            <input type="text" name="username" class="input"/>
                        </div>
                        
                        <div class="sh-small-hint"><?php echo (L("_HINT_RES_EMAIL_EMPTY_")); ?></div>

                        <div class="re-small-btn">
                            <button type="button" class="btn register xy-login-register" @click="PhoneRegister()"><?php echo (L("_LOGIN_SIGN_UP_")); ?></button>
                        </div>

                        <div id="login-btn" class="login-btn-re">
                            <?php echo (L("_LOGIN_LOGIN_")); ?>
                        </div>
                    </div>

                    <!-- 手机端忘记密码 -->
                    <div class="forget-pwd-small">
                        <div class="input-group">
                            <span><?php echo (L("_LOGIN_FORGOT_PSW_TIPS_")); ?></span>
                        </div>

                        <div class="input-group" style="width: 100%; margin-top: 5px;">
                            <input
                                type ="text" 
                                name ="mobile-forget-email" 
                                class="input" 
                                placeholder="<?php echo (L("_LOGIN_SIGN_UP_EMAIL_")); ?>"
                            />
                        </div>

                        <div class="re-small-btn">
                            <button 
                                class ="btn forgetBtn" 
                                @click="resetPass('mobile')"
                            >
                                <?php echo (L("_LOGIN_RESET_PSW_")); ?>
                            </button>
                        </div>

                        <div style="text-align: center">
                            <a class="gologinsmall" href="JavaScript:;"><?php echo (L("_LOGIN_BACK_LOGIN_")); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- login end -->
        <!-- 服务开始 -->
        <div class="container-service">
            <div class="container-service-group max-width">
                <!-- 超商代收 -->
                <div class="service payment col-md-4 col-xs-4 ">
                    <img src="/Public/images/collection.png" alt="超商代收" class="">
                    <div class="caption">
                        <h4 class="btc-txc64"><?php echo (L("_LOGIN_CASH_PAYMENT_")); ?></h4>
                        <p class="btc-txc96"><?php echo (L("_LOGIN_CASH_CONTENT_")); ?></p>
                    </div>
                </div>
                <!-- 银行汇款 -->
                <div class="service integration col-md-4 col-xs-4 ">
                    <img src="/Public/images/returnedMone.png" alt="银行汇款" class="">
                    <div class="caption">
                        <h4 class="btc-txc64"><?php echo (L("_LOGIN_BANK_INTEGRATION_")); ?></h4>
                        <p class="btc-txc96"><?php echo (L("_LOGIN_BANK_CONTENT_")); ?></p>
                    </div>

                </div>
                <!-- 全天候服务 -->
                <div class="service aroundmd col-md-4 col-xs-4 ">
                    <img src="/Public/images/service.png" alt="全天候服务" class="">
                    <div class="caption">
                        <h4 class="btc-txc64"><?php echo (L("_LOGIN_AROUND_THE_CLOCK_")); ?></h4>
                        <p class="btc-txc96"><?php echo (L("_LOGIN_AROUND_CONTENT_")); ?></p>
                    </div>

                </div>
            </div>
        </div>
        <!-- 服务结束 -->

        <!-- 客服开始 -->
        <div class="customer-service">
            <div class="customer-service-group max-width row">
                <!-- 安全保障 -->
                <div class="service security col-md-6 col-xs-6">
                    <img src="/Public/images/protect.png" alt="">
                    <div class="caption">
                        <h4 class="btc-txc64"><?php echo (L("_LOGIN_SECURITY_")); ?></h4>
                        <p class="btc-txc96" style="width: 99%"><?php echo (L("_LOGIN_SECURITY_CONTENT_")); ?></p>
                    </div>
                </div>
                <!-- 客服服务 -->
                <div class="service customer col-md-6 col-xs-6">
                    <img src="/Public/images/customerService.png" alt="">
                    <div class="caption">
                        <h4 class="btc-txc64"><?php echo (L("_LOGIN_CUSTOMER_SERVICE_")); ?></h4>
                        <p class="btc-txc96"><?php echo (L("_LOGIN_CUSTOMER_CONTENT_")); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- 客服结束 -->

        <!-- btc优点开始 -->
        <div class="advantage">
            <div class="advantage-group">
                <!-- 简单上手 -->
                <div class="character col-md-4 col-xs-4">
                    <div class="caption">
                        <h4 class=""><?php echo (L("_LOGIN_SIMPLICITY_")); ?></h4>
                        <p class=""><?php echo (L("_LOGIN_SIMPLICITY_CONTENT_")); ?></p>
                    </div>
                </div>
                <!-- 高效率 -->
                <div class="character col-md-4 col-xs-4">
                    <div class="caption">
                        <h4 class=""><?php echo (L("_LOGIN_EFFICIENCY_")); ?></h4>
                        <p class=""><?php echo (L("_LOGIN_EFFICIENCY_CONTENT_")); ?></p>
                    </div>
                </div>
                <!-- 全天候 -->
                <div class="character col-md-4 col-xs-4">
                    <div class="caption">
                        <h4 class=""><?php echo (L("_LOGIN_ANYTIME_")); ?></h4>
                        <p class=""><?php echo (L("_LOGIN_ANYTIME_CONTENT_")); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- btc优点结束 -->

        <!-- 底部问题联系开始 -->
        <div class="problem">
            <div class="problem-group">
                <div class="issue col-md-6 col-xs-6" >
                    <h4> 
                        <a 
                            href  = "http://192.168.0.100:8081/Home/Question"
                            style = "color: #fff"
                        >
                            <?php echo (L("_LOGIN_COMMON_QUESTIONS_")); ?>
                        </a>
                    </h4>
                    <div v-for="(item, index) in questionList">
                        <p><a href="javascript:;" @click="goQuestionContent(item.type)">{{ item.title }}</a></p>
                    </div>
                    <p><a href="javascript:;" @click="goQuestionMore()"><?php echo (L("_LOGIN_MORE_")); ?></a></p>
                </div>
                <!-- 联系我们 -->
                <div class="relation col-md-6 col-xs-6">
                    <h4><?php echo (L("_LOGIN_CONTACT_US_")); ?></h4>
                    <p>
                        <?php echo (L("_LOGIN_BUSINESS_HOURS_")); ?>
                        <span>{{ serviceTime }}</span>
                    </p>
                    <p>
                        <a href="javascript:;"><?php echo (L("_LOGIN_PHONE_")); ?></a>
                        <span>{{ companyPhone }}</span>
                    </p>
                    <p>
                        <a href="javascript:;"><?php echo (L("_LOGIN_EMAIL_")); ?></a>
                        <span>{{ companyEmail }}</span>
                    </p>
                </div>
            </div>
        </div>
        <!-- 底部问题联系结束-->

        <!-- footer start-->
        <!-- 底部开始 -->
	
    <footer>
    	<div class="footer-main">
    		<div class="col-lg-2 col-sm-2">	</div>
    		<div class="ft col-lg-8 col-sm-8 ">
    			<a href="http://192.168.0.100:8081/Home/PDF/index/type/termsOfUse">
                    <?php echo (L("_LOGIN_TERMS_FOR_USAGE_")); ?>
                </a><span>|</span>
    			<a href="http://192.168.0.100:8081/Home/PDF/index/type/privacy">
                    <?php echo (L("_LOGIN_PRIVACY_POLICY_")); ?>
                </a><span>|</span>
    			<a href="http://192.168.0.100:8081/Home/Question">
                    <?php echo (L("_FAQ_")); ?></a><span>|</span>
    			<a href="http://192.168.0.100:8081/Home/ContactUs">
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
</body>
<script type="text/javascript" src="http://192.168.0.100:8081/Public/js/md5.js"></script>
<script type="text/javascript" src="/Public/home/js/login.min.js"></script>