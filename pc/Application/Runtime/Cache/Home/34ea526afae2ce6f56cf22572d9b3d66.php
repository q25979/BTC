<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($title); ?></title>
	<link rel="stylesheet" href="/Public/home/bocai/deal.css" />
	<link rel="stylesheet" href="http://localhost:8081/Public/plug-in/layui-v2.3.0/layui/css/layui.css" />
	<script src="http://localhost:8081/Public/js/config.js"></script>
	<script src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://localhost:8081/Public/plug-in/layui-v2.3.0/layui/layui.js"></script>
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
						<div>當前期數</div>
						<div class="label-bg" id="openNumber">00</div>
					</div>
					<div>
						<div>餘額</div>
						<div class="label-bg" id="balance">00.00</div>
					</div>
				</div>
			</div>

			<div class="order fl">
				<table class="layui-table" id="log"></table>
				<div class="tip">已顯示最近20條走勢</div>
			</div>
		</div>
		<div class="r fr">
			<div class="money">
				<div class="mb-6">下注金額</div>
				<div class="number">
					<span class="span span-active">100</span>
					<span class="span">200</span>
					<span class="span">300</span>
					<br>
					<span class="span mt-15">500</span>
					<span class="span">1000</span>
					<span class="span">2000</span>
					<span class="span other">其它</span>
					<input type="number" name="other" value="0" min="0" />
				</div>
				<div class="mb-6 mt-15">購買方向</div>
				<div class="type">
					<span class="span span-active">買漲</span>
					<span class="span">買跌</span>
				</div>
				<div class="confirm mt-15" onclick="onOrder()">確認下注</div>
				<div class="confirm mt-15 refresh" onclick="onAllrefresh()">刷新數據</div>
				<div class="confirm mt-15 getlog">
					<table id="getlog">
						<thead>
							<tr>
								<td width="55">期號</td>
								<td width="81">投注金額</td>
								<td width="80">獎金</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><div></div></td>
								<td><div></div></td>
								<td><div></div></td>
							</tr>
							<tr>
								<td><div></div></td>
								<td><div></div></td>
								<td><div></div></td>
							</tr>
							<tr>
								<td><div></div></td>
								<td><div></div></td>
								<td><div></div></td>
							</tr>
							<tr class="more">
								<td colspan='3'><span onclick="onRecord()">更多 >></span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>