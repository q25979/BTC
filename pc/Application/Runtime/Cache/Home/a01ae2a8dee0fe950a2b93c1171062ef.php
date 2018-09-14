<?php if (!defined('THINK_PATH')) exit();?><head>
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

<link rel="stylesheet" type="text/css" href="/Public/home/css/index.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/security/security.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/security/update.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/security/enable.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/sell.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/send/send.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/send/receive.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/dealDetails.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/buy.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/MessageTip.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/setting.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/WithdrawalDetail.css" />

<style>
	/*公告*/
    #announcement {width: 128px;  background: #F5F5F5; position: fixed; top: 25%; box-shadow: 1px 3px 10px #ccc; z-index: 2; border-bottom-right-radius: 7px;}
    #announcement-hd{width: 100%;height: 36px;background-image: url(/Public/images/Popupblock.png);display: flex;justify-content: center;align-items: center; border-top-right-radius: 7px;}
    .bull-title {font-size: 14px; color: #E6E6E6; padding: 0 6px 0 6px;}
    .bull-close-left {position: absolute; right: 10px; top: 7px; font-weight: bold;font-size: 18px;}
    .bull-close-left:hover {color: #fff; cursor: pointer;}
    #announcement-bd {  overflow: hidden; }
    .announcement-bd { width: 90%; padding: 5px 5px 5px 15px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-size: 12px;}
    #announcement-info-box{width: 100%; margin-top: 0;}
    #announcement-info-box ul{list-style: none;}
    #announcement-info-box li{margin-bottom: 5px;}
    @media all and (max-width: 770px) {
        #announcement, .call-callCenter  {display: none !important;}
    }
    
	/*客服*/
    .call-callCenter {width: 180px; background: #F5F5F5; position: fixed; top:60%; right: 0; z-index: 1; border-bottom-left-radius: 7px; box-shadow: -1px 3px 10px #ccc;}
    .call-fix {position: relative; display: flex;justify-content: center;align-items: center;}
    .call-callCenter img{ position: absolute; top: 0; left: 0;}
    .call-title {position: absolute; font-size: 14px; color: #E6E6E6; top: 3px; left: 70px;}
    .call-close-right {position: absolute; left: 10px; top: 7px; outline:none; cursor: pointer; }
    .call-close-right:hover {color: #fff; }
    .call-qq-info { display: block; }
    .call-qq-info span { font-size: 14px;}
    #call_content { font-weight: bold; display: block; margin-top: 5px;  width: 160px;}

</style>

<body>
<!-- 公告 -->
	<div id="announcement" @mouseover="rollStop()" @mouseout="rollOpen()">
	    <div id="announcement-hd">
            <span class="bull-title"><?php echo (L("_HINT_BULLETIN_BOARD_")); ?></span>
            <div type="button" class="bull-close-left" @click="close()">&times;</div>
        </div>
       
        <div id="announcement-bd">
            <div id="announcement-info-box">
                <ul>
                    <li v-for="item in bulletinLit">
                        <div class="announcement-bd"><a href="javascript:void(0)" @click = "getBulletinContent(item.bulletin_id)">{{ item.title }}</a></div>
                        <div style="border-top: 1px dashed #ccc; width: 90%; margin-top: 5px;" ></div>
                    </li>
                </ul>
            </div>
        </div>
    	
    	<script type="text/javascript" src="/Public/home/js/bulletin.js"></script>
        <script type="text/javascript">
            //如果开启浮动就显示（公告）
            var url = 'http://localhost:8081/home/PopupWindow/isBuClose';
            $.get(url, function (res) {
                if (res) {
                    $('#announcement').css("display","block");
                }
            });
        </script>
	</div>
    <!-- 客服 -->
	<div class="call-callCenter" style="display: none">
        <div class="call-fix" id="call-callCenter">
            <div>
                <img src="/Public/images/Popupblock.png" style="border-top-left-radius: 7px; width: 180px;">
                <span class="call-title"><?php echo (L("_CALL_CENTER_")); ?></span>
                <div type="button" class="call-close-right" id="call-close-right" onclick="callClose()">&times;</div>
            </div>
            <ul>
                <div style="height: 38px;"></div>
                <li class="call-qq-info" v-for="item in callCenterList">
                    <span id="call_content" v-bind:title="item" > {{ item }} </span>
                    <div style="border-top: 1px solid #ccc; width: 140px; margin-top: 10px;" ></div>
                </li>
            </ul>
        </div>
        <script type="text/javascript" src="/Public/home/js/callCenter.js"></script>
        <script type="text/javascript">
            //如果开启浮动就显示（客服）
            function callClose(){
                $('.call-callCenter').animate({'right':'-200px'});
            }

            var url = 'http://localhost:8081/home/PopupWindow/isSvClose';
            $.get(url, function (res) {
                if (res) {
                    $('.call-callCenter').css("display","block");
                }
            });

        </script>
    </div>


    <div id="topFloat">
    	<!-- 顶部 -->
	    

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <!--<header><?php echo (L("_MODULE_NOT_EXIST_")); ?></header>-->

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





	
	    <!-- 选项卡 -->
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
				<div class="nav-container col-md-9 col-sm-9 col-xs-12">
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
				                    <li><a href="http://localhost:8081/Home/Send/index?type=2">ETH</a></li>
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
				                    <li><a href="http://localhost:8081/Home/WalletAddr/receive?type=2">ETH</a></li>
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
				                    <li><a href="http://localhost:8081/Home/DealDetails/index?type=2">ETH</a></li>
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
				                    <li><a href="http://localhost:8081/Home/Buy/index?type=2">ETH</a></li>
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
				                    <li><a href="http://localhost:8081/Home/Sell/index?type=2">ETH</a></li>
				                </ul>
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
		                </ul>
		            </div>
					
				</div>
			</div>
		</div>
			<!--<button class="btn btn-success ceshi btn-close">测试</button>-->
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
					//修改提示内容
//					$(".hint").html("成功 登陆了").css("color","#fff");

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
//					$(".hint").html("Email 無效的電子信箱");

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

			//控制一级菜单的点击事件
//			$(".nav-a").click(function(){
//				$(".nav-a").css("color","#3388BB");
//				$(".nav-span").css("color","#3388BB");
//				$(".nav-a").css("border-bottom","2px solid #fff");
//				
//				$(this).css("color","#000");
//				$(this).next().css("color","#000");
//				$(this).css("border-bottom","2px solid #EB5A4D");
//			});
			
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
			
//			$(".dropdown-a").click(function(){
//				var textContent = $(this).html();
//				$(".text-content").html(textContent);
//			})
			
			setNav();
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
	</script>

	<script>
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


					$('.logo-img').attr('src', res.data[0].logo_url);
					$('.logo-text').text(res.data[0].name);
				}
			});
		}

	</script>
</block>




		<!--左右侧浮动窗-->
			<div style="width: 100%;display: flex;justify-content: center;align-items: center;">
		    <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12 total-container" style="max-width: 1200px;padding: 0; margin: 0 auto; margin-top: 26px;position: relative;overflow: -hidden;" >
	
				
			    <!-- 侧边栏 -->
				<!--侧边栏-->

	<!--侧边栏容器-->
    <div class="sidebar-container col-lg-4 col-md-4 col-sm-4 col-xs-12">
    	<!--侧边栏内容-->
	    <div class="sidebar-content">
    		<ul class="sidebar-content-ul">
    			<li class="sidebar-content-li"><a href="http://localhost:8081/Home/Index/index" class="sidebar-content-a sidebar-content-hd"><img src="/Public/images/home-click.png" /><?php echo (L("_ACCOUNT_HOME_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://localhost:8081/Home/WalletAddr/receive" class="sidebar-content-a"><img src="/Public/images/wallet-active.png" /><?php echo (L("_ACCOUNT_ADDRESSES_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://localhost:8081/Home/Security/index" class="sidebar-content-a"><img src="/Public/images/safety-active.png" /><?php echo (L("_ACCOUNT_SECURITY_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://localhost:8081/Home/Setting/index" class="sidebar-content-a"><img src="/Public/images/set-active.png" /><?php echo (L("_ACCOUNT_SETTINGS_")); ?></a> <span class="label label-success new-logo">new</span></li>
    		</ul>
   		</div>
   		
		<!--二维码-->
		<div id="QR-code-box" style="width: 100%;">
			<div style="border: 5px solid #3388bb;">
				<p style="font-size: 16px;margin-left: 5px;margin-top: 10px;"><?php echo (L("__QRCODE_TIPS_1__")); ?></p>
				<p style="font-size: 16px;margin-left: 5px;"><?php echo (L("__QRCODE_TIPS_2__")); ?></p>
				<!--<p style="font-size: 16px;margin-left: 5px;"><?php echo (L("__QRCODE_TIPS_3__")); ?></p>-->
				<div id="QR-code" style="width: 100%;height: 250px;border-top: 5px solid #3388bb;">
					<img src="/Public/images/b.jpg" width="100%" height="100%"/>
				</div>
			</div>
		</div>
    </div>


	<!--宽度过低时左侧内容-->
	<div id="small-bulContent" style="display: none;">
        <div class="small-bultitle">
            <ul>
                <li v-for="item in bulletinLit" class="small-hiddeny" style="height: 25px;">
                    <div class="small-announcement-bd"><a href="javascript:void(0)" @click = "getBulletinContent(item.bulletin_id)">{{ item.title }}</a></div>
                    <!--<div style="border-top: 1px dashed #ccc; width: 80%; margin-top: 5px; margin-left: 10%;" ></div>-->
                </li>
            </ul>
        </div>
	</div>
	<!--宽度过低时右侧内容-->
	<div id="small-centerContent" style="display: none;">
        <div class="small-caltitle">
            <div class="callCenter-center">
                <span v-for="item in callCenterList" class="small-centerContent-bd">
                    <span id="small-call_name">{{ item }}</span>
                </span>
            </div>
        </div>
	</div>


<script type="text/javascript">
	$(function(){
        new Vue({
            el: '#small-centerContent',
            data:{
                callCenterList: []
            },
            created:function(){
                this.getData();
            },
            methods: {
                getData: function () {
                    var _this = this;
                    var url_buletin = config.host_path + '/Home/PopupWindow/getCallCenter';

                    $.get(url_buletin,function(res){
                        for(var i in res) {
                            _this.callCenterList.push(res[i]);
                            _this.count += 1;
                        }

                    });
                }
            }

        });


        var popupVm = new Vue({
            el: '#small-bulContent',
            data:{
                bulletinLit:[],
                count: 0
            },
            created: function(){

                this.getData();

            },
            methods: {
                /*
                 * 获取公告栏数据
                 * */
                getData: function () {
                    var _this = this;
                    var url = config.host_path + '/Home/PopupWindow/getBulletin';

                    $.get(url, function (res) {

                        for(var i in res.data) {
                            _this.bulletinLit.push(res.data[i]);
                            _this.count += 1;
                        }

                        _this.small_noticeRoll(res.data.length);
                    });
                },
                /**
                 * 点击公告详情
                 * @param bulletinId 公告Id
                 */
                getBulletinContent: function (bulletinId){
                    window.location.href=config.host_path + "/Home/PopupWindow/bulletinContent.html?bulletin_id=" + bulletinId;
                },
                /**
                 * 公告滚动
                 */
                small_noticeRoll: function (length) {

                    if (length <= 1 ) { return ; }

                    var _this = this;
                    small_margintop = $(".small-bultitle ul").css("marginTop");//偏移量
                    var reg = new RegExp("px","g");
                    var small_margin = small_margintop.replace(reg, "");
                    small_margin = parseInt(small_margin);

                    var small_height = $(".small-bultitle").css("height");//获取容器高度
                    var small_height_1 = small_height.replace(reg, "");
                    small_height_1 = parseInt(small_height_1) + length * 25;

                    setInterval(function(){
                       small_margin -= 25;
                        if (small_margin <= -small_height_1) {
                            small_margin = 0;
                        }
                        $(".small-bultitle").css("marginTop",small_margin+"px");
                    }, 5000);
                }
            }


        });
    });
</script>
		        

    <!-- 设定-->
    <div class="content-setting">
        <!--容器-->
        <div class="setting-container">
            <!--基本资讯-->
            <div class="setting-info">
                <h3><?php echo (L("_ACCOUNT_SETTINGS_BASIC_INFO_")); ?>
                    <span class="glyphicon glyphicon-question-sign setting-hint"></span>
                </h3>
                <!--标题里的内容-->
                <div class="setting-info-content">
                    <ul class="setting-info-ul">
                        <li><?php echo (L("_HINT_EMAIL_")); ?><span id="info_email"</span></li>
                        <li><?php echo (L("_HINT_NAME_")); ?><span id="info_name"></span></li>
                        <li><?php echo (L("_ACCOUNT_SETTINGS_ID_NUMBER_")); ?>：<span id="info_idnumber"></span></li>
                        <li><?php echo (L("_ACCOUNT_SETTINGS_HOME_ID_")); ?>：<span id="info_id"></span></li>
                    </ul>
                    <button class="btn btn-lg btn-active setting-btn" ><?php echo (L("_ACCOUNT_SETTINGS_ADD_INFO_")); ?></button>
                    <div class="setting-hint-text">
                        <?php echo (L("_ACCOUNT_SETTINGS_CHANGE_INFO_")); ?>
                    </div>
                </div>
            </div>
            <div class="dash"></div>
            <!--身份验证-->
            <div class="setting-info setting-info-identity">
                <h3><?php echo (L("_ACCOUNT_BUY_BTC_ID_VER_")); ?></h3>
                <!--标题里的内容-->
                <div class="setting-info-content">
                    <p class="identity-p"><?php echo (L("_ACCOUNT_SETTINGS_VER_TIPS_")); ?></p>
                    <div class="identity-content">
                        <p style="margin-bottom: 10px;"><?php echo (L("_HINT_UPLOAD_FILE_")); ?></p>
                        <p style="margin-bottom: 5px;"><?php echo (L("_HINT_UPLOAD_ID_TIPS_")); ?></p>
                        <p style="color: red;"><?php echo (L("_HINT_UPLOAD_NOTICE_")); ?></p>
                        <button class="btn btn-lg btn-active identity-btn"><?php echo (L("_HINT_UPLOAD_ID_")); ?></button>
                        <p class="identity-verify-text"><?php echo (L("_HINT_ID_CHECK_TIPS_")); ?></p>
                        <p><?php echo (L("_HINT_ID_WARNING_")); ?></p>
                    </div>
                </div>
            </div>
            <div class="dash"></div>
  

            <!--基本资讯-->
            <div class="setting-info">
                <h3><?php echo (L("_ACCOUNT_SETTINGS_PHONE_")); ?>
                    <a href="http://localhost:8081/Home/Setting/updateMobilePhone" class="setting-hint-a"><?php echo (L("_HINT_PHONE_NUMBER_")); ?></a>
                </h3>
                <!--标题里的内容-->
                <div class="setting-info-content">
                    <p> <?php echo (L("_ACCOUNT_SETTINGS_PHONE_NUM_")); ?> <b id="getPhone"></b></p>
                </div>

                <button class="btn btn-lg btn-active bind-phone">
                    <span class="glyphicon glyphicon-plus" style="margin-right: 10px;font-size: 14px;"></span> <?php echo (L("_HINT_BINDING_PHONE_")); ?>
                </button>
            </div>
            <div class="dash"></div>

            <!--卖单汇款银行账户-->
            <div class="setting-info">
                <h3><?php echo (L("_ACCOUNT_SETTINGS_BANK_SELL")); ?></h3>
                <!--标题里的内容-->
                <div class="setting-info-content">
                    <p class="average-price"><span>?</span><?php echo (L("_ACCOUNT_SETTINGS_SELL_TIPS_")); ?></p>
                     <a href="http://localhost:8081/Home/Setting/bindingBankCard" class="bank-hint-a">修改銀行賬號</a>
                    <div id="bank-box">
	                    <p class="bank-info"><span>您当前銀行账户名：</span><span id="bank_name"></span></p>
	                    <p class="bank-info"><span>您当前銀行賬號是：</span><span id="bank_number"></span></p>
                    </div>

                    <button class="btn btn-lg btn-active sell-account-btn" id="setBank">
                        <span class="glyphicon glyphicon-plus" style="margin-right: 10px;font-size: 14px;"></span> <?php echo (L("_ACCOUNT_SETTINGS_ADD_BANK_")); ?>
                    </button>
                </div>
            </div>
            <div class="dash"></div>
            <!--买单汇款银行账户-->
            <div class="setting-info">
                <h3><?php echo (L("_ACCOUNT_SETTINGS_BANK_BUY_")); ?></h3>
                <!--标题里的内容-->
                <div class="setting-info-content">
                    <p><?php echo (L("_ACCOUNT_SETTINGS_BUY_TIPS_TOP_")); ?>
                        <a href="http://localhost:8081/Home/Buy/index"><?php echo (L("_ACCOUNT_SETTINGS_BUY_BTC_")); ?></a>
                        <?php echo (L("_ACCOUNT_SETTINGS_BUY_TIPS_DOWN_")); ?></p>
                </div>
            </div>
            <div class="dash"></div>
            <!--邮件通知设定-->
            <div class="setting-info setting-info-email">
                <h3><?php echo (L("_ACCOUNT_SETTINGS_NOTIFICATION_")); ?></h3>
                <!--标题里的内容-->
                <div class="setting-info-content">

                    <div class="email-toggle">
                        <p><?php echo (L("_ACCOUNT_SETTINGS_LOGIN_")); ?></p>
                        <div class="switch-btn">
                            <div class="switch-btn-left"><?php echo (L("_ACCOUNT_SETTINGS_SWITCH_ON_")); ?></div>
                            <div class="switch-btn-right"><?php echo (L("_ACCOUNT_SETTINGS_SWITCH_OFF_")); ?></div>
                            <div class="switch-btn-hide"></div>
                        </div>
                    </div>

                    <div class="email-toggle">
                        <p><?php echo (L("_ACCOUNT_SETTINGS_SRP_")); ?></p>
                        <div class="switch-btn">
                            <div class="switch-btn-left"><?php echo (L("_ACCOUNT_SETTINGS_SWITCH_ON_")); ?></div>
                            <div class="switch-btn-right"><?php echo (L("_ACCOUNT_SETTINGS_SWITCH_OFF_")); ?></div>
                            <div class="switch-btn-hide"></div>
                        </div>
                    </div>

                    <div class="email-toggle">
                        <p><?php echo (L("_ACCOUNT_SETTINGS_BUY_SELL_")); ?></p>
                        <div class="switch-btn">
                            <div class="switch-btn-left"><?php echo (L("_ACCOUNT_SETTINGS_SWITCH_ON_")); ?></div>
                            <div class="switch-btn-right"><?php echo (L("_ACCOUNT_SETTINGS_SWITCH_OFF_")); ?></div>
                            <div class="switch-btn-hide"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="dash"></div>
            <!--其他设置-->
            <div class="setting-info">
                <h3><?php echo (L("_ACCOUNT_SETTINGS_OTHER_")); ?>
                    <!--<a href="http://localhost:8081/Home/Setting/otherSetting" class="right-a"><?php echo (L("_ACCOUNT_SETTINGS_CHANGE_OTHER_")); ?></a>-->
                </h3>
                <!--标题里的内容-->
                <div class="setting-info-content">
                    <p><?php echo (L("_ACCOUNT_SETTINGS_TIME_ZONE_")); ?><b>Taipei</b></p>
                    <p><?php echo (L("_ACCOUNT_SETTINGS_CURRENCY_")); ?><b>New Taiwan Dollar</b></p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="http://localhost:8081/Public/plug-in/layui/layui.js"></script>

    <script type="text/javascript">
        //获取基本资讯状态和信息
        var SetInfo_url = 'http://localhost:8081/Home/Setting/getInfo';
        $.ajax({
            url: SetInfo_url,
            type: 'get',
            success: function (res) {
                if(parseInt(res.code) == 0){
                    $('.setting-info-ul').css({"display":"block"});
                    $('#info_email').text(res.data[0].email);
                    $('#info_name').text(res.data[0].user_name);
                    $('#info_idnumber').text(res.data[0].certificate_num);
                    $('#info_id').text(res.data[0].maincoin_id);
					$(".setting-btn").css("display","none");

                    judgePhone(res.data[0].maincoin_id);
                }
            }
        });
    </script>

    <script>
        phone_init();
        /**
         *  初始化
         */
         function phone_init() {
             $('.bind-phone').css('display', 'none');        // 绑定手机号按钮
             $('.setting-hint-a').css('display', 'none');    // 显示按钮
             /*$('#handId-btn').attr('disabled', true);       // 上传图片
             $('#upload-handId').attr('disabled', true);    // 浏览上传图片*/
        };

        /**
         * 判断是否绑定手机号
         * @param int maincoin_id 本站ID
         */
        function judgePhone(maincoin_id) {
            if (maincoin_id == '' || maincoin_id == undefined ) {
                $('.bind-phone').css('display', 'block');
            } else {
                $('.setting-hint-a').css('display', 'block');
            }
        };

    </script>

    <script type="text/javascript">
        $(function(){
            //更改按钮样式
            $(".btn-active").click(function(){
                $(this).css("color","#fff");
            })

            //提示小问号hover事件
            $(".setting-hint").hover(function(){
                $(".setting-hint-text").css("display","block");
            },function(){
                $(".setting-hint-text").css("display","none");
            });

            layui.use('layer', function(){
                var layer = layui.layer;
                $(document).ready(function() {

                    var status1 = 0;
                    var status2 = 0;
                    var status3 = 0;

                    var url = 'http://localhost:8081/Home/Setting/getEmailStatus';

                    $.get(url,function(res){//根据设置调整按钮
                        if(res.data.email_login == 1){
                            $(".switch-btn").eq(0).children('div:eq(2)').css("left","41px");
                        }else if(res.data.email_login == 0){
                            $(".switch-btn").eq(0).children('div:eq(2)').css("left","0px");
                        }

                        if(res.data.email_get == 1){
                            $(".switch-btn").eq(1).children('div:eq(2)').css("left","41px");
                        }else if(res.data.email_get == 0){
                            $(".switch-btn").eq(1).children('div:eq(2)').css("left","0px");
                        }

                        if(res.data.email_buy == 1){
                            $(".switch-btn").eq(2).children('div:eq(2)').css("left","41px");
                        }else if(res.data.email_buy == 0){
                            $(".switch-btn").eq(2).children('div:eq(2)').css("left","0px");
                        }

                    });

                    //成功登入接收通知开关
                    $(".switch-btn").eq(0).click(function(){
                        var hidePosition = $(this).children('div:eq(2)').css("left");   //获取滑块的位置

                        if(hidePosition == "0px"){            //如果滑块的在左边就让它去右边 （开启）
                            $(this).children('div:eq(2)').css({
                                transition:"left 0.3s",
                                left:"41px",
                                borderRadius:"0 3px 3px 0"
                            });
                            var status1 = 1;
                        }else{                            //否则滑块的在右边就让它去左边 （关闭）
                            $(this).children('div:eq(2)').css({
                                transition:"left 0.3s",
                                left:"0px",
                                borderRadius:"3px 0 0 3px"
                            });
                            var status1 = 0;
                        }

                        var u = 'http://localhost:8081/Home/Setting/emailSet';
                        var	d = {
                            email_login:status1,
                        };
                        $.ajax({
                            url: u,
                            data: d,
                            type: 'post',
                            success: function (res) {

                                if(parseInt(res.code) == 0) {
                                    layer.msg('SUCCESS', {offset:'350px',anim: '0',fixed: 'false',icon : 1});
                                }else{
                                    layer.msg('ERROR', {offset:'350px',anim: '0',fixed: 'false',icon : 2});
                                }
                            }
                        });
                    })

                    //发送接送。接受或支付时接受
                    $(".switch-btn").eq(1).click(function(){
                        var hidePosition = $(this).children('div:eq(2)').css("left");   //获取滑块的位置

                        if(hidePosition == "0px"){            //如果滑块的在左边就让它去右边 （开启）
                            $(this).children('div:eq(2)').css({
                                transition:"left 0.3s",
                                left:"41px",
                                borderRadius:"0 3px 3px 0"
                            });
                            status2 = 1;
                        }else{                            //否则滑块的在右边就让它去左边 （关闭）
                            $(this).children('div:eq(2)').css({
                                transition:"left 0.3s",
                                left:"0px",
                                borderRadius:"3px 0 0 3px"
                            });
                            status2 = 0;
                        }
                        var u = 'http://localhost:8081/Home/Setting/emailSet';
                        var	d = {
                            email_get:status2
                        };
                        $.ajax({
                            url: u,
                            data: d,
                            type: 'post',
                            success: function (res) {

                                if(parseInt(res.code) == 0) {
                                    layer.msg('SUCCESS', {offset:'350px',anim: '0',fixed: 'false',icon : 1});
                                }else{
                                    layer.msg('ERROR', {offset:'350px',anim: '0',fixed: 'false',icon : 2});
                                }
                            }
                        });
                    });
                    //购买比特币时通知
                    $(".switch-btn").eq(2).click(function(){
                        var hidePosition = $(this).children('div:eq(2)').css("left");   //获取滑块的位置

                        if(hidePosition == "0px"){            //如果滑块的在左边就让它去右边 （开启）
                            $(this).children('div:eq(2)').css({
                                transition:"left 0.3s",
                                left:"41px",
                                borderRadius:"0 3px 3px 0"
                            });
                            status3 = 1;
                        }else{                            //否则滑块的在右边就让它去左边 （关闭）
                            $(this).children('div:eq(2)').css({
                                transition:"left 0.3s",
                                left:"0px",
                                borderRadius:"3px 0 0 3px"
                            });
                            status3 = 0;
                        }
                        var u = 'http://localhost:8081/Home/Setting/emailSet';
                        var	d = {
                            email_buy:status3
                        };
                        $.ajax({
                            url: u,
                            data: d,
                            type: 'post',
                            success: function (res) {

                                if(parseInt(res.code) == 0) {
                                    layer.msg('SUCCESS', {offset:'350px',anim: '0',fixed: 'false',icon : 1});
                                }else{
                                    layer.msg('ERROR', {offset:'350px',anim: '0',fixed: 'false',icon : 2});
                                }
                            }
                        });
                    })
                });
            })

            $(".switch-btn").hover(function(){
                $(this).css("cursor","hand")
            })

            //点击跳转
            $(".setting-btn").click(function(){
                window.location.href="http://localhost:8081/Home/Setting/addBasicInformation";
            })

            $(".identity-btn").click(function(){
                window.location.href="http://localhost:8081/Home/Setting/uploadIdCard";
            })

            $(".sell-account-btn").click(function(){
                window.location.href="http://localhost:8081/Home/Setting/bindingBankCard";
            })

            // 绑定手机跳转
            $(".bind-phone").click(function(){
                window.location.href="http://localhost:8081/Home/Setting/updateMobilePhone/type/bind";
            })

            //侧边栏
            $(".sidebar-content-a").css("color","#3397D3");
            $(".sidebar-content-a").eq(3).css("color","#000");
            $(".sidebar-content-a img").eq(0).attr("src","/Public/images/home-active.png");
            $(".sidebar-content-a img").eq(3).attr("src","/Public/images/set-click.png");

        });

        //forbidUpload();
        //禁止重复上传正反面身份证
        function forbidUpload() {
            var forbId_url = 'http://localhost:8081/Home/Setting/forbidUpload';
            $.ajax({
                url: forbId_url,
                type: 'get',
                success: function (res) {
                    console.log('禁止重复上传正反面身份证', res);
                    if(parseInt(res.code) == 0) {
                        $('.identity-btn').html("<?php echo (L("_HINT_TO_AUDIT_")); ?>")
                        $('.identity-btn').attr("disabled",true);
                    }
                    if(parseInt(res.code) == 1){
                        $('.identity-btn').html("<?php echo (L("_HINT_PASS_THE_AUDIT_")); ?>")
                        $('.identity-btn').attr("disabled",true);
                    }
                    if(parseInt(res.code) == -1){
                        $('.identity-btn').html("<?php echo (L("_HINT_AUDIT_FAILED_")); ?>")
                        //$('.identity-btn').attr("disabled",false);

                    }
                }
            })
        }





        // 上传手持身份证
        var hand_Idcard;

        layui.use(['upload', 'layer'], function(){
            var layer = layui.layer;
            var $ = layui.jquery,
                    upload = layui.upload,
                    qnurl = 'http://localhost:8081/Home/Setting/getUpload';

            //上传
            var uploadInst = upload.render({
                elem: '#upload-handId',
                url: qnurl,
                data: {
                    type: "1"
                },
                field: 'imgaddr',
                before: function(obj){
                    //预读本地文件示例，不支持ie8
                    layer.load(2);
                    obj.preview(function(index, file, result) {
                        $('#upload-img').attr('src', result); //图片链接（base64）
                    });
                },
                choose: function() {
                    layer.load(2);
                },
                done: function(res){
                    layer.closeAll();
                    //如果上传失败
                    if(res.code > 0){
                        return layer.msg('<?php echo (L("_HINT_UPLOAD_FAIL_")); ?>',{offset:'350px',anim: '0',fixed: 'false',icon : 2});
                    }
                    //上传成功
                    layer.msg('<?php echo (L("_HINT_PIC_UPLOAD_SUCCESS_")); ?>', {offset:'350px',anim: '0',fixed: 'false',icon : 1});
                    $('#upload-img').css({'display':'block'});
                    hand_Idcard =res.data.file_address;       // 临时保存正面图片路径

                },
                error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#upload-err');
                    demoText.html('<span style="color: #FF5722; margin: 10px 0 0 0; font-weight: bold;"><?php echo (L("_HINT_UPLOAD_FAIL_")); ?></span> <a class="layui-btn layui-btn-radius layui-btn-normal demo-reload"><?php echo (L("_HINT_RETRY_")); ?></a>');

                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });

            judgeIDCard();
            /**
             * 判断正反面身份证有没有上传
             */
            function judgeIDCard() {
                var u = "http://localhost:8081/Home/Setting/checkOrder";
                $.ajax({
                    url: u,
                    type: 'get',
                    success:　function (res) {
                        //console.log('judgeIDCard', res);

                        if (parseInt(res.code) != 0) {
                            $('#handId-btn').attr('disabled', true);     // 上传图片
                            $('#upload-handId').attr('disabled', true);  // 浏览上传图片

                            /*$('#handId-btn').attr('disabled', false);     // 上传图片
                            $('#upload-handId').attr('disabled', false);  // 浏览上传图片*/
                        }
                    }
                });
            }


            //点击上传手持身份证
            $('#handId-btn').click(function(){
                //提示是否确定提交
                layer.open({
                    title: "<?php echo (L("_HINT_MSG_TIPS_")); ?>",
                    offset: 'c',
                    content: "<?php echo (L("_HINT_COMMIT_CONFIRM_")); ?>",
                    btn: 'yes',
                    btnAlign: 'c',
                    fixed: 'false',
                    yes: function (res){
                        layer.closeAll();
                        var hand_url = 'http://localhost:8081/Home/Setting/getuploadIdCard'; // 请求上传手持身份证接口
                        var hand_data = {
                            file_hand: hand_Idcard,      // 手持身份证的url
                        };

                        // 上传手持身份证
                        layer.load(2);
                        $.ajax({
                            url: hand_url,
                            data: hand_data,
                            type: 'post',
                            success: function(res){
                                layer.closeAll();
                                if(parseInt(res.code) == 0) {
                                    layer.msg('<?php echo (L("_HINT_SUBMIT_SUCCESS_")); ?>',{offset:'350px',anim: '0',fixed: 'false',icon : 1});
                                    $('#upload-img').css({'height':'0'});
                                    $('#upload-handId').attr("disabled",true);
                                    //$('#upload-btn').attr("disabled",true);
                                    $('#handId-btn').text('<?php echo (L("_HINT_TO_AUDIT_")); ?>');                                 
									layer.closeAll();
									window.location.reload();
                        	            
                                }else{
                                    layer.msg('<?php echo (L("_HINT_SUBMIT_FAILED_")); ?>！', {offset:'350px',anim: '0',fixed: 'false',icon : 2});
                                }

                            }
                        });
                    }
                });

            });

            var url_getphone = 'http://localhost:8081/Home/Setting/updatePhone';
            $.ajax({
                url: url_getphone,
                type:"get",
                success: function (res) {
                    $('#getPhone').text(res.data.tel);

                    /**
                     * @shen
                     * 判断是否存在电话号码
                     */
                    if ( res.data.tel == ''         ||
                         res.data.tel == null       ||
                         res.data.tel == 'null'     ||
                         res.data.tel == undefined  ||
                         res.data.tel == 'undefined'
                    ) {
                        $('.bind-phone').css('display', 'block');
                    } else {
                        $('.setting-hint-a').css('display', 'block');
                    }
                }
            });
        });

        uploadStatus();
        /**
         * @shen
         * 判断上传身份证当前审核状态
         */
        function uploadStatus() {

            var url = 'http://localhost:8081/Home/Setting/getStatus';
            $.ajax({
                url: url,
                type: 'get',
                success: function (res) {
                    if(parseInt(res.status) == 0) {
                        $('.identity-btn').html("<?php echo (L("_HINT_TO_AUDIT_")); ?>")  // 待审核
                        $('.identity-btn').attr("disabled",true);
                    }
                    if(parseInt(res.status) == 1){
                        $('.identity-btn').html("<?php echo (L("_HINT_PASS_THE_AUDIT_")); ?>");   // 审核通过
                        $('.identity-btn').attr("disabled",true);

                        $('#handId-btn').html("<?php echo (L("_HINT_PASS_THE_AUDIT_")); ?>");     // 审核通过
                        $('#handId-btn').attr("disabled",true);
                        $('#upload-handId').attr("disabled",true);

                        return ;
                    }
                    if(parseInt(res.status) == -1){
                        $('.identity-btn').html("<?php echo (L("_HINT_AUDIT_FAILED_")); ?>")      // 审核不通过
                        $('.identity-btn').attr("disabled",false);
                    }

                    judgeHandIDCard();

                }
            });
        }

        // 禁止重複上傳手持身份證
        function judgeHandIDCard() {
            var forbIdHand_url = 'http://localhost:8081/Home/Setting/forbidUploadHand';
            $.ajax({
                url: forbIdHand_url,
                type: 'get',
                success: function (res) {
                    if(parseInt(res.code) == 0) {
                        $('#handId-btn').html("<?php echo (L("_HINT_TO_AUDIT_")); ?>");    // 待审核
                        $('#handId-btn').attr("disabled", true);
                        $('#upload-handId').attr("disabled", true);

                        return ;
                    }
                        if(res.code == false || res.code == 'false'){
                        //$('#handId-btn').html("<?php echo (L("_HINT_AUDIT_FAILED_")); ?>");   // 审核不通过
                        $('#handId-btn').attr("disabled",false);
                        $('#upload-handId').attr("disabled",false);
                    }

                    if(parseInt(res.code) == -1){
                        $('#handId-btn').html("<?php echo (L("_HINT_AUDIT_FAILED_")); ?>")      // 审核不通过
                        $('#handId-btn').attr("disabled",true);
                        $('#upload-handId').attr("disabled",true);
                    }
                }
            })
        }

    </script>
    
    <script>
    	
    	//银行账号显示
       var bank_url = 'http://localhost:8081/Home/Setting/userBank';
       
       $.ajax({
       	url:bank_url,
       	type:"get",
       	success:function(res){
            console.log(res)
       		if(parseInt(res.code) == 0){
	       	    $('#bank_name').text(res.data[0].bank_account);
	       		$('#bank_number').text(res.data[0].bank_num);
	       		$('#setBank').hide();
	       		$('.bank-hint-a').show();
	       		$('#bank-box').show();
       		}else{
       			$('#setBank').show();
       			$('.bank-hint-a').hide();
	       		$('#bank-box').hide();
       		}
       	}
       })
    </script>


		    </section>
		</div>
	    
	    <footer>
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
	    </footer>
    </div>
</body>