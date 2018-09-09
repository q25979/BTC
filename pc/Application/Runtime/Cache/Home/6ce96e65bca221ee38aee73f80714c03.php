<?php if (!defined('THINK_PATH')) exit();?><head>
	<meta charset="UTF-8">
	<title>Blnance幣淘 港臺數位資產交易平臺</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://blnance66.com/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://blnance66.com/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="http://blnance66.com/Public/css/base.css" />

	<script type="text/javascript" src="http://blnance66.com/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://blnance66.com/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/base64.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/config.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/function.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/jquery.bday-picker.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/plug-in/layui/layui.js"></script>


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
            var url = 'http://blnance66.com/home/PopupWindow/isBuClose';
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

            var url = 'http://blnance66.com/home/PopupWindow/isSvClose';
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
						<a id="login-href" href="http://blnance66.com/Home/Login/index"><?php echo (L("_LOGIN_LOGIN_")); ?></a>
                        <a id="logout-href" href="http://blnance66.com/Home/Login/logout" style="display: none;"><?php echo (L("_ACCOUNT_LOGOUT_")); ?></a>
                        <li @click='jumpMessage()' id="login-bell" style="display: none;">
                            <span class="glyphicon glyphicon-bell"></span>
                            <span id="xy-top-messageminwidth"></span>
                        </li>
	                </li>
	                <li><a href="http://blnance66.com/Home/index/index" id="minwidth1-act"><?php echo (L("_LOGIN_WALLET_")); ?></a></li>
	                <li><a href="http://blnance66.com/Home/RealtimeMarket/index" id="minwidth2-act"><?php echo (L("_LOGIN_CHART_")); ?></a></li>
	                <li><a href="http://blnance66.com/Home/ContactUs/index" id="minwidth3-act"><?php echo (L("_LOGIN_CONTACT_US_")); ?></a></li>
	                <li><a href="http://blnance66.com/Home/Question/index" id="minwidth4-act"><?php echo (L("_LOGIN_FAQ_")); ?></a></li>
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
	                    <li><a href="http://blnance66.com/Home/Index/index" id="indexAct" class="active"><?php echo (L("_LOGIN_WALLET_")); ?></a></li>
	                    <li><a href="http://blnance66.com/Home/RealtimeMarket/index" id="realtimeAct"><?php echo (L("_LOGIN_CHART_")); ?></a></li>
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
									<a href="http://blnance66.com">
										<?php echo (L("_LOGIN_LOGIN_")); ?>
									</a>
								</li>
								<li>
									<a href="http://blnance66.com">
										<?php echo (L("_LOGIN_SIGN_UP_")); ?>
									</a>
								</li>
							</ul>
							<ul class="user-Logout">
								<li>
									<a href="http://blnance66.com/Home/Login/logout">
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

						<li>ETH:{{ ETH }}</li>
						<li>BTC:{{ BTC }}&nbsp;&nbsp;</li>


					</ul>
	            </div>
	
	            <!--宽度过低时的导航栏-->
	            <div class="top-low-width">
	                <div class="top-money-country">
	                    <p>BTC:{{ BTC }}</p>
	                    <p>ETH:{{ ETH }}</p>
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
			setInterval(function() {
				_this.getFloat(_this.currencyType);

			}, 1000 * 30); //1分钟刷新一次

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
				var _this = this;
				var u = 'http://blnance66.com/Home/Login/getFloat';
				var	d = {
						currency_type: id,
						empty: 'yes'
					};
				$.post(u,d,function(res){
					if (id == 1) {
	                	_this.BTC = "NT$"+res.btc_twd;
	                	_this.ETH = "NT$"+res.eth_twd;
	                } else if (id == 2) {
	                	_this.BTC = "HK$"+res.btc_hkd;
	                	_this.ETH = "HK$"+res.eth_hkd;
					} else if (id == 3) {
	                	_this.BTC = "$"+res.btc_usd;
	                	_this.ETH = "$"+res.eth_usd;
					}
				});
			},

			/**
			 * 是登入进去的页面
			 */
			isLogin: function() {
				var u = 'http://blnance66.com/Home/Index/getTopInfo';
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
				sg.jump('http://blnance66.com/Home/MessageTip/index');
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
				window.location.href="http://blnance66.com/Home/Question/index";
			},
			goRelation : function(){//跳转到联系我们
				window.location.href="http://blnance66.com/Home/ContactUs/index";
			},
			changUrl:function(zt){
				var url = "http://blnance66.com/Home/Lang/change";
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

		var logoUrl = "http://blnance66.com/Home/Login/getupdateLogo";

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
								<a href="http://blnance66.com/Home/Index/index" class="nav-a nav-a-first"><?php echo (L("_ACCOUNT_MY_WALLET_")); ?></a>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://blnance66.com/Home/Send/index" class="nav-a"><?php echo (L("_ACCOUNT_SEND_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://blnance66.com/Home/Send/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://blnance66.com/Home/Send/index?type=2">ETH</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://blnance66.com/Home/WalletAddr/receive" class="nav-a"><?php echo (L("_ACCOUNT_RECEIVE_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://blnance66.com/Home/WalletAddr/receive">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://blnance66.com/Home/WalletAddr/receive?type=2">ETH</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://blnance66.com/Home/DealDetails/index" class="nav-a"><?php echo (L("_ACCOUNT_TRANSACTIONS_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://blnance66.com/Home/DealDetails/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://blnance66.com/Home/DealDetails/index?type=2">ETH</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://blnance66.com/Home/Buy/index" class="nav-a"><?php echo (L("_ACCOUNT_BUY_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://blnance66.com/Home/Buy/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://blnance66.com/Home/Buy/index?type=2">ETH</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://blnance66.com/Home/Sell/index" class="nav-a"><?php echo (L("_ACCOUNT_SELL_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://blnance66.com/Home/Sell/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://blnance66.com/Home/Sell/index?type=2">ETH</a></li>
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
		                    <li><a href="http://blnance66.com/Home/Index/index" class="dropdown-a"><?php echo (L("_LOGIN_WALLET_")); ?>&nbsp;</a></li>
		                    <li><a href="http://blnance66.com/Home/Buy/index" class="dropdown-a"><?php echo (L("_ACCOUNT_BUY_")); ?>&nbsp;</a></li>
		                    <li><a href="http://blnance66.com/Home/Sell/index" class="dropdown-a"><?php echo (L("_ACCOUNT_SELL_")); ?>&nbsp;</a></li>
		                    <li><a href="http://blnance66.com/Home/Send/index" class="dropdown-a"><?php echo (L("_ACCOUNT_SEND_")); ?>&nbsp;</a></li>
		                    <li><a href="http://blnance66.com/Home/WalletAddr/receive" class="dropdown-a"><?php echo (L("_ACCOUNT_RECEIVE_")); ?>&nbsp;</a></li>
		                    <li><a href="http://blnance66.com/Home/DealDetails/index" class="dropdown-a"><?php echo (L("_ACCOUNT_TRANSACTIONS_")); ?>&nbsp;</a></li>
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
	        	sg.jump('http://blnance66.com/Home/Index');
	        });
		}
	</script>

	<script>
		getLogo();
		/**
		 * 获取logo
		 */
		function getLogo () {

			var logoUrl = "http://blnance66.com/Home/Login/getupdateLogo";

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
    			<li class="sidebar-content-li"><a href="http://blnance66.com/Home/Index/index" class="sidebar-content-a sidebar-content-hd"><img src="/Public/images/home-click.png" /><?php echo (L("_ACCOUNT_HOME_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://blnance66.com/Home/WalletAddr/receive" class="sidebar-content-a"><img src="/Public/images/wallet-active.png" /><?php echo (L("_ACCOUNT_ADDRESSES_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://blnance66.com/Home/Security/index" class="sidebar-content-a"><img src="/Public/images/safety-active.png" /><?php echo (L("_ACCOUNT_SECURITY_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://blnance66.com/Home/Setting/index" class="sidebar-content-a"><img src="/Public/images/set-active.png" /><?php echo (L("_ACCOUNT_SETTINGS_")); ?></a> <span class="label label-success new-logo">new</span></li>
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
		        
    <!-- 綁定銀行帳戶 -->
    <div class="bankCard col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div style="margin-top: 20px;"><a href="http://blnance66.com/Home/Setting/index"> < <?php echo (L("_ACCOUNT_SETTINGS_BACK_")); ?></a></div>
        <br>
        <h3><?php echo (L("_ACCOUNT_SETTINGS_BANK_SELL")); ?></h3>

        <div class="bank-setting">
            <p class="highlight"><?php echo (L("_ACCOUNT_SETTINGS_CLAUSE_")); ?></p>
            <ul>
                <li><?php echo (L("_ACCOUNT_SETTINGS_CLAUSE_ONE_")); ?></li>
                <!--<li><?php echo (L("_ACCOUNT_SETTINGS_CLAUSE_TWO_")); ?></li>-->
            </ul>
            <p class="highlight"><?php echo (L("_ACCOUNT_SETTINGS_POSTAL_COMPANY_")); ?></p>
            <ul>
                <li><?php echo (L("_ACCOUNT_SETTINGS_POSTAL_CLAUSE_")); ?></li>
            </ul>
        </div>

        <div id="bank_info" autocomplete="off" class="edit-user"data-remote="true">
            <div class="area area-settings">
                <label>
                    <?php echo (L("_ACCOUNT_SETTINGS_BANK_NAME_")); ?>
                </label>
                <div>
					<select id ="bank_select"
							class="form-control"
							name="bank_select"
							lay-verify=""
							style="width: 100%;"
					>
						<option value=''><?php echo (L("_ACCOUNT_SETTINGS_BANK_CHOOSE_")); ?></option>
					</select>   
                </div>
                 <span id="bank-span" class="bank-below-msg"  >
					   <?php echo (L("_HINT_FILL_")); ?>
			     </span>
			     <br />
                <label>
                    <?php echo (L("_ACCOUNT_SETTINGS_BANK_BRANCH_")); ?>:
                </label>
                <!-- v-bind:value = "j.bank_id" -->
                <div>
                	<!-- 分行 -->
	                <!-- <select id = "bank_son_select"
							class="form-control"
							name="bank_son_select"
							lay-verify=""
							style="width: 320px;"
					>
	                	<option value=''><?php echo (L("_ACCOUNT_SETTINGS_BRANCH_CHOOSE_")); ?></option>
					</select> -->
					<input 
						type = "text" 
						placeholder="例：0040118 臺銀高雄"
						id   = "branch" 
					/>
				</div>
                <span id="bank-son-span" class="bank-below-msg"  >
					   <?php echo (L("_HINT_FILL_")); ?>
			     </span>
			     <br />
                <label>
                    <?php echo (L("_ACCOUNT_SETTINGS_BANK_ACCOUNT_")); ?>
                </label>
                <div><input maxlength="150" class="form-control" size="150" id="bank-account-number" name="user[bank-account-number]" type="text"></div>
                <span id="bank-account-number-prompt" class="tip-below-msg" style="display: none;"><?php echo (L("_ACCOUNT_SETTINGS_ACCOUNT_TIPS_")); ?></span>
                <label>
                    <?php echo (L("_ACCOUNT_SETTINGS_BANK_USERNAME_")); ?>
                </label>
                <div><input maxlength="150" class="form-control" size="150" id="bank-account-name" name="user[bank-account-name]" type="text"></div>
                <span id="bank-account-name-prompt" class="tip-below-msg" style="display: none;"><?php echo (L("_ACCOUNT_SETTINGS_USERNAME_TIPS_")); ?></span>
                
                <!--短信验证-->
                <div id="SMS-verification-box">
              		<input value="獲取數位管家驗證碼" class="btn btn-1" id="SMS-verification-btn" type="button">
                	
                	<input maxlength="150" class="form-control" size="150" id="SMS-verification-input" placeholder="请输入短信验证码" type="text">

                </div>
                
                
                <input name="commit" value="<?php echo (L("_ACCOUNT_SETTINGS_SAVE_SETTING_")); ?>" data-disable-with="<?php echo (L("_HINT_TRANSMITTING_")); ?>" class="btn btn-1" id="submit-bank-form" type="submit">
				
				
            </div>

        </div>


    </div>
    
    <script type="text/javascript" src="http://blnance66.com/Public/plug-in/layui/layui.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/plug-in/layer_mobile/layer.js"></script>
    
    <script>
    //获取是否开启短信验证
    var SMScode = 0;
    var SMSstatus = 0;

    // 判断是否开启验证码
    $.get('http://blnance66.com/Home/Setting/msgStatus', function(res) {
    	SMSstatus = parseInt(res.status);

    	// 关闭
    	if (parseInt(res.status) != 0) {
    		$('#SMS-verification-box').css('display', 'none');
    	}
    });	
    
    function invokeSettime(obj){
	    var countdown=60;
	    settime(obj);
	    function settime(obj) {
	        if (countdown == 0) {
	            $(obj).attr("disabled",false);
	            $(obj).val("获取验证码");
	            countdown = 60;
	            return;
	        } else {
	            $(obj).attr("disabled",true);
	            $(obj).val("" + countdown + " s 重新发送");
	            countdown--;
	        }
	        setTimeout(function() {
	            settime(obj) 
	        },1000);
	    }
	}
	
	//获取短信验证码
	$("#SMS-verification-btn").click(function(){
		//判断输入银行账户信息不为空，就获取短信验证码
		if($("#bank_select").val() != "" && $("#branch").val() != "" && $("#bank-account-number").val() != "" && $("#bank-account-name").val() != ""){
			invokeSettime("#SMS-verification-btn");

			var u = 'http://blnance66.com/Home/Setting/sendCode';
	
			// 验证码
			$.get(u, function(res) {
				// 重置全局
				SMScode = res.code;
	
				console.log(res);
				if (res.msg != '发送成功') {
					layer.msg('獲取驗證碼失敗！', {icon: 5});
				}
			});
		}else{
			layer.msg('銀行賬戶信息不能為空！', {icon: 2});
		}
		
	});
    	
    	
    getdata(1,0);
    function getdata(type,id){
		var vm = this;
		var url = "http://blnance66.com/Home/Setting/getBankInfo";
		var data = {
				type : type,
				bank_parent : id
		}
		
		$.get(url,data,function(res){

			if (res.code == 0) {
				if (type == 1) {
					var data = res.data;
					$("#bank_select").empty();
					$("#bank_select").append("<option value=''><?php echo (L("_ACCOUNT_SETTINGS_BANK_CHOOSE_")); ?></option>");
					//如果是主银行名称
					for (i in data) {
						$("#bank_select").append("<option value = "+data[i].bank_id+">"+data[i].bank_name+"</option>");
					}
					
				}else if(type == 2){
					//如果是子类银行名称
					var data = res.data;
					$("#bank_son_select").empty();//清空后再赋值
					$("#bank_son_select").append("<option value=''><?php echo (L("_ACCOUNT_SETTINGS_BRANCH_CHOOSE_")); ?></option>");
					for (i in data) {
						$("#bank_son_select").append("<option value = "+data[i].bank_id+">"+data[i].bank_name+"</option>");
					}
				}

			}else{
				layer.msg('network anomaly', {icon : 2});
			}
		});

	};

	$("#bank_select").change('change',function(){
		if ($("#bank_select").val() != null && $("#bank_select").val() != '') {
			getdata(2,$("#bank_select").val());//获取二级下拉的值
		}	
	});
    	
	layui.use(['layer'], function(){
		var layer = layui.layer;

		$(document).ready(function() {
		     
		    //交互
		    var nonce_str 	= nonceStr(32);
		    $('#submit-bank-form').on('click', function () {
		
				var bankName = $("#bank_select").val();
				var bankSon  = $('#branch').val();
				var accountNumber = $('#bank-account-number').val();
				var accountName = $('#bank-account-name').val();

				//表单正则
//				var userbankReg = /^\d{10,18}$/;
				var accountnameReg = /^\D*$/;

				//表单验证：
				//銀行名稱
				if(bankName == '') {
					$('#bank-span').css({'display':'block'});
					return ;
				} else {
					$('#bank-span').hide();
				}

				//银行分行
				// if(bankSon == '') {
				// 	$('#bank-son-span').css({'display':'block'});
				// 	return ;
				// } else {
				// 	$('#bank-son-span').hide()
				// }

				//銀行帳戶號碼
				if(accountNumber == '') {
					$('#bank-account-number-prompt').css({'display':'block'});
					return ;
				} else {
					$('#bank-account-number-prompt').hide();
				}

				//銀行帳戶名
				if(accountName == '') {
					$('#bank-account-name-prompt').css({'display':'block'});
					return ;
				} else {
					$('#bank-account-name-prompt').hide();
				}

				if (SMSstatus == 0) {
					if ($('#SMS-verification-input').val().length < 3 
						|| $('#SMS-verification-input').val() != SMScode) {

						layer.msg('驗證碼錯誤！', {icon: 5});
						return false;
					}
				}

				var u = 'http://blnance66.com/Home/Setting/Bankcard';
				var	d = {
					bank_name : bankName,
					bank_branch : bankSon,
					
					bank_num : accountNumber, 			  
					bank_account : accountName,

					nonce_str: nonce_str,
					sign: hex_md5('oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1' + accountNumber + nonce_str),
				};

				var old = $('[name=commit]').val()
				sg.loading($('[name=commit]'));
				$.ajax({
					url: u,
					data: d,
					type: 'post',
					success: function (res) {
						console.log(res);
						sg.hideLoading($('[name=commit]'), old);
						if(parseInt(res.code) == 0) {
		                	
		                	layer.msg('<?php echo (L("_HINT_AMEND_SUCCESS_")); ?>', {icon: 1}, function(){
		                    // 刷新
		                     window.location.replace("http://blnance66.com/Home/Setting/index?code=" + res.code);
                            
		                })
		            	}else{
		                	layer.msg('<?php echo (L("_HINT_AMEND_DEFEAT_")); ?>', {icon : 2});
		            	}
					}
				});
			});     
		});
	});
    	
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
    			<a href="http://blnance66.com/Home/PDF/index/type/termsOfUse">
                    <?php echo (L("_LOGIN_TERMS_FOR_USAGE_")); ?>
                </a><span>|</span>
    			<a href="http://blnance66.com/Home/PDF/index/type/privacy">
                    <?php echo (L("_LOGIN_PRIVACY_POLICY_")); ?>
                </a><span>|</span>
    			<a href="http://blnance66.com/Home/Question">
                    <?php echo (L("_FAQ_")); ?></a><span>|</span>
    			<!-- <a href="#">
                    <?php echo (L("_LOGIN_TRANSPARENCY_REPORT_")); ?>
                </a><span>|</span> -->
    			<a href="http://blnance66.com/Home/ContactUs">
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