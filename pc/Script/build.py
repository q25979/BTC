#!/usr/bin/python
# -*- coding: utf8 -*-
# 微平台开奖脚本

from db import Db
import time
import httplib
import json
import random

# 定义全局变量
db = Db()


# 获取随机数，设置 0.0000 ~ 0.9999 之间的随机数
def set_random():
	number = random.randint(0, 1000)
	return float(number) / 10000


# 获取收盘价
def get_close():
	url = 'https://api.huobipro.com/market/history/kline?period=1min&size=1&symbol=btcusdt'
	conn = httplib.HTTPConnection('api.huobipro.com')
	try:
		conn.request(method='GET', url=url)
		response = conn.getresponse()
		res = response.read()
		dict_data = json.loads(res)
		return dict_data['data'][0]['close']
	except Exception:
		return 0


# 生成文件保存
def build_file(dic):
	file_name = './price.json'
	file = open(file_name, 'w')
	file.write(json.dumps(dic))
	file.close()


# 生成执行价和成交价并且保存数据
def build_price():
	close = 0
	execute_flag = 1
	g_execute_price = 0		# 执行价
	g_last_price    = 0		# 成交价
	# 一直执行
	while True:
		# 实时获取本地服务器时间
		minue = int(time.strftime('%M', time.localtime()))
		sec   = int(time.strftime('%S', time.localtime()))
		random_price = set_random()
		# 倒计时剩余 00:30 开始到 00:00 生成执行价
		if minue%5 == 4 and sec >= 30 and sec < 60:
			if execute_flag == 1:
				close = get_close()
				if close != 0:
					execute_flag = 0
					if random.randint(0, 1) == 1:
						g_execute_price = close + random_price
					else:
						g_execute_price = close - random_price
					g_execute_price = round(g_execute_price, 4)
					# 生成执行价，把执行价, 写入文档保存
					if int(g_execute_price) > 1:
						dic = {
							'number': db.open_number() + 1,
							'execute_price': g_execute_price,
							'last_price': 0
						}
						build_file(dic)
					else:
						# 获取数据失败，重新获取
						execute_flag = 1

		# 生成成交价，并且保存数据库
		if minue%5 == 0 and sec >= 0 and sec < 30:
			execute_flag = 1
			dirction    = db.open_direction()	# 开奖方向 0-涨  1-跌
			open_number = db.open_number()		# 开奖期号
			if not dirction:
				g_last_price = g_execute_price + random_price
			else:
				g_last_price = g_execute_price - random_price
			
			'''@1
			- 数据全部设置成功之后,首先先判断数据库是否存在该期号的开奖记录
			- 如果没有则保存开奖记录
			- 否则退出
			+ 所需保存到数据表字段的数据:
			  +------+--------------+-------------+----------+-----------+
			  |number|last_direction|execute_price|last_price|create_time|
			  +------+--------------+-------------+----------+-----------+ 
			'''
			l_execute_price = g_execute_price
			l_last_price = round(g_last_price, 4)
			if db.be_open_log() == 0:
				# 开奖还未保存，先保存
				dict_data = {
					'number': int(open_number),
					'last_direction': int(dirction),
					'execute_price': l_execute_price,
					'last_price' : l_last_price,
					'create_time': int(time.time())
				}

				if int(l_execute_price) > 1 and int(l_last_price) > 1:
					if db.add_open_log(dict_data):
						'''@2
						- 第一步添加开奖记录成功
						- 进行第二步
						- 更新交易的记录并且添加余额
						+ 所需更新的数据表：btc_w_minlog
						  - 字段：last_direction, last_money, execute_price, last_price
						'''
						dict_save_data = {
							'buy_number': open_number,
							'last_direction': dirction,
							'execute_price': l_execute_price,
							'last_price': l_last_price
						}
						db.update_buy_status(dict_save_data)
						# 状态全部更新成功，执行价和开奖信息用WebSocket返回
						dic = {
							'number': open_number,
							'execute_price': l_execute_price,
							'last_price': l_last_price
						}
						build_file(dic)
						print 'number:' + str(open_number) + ' minue:' + str(minue)
						print(' direction: %s, execute: %s, last: %s' % (dirction, l_execute_price, l_last_price))
					else:
						# 添加开奖记录失败了
						print('%d Number lottery failed!' % (open_number))
				else:
					pass
			else:
				# 已经保存数据库不执行
				pass

		# 延时0.7s
		time.sleep(0.7)


print 'price building...'
build_price()
