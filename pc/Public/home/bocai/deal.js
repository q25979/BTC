var otherInput = 'none';	// 金额的输入框是否显示并且判断是否使用输入框
var open = 0;	// 开盘数据
var tcolor = ['#228B22', '#F00'];	// 开盘数据
var openTime = 5;	// 设置开盘时间5分钟一次

$(function() {
	// 金额切换
	$('.number>.span').each(function(idx) {
		$(this).click(function() {
			$('.number>.span').removeClass('span-active');
			$($('.number>.span')[idx]).addClass('span-active');
			otherInput = idx == 4 ? 'inline-block' : 'none';
			$('[name=other]').css('display', otherInput);
		});
	});

	// 交易类型切换
	$('.type>.span').each(function(idx) {
		$(this).click(function() {
			$('.type>.span').removeClass('span-active');
			$($('.type>.span')[idx]).addClass('span-active');
		});
	});

	// 1s钟获取实时数据
	setInterval(gettdata, 1000);
	getbalance(); // 获取余额
});

/**
 * 获取实时数据
 */
function gettdata() {
	var u = config.host_path + "/Float/Index/getbtc";
	$.get(u, function(res) {
		// 设置颜色
		var copen = open > res.ticker.buy
			? tcolor[1] : tcolor[0];
		if (open == res.ticker.buy) copen = $($(".now-price")[0]).css('color');
		open = res.ticker.buy;
		var atime = res.time.split(':'); // 0-小时 1-分钟 2-秒

		// 把获取的时间,设为独立时间
		var minue  = openTime-parseInt(atime[1]%5)-1;
		var second = 0;
		if (60-parseInt(atime[2]) == 60) {
			second = 0;
			minue = minue+1;
		} else {
			second = 60-parseInt(atime[2]);
		}
		minue  = minue<10 ? '0'+minue : minue;
		second = second<10 ? '0'+second : second;
		minue == 0 
			? $(".time>div:nth-last-child(1)").css('color', tcolor[1])
			: $(".time>div:nth-last-child(1)").css('color', tcolor[0])

		// 设置显示
		$($(".now-price")[0]).text(open);
		$($(".now-price")[0]).css('color', copen);
		$(".time>div:nth-last-child(1)").text(minue+':'+second);
	});
}

/**
 * 获取余额
 */
function getbalance(callback) {
	$.get(config.host_path+'/Home/Bocai/getbalance', function(res) {
		$('#balance').text('NT$: '+res);
		callback ? callback() : '';
	});
}

/**
 * 刷新余额
 */
function refresh() {
	$('.update').addClass('_360');
	getbalance(function() {
		$('.update').removeClass('_360');
	});
}