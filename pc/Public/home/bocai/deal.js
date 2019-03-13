var otherInput = 'none';	// 金额的输入框是否显示并且判断是否使用输入框
var tcolor = ['#228B22', '#D83F4E'];	// 开盘数据
var openTime = 5;			// 设置开盘时间5分钟一次
var tableDealLog = null;	// 表格
var worker = null;			// 倒计时Worker

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

	init();
});

/**
 * 初始化
 */
function init() {
	setCountDown()	// 设置倒计时
	openfn()		// 开盘
	getprice()		// 获取价格
}

/**
 * 设置倒计时
 */
function setCountDown() {
	if (worker != null) worker.terminate()
	$.get(config.host_path + '/home/bocai/timestamp', function(timestamp) {
		CountDown(timestamp)
	})
}

/**
 * 获取交易记录
 */
function getdeallog() {
	var u = config.host_path + '/home/bocai/getdeallog'

	$.get(u, function(d) {
		var res = d.data
		for (i in res) {
			var h  = '<td>'+res[i].buy_number+'</td>'
				h += '<td>'+res[i].money+'</td>'
			h += parseFloat(res[i].last_money) > 0
				? '<td style="color:#E4393C">'+res[i].last_money+'</td>'
				: '<td>'+res[i].last_money+'</td>'
			$($('#getlog tbody tr')[i]).html(h)
		}
	})
}

/**
 * 开盘
 */
function openfn() {
	$('.refresh').text("數據獲取中...")
	getbalance();	// 获取余额
	getdeallog()	// 获取交易记录
	getorder()		// 获取往期记录
}

/**
 * 获取价格
 */
function getprice() {
	var worker = new Worker("/Public/home/bocai/worker/msgscript.js")
	worker.postMessage(1)
	worker.onmessage = function(data) {
		var obj = data.data
		var atime = ($('.time>div:nth-last-child(1)').text()).split(':')
		var m = parseInt(atime[0])
		var s = parseInt(atime[1])
		if (m==0 && s==0) return ;
		var url   = config.host_path+'/home/bocai/getprice'
		var ashow = ['', '']	// 0-执行价  1-成交价
		var execute = $('#executePrice>div:nth-last-child(1)')
		var last = $('#lastPrice>div:nth-last-child(1)')
		var executename = $('#executePrice>div:nth-child(1)')
		var lastname = $('#lastPrice>div:nth-child(1)')

		// 规定时间显示
		ashow[0] = m==4||m==0&&s<=30 ? 'visible' : 'hidden'
		ashow[1] = m==4 ? 'visible' : 'hidden'

		// 请求数据
		if (m==0 && s<=32 && s>5) {
			var number = $('#openNumber').text()
			$.get(url, function(res) {
				executename.text('第'+number+'期-執行價')
				execute.text(res.execute_price)
				lastname.text('第'+number+'期-成交價')
				last.text(res.last_price)
			})
		}
		if (parseInt(execute.text())==0) ashow[0] = 'hidden'
		if (parseInt(last.text())==0) ashow[1] = 'hidden'
		$('#executePrice').css('visibility', ashow[0])
		$('#lastPrice').css('visibility', ashow[1])
		getClose()	// 获取收盘价
	}
}

/**
 * 设置倒计时
 */
function CountDown(timestamp) {
	worker = new Worker("/Public/home/bocai/countdown.js")
	worker.postMessage(timestamp)
	worker.onmessage = function(data) {
		var obj = data.data;
		if (obj.open) {
			openfn()
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
 * 獲取訂單
 */
function getorder() {
	var u = config.host_path + '/Home/Bocai/getrecord';
	layui.use('table', function() {
		var table = layui.table
		table.render({
			elem: '#log',
			url: u,
			size: 'sm',
			skin: 'row',
			height: 285,
			width: 740,
			limit: 20,
			page: true,
			loading: false,
			done: function(res) {
				$('.refresh').text('刷新數據')
			},
			cols: [[
				{field:'number',title:'期號',align:'center',unresize:true,width:100},
				{field:'execute_price',title:'執行價',align:'center',unresize:true,width:172},
				{field:'last_price',title:'成交價',align:'center',unresize:true,width:172},
				{field:'last_direction_name',title:'方向',align:'center',unresize:true,width:100},
				{field:'create_time',title:'開盤時間',align:'center',unresize:true,width:173}
			]]
		})
	})
}

/**
 * 获取实时数据
 */
function getClose() {
	// 设置显示
	var n = $($('.now-price')[0])
	if (localStorage.close) {
		$($(".now-price")[0]).text(localStorage.close);
		$($(".now-price")[0]).css('color', localStorage.cClose)
	}
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
 * 确认下单
 */
function onOrder() {
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
				getbalance();	// 获取余额
				getdeallog();	// 获取交易记录
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
function onAllrefresh() {
	openfn();
}

/**
 * 交易记录
 * @return {[type]} [description]
 */
function onRecord() {
	var u = config.host_path + '/Home/Bocai/getlog'
	var iframeName = window.parent;

	iframeName.layer.open({
		type: 2,
		content: u,
		area: ['1000px', '500px'],
		title: '交易記錄'
	})
}