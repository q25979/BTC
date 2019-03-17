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
				VALUES (%s, %s, %s, %s, %s)" % \
				(dict_data['last_direction'], dict_data['number'], dict_data['execute_price'], \
					dict_data['last_price'], dict_data['create_time'])
		try:
			self._execute(sql)
			self.db.commit()
			return 1
		except:
			self.db.rollback()
			return 0
