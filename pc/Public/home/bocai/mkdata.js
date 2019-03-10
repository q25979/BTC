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
	uK: 	  '/Float/Index/getkdata',	// k线图数据
	uInitial: '/Home/Bocai/initial',	// 初始化
	uOrder:   '/Home/Bocai/okorder',	// 下单
	uBtc:     '/Float/Index/ticker',	// 获取BTC数据

	K:  null,	// 初始化K线图
	ws: null,	// webSocket
	wsUrl: 'wss://api.huobi.pro/ws',	// kline数据
	klineTime: '',	// kline时间
	wsLock: false,	// WebSocket锁防止重复请求
	oKOption: {
		// K线图配置
		start: 90,
		end: 100
	},

	color:  ['#14B143', '#EF232A'],		// 颜色代码 0-涨  1-跌
	aTimeK: ['1min', '5min', '30min', '1hour', '1day'],	// 时间K
	aFlag:  [true, false, false, false, false],

	iDirection: 0,	// 购买方向

	/**
	 * 运行微平台
	 */
	run: function() {
		this.initial()			// 初始化
		this.switchK()		// 切换时间K选项卡
		this.switchDeal()	// 切换涨跌选项卡
	},

	/**
	 * 初始化
	 */
	initial: function() {
		var self = this
		$.get(this.h+this.uInitial, function(res) {
			self.countDown(res.timestamp)	// 设置倒计时
			$('.deal>.balance>span').html(res.extract_balance)	// 设置账户余额
		})

		// 初始化定义
		this.klineTime = this.aTimeK[0]
		this.createWebSocket()	// 创建webSocket

		this.K = echarts.init(document.getElementById('k'))	// ECharts初始化
		this.kEvent()	// K线图事件

		// 窗口关闭事件
		window.onbeforeunload = function() {
			self.ws.close()	// 关闭webSocket
		}
	},

	/**
	 * 创建并且判断WebSocket是否支持
	 * @return {[type]} [description]
	 */
	createWebSocket: function() {
		try {
			if ('WebSocket' in window) {
				this.ws = new WebSocket(this.wsUrl)
			} else if ('MozWebSocket' in window) {
				this.ws = new MozWebSocket(this.wsUrl)
			} else {
				layer.open({
					content: '您的瀏覽器不支持K綫圖交易，建議使用新版谷歌瀏覽器，請勿使用IE10以下瀏覽器!',
					btn: '確認'
				})
			}
			this.runWebSocket()
		} catch(e) {
			console.log('WebSocket error in option!')
			// reconnect(url)
		}
	},

	/**
	 * 启动WebSocket
	 * @return {[type]} [description]
	 */
	runWebSocket: function() {
		var self = this
		this.ws.onclose = function() {
			self.wsLock = false
			console.log('连接关闭!')
			self.createWebSocket()
		}
		this.ws.onerror = function() {
			self.wsLock = false
			self.createWebSocket()
		}
		this.ws.onopen = function() {
			self.wsLock = true
			let obj = new Object()
			obj.req = 'market.btcusdt.kline.'+self.klineTime
			obj.id  = 'id1'

			obj = JSON.stringify(obj)
			self.ws.send(obj)
		}
		this.ws.onmessage = function(ev) {
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
						self.K.setOption(self.koption(eData))
						self.K.resize()

						$('.price li:nth-child(1) .number').text(eData[eData.length-1].close)
						$('.price li:nth-child(2) .number').text(eData[eData.length-1].open)
						$('.price li:nth-child(3) .number').text(eData[eData.length-1].low)
						$('.price li:nth-child(4) .number').text(eData[eData.length-1].high)
					}
				}
			}
		}
	},

	/**
	 * K线图事件
	 * @return {[type]} [description]
	 */
	kEvent: function() {
		var self = this
		this.K.on('dataZoom', function(ev) {
			self.oKOption.start = ev.batch[0].start
			self.oKOption.end = ev.batch[0].end
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
				self.aFlag = [false, false, false, false, false]
				self.aFlag[idx] = true

				// 获取数据
				self.klineTime = self.aTimeK[idx]
				if (self.wsLock) self.ws.close()
				self.runWebSocket()
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
	setKLine: function(d) {
		var self = this

		// 点击事件
		var c = $('.parse .number:nth-child(1)')
		var o = $('.parse .number:nth-child(2)')
		var l = $('.parse .number:nth-child(3)')
		var h = $('.parse .number:nth-child(4)')
		this.K.onclick= function(params) {
			var d= params.data
			c.text(d[4])
		}
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
		var self = this
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
		    return [+item.open, +item.close, +item.low, +item.high]
		})

		var volumes = res.map(function (item) {
			return item.vol
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
			start: self.oKOption.start,
			end: self.oKOption.end
		}, {
			type: 'inside',
			xAxisIndex: [0, 1],
			start: self.oKOption.start,
			end: self.oKOption.end
		}]

		option.xAxis = [{
			type: 'category',
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
			gridIndex: 1,
			splitNumber: 2,
			axisLine: { lineStyle: { color: '#777' } },
			splitLine: { show: false },
			axisLabel: { margin: 5, showMaxLabel: false }
		}]

		// 方向大小定位
		option.grid = [{
			left: 10,
			right: 55,
			top: 30,
			height: 200
		}, {
			left: 10,
			right: 55,
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
