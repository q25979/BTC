<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($title); ?></title>
	<link rel="stylesheet" href="/Public/home/bocai/iconfont.css" />
	<link rel="stylesheet" href="/Public/home/bocai/deal.css" />
	<link rel="stylesheet" href="http://192.168.0.137:8081/Public/plug-in/layui-v2.3.0/layui/css/layui.css" />
	<script src="http://192.168.0.137:8081/Public/js/config.js"></script>
	<script src="http://192.168.0.137:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://192.168.0.137:8081/Public/js/jquery.cookie.js"></script>
	<script src="http://192.168.0.137:8081/Public/plug-in/layui-v2.3.0/layui/layui.js"></script>
	<script src="/Public/home/bocai/deal.js"></script>
</head>
<body>
	<div class="deal-container">
		<div class="l fl clearfix">
			<div class="time fl">
				<div class="mb-3">倒計時</div>
				<div>00:00</div>
			</div>

			<div class="execute fr">
				<div class="t">
					<div>
						<div class="mb-3">現價</div>
						<div class="label-bg now-price">00.00</div>
					</div>
					<div id="executePrice">
						<div class="mb-3">執行價</div>
						<div class="label-bg">00.00</div>
					</div>
					<div id="lastPrice">
						<div class="mb-3">成交價</div>
						<div class="label-bg">00.00</div>
					</div>
				</div>
				<div class="b">
					<div>
						<div class=>當前期數</div>
						<div class="label-bg" id="openNumber">00</div>
					</div>
				</div>
			</div>

			<div class="order fl">
				<table class="layui-table" id="log"></table>
			</div>
		</div>
		<div class="r fr">
			<div class="money">
				<div class="mb-6">下注金額</div>
				<div class="number">
					<span class="span span-active">200</span>
					<span class="span">500</span>
					<span class="span">1000</span>
					<span class="span other">其它</span>
					<input type="number" name="other" value="0" />
				</div>
				<div class="mb-6 mt-15">購買方向</div>
				<div class="type">
					<span class="span span-active">買漲</span>
					<span class="span">買跌</span>
				</div>
				<div class="mb-3 mt-15">餘額</div>
				<div class="balance">
					<span id="balance">NT$: 00.00</span>
					<button class="update" title="刷新餘額" onclick="refresh()">
						<i class="layui-icon layui-icon-refresh-1"></i>
					</button>
				</div>
				<div class="confirm mt-15" onclick="okorder()">確認下注</div>
				<div class="confirm mt-15 refresh" onclick="allrefresh()">刷新數據</div>
				<div class="confirm mt-15 getlog" onclick="getlog()">
					<table id="getlog"></table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>