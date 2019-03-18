<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>幣淘微平台-走勢圖</title>
	<!--强制让文档的宽度与设备的宽度保持1:1，并且文档最大的宽度比例是1.0，且不允许用户点击屏幕放大浏览；--> 
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!--iphone设备中的safari私有meta标签，它表示：允许全屏模式浏览--> 
	<meta content="yes" name="apple-mobile-web-app-capable">
	<!--iphone的私有标签，它指定的iphone中safari顶端的状态条的样式--> 
	<meta content="black" name="apple-mobile-web-app-status-bar-style">
	<link rel="stylesheet" href="http://localhost:8081/Public/plug-in/layui-v2.3.0/layui/css/layui.css" />
	<script src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	
	<style>
		body,ul,li,p,button,div,h3{padding:0;margin:0;}
		body{color:#555;font-family:"微软雅黑";font-size:0.875em;}
		ul,li{list-style:none}

		.clearfix:after{height:0;visibility:hidden;display:block;line-height:0;clear:both;content:'.';}
		header{z-index:1;color:#c4c7c9;background:#2c3940;padding:0 0.625em;position:fixed;width:100%;top:0;height:3em;line-height:3em;}
		header>ul>li{float:left;margin-right:0.9375em}
		#trend{margin-top:3.5em;width:100%;font-size:0.75em;visibility:hidden;}
		tr>td:nth-child(1){width:20%;}
		tr>td:nth-child(2){width:30%;}
		tr>td:nth-child(3){width:30%;}
		tr>td:nth-child(4){width:20%;}
		thead tr,tfoot tr{background:#F2F2F2;}
		thead td{padding:0.625em 0;}
		tfoot td{padding:1em 0;}
		td{text-align:center;padding:0.5em 0;border:1px solid #E6E6E6;}
	</style>
</head>
<body>
	<header>
		<ul class="clearfix">
			<li onclick="w.jump('/')">首頁</li>
			<li onclick="w.jump('<?php echo U(m);?>')">微平臺</li>
			<li onclick="w.jump('<?php echo U(mlog);?>')">交易記錄</li>
		</ul>
	</header>
	
	<div id="loader" style="margin-top:4em;text-align:center">加載中...</div>
	<table id="trend">
		<thead>
			<tr>
				<td>期號</td>
				<td>執行價</td>
				<td>成交價</td>
				<td>方向</td>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot>
			<tr><td colspan="4">以顯示最近20期走勢</td></tr>
		</tfoot>
	</table>

	<script>
		var w = {
			url: '<?php echo U("getrecord");?>',
			data: {page:1, limit:20},
			jump: function(url) {
				window.location.href=url
			},
			init: function() {
				$.get(this.url, this.data, function(res) {
					$('#loader').css('display', 'none')	// 隐藏
					$('#trend').css('visibility', 'visible')	// 显示
					
					var html
					for (var i in res.data) {
					var color = parseInt(res.data[i].last_direction) == 0 ? '#14B143' : '#EF232A'
						html += '<tr>'
						html += '<td>'+res.data[i].number+'</td>'
						html += '<td>'+res.data[i].execute_price+'</td>'
						html += '<td>'+res.data[i].last_price+'</td>'
						html += '<td style="color:'+color+'">'+res.data[i].last_direction_name+'</td>'
						html += '</tr>'
					}
					$('#trend>tbody').append(html)
				})
			}
		}

		w.init()
	</script>
</body>
</html>