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
	uSetPrice: '/home/bocai/getprice',	// 获取BTC数据

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

	worker: null,	// 定时器

	color:  ['#14B143', '#EF232A'],		// 颜色代码 0-涨  1-跌
	aTimeK: ['1min', '5min', '30min', '60min', '1day'],	// 时间K
	aFlag:  [true, false, false, false, false],

	iDirection: 0,	// 购买方向

	/**
	 * 运行微平台
	 */
	run: function() {
		this.initial()			// 初始化
	},

	/**
	 * 初始化
	 */
	initial: function() {
		var self = this
		this.basics()	// 设置倒计时和设置账户余额

		// 初始化定义
		this.klineTime = this.aTimeK[0]
		this.createWebSocket()	// 创建webSocket

		this.K = echarts.init(document.getElementById('k'))	// ECharts初始化
		this.K.showLoading()	// K线图加载	
		this.kEvent()			// K线图事件

		this.switchK()		// 切换时间K选项卡
		this.switchDeal()	// 切换涨跌选项卡
		this.setPrice()		// 设置执行价和成交价

		// 窗口关闭事件
		window.onbeforeunload = function() {
			self.ws.close()	// 关闭webSocket
		}
	},

	/**
	 * 设置基础数据
	 */
	basics: function() {
		var self = this
		if (this.worker != null) this.worker.terminate()
		$.get(this.h+this.uInitial, function(res) {
			self.countDown(res.timestamp)	// 设置倒计时
			$('.deal>.balance>span').html(res.extract_balance)	// 设置账户余额
		})
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
						self.K.hideLoading()
						self.K.setOption(self.koption(eData))
						self.K.resize()

						var c = $('.price li:nth-child(1) .number'),
							o = $('.price li:nth-child(2) .number'),
							l = $('.price li:nth-child(3) .number'),
							h = $('.price li:nth-child(4) .number')
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
						c.text(parseFloat(eData[eData.length-1].close).toFixed(2))
						o.text(parseFloat(eData[eData.length-1].open).toFixed(2))
						l.text(parseFloat(eData[eData.length-1].low).toFixed(2))
						h.text(parseFloat(eData[eData.length-1].high).toFixed(2))
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

		this.K.on('click', function(ev) {
			var c = $('.price li:nth-child(1) .number'),
				o = $('.price li:nth-child(2) .number'),
				l = $('.price li:nth-child(3) .number'),
				h = $('.price li:nth-child(4) .number')
			if (ev.componentSubType == 'candlestick') {
				c.text(ev.data[2])
				o.text(ev.data[1])
				l.text(ev.data[3])
				h.text(ev.data[4])
				if (ev.color.toUpperCase() == self.color[0]) {
					c.addClass('rise').removeClass('fall')
					o.addClass('rise').removeClass('fall')
					l.addClass('rise').removeClass('fall')
					h.addClass('rise').removeClass('fall')
				} else {
					c.addClass('fall').removeClass('rise')
					o.addClass('fall').removeClass('rise')
					l.addClass('fall').removeClass('rise')
					h.addClass('fall').removeClass('rise')
				}
			}
		})
	},

	/**
	 * 设置执行价和成交价
	 */
	setPrice: function() {
		var self = this
		var execute = $('.execute-price>div:nth-last-child(1)')
		var last = $('.last-price>div:nth-last-child(1)')
		var executename = $('.execute-price>div:nth-child(1)')
		var lastname = $('.last-price>div:nth-child(1)')
		var ws = new WebSocket(config.ws_price)

		ws.open = function() {
			console.log('Connection open ...')
			ws.send('Hello')
		}

		ws.onmessage = function(evt) {
			var json = JSON.parse(evt.data)
			execute.text(json.execute_price.toFixed(4))
			last.text(json.last_price.toFixed(4))
			executename.text('第'+json.number+'期-執行價')
			lastname.text('第'+json.number+'期-成交價')
		}

		ws.onclose = function() {
			console.log('Connection closeed.')
			self.setPrice()
		}

		ws.onerror = function(err) {
			console.log(err)
			self.setPrice()
		}
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
				layer.open({type: 2, content: '確認訂單中，請勿重複操作。'})
				$.post(u, d, function(res) {
					layer.closeAll()
					layer.open({
						content: res.msg,
						btn: '確認'
					})

					if (res.code == 0) {
						var balance = parseFloat($('.deal .balance>span').text())-d.money
						$('.deal .balance>span').text(balance.toFixed(2))
						$('[name=money]').val(0)
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

				self.K.showLoading()
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
		var self = this
		this.worker = new Worker("/Public/home/bocai/countdown.js")
		this.worker.postMessage(timestamp)
		this.worker.onmessage = function(data) {
			var obj = data.data;
			if (obj.open) {
				if (sessionStorage.number) {
					layer.closeAll()
					layer.open({
						content: '第'+sessionStorage.number+'期開獎啦，請注意查收。',
						btn: '確認'
					})
				}
				self.basics()	// 重新获取余额
			}

			// 倒计时页面渲染
			obj.minue == 0
				? $(".time>.number").css('color', self.color[1])
				: $(".time>.number").css('color', self.color[0])
			if (obj.minue < 10) obj.minue = "0" + obj.minue
			if (obj.second < 10) obj.second = "0" + obj.second

			time = obj.minue + ":" + obj.second
			$(".time>.number").text(time)
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
		    return [item.open, item.close, item.low, item.high]
		})

		data = data.map(function (item) {
			return [item[0].toFixed(2), item[1].toFixed(2), item[2].toFixed(2), item[3].toFixed(2)]
		})

		var volumes = res.map(function (item) {
			return item.amount
		})

		var labelFont = 'bold 10px Sans-serif'

		var option = {}
		option.animation = false
		
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
				label: {backgroundColor:'#AB1643',color:'white'},
				lineStyle: {type:'dashed'},
				data: [{ yAxis: parseFloat(data[data.length-1][1]).toFixed(2) }]	// 收盘
			},
		}]

	    return option
	}
}
