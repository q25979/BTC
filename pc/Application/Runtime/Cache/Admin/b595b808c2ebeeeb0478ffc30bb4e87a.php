<?php if (!defined('THINK_PATH')) exit();?><head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/xy.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/plug-in/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/xadmin.css" />

	<script type="text/javascript" src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://localhost:8081/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/plug-in/layui/layui.js"></script>
	<script type="text/javascript" src="http://localhost:8081/Public/js/xadmin.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/config.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/function.js"></script>
    

	<!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>





<!--logo 样式-->
<link rel="stylesheet" type="text/css" href="/Public/css/topLogo.css" />

<script type="text/javascript" src="http://localhost:8081/Public/js/md5.js"></script>

<style>
	.oldpass,.newpass,.surepass{font-size:16px; margin-left:15%; display:inline-block;}
	.layui-input {display: inline; width: 65%; position: relative; left: 20%; border:1px solid #ddd; font-size:13px; }
	.layui-btn-normal{position: relative; left: 60%; margin: 20px 0 0 0; width: 100px;}
	.changepass {padding: 20px; }
	.sg-btn { margin-right: 10px; }
</style>

<!-- 顶部开始 -->
<div class="container">
	<div class="logo">
		<a href="#">后台管理系统</a>
	</div>
	<div class="left_open">
		<i title="展开左侧栏" class="iconfont">&#xe699;</i>
	</div>
    
	<ul class="layui-nav right" lay-filter="">
		<button class="layui-btn" onclick="refresh()">
			刷新
		</button>
		
		<button class="layui-btn" onclick="informationHint()">
			动态
			<span id="hint" class="layui-badge-dot layui-bg-orange"></span>
		</button>
		<li class="layui-nav-item">
			<a href="javascript:;">管理员</a>
			<dl class="layui-nav-child" style="cursor:pointer;">
				<!-- 二级菜单 -->
				<dd><a onclick="modifyThePassword()">修改密码</a></dd>
				<dd><a onclick="switchAdminAccount(1)">切换帐号</a></dd>
				<dd><a onclick="switchAdminAccount(0)">退出</a></dd>
			</dl>
		</li>
		<li class="layui-nav-item to-index"><a href=""></a></li>
	</ul>
</div>
<!-- 顶部结束 -->

<script>
	$(function() {
		init();
	});

	var init = function() {
		var u = 'http://localhost:8081/Admin/Index/init';

		$.get(u, function(res) {
			if (parseInt(res.count) == 0) return ;
			if (parseInt(res.count) > 0) {
				$('.withdraw').addClass('layui-badge');
				$('.withdraw').text(res.count);
			}
			
			if (parseInt(res.count) > 99) {
				$('.withdraw').text('99+');
			}
		});
	}

	/**
	 * 提现消息提示
	 */
	var withdrawMessgae = function() {
		layer.alert("请您到提现管理下的提现列表进行处理", {
	       btn: [ '我知道了']
	    });
	    $('#hint').hide();
	}

	/**
	 * 刷新
	 */
	var refresh = function() {
		window.parent.location.reload();
	}

	var html = '<div class="changepass">';
		html += '<div class="oldpass">';
		html += '原密码：　'
		html += '<input type="password" class="layui-input" id="oldpass" placeholder="请输入原密码">';
		html += '</div>';
		html += '<hr class="hr15">';
		html += '<div class="newpass">';
		html += '新的密码：';
		html += '<input type="password" class="layui-input" id="newpass" placeholder="请输入新的密码">';
		html += '</div>';
		html += '<hr class="hr15" />';
		html += '<div class="surepass">';
		html += '确认密码：';
		html += '<input type="password" class="layui-input" id="surepass" placeholder="请确认密码">';
		html += '</div>';
		html += '<div><button class="layui-btn layui-btn-normal savepass">保存</button></div>';
		html += '</div>';

	// 修改密码
	function modifyThePassword(){
		layer.open({
			type: 1,
			title: "修改密码",
			area: ['30%', '40%'], //宽高
			resize: false,
			content: html
		});
		// 修改密码保存按钮
		$('.savepass').on('click', function (){
			changepass();
		})
	}

	// 消息提示
	function informationHint(){
		var url = "http://localhost:8081/Admin/Index/informationHint";
	 	$.get(url,function(res){
	 	//配置一个透明的询问框
		    layer.msg("您还有"+res.countOrder+"个待提交订单和"+res.countSend+"个待提交发送单未处理！", {
			       time: 20000, //20s后自动关闭
			       btn: [ '知道了']
		    });
		    $('#hint').hide();
	 	});
	}

	// 切换账号 退出
	function switchAdminAccount(id) {

		if (id) {
			var msg = '切换';
		} else {
			msg = '退出';
		}
		layer.open({
			title: "提示",
			content: "确定要"+ msg +"当前账号吗？",
			btn: ["确定", "取消"],
			yes: function (res) {
				var url = "http://localhost:8081" + "/Admin/Index/logout";

				layer.load(2);
				$.ajax({
					url: url,
					type: 'get',
					success: function (res) {
						layer.closeAll();
						if(parseInt(res.code) == 0) {
							layer.msg( msg + "成功!", {icon: 6}, function (){
								location.reload() || window.location.reload();
							});
						}
					}
				});
			}
		})
	}

	//修改新密码
	function changepass () {

		// 获取原密码，新密码，确认密码
		var oldpass = $('#oldpass').val();
		var newpass = $('#newpass').val();
		var surepass = $('#surepass').val();

		// 正则判断密码是否合法
		var pass=/^[a-zA-Z0-9_-]{6,20}$/;

		if(oldpass == '' || newpass =='' || surepass == '') {
			layer.msg('输入的密码不能为空！', {icon: 2});
			return ;
		}

		if( !pass.test(newpass) ) {
			layer.msg("密码不合法!", { icon :2});
			return ;
		}
		if (newpass != surepass) {
			layer.msg("输入的两次密码不一致!", {icon: 2});
			return ;
		}
		if (oldpass == newpass || oldpass == surepass) {
			layer.msg("新密码和旧密码不能相同！", {icon: 2});
			return ;
		}

		// 请求链接 请求数据
		var url = "http://localhost:8081" + "/Admin/Index/changepass";
		var data = {
			pass_word : hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + $('#oldpass').val()),
			newpass : hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + $('#newpass').val())
		}
		console.log(data);

		layer.load(2);
		// 数据请求
		$.ajax({
			url : url,
			data : data,
			type : 'post',
			success : function(res){
				console.log(res);
				layer.closeAll();

				if(parseInt(res.code) == 0) {
					layer.msg('修改成功！请重新登录！', {icon: 1}, function(){
						// 刷新
						location.reload();
					})
				}else{
					layer.msg('原密码错误！修改失败', {icon : 2});
				}
			}
		})
	}
</script>
<!-- 侧边栏 -->
<div class="left-nav">
  <div id="side-nav">
    <ul id="nav">
        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe620;</i>
                <cite>系统设置</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('System/LogoList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>基本信息</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('System/EmailList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>邮箱接口</cite>
                    </a>
                </li>
                <li id="MSM-result" style="display: none">
                    <a _href="<?php echo U('System/MessageVerify');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>短信验证</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('System/CoinList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>浮动设置</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('System/Exchange');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>汇率设置</cite>
                    </a>
                </li>
                
                <li>
                    <a _href="<?php echo U('System/Company');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>公司管理</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('System/NoticeList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>公告管理</cite>
                    </a>
                </li>

                <li>
                    <a _href="<?php echo U('System/BiscProblem');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>常见问题</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('System/UserProblem');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>用户问题</cite>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe624;</i>
                <cite>银行管理</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Bank/BankList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>银行列表</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('Bank/BankAdd');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>银行添加</cite>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe624;</i>
                <cite>提现管理</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Withdraw/index');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>提现列表</cite>
                    </a>
                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe600;</i>
                <cite>用户账户</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Account/AccountList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>账户列表</cite>
                    </a>
                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;">
                <i class="iconfont">&#xe6af;</i>
                <cite>用户管理</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('User/UserList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>用户列表</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('User/SendList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>用户私信</cite>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="iconfont">&#xe6b8;</i>
                <cite>用户认证</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Attest/AttestList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>认证列表</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('Attest/Examine');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>认证审核</cite>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe698;</i>
                <cite>交易管理</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Order/OrderListAll');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>订单列表</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('Order/OrderList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>订单审核</cite>
                    </a>
                </li>
                <!--<li>-->
                    <!--<a _href="<?php echo U('Order/OrderAudit');?>">-->
                        <!--<i class="iconfont">&#xe6a7;</i>-->
                        <!--<cite>订单确认</cite>-->
                    <!--</a>-->
                <!--</li>-->
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe65e;</i>
                <cite>出售购买</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Trade/TradeList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>浮动设置</cite>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe609;</i>
                <cite>发送管理</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Send/SendListAll');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>发送列表</cite>
                    </a>
                </li>
                <li>
                    <a _href="<?php echo U('Send/SendList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>发送审核</cite>
                    </a>
                </li>
            </ul>
        </li>

        <li id="walletSite" style="display: none">
            <a href="javascript:;">
                <i class="layui-icon">&#xe624;</i>
                <cite>钱包地址</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Walletaddress/WalletaddressList');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>地址列表</cite>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe606;</i>
                <cite>客服管理</cite>
                <i class="iconfont nav_right">&#xe697;</i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a _href="<?php echo U('Service/Service');?>">
                        <i class="iconfont">&#xe6a7;</i>
                        <cite>客服设置</cite>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
  </div>
</div>

<script type="text/javascript">
	switchSite();
	//获取权限，identity为1是显示钱包地址，其他隐藏
	function switchSite(){
		var url_switchSite = "http://localhost:8081/Admin/Index/identity";
		
		$.ajax({
			type:"post",
			url:url_switchSite,
            data: {
                empty: 'yes'
            },
			success:function(res){
				var status = res.data.identity;

				if(parseInt(status) == 1){
					$("#walletSite").css("display","block");
                    $("#MSM-result").css("display","block");
				}else{
					$("#walletSite").css("display","none");
                    $("#MSM-result").css("display","none");
				}
			}
		});
	}
</script>


  <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='http://localhost:8081/Template/admin/welcome.php' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->


<div class="footer">
    <div class="copyright"></div>
</div>