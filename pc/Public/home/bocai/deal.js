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

	setInterval(gettdata, 1000); // 1s钟获取实时数据
	getbalance();	// 获取余额
	getorder();
	setInterval(getorder, 1000*60*1);	// 獲取訂單
});

/**
 * 獲取訂單
 */
function getorder() {
	var u = config.host_path + '/Home/Bocai/getrecord';
	var d = { limit: 10 };
	$.get(u, d, function(res) {
		$('.flag').removeClass('_y360');
		$('#log').empty();	// 重构子节点
		for (var i in res.data) {
			var h  = '<tr>';
				h += '<td>'+ res.data[i].order_id +'</td>';
				h += '<td>'+ res.data[i].buy_direction_name +'</td>';
				h += '<td>'+ res.data[i].last_direction_name +'</td>';
				h += '<td>'+ res.data[i].money +'</td>';
				h += '<td>'+ res.data[i].buy_number +'</td>';
				h += '<td>'+ res.data[i].buy_price +'</td>';
				h += '<td>'+ res.data[i].last_price +'</td>';
				h += '<td>'+ res.data[i].buy_time +'</td>';
				h += '<td>'+ res.data[i].last_time +'</td>';
				h += '</tr>';
			$('#log').append(h);
		}
		// 上一期
		$('#prev').text('上一期: '+res.prev);
	});
}

/**
 * 获取实时数据
 */
function gettdata() {
	var last = $.cookie('btc_wbtcopen')
	var time = $.cookie('btc_wbtctime')
	
	// 设置颜色
	var copen = open > last
		? tcolor[1] : tcolor[0];
	if (open == last) copen = $($(".now-price")[0]).css('color');
	open = last;
	var atime = time.split(':'); // 0-小时 1-分钟 2-秒

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
	$('#openNumber').text(parseInt((((parseInt(atime[0])*60+parseInt(atime[1]))/5)+1)));
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

/**
 * 确认下单
 */
function okorder() {
	// 交易金额
	var moneyidx = 0;	// 金额选择下标
	var typeidx  = 0;	// 类型下标
	var d = {};	// 需要提交的数据
	var u = config.host_path + '/Home/Bocai/okorder';

	// 金额
	$('.number>.span').each(function(idx) {
		if ($($('.number>.span')[idx]).hasClass('span-active')) moneyidx = idx;
	});
	// 类型
	$('.type>.span').each(function(idx) {
		if ($($('.type>.span')[idx]).hasClass('span-active')) typeidx = idx;
	});
	d.money = moneyidx == 4	// 金额
		? parseFloat($('[name=other]').val())
		: parseFloat($($('.number>.span')[moneyidx]).text());
	d.buy_direction = typeidx;
	d.buy_number = parseInt($('#openNumber').text());
	d.buy_price  = parseFloat($($('.now-price')[0]).text()).toFixed(4);
	d.time = $('.time>div:nth-last-child(1)').text();
	d.time = parseInt(d.time.split(':')[0]);
	if (d.time == 0) {
		layer.msg('最後一分鐘禁止購買');
		return false;
	}

	if (d.money < 1 || isNaN(d.money)) {
		layer.msg('請輸入正確的金額', {time:1500})
		return false;
	}
	layer.open({
		content: '確認下單?',
		btn: ['確認', '取消'],
		yes: function() {
			layer.closeAll();
			layer.load(2)
			$.post(u, d, function(res) {
				var icon = res.code == 0 ? 6 : 5;
				layer.closeAll('loading')
				layer.msg(res.msg, {time: 1500, icon: icon});
				if (icon == 5) return false;
				getorder();
			}).fail(function() {
				layer.closeAll()
				layer.msg('請求超時')
			})
		}
	});
}

/**
 * 更新数据
 */
function allrefresh() {
	getbalance();
	$('.flag').addClass('_y360');
	getorder();
}