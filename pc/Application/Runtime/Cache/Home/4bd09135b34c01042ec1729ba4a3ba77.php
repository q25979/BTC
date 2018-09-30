<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>幣淘微平台</title>
	<script src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>

	<style>
		h3, body, p { margin: 0; padding: 0; }
		body { background: #010101; color: #fff; }
		.yi-container { max-width: 1200px; background: #333; margin: 0 auto; }
		.yi-container header h3 { text-align: center; padding: 15px 0; letter-spacing: 3px; }
		.yi-price { background: #252C34; }
	</style>
</head>
<body>
	<div class="yi-container">
		<header>
			<h3>比特幣</h3>
		</header>
		<div class="yi-price"></div>
	</div>

	<script>
		$.get("http://localhost:8081/Float/Index/getbtc", {type: 'usd'}, function(res) {
			console.log(res)
		})
	</script>
</body>
</html>