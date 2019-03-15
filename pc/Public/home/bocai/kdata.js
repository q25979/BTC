
// 设置全局变量
// 5分钟K线  可以根据开盘和收盘价的波动范围 0.5 0.5-2 2-4 4
var k = null
var aKtimeLine = ['1min', '5min', '15min', '30min', '60min', '1day']
var ktimeLine = aKtimeLine[1]	// 设置k线图时间线初始化
var option = {}
var tdata  = { open: 0, collect: 0, high: 0, low: 0 }
var	zoom   = { start: 80, end: 100 }	// 初始化dataZoom
var	wsUrl  = 'wss://api.huobi.pro/ws'	// WebSocket k线图地址
var	ws = null		// WebSocket
var	wsLock = false 	// Socket锁防止重复
var dealArea = ['1000px', '500px']	// 弹出层大小

$(function() {
	k = echarts.init(document.getElementById('k'))
	k.showLoading()
	createWebSocket()	// 创建webSocket
	kEvent()	// K线图事件
	worker()	// 时间设置

	// 窗口关闭事件
	window.onbeforeunload = function() {
		ws.close()	// 关闭webSocket
	}
})


/**
 * K线图事件
 * @return {[type]} [description]
 */
function kEvent() {
	// K线图切换
	$('.yi-time li').each(function(idx) {
		$(this).click(function() {
			$('.yi-time li').removeClass('active');
			$($('.yi-time li')[idx]).addClass('active');
			k.showLoading()
			ktimeLine = aKtimeLine[idx]
			if (wsLock) ws.close()
			runWebSocket()
		})
	})

	// dataZoom时间
	k.on('dataZoom', function(ev) {
		zoom.start = ev.batch[0].start
		zoom.end   = ev.batch[0].end
	})
}

/**
 * 创建websocket
 * @return {[type]} [description]
 */
function createWebSocket() {
	try {
		if ('WebSocket' in window) {
			ws = new WebSocket(wsUrl)
		} else if ('MozWebSocket' in window) {
			ws = new MozWebSocket(wsUrl)
		} else {
			layer.open({
				content: '您的瀏覽器不支持K綫圖交易，建議使用新版谷歌瀏覽器，請勿使用IE10以下瀏覽器!',
				btn: '確認'
			})
		}
		runWebSocket()
	} catch(e) {
		console.log('WebSocket error in option!')
		// reconnect(url)
	}
}

/**
 * 运行websocket
 * @return {[type]} [description]
 */
function runWebSocket() {
	ws.onclose = function() {
		wsLock = false
		createWebSocket()
	}
	ws.onerror = function() {
		wsLock = false
		createWebSocket()
	}
	ws.onopen = function() {
		wsLock = true
		let obj = new Object()
		obj.req = 'market.btcusdt.kline.'+ktimeLine
		obj.id  = 'id2'

		obj = JSON.stringify(obj)
		ws.send(obj)
	}
	ws.onmessage = function(ev) {
		var reader = new FileReader()
		reader.readAsArrayBuffer(ev.data)
		reader.onload = function(e) {
			if (e.target.readyState == FileReader.DONE) {
				let data = pako.inflate(reader.result)
				let strData = String.fromCharCode.apply(null, new Uint16Array(data))
				let objData = JSON.parse(strData)
				var eData = objData.data
				
				// 配置数据
				if (eData) {
					k.hideLoading()
					k.setOption(koption(eData))
					k.resize()

					var c = $('.yi-price li:nth-child(1)'),
						o = $('.yi-price li:nth-child(2)>.yi-number'),
						l = $('.yi-price li:nth-child(3)>.yi-number'),
						h = $('.yi-price li:nth-child(4)>.yi-number')
					if (eData[eData.length-1].vol < eData[eData.length-2].vol) {
						c.addClass('fall').removeClass('rise')
						o.addClass('fall').removeClass('rise')
						l.addClass('fall').removeClass('rise')
						h.addClass('fall').removeClass('rise')
					} else {
						c.addClass('rise').removeClass('fall')
						o.addClass('rise').removeClass('fall')
						l.addClass('rise').removeClass('fall')
						h.addClass('rise').removeClass('fall')
					}
					c.text(parseFloat(eData[eData.length-1].close).toFixed(4))
					o.text(parseFloat(eData[eData.length-1].open).toFixed(4))
					l.text(parseFloat(eData[eData.length-1].low).toFixed(4))
					h.text(parseFloat(eData[eData.length-1].high).toFixed(4))
					localStorage.close = parseFloat(eData[eData.length-1].close).toFixed(4)
					localStorage.cClose = c.css('color')
				}
			}
		}
	}
}

/**
 * 使用worker多线程设置时间
 */
function worker() {
	$.get(config.host_path+'/home/bocai/timestamp', function(timestamp) {
		var worker = new Worker("/Public/home/bocai/time.js")
		worker.postMessage(timestamp)
		worker.onmessage = function(data) {
			$("#yi-server-time").html(data.data)
		}
	})
}

/**
 * 配置MA
 */
function calculateMA(dayCount, data) {
    var result = [];
    for (var i = 0, len = data.length; i < len; i++) {
        if (i < dayCount) {
            result.push('-');
            continue;
        }
        var sum = 0;
        for (var j = 0; j < dayCount; j++) {
            sum += data[i - j][1];
        }
        result.push(sum / dayCount);
    }
    return result;
}

/**
 * 配置K线图数据
 */
function koption(res) {
	var dates = []
	for (var i in res) {
		let date = new Date(res[i].id * 1000)
		let y = date.getFullYear(),
			m = date.getMonth()+1,
			d = date.getDate(),
			h = date.getHours(),
			mm = date.getMinutes()
		if (parseInt(h) < 10) h = '0' + h
		if (parseInt(mm) < 10) mm = '0' + mm
		if (parseInt(m) < 10) m = '0' + m 
		if (parseInt(d) < 10) d = '0' + d
		
		let time = self.klineTime == '1day' ? y+'/'+m+'/'+d : h+':'+mm
		dates.push(time)
	}

	var data = res.map(function (item) {
	    return [item.open, item.close, item.low, item.high]
	})

	data = data.map(function (item) {
		return [item[0].toFixed(2), item[1].toFixed(2), item[2].toFixed(2), item[3].toFixed(2)]
	})

	var volumes = res.map(function (item) {
		return item.amount
	})

	var option = {};
	option.backgroundColor = '#21202D';
	option.series = [{
		// 设置图表类型
		type: 'candlestick',
		data: data,
		itemStyle: {
			color: '#FD1050',
			color0: '#0CF49B',
			borderColor: '#FD1050',
			borderColor0: '#0CF49B',
			opacity: 0.5
		},
		markLine: {
			animation: false,
			symbol: ['none', 'none'],
			lineStyle: {type:'dashed'},
			label: {backgroundColor:'#AB1643',color:'white'},
        	data: [{
        		yAxis: data[data.length-1][1]	// 全局的开盘数据
        	}]
		}
	}, {
		name: 'Volume',
		type: 'bar',
		xAxisIndex: 1,
		yAxisIndex: 1,
		itemStyle: {
			color: '#19B47D',
			opacity: 0.8
		},
		data: volumes
	}]
	option.tooltip = {
		trigger: 'axis',
		axisPointer: {
			animation: false,
			type: 'cross',
			lineStyle: {
				color: '#376df4',
				width: 1,
				opacity: 1
			}
		}
	}
	option.xAxis = [{
		type: 'category',
		data: dates,
		axisLine: { lineStyle: { color: '#585264' } },
        axisTick: { show: false },
        axisPointer: { show: true },
		axisLabel: {show: false}
	}, {
		gridIndex: 1,
		type: 'category',
		data: dates,
		axisLine: { lineStyle: { color: '#A2AFBC' } },
        axisTick: { show: false },
	}];
	option.yAxis = [{
		scale: true,
        position: 'right',
        axisLine: { lineStyle: { color: '#8392A5' } },
        splitLine: { show: true, lineStyle: { color: '#343140'} },
        axisTick: { show: false },
	}, {
		gridIndex: 1,
		scale: true,
		position: 'right',
		splitNumber: 2,
		min: 0,
		max: 'dataMax',
		axisLine: { lineStyle: { color: '#8392A5' } },
		splitLine: { show: true, lineStyle: { color: '#343140' } },
		axisLabel: { margin: 5, showMaxLabel: false }
	}];
	option.grid = [{
		top: 30,
        height: 350,
        left: 30,
        right: 60
	}, {
		top: 380,
        height: 100,
        left: 30,
        right: 60
	}];
	option.dataZoom = [{
		show: false,
		type: 'slider',
		xAxisIndex: [0, 1],
		realtime: false,
		start: zoom.start,
		end: zoom.end
	}, {
		type: 'inside',
		xAxisIndex: [0, 1],
		start: zoom.start,
		end: zoom.end
	}]

	return option;
}

/**
 * 返回首页
 */
function onHome() {
	window.location.href = config.host_path
}

/**
 * 交易记录
 * @return {[type]} [description]
 */
function onRecord() {
	var u = config.host_path + '/Home/Bocai/getlog'
	layer.open({
		type: 2,
		content: u,
		area: dealArea,
		title: '交易記錄'
	})
}

/**
 * 買
 * @param int type 類型1-買漲 2-買跌
 */
function onDeal(type) {
	var u = config.host_path + "/Home/Bocai/deal/type/"+type
	layer.open({
		type: 2,
		content: u,
		area: dealArea,
		title: "投資比特幣",
		skin: "deal-class",
		resize: false,
		scrollbar: false
	})
}

function onOldLog() {
	var u = config.host_path + "/Home/Bocai/oldlog"
	layer.open({
		type: 2,
		content: u,
		area: ['750px', '400px'],
		title: "開獎記錄",
		skin: "deal-class"
	})
}
