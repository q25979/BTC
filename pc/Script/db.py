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


	# test
	def test(self):
		print self.open_direction()


# db = Db()
# db.test()
