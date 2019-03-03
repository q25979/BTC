var self = this

// 有数据发过来，触发
self.onmessage = function(ev) {
	var timeset = function() {
		self.postMessage(ev.data)
		setTimeout(timeset, 1000)
	}
	timeset()
}
