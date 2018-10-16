<?php if (!defined('THINK_PATH')) exit();?><head>
	<meta charset="UTF-8">
	<title>Blnance幣淘 港臺數位資產交易平臺</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/base.min.css" />

	<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/base64.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/config.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/function.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/jquery.bday-picker.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/plug-in/layui/layui.js"></script>

    <!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>

<link rel="stylesheet" type="text/css" href="/Public/home/css/index.min.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/send/send.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/send/receive.min.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/setting.min.css" />
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
        #announcement, .call-callCenter {display: none !important;}
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
            var url = 'http://192.168.0.128:8081/home/PopupWindow/isBuClose';
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

            var url = 'http://192.168.0.128:8081/home/PopupWindow/isSvClose';
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


    <div id="top">
    	<div id="wrapper">
	        <!-- 侧边栏 -->
	        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
	            <ul class="nav sidebar-nav warpp">
	                <li class="img-login">
	                    <img src="/Public/images/customerService.png" class="get_imglogo">
						<a id="login-href" href="http://192.168.0.128:8081/Home/Login/index"><?php echo (L("_LOGIN_LOGIN_")); ?></a>
                        <a id="logout-href" href="http://192.168.0.128:8081/Home/Login/logout" style="display: none;"><?php echo (L("_ACCOUNT_LOGOUT_")); ?></a>
                        <li @click='jumpMessage()' id="login-bell" style="display: none;">
                            <span class="glyphicon glyphicon-bell"></span>
                            <span id="xy-top-messageminwidth"></span>
                        </li>
	                </li>
	                <li><a href="http://192.168.0.128:8081/Home/index/index" id="minwidth1-act"><?php echo (L("_LOGIN_WALLET_")); ?></a></li>
	                <li><a href="http://192.168.0.128:8081/Home/RealtimeMarket/index" id="minwidth2-act"><?php echo (L("_LOGIN_CHART_")); ?></a></li>
	                <li><a href="http://192.168.0.128:8081/Home/ContactUs/index" id="minwidth3-act"><?php echo (L("_LOGIN_CONTACT_US_")); ?></a></li>
	                <li><a href="http://192.168.0.128:8081/Home/Question/index" id="minwidth4-act"><?php echo (L("_LOGIN_FAQ_")); ?></a></li>
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
	                    <li><a href="http://192.168.0.128:8081/Home/Index/index" id="indexAct" class="active"><?php echo (L("_LOGIN_WALLET_")); ?></a></li>
	                    <li><a href="http://192.168.0.128:8081/Home/RealtimeMarket/index" id="realtimeAct"><?php echo (L("_LOGIN_CHART_")); ?></a></li>
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
									<a href="http://192.168.0.128:8081">
										<?php echo (L("_LOGIN_LOGIN_")); ?>
									</a>
								</li>
								<li>
									<a href="http://192.168.0.128:8081">
										<?php echo (L("_LOGIN_SIGN_UP_")); ?>
									</a>
								</li>
							</ul>
							<ul class="user-Logout">
								<li>
									<a href="http://192.168.0.128:8081/Home/Login/logout">
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
				var u = 'http://192.168.0.128:8081/Float/Index/getdata';
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
				var u = 'http://192.168.0.128:8081/Home/Index/getTopInfo';
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
				sg.jump('http://192.168.0.128:8081/Home/MessageTip/index');
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
				window.location.href="http://192.168.0.128:8081/Home/Question/index";
			},
			goRelation : function(){//跳转到联系我们
				window.location.href="http://192.168.0.128:8081/Home/ContactUs/index";
			},
			changUrl:function(zt){
				var url = "http://192.168.0.128:8081/Home/Lang/change";
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
		var logoUrl = "http://192.168.0.128:8081/Home/Login/getupdateLogo";

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
				<style>
					.gambling { color: red !important; font-weight: bold; }
					.gambling:hover { color: red; }
				</style>
				<div class="nav-container col-md-9 col-sm-9 col-xs-12" id="navCo">
					<ul class="nav-ul" id="xy-nav-ul">
						<li class="nav-li">
							<div class="li-content">
								<a href="http://192.168.0.128:8081/Home/Index/index" class="nav-a nav-a-first"><?php echo (L("_ACCOUNT_MY_WALLET_")); ?></a>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.128:8081/Home/Send/index" class="nav-a"><?php echo (L("_ACCOUNT_SEND_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.128:8081/Home/Send/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.128:8081/Home/Send/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.128:8081/Home/WalletAddr/receive" class="nav-a"><?php echo (L("_ACCOUNT_RECEIVE_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.128:8081/Home/WalletAddr/receive">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.128:8081/Home/WalletAddr/receive?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.128:8081/Home/DealDetails/index" class="nav-a"><?php echo (L("_ACCOUNT_TRANSACTIONS_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.128:8081/Home/DealDetails/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.128:8081/Home/DealDetails/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.128:8081/Home/Buy/index" class="nav-a"><?php echo (L("_ACCOUNT_BUY_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.128:8081/Home/Buy/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.128:8081/Home/Buy/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li dropdown">
							<div class="li-content">
								<a href="http://192.168.0.128:8081/Home/Sell/index" class="nav-a"><?php echo (L("_ACCOUNT_SELL_")); ?></a>
								<span class="glyphicon glyphicon-triangle-bottom nav-span" class="dropdown-toggle nav-span" data-toggle="dropdown"></span>
				                <ul class="dropdown-menu Spinner">
				                    <li><a href="http://192.168.0.128:8081/Home/Sell/index">BTC</a></li>
				                    <li class="divider"></li>
				                    <li><a href="http://192.168.0.128:8081/Home/Sell/index?type=2">LTC</a></li>
				                </ul>
							</div>
						</li>
						<li class="nav-li">
							<div class="li-content">
								<a href="http://192.168.0.128:8081/Home/Bocai/index" class="nav-a gambling">微平台</a>
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
		                    <li><a href="http://192.168.0.128:8081/Home/Index/index" class="dropdown-a"><?php echo (L("_LOGIN_WALLET_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.128:8081/Home/Buy/index" class="dropdown-a"><?php echo (L("_ACCOUNT_BUY_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.128:8081/Home/Sell/index" class="dropdown-a"><?php echo (L("_ACCOUNT_SELL_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.128:8081/Home/Send/index" class="dropdown-a"><?php echo (L("_ACCOUNT_SEND_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.128:8081/Home/WalletAddr/receive" class="dropdown-a"><?php echo (L("_ACCOUNT_RECEIVE_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.128:8081/Home/DealDetails/index" class="dropdown-a"><?php echo (L("_ACCOUNT_TRANSACTIONS_")); ?>&nbsp;</a></li>
		                    <li><a href="http://192.168.0.128:8081/Home/Bocai/index" class="dropdown-a gambling">微平台&nbsp;</a></li>
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
	        	sg.jump('http://192.168.0.128:8081/Home/Index');
	        });
		}
	
		/**
		 * 获取logo
		 */
		function getLogo () {
			var logoUrl = "http://192.168.0.128:8081/Home/Login/getupdateLogo";
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
    			<li class="sidebar-content-li"><a href="http://192.168.0.128:8081/Home/Index/index" class="sidebar-content-a sidebar-content-hd"><img src="/Public/images/home-click.png" /><?php echo (L("_ACCOUNT_HOME_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://192.168.0.128:8081/Home/WalletAddr/receive" class="sidebar-content-a"><img src="/Public/images/wallet-active.png" /><?php echo (L("_ACCOUNT_ADDRESSES_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://192.168.0.128:8081/Home/Security/index" class="sidebar-content-a"><img src="/Public/images/safety-active.png" /><?php echo (L("_ACCOUNT_SECURITY_")); ?></a></li>
    			<li class="sidebar-content-li"><a href="http://192.168.0.128:8081/Home/Setting/index" class="sidebar-content-a"><img src="/Public/images/set-active.png" /><?php echo (L("_ACCOUNT_SETTINGS_")); ?></a> <span class="label label-success new-logo">new</span></li>
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
		        
	<link rel="stylesheet" type="text/css" href="/Public/home/css/sell.css" />
	
	<div class="content-sell col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<!--头部标签开始-->
		<!--选项卡容器-->
		<div class="buy-tab">
			<!--选项卡1-->
			<div class="tab1" onclick="getSell(1)">
				<a href="javascript:;" class="buy-BTC"><?php echo (L("_ACCOUNT_SELL_BTC_")); ?></a>
			</div>
			<!--选项卡2-->
			<div class="tab2" onclick="getSell(2)">
				<a href="javascript:;" class="buy-ETC"><?php echo (L("_ACCOUNT_SELL_ETH_")); ?></a>
			</div>
		</div>
		<!--头部标签结束-->
		<!--比特币区域开始-->
		<div class="sell-info-btc">
			<!--价格信息开始-->
			<div class="sell-cost-box">
				<p>
					<span class="ico-point">•</span> <?php echo (L("_ACCOUNT_SELL_BTC_PRICE_")); ?>
					<span class="sell-cost"><span id="sell-btc-price"></span> <br></span>
					<span class="sell-balance"> <?php echo (L("_ACCOUNT_SEND_BALANCE_")); ?><b> <span id="sell-btc-balance"></span> BTC</b></span>
					<span class="cashBalance"><?php echo (L("_HINT_EXTRACT_ENOUGH_")); ?>:<b>NT$ <span class="cashBalance1"></span></b></span>
				</p>
			</div>
			<!--价格信息结束-->
			<!--比特币出售开始-->
			<div class="sell-area">
				<div class="price-widget">
					<div class="form-group">
						<label class="sell-label" for="InputSell"><?php echo (L("_ACCOUNT_SELL_BTC_")); ?></label>
						<input id="sell-one-btc"  class="form-control" name="coin" autocomplete="off" placeholder="0.00" onkeyup="clearNoNum(this);">
						<span class="currency-inner">BTC</span>
					</div>
					<div class="ico-sanjiao">
						<span class="glyphicon glyphicon-triangle-left"></span><span class="glyphicon glyphicon-triangle-right"></span>
					</div>
					<div class="form-group">
						<label class="sell-label" for="InputSell"><?php echo (L("_ACCOUNT_SELL_RECEIVE_TWD_")); ?></label>
						<input id="sell-one-twd" class="form-control" name="coin" autocomplete="off" placeholder="0.00" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}">
						<span class="currency-inner changeCoin">TWD</span>
					</div>
				</div>
				<!--按钮区-->
                <div class="sell-button-p">
                	<button  id="sell-submit1" class="btn btn-sell disabled" name="commit" type="button" disabled="disabled"/><?php echo (L("_ACCOUNT_SELL_BTC_")); ?></button>
				    <!--<div class="sell-button-info"><?php echo (L("_ACCOUNT_SELL_BALANCE_")); ?></div>-->
                </div>
				

				<div class="sell-bank">
					<div class="bank-notice clearfix">
						<?php echo (L("_ACCOUNT_SELL_ADD_BANK_TIPS_")); ?>
						<a href="http://192.168.0.128:8081/Home/Setting/bindingBankCard"><?php echo (L("_ACCOUNT_SELL_ADD_BANK_")); ?></a>
						<a href="http://192.168.0.128:8081/Home/Setting/index"><?php echo (L("_ACCOUNT_BUY_BTC_ID_VER_")); ?></a>
					</div>
					<small class="bank-notice clearfix"><?php echo (L("_ACCOUNT_SELL_LIMIT_")); ?>NT$5,000,000</small>
					<small class="bank-notice clearfix"><?php echo (L("_ACCOUNT_SELL_TIPS_")); ?></small>
				</div>
			</div>
			<!--比特币出售结束-->
		</div>
		<!--比特币区块结束-->

		<!--以太币区块开始-->
		<div class="sell-info-eth">
			<!--价格信息开始-->
			<div class="sell-cost-box">
				<p>
					<span class="ico-point">•</span> <?php echo (L("_ACCOUNT_SELL_BTC_PRICE_")); ?>
					<span class="sell-cost"><span id="sell-eth-price"></span></span>
					<span class="sell-balance"><?php echo (L("_ACCOUNT_SEND_BALANCE_")); ?><b><span id="sell-eth-balance"></span> LTC</b></span>
					<span class="cashBalance"><?php echo (L("_HINT_EXTRACT_ENOUGH_")); ?>:<b>NT$ <span class="cashBalance1"></span></b></span>
				</p>
			</div>
			<!--价格信息结束-->
			<!--以太币出售开始-->
			<div class="sell-area">
				<div class="price-widget">
					<div class="form-group">
						<label class="sell-label" for="InputSell"><?php echo (L("_ACCOUNT_SELL_ETH_")); ?></label>
						<input id="sell-two-btc" class="form-control" name="coin" autocomplete="off" placeholder="0.00" onkeyup="clearNoNum(this);">
						<span class="currency-inner">LTC</span>
					</div>
					<div class="ico-sanjiao">
						<span class="glyphicon glyphicon-triangle-left"></span><span class="glyphicon glyphicon-triangle-right"></span>
					</div>
					<div class="form-group">
						<label class="sell-label" for="InputSell"><?php echo (L("_ACCOUNT_SELL_RECEIVE_TWD_")); ?></label>
						<input id="sell-two-twd" class="form-control" name="coin" autocomplete="off" placeholder="0.00" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}">
						<span class="currency-inner changeCoin">TWD</span>
					</div>
				</div>
                <!--按钮区-->
				<div class="sell-button-p">
                	<button  id="sell-submit2" class="btn btn-sell disabled" name="commit" type="button" disabled="disabled"/><?php echo (L("_ACCOUNT_SELL_ETH_")); ?></button>
				    <!--<div class="sell-button-info"><?php echo (L("_ACCOUNT_SELL_BALANCE_")); ?></div>-->
                </div>

				<div class="sell-bank">
					<div class="bank-notice clearfix">
						<?php echo (L("_ACCOUNT_SELL_ADD_BANK_TIPS_")); ?>
						<a href="http://192.168.0.128:8081/Home/Setting/bindingBankCard"><?php echo (L("_ACCOUNT_SELL_ADD_BANK_")); ?></a>
						<a href="http://192.168.0.128:8081/Home/Setting/index"><?php echo (L("_ACCOUNT_BUY_BTC_ID_VER_")); ?></a>
					</div>
					<small class="bank-notice clearfix"><?php echo (L("_ACCOUNT_SELL_LIMIT_")); ?>NT$5,000,000</small>
					<small class="bank-notice clearfix"><?php echo (L("_ACCOUNT_SELL_TIPS_")); ?></small>
				</div>
			</div>
			<!--以太币出售结束-->
		</div>
		<!--以太币区块结束-->

	</div>
	<!--头部标签切换js-->
	<script type="text/javascript">
		$(function(){
    		if(GetRequest().type == 2){
	            $(".buy-ETC").css({
	                textDecoration:"none",
	                color:"#000"
	            });
	            $(".tab2").css({
	                backgroundColor:"#fff",
	                borderBottom:"1px solid #fff"
	            });
	            $(".tab1").css({
	                backgroundColor:"#F0EFEE",
	                borderBottom:"1px solid #ddd"
	            });
	            $(".buy-ETC").mouseover(function(){
	                $(".buy-ETC").css("color","#000");
	            });
				$(".sell-info-btc").css({
					"display": "none"
				})
				$(".sell-info-eth").css({
					"display": "block"
				})
				
				getSell(2);
        	}
    	});

    	function GetRequest() {//获取get请求后面的参数
	        var url = location.search; //获取url中"?"符后的字串
	        var theRequest = new Object();
	        if (url.indexOf("?") != -1) {
	            var str = url.substr(1);
	            strs = str.split("&");
	            for(var i = 0; i < strs.length; i ++) {
	                theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
	            }
	        }
	        return theRequest;
		}
		
		$(function() {
			$(".buy-BTC").click(function() {
				$(this).css({ textDecoration: "none", color: "#000" });
				$(".tab1").css({ backgroundColor: "#fff", borderBottom: "1px solid #fff" });
				$(".tab2").css({ backgroundColor: "#F0EFEE", borderBottom: "1px solid #ddd" });
				$(this).mouseover(function() { $(this).css("color", "#000") });
				$(".sell-info-btc").css({ "display": "block" });
				$(".sell-info-eth").css({ "display": "none" })
			});

			$(".buy-ETC").click(function() {
				$(this).css({
					textDecoration: "none",
					color: "#000"
				});

				$(".tab2").css({
					backgroundColor: "#fff",
					borderBottom: "1px solid #fff"
				});

				$(".tab1").css({
					backgroundColor: "#F0EFEE",
					borderBottom: "1px solid #ddd"
				});

				$(this).mouseover(function() {
					$(this).css("color", "#000")
				});
				$(".sell-info-btc").css({
					"display": "none"
				});
				$(".sell-info-eth").css({
					"display": "block"
				})
			})
		});
		
        //控制一级菜单的点击事件
		$(".nav-a").css("color","#3388BB");
		$(".nav-span").css("color","#3388BB");
		$(".nav-a").css("border-bottom","2px solid #fff");
		
		$(".nav-a").eq(5).css("color","#000");
		$(".nav-span").eq(4).css("color","#000");
		$(".nav-span").eq(5).next().css("color","#000");
		$(".nav-a").eq(5).css("border-bottom","2px solid #3388BB");
		
		
    	var BtcSellPrice; //比特币单价
    	var EthSellPrice; //以太币单价
    	
    	var BtcSellBalance; //比特币余额
    	var EthSellBalance; //以太币余额
        
        var btc_sell_number; //btc数量
        var btc_sell_price; //btc总价格
       
        var eth_sell_number; //eth数量
        var eth_sell_price; //eth总价格
		
		//获取单价和余额
        getSell(1);
		function getSell(id) {
            var url_sell = 'http://192.168.0.128:8081/Home/Sell/getSellBalance';
            var data_sell = {
            	currency_type: id
			};	
			
			$.ajax({
	            url: url_sell,
	            data: data_sell,
	            type: 'post',
	            success: function(res){
	                if(parseInt(res.code) == 0) {
	                	if (id == 1){
	                    	$('#sell-btc-balance').html(res.data[0].btc_balance);//BTC余额
	                    	BtcSellBalance = res.data[0].btc_balance; //比特币余额
	                    	$(".cashBalance1").html(res.data[1].extract_balance);
	                	} else if (id == 2) {
		                    $('#sell-eth-balance').html(res.data[0].eth_balance);//ETH余额
		                    EthSellBalance = res.data[0].eth_balance; //比特币余额
		                    $(".cashBalance1").html(res.data[1].extract_balance);
	                	}
	                	
	                }
	            }
	        });
    	}
		
		var sellStatus = false; //是否拥有出售全新状态
		
		//检查身份是否验证
		authentication();
		function authentication() {
            var url_authentication = 'http://192.168.0.128:8081/Home/Sell/check';
			
			$.ajax({
	            url: url_authentication,
				type: 'get',
	            success: function(res){
	                if(res.code == "拥有出售权限！") {
	                	sellStatus = true;
	                }
	            }
	        });
    	}
		
		//出售比特币左输入框 数量
        $("#sell-one-btc").keyup (function(){
		    btc_sell_number = $("#sell-one-btc").val();
		    btc_sell_price = btc_sell_number*BtcSellPrice;
		    $("#sell-one-twd").val(parseFloat(btc_sell_price).toFixed(2));
		    BtcSellNotNull("#sell-one-btc","#sell-one-twd","#sell-submit1",sellStatus);
		    BtcSellNull("#sell-one-btc","#sell-one-twd","#sell-submit1",sellStatus);
		});
		
		//出售比特币右输入框 价格
        $("#sell-one-twd").keyup (function(){
		    btc_sell_price = $("#sell-one-twd").val();
		    btc_sell_number = btc_sell_price/BtcSellPrice;
		    $("#sell-one-btc").val(parseFloat(btc_sell_number).toFixed(4));
		    BtcSellNotNull("#sell-one-btc","#sell-one-twd","#sell-submit1",sellStatus);
		    BtcSellNull("#sell-one-btc","#sell-one-twd","#sell-submit1",sellStatus);
		});
		
		//判断文本框不为空
		function BtcSellNotNull(leftID,rightID,btn,status){
			var SelltextLeft = $(leftID).val();
			var SelltextRight = $(rightID).val();
			
			if(SelltextLeft != "" && SelltextRight != "" && status){
				$(btn)
				.removeAttr('disabled')
				.removeClass('disabled')
				.css({
				    background: "#5AC",
				    boxShadow: "inset 0 -3px 0 #18A",
				    color: "#fff",
				    borderRadius: "5px",
				    textAlign: "center",
				    marginTop:"20px"
				})
				.hover(function(){
					$(btn).css("background","#4499BB");
				},function(){
					$(btn).css("background","#5AC");
				});
			}
		}
		
		//判断文本框为空
		function BtcSellNull(leftID,rightID,btn,status){
			var SelltextLeft = $(leftID).val();
			var SelltextRight = $(rightID).val();
				
			if(SelltextLeft == "" || SelltextRight == "" && status){
				$(leftID).val("");
				$(rightID).val("");
				
				$(btn).attr('disabled',true);
				$(btn).addClass('disabled');
				$(btn).css({
				    background: "#ddd",
				    boxShadow: "inset 0 -3px 0 #AAA",
				    color: "#fff",
				    borderRadius: "5px",
				    textAlign: "center",
				    marginTop:"20px"
				})
				.hover(function(){
					$(btn).css("background","#ddd");
				},function(){
					$(btn).css("background","#ddd");
				});
			}
		}
		
		//出售以太币左输入框 数量
        $("#sell-two-btc").keyup (function(){
		    eth_sell_number = $("#sell-two-btc").val();
		    eth_sell_price = eth_sell_number*EthSellPrice;
		    $("#sell-two-twd").val(parseFloat(eth_sell_price).toFixed(2));
		    BtcSellNotNull("#sell-two-btc","#sell-two-twd","#sell-submit2",sellStatus);
		    BtcSellNull("#sell-two-btc","#sell-two-twd","#sell-submit2",sellStatus);
		});
		
		//出售以太币右输入框 价格
        $("#sell-two-twd").keyup (function(){
		    eth_sell_price = $("#sell-two-twd").val();
		    eth_sell_number = eth_sell_price/EthSellPrice;
		    $("#sell-two-btc").val(parseFloat(eth_sell_number).toFixed(4));
		    BtcSellNotNull("#sell-two-btc","#sell-two-twd","#sell-submit2",sellStatus);
		    BtcSellNull("#sell-two-btc","#sell-two-twd","#sell-submit2",sellStatus);
		});
		
		$(".text-content").html("<?php echo (L("_ACCOUNT_SELL_")); ?>&nbsp;");
		
		
		var number;  //数量
		var price;  //总价
		var money_currency_type; //新台币
		var unit_price; //单价
		var currency_type; //币种
		var nonce_str; //随机32个随机数
		
		//出售比特币按钮
		$("#sell-submit1").click(function(){
			number = $("#sell-one-btc").val();  //数量
			price = number*BTCPrice;  //总价
			money_currency_type = 1; //新台币
			unit_price = BtcSellPrice; //单价
			currency_type = 1; //币种
			nonce_str = nonceStr(32); //随机32个随机数
			
			var btnName = $(this).html();
			
			if(parseFloat(number)  <= parseFloat(BtcSellBalance) && number > 0 && price > 0){
				
				sg.loading($('#sell-submit1'));
				
				SellVirtualCurrency(number,price,money_currency_type,unit_price,currency_type,nonce_str,function(res){
					sg.hideLoading($('#sell-submit1'), btnName);
					
					if (res.code == 0) {
                        alert("<?php echo (L("_HINT_BTC_SELL_OK_")); ?>");
						window.location.href = "http://192.168.0.128:8081/Home/DealDetails/index";
                    } else {
                        // 会失败
                        alert("<?php echo (L("_HINT_BTC_BALANCE_NOT_")); ?>");
                    }
				});
			}else{
				alert("<?php echo (L("_HINT_BTC_BALANCE_NOT_")); ?>");
				$("#sell-one-btc").val("");
				BtcSellNull("#sell-one-btc","#sell-one-twd","#sell-submit1",sellStatus);
			}
		})
		
		//出售以太币按钮
		$("#sell-submit2").click(function(){
			number = $("#sell-two-btc").val();  //数量
			price =  number*ETHPrice;  //总价
			money_currency_type = 1; //新台币
			unit_price = EthSellPrice; //单价
			currency_type = 2; //币种
			nonce_str = nonceStr(32); //随机32个随机数
			
			var btnName = $(this).html();
			
			if(parseFloat(number)  <= parseFloat(EthSellBalance) && number > 0 && price > 0){
				
				sg.loading($('#sell-submit2'));
				
				SellVirtualCurrency(number,price,money_currency_type,unit_price,currency_type,nonce_str,function(res){
					sg.hideLoading($('#sell-submit2'), btnName);
					
					if (res.code == 0) {
                        alert("<?php echo (L("_HINT_ETH_SELL_OK_")); ?>");
						window.location.href = "http://192.168.0.128:8081/Home/DealDetails/index?type=2";
                    } else {
                        // 会失败
                        alert("<?php echo (L("_HINT_ETH_BALANCE_NOT_")); ?>");
                    }
				});
				
			}else{
				alert("<?php echo (L("_HINT_ETH_BALANCE_NOT_")); ?>");
				$("#sell-two-btc").val("");
				BtcSellNull("#sell-two-btc","#sell-two-twd","#sell-submit2",sellStatus);
			}
			
		})
		
		//定义方法发送数据
		function SellVirtualCurrency(number,price,money_currency_type,unit_price,currency_type,nonce_str,callback) {
            var url_sellVirtualCurrency = 'http://192.168.0.128:8081/Home/Sell/sellCoin';
            var data = {
            	number: number,
            	price: price,
            	money_currency_type: money_currency_type,
            	unit_price: unit_price,
            	currency_type: currency_type,
            	nonce_str: nonce_str
            }
            var btype = parseInt($.cookie('btc_float_value')) // 币种类型 1-台币 2-港币 3-美金

			sg.exchange(function(res) {
				// 转为新台币
				let hkd = parseFloat(res.hkd),
					twd = parseFloat(res.twd),
					usd = parseFloat(res.usd),
					ftmp = 0 	// 临时

				if (btype == 1) ftmp = twd 
				if (btype == 2) ftmp = hkd
				if (btype == 3) ftmp = usd
				data.unit_price = parseFloat(data.unit_price)*twd/ftmp
				data.price = (parseFloat(data.price)*twd/ftmp).toFixed(4)

				data.sign = hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + data.currency_type + data.money_currency_type + data.nonce_str + data.number + data.price + data.unit_price)
				$.post(url_sellVirtualCurrency, data, function(res) {
					console.log(res)
					callback(res)
				})
			})
    	}
		
		var BTCPrice;
		var ETHPrice;
		// 2s获取一次数据---------------------------------------------------------------
        setInterval(function() { 
            getValue() 
        }, 2000);
        // 获取实际价格
        function getValue() {
            // 2s
            let btc_btc_value = $.cookie('btc_btc_value'),
                btc_eth_value = $.cookie('btc_eth_value'),
                realtimeIndex = $.cookie('btc_float_value') // 缓存的币种
            let type = 'TWD', currency = 'NT$ '
            if (realtimeIndex == 2) { 
                type = 'HKD'
                currency = 'HKD$ '
            }
            if (realtimeIndex == 3) {
                type = 'USD'
                currency = 'USD$ '
            }

            $('.changeCoin').text(type);
            BtcSellPrice = parseFloat(btc_btc_value).toFixed(4)
            EthSellPrice = parseFloat(btc_eth_value).toFixed(4)
            BTCPrice = BtcSellPrice
            ETHPrice = EthSellPrice
            
            $('#sell-btc-price').html(currency + BtcSellPrice);
            $('#sell-eth-price').html(currency + EthSellPrice);

            let twd = parseFloat($('#sell-one-btc').val()) * BtcSellPrice
            let twdother = parseFloat($('#sell-two-btc').val()) * EthSellPrice
            // 比特币,输入框
            sg.isEmpty($('#sell-one-btc').val())
                ? ''
                : $('#sell-one-twd').val(parseFloat(twd).toFixed(2))

            // 莱特币,输入框
            sg.isEmpty($('#sell-two-btc').val())
                ? ''
                : $('#sell-two-twd').val(parseFloat(twdother).toFixed(2))
        }
		
		function clearNoNum(obj){
        	obj.value = obj.value.replace(/^\./g,"");  //不能以点开头
		    obj.value = obj.value.replace(/[^\d.]/g,"");  //清除“数字”和“.”以外的字符  
		    obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的  
		    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); 
		    obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d\d\d).*$/,'$1$2.$3');//只能输入4个小数  
		    if(obj.value.indexOf(".")< 0 && obj.value !=""){//以上已经过滤，此处控制的是如果没有小数点，首位不能为类似于 01、02的金额 
		        obj.value= parseFloat(obj.value); 
		    } 
		}

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
    			<a href="http://192.168.0.128:8081/Home/PDF/index/type/termsOfUse">
                    <?php echo (L("_LOGIN_TERMS_FOR_USAGE_")); ?>
                </a><span>|</span>
    			<a href="http://192.168.0.128:8081/Home/PDF/index/type/privacy">
                    <?php echo (L("_LOGIN_PRIVACY_POLICY_")); ?>
                </a><span>|</span>
    			<a href="http://192.168.0.128:8081/Home/Question">
                    <?php echo (L("_FAQ_")); ?></a><span>|</span>
    			<!-- <a href="#">
                    <?php echo (L("_LOGIN_TRANSPARENCY_REPORT_")); ?>
                </a><span>|</span> -->
    			<a href="http://192.168.0.128:8081/Home/ContactUs">
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