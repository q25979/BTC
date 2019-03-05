/**
 * 用worker实现自定义延时
 *
 * var x = new Worker('./path.js')
 * x.postMessage 发送数据
 * x.onmessage = function(obj) {}
 */

var self = this

// 有数据发过来，触发
self.onmessage = function(ev) {
	var timeset = function() {
		// 接收过来的时间（单位毫秒）
		self.postMessage(ev.data)
		setTimeout(timeset, ev.data)
	}
	timeset()
}
