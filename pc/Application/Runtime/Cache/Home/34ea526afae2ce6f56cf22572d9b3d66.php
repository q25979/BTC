<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($title); ?></title>
	<link rel="stylesheet" href="/Public/home/bocai/iconfont.css" />
	<link rel="stylesheet" href="/Public/home/bocai/deal.css" />
	<link rel="stylesheet" href="http://192.168.0.128:8081/Public/plug-in/layui-v2.3.0/layui/css/layui.css" />
	<script src="http://192.168.0.128:8081/Public/js/config.js"></script>
	<script src="http://192.168.0.128:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://192.168.0.128:8081/Public/js/jquery.cookie.js"></script>
	<script src="http://192.168.0.128:8081/Public/plug-in/layui-v2.3.0/layer/layer.js"></script>
	<script src="/Public/home/bocai/deal.js"></script>
</head>
<body>
	<div class="deal-container">
		<div class="l fl clearfix">
			<div class="time fl">
				<div class="mb-3">倒計時</div>
				<div>00:00</div>
			</div>
			<div class="money fr">
				<div class="mb-6">金額</div>
				<div class="number">
					<span class="span span-active">200</span>
					<span class="span">500</span>
					<span class="span">1000</span>
					<span class="span">5000</span>
					<span class="span">其它</span>
					<input type="number" name="other" value="0" />
				</div>
				<div class="mb-6 mt-15">交易類型</div>
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
				<div id="prev">上一期: 無</div>
			</div>
			<div class="order fl">
				<table class="layui-table" lay-size="sm" lay-skin="line">
					<thead>
						<tr>
							<th>訂單ID</th>
							<th>購買方向</th>
							<th>最終方向</th>
							<th>金額(NT$)</th>
							<th>期數</th>
							<th>購買價格($)</th>
							<th>最終價格($)</th>
							<th>購買時間</th>
							<th>開盤時間</th>
						</tr>
					</thead>
					<tbody id="log">
					</tbody>
				</table>
			</div>
		</div>
		<div class="r fr">
			<div>
				<div class="mb-3">現價</div>
				<div class="label-bg now-price">00.00</div>
				<div class="mb-3 mt-15">期數</div>
				<div class="label-bg" id="openNumber">00</div>
				<div class="confirm mt-15" onclick="okorder()">確認下單</div>
				<div class="flag _y360" onclick="allrefresh()" style="background-image:url('/Public/home/bocai/btc.png')"></div>
			</div>
		</div>
	</div>
</body>
</html>