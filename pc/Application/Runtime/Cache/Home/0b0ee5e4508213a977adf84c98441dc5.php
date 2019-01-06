<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>購買記錄</title>
	<link rel="stylesheet" href="/Public/home/bocai/iconfont.css" />
	<link rel="stylesheet" href="http://localhost:8081/Public/plug-in/layui-v2.3.0/layui/css/layui.css" />
	<script src="http://localhost:8081/Public/js/config.js"></script>
	<script src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://localhost:8081/Public/plug-in/layui-v2.3.0/layer/layer.js"></script>
	<style>
		body{max-width:1200px;margin:0 auto;padding:0;}
	</style>
</head>
<body>
	<div class="deal-container">
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
			<tbody>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($vo["order_id"]); ?></td>
						<td><?php echo ($vo["buy_direction_name"]); ?></td>
						<td><?php echo ($vo["last_direction_name"]); ?></td>
						<td><?php echo ($vo["money"]); ?></td>
						<td><?php echo ($vo["buy_number"]); ?></td>
						<td><?php echo ($vo["buy_price"]); ?></td>
						<td><?php echo ($vo["last_price"]); ?></td>
						<td><?php echo ($vo["buy_time"]); ?></td>
						<td><?php echo ($vo["last_time"]); ?></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
</body>
</html>