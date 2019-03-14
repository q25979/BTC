<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>購買記錄</title>
	<link rel="stylesheet" href="/Public/home/bocai/iconfont.css" />
	<link rel="stylesheet" href="http://localhost:8081/Public/plug-in/layui-v2.3.0/layui/css/layui.css" />
	<script src="http://localhost:8081/Public/js/config.js"></script>
	<script src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script src="http://localhost:8081/Public/plug-in/layui-v2.3.0/layui/layui.js"></script>
	<style>
		body{max-width:1000px;margin:0 auto;padding:0;}
		.layui-table, .layui-table-view{margin:0;}
	</style>

	<script>
		$(function() {
			layui.use('table', function() {
				var table = layui.table
				table.render({
					elem: '#log',
					url: '<?php echo U("getlog");?>',
					page: true,
					height: 455,
					skin: 'row',
					limit: 20,
					size: 'sm',
					cols: [[
						{field:'order_id',title:'訂單ID',width:110,align:'center',unresize:true},
						{field:'buy_direction_name',title:'購買方向',width:80,align:'center',unresize:true},
						{field:'last_direction_name',title:'最終方向',width:80,align:'center',unresize:true},
						{field:'money',title:'下注金額(NT$)',width:109,align:'center',unresize:true},
						{field:'buy_number',title:'期號',width:58,align:'center',unresize:true},
						{field:'last_money',title:'中將金額(NT$)',width:109,align:'center',unresize:true,templet:'#lastMoney'},
						{field:'execute_price',title:'執行價($)',width:87,align:'center',unresize:true},
						{field:'last_price',title:'成交價($)',width:87,align:'center',unresize:true},
						{field:'buy_time',title:'購買時間',width:125,align:'center',unresize:true},
						{field:'last_time',title:'開盤時間',width:127,align:'center',unresize:true}
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

	<script type="text/html" id="lastMoney">
		{{# if(d.last_money=='等待開獎') { }}
			<span style="color:#1ABC65">等待開獎</span>
		{{# } else if(d.last_money=='未中獎') { }}
			<span style="color:#989898">未中獎</span>
		{{# } else { }}
			<span style="color:red">+{{d.last_money}}</span>
		{{# } }}
	</script>
</body>
</html>