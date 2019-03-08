<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>微平台脚本</title>

	<script type="text/javascript" src="http://192.168.0.137:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script>
		var worker = new Worker("/Public/home/bocai/worker/msgscript.js")
		worker.postMessage(1)
		worker.onmessage = function(data) {
			$.get('<?php echo U("wrun");?>', function(res) {
				if (res.step == 0) {
					$('#setp0').text('第'+res.number+'期，正在采集数据中...')
				} else if (res.step == 1) {
					$('#setp1').text(res.number+'期，执行价:'+res.data.execute_price+'  成交价:'+res.data.last_price + '  正在执行中...')
				} else {
					var direction = res.data.execute_price-res.data.last_price>0?'跌':'涨'
					$('#setp2').text(res.number+'期，执行价:'+res.data.execute_price+'  成交价:'+res.data.last_price+'  方向:'+direction)
				}
			})
		}
	</script>
</head>
<body>
	<h3>微平台脚本运行，请不要关闭!!!</h3>
	<h3 id="setp0"></h3>
	<h3 id="setp1"></h3>
	<h3 id="setp2"></h3>
</body>
</html>