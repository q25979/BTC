$(function() {
	// 5分钟K线  可以根据开盘和收盘价的波动范围 0.5 0.5-2 2-4 4
	var k = echarts.init(document.getElementById('k'));
	// 1min,3min,5min,30min,1hour,1day, 设置K线图
	var req = {type: '5min'};
	var option = {};

	loader();
	getkdata(req, function(data, timestamp) {
		$('#k-load').remove();
		$('.yi-container').css('display', 'block');
		option = koption(data, req.type);

		// 时间处理
		worker(timestamp)
		
		// 设置k线图
		var setkdata = function() {
			gettdata();	// 获取实时数据
			option.dataZoom[0].start = zoom.start;
			option.dataZoom[0].end = zoom.end;
			option.series[0].markLine.data[0].yAxis = tdata.open;
			k.setOption(option, true);
			k.resize();	// 重置大小
		}
		setInterval(setkdata, 5000);
	});

	// K线图切换
	$('.yi-time li').each(function(idx) {
		$(this).click(function() {
			var atype = ['1min', '5min', '15min', '30min', '1hour', '1day'];
			var req = {type: atype[idx]};

			$('.yi-time li').removeClass('active');
			$($('.yi-time li')[idx]).addClass('active');
			layer.load(2);
			getkdata(req, function(data) {
				layer.closeAll();
				zoom.start = 60;
				zoom.end = 100;
				option = koption(data, req.type);
			})
		})
	})

	// chart事件
	k.on('dataZoom', function(data) {
		// 拖动
		if (data.batch == undefined) {
			zoom.start = data.start;
			zoom.end = data.end;
		} else {
			// 滚动
			zoom.start = data.batch[0].start;
			zoom.end = data.batch[0].end;
		}
	});

	// 加载layui
	layui.define('layer', function(exports) {
		var layer = layui.layer
	});

	// 5分钟更新一次
	$.get(config.host_path + "/float/index/updatebtc");
	setInterval(function() {
		$.get(config.host_path + "/float/index/updatebtc");
	}, 1000*60*5);
})

// 设置全局变量
var tdata = { open: 0, collect: 0, high: 0, low: 0 },
	tcolor = ['#D83F4E', '#1FC65B'],	// 颜色 0-red
	zoom  = { start: 60, end: 100 }		// 初始化dataZoom

/**
 * 获取实时数据
 */
function gettdata() {
	var u = config.host_path + "/Float/Index/getbtc";
	$.get(u, function(res) {
		// 设置颜色
		var copen = tdata.open > res.last
			? tcolor[0] : tcolor[1];
		var ccollect = tdata.collect > res.open
			? tcolor[0] : tcolor[1];
		var clow = tdata.low > res.low
			? tcolor[0] : tcolor[1];
		var chigh = tdata.hign > res.high
			? tcolor[0] : tcolor[1];
		if (tdata.open == res.last) copen = $($(".yi-number")[0]).css('color');
		if (tdata.collect == res.open) ccollect = $($(".yi-number")[1]).css('color');
		if (tdata.low == res.low) clow = $($(".yi-number")[2]).css('color');
		if (tdata.high == res.high) chigh = $($(".yi-number")[3]).css('color');

		tdata.open = res.last;
		tdata.collect = res.open;
		tdata.low  = res.low;
		tdata.high = res.high;

		// 设置显示
		$($(".yi-number")[0]).text(tdata.open);
		$($(".yi-number")[1]).text(tdata.collect);
		$($(".yi-number")[2]).text(tdata.low);
		$($(".yi-number")[3]).text(tdata.high);
		$($(".yi-number")[0]).css('color', copen);
		$($(".yi-number")[1]).css('color', ccollect);
		$($(".yi-number")[2]).css('color', clow);
		$($(".yi-number")[3]).css('color', chigh);
		$.cookie('btc_wbtcopen', tdata.open, {path: '/'});
	});
}

/**
 * 获取K线图数据
 */
function getkdata(d, callback) {
	var u = config.host_path + "/Float/Index/getkdata";

	$.get(u, d, function(res) {
		var odata = JSON.parse(res.k).data,
			data  = odata.map(function (item) {
				item[0] = new Date(item[0]);
				item[0] = d.type == "1day"
					? item[0] = item[0].getFullYear() + "/" + (item[0].getMonth()+1) + "/" + item[0].getDate()
					: item[0] = item[0].getHours() + ":" + item[0].getMinutes();
				return item;
			});

		// 回调
		callback(data, res.timestamp)
	}).fail(function() {
		closeAll()
	});
}

/**
 * 使用worker多线程设置时间
 */
function worker(timestamp) {
	var worker = new Worker("/Public/home/bocai/time.js")
	worker.postMessage(timestamp)
	worker.onmessage = function(data) {
		$("#yi-server-time").html(data.data)
	}
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
function koption(res, type) {
	var dates = res.map(function (item) {
	    return item[0];
	});

	var data = res.map(function (item) {
	    return [+item[1], +item[4], +item[3], +item[2]];
	});

	var option = {};
	option.backgroundColor = '#21202D';
	option.series = [
		{
			// 设置图表类型
			type: 'candlestick',
			name: type,
			data: data,
			itemStyle: {
				color: '#FD1050',
				color0: '#0CF49B',
				borderColor: '#FD1050',
				borderColor0: '#0CF49B'
			},
			markLine: {
				symbol: ['none', 'none'],
	        	data: [{
	        		yAxis: tdata.open	// 全局的开盘数据
	        	}]
			}
		}, 
		kline(5, data), 
		kline(10, data),
		kline(20, data), 
		kline(30, data),
	];
	option.legend = {
		data: [type, 'MA5', 'MA10', 'MA20', 'MA30'],
		inactiveColor: '#777',
		textStyle: { color: '#fff' }
	};
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
	};
	option.xAxis = {
		type: 'category',
		data: dates,
		axisLine: { lineStyle: { color: '#8392A5' } },
        axisTick: { show: false },
	};
	option.yAxis = {
		scale: true,
        position: 'right',
        axisLine: { lineStyle: { color: '#8392A5' } },
        splitLine: { show: true, lineStyle: { color: '#343140'} },
        axisTick: { show: false },
	};
	option.grid = {
        bottom: 80,
        left: 30,
        right: 60
	};
	option.dataZoom = [
		{
			textStyle: {
	            color: '#8392A5'
	        },
	        handleSize: '80%',
	        filterMode: 'empty',
	        dataBackground: {
	            areaStyle: {
	                color: '#8392A5'
	            },
	            lineStyle: {
	                opacity: 0.8,
	                color: '#8392A5'
	            }
	        },
	        handleStyle: {
	            color: '#fff',
	            shadowBlur: 3,
	            shadowColor: 'rgba(0, 0, 0, 0.6)',
	            shadowOffsetX: 2,
	            shadowOffsetY: 2
	        },
	        start: zoom.start,
	        end: zoom.end
	    },
	    {
	    	type: 'inside',
	    }
	];

	return option;
}

/**
 * K线图line
 */
function kline(ma, data) {
	var line = {};

	line.name = 'MA'+ma;
	line.type = 'line';
	line.data = calculateMA(ma, data);
	line.smooth = true;
	line.showSymbol = false;
	line.lineStyle = {
		normal: { width: 1 }
	}
	return line;
}

/**
 * 事件函数处理
 * 获取余额
 */
function balance() {
	layer.load(2);
	$.get(config.host_path+'/Home/Bocai/getbalance', function(res) {
		layer.closeAll();
		layer.alert("您的餘額為：NT$ " + res);
	})
}

/**
 * 返回首页
 */
function gohome() {
	window.location.href = config.host_path
}

/**
 * 加载
 */
function loader() {
	var circle = new Sonic({
		width: 100,
		height: 50,
		padding: 10,
		stepsPerFrame: 2,
		trailLength: 1,
		pointDistance: .03,
		strokeColor: '#6B9EFE',
		step: 'fader',
		fps: 40,
		multiplier: 2,
		setup: function() {
			this._.lineWidth = 5;
		},
		path: [
			['arc', 10, 10, 10, -270, -90],
			['bezier', 10, 0, 40, 20, 20, 0, 30, 20],
			['arc', 40, 10, 10, 90, -90],
			['bezier', 40, 0, 10, 20, 30, 0, 20, 20]
		]
	});

	$('#k-load').append(circle.canvas);
	circle.play();
}

/**
 * 買
 * @param int type 類型1-買漲 2-買跌
 */
function deal(type) {
	var u = config.host_path + "/Home/Bocai/deal/type/"+type
	layer.open({
		type: 2,
		content: u,
		area: dealArea,
		title: "確認訂單",
		skin: "deal-class",
		resize: false,
		scrollbar: false
	})
}

/**
 * 交易記錄
 */
function record() {
	window.open(config.host_path + '/Home/Bocai/getlog')
}
