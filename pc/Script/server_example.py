#!/usr/bin/python
# -*- coding: utf8 -*-
# 微平台开奖脚本
from twisted.internet.protocol import Factory
from twisted.internet import reactor, ssl
from TwistedWebsocket.server import Protocol
import re
import time
import json


class WebSocketHandler(Protocol):

  def onConnect(self):
    for _id, user in self.users.items():
      print("New client connection to id %s" % self.id)
      msg = "connection successful"
      user.sendMessage("%s" % msg)
        
  def onDisconnect(self):
    for _id, user in self.users.items():
      print("%s disconnected" % self.id)

  def onMessage(self, msg):
    for _id, user in  self.users.items():
      file = open('./price.json', 'r')
      file_data = file.read()
      file.close()
      user.sendMessage("%s" % file_data)


class WebSocketFactory(Factory):
  
  def __init__(self):
    self.users = {}
  
  def buildProtocol(self, addr):
    return WebSocketHandler(self.users)

with open("/home/bitao/ssl/bitao999.key") as keyFile:
  with open("/home/bitao/ssl/bitao999.crt") as certFile:
    cert = ssl.PrivateCertificate.loadPEM(keyFile.read() + certFile.read())

port = 12585
print "listen port %s ..." % port
reactor.listenSSL(12585, WebSocketFactory(), cert.options())
reactor.run()
