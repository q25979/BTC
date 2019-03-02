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
			otherInput = idx == 3 ? 'inline-block' : 'none';
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
	openfn();
});

/**
 * 开盘
 */
function openfn() {
	$('.refresh').text("數據獲取中...")
	getbalance();	// 获取余额
	$.get(config.host_path + '/home/bocai/open', function(res) {
		CountDown(res.timestamp)	// 倒计时时间戳
		getorder()	// 刷新记录
	});
}

/**
 * 设置倒计时
 */
function CountDown(timestamp) {
	var worker = new Worker("/Public/home/bocai/countdown.js")
	worker.postMessage(timestamp)
	worker.onmessage = function(data) {
		var obj = data.data;
		if (obj.open) {
			console.log("开盘啦！")
		}

		// 页面渲染
		obj.minue == 0
			? $(".time>div:nth-last-child(1)").css('color', tcolor[1])
			: $(".time>div:nth-last-child(1)").css('color', tcolor[0])
		if (obj.minue < 10) obj.minue = "0" + obj.minue
		if (obj.second < 10) obj.second = "0" + obj.second

		time = obj.minue + ":" + obj.second
		$(".time>div:nth-last-child(1)").text(time);
		$("#openNumber").text(obj.number)
	}
}

/**
 * 交易記錄
 */
function getlog() {
	console.log("交易記錄")
}

/**
 * 獲取訂單
 */
function getorder() {
	var u = config.host_path + '/Home/Bocai/getrecord';
	var d = { limit: 20 };
	$.get(u, d, function(res) {
		$('.refresh').text('刷新數據')
		$('#log').empty();	// 重构子节点
		for (var i in res.data) {
			var h  = '<tr>';
				h += '<td>'+ res.data[i].number +'</td>';
				h += '<td>'+ res.data[i].execute_price +'</td>';
				h += '<td>'+ res.data[i].last_price +'</td>';
				h += '<td>'+ res.data[i].last_direction_name +'</td>';
				h += '<td>'+ res.data[i].create_time +'</td>';
				h += '</tr>';
			$('#log').append(h);
		}
	});
}

/**
 * 获取实时数据
 */
function gettdata() {
	var last = $.cookie('btc_wbtcopen')
	
	// 设置颜色
	var copen = open > last
		? tcolor[1] : tcolor[0];
	if (open == last) copen = $($(".now-price")[0]).css('color');
	open = last;

	// 设置显示
	$($(".now-price")[0]).text(open);
	$($(".now-price")[0]).css('color', copen);
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
				getbalance();
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
	openfn();
}