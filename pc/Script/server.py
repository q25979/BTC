#!/usr/bin/python
# -*- coding: utf8 -*-
# 微平台开奖脚本

from websocket_server import WebsocketServer
import time
import json

# 监听连接端口WebSocket端口
PORT = 12585


# 设置当有新客户端接入时的动作
def new_client(client, server):
	print("New client connection to id %d" % client['id'])
	while True:
		file = open('./price.json', 'r')
		file_data = file.read()
		file.close()
		server.send_message(client, file_data)
		time.sleep(0.8)


# 设置当有客户端断开时的动作
def client_left(client, server):
	print("Client(%d) disconnected" % client['id'])


# 设置当接收某个客户端发送信息后的操作
def message_received(client, server, message):
	if len(message) > 200:
		message = message[:200]+'..'
	print("Client(%d) said: %s" % (client['id'], message))


# 主函数执行
print 'Service runing...'
server = WebsocketServer(PORT)
server.set_fn_new_client(new_client)
server.set_fn_client_left(client_left)
server.set_fn_message_received(message_received)
server.run_forever()	# 让程序一直执行
