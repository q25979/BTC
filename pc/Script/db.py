#!/usr/bin/python
# -*- coding: utf-8 -*-

'''
创建日期：2019年3月16日
作者：@671
功能：微平台操作数据，自动开奖脚本
Python版本：V2.7
'''

import MySQLdb
import time

class Db:
	__host = '127.0.0.1'	# 主机地址
	__user = 'root'			# 数据库账号
	__pass = 'root'			# 数据库密码
	__dbname = 'btn'		# 数据名称
	

	# 构造函数
	def __init__(self):
		# 打开连接数据库
		self.db = MySQLdb.connect(self.__host, self.__user, self.__pass, self.__dbname)
		self.cursor = self.db.cursor()


	# 析构函数
	def __del__(self):
		self.db.close()


	# 执行SQL语句
	def _execute(self, sql):
		self.cursor.execute(sql)


	# 设置当前开奖期号
	def open_number(self):
		hour  = int(time.strftime('%H', time.localtime()))
		minue = int(time.strftime('%M', time.localtime()))
		return (hour*60+minue)/5


	# 设置当前开盘方向
	def open_direction(self):
		sql = "SELECT btc_w_openset.set FROM btc_w_openset WHERE number="+str(self.open_number())
		self._execute(sql)
		info = self.cursor.fetchone()
		return info[0]


	# 判断是否存在开奖记录
	def be_open_log(self):
		cur_date  = time.strftime('%Y-%m-%d', time.localtime())
		today_time = int(time.mktime(time.strptime(cur_date, '%Y-%m-%d')))	# 当日00:00:00 时间戳
		start_time = today_time + 30
		end_time   = today_time + 30 + 24 * 60 * 60

		sql = "SELECT * FROM btc_w_openlog WHERE \
				number = %d and create_time > %d and create_time < %d" \
				% (self.open_number(), start_time, end_time)
		
		self._execute(sql)
		result = self.cursor.fetchone()
		if not result:
			return 0
		else:
			return 1


	# 添加开奖记录
	def add_open_log(self, dict_data):
		sql = "INSERT INTO btc_w_openlog( \
				last_direction, number, execute_price, last_price, create_time) \
				VALUES (%d, %d, %f, %f, %d)" % \
				(dict_data['last_direction'], dict_data['number'], dict_data['execute_price'], \
					dict_data['last_price'], dict_data['create_time'])
		try:
			self._execute(sql)
			self.db.commit()
			return 1
		except:
			self.db.rollback()
			return 0


	# 获取开奖的赔率
	def get_odds(self):
		sql = "SELECT `odds_set` FROM btc_w_set where id = 1"
		self._execute(sql)
		result = self.cursor.fetchone()
		return result[0]


	# 更新购买状态
	def update_buy_status(self, dict_data):
		cur_date  = time.strftime('%Y-%m-%d', time.localtime())
		today_time = int(time.mktime(time.strptime(cur_date, '%Y-%m-%d')))	# 当日00:00:00 时间戳
		start_time = today_time + 30
		end_time   = today_time + 30 + 24 * 60 * 60

		# 查询购买本期的人的ID
		sql = "SELECT `id`, `uid`, `money`, `buy_direction` FROM btc_w_minlog WHERE \
				buy_number = %d and buy_time > %d and buy_time < %d and last_direction = -1" \
				% (dict_data['buy_number'], start_time, end_time)
		self._execute(sql)

		results = self.cursor.fetchall()
		for row in results:
			# 如果中奖更改last_money状态
			if row[3] == dict_data['last_direction']:
				# 给用户余额加钱
				d_money = self.get_odds() * row[2]
				sql_user_account = "UPDATE btc_user_account SET \
						extract_balance = extract_balance + %f WHERE \
						user_id = '%s'" \
						% (d_money, row[1])
				self._execute(sql_user_account)
				self.db.commit()
			else:
				d_money = 0.00

			# 更新开奖状态
			sql_w_minlog = "UPDATE btc_w_minlog SET \
					last_direction = %d, last_money = %f, \
					execute_price = %f, last_price = %f WHERE id = %d" \
					% (dict_data['last_direction'], d_money, \
						dict_data['execute_price'], dict_data['last_price'], row[0])
			self._execute(sql_w_minlog)
			self.db.commit()
		return 1
