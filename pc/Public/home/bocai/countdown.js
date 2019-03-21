var self = this

// 有数据发过来，触发
self.onmessage = function(ev) {
	var timestamp = ev.data	// 获取时间戳

	// 倒计时设置
	var time = new Date(timestamp * 1000),
		m = parseInt(time.getMinutes()),
		s = parseInt(time.getSeconds()),
		open = 5,	// 设置开盘时间
		timer = null

	var minue = open - (m%5) - 1	// 分钟设置为开盘所需时间
	var second = 60 - s
	var data = {}
	var timeset = function() {
		data.open = false	// 未开盘状态
		if (--second < 0) {
			second = 59
			if (--minue < 0) {
				minue = 4
				data.open = true	// 开盘状态
			}
		}

		data.minue = minue
		data.second = second
		data.number = self.setnum(++timestamp)
		data.number = data.number == 0 ? 288 : data.number
		self.postMessage(data)	// 数据返回
		timer = setTimeout(timeset, 1000)	// 时间
	}
	timeset()
}

self.setnum = function(timestamp) {
	var time = new Date(timestamp*1000)
		h = parseInt(time.getHours())
		m = parseInt(time.getMinutes())
		s = parseInt(time.getSeconds())

	return parseInt((h*60+m)/5+1)
}
