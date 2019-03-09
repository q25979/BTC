/**
 * 移动端微平台
 * 作者：@671
 * 时间：2019年3月5日
 */

var w = WMProgram = {

	/**
	 * 请求接口设置
	 * h是域名
	 */
	h: config.host_path,				// 域名
	uK: '/Float/Index/getkdata',		// k线图数据
	uInitial: '/Home/Bocai/initial',	// 初始化
	uOrder: '/Home/Bocai/okorder',		// 下单

	color: ['#14B143', '#EF232A'],		// 颜色代码 0-涨  1-跌
	aTimeK: ['1min', '5min', '30min', '1hour', '1day'],	// 时间K
	aFlag: [true, false, false, false, false],

	iDirection: 0,	// 购买方向

	/**
	 * 运行微平台
	 */
	run: function() {
		var req = {type: this.aTimeK[0]}

		this.getKData(req)	// 获取K线图
		this.init()
		this.switchK()		// 切换时间K选项卡
		this.switchDeal()	// 切换涨跌选项卡
	},

	/**
	 * 初始化
	 */
	init: function() {
		var self = this
		$.get(this.h+this.uInitial, function(res) {
			self.countDown(res.timestamp)	// 设置倒计时
			$('.deal>.balance>span').html(res.extract_balance)	// 设置账户余额
		})
	},

	/**
	 * 下单
	 */
	order: function() {
		var u = this.h + this.uOrder
		var d = new Object()

		d.buy_direction = this.iDirection	// 购买方向
		d.money = $('[name=money]').val()

		if (d.money <= 0) {
			layer.open({
				content: '下注金額輸入錯誤',
				btn: '確認'
			})
			return ;
		}
		if (parseInt($('.dets .time .number').text().split(':')[0]) == 0) {
			layer.open({
				content: '最後一分鐘禁止購買',
				btn: '確認'
			})
			return ;
		}

		layer.open({
			content: '確認下注？',
			btn: ['確認', '取消'],
			yes: function(index) {
				layer.close(index)
				$.post(u, d, function(res) {
					layer.open({
						content: res.msg,
						btn: '確認'
					})

					if (res.code == 0) {
						var balance = parseFloat($('.deal .balance>span').text())-d.money
						$('.deal .balance>span').text(balance.toFixed(2))
						$('[name=money]').val(' ')
					}
				})
			}
		})
	},

	/**
	 * 切换时间K选项卡
	 */
	switchK: function() {
		var k = $('.timek>ul>li')
		var self = this

		k.each(function(idx) {
			$(this).click(function() {
				if (self.aFlag[idx]) return ;
				k.children('span').removeClass('active')
				var span = $(k[idx]).children('span')
				span.addClass('active')

				var d = {type: self.aTimeK[idx]};
				self.aFlag = [false, false, false, false, false]
				self.aFlag[idx] = true
			})
		})
	},

	/**
	 * 切换涨跌选项卡
	 */
	switchDeal: function() {
		var deal = $('.deal>.direction>div')
		var self = this
		var obj = {}

		deal.each(function(idx) {
			$(this).click(function() {
				// 样式设置
				obj.background = self.color[idx]
				obj.color = 'white'
				var borderColor = self.color[idx]
				if (idx == 0) {
					$(deal[0]).css(obj)
					$(deal[1]).css({'background': 'transparent', 'color': borderColor})
					$('.deal>.direction').css('border-color', borderColor)
				} else {
					$(deal[0]).css({'background': 'transparent', 'color': borderColor})
					$(deal[1]).css(obj)
					$('.deal>.direction').css('border-color', borderColor)
				}
				$('.deal>.confirm').css('background', self.color[idx])
				self.iDirection = idx
			})
		})
	},

	/**
	 * 跳转
	 */
	jump: function(url) {

		window.location.href = url
	},

	/**
	 * 获取K线图数据
	 * @return {[type]} [description]
	 */
	getKData: function(d) {
		var self = this

		var k = echarts.init(document.getElementById('k'))
		k.showLoading()
		$.get(this.h+this.uK, d, function(res) {
			var odata = JSON.parse(res.k).data
			data  = odata.map(function (item) {
				item[0] = new Date(item[0]);
				item[0] = d.type == "1day"
					? item[0] = item[0].getFullYear() + "/" + (item[0].getMonth()+1) + "/" + item[0].getDate()
					: item[0] = item[0].getHours() + ":" + item[0].getMinutes();
				return item;
			});

			k.hideLoading()
			k.setOption(self.koption(data))
		})
	},

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
	 * 设置倒计时
	 * @param  {[int]} timestamp
	 */
	countDown: function(timestamp) {
		var worker = new Worker("/Public/home/bocai/countdown.js")
		var self = this
		worker.postMessage(timestamp)
		worker.onmessage = function(data) {
			var obj = data.data;
			if (obj.open) {
				console.log('开盘!')
			}

			// 页面渲染
			obj.minue == 0
				? $(".time>.number").css('color', self.color[1])
				: $(".time>.number").css('color', self.color[0])
			if (obj.minue < 10) obj.minue = "0" + obj.minue
			if (obj.second < 10) obj.second = "0" + obj.second

			time = obj.minue + ":" + obj.second
			$(".time>.number").text(time);
			$(".issue>.number").text(obj.number)
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
		    return item[0]
		})

		var data = res.map(function (item) {
		    return [+item[1], +item[4], +item[3], +item[2]]
		})

		var volumes = res.map(function (item) {
			return item[5]
		})

		var labelFont = 'bold 10px Sans-serif'

		var option = {}
		option.animation = false
		
		option.legend = {
			top: 30,
			data: ['MA5', 'MA10', 'MA20']
		}

		option.tooltip = {
			triggerOn: 'none',
			transitionDuration: 0,
			confine: true,
			bordeRadius: 4,
			bordeWidth: 1,
			borderColor: '#333',
			backgroundColor: 'rgba(255,255,255,0.9)',
			textStyle: {
				fontSize: 10,
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
			show: false,
			type: 'slider',
			xAxisIndex: [0, 1],
			realtime: false,
			start: 90,
			end: 100
		}, {
			type: 'inside',
			xAxisIndex: [0, 1],
			start: 90,
			end: 100
		}]

		option.xAxis = [{
			type: 'category',
			data: dates,
			boundaryGap: false,
			axisTick: {show: false},
			axisLabel: {show: false},
			axisLine: { lineStyle: { color: '#ccc' } },
			min: 'dataMin',
			max: 'dataMax',
			axisPointer: { show: true }
		}, {
			type: 'category',
			gridIndex: 1,
			data: dates,
			scale: true,
			boundaryGap: false,
			axisLine: { lineStyle: { color: '#777' } },
			splitNumber: 20,
			min: 'dataMin',
			max: 'dataMax',
			axisPointer: {
				type: 'shadow',
				label: {show: false},
				triggerToolip: true
			}
		}]

		option.yAxis = [{
			scale: true,
			position: 'right',
			axisLine: { lineStyle: { color: '#777' } },
			splitLine: { show: true, lineStyle: { color: '#f5f5f5' } },
			axisLabel: { margin: 5 }
		}, {
			scale: true,
			position: 'right',
			max: '300',
			gridIndex: 1,
			splitNumber: 2,
			axisLine: { lineStyle: { color: '#777' } },
			splitLine: { show: false },
			axisLabel: { margin: 5, showMaxLabel: false }
		}]

		// 方向大小定位
		option.grid = [{
			left: 10,
			right: 45,
			top: 30,
			height: 200
		}, {
			left: 10,
			right: 45,
			height: 60,
			top: 230
		}]

		option.graphic = [{
			type: 'group',
			left: 'center',
			top: 70,
			width: 300,
			bounding: 'raw'
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
			data: data,
			itemStyle: {
				normal: {
	                color: '#ef232a',
	                color0: '#14b143',
	                borderColor: '#ef232a',
	                borderColor0: '#14b143',
	            },
	            emphasis: {
	                color: 'black',
	                color0: '#444',
	                borderColor: 'black',
	                borderColor0: '#444'
	            }
			},
			markLine: {
				symbol: ['none', 'none'],
				data: [{ yAxis: parseInt(data[data.length-1][1]) }]	// 收盘
			},
		}]

	    return option
	}
}
