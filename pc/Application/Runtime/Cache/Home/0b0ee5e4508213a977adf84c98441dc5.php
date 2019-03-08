<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>購買記錄</title>
	<link rel="stylesheet" href="/Public/home/bocai/iconfont.css" />
	<link rel="stylesheet" href="http://192.168.0.137:8081/Public/plug-in/layui-v2.3.0/layui/css/layui.css" />
	<script src="http://192.168.0.137:8081/Public/js/config.js"></script>
	<script src="http://192.168.0.137:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://192.168.0.137:8081/Public/plug-in/layui-v2.3.0/layui/layui.js"></script>
	<style>
		body{max-width:1200px;margin:0 auto;padding:0;}
	</style>

	<script>
		$(function() {
			layui.use('table', function() {
				var table = layui.table

				table.render({
					elem: '#log',
					url: '<?php echo U("getlog");?>',
					page: true,
					skin: 'row',
					limit: 20,
					size: 'sm',
					cols: [[
						{field:'order_id',title:'訂單ID',width:110,align:'center'},
						{field:'buy_direction_name',title:'購買方向',width:80,align:'center'},
						{field:'last_direction_name',title:'最終方向',width:80,align:'center'},
						{field:'money',title:'購買金額(NT$)',width:110,align:'center'},
						{field:'buy_number',title:'期號',width:60,align:'center'},
						{field:'last_money',title:'中將金額(NT$)',width:110,align:'center'},
						{field:'execute_price',title:'執行價($)',width:90,align:'center'},
						{field:'last_price',title:'成交價($)',width:90,align:'center'},
						{field:'buy_time',title:'購買時間',width:130,align:'center'},
						{field:'last_time',title:'開盤時間',width:130,align:'center'}
					]]
				})
			})
		})
	</script>
</head>
<body>
	<div class="deal-container">
		<table class="layui-table" id="log"></table>
	</div>
</body>
</html>