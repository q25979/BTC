/**
 * 移动端微平台
 * 作者：@671
 * 时间：2019年3月5日
 */


var w = WMProgram = {

	// 请求接口域名
	h: config.host_path,

	// k线图数据
	uK: '/Float/Index/getkdata',

	// 获取余额
	uBalance: '/Home/Bocai/getbalance',

	// 交易
	uDealLog: '/Home/Bocai/getlog',


	/**
	 * 自定义延时
	 * @param  {[type]}   time     
	 * @param  {Function} callback 
	 */
	delay: function(time, callback) {
		var worker = new Worker('/Public/home/bocai/worker/delay.js')

		worker.postMessage(time)
		worker.onmessage = function(data) {
			callback(data)
		}
	},

	/**
	 * 配置MA(时间)线
	 * @param  {[number]} dayCount
	 * @param  {[object]} data
	 * @return {[type]}
	 */
	calculateMA: function(dayCount, data) {
		var result = []
		for (var i=0, len=data.length; i<len; i++) {
			if (i < dayCount) {
				result.push('-')
				continue;
			}
			var sum = 0
			for (var j=0; j<dayCount; j++) {
				sum += data[i-j][1]
			}
			result.push((sum/dayCount).toFixed(2))
		}
		return result
	},

	/**
	 * 配置K线图
	 * @param  {[object]} res
	 * @return {[object]}
	 */
	koption: function(res) {
		var dates = res.map(function (item) {
		    return item[0];
		});

		var data = res.map(function (item) {
		    return [+item[1], +item[4], +item[3], +item[2]];
		});

		var option = {}
		option.animation = false
		option.color = []
		
		option.legend.top = 30
		option.legend.data = ['MA5', 'MA10', 'MA20']

		option.tooltip = {
			triggerOn: 'none',
			transitionDuration: 0,
			confine: true,
			bordeRadius: 4,
			bordeWidth: 1,
			borderColor: '#333',
			backgroundColor: 'rgba(255,255,255,0.9)',
			textStyle: {
				fontSize: 12,
				color: '#333'
			},
			position: function(pos, params, el, elRect, size) {
				var obj = { top: 60 }
				obj[['left', 'right'][+(pos[0]<size.viewSize[0]/2)]] = 5
				return obj
			}
		}

		option.axisPointer = {
			link: [{
				xAxisIndex: [0, 1]
			}]
		}

		option.dataZoom = [{
			type: 'slider',
			xAxisIndex: [0, 1],
			realtime: false,
			start: 20,
			end: 70,
			top: 65,
			height: 20
		}, {
			type: 'inside',
			xAxisIndex: [0, 1],
			start: 40,
			end: 70,
			top: 30,
			height: 20
		}]

		option.xAxis = [{
			type: 'category',
			data: dates,
			boundaryGap: false,
			axisLine: { lineStyle: { color: '#777' } },
			min: 'dataMin',
			max: 'dataMax',
			axisPointer: { show: true }
		}, {
			type: 'category',
			gridIndex: 1,
			data: dates,
			scale: true,
			boundaryGap: false,
			splitLine: {show: false},
			axisLabel: {show: false},
			axisTick: {show: false},
			axisLine: { lineStyle: { color: '#777' } },
			splitNumber: 20,
			min: 'dataMin',
			max: 'dataMax',
			axisPointer: {
				type: 'shadow',
				label: {show: false},
				triggerToolip: true,
				handle: {
					show: true,
					margin: 30,
					color: '#b80c00'
				}
			}
		}]

		option.yAxis = [{
			scale: true,
			splitNumber: 2,
			axisLine: { lineStyle: { color: '#777' } },
			splitLine: { show: true },
			axisTick: { show: true },
			axisLabel: {
				inside: true,
				formatter: '{value}\n'
			}
		}, {
			scale: true,
			gridIndex: 1,
			splitNumber: 2,
			axisLabel: { show: false },
			axisLine: { show: false },
			axisTick: { show: false },
			splitLine: { show: false }
		}]

		option.grid = [{
			left: 20,
			right: 20,
			top: 110,
			height: 120
		}, {
			left: 20,
			right: 20,
			height: 40,
			top: 260
		}]

		option.graphic = [{
			type: 'group',
			left: 'center',
			top: 70,
			width: 300,
			bounding: 'raw',
			children: [{
				id: 'MA5',
				type: 'text',
				style: {fill: colorList[1], font: labelFont},
				left: 0
			}, {
				id: 'MA10',
				type: 'text',
				style: {fill: colorList[2], font: labelFont},
				left: 'center'
			}, {
				id: 'MA20',
				type: 'text',
				style: {fill: colorList[3], font: labelFont},
				right: 0
			}]
		}]

		option.series = [{
			name: 'Volume',
			type: 'bar',
			xAxisIndex: 1,
			yAxisIndex: 1,
			itemStyle: {
				normal: { color: '#7fbe9e' },
				emphasis: { color: '#140' }
			},
			data: volumes
		}, {
			type: 'candlestick',
			name: '日K',
			data: data,
			itemStyle: {
				normal: {
	                color: '#ef232a',
	                color0: '#14b143',
	                borderColor: '#ef232a',
	                borderColor0: '#14b143'
	            },
	            emphasis: {
	                color: 'black',
	                color0: '#444',
	                borderColor: 'black',
	                borderColor0: '#444'
	            }
			}
		}, {
	        name: 'MA5',
	        type: 'line',
	        data: dataMA5,
	        smooth: true,
	        showSymbol: false,
	        lineStyle: {
	            normal: {
	                width: 1
	            }
	        }
	    }, {
	        name: 'MA10',
	        type: 'line',
	        data: dataMA10,
	        smooth: true,
	        showSymbol: false,
	        lineStyle: {
	            normal: {
	                width: 1
	            }
	        }
	    }, {
	        name: 'MA20',
	        type: 'line',
	        data: dataMA20,
	        smooth: true,
	        showSymbol: false,
	        lineStyle: {
	            normal: {
	                width: 1
	            }
	        }
	    }]

	    return option
	}
}
