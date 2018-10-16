<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>幣淘微平台</title>
	<link rel="stylesheet" href="/Public/home/bocai/iconfont.css" />
	<link rel="stylesheet" href="/Public/home/bocai/common.css" />
	<link rel="stylesheet" id="device" />
	<script src="http://192.168.0.128:8081/Public/js/config.js"></script>
	<script src="http://192.168.0.128:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://192.168.0.128:8081/Public/plug-in/layui-v2.3.0/layui/layui.js"></script>
	<script>
		// 判断该使用什么样式 768 900 1080 手机
		var iWh = $(window).height();
		var m = navigator.userAgent.match(/IEMobile|BlackBerry|Android|iPod|iPhone|iPad/i);
		if (iWh < 1000 && !m) {
			$("#device").attr("href", "/Public/home/bocai/midding.css")
		}

		// 手机设备
		if (m) {
			$("#device").attr("href", "/Public/home/bocai/m.css")
		}
	</script>
	<script src="/Public/home/bocai/echarts.min.js"></script>
	<script src="/Public/home/bocai/kdata.js"></script>
</head>
<body>
	<i class="iconfont icon-load" id="k-load"></i>
	<div class="yi-container">
		<header>
			<i class="iconfont icon-back k-back" title="回到首頁" onclick="gohome()"></i>
			<h3>比特幣</h3>
		</header>
		<div class="yi-price">
			<ul>
				<li class="yi-number">6546.1254</li>
				<li>
					<p class="t">開盤</p>
					<p class="yi-number">6394.45</p>
				</li>
				<li>
					<p class="t">最低</p>
					<p class="yi-number">6394.22</p>
				</li>
				<li>
					<p class="t">最高</p>
					<p class="yi-number">6539.29</p>
				</li>
			</ul>
		</div>
		<div class="yi-time">
			<div id="yi-server-time">11:42:33</div>
			<ul>
				<li class="active">1M</li>
				<li>5M</li>
				<li>15M</li>
				<li>30M</li>
				<li>1H</li>
				<li>1D</li>
			</ul>
		</div>
		<div class="yi-k" id="k"></div>
		<footer>
			<ul>
				<li onclick="balance()">
					<p><i class="iconfont icon-coins"></i></p>
					<p>餘額</p>
				</li>
				<li onclick="">
					<p><i class="iconfont icon-value-"></i></p>
					<p>買漲</p>
				</li>
				<li onclick="">
					<p><i class="iconfont icon-devaluation"></i></p>
					<p>買跌</p>
				</li>
				<li onclick="">
					<p><i class="iconfont icon-jilu"></i></p>
					<p>交易記錄</p>
				</li>
			</ul>
		</footer>
	</div>
</body>
</html>