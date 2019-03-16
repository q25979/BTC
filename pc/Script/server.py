#!/usr/bin/python
# -*- coding: utf8 -*-
# 微平台开奖脚本

from websocket_server import WebsocketServer
from db import Db
import time
import httplib
import json
import random

# 监听连接端口WebSocket端口
PORT = 12585

# 定义全局变量
db = Db()
g_execute_price = 0.0		# 执行价
g_last_price    = 0.0		# 成交价


# 获取随机数，设置 0.0000 ~ 0.9999 之间的随机数
def set_random():
	number = random.randint(0, 1000)
	return float(number) / 10000


# 获取收盘价
def get_close():
	url = 'https://api.huobipro.com/market/history/kline?period=1min&size=1&symbol=btcusdt'
	conn = httplib.HTTPConnection('api.huobipro.com')
	conn.request(method='GET', url=url)
	response = conn.getresponse()
	res = response.read()
	dict_data = json.loads(res)
	return dict_data['data'][0]['close']


# 生成执行价和成交价并且保存数据
def build_price():
	# 一直执行
	while True:
		# 实时获取本地服务器时间
		minue = int(time.strftime('%M', time.localtime()))
		sec   = int(time.strftime('%S', time.localtime()))
		random_price = set_random()
		# 倒计时剩余 00:30 开始到 00:00 生成执行价
		if minue%5 == 4 and sec >= 30 and sec < 60:
			close = get_close()		# 获取收盘价
			if random.randint(0, 1) == 1:
				g_execute_price = close + random_price
			else:
				g_execute_price = close - random_price

		# 生成成交价，并且保存数据库
		if minue%5 == 0 and sec == 0:
			dirction = db.open_direction()	# 开奖方向 0-涨  1-跌
			if not dirction:
				g_last_price = g_execute_price + random_price
			else:
				g_last_price = g_execute_price - random_price
			pass
			print 'number:' + str(db.open_number()) + ' minue:' + str(minue)
			print(' dirction: %s, execute: %s, last: %s' % (dirction, g_execute_price, g_last_price))		
		# 延时0.7s
		time.sleep(0.7)


# 设置当有新客户端接入时的动作
def new_client(client, server):
	print("New client connection to id %d" % client['id'])
	# server.send_message_to_all("你好！")


# 设置当有客户端断开时的动作
def client_left(client, server):
	print("Client(%d) disconnected" % client['id'])


# 设置当接收某个客户端发送信息后的操作
def message_received(client, server, message):
	if len(message) > 200:
		message = message[:200]+'..'
	print("Client(%d) said: %s" % (client['id'], message))


# 测试
build_price()

# 主函数执行
# print 'Service runing...'
# server = WebsocketServer(PORT)
# server.set_fn_new_client(new_client)
# server.set_fn_client_left(client_left)
# server.set_fn_message_received(message_received)
# server.run_forever()	# 让程序一直执行
