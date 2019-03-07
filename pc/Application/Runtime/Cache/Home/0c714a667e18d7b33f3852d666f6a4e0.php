<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>幣淘微平台</title>
	<!--强制让文档的宽度与设备的宽度保持1:1，并且文档最大的宽度比例是1.0，且不允许用户点击屏幕放大浏览；--> 
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!--iphone设备中的safari私有meta标签，它表示：允许全屏模式浏览--> 
	<meta content="yes" name="apple-mobile-web-app-capable">
	<!--iphone的私有标签，它指定的iphone中safari顶端的状态条的样式--> 
	<meta content="black" name="apple-mobile-web-app-status-bar-style"> 

	<link rel="stylesheet" href="/Public/home/bocai/iconfont.css" />
	<link rel="stylesheet" href="/Public/home/bocai/m.css" />
	<link rel="stylesheet" href="http://localhost:8081/Public/plug-in/layer_mobile/need/layer.css" />
	<script src="http://localhost:8081/Public/js/config.js"></script>
	<script src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://localhost:8081/Public/js/jquery.cookie.js"></script>
	<script src="http://localhost:8081/Public/js/sonic.js"></script>
	<script src="http://localhost:8081/Public/plug-in/layer_mobile/layer.js"></script>
	<script src="/Public/home/bocai/echarts.min.js"></script>
	<script src="/Public/home/bocai/mkdata.js"></script>
</head>
<body>
	<header>
		<ul class="clearfix">
			<li>首頁</li>
			<li>走勢</li>
			<li>交易記錄</li>
		</ul>
	</header>
	<div class="price">
		<ul class="clearfix">
			<li>
				<span class="title">C</span>
				<span class="number">3252.23</span>
			</li>
			<li>
				<span class="title">O</span>
				<span class="number">3252.23</span>
			</li>
			<li>
				<span class="title">L</span>
				<span class="number">3252.23</span>
			</li>
			<li>
				<span class="title">H</span>
				<span class="number">3252.23</span>
			</li>
		</ul>
	</div>
	
	<div class="timek">
		<ul class="clearfix">
			<li><span class="active">1M</span></li>
			<li><span>5M</span></li>
			<li><span>30M</span></li>
			<li><span>1H</span></li>
			<li><span>1D</span></li>
		</ul>
	</div>

	<div class="container" id="k"></div>

	<div class="dets">
		<div class="execute">
			<div class="balance">账户餘額：<span>0.00</span></div>
			<div class="mt-10">
				<div>執行價</div>
				<div class="number">0.0000</div>
			</div>
			<div class="mt-10">
				<div>成交價</div>
				<div class="number">0.0000</div>
			</div>
		</div>
		<div class="deal">
			<div class="direction border clearfix">
				<div><span>漲</span></div>
				<div><span>跌</span></div>
			</div>
		</div>
	</div>

	<script>
		w.run()
	</script>
</body>
</html>