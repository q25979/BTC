<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>幣淘微平台</title>
	<link rel="stylesheet" href="/Public/home/bocai/common.css" />
	<script src="http://localhost:8081/Public/js/config.js"></script>
	<script src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://localhost:8081/Public/plug-in/layui-v2.3.0/layer/layer.js"></script>
	<script>
		// 判断该使用什么样式 768 900 1080 手机
		var m = navigator.userAgent.match(/IEMobile|BlackBerry|Android|iPod|iPhone|iPad/i)
		// 手机设备
		if (m) window.location.href = '<?php echo U("m");?>'
	</script>
	<script src="/Public/home/bocai/echarts.min.js"></script>
	<script src="https://cdn.bootcss.com/pako/1.0.6/pako.min.js"></script>
	<script src="/Public/home/bocai/kdata.js"></script>
</head>
<body>
	<div class="yi-container">
		<header>
			<ul class="clearfix">
				<li onclick="gohome()">首頁</li>
				<li onclick="onDeal(1)">下注</li>
				<li onclick="onRecord()">交易記錄</li>
			</ul>
		</header>
		<div class="yi-price">
			<ul>
				<li class="yi-number">0.0000</li>
				<li>
					<p class="t">開盤</p>
					<p class="yi-number">0.0000</p>
				</li>
				<li>
					<p class="t">最低</p>
					<p class="yi-number">0.0000</p>
				</li>
				<li>
					<p class="t">最高</p>
					<p class="yi-number">0.0000</p>
				</li>
			</ul>
		</div>
		<div class="yi-time">
			<div id="yi-server-time">00:00:00</div>
			<ul>
				<li>1M</li>
				<li class="active">5M</li>
				<li>15M</li>
				<li>30M</li>
				<li>1H</li>
				<li>1D</li>
			</ul>
		</div>
		<div class="yi-k" id="k"></div>
		<!-- <footer>
			<ul>
				<li onclick="balance()">
					<p><i class="iconfont icon-coins"></i></p>
					<p>餘額</p>
				</li>
				<li onclick="deal(1)">
					<p><i class="iconfont icon-value-"></i></p>
					<p>買漲</p>
				</li>
				<li onclick="deal(2)">
					<p><i class="iconfont icon-devaluation"></i></p>
					<p>買跌</p>
				</li>
				<li onclick="record()">
					<p><i class="iconfont icon-jilu"></i></p>
					<p>交易記錄</p>
				</li>
			</ul>
		</footer> -->
	</div>
</body>
</html>