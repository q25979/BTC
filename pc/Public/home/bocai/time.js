var self = this

// 有数据发过来，触发
self.onmessage = function(ev) {
	var timestamp = ev.data	// 获取时间戳

	// 设置时间
	var time = new Date(timestamp * 1000),
		h = time.getHours(),
		m = time.getMinutes(),
		s = time.getSeconds()

	// 计数
	var timeset = function() {
		s++
		if (s > 59) {
			s=0
			m++
			if (m > 59) {
				m=0
				h++
				if (h > 23) {
					h=0
				}
			}
		}

		seconds=s, minue=m, hour=h
		if (s == 60) seconds = "00";
		if (m == 60) minue = "00";
		if (h == 24) hour = "00";

		if (s < 10) seconds="0"+s
		if (m < 10) minue="0"+m
		if (h < 10) hour ="0"+h
		self.postMessage(hour+":"+minue+":"+seconds)
		setTimeout(timeset, 1000)	// 时间
	}
	timeset()
}