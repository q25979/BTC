/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : btn

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-13 17:29:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for btc_admin
-- ----------------------------
DROP TABLE IF EXISTS `btc_admin`;
CREATE TABLE `btc_admin` (
  `admin_id` varchar(32) NOT NULL COMMENT '后台管理id',
  `user_name` varchar(16) NOT NULL COMMENT '管理员账号名',
  `pass_word` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `login_ip` varchar(16) DEFAULT NULL COMMENT '最后登录的IP',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-正常使用 -1-封号',
  `end_time` varchar(10) DEFAULT NULL COMMENT '最后登录的时间',
  `identity` tinyint(1) NOT NULL DEFAULT '2',
  `create_time` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`admin_id`,`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台管理表';

-- ----------------------------
-- Records of btc_admin
-- ----------------------------
INSERT INTO `btc_admin` VALUES ('10000000000000000000000000000000', 'zyan001', '62fa7bbe115476d6b10ecb376839e996', null, '0', null, '1', null, '0', null, null);
INSERT INTO `btc_admin` VALUES ('admin001', 'admin001', '4192d21d2e09a8f2b97c5467e8e5d3ce', null, '0', null, '2', null, '0', null, null);
INSERT INTO `btc_admin` VALUES ('admin002', 'admin002', '62fa7bbe115476d6b10ecb376839e996', null, '0', null, '2', null, '0', null, null);

-- ----------------------------
-- Table structure for btc_authentication
-- ----------------------------
DROP TABLE IF EXISTS `btc_authentication`;
CREATE TABLE `btc_authentication` (
  `authentication_id` varchar(32) NOT NULL COMMENT '认证ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户ID',
  `f_status_url` varchar(255) NOT NULL COMMENT '正面身份证图片的url',
  `r_status_url` varchar(255) NOT NULL COMMENT '身份证反面的url',
  `hand_status_url` varchar(255) NOT NULL COMMENT '手持身份证的URL',
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '0-待审核 1-审核通过 -1 审核不通过',
  `delete_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`authentication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='认证审核表';

-- ----------------------------
-- Records of btc_authentication
-- ----------------------------
INSERT INTO `btc_authentication` VALUES ('A2018052921530215276019826337829', 'z2018052921374715276010670107453', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d5b2733bca.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d5b338007e.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e52f053724.jpg', '-1', null, '1527665401', '1527601982', '0');
INSERT INTO `btc_authentication` VALUES ('A2018052922263315276039930224648', 'z2018052921374715276010670107453', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d6300044aa.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d631067b64.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e52f053724.jpg', '-1', null, '1527665401', '1527603993', '0');
INSERT INTO `btc_authentication` VALUES ('a2018052923451315276087134228546', 'B2018051510104015263502407538798', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d757138fb6.png', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d75819d1e2.jpg', '0', '-1', null, '1527609157', '1527608713', '0');
INSERT INTO `btc_authentication` VALUES ('A2018052923552415276093240283219', 'G2018052623401215273492129960960', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d77d95705d.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d77e5889d2.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-29/5b0d78b44b942.jpg', '-1', null, '1527609669', '1527609324', '0');
INSERT INTO `btc_authentication` VALUES ('A2018053015245315276650939619144', 'z2018052921374715276010670107453', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e51b085c0b.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e51be3f6b5.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e52f053724.jpg', '1', null, '1527666660', '1527665093', '0');
INSERT INTO `btc_authentication` VALUES ('a2018060314340815280076488162918', 'G2018060313071815280024388174332', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b138bd51a8a3.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b138bdd80980.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b1396480e9fc.jpg', '-1', null, '1528010316', '1528007648', '0');
INSERT INTO `btc_authentication` VALUES ('A2018061300232515288206054220058', 'D2018061300202515288204253732655', 'http://blnance66.com/Uploads/action/IDcard/2018-06-13/5b1ff358eea7a.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-13/5b1ff36cd517c.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-13/5b1ff377b22e0.jpg', '-1', null, '1528820746', '1528820605', '0');
INSERT INTO `btc_authentication` VALUES ('A2018062709514115300643018617302', 'c2018062612085515299861355405624', 'http://blnance66.com/Uploads/action/IDcard/2018-06-27/5b32ed9870876.jpeg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-27/5b32ed9edefe5.jpeg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-27/5b32eda652864.jpeg', '1', null, '1530078247', '1530064301', '0');
INSERT INTO `btc_authentication` VALUES ('a2018063019423115303589517740699', 'a2018062615000515299964051541616', 'http://blnance66.com/Uploads/action/IDcard/2018-06-30/5b376c4c1a2a4.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-30/5b376c5e7cf46.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-30/5b376ca4d5b57.jpg', '1', null, '1530359329', '1530358951', '0');
INSERT INTO `btc_authentication` VALUES ('a2018071021023615312277566040214', 'B2018071020412515312264856001488', 'http://blnance66.com/Uploads/action/IDcard/2018-07-10/5b44abe72455f.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-10/5b44aca702471.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-10/5b44ae6831a42.jpg', '1', null, '1531227864', '1531227756', '0');
INSERT INTO `btc_authentication` VALUES ('a2018071313213215314592927797212', 'A2018071222505615314070569467166', 'http://blnance66.com/Uploads/action/IDcard/2018-07-13/5b4836b6c2d58.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-13/5b4836c2686ef.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-13/5b4836d7f1113.jpg', '1', null, '1531463451', '1531459292', '0');
INSERT INTO `btc_authentication` VALUES ('a2018071617172515317326454346581', 'q2018071514213715316356977114670', 'http://blnance66.com/Uploads/action/IDcard/2018-07-16/5b4c622d5c4b7.JPG', 'http://blnance66.com/Uploads/action/IDcard/2018-07-16/5b4c629fb9cc0.JPG', 'http://blnance66.com/Uploads/action/IDcard/2018-07-16/5b4c6262ba036.JPG', '1', null, '1531733168', '1531732645', '0');
INSERT INTO `btc_authentication` VALUES ('b2018052814500515274902050055180', 'B2018051510104015263502407538798', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0ba6037ff26.png', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0ba67036097.png', '0', '1', null, '1527490247', '1527490205', '0');
INSERT INTO `btc_authentication` VALUES ('B2018053000024215276097625126902', 'G2018052623401215273492129960960', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0d798b03197.jpeg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0d7999c976b.jpeg', '0', '1', null, '1527609791', '1527609762', '0');
INSERT INTO `btc_authentication` VALUES ('b2018060313143115280028717637973', 'G2018060313071815280024388174332', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b137916b7dd7.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b137934a79de.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b1396480e9fc.jpg', '-1', null, '1528010316', '1528002871', '0');
INSERT INTO `btc_authentication` VALUES ('B2018060314234215280070225808920', 'a2018060313265415280036142856758', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b138961bd657.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b13896a174f0.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b138979d8188.jpg', '1', null, '1528007262', '1528007022', '0');
INSERT INTO `btc_authentication` VALUES ('b2018060717063015283623900945296', 'b2018060717050615283623060351172', 'http://blnance66.com/Uploads/action/IDcard/2018-06-07/5b18f58755638.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-07/5b18f58dd9c1f.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-07/5b18f5928035e.jpg', '-1', null, '1528362423', '1528362390', '0');
INSERT INTO `btc_authentication` VALUES ('B2018062522501815299382184202742', 'D2018062522390515299375453098002', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b3100a1ce947.jpeg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b3100aa870f4.jpeg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b310125a20f8.jpeg', '1', null, '1529940864', '1529938218', '0');
INSERT INTO `btc_authentication` VALUES ('B2018071516052315316419233711677', 'z2018071321035315314870335446208', 'http://blnance66.com/Uploads/action/IDcard/2018-07-15/5b4b0010a495b.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-15/5b4b002885db4.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-15/5b4b003fbb2ef.jpg', '1', null, '1531642209', '1531641923', '0');
INSERT INTO `btc_authentication` VALUES ('c2018051523095615263969965038798', 'D2018050922545015258776900852531', 'http://blnance66.com/Uploads/action/IDcard/2018-05-15/5afaf81aa4fa6.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-15/5afaf83ed2c12.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0aee94c2f14.png', '-1', null, '1527443097', '1526396996', '0');
INSERT INTO `btc_authentication` VALUES ('c2018060409270615280756269419948', 'G2018060320571315280306337373767', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b149557b8628.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b149565b52dc.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b1495826005c.jpg', '1', null, '1528085551', '1528075626', '0');
INSERT INTO `btc_authentication` VALUES ('c2018061718305515292314555134460', 'b2018061221310015288102605757749', 'http://blnance66.com/Uploads/action/IDcard/2018-06-17/5b2638108da39.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-17/5b26385beae32.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-17/5b26381ac3c39.jpg', '1', null, '1529231727', '1529231455', '0');
INSERT INTO `btc_authentication` VALUES ('c2018062514253615299079364793599', 'q2018062509385715298907370574160', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b308ac87f85a.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b308ad231c3f.png', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b308adcdfe61.jpg', '1', null, '1529907978', '1529907936', '0');
INSERT INTO `btc_authentication` VALUES ('c2018071110262715312759871714439', 'G2018070922145315311456936023385', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b456ac4aee33.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b456ac9d86f1.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b456acda6e52.jpg', '1', null, '1531295085', '1531275987', '0');
INSERT INTO `btc_authentication` VALUES ('D2018060415510815280986688824653', 'q2018060414352815280941282359801', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14ef59932ca.png', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14ef678399e.png', '0', '1', null, '1528098836', '1528098668', '0');
INSERT INTO `btc_authentication` VALUES ('D2018071218014815313897082940085', 'D2018071217425015313885700332916', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4726f66e130.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4726fe8826d.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4727079aa93.jpg', '1', null, '1531389796', '1531389708', '0');
INSERT INTO `btc_authentication` VALUES ('G2018052801441815274430588609806', 'D2018050922545015258776900852531', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0aee6233e42.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0aee6df16f2.png', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0aee94c2f14.png', '1', null, '1527443145', '1527443058', '0');
INSERT INTO `btc_authentication` VALUES ('G2018060417473815281056585677509', 'c2018060417125115281035716226873', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b150ab0e60e0.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b150ab6c4d65.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b150acaad563.jpg', '1', null, '1528105692', '1528105658', '0');
INSERT INTO `btc_authentication` VALUES ('G2018060816565515284482150851612', 'A2018060816492515284477655068427', 'http://blnance66.com/Uploads/action/IDcard/2018-06-08/5b1a4491c1f83.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-08/5b1a44983fe0b.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-08/5b1a44cf932af.jpg', '1', null, '1528448452', '1528448215', '0');
INSERT INTO `btc_authentication` VALUES ('G2018071115230615312937869101986', 'B2018071115174515312934650701210', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b45b01f2ed11.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b45b03994993.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b45b05730954.jpg', '1', null, '1531295084', '1531293786', '0');
INSERT INTO `btc_authentication` VALUES ('H2018060315181415280102949139721', 'G2018060313071815280024388174332', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b13962ce711a.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b139630cfbe9.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b1396480e9fc.jpg', '1', null, '1528010338', '1528010294', '0');
INSERT INTO `btc_authentication` VALUES ('H2019031317064015524680003363983', 'q2018090611234315362042232669474', 'http://localhost:8081/Uploads/action/IDcard/2019-03-13/5c88c81abe302.jpg', 'http://localhost:8081/Uploads/action/IDcard/2019-03-13/5c88c8116af60.jpg', 'http://localhost:8081/Uploads/action/IDcard/2019-03-13/5c88c80b628b7.jpg', '0', null, '1552468000', '1552468000', '0');
INSERT INTO `btc_authentication` VALUES ('q2018060720173515283738553102482', 'b2018060717050615283623060351172', 'http://blnance66.com/Uploads/action/IDcard/2018-06-07/5b19222b5d512.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-07/5b19224c5c28b.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-07/5b192257d2a41.jpg', '-1', null, '1528433375', '1528373855', '0');
INSERT INTO `btc_authentication` VALUES ('q2018070923321415311503347467760', 'a2018070923171615311494368916322', 'http://blnance66.com/Uploads/action/IDcard/2018-07-09/5b437fc8ad9b6.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-09/5b437fb324556.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-09/5b437ff318afb.jpg', '1', null, '1531152291', '1531150334', '0');
INSERT INTO `btc_authentication` VALUES ('z2018060302025015279625706670111', 'c2018060301570315279622236824644', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b12dbbb88ee4.jpeg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b12dbc6cff63.jpeg', '0', '-1', null, '1527962663', '1527962570', '0');
INSERT INTO `btc_authentication` VALUES ('z2018060315001815280092185726730', 'B2018060314494815280085889461708', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b1391f51975a.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b1391fd3ccba.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b13922484049.jpg', '1', null, '1528009442', '1528009218', '0');
INSERT INTO `btc_authentication` VALUES ('z2018060414171715280930372383950', 'b2018060414125815280927787957880', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14d96081114.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14d96900073.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14d98ba75d5.jpg', '1', null, '1528093362', '1528093037', '0');
INSERT INTO `btc_authentication` VALUES ('z2018071220231215313981923674464', 'D2018071217595215313895922312343', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4747c05aac4.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4747cb7d7c9.jpg', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b47482cf11db.jpg', '1', null, '1531398876', '1531398192', '0');

-- ----------------------------
-- Table structure for btc_bank
-- ----------------------------
DROP TABLE IF EXISTS `btc_bank`;
CREATE TABLE `btc_bank` (
  `bank_id` varchar(32) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_type` varchar(1) NOT NULL COMMENT '1主银行2.银行分行',
  `bank_parent` varchar(32) NOT NULL DEFAULT '0' COMMENT '父类ID',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of btc_bank
-- ----------------------------
INSERT INTO `btc_bank` VALUES ('a2018050920400315258696034838354', '0040152 臺銀新竹', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869603');
INSERT INTO `btc_bank` VALUES ('a2018050920481615258700968513409', '0040211 臺銀高加', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870096');
INSERT INTO `btc_bank` VALUES ('a2018050920491315258701530905375', '0040233 臺銀臺東', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870153');
INSERT INTO `btc_bank` VALUES ('A2018050920552615258705261998477', '0040392 臺銀馬祖', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870526');
INSERT INTO `btc_bank` VALUES ('a2018050920563015258705903482364', '0040439 臺銀頭份', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870590');
INSERT INTO `btc_bank` VALUES ('a2018050921004715258708477917490', '0040521 臺銀龍山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870847');
INSERT INTO `btc_bank` VALUES ('A2018050921010815258708689863621', '0040543 臺銀信義', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870868');
INSERT INTO `btc_bank` VALUES ('A2018050921011715258708777661043', '0040554 臺銀復興', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870877');
INSERT INTO `btc_bank` VALUES ('A2018050921012615258708864600776', '0040565 臺銀三民', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870886');
INSERT INTO `btc_bank` VALUES ('A2018050921025415258709740958520', '0040646 臺銀松山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870974');
INSERT INTO `btc_bank` VALUES ('A2018050921032115258710019719533', '0040679 臺銀太保', '2', 'z2018050920384315258695239267163', '0', null, null, '1525871001');
INSERT INTO `btc_bank` VALUES ('A2018050922233515258758154981358', '0040794 臺銀黎明', '2', 'z2018050920384315258695239267163', '0', null, null, '1525875815');
INSERT INTO `btc_bank` VALUES ('a2018050922283515258761156158916', '0040794 臺銀黎明', '2', 'z2018050920384315258695239267163', '1', null, null, '1525876115');
INSERT INTO `btc_bank` VALUES ('a2018050922304115258762416120950', '0040853 臺銀世貿', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876241');
INSERT INTO `btc_bank` VALUES ('a2018050922311315258762735269670', '0040886 臺銀潮州', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876273');
INSERT INTO `btc_bank` VALUES ('a2018050922312115258762819238617', '0040897 臺銀蘇澳', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876281');
INSERT INTO `btc_bank` VALUES ('A2018050922314915258763095965628', '0040923 臺銀中工', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876309');
INSERT INTO `btc_bank` VALUES ('a2018050922323815258763586715368', '0041104 台银中崙', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876358');
INSERT INTO `btc_bank` VALUES ('A2018050922331815258763980710431', '0041182 臺銀五甲', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876398');
INSERT INTO `btc_bank` VALUES ('A2018050922340415258764447798166', '0041230 臺銀南崁', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876444');
INSERT INTO `btc_bank` VALUES ('A2018050922350315258765038315587', '0041425 臺銀天母', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876503');
INSERT INTO `btc_bank` VALUES ('a2018050922354015258765400047222', '0041447 臺銀內壢', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876540');
INSERT INTO `btc_bank` VALUES ('A2018050922355615258765565419825', '0041470 臺銀虎尾', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876556');
INSERT INTO `btc_bank` VALUES ('a2018050922363315258765937753040', '0041551 臺銀東港', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876593');
INSERT INTO `btc_bank` VALUES ('a2018050922373415258766543691485', '0041643 臺銀北大', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876654');
INSERT INTO `btc_bank` VALUES ('a2018050922390715258767475443402', '0041953 臺銀愛國簡', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876747');
INSERT INTO `btc_bank` VALUES ('A2018050922433615258770164519231', '0042444 臺銀新永和', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877016');
INSERT INTO `btc_bank` VALUES ('a2018050922445415258770943010237', '0042499 臺銀北臺中', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877094');
INSERT INTO `btc_bank` VALUES ('a2018050922452715258771273231924', '0042569 臺銀成功', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877127');
INSERT INTO `btc_bank` VALUES ('A2018050922460315258771637661750', '0042721 臺銀六假頂', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877163');
INSERT INTO `btc_bank` VALUES ('A2018050922461115258771718151042', '0042787 臺銀中都', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877171');
INSERT INTO `btc_bank` VALUES ('a2018050923370515258802250527365', '008 華南商業銀行', '1', '0', '0', null, null, '1525880225');
INSERT INTO `btc_bank` VALUES ('a2018050923371015258802302906175', '009 彰化商業銀行', '1', '0', '0', null, null, '1525880230');
INSERT INTO `btc_bank` VALUES ('A2018050923371615258802368854317', '011 上海商業儲蓄銀行', '1', '0', '0', null, null, '1525880236');
INSERT INTO `btc_bank` VALUES ('A2018050923373115258802514617268', '013 國泰世華商業銀行', '1', '0', '0', null, null, '1525880251');
INSERT INTO `btc_bank` VALUES ('A2018050923374415258802649510938', '017 兆豐國際商業銀行', '1', '0', '0', null, null, '1525880264');
INSERT INTO `btc_bank` VALUES ('A2018050923380015258802808993602', '020 日商瑞穗銀行台北分行', '1', '0', '0', null, null, '1525880280');
INSERT INTO `btc_bank` VALUES ('A2018050923382015258803000912879', '023 泰國盤谷銀行台北分行', '1', '0', '0', null, null, '1525880300');
INSERT INTO `btc_bank` VALUES ('A2018050923382615258803066346615', '025 菲律賓首都銀行台北分行', '1', '0', '0', null, null, '1525880306');
INSERT INTO `btc_bank` VALUES ('A2018050923383715258803178730228', '030 美商道富銀行台北分行', '1', '0', '0', null, null, '1525880317');
INSERT INTO `btc_bank` VALUES ('a2018050923390215258803428393295', '050 臺灣中小企業銀行', '1', '0', '0', null, null, '1525880342');
INSERT INTO `btc_bank` VALUES ('A2018050923393915258803799638610', '061 中華票券金融股份有限公司', '1', '0', '0', null, null, '1525880379');
INSERT INTO `btc_bank` VALUES ('a2018050923394715258803873247448', '062 國際票券金融股份有限公司', '1', '0', '0', null, null, '1525880387');
INSERT INTO `btc_bank` VALUES ('A2018050923401015258804102918968', '075 香港商東亞銀行台北分行', '1', '0', '0', null, null, '1525880410');
INSERT INTO `btc_bank` VALUES ('A2018050923405215258804529312412', '093 荷商安智銀行台北分行', '1', '0', '0', null, null, '1525880452');
INSERT INTO `btc_bank` VALUES ('A2018050923411215258804720073032', '102 華泰商業銀行', '1', '0', '0', null, null, '1525880472');
INSERT INTO `btc_bank` VALUES ('A2018050923412815258804889150991', '108 陽信商業銀行', '1', '0', '0', null, null, '1525880488');
INSERT INTO `btc_bank` VALUES ('A2018050923414015258805004629649', '115 基隆市第二信用合作社', '1', '0', '0', null, null, '1525880500');
INSERT INTO `btc_bank` VALUES ('A2018050923414715258805073201782', '118 板信商業銀行', '1', '0', '0', null, null, '1525880507');
INSERT INTO `btc_bank` VALUES ('A2018050923415215258805129845680', '119 淡水第一信用合作社', '1', '0', '0', null, null, '1525880512');
INSERT INTO `btc_bank` VALUES ('A2018050923415915258805191971948', '120 新北市淡水信用合作社', '1', '0', '0', null, null, '1525880519');
INSERT INTO `btc_bank` VALUES ('A2018050923423215258805521877529', '146 台中市第二信用合作社', '1', '0', '0', null, null, '1525880552');
INSERT INTO `btc_bank` VALUES ('a2018050923423715258805572499399', '147 三信商業銀行', '1', '0', '0', null, null, '1525880557');
INSERT INTO `btc_bank` VALUES ('a2018050923453315258807337296368', '326 西班牙商西班牙對外銀行臺北分行', '1', '0', '0', null, null, '1525880733');
INSERT INTO `btc_bank` VALUES ('A2018050923455115258807512975624', '381 大陸商交通銀行臺北分行', '1', '0', '0', null, null, '1525880751');
INSERT INTO `btc_bank` VALUES ('A2018050923461415258807743971527', '504 北農中心所屬會員', '1', '0', '0', null, null, '1525880774');
INSERT INTO `btc_bank` VALUES ('A2018050923462415258807849101938', '506 聯資中心所屬會員', '1', '0', '0', null, null, '1525880784');
INSERT INTO `btc_bank` VALUES ('A2018050923464415258808044139382', '511 農金資中心', '1', '0', '0', null, null, '1525880804');
INSERT INTO `btc_bank` VALUES ('A2018050923475715258808770558454', '526 南農中心所屬會員', '1', '0', '0', null, null, '1525880877');
INSERT INTO `btc_bank` VALUES ('a2018050923482315258809033212773', '551 農金資中心', '1', '0', '0', null, null, '1525880903');
INSERT INTO `btc_bank` VALUES ('A2018050923490915258809496165453', '565 龍崎農會', '1', '0', '0', null, null, '1525880949');
INSERT INTO `btc_bank` VALUES ('A2018050923492015258809604064737', '568 農金資中心', '1', '0', '0', null, null, '1525880960');
INSERT INTO `btc_bank` VALUES ('A2018050923493915258809792957292', '575 農金資中心', '1', '0', '0', null, null, '1525880979');
INSERT INTO `btc_bank` VALUES ('A2018050923500415258810045045058', '581 農金資中心', '1', '0', '0', null, null, '1525881004');
INSERT INTO `btc_bank` VALUES ('a2018050923504515258810452453513', '605 高雄市高雄地區農會', '1', '0', '0', null, null, '1525881045');
INSERT INTO `btc_bank` VALUES ('a2018050923512115258810811357973', '607 北農中心所屬會員', '1', '0', '0', null, null, '1525881081');
INSERT INTO `btc_bank` VALUES ('A2018050923522115258811411842672', '618 南農中心所屬會員', '1', '0', '0', null, null, '1525881141');
INSERT INTO `btc_bank` VALUES ('a2018050923523015258811503808107', '620 南農中心所屬會員', '1', '0', '0', null, null, '1525881150');
INSERT INTO `btc_bank` VALUES ('a2018050923523515258811553369414', '621 南農中心所屬會員', '1', '0', '0', null, null, '1525881155');
INSERT INTO `btc_bank` VALUES ('a2018050923530015258811801071917', '625 臺中市臺中地區農會', '1', '0', '0', null, null, '1525881180');
INSERT INTO `btc_bank` VALUES ('A2018050923533215258812127190752', '633 農金資中心', '1', '0', '0', null, null, '1525881212');
INSERT INTO `btc_bank` VALUES ('a2018050923542015258812601572495', '647 農金資中心', '1', '0', '0', null, null, '1525881260');
INSERT INTO `btc_bank` VALUES ('A2018050923555815258813584005374', '810 星展（台灣）商業銀行', '1', '0', '0', null, null, '1525881358');
INSERT INTO `btc_bank` VALUES ('A2018050923562115258813811125086', '815 日盛國際商業銀行', '1', '0', '0', null, null, '1525881381');
INSERT INTO `btc_bank` VALUES ('A2018050923570815258814285986274', '871 農金資中心', '1', '0', '0', null, null, '1525881428');
INSERT INTO `btc_bank` VALUES ('A2018050923574015258814608253976', '879 農金資中心', '1', '0', '0', null, null, '1525881460');
INSERT INTO `btc_bank` VALUES ('a2018050923583215258815128280032', '891 花蓮農會', '1', '0', '0', null, null, '1525881512');
INSERT INTO `btc_bank` VALUES ('A2018050923585415258815346708629', '898 光豐農會', '1', '0', '0', null, null, '1525881534');
INSERT INTO `btc_bank` VALUES ('a2018050923595015258815906730567', '908 農金資中心', '1', '0', '0', null, null, '1525881590');
INSERT INTO `btc_bank` VALUES ('a2018050923595415258815947124181', '909 農金資中心', '1', '0', '0', null, null, '1525881594');
INSERT INTO `btc_bank` VALUES ('A2018051000000615258816061765689', '914 農金資中心', '1', '0', '0', null, null, '1525881606');
INSERT INTO `btc_bank` VALUES ('A2018051000004415258816447539323', '922 臺南農會', '1', '0', '0', null, null, '1525881644');
INSERT INTO `btc_bank` VALUES ('A2018051000012815258816880190533', '995 關貿網路股份有限公司', '1', '0', '0', null, null, '1525881688');
INSERT INTO `btc_bank` VALUES ('a2018051009452915259167295800933', '上海', '2', 'A2018050923371615258802368854317', '0', null, null, '1525916729');
INSERT INTO `btc_bank` VALUES ('A2018052020345815268196986787122', '中国农业银行', '1', '0', '0', null, null, '1526819698');
INSERT INTO `btc_bank` VALUES ('a2018052020351715268197174140631', '中国工商银行', '1', '0', '0', null, null, '1526819717');
INSERT INTO `btc_bank` VALUES ('A2018052020360615268197660468769', '中国兴业银行', '1', '0', '0', null, null, '1526819766');
INSERT INTO `btc_bank` VALUES ('A2018052020363915268197998300798', '中国浦发银行', '1', '0', '0', null, null, '1526819799');
INSERT INTO `btc_bank` VALUES ('A2018052801425415274429746021903', '上海支行', '2', 'c2018052020384715268199277138613', '0', null, null, '1527442974');
INSERT INTO `btc_bank` VALUES ('A2018052814454115274899411139106', '上海', '2', 'z2018052020344515268196854287198', '0', null, null, '1527489941');
INSERT INTO `btc_bank` VALUES ('a2018060313163515280029959141713', '福建福州分行', '2', 'z2018052020371515268198352373018', '0', null, null, '1528002995');
INSERT INTO `btc_bank` VALUES ('A2018060314254615280071468847374', '福建省福州分行', '2', 'z2018052020371515268198352373018', '0', null, null, '1528007146');
INSERT INTO `btc_bank` VALUES ('A2018071115242515312938657394971', '草屯郵局', '2', 'z2018050923551615258813160302405', '0', null, null, '1531293865');
INSERT INTO `btc_bank` VALUES ('b2018050920390315258695437452603', '0040059 臺銀公庫部', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869543');
INSERT INTO `btc_bank` VALUES ('B2018050920393615258695764711474', '0040118 臺銀高雄', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869576');
INSERT INTO `btc_bank` VALUES ('B2018050920394215258695826689771', '0040129 臺銀基隆', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869582');
INSERT INTO `btc_bank` VALUES ('b2018050920402315258696234852096', '0040185 臺銀花蓮', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869623');
INSERT INTO `btc_bank` VALUES ('b2018050920411015258696705949916', '0040200 臺銀中山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869670');
INSERT INTO `btc_bank` VALUES ('b2018050920495815258701983265806', '0040266 臺銀桃園', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870198');
INSERT INTO `btc_bank` VALUES ('b2018050920540615258704463620626', '0040325 臺銀南投', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870446');
INSERT INTO `btc_bank` VALUES ('b2018050920544415258704843331490', '0040369 臺銀北投', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870484');
INSERT INTO `btc_bank` VALUES ('b2018050920551415258705147192578', '0040381 臺銀金門', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870514');
INSERT INTO `btc_bank` VALUES ('B2018050920555415258705548937375', '0040417 臺銀中壢', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870554');
INSERT INTO `btc_bank` VALUES ('b2018050920595115258707911419135', '0040462 臺銀民權', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870791');
INSERT INTO `btc_bank` VALUES ('B2018050921005915258708591241053', '0040532 臺銀忠孝', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870859');
INSERT INTO `btc_bank` VALUES ('B2018050921031115258709915572493', '0040668 臺銀中和', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870991');
INSERT INTO `btc_bank` VALUES ('b2018050921033115258710118641922', '0040680 臺銀竹北', '2', 'z2018050920384315258695239267163', '0', null, null, '1525871011');
INSERT INTO `btc_bank` VALUES ('B2018050921040715258710476401960', '0040727 臺銀大甲', '2', 'z2018050920384315258695239267163', '0', null, null, '1525871047');
INSERT INTO `btc_bank` VALUES ('B2018050922301115258762119136798', '0040808 臺銀民生', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876211');
INSERT INTO `btc_bank` VALUES ('B2018050922310315258762631726980', '0040875 臺銀華江', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876263');
INSERT INTO `btc_bank` VALUES ('b2018050922315815258763185813982', '0041067 臺銀敦化', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876318');
INSERT INTO `btc_bank` VALUES ('B2018050922320915258763294152749', '0041078 臺銀南港', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876329');
INSERT INTO `btc_bank` VALUES ('b2018050922341515258764551489916', '0041241 臺銀圓山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876455');
INSERT INTO `btc_bank` VALUES ('b2018050922372515258766453289783', '0041621 臺銀群賢', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876645');
INSERT INTO `btc_bank` VALUES ('b2018050922374315258766631820377', '0041654 臺銀文山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876663');
INSERT INTO `btc_bank` VALUES ('b2018050922375115258766713133716', '0041702 臺銀太平', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876671');
INSERT INTO `btc_bank` VALUES ('b2018050922381615258766964980071', '0041768 臺銀農科', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876696');
INSERT INTO `btc_bank` VALUES ('b2018050922391615258767562418536', '0041986 臺銀臺電簡', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876756');
INSERT INTO `btc_bank` VALUES ('b2018050922392515258767653253434', '0042053 臺銀北府簡', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876765');
INSERT INTO `btc_bank` VALUES ('b2018050922393415258767740994942', '0042189 臺銀臺北港', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876774');
INSERT INTO `btc_bank` VALUES ('b2018050922413915258768993411152', '0042248 臺銀高榮', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876899');
INSERT INTO `btc_bank` VALUES ('b2018050922422415258769447399499', '0042307 臺銀南創', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876944');
INSERT INTO `btc_bank` VALUES ('B2018050922424115258769617071774', '0042385 臺銀台北', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876961');
INSERT INTO `btc_bank` VALUES ('b2018050922435515258770357780384', '0042466 臺銀桃興', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877035');
INSERT INTO `btc_bank` VALUES ('B2018050922451115258771115841681', '0042536 臺銀南都', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877111');
INSERT INTO `btc_bank` VALUES ('b2018050922453515258771359470199', '0042570 臺銀北花蓮', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877135');
INSERT INTO `btc_bank` VALUES ('B2018050922454515258771455751233', '0042709 臺銀新湖', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877145');
INSERT INTO `btc_bank` VALUES ('b2018050922455315258771537878903', '0042710 臺銀五福', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877153');
INSERT INTO `btc_bank` VALUES ('B2018050922462815258771887087141', '0042802 臺銀副都', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877188');
INSERT INTO `btc_bank` VALUES ('b2018050922465315258772131316691', '0042905 臺銀中精密', '2', 'z2018050920384315258695239267163', '1', null, null, '1525877213');
INSERT INTO `btc_bank` VALUES ('b2018050923380615258802869776168', '021 花旗（台灣）商業銀行', '1', '0', '0', null, null, '1525880286');
INSERT INTO `btc_bank` VALUES ('b2018050923381315258802938590048', '022 美國銀行台北分行', '1', '0', '0', null, null, '1525880293');
INSERT INTO `btc_bank` VALUES ('b2018050923384415258803245089649', '037 法商法國興業銀行台北分行', '1', '0', '0', null, null, '1525880324');
INSERT INTO `btc_bank` VALUES ('b2018050923395815258803989961750', '066 萬通票券金融股份有限公司', '1', '0', '0', null, null, '1525880398');
INSERT INTO `btc_bank` VALUES ('B2018050923400415258804049596097', '072 德商德意志銀行台北分行', '1', '0', '0', null, null, '1525880404');
INSERT INTO `btc_bank` VALUES ('b2018050923401515258804157956511', '076 美商摩根大通銀行台北分行', '1', '0', '0', null, null, '1525880415');
INSERT INTO `btc_bank` VALUES ('B2018050923404715258804474173543', '092 瑞士商瑞士銀行台北分行', '1', '0', '0', null, null, '1525880447');
INSERT INTO `btc_bank` VALUES ('b2018050923412415258804842445735', '104 台北市第五信用合作社', '1', '0', '0', null, null, '1525880484');
INSERT INTO `btc_bank` VALUES ('B2018050923421815258805382798984', '130 新竹第一信用合作社', '1', '0', '0', null, null, '1525880538');
INSERT INTO `btc_bank` VALUES ('b2018050923452215258807223563875', '224 金門縣信用合作社', '1', '0', '0', null, null, '1525880722');
INSERT INTO `btc_bank` VALUES ('b2018050923452815258807282158337', '321 日商三井住友銀行台北分行', '1', '0', '0', null, null, '1525880728');
INSERT INTO `btc_bank` VALUES ('b2018050923463515258807951388157', '508 農金資中心', '1', '0', '0', null, null, '1525880795');
INSERT INTO `btc_bank` VALUES ('B2018050923465015258808102628181', '512 南農中心所屬會員', '1', '0', '0', null, null, '1525880810');
INSERT INTO `btc_bank` VALUES ('b2018050923470415258808249158142', '517 南農中心所屬會員', '1', '0', '0', null, null, '1525880824');
INSERT INTO `btc_bank` VALUES ('B2018050923472415258808442596556', '520 南農中心所屬會員', '1', '0', '0', null, null, '1525880844');
INSERT INTO `btc_bank` VALUES ('b2018050923481315258808932883234', '547 後壁農會', '1', '0', '0', null, null, '1525880893');
INSERT INTO `btc_bank` VALUES ('b2018050923485415258809341262018', '561 左鎮農會', '1', '0', '0', null, null, '1525880934');
INSERT INTO `btc_bank` VALUES ('b2018050923494415258809842861751', '577 農金資中心', '1', '0', '0', null, null, '1525880984');
INSERT INTO `btc_bank` VALUES ('b2018050923495415258809947140907', '579 農金資中心', '1', '0', '0', null, null, '1525880994');
INSERT INTO `btc_bank` VALUES ('B2018050923500915258810090433748', '582 農金資中心', '1', '0', '0', null, null, '1525881009');
INSERT INTO `btc_bank` VALUES ('B2018050923501415258810140918710', '583 東山農會', '1', '0', '0', null, null, '1525881014');
INSERT INTO `btc_bank` VALUES ('B2018050923501915258810192235292', '587 礁溪農會', '1', '0', '0', null, null, '1525881019');
INSERT INTO `btc_bank` VALUES ('B2018050923505415258810544059380', '606 北農中心所屬會員', '1', '0', '0', null, null, '1525881054');
INSERT INTO `btc_bank` VALUES ('B2018050923515515258811154265586', '612 南農中心所屬會員', '1', '0', '0', null, null, '1525881115');
INSERT INTO `btc_bank` VALUES ('B2018050923515915258811198071192', '613 南農中心所屬會員', '1', '0', '0', null, null, '1525881119');
INSERT INTO `btc_bank` VALUES ('b2018050923525515258811756403931', '624 南農中心所屬會員', '1', '0', '0', null, null, '1525881175');
INSERT INTO `btc_bank` VALUES ('b2018050923535515258812355983300', '638 農金資中心', '1', '0', '0', null, null, '1525881235');
INSERT INTO `btc_bank` VALUES ('B2018050923540515258812456645231', '642 農金資中心', '1', '0', '0', null, null, '1525881245');
INSERT INTO `btc_bank` VALUES ('b2018050923541515258812554256852', '646 農金資中心', '1', '0', '0', null, null, '1525881255');
INSERT INTO `btc_bank` VALUES ('b2018050923544115258812810539264', '683 農金資中心', '1', '0', '0', null, null, '1525881281');
INSERT INTO `btc_bank` VALUES ('b2018050923544515258812854612670', '685 農金資中心', '1', '0', '0', null, null, '1525881285');
INSERT INTO `btc_bank` VALUES ('B2018050923545515258812956576154', '696 農金資中心', '1', '0', '0', null, null, '1525881295');
INSERT INTO `btc_bank` VALUES ('b2018050923553615258813363257398', '806 元大商業銀行', '1', '0', '0', null, null, '1525881336');
INSERT INTO `btc_bank` VALUES ('b2018050923554815258813481249196', '808 玉山商業銀行', '1', '0', '0', null, null, '1525881348');
INSERT INTO `btc_bank` VALUES ('B2018050923555315258813531213576', '809 凱基商業銀行', '1', '0', '0', null, null, '1525881353');
INSERT INTO `btc_bank` VALUES ('B2018050923564415258814041396753', '866 阿里山農會', '1', '0', '0', null, null, '1525881404');
INSERT INTO `btc_bank` VALUES ('B2018050923565115258814113211866', '868 農金資中心', '1', '0', '0', null, null, '1525881411');
INSERT INTO `btc_bank` VALUES ('b2018050923565715258814175916172', '869 農金資中心', '1', '0', '0', null, null, '1525881417');
INSERT INTO `btc_bank` VALUES ('B2018050923572215258814426411933', '875 農金資中心', '1', '0', '0', null, null, '1525881442');
INSERT INTO `btc_bank` VALUES ('b2018050923573115258814518834215', '877 農金資中心', '1', '0', '0', null, null, '1525881451');
INSERT INTO `btc_bank` VALUES ('B2018050923573615258814561951701', '878 農金資中心', '1', '0', '0', null, null, '1525881456');
INSERT INTO `btc_bank` VALUES ('B2018050923582715258815077463258', '886 農金資中心', '1', '0', '0', null, null, '1525881507');
INSERT INTO `btc_bank` VALUES ('b2018050923585915258815398972190', '901 板農中心所屬會員', '1', '0', '0', null, null, '1525881539');
INSERT INTO `btc_bank` VALUES ('b2018050923592615258815666457662', '903 農金資中心', '1', '0', '0', null, null, '1525881566');
INSERT INTO `btc_bank` VALUES ('B2018050923594315258815839671181', '907 農金資中心', '1', '0', '0', null, null, '1525881583');
INSERT INTO `btc_bank` VALUES ('b2018050923595915258815998469611', '912 板農中心所屬會員', '1', '0', '0', null, null, '1525881599');
INSERT INTO `btc_bank` VALUES ('B2018051000002415258816248339797', '918 農金資中心', '1', '0', '0', null, null, '1525881624');
INSERT INTO `btc_bank` VALUES ('B2018052020355115268197511250037', '中国交通银行', '1', '0', '0', null, null, '1526819751');
INSERT INTO `btc_bank` VALUES ('b2018052020383515268199156123026', '中国光大银行', '1', '0', '0', null, null, '1526819915');
INSERT INTO `btc_bank` VALUES ('B2018052020390115268199410253973', '中国华夏银行', '1', '0', '0', null, null, '1526819941');
INSERT INTO `btc_bank` VALUES ('B2018062914585715302555370207614', '中国广西省南宁市兴宁区南梧大道支行', '2', 'A2018052020345815268196986787122', '0', null, null, '1530255537');
INSERT INTO `btc_bank` VALUES ('B2018063019111515303570751282108', '0131139國泰大甲', '2', 'A2018050923373115258802514617268', '0', null, null, '1530357075');
INSERT INTO `btc_bank` VALUES ('b2018071218061015313899703948648', '0447太平分行', '2', 'q2018050923561115258813715308681', '0', null, null, '1531389970');
INSERT INTO `btc_bank` VALUES ('c2018050920385115258695318605555', '0040037 臺銀營業部', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869531');
INSERT INTO `btc_bank` VALUES ('c2018050920391315258695535276095', '004007 臺銀館前', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869553');
INSERT INTO `btc_bank` VALUES ('c2018050920401715258696173822581', '0040174 臺銀屏東', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869617');
INSERT INTO `btc_bank` VALUES ('c2018050920560415258705647626967', '0040428 臺銀三重', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870564');
INSERT INTO `btc_bank` VALUES ('c2018050921041715258710578743695', '0040738 臺銀科學園', '2', 'z2018050920384315258695239267163', '0', null, null, '1525871057');
INSERT INTO `btc_bank` VALUES ('c2018050922322015258763409597738', '0041089 臺銀和平', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876340');
INSERT INTO `btc_bank` VALUES ('c2018050922324815258763686283426', '0041115 臺銀土城', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876368');
INSERT INTO `btc_bank` VALUES ('c2018050922333715258764177627016', '0041207 臺銀中莊', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876417');
INSERT INTO `btc_bank` VALUES ('c2018050922334715258764272579896', '0041218臺銀平鎮', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876427');
INSERT INTO `btc_bank` VALUES ('c2018050922344315258764837512002', '0041377 臺銀安南', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876483');
INSERT INTO `btc_bank` VALUES ('c2018050922353115258765310729568', '0041436 臺銀鹿港', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876531');
INSERT INTO `btc_bank` VALUES ('c2018050922365915258766199654903', '0041573 臺銀梧棲', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876619');
INSERT INTO `btc_bank` VALUES ('c2018050922395215258767923600180', '0042215 臺銀高科', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876792');
INSERT INTO `btc_bank` VALUES ('c2018050922400315258768030902628', '0042237 臺銀東湖', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876803');
INSERT INTO `btc_bank` VALUES ('c2018050922414715258769079137693', '0042259 臺銀南港園', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876907');
INSERT INTO `btc_bank` VALUES ('c2018050923365715258802176788177', '007 第一商業銀行', '1', '0', '0', null, null, '1525880217');
INSERT INTO `btc_bank` VALUES ('c2018050923404115258804411633173', '086 法商東方匯理銀行台北分行', '1', '0', '0', null, null, '1525880441');
INSERT INTO `btc_bank` VALUES ('c2018050923410515258804659001744', '101 瑞興商業銀行', '1', '0', '0', null, null, '1525880465');
INSERT INTO `btc_bank` VALUES ('c2018050923430415258805845464477', '161 彰化第五信用合作社', '1', '0', '0', null, null, '1525880584');
INSERT INTO `btc_bank` VALUES ('c2018050923432115258806012760178', '163 彰化第十信用合作社', '1', '0', '0', null, null, '1525880601');
INSERT INTO `btc_bank` VALUES ('c2018050923451015258807109211581', '222 澎湖縣第一信用合作社', '1', '0', '0', null, null, '1525880710');
INSERT INTO `btc_bank` VALUES ('c2018050923453915258807390721735', '372 大慶票券金融股份有限公司', '1', '0', '0', null, null, '1525880739');
INSERT INTO `btc_bank` VALUES ('c2018050923455815258807585464273', '382 大陸商中國建設銀行臺北分行', '1', '0', '0', null, null, '1525880758');
INSERT INTO `btc_bank` VALUES ('c2018050923480215258808821688261', '541 白河農會', '1', '0', '0', null, null, '1525880882');
INSERT INTO `btc_bank` VALUES ('c2018050923481815258808983805675', '549 農金資中心', '1', '0', '0', null, null, '1525880898');
INSERT INTO `btc_bank` VALUES ('c2018050923492515258809652631981', '570 農金資中心', '1', '0', '0', null, null, '1525880965');
INSERT INTO `btc_bank` VALUES ('c2018050923502415258810246320890', '603 北農中心所屬會員', '1', '0', '0', null, null, '1525881024');
INSERT INTO `btc_bank` VALUES ('c2018050923532115258812019038031', '631 農金資中心', '1', '0', '0', null, null, '1525881201');
INSERT INTO `btc_bank` VALUES ('c2018050923572715258814470555151', '876 農金資中心', '1', '0', '0', null, null, '1525881447');
INSERT INTO `btc_bank` VALUES ('c2018050923581115258814917358256', '883 農金資中心', '1', '0', '0', null, null, '1525881491');
INSERT INTO `btc_bank` VALUES ('c2018050923581715258814970950791', '884 農金資中心', '1', '0', '0', null, null, '1525881497');
INSERT INTO `btc_bank` VALUES ('c2018050923582215258815024817383', '885 農金資中心', '1', '0', '0', null, null, '1525881502');
INSERT INTO `btc_bank` VALUES ('c2018051000002915258816295318487', '919 農金資中心', '1', '0', '0', null, null, '1525881629');
INSERT INTO `btc_bank` VALUES ('c2018051000011715258816773698777', '952 南農中心所屬會員', '1', '0', '0', null, null, '1525881677');
INSERT INTO `btc_bank` VALUES ('c2018052020384715268199277138613', '中国民生银行', '1', '0', '0', null, null, '1526819927');
INSERT INTO `btc_bank` VALUES ('c2018060417491915281057593257128', '中国四川省成都分行', '2', 'z2018052020371515268198352373018', '0', null, null, '1528105759');
INSERT INTO `btc_bank` VALUES ('c2018063019111315303570737229567', '0131139國泰大甲', '2', 'A2018050923373115258802514617268', '0', null, null, '1530357073');
INSERT INTO `btc_bank` VALUES ('D2018050920392115258695618838561', '0040093 臺銀臺南', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869561');
INSERT INTO `btc_bank` VALUES ('D2018050920392815258695688640290', '0040107 臺銀臺中', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869568');
INSERT INTO `btc_bank` VALUES ('D2018050920483915258701198940862', '0040222 臺銀宜蘭', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870119');
INSERT INTO `btc_bank` VALUES ('D2018050920493915258701796117147', '0040255 臺銀鳳山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870179');
INSERT INTO `btc_bank` VALUES ('D2018050920545715258704976444059', '0040370 臺銀霧峰', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870497');
INSERT INTO `btc_bank` VALUES ('D2018050920553815258705387951892', '0040406 臺銀安平', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870538');
INSERT INTO `btc_bank` VALUES ('D2018050921002915258708292465733', '0040509 臺銀松江', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870829');
INSERT INTO `btc_bank` VALUES ('D2018050921003815258708381762584', '0040510 臺銀鼓山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870838');
INSERT INTO `btc_bank` VALUES ('D2018050921020815258709280197858', '0040602臺銀岡山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870928');
INSERT INTO `btc_bank` VALUES ('D2018050922303215258762321900622', '0040820 臺銀三多', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876232');
INSERT INTO `btc_bank` VALUES ('D2018050922313015258762905814905', '0040901 臺銀大雅', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876290');
INSERT INTO `btc_bank` VALUES ('D2018050922332815258764089759836', '0041193 臺銀博愛', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876408');
INSERT INTO `btc_bank` VALUES ('D2018050922335515258764351855253', '0041229臺銀仁愛', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876435');
INSERT INTO `btc_bank` VALUES ('D2018050922342315258764637977022', '0041355 臺銀五股', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876463');
INSERT INTO `btc_bank` VALUES ('D2018050922343215258764726237280', '0041366臺銀大里', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876472');
INSERT INTO `btc_bank` VALUES ('D2018050922345315258764930571980', '0041414 臺銀西屯', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876493');
INSERT INTO `btc_bank` VALUES ('D2018050922384215258767227504144', '0041919 臺銀高機', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876722');
INSERT INTO `btc_bank` VALUES ('D2018050922425815258769782667821', '0042400 臺銀信安', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876978');
INSERT INTO `btc_bank` VALUES ('D2018050922430815258769886562678', '0042411 臺銀劍潭', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876988');
INSERT INTO `btc_bank` VALUES ('D2018050922462015258771801615914', '0042798 臺銀北機', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877180');
INSERT INTO `btc_bank` VALUES ('D2018050923363715258801979811441', '005 臺灣土地銀行', '1', '0', '0', null, null, '1525880197');
INSERT INTO `btc_bank` VALUES ('D2018050923385015258803309514585', '039 澳盛（台灣）商業銀行', '1', '0', '0', null, null, '1525880330');
INSERT INTO `btc_bank` VALUES ('D2018050923391715258803574141521', '053 台中商業銀行', '1', '0', '0', null, null, '1525880357');
INSERT INTO `btc_bank` VALUES ('D2018050923413415258804948830581', '114 基隆第一信用合作社', '1', '0', '0', null, null, '1525880494');
INSERT INTO `btc_bank` VALUES ('D2018050923422715258805471950099', '132 新竹第三信用合作社', '1', '0', '0', null, null, '1525880547');
INSERT INTO `btc_bank` VALUES ('D2018050923424515258805651265023', '158 彰化第一信用合作社', '1', '0', '0', null, null, '1525880565');
INSERT INTO `btc_bank` VALUES ('D2018050923425215258805726630442', '158 彰化第一信用合作社', '1', '0', '0', null, null, '1525880572');
INSERT INTO `btc_bank` VALUES ('D2018050923432615258806066514862', '165 彰化縣鹿港信用合作社', '1', '0', '0', null, null, '1525880606');
INSERT INTO `btc_bank` VALUES ('D2018050923450515258807058761703', '216 花蓮第二信用合作社', '1', '0', '0', null, null, '1525880705');
INSERT INTO `btc_bank` VALUES ('D2018050923473415258808540645191', '523 南農中心所屬會員', '1', '0', '0', null, null, '1525880854');
INSERT INTO `btc_bank` VALUES ('D2018050923473915258808596483273', '524 南農中心所屬會員', '1', '0', '0', null, null, '1525880859');
INSERT INTO `btc_bank` VALUES ('D2018050923483915258809198752618', '557 農金資中心', '1', '0', '0', null, null, '1525880919');
INSERT INTO `btc_bank` VALUES ('D2018050923494915258809894961867', '578 農金資中心', '1', '0', '0', null, null, '1525880989');
INSERT INTO `btc_bank` VALUES ('D2018050923514515258811057651851', '610 北農中心所屬會員', '1', '0', '0', null, null, '1525881105');
INSERT INTO `btc_bank` VALUES ('D2018050923520415258811243060242', '614 南農中心所屬會員', '1', '0', '0', null, null, '1525881124');
INSERT INTO `btc_bank` VALUES ('D2018050923540015258812403165476', '639 農金資中心', '1', '0', '0', null, null, '1525881240');
INSERT INTO `btc_bank` VALUES ('D2018050923545015258812903270933', '693 農金資中心', '1', '0', '0', null, null, '1525881290');
INSERT INTO `btc_bank` VALUES ('D2018050923545915258812997867446', '697 農金資中心', '1', '0', '0', null, null, '1525881299');
INSERT INTO `btc_bank` VALUES ('D2018050923563715258813979036011', '860 農金資中心', '1', '0', '0', null, null, '1525881397');
INSERT INTO `btc_bank` VALUES ('D2018050923570315258814239520774', '870 農金資中心', '1', '0', '0', null, null, '1525881423');
INSERT INTO `btc_bank` VALUES ('D2018050923574515258814656284472', '880 農金資中心', '1', '0', '0', null, null, '1525881465');
INSERT INTO `btc_bank` VALUES ('D2018050923575115258814719637996', '881 農金資中心', '1', '0', '0', null, null, '1525881471');
INSERT INTO `btc_bank` VALUES ('D2018050923584915258815296852308', '897 鳳榮農會', '1', '0', '0', null, null, '1525881529');
INSERT INTO `btc_bank` VALUES ('D2018050923593815258815785284196', '906 農金資中心', '1', '0', '0', null, null, '1525881578');
INSERT INTO `btc_bank` VALUES ('D2018051000010115258816618476321', '925 農金資中心', '1', '0', '0', null, null, '1525881661');
INSERT INTO `btc_bank` VALUES ('D2018051009513815259170985641939', '台北分行有点好', '2', 'A2018050923383715258803178730228', '0', null, null, '1525917098');
INSERT INTO `btc_bank` VALUES ('D2018052922023115276025510205008', '中国福建省福州分行', '2', 'z2018052020371515268198352373018', '0', null, null, '1527602551');
INSERT INTO `btc_bank` VALUES ('D2018070923375215311506729136232', '0129中壢分行', '2', 'G2018050923563215258813925010552', '0', null, null, '1531150672');
INSERT INTO `btc_bank` VALUES ('D2018071110372415312766442276910', '8060183 雲林斗信', '2', 'b2018050923553615258813363257398', '0', null, null, '1531276644');
INSERT INTO `btc_bank` VALUES ('D2018071617195615317327963867527', '3802108內壢簡易型分行', '2', 'G2018050923563215258813925010552', '0', null, null, '1531732796');
INSERT INTO `btc_bank` VALUES ('G2018050920492915258701691354845', '0040244 臺銀澎湖', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870169');
INSERT INTO `btc_bank` VALUES ('G2018050920512915258702894593823', '0040303 臺銀豐原', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870289');
INSERT INTO `btc_bank` VALUES ('G2018050921001015258708101082799', '0040484 臺銀連城', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870810');
INSERT INTO `btc_bank` VALUES ('G2018050921001815258708189518184', '0040495 臺銀員林', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870818');
INSERT INTO `btc_bank` VALUES ('G2018050921014715258709072718446', '0040587 臺銀羅東', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870907');
INSERT INTO `btc_bank` VALUES ('G2018050921042715258710675050969', '0040749 臺銀樹林', '2', 'z2018050920384315258695239267163', '0', null, null, '1525871067');
INSERT INTO `btc_bank` VALUES ('G2018050922330815258763880214485', '0041160 臺銀大昌', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876388');
INSERT INTO `btc_bank` VALUES ('G2018050922354815258765480115493', '0041469 臺銀南科', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876548');
INSERT INTO `btc_bank` VALUES ('G2018050922380815258766881926849', '0041724 臺銀建國', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876688');
INSERT INTO `btc_bank` VALUES ('G2018050922382515258767057403161', '0041861 臺銀東桃園', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876705');
INSERT INTO `btc_bank` VALUES ('G2018050922385015258767303367678', '0041931 臺銀永吉簡', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876730');
INSERT INTO `btc_bank` VALUES ('G2018050922394215258767823307169', '0042204 臺銀中科', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876782');
INSERT INTO `btc_bank` VALUES ('G2018050922420215258769226208733', '0042271 臺銀仁德', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876922');
INSERT INTO `btc_bank` VALUES ('G2018050922421715258769376244447', '0042293 臺銀木柵', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876937');
INSERT INTO `btc_bank` VALUES ('G2018050922432115258770014289900', '0042422 臺銀萬華', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877001');
INSERT INTO `btc_bank` VALUES ('G2018050922450215258771020797444', '0042525 臺銀嘉南', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877102');
INSERT INTO `btc_bank` VALUES ('G2018050923372215258802429762215', '012 台北富邦商業銀行', '1', '0', '0', null, null, '1525880242');
INSERT INTO `btc_bank` VALUES ('G2018050923392515258803656766381', '054 京城商業銀行', '1', '0', '0', null, null, '1525880365');
INSERT INTO `btc_bank` VALUES ('G2018050923411715258804775097879', '103 臺灣新光商業銀行', '1', '0', '0', null, null, '1525880477');
INSERT INTO `btc_bank` VALUES ('G2018050923421315258805330355684', '127 桃園信用合作社', '1', '0', '0', null, null, '1525880533');
INSERT INTO `btc_bank` VALUES ('G2018050923450015258807000591564', '215 花蓮第一信用合作社', '1', '0', '0', null, null, '1525880700');
INSERT INTO `btc_bank` VALUES ('G2018050923451615258807164364434', '223 澎湖第二信用合作社', '1', '0', '0', null, null, '1525880716');
INSERT INTO `btc_bank` VALUES ('G2018050923461915258807794198933', '505 北農中心所屬會員', '1', '0', '0', null, null, '1525880779');
INSERT INTO `btc_bank` VALUES ('G2018050923464015258808000204572', '510 農金資中心', '1', '0', '0', null, null, '1525880800');
INSERT INTO `btc_bank` VALUES ('G2018050923465715258808176716927', '515 南農中心所屬會員', '1', '0', '0', null, null, '1525880817');
INSERT INTO `btc_bank` VALUES ('G2018050923471215258808326260923', '518 南農中心所屬會員', '1', '0', '0', null, null, '1525880832');
INSERT INTO `btc_bank` VALUES ('G2018050923484415258809242426068', '558 農金資中心', '1', '0', '0', null, null, '1525880924');
INSERT INTO `btc_bank` VALUES ('G2018050923485815258809389355283', '562 農金資中心', '1', '0', '0', null, null, '1525880938');
INSERT INTO `btc_bank` VALUES ('G2018050923493415258809744356212', '574 農金資中心', '1', '0', '0', null, null, '1525880974');
INSERT INTO `btc_bank` VALUES ('G2018050923495915258809991778543', '580 農金資中心', '1', '0', '0', null, null, '1525880999');
INSERT INTO `btc_bank` VALUES ('G2018050923513915258810999207900', '609 北農中心所屬會員', '1', '0', '0', null, null, '1525881099');
INSERT INTO `btc_bank` VALUES ('G2018050923515015258811102342991', '611 北農中心所屬會員', '1', '0', '0', null, null, '1525881110');
INSERT INTO `btc_bank` VALUES ('G2018050923525115258811711074206', '623 北農中心所屬會員', '1', '0', '0', null, null, '1525881171');
INSERT INTO `btc_bank` VALUES ('G2018050923530615258811863344753', '627 南農中心所屬會員', '1', '0', '0', null, null, '1525881186');
INSERT INTO `btc_bank` VALUES ('G2018050923535015258812300985471', '636 農金資中心', '1', '0', '0', null, null, '1525881230');
INSERT INTO `btc_bank` VALUES ('G2018050923550615258813061334543', '698 農金資中心', '1', '0', '0', null, null, '1525881306');
INSERT INTO `btc_bank` VALUES ('G2018050923552015258813208233683', '749 內埔農會', '1', '0', '0', null, null, '1525881320');
INSERT INTO `btc_bank` VALUES ('G2018050923554215258813428629335', '807 永豐商業銀行', '1', '0', '0', null, null, '1525881342');
INSERT INTO `btc_bank` VALUES ('G2018050923562615258813863956354', '816 安泰商業銀行', '1', '0', '0', null, null, '1525881386');
INSERT INTO `btc_bank` VALUES ('G2018050923563215258813925010552', '822 中國信託商業銀行', '1', '0', '0', null, null, '1525881392');
INSERT INTO `btc_bank` VALUES ('G2018050923571315258814333340471', '872 農金資中心', '1', '0', '0', null, null, '1525881433');
INSERT INTO `btc_bank` VALUES ('G2018050923580515258814852072759', '882 農金資中心', '1', '0', '0', null, null, '1525881485');
INSERT INTO `btc_bank` VALUES ('G2018051000001615258816162385768', '916 板農中心所屬會員', '1', '0', '0', null, null, '1525881616');
INSERT INTO `btc_bank` VALUES ('G2018051000002015258816201697346', '917 農金資中心', '1', '0', '0', null, null, '1525881620');
INSERT INTO `btc_bank` VALUES ('G2018051000003415258816343152894', '920 農金資中心', '1', '0', '0', null, null, '1525881634');
INSERT INTO `btc_bank` VALUES ('G2018051000010615258816666261090', '926 農金資中心', '1', '0', '0', null, null, '1525881666');
INSERT INTO `btc_bank` VALUES ('G2018052020353115268197315078156', '中国招商银行', '1', '0', '0', null, null, '1526819731');
INSERT INTO `btc_bank` VALUES ('G2018052020382415268199044404239', '农村商业银行（信用社）', '1', '0', '0', null, null, '1526819904');
INSERT INTO `btc_bank` VALUES ('G2018071323500615314970067889850', '221 新店分行', '2', 'c2018050923365715258802176788177', '0', null, null, '1531497006');
INSERT INTO `btc_bank` VALUES ('H2018050920395615258695968214510', '0040141 臺銀嘉義', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869596');
INSERT INTO `btc_bank` VALUES ('H2018050920515515258703159535388', '0040314 臺銀斗六', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870315');
INSERT INTO `btc_bank` VALUES ('H2018050921015815258709183295996', '0040598 臺銀埔里', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870918');
INSERT INTO `btc_bank` VALUES ('H2018050922313915258762996597024', '0040912 臺銀南梓', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876299');
INSERT INTO `btc_bank` VALUES ('H2018050922361515258765759954496', '0041539 臺銀內湖', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876575');
INSERT INTO `btc_bank` VALUES ('H2018050922385915258767394773625', '0041942 臺銀東門簡', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876739');
INSERT INTO `btc_bank` VALUES ('H2018050922421015258769303087317', '0042282 臺銀林口', '2', 'z2018050920384315258695239267163', '1', null, null, '1525876930');
INSERT INTO `btc_bank` VALUES ('H2018050922423315258769533208352', '0042363 臺銀武昌', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876953');
INSERT INTO `btc_bank` VALUES ('H2018050922464415258772048692084', '0042891 臺銀中機', '2', 'z2018050920384315258695239267163', '1', null, null, '1525877204');
INSERT INTO `btc_bank` VALUES ('H2018050923375215258802722028299', '018 全國農業金庫', '1', '0', '0', null, null, '1525880272');
INSERT INTO `btc_bank` VALUES ('H2018050923383115258803119868393', '029 新加坡商大華銀行台北分行', '1', '0', '0', null, null, '1525880311');
INSERT INTO `btc_bank` VALUES ('H2018050923385715258803374627893', '048 王道商業銀行', '1', '0', '0', null, null, '1525880337');
INSERT INTO `btc_bank` VALUES ('H2018050923402115258804211534405', '081 匯豐（台灣）商業銀行', '1', '0', '0', null, null, '1525880421');
INSERT INTO `btc_bank` VALUES ('H2018050923403215258804327386589', '085 新加坡商新加坡華僑銀行台北分行', '1', '0', '0', null, null, '1525880432');
INSERT INTO `btc_bank` VALUES ('H2018050923405915258804597675918', '098 日商三菱東京日聯銀行台北分行', '1', '0', '0', null, null, '1525880459');
INSERT INTO `btc_bank` VALUES ('H2018050923433315258806131747916', '178 嘉義市第三信用合作社', '1', '0', '0', null, null, '1525880613');
INSERT INTO `btc_bank` VALUES ('H2018050923444815258806884720495', '188 台南第三信用合作社', '1', '0', '0', null, null, '1525880688');
INSERT INTO `btc_bank` VALUES ('H2018050923445415258806945293106', '204 高雄市第三信用合作社', '1', '0', '0', null, null, '1525880694');
INSERT INTO `btc_bank` VALUES ('H2018050923454615258807462716935', '380 大陸商中國銀行臺北分行', '1', '0', '0', null, null, '1525880746');
INSERT INTO `btc_bank` VALUES ('H2018050923460915258807697554725', '503 北農中心所屬會員', '1', '0', '0', null, null, '1525880769');
INSERT INTO `btc_bank` VALUES ('H2018050923471815258808387970847', '519 新化農會', '1', '0', '0', null, null, '1525880838');
INSERT INTO `btc_bank` VALUES ('H2018050923480815258808880764266', '542 農金資中心', '1', '0', '0', null, null, '1525880888');
INSERT INTO `btc_bank` VALUES ('H2018050923483315258809136340977', '556 學甲農會', '1', '0', '0', null, null, '1525880913');
INSERT INTO `btc_bank` VALUES ('H2018050923484915258809296070331', '559 山上農會', '1', '0', '0', null, null, '1525880929');
INSERT INTO `btc_bank` VALUES ('H2018050923490415258809442496320', '564 關廟農會', '1', '0', '0', null, null, '1525880944');
INSERT INTO `btc_bank` VALUES ('H2018050923491415258809546077148', '567 農金資中心', '1', '0', '0', null, null, '1525880954');
INSERT INTO `btc_bank` VALUES ('H2018050923521415258811347537903', '617 南農中心所屬會員', '1', '0', '0', null, null, '1525881134');
INSERT INTO `btc_bank` VALUES ('H2018050923522515258811455536254', '619 南農中心所屬會員', '1', '0', '0', null, null, '1525881145');
INSERT INTO `btc_bank` VALUES ('H2018050923531215258811927299062', '628 農金資中心', '1', '0', '0', null, null, '1525881192');
INSERT INTO `btc_bank` VALUES ('H2018050923531715258811971407338', '629 農金資中心', '1', '0', '0', null, null, '1525881197');
INSERT INTO `btc_bank` VALUES ('H2018050923534515258812253431960', '635 農金資中心', '1', '0', '0', null, null, '1525881225');
INSERT INTO `btc_bank` VALUES ('H2018050923553115258813314524216', '805 遠東國際商業銀行', '1', '0', '0', null, null, '1525881331');
INSERT INTO `btc_bank` VALUES ('H2018050923571815258814385667699', '874 霧峰農會', '1', '0', '0', null, null, '1525881438');
INSERT INTO `btc_bank` VALUES ('H2018050923584415258815249511284', '896 玉溪農會', '1', '0', '0', null, null, '1525881524');
INSERT INTO `btc_bank` VALUES ('H2018050923592215258815622708703', '902 農金資中心', '1', '0', '0', null, null, '1525881562');
INSERT INTO `btc_bank` VALUES ('H2018051000003815258816387603648', '921 農金資中心', '1', '0', '0', null, null, '1525881638');
INSERT INTO `btc_bank` VALUES ('H2018051000012215258816829424435', '953 農金資中心', '1', '0', '0', null, null, '1525881682');
INSERT INTO `btc_bank` VALUES ('H2018051009500715259170075799963', '行名', '2', 'A2018050923382015258803000912879', '0', null, null, '1525917007');
INSERT INTO `btc_bank` VALUES ('H2018052020401315268200139121093', '中国邮政银行', '1', '0', '0', null, null, '1526820013');
INSERT INTO `btc_bank` VALUES ('H2018060816583315284483131497605', '中国福建省福鼎市支行', '2', 'z2018052020344515268196854287198', '0', null, null, '1528448313');
INSERT INTO `btc_bank` VALUES ('H2018071516091315316421536112252', '竹北分行', '2', 'A2018050923374415258802649510938', '0', null, null, '1531642153');
INSERT INTO `btc_bank` VALUES ('q2018050920394915258695898153612', '0040130 臺銀中興', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869589');
INSERT INTO `btc_bank` VALUES ('q2018050920401015258696107849296', '0040163 臺銀彰化', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869610');
INSERT INTO `btc_bank` VALUES ('q2018050920503515258702350010359', '0040277 臺銀板橋', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870235');
INSERT INTO `btc_bank` VALUES ('q2018050920504715258702475478861', '0040288臺銀新營', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870247');
INSERT INTO `btc_bank` VALUES ('q2018050920510415258702647653853', '0040299 臺銀苗栗', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870264');
INSERT INTO `btc_bank` VALUES ('q2018050920543215258704723188915', '0040358 臺銀左營', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870472');
INSERT INTO `btc_bank` VALUES ('q2018050920564115258706015200664', '0040440 臺銀前鎮', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870601');
INSERT INTO `btc_bank` VALUES ('q2018050921022215258709425971019', '0040613臺銀新興', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870942');
INSERT INTO `btc_bank` VALUES ('q2018050921035815258710380169400', '0040716 臺銀新莊', '2', 'z2018050920384315258695239267163', '0', null, null, '1525871038');
INSERT INTO `btc_bank` VALUES ('q2018050921043715258710770793753', '0040750 臺銀新店', '2', 'z2018050920384315258695239267163', '0', null, null, '1525871077');
INSERT INTO `btc_bank` VALUES ('q2018050922322915258763497111006', '0041090 臺银水湳', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876349');
INSERT INTO `btc_bank` VALUES ('q2018050922325815258763787839819', '0041159 臺銀桃機', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876378');
INSERT INTO `btc_bank` VALUES ('q2018050922362515258765850593196', '0041540 臺銀嘉北', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876585');
INSERT INTO `btc_bank` VALUES ('q2018050922364815258766088269028', '0041562 臺銀汐止', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876608');
INSERT INTO `btc_bank` VALUES ('q2018050922370815258766287833971', '0041595 臺銀小港', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876628');
INSERT INTO `btc_bank` VALUES ('q2018050922380015258766800858384', '0041713 臺銀德芳', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876680');
INSERT INTO `btc_bank` VALUES ('q2018050922383415258767146147989', '0041872 臺銀蘆洲', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876714');
INSERT INTO `btc_bank` VALUES ('q2018050922415515258769153274564', '0042260 臺銀龍潭', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876915');
INSERT INTO `btc_bank` VALUES ('q2018050922425015258769703835268', '0042396 臺銀金山', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876970');
INSERT INTO `btc_bank` VALUES ('q2018050922444615258770866560269', '0042488 臺銀六家', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877086');
INSERT INTO `btc_bank` VALUES ('q2018050922463615258771964675861', '0042835 臺銀仁武', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877196');
INSERT INTO `btc_bank` VALUES ('q2018050923390915258803492563256', '052 渣打國際商業銀行', '1', '0', '0', null, null, '1525880349');
INSERT INTO `btc_bank` VALUES ('q2018050923393415258803741278828', '060 兆豐票券金融股份有限公司', '1', '0', '0', null, null, '1525880374');
INSERT INTO `btc_bank` VALUES ('q2018050923431015258805908977878', '162 彰化第六信用合作社', '1', '0', '0', null, null, '1525880590');
INSERT INTO `btc_bank` VALUES ('q2018050923492915258809697531543', '573 農金資中心', '1', '0', '0', null, null, '1525880969');
INSERT INTO `btc_bank` VALUES ('q2018050923524615258811661961180', '622 南農中心所屬會員', '1', '0', '0', null, null, '1525881166');
INSERT INTO `btc_bank` VALUES ('q2018050923532715258812077370043', '632 農金資中心', '1', '0', '0', null, null, '1525881207');
INSERT INTO `btc_bank` VALUES ('q2018050923543615258812764017389', '651 農金資中心', '1', '0', '0', null, null, '1525881276');
INSERT INTO `btc_bank` VALUES ('q2018050923561115258813715308681', '812 台新國際商業銀行', '1', '0', '0', null, null, '1525881371');
INSERT INTO `btc_bank` VALUES ('q2018050923583915258815194210118', '895 瑞穗農會', '1', '0', '0', null, null, '1525881519');
INSERT INTO `btc_bank` VALUES ('q2018050923593215258815720544042', '904 板農中心所屬會員', '1', '0', '0', null, null, '1525881572');
INSERT INTO `btc_bank` VALUES ('q2018051000005615258816567488242', '924 農金資中心', '1', '0', '0', null, null, '1525881656');
INSERT INTO `btc_bank` VALUES ('q2018051000011115258816716240597', '928 板農中心所屬會員', '1', '0', '0', null, null, '1525881671');
INSERT INTO `btc_bank` VALUES ('q2018060315060115280095613042991', '上海支行', '2', 'z2018052020371515268198352373018', '0', null, null, '1528009561');
INSERT INTO `btc_bank` VALUES ('q2018060720182415283739042791373', '苏苏', '2', 'z2018050923364815258802087731016', '0', null, null, '1528373904');
INSERT INTO `btc_bank` VALUES ('q2018061516281115290512918349810', '001 高雄分行', '2', 'z2018050920384315258695239267163', '0', null, null, '1529051291');
INSERT INTO `btc_bank` VALUES ('z2018050920384315258695239267163', '004 臺灣銀行', '1', '0', '0', null, null, '1525869523');
INSERT INTO `btc_bank` VALUES ('z2018050920403315258696332193042', '0040196 臺銀延平', '2', 'z2018050920384315258695239267163', '0', null, null, '1525869633');
INSERT INTO `btc_bank` VALUES ('z2018050920541815258704582282105', '0040347 臺銀公館', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870458');
INSERT INTO `btc_bank` VALUES ('z2018050920565315258706137633233', '0040451 臺銀城中', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870613');
INSERT INTO `btc_bank` VALUES ('z2018050921000015258708003641955', '0040473 臺銀潭子', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870800');
INSERT INTO `btc_bank` VALUES ('z2018050921013715258708979157456', '0040576 臺銀臺中港', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870897');
INSERT INTO `btc_bank` VALUES ('z2018050921024215258709624857529', '0040624 臺銀岺雅', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870962');
INSERT INTO `btc_bank` VALUES ('z2018050921030315258709831209395', '0040657 臺銀健行', '2', 'z2018050920384315258695239267163', '0', null, null, '1525870983');
INSERT INTO `btc_bank` VALUES ('z2018050921034115258710219724515', '0040705 臺銀士林', '2', 'z2018050920384315258695239267163', '0', null, null, '1525871021');
INSERT INTO `btc_bank` VALUES ('z2018050922302115258762214857914', '0040819 臺銀永康', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876221');
INSERT INTO `btc_bank` VALUES ('z2018050922305215258762526184271', '0040864 臺銀大安', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876252');
INSERT INTO `btc_bank` VALUES ('z2018050922360715258765672386242', '0041481 臺銀淡水', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876567');
INSERT INTO `btc_bank` VALUES ('z2018050922371715258766372471147', '0041609 臺銀中屏', '2', 'z2018050920384315258695239267163', '0', null, null, '1525876637');
INSERT INTO `btc_bank` VALUES ('z2018050922432915258770094854912', '0042433 臺銀板新', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877009');
INSERT INTO `btc_bank` VALUES ('z2018050922434515258770252817366', '0042455 臺銀南新莊', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877025');
INSERT INTO `btc_bank` VALUES ('z2018050922441015258770504727596', '0042477 臺銀新明', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877050');
INSERT INTO `btc_bank` VALUES ('z2018050922451915258771195214871', '0042558 臺銀北高雄', '2', 'z2018050920384315258695239267163', '0', null, null, '1525877119');
INSERT INTO `btc_bank` VALUES ('z2018050923364815258802087731016', '006 合作金庫商業銀行', '1', '0', '0', null, null, '1525880208');
INSERT INTO `btc_bank` VALUES ('z2018050923373715258802578607655', '016 高雄銀行', '1', '0', '0', null, null, '1525880257');
INSERT INTO `btc_bank` VALUES ('z2018050923402615258804262741089', '082 法國巴黎銀行台北分行', '1', '0', '0', null, null, '1525880426');
INSERT INTO `btc_bank` VALUES ('z2018050923420715258805271335418', '124 宜蘭信用合作社', '1', '0', '0', null, null, '1525880527');
INSERT INTO `btc_bank` VALUES ('z2018050923462915258807897923890', '507 聯資中心所屬會員', '1', '0', '0', null, null, '1525880789');
INSERT INTO `btc_bank` VALUES ('z2018050923472815258808488777031', '521 南農中心所屬會員', '1', '0', '0', null, null, '1525880848');
INSERT INTO `btc_bank` VALUES ('z2018050923475015258808708694957', '525 南農中心所屬會員', '1', '0', '0', null, null, '1525880870');
INSERT INTO `btc_bank` VALUES ('z2018050923482815258809081563895', '552 農金資中心', '1', '0', '0', null, null, '1525880908');
INSERT INTO `btc_bank` VALUES ('z2018050923513415258810945198179', '608 聯資中心所屬會員', '1', '0', '0', null, null, '1525881094');
INSERT INTO `btc_bank` VALUES ('z2018050923520915258811293292087', '616 南農中心所屬會員', '1', '0', '0', null, null, '1525881129');
INSERT INTO `btc_bank` VALUES ('z2018050923541115258812511859081', '643 農金資中心', '1', '0', '0', null, null, '1525881251');
INSERT INTO `btc_bank` VALUES ('z2018050923542615258812666117872', '649 農金資中心', '1', '0', '0', null, null, '1525881266');
INSERT INTO `btc_bank` VALUES ('z2018050923543115258812714819199', '650 農金資中心', '1', '0', '0', null, null, '1525881271');
INSERT INTO `btc_bank` VALUES ('z2018050923551115258813112518203', '699 農金資中心', '1', '0', '0', null, null, '1525881311');
INSERT INTO `btc_bank` VALUES ('z2018050923551615258813160302405', '700 中華郵政股份有限公司', '1', '0', '0', null, null, '1525881316');
INSERT INTO `btc_bank` VALUES ('z2018050923552515258813255128226', '803 聯邦銀行', '1', '0', '0', null, null, '1525881325');
INSERT INTO `btc_bank` VALUES ('z2018051000001015258816104843821', '915 農金資中心', '1', '0', '0', null, null, '1525881610');
INSERT INTO `btc_bank` VALUES ('z2018051000005115258816513046770', '923 農金資中心', '1', '0', '0', null, null, '1525881651');
INSERT INTO `btc_bank` VALUES ('z2018051000013315258816934451290', '996 財政部國庫署', '1', '0', '0', null, null, '1525881693');
INSERT INTO `btc_bank` VALUES ('z2018052020344515268196854287198', '中国建设银行', '1', '0', '0', null, null, '1526819685');
INSERT INTO `btc_bank` VALUES ('z2018052020371515268198352373018', '中国中信银行', '1', '0', '0', null, null, '1526819835');
INSERT INTO `btc_bank` VALUES ('z2018060315055815280095585690550', '上海支行', '2', 'z2018052020371515268198352373018', '0', null, null, '1528009558');
INSERT INTO `btc_bank` VALUES ('z2018060414192715280931670687775', '福建省福州分行', '2', 'z2018052020371515268198352373018', '0', null, null, '1528093167');
INSERT INTO `btc_bank` VALUES ('z2018060414524915280951694273928', '广东省惠州淡水立交桥中国工商银行', '2', 'a2018052020351715268197174140631', '0', null, null, '1528095169');
INSERT INTO `btc_bank` VALUES ('z2018062914572115302554417462533', '中国广西省南宁市兴宁区南梧支行', '2', 'A2018052020345815268196986787122', '0', null, null, '1530255441');
INSERT INTO `btc_bank` VALUES ('z2018071218335715313916377019167', '0473 文心分行', '2', 'G2018050923563215258813925010552', '0', null, null, '1531391637');

-- ----------------------------
-- Table structure for btc_bulletin
-- ----------------------------
DROP TABLE IF EXISTS `btc_bulletin`;
CREATE TABLE `btc_bulletin` (
  `bulletin_id` varchar(32) NOT NULL COMMENT '公告ID',
  `bulletin_title_i18n` varchar(32) NOT NULL COMMENT '公告标题',
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '发布状态0-未发布 1-已发布',
  `bulletin_content_i18n` varchar(32) NOT NULL COMMENT '公告内容',
  `bulletin_issue_time` varchar(12) DEFAULT NULL COMMENT '公告发布时间',
  `delete_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`bulletin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告表';

-- ----------------------------
-- Records of btc_bulletin
-- ----------------------------
INSERT INTO `btc_bulletin` VALUES ('A2018051001010915258852697842729', 'G2018051001010915258852697820646', '1', 'D2018051001010915258852697821086', '1525885276', '1527950333', null, '1525885269', '1');
INSERT INTO `btc_bulletin` VALUES ('a2018053013593215276599729707084', 'q2018053013593215276599729550771', '1', 'a2018053013593215276599729550793', '1527660021', '1527744002', null, '1527659972', '1');
INSERT INTO `btc_bulletin` VALUES ('a2018060221114515279451057132173', 'D2018060221114515279451057127752', '1', 'B2018060221114515279451057127967', '1527945128', '1528086294', null, '1527945105', '1');
INSERT INTO `btc_bulletin` VALUES ('A2018060812571615284338362840348', 'D2018060812571615284338362835541', '1', 'H2018060812571615284338362835772', '1528433845', '1528647491', null, '1528433836', '1');
INSERT INTO `btc_bulletin` VALUES ('B2018051000570215258850220296843', 'b2018051000570215258850220264347', '1', 'B2018051000570215258850220264715', '1525885057', '1525885163', null, '1525885022', '1');
INSERT INTO `btc_bulletin` VALUES ('b2018052020191515268187554501904', 'z2018052020191515268187554345747', '1', 'A2018052020191515268187554345721', '1526819167', null, null, '1526818755', '0');
INSERT INTO `btc_bulletin` VALUES ('b2018052814352715274893278697714', 'a2018052814352715274893278228965', '1', 'z2018052814352715274893278228900', '1527489363', '1527576299', null, '1527489327', '1');
INSERT INTO `btc_bulletin` VALUES ('B2018052914444315275762838367168', 'q2018052914444315275762838054600', '1', 'z2018052914444315275762838054605', '1527576310', '1527576685', null, '1527576283', '1');
INSERT INTO `btc_bulletin` VALUES ('B2018061118132715287120073149697', 'z2018061118132715287120073145229', '1', 'a2018061118132715287120073145560', '1528712029', '1529677738', null, '1528712007', '1');
INSERT INTO `btc_bulletin` VALUES ('B2018062222284415296777242426136', 'b2018062222284415296777242420191', '1', 'H2018062222284415296777242420375', '1529677747', null, null, '1529677724', '0');
INSERT INTO `btc_bulletin` VALUES ('D2018053113194415277439846650309', 'z2018053113194415277439846337827', '1', 'D2018053113194415277439846337807', '1527744013', '1527945121', null, '1527743984', '1');
INSERT INTO `btc_bulletin` VALUES ('H2018052020324915268195691289022', 'q2018052020324915268195691289035', '1', 'b2018052020324915268195691289041', '1526819638', '1527489134', null, '1526819569', '1');
INSERT INTO `btc_bulletin` VALUES ('H2018060412243315280862737356765', 'B2018060412243315280862737352405', '1', 'A2018060412243315280862737352640', '1528086301', '1528204761', null, '1528086273', '1');
INSERT INTO `btc_bulletin` VALUES ('q2018060222383315279503135143813', 'z2018060222383315279503135139501', '1', 'D2018060222383315279503135139786', '1527950434', '1527950785', null, '1527950313', '1');
INSERT INTO `btc_bulletin` VALUES ('q2018060521184915282047294026911', 'c2018060521184915282047294021748', '1', 'b2018060521184915282047294021912', '1528204776', '1528712020', null, '1528204729', '1');
INSERT INTO `btc_bulletin` VALUES ('z2018052914510815275766686365284', 'b2018052914510815275766686365218', '1', 'A2018052914510815275766686365276', '1527576696', '1527660007', null, '1527576668', '1');
INSERT INTO `btc_bulletin` VALUES ('z2018060222491615279509562359528', 'B2018060222491615279509562322536', '1', 'b2018060222491615279509562322777', '1527950967', '1529905777', null, '1527950956', '1');
INSERT INTO `btc_bulletin` VALUES ('z2018062513490815299057485157188', 'H2018062513490815299057485152429', '1', 'D2018062513490815299057485152688', '1529905765', null, null, '1529905748', '0');

-- ----------------------------
-- Table structure for btc_common_problem
-- ----------------------------
DROP TABLE IF EXISTS `btc_common_problem`;
CREATE TABLE `btc_common_problem` (
  `common_problem_id` varchar(32) NOT NULL COMMENT '常见问题ID',
  `title_i18n_id` varchar(32) DEFAULT NULL COMMENT '标题题目',
  `content_i18n_id` varchar(32) DEFAULT NULL COMMENT '问题内容',
  `type` tinyint(1) DEFAULT '1' COMMENT '查看constant.php文件',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`common_problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='常见问题表';

-- ----------------------------
-- Records of btc_common_problem
-- ----------------------------
INSERT INTO `btc_common_problem` VALUES ('a2018051000362315258837838904429', 'q2018051000362315258837838874404', 'b2018051000362315258837838874920', '2', null, null, '1525883783', '0');
INSERT INTO `btc_common_problem` VALUES ('a2018051000384515258839254026186', 'D2018051000384515258839253990379', 'B2018051000384515258839253990648', '2', null, null, '1525883925', '0');
INSERT INTO `btc_common_problem` VALUES ('c2018051000233015258830104870327', 'B2018051000233015258830104844442', 'D2018051000233015258830104844846', '1', null, null, '1525883010', '0');
INSERT INTO `btc_common_problem` VALUES ('G2018051000210715258828675379404', 'A2018051000210715258828675346581', 'c2018051000210715258828675346814', '1', null, null, '1525882867', '0');
INSERT INTO `btc_common_problem` VALUES ('z2018051000281615258832966442913', 'G2018051000281615258832966404707', 'H2018051000281615258832966405154', '1', null, null, '1525883296', '0');
INSERT INTO `btc_common_problem` VALUES ('z2018051000312115258834819795782', 'c2018051000312115258834819759238', 'b2018051000312115258834819759539', '1', null, null, '1525883481', '0');
INSERT INTO `btc_common_problem` VALUES ('z2018051000411715258840778745910', 'D2018051000411715258840778715581', 'a2018051000411715258840778715803', '2', null, null, '1525884077', '0');

-- ----------------------------
-- Table structure for btc_currency_value
-- ----------------------------
DROP TABLE IF EXISTS `btc_currency_value`;
CREATE TABLE `btc_currency_value` (
  `id` varchar(32) NOT NULL,
  `btc_value_twd` decimal(50,0) NOT NULL COMMENT '比特币对新台币的单价',
  `btc_value_hkd` decimal(50,0) NOT NULL COMMENT '比特币对港币的单价',
  `btc_value_usd` decimal(50,0) NOT NULL COMMENT '比特币对美元的单价',
  `eth_value_twd` decimal(50,0) NOT NULL COMMENT '以太币对新台币的单价',
  `eth_value_hkd` decimal(50,0) NOT NULL COMMENT '以太币对港币的单价',
  `eth_value_usd` decimal(50,0) NOT NULL COMMENT '以太币对美元的单价',
  `etc_float_max` varchar(10) NOT NULL COMMENT '以太币浮动值',
  `btc_float_max` varchar(10) NOT NULL COMMENT '比特币浮动值',
  `etc_float_min` varchar(10) NOT NULL COMMENT '以太币浮动最小值',
  `btc_float_min` varchar(10) NOT NULL COMMENT '比特币浮动最小值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='货币价值表';

-- ----------------------------
-- Records of btc_currency_value
-- ----------------------------
INSERT INTO `btc_currency_value` VALUES ('10000000000000000000000000000000', '191100', '49685', '6370', '13380', '3478', '446', '0.0831', '0.0155', '0.0322', '0.00350');

-- ----------------------------
-- Table structure for btc_exchange
-- ----------------------------
DROP TABLE IF EXISTS `btc_exchange`;
CREATE TABLE `btc_exchange` (
  `id` int(2) NOT NULL,
  `usd` float(32,4) DEFAULT NULL COMMENT '美金',
  `twd` float(32,4) DEFAULT NULL COMMENT '新台币',
  `hkd` float(32,4) DEFAULT NULL COMMENT '港币',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='汇率设置';

-- ----------------------------
-- Records of btc_exchange
-- ----------------------------
INSERT INTO `btc_exchange` VALUES ('1', '1.0000', '6.1400', '7.2200');

-- ----------------------------
-- Table structure for btc_home_info
-- ----------------------------
DROP TABLE IF EXISTS `btc_home_info`;
CREATE TABLE `btc_home_info` (
  `id` varchar(32) NOT NULL,
  `background_url` varchar(255) NOT NULL COMMENT '首页图片的URL',
  `logo_url` varchar(255) NOT NULL COMMENT '首页图标的URL',
  `name` varchar(255) NOT NULL COMMENT '网站名字',
  `company_tel` varchar(18) NOT NULL COMMENT '公司电话',
  `i18n_id` varchar(50) NOT NULL COMMENT '公司营业时间，用文字描述',
  `company_email` varchar(50) NOT NULL COMMENT '公司邮箱',
  `bulletin_status` varchar(1) NOT NULL COMMENT '0-公告浮动1-公告隐藏',
  `service_status` varchar(1) NOT NULL COMMENT '0-客服浮动1-客服隐藏',
  `float_status` varchar(1) NOT NULL DEFAULT '0' COMMENT '1-开启自动跳动 0-关闭自动跳动',
  `email_type` varchar(1) DEFAULT NULL COMMENT '1-QQ邮箱 2-163邮箱3-雅虎邮箱',
  `email_account` varchar(50) DEFAULT NULL COMMENT '邮箱账号',
  `email_password` varchar(50) DEFAULT NULL COMMENT '邮箱密码',
  `buy_float` varchar(10) NOT NULL COMMENT '买入的浮动设置',
  `sell_float` varchar(10) NOT NULL COMMENT '卖出的浮动',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='界面图片信息表';

-- ----------------------------
-- Records of btc_home_info
-- ----------------------------
INSERT INTO `btc_home_info` VALUES ('10000000000000000000000000000000', 'http://blnance66.com/Uploads/action/basics/5b20cb9079e34.jpg', 'http://localhost:8081/Uploads/action/basics/5b94ae888317d.jpg', 'Blnance幣淘网', '+852-67349858', 'z2018051614152915264513298476213', 'binance8856@163.com', '0', '0', '1', '2', '13885578655@163.com', 'bHV4aW5neWkxOTk2MTIwNQ==', '0.0082', '0.0052');

-- ----------------------------
-- Table structure for btc_i18n
-- ----------------------------
DROP TABLE IF EXISTS `btc_i18n`;
CREATE TABLE `btc_i18n` (
  `i18n_id` varchar(32) NOT NULL COMMENT '国际化ID',
  `en_content` text COMMENT '英文',
  `tw_content` text COMMENT '繁体',
  `deleted_time` varchar(11) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(11) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT '0-正常 1-删除',
  PRIMARY KEY (`i18n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='国际化信息表';

-- ----------------------------
-- Records of btc_i18n
-- ----------------------------
INSERT INTO `btc_i18n` VALUES ('20180424154524152455592436552193', 'yes', '每周一', null, null, '1525436879', '0');
INSERT INTO `btc_i18n` VALUES ('A2018051000210715258828675346581', 'How do I send digital assets?', '如何發送數位資產？', null, null, '1525882867', '0');
INSERT INTO `btc_i18n` VALUES ('a2018051000411715258840778715803', '&lt;p&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: arial; font-size: 17px; background-color: rgb(245, 245, 245);&quot;&gt;Since this platform is self-motivated, there will be no refund for each order after the transaction is completed. Please use your client to send out the money before the transaction. The service will confirm the order information and thank you.&lt;/span&gt;&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;因本平台自動化交易，所以每筆訂單完成交易後，即無法退款，請用戶匯出款項前，務必將訂單資訊確認再三，謝謝您。&lt;/span&gt;&lt;/p&gt;', null, null, '1525884077', '0');
INSERT INTO `btc_i18n` VALUES ('A2018052020191515268187554345721', '&lt;pre class=&quot;tw-data-text tw-ta tw-text-small&quot; style=&quot;height: 288px; text-align: right;&quot;&gt;To&amp;nbsp;make&amp;nbsp;the&amp;nbsp;platform&amp;nbsp;better&amp;nbsp;serve&amp;nbsp;our&amp;nbsp;customers,&amp;nbsp;we&amp;nbsp;are&amp;nbsp;now&amp;nbsp;opening&amp;nbsp;new&amp;nbsp;channels&amp;nbsp;for&amp;nbsp;virtual&amp;nbsp;currency&amp;nbsp;transactions&amp;nbsp;in&amp;nbsp;mainland&amp;nbsp;China.&amp;nbsp;For&amp;nbsp;the&amp;nbsp;settlement&amp;nbsp;of&amp;nbsp;RMB&amp;nbsp;in&amp;nbsp;mainland&amp;nbsp;China,&amp;nbsp;the&amp;nbsp;platform&amp;nbsp;will&amp;nbsp;display&amp;nbsp;the&amp;nbsp;currency&amp;nbsp;in&amp;nbsp;Taiwanese&amp;nbsp;dollars.&amp;nbsp;For&amp;nbsp;Mainland&amp;nbsp;China&amp;nbsp;customers&amp;nbsp;who&amp;nbsp;need&amp;nbsp;to&amp;nbsp;withdraw&amp;nbsp;cash,&amp;nbsp;you&amp;nbsp;can&amp;nbsp;check&amp;nbsp;the&amp;nbsp;exchange&amp;nbsp;rate&amp;nbsp;on&amp;nbsp;the&amp;nbsp;same&amp;nbsp;day&amp;nbsp;that&amp;nbsp;you&amp;nbsp;are&amp;nbsp;viewing&amp;nbsp;the&amp;nbsp;platform&amp;nbsp;announcement.&amp;nbsp;For&amp;nbsp;details,&amp;nbsp;please&amp;nbsp;contact&amp;nbsp;WeChat:&amp;nbsp;girls_696\n&amp;nbsp;&amp;nbsp;&amp;nbsp;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;Blnance&amp;nbsp;Coin&amp;nbsp;Trading&amp;nbsp;Platform&lt;/pre&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p&gt;&amp;nbsp; &amp;nbsp; 為使平臺更好的服務廣大客戶，現新開通中國大陸客戶虛擬貨幣交易渠道。對於中國大陸需以人民幣為結算，平台將實行以新台幣為基本貨幣顯示，對於需要提現的中國大陸客戶，您可以在提現當日查看平臺公告將會告知當日匯率進行結算。詳情可咨詢 &amp;nbsp;微信：girls_696&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; Blnance幣淘交易平臺&lt;/p&gt;', null, null, '1526818755', '0');
INSERT INTO `btc_i18n` VALUES ('a2018052814352715274893278228965', 'announcement', '公告：今日提現匯率', null, null, '1527489327', '0');
INSERT INTO `btc_i18n` VALUES ('A2018052914510815275766686365276', '&lt;p&gt;1 USD = 6.4138 CNY &amp;nbsp; &amp;nbsp; &amp;nbsp;1 TWD = 0.2138 CNY&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p&gt;1 美元 = 6.4138 人民幣 &amp;nbsp; &amp;nbsp; &amp;nbsp; 1 新臺幣 = 0.2138 人民幣&lt;/p&gt;', null, null, '1527576668', '0');
INSERT INTO `btc_i18n` VALUES ('a2018053013593215276599729550793', '&lt;p&gt;1 USD = 6.4256 CNY &amp;nbsp; &amp;nbsp; &amp;nbsp;1 TWD = 0.2137 CNY&lt;/p&gt;', '&lt;p&gt;1 美元 = 6.4256 人民幣 &amp;nbsp; &amp;nbsp; &amp;nbsp; 1 新臺幣 = 0.2137 人民幣&lt;/p&gt;', null, null, '1527659972', '0');
INSERT INTO `btc_i18n` VALUES ('A2018060315273915280108594864601', '新註冊用戶首次交易', '新註冊用戶首次交易', null, null, '1528010859', '0');
INSERT INTO `btc_i18n` VALUES ('A2018060412243315280862737352640', '&lt;p&gt;1 USD = 6.418 CNY&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 1 TWD = 0.2153 CNY&lt;/p&gt;', '&lt;p&gt;1 美元 = 6.418 人民幣&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 1 新臺幣 = 0.2153 人民幣&lt;br/&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1528086273', '0');
INSERT INTO `btc_i18n` VALUES ('A2018060412472915280876493475338', '平台返利到賬', '平台返利到賬', null, null, '1528087649', '0');
INSERT INTO `btc_i18n` VALUES ('a2018060419161415281109746653727', '平台返利到賬', '平台返利到賬', null, null, '1528110974', '0');
INSERT INTO `btc_i18n` VALUES ('a2018060513185715281759378880518', '提現到賬通知', '提現到賬通知', null, null, '1528175937', '0');
INSERT INTO `btc_i18n` VALUES ('a2018060513242315281762633607076', '提現到賬通知', '提現到賬通知', null, null, '1528176263', '0');
INSERT INTO `btc_i18n` VALUES ('a2018061118132715287120073145560', '&lt;p&gt;1 USD = 6.4 CNY&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 1 TWD = 0.21 CNY&lt;/p&gt;', '&lt;p&gt;1 美元 = 6.4 人民幣&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 1 新臺幣 = 0.21 人民幣&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1528712007', '0');
INSERT INTO `btc_i18n` VALUES ('A2018061323540215289052428465298', '币淘微平台ID和初始密码', '币淘微平台ID和初始密码', null, null, '1528905242', '0');
INSERT INTO `btc_i18n` VALUES ('A2018062522001215299352128562964', '系統資金提領失敗以退回原賬戶', '系統資金提領失敗以退回原賬戶', null, null, '1529935212', '0');
INSERT INTO `btc_i18n` VALUES ('A2018062815263715301707977352198', '幣淘ID獲取', '幣淘ID獲取', null, null, '1530170797', '0');
INSERT INTO `btc_i18n` VALUES ('A2018070717470415309568245014055', '幣淘微投ID', '幣淘微投ID', null, null, '1530956824', '0');
INSERT INTO `btc_i18n` VALUES ('a2018071314432515314642052485703', '通知', '【幣淘微投】ID', null, null, '1531464205', '0');
INSERT INTO `btc_i18n` VALUES ('A2018071514511715316374771025819', 'Blnance micro-projection', ' 幣淘微投ID', null, null, '1531637477', '0');
INSERT INTO `btc_i18n` VALUES ('a2018071521060815316599682390896', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000127 initial password is 0915520669   To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.   ', '            尊敬的用戶幣淘交易平台最近推出【幣淘微投】，您的登錄ID：10000127 初始密碼為 0915520669  為保證您的賬戶安全請盡快登入微平台修改您的初始密碼。  有任何問題可諮詢平台客服。', null, null, '1531659968', '0');
INSERT INTO `btc_i18n` VALUES ('a2018071617305215317334526425540', '【現金提領通知】', '【現金提領通知】', null, null, '1531733452', '0');
INSERT INTO `btc_i18n` VALUES ('a2018071617305215317334526425687', '            親愛 Blnance幣淘 用戶您好， 因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳提領現金金額為【25000】台幣---（RMB5000）以上， 每筆提領手續費0.01---造成不便敬請見諒。 謝謝您 Blnance幣淘 敬上', '            親愛 Blnance幣淘 用戶您好， 因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳提領現金金額為【25000】台幣---（RMB5000）以上， 每筆提領手續費0.01---造成不便敬請見諒。 謝謝您 Blnance幣淘 敬上', null, null, '1531733452', '0');
INSERT INTO `btc_i18n` VALUES ('A2019022815361015513393706047659', '123', '1', null, null, '1551339370', '0');
INSERT INTO `btc_i18n` VALUES ('A2019022815361015513393706047891', '123sdasdasdasdasd', '            123asdasdasdada', null, null, '1551339370', '0');
INSERT INTO `btc_i18n` VALUES ('B2018051000233015258830104844442', 'How do I receive digital assets? ', '如何接收數位資產？', null, null, '1525883010', '0');
INSERT INTO `btc_i18n` VALUES ('b2018051000312115258834819759539', '&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 24px; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;The system typically sends out digital assets from addresses that do not belong to users. We recommend searching by transaction ID for the best result.Most well-known digital asset websites and apps rely on the exclusivity of transaction IDs for record verification.&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 24px; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;從本站發送數位資產至外部錢包時並不會從用戶的地址發送。基本上就像您在便利超商領的錢不會是您在郵局存的「一樣的錢」。所以本站強烈建議用戶以具有唯一性的交易ID在區塊鏈帳本上搜尋以獲得最準確的結果證明。目前有許多以比特幣或以太幣為交易媒介並標榜高報酬的投資網站會要求使用發送地址作為依據，此為常見的詐騙手法。本站無法對其他外部網站負責，還請用戶在登錄這些高風險網站時務必小心謹慎。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1525883481', '0');
INSERT INTO `btc_i18n` VALUES ('b2018051000362315258837838874920', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;To sell your digital assets, please enter your wallet and click on the Sell menu item. MaiCoin will transfer money to your designated bank account within 3-5 business days.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 24px; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;Important: Please make sure your bank information is updated on your account.&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;點選出售功能，並輸入您欲出售之數位資產，完成出售動作後，我們將在3-5個工作天匯款至您指定的銀行帳戶。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 24px; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;請注意，進行出售前，須至設定，完成綁定賣單銀行帳號&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1525883783', '0');
INSERT INTO `btc_i18n` VALUES ('B2018051000363615258837964841311', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;To sell your digital assets, please enter your wallet and click on the Sell menu item. MaiCoin will transfer money to your designated bank account within 3-5 business days.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 24px; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;Important: Please make sure your bank information is updated on your account.&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;點選出售功能，並輸入您欲出售之數位資產，完成出售動作後，我們將在3-5個工作天匯款至您指定的銀行帳戶。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 24px; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;請注意，進行出售前，須至設定，完成綁定賣單銀行帳號&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1525883796', '0');
INSERT INTO `btc_i18n` VALUES ('B2018051000384515258839253990648', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;You can only place one order at a time. Please pay for your outstanding order before placing a new order.&lt;/span&gt;&lt;/p&gt;', '&lt;ul style=&quot;box-sizing: border-box; padding: 0px; margin-top: 12px; margin-bottom: 24px; margin-left: 20px; list-style-position: initial; list-style-image: initial; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot; class=&quot; list-paddingleft-2&quot;&gt;&lt;li&gt;&lt;p&gt;欲使用銀行轉帳功能進行購買，您需要提供 [身份證字號] 及完成 [雙層認證]，請參照&lt;a href=&quot;https://www.maicoin.com/zh-TW/faq/security?selected=69&quot; style=&quot;box-sizing: border-box; color: rgb(46, 69, 146); text-decoration: none; background-color: transparent;&quot;&gt;身份驗證項目&lt;/a&gt;。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;一次只能下一張買單。您需要完成上筆付款，才可以下新的買單。&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1525883925', '0');
INSERT INTO `btc_i18n` VALUES ('b2018051000570215258850220264347', 'announcement', '平臺公告：新註冊用戶送NT$2000（送送送）', null, null, '1525885022', '0');
INSERT INTO `btc_i18n` VALUES ('B2018051000570215258850220264715', '&lt;p&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: arial; font-size: 24px; background-color: rgb(245, 245, 245);&quot;&gt;New register successfully launched NT$ 2000 with the first transaction，（&lt;span style=&quot;color: rgb(51, 51, 51); font-family: arial; font-size: 24px; background-color: rgb(245, 245, 245);&quot;&gt;Please contact customer service when the transaction is successful.）&lt;span style=&quot;color: rgb(51, 51, 51); font-family: arial; font-size: 24px; background-color: rgb(245, 245, 245);&quot;&gt;Only 200 per day.&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;', '&lt;p&gt;&amp;nbsp; &amp;nbsp;本平臺新註冊用戶首次交易成功立送NT$2000（請交易成功后聯繫客服領取），每日僅限200名。&lt;/p&gt;', null, null, '1525885022', '0');
INSERT INTO `btc_i18n` VALUES ('b2018052020324915268195691289041', '&lt;p&gt;1CNY=4.6937TWD&lt;/p&gt;', '&lt;p&gt;1人民幣=4.6937新台幣&lt;br/&gt;&lt;/p&gt;', null, null, '1526819569', '0');
INSERT INTO `btc_i18n` VALUES ('b2018052914510815275766686365218', 'Announcement', '公告：今日提現匯率', null, null, '1527576668', '0');
INSERT INTO `btc_i18n` VALUES ('B2018060221114515279451057127967', '&lt;p&gt;1 USD = 6.418 CNY &amp;nbsp; &amp;nbsp; &amp;nbsp;1 TWD = 0.2135 CNY&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p&gt;1 美元 = 6.418 人民幣 &amp;nbsp; &amp;nbsp; &amp;nbsp; 1 新臺幣 = 0.2135 人民幣&lt;/p&gt;', null, null, '1527945105', '0');
INSERT INTO `btc_i18n` VALUES ('B2018060222491615279509562322536', 'Announcement: newly registered mainland users successfully sent 300RMB for the first time', '公告：新註冊大陆用户首次交易成功立送300RMB', null, null, '1527950956', '0');
INSERT INTO `btc_i18n` VALUES ('b2018060222491615279509562322777', '&lt;p&gt;The newly registered mainland user&amp;#39;s first transaction was successfully sent to RMB300 (please contact customer service after successful transaction), with a daily limit of 200.&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);&quot;&gt;本平臺新註冊大陆用戶首次交易无需任何手续费，并且交易成功立送RMB300（請交易成功后凭订单号聯繫客服領取），每日僅限200名。&lt;/span&gt;&lt;/p&gt;', null, null, '1527950956', '0');
INSERT INTO `btc_i18n` VALUES ('B2018060412243315280862737352405', 'Announcement', '公告：今日提現匯率', null, null, '1528086273', '0');
INSERT INTO `btc_i18n` VALUES ('b2018060521184915282047294021912', '&lt;p&gt;1 USD = 6.5 CNY&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 1 TWD = 0.2153 CNY&lt;/p&gt;', '&lt;p&gt;1 美元 = 6.5 人民幣&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 1 新臺幣 = 0.2153 人民幣&lt;br/&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1528204729', '0');
INSERT INTO `btc_i18n` VALUES ('B2018061816471815293116385494412', '     尊敬的用戶幣淘交易平臺最近推出幣淘微投，您的登錄ID：10000105\n初始密碼為 123456   為保障您的賬戶安全請盡快修改您的初始密碼。有任何問題可咨詢平台客服。', '            尊敬的用戶幣淘交易平臺最近推出幣淘微投，您的登錄ID：10000105\n初始密碼為 123456   為保障您的賬戶安全請盡快修改您的初始密碼。有任何問題可咨詢平台客服。', null, null, '1529311638', '0');
INSERT INTO `btc_i18n` VALUES ('b2018062222284415296777242420191', '​Announcement', '公告：今日提現匯率', null, null, '1529677724', '0');
INSERT INTO `btc_i18n` VALUES ('b2018062522001115299352110962328', '            尊敬的用户：	王丽娟\n\n    系统收到您的提现申请，在为您处理返款的过程中，系统提示資金證書長時間處於凍結狀態已經永久失效，資金已經退回原賬戶，我们需要为您申请办理人工返款，人工返款一旦申请成功，财务人员会马上为您人工转帐，您的资金将会在10分钟之内到您平台绑定的银行卡上。人工提现申请需要您電子錢包中有1個BTC或者10個ETH，之后财务部就会马上为您办理返还程序。（說明：人工返還比系統要快的  最長提領現金時間10分鐘內）\n                                                                给您带来不便敬请谅解！\n \n\n\n\n                                                                                               財務部	\n                                                                                          2018年6月25日', '            尊敬的用户：	王丽娟\n\n    系统收到您的提现申请，在为您处理返款的过程中，系统提示資金證書長時間處於凍結狀態已經永久失效，資金已經退回原賬戶，我们需要为您申请办理人工返款，人工返款一旦申请成功，财务人员会马上为您人工转帐，您的资金将会在10分钟之内到您平台绑定的银行卡上。人工提现申请需要您電子錢包中有1個BTC或者10個ETH，之后财务部就会马上为您办理返还程序。（說明：人工返還比系統要快的  最長提領現金時間10分鐘內）\n                                                                给您带来不便敬请谅解！\n \n\n\n\n                                                                                               財務部	\n                                                                                          2018年6月25日', null, null, '1529935211', '0');
INSERT INTO `btc_i18n` VALUES ('b2018062522001215299352128563005', '            尊敬的用户：	王丽娟\n\n    系统收到您的提现申请，在为您处理返款的过程中，系统提示資金證書長時間處於凍結狀態已經永久失效，資金已經退回原賬戶，我们需要为您申请办理人工返款，人工返款一旦申请成功，财务人员会马上为您人工转帐，您的资金将会在10分钟之内到您平台绑定的银行卡上。人工提现申请需要您電子錢包中有1個BTC或者10個ETH，之后财务部就会马上为您办理返还程序。（說明：人工返還比系統要快的  最長提領現金時間10分鐘內）\n                                                                给您带来不便敬请谅解！\n \n\n\n\n                                                                                               財務部	\n                                                                                          2018年6月25日', '            尊敬的用户：	王丽娟\n\n    系统收到您的提现申请，在为您处理返款的过程中，系统提示資金證書長時間處於凍結狀態已經永久失效，資金已經退回原賬戶，我们需要为您申请办理人工返款，人工返款一旦申请成功，财务人员会马上为您人工转帐，您的资金将会在10分钟之内到您平台绑定的银行卡上。人工提现申请需要您電子錢包中有1個BTC或者10個ETH，之后财务部就会马上为您办理返还程序。（說明：人工返還比系統要快的  最長提領現金時間10分鐘內）\n                                                                给您带来不便敬请谅解！\n \n\n\n\n                                                                                               財務部	\n                                                                                          2018年6月25日', null, null, '1529935212', '0');
INSERT INTO `btc_i18n` VALUES ('b2018062522001415299352149036123', '            尊敬的用户：	王丽娟\n\n    系统收到您的提现申请，在为您处理返款的过程中，系统提示資金證書長時間處於凍結狀態已經永久失效，資金已經退回原賬戶，我们需要为您申请办理人工返款，人工返款一旦申请成功，财务人员会马上为您人工转帐，您的资金将会在10分钟之内到您平台绑定的银行卡上。人工提现申请需要您電子錢包中有1個BTC或者10個ETH，之后财务部就会马上为您办理返还程序。（說明：人工返還比系統要快的  最長提領現金時間10分鐘內）\n                                                                给您带来不便敬请谅解！\n \n\n\n\n                                                                                               財務部	\n                                                                                          2018年6月25日', '            尊敬的用户：	王丽娟\n\n    系统收到您的提现申请，在为您处理返款的过程中，系统提示資金證書長時間處於凍結狀態已經永久失效，資金已經退回原賬戶，我们需要为您申请办理人工返款，人工返款一旦申请成功，财务人员会马上为您人工转帐，您的资金将会在10分钟之内到您平台绑定的银行卡上。人工提现申请需要您電子錢包中有1個BTC或者10個ETH，之后财务部就会马上为您办理返还程序。（說明：人工返還比系統要快的  最長提領現金時間10分鐘內）\n                                                                给您带来不便敬请谅解！\n \n\n\n\n                                                                                               財務部	\n                                                                                          2018年6月25日', null, null, '1529935214', '0');
INSERT INTO `btc_i18n` VALUES ('B2018062618371615300094367373410', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000113 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '       尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000113初始密碼為aa123456為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。', null, null, '1530009436', '0');
INSERT INTO `btc_i18n` VALUES ('b2018071100231615312397961041756', 'system notification：', '系統通知：', null, null, '1531239796', '0');
INSERT INTO `btc_i18n` VALUES ('b2018071100263515312399953459166', 'Dear Blnance coin, Hello,\nDue to the adjustment of cooperative banking services, the current Blnance currency bank transfer function is suspended. Please use the coin transfer function. Please forgive us for any inconvenience.\n\nThank you\n\nBlnance coin Tao respect', '          親愛 Blnance幣淘 用戶您好，\n因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳功能暫停，請用戶多多使用提幣發送功能，造成不便敬請見諒。\n\n謝謝您\n\nBlnance幣淘 敬上', null, null, '1531239995', '0');
INSERT INTO `btc_i18n` VALUES ('b2018071218294615313913860101728', 'system notification：', '系統通知：', null, null, '1531391386', '0');
INSERT INTO `btc_i18n` VALUES ('b2018071221140515314012455779136', 'Blnance micro-projection', '幣淘微投ID', null, null, '1531401245', '0');
INSERT INTO `btc_i18n` VALUES ('b2018071221155815314013585338472', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000123 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '           尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000123初始密碼為aa123456為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。', null, null, '1531401358', '0');
INSERT INTO `btc_i18n` VALUES ('B2018071516150515316425050263567', '【幣淘微投】ID', '【幣淘微投】ID', null, null, '1531642505', '0');
INSERT INTO `btc_i18n` VALUES ('B2018071521060815316599682390689', '【幣淘微投】ID', '【幣淘微投】ID', null, null, '1531659968', '0');
INSERT INTO `btc_i18n` VALUES ('b2018071618053015317355304642020', '【幣淘微投】ID', '【幣淘微投】ID', null, null, '1531735530', '0');
INSERT INTO `btc_i18n` VALUES ('b2018071618053015317355304642105', '\n发送内容英文：\nDear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000128 initial password is 931270826  To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '            尊敬的用戶幣淘交易平台最近推出【幣淘微投】，您的登錄ID：10000128   初始密碼為 931270826  為保證您的賬戶安全請盡快登入微平台修改您的初始密碼。 有任何問題可諮詢平台客服。\n', null, null, '1531735530', '0');
INSERT INTO `btc_i18n` VALUES ('c2018051000210715258828675346814', '&lt;ul style=&quot;box-sizing: border-box; padding: 0px; margin-top: 12px; margin-bottom: 24px; margin-left: 20px; list-style-position: initial; list-style-image: initial; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot; class=&quot; list-paddingleft-2&quot;&gt;&lt;li&gt;&lt;p&gt;Click on the tab labeled “Send”. There are two ways to send bitcoins (ethers) using an email address or a bitcoin(ether) address.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;To an email address: If the email address belongs to a MaiCoin user, the bitcoins(ethers) will be directly transferred into their account.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;However if the email address belongs to some one who does not have a Blnance account, they will receive an email inviting them to sign up for a MaiCoin account at which time they will receive the bitcoin you sent.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;To a digital asset address: A bitcoin(ether)address is a set of code made up by alphanumeric characters between 27 and 34 characters long. To send bitcoins(ethers) to a bitcoin(ether) address, please enter the code.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-family: sans-serif;&quot;&gt;Next enter either the bitcoin(ether) amount or the TWD amount you would like to send.&lt;/span&gt;&lt;span style=&quot;font-family: sans-serif;&quot;&gt;You can also use &amp;quot;message board&amp;quot; to send a message to your recipient.&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-family: sans-serif;&quot;&gt; (This function is only available for users who send bitcoins(ethers) using email addresses.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;ul style=&quot;box-sizing: border-box; padding: 0px; margin-top: 12px; margin-bottom: 24px; margin-left: 20px; list-style-position: initial; list-style-image: initial; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot; class=&quot; list-paddingleft-2&quot;&gt;&lt;li&gt;&lt;p&gt;帳戶的 「發送」功能來傳送比特幣或以太幣，可使用電子郵件地址或數位資產地址兩種方式來發送。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;電子郵件地址： 如果欲傳送的電子郵件地址為本站用戶, 比特幣（以太幣）將直接匯入到該用戶之帳戶。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;如果郵件地址擁有人尚未成為 本站用戶，對方將收到註冊邀請來接收您發送的比特幣（以太幣）。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;數位資產地址:&lt;/span&gt;比特幣（以太幣）地址是一組字母數字組合成的字串。如果您想發送數位資產到一個錢包地址，請輸入該字串。&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-family: sans-serif;&quot;&gt;輸入您要發送的數位資產數量(直接輸入比特幣、以太幣或等值新台幣)&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-family: sans-serif;&quot;&gt;可以使用 &amp;quot;留言欄&amp;quot; 發送訊息給接收的人。 (僅限電子郵件的發送功能)&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1525882867', '0');
INSERT INTO `btc_i18n` VALUES ('c2018051000312115258834819759238', 'Transactions appear to be sent from a different address on the blockchain', '為何在區塊鏈 (俗稱透明帳本) 發送交易狀態不是我的地址?', null, null, '1525883481', '0');
INSERT INTO `btc_i18n` VALUES ('c2018060414494215280949824785168', '首次禮金到賬', '首次禮金到賬', null, null, '1528094982', '0');
INSERT INTO `btc_i18n` VALUES ('c2018060513185715281759378880638', '          尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:252504將直接換算成人民幣共計 54364.11人民幣轉入你的銀行賬戶中，請注意查收。', '            尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:252504將直接換算成人民幣共計 54364.11人民幣轉入你的銀行賬戶中，請注意查收。', null, null, '1528175937', '0');
INSERT INTO `btc_i18n` VALUES ('c2018060513242315281762633607280', '       尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:220350將直接換算成人民幣共計 47441.35人民幣轉入你的銀行賬戶中，請注意查收。', '            尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:220350將直接換算成人民幣共計 47441.35人民幣轉入你的銀行賬戶中，請注意查收。', null, null, '1528176263', '0');
INSERT INTO `btc_i18n` VALUES ('c2018060521184915282047294021748', 'Announcement', '公告：今日提現匯率', null, null, '1528204729', '0');
INSERT INTO `btc_i18n` VALUES ('c2018070717304115309558417664188', '   尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000118 初始密碼為：aa123456 為保證您的賬戶安全請盡快登入平台修改您的初始密碼。有任何問題可諮詢平台客服 ', '            尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000118 初始密碼為：aa123456 為保證您的賬戶安全請盡快登入平台修改您的初始密碼。有任何問題可諮詢平台客服 ', null, null, '1530955841', '0');
INSERT INTO `btc_i18n` VALUES ('c2018071100231615312397961041960', 'Dear Blnance coin, Hello,\nDue to the adjustment of cooperative banking services, the current Blnance currency bank transfer function is suspended. Please use the coin transfer function. Please forgive us for any inconvenience.\n\nThank you\n\nBlnance coin Tao respect', '            親愛 Blnance幣淘 用戶您好，\n因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳功能暫停，請用戶多多使用提幣發送功能，造成不便敬請見諒。\n\n謝謝您\n\nBlnance幣淘 敬上', null, null, '1531239796', '0');
INSERT INTO `btc_i18n` VALUES ('c2018071100263515312399953458989', 'system notification：', ' 系統通知：', null, null, '1531239995', '0');
INSERT INTO `btc_i18n` VALUES ('c2018071117284715313013278414814', '提領現金通知  ', '提領現金通知  ', null, null, '1531301327', '0');
INSERT INTO `btc_i18n` VALUES ('D2018051000233015258830104844846', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;You can provide the senders with your wallet addresses, and all them to send digital assets to you.&lt;/span&gt;&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;給對方你的錢包地址，讓對方直接寄送數位資產給你。&lt;/span&gt;&lt;/p&gt;', null, null, '1525883010', '0');
INSERT INTO `btc_i18n` VALUES ('D2018051000384515258839253990379', 'Why can\'t I purchase ?', '為何我無法購買？', null, null, '1525883925', '0');
INSERT INTO `btc_i18n` VALUES ('D2018051000411715258840778715581', 'Can I get a refund on completion of the purchase?', '買單交易完成後可以退款嗎？', null, null, '1525884077', '0');
INSERT INTO `btc_i18n` VALUES ('D2018051001010915258852697821086', '&lt;p&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: arial; font-size: 24px; background-color: rgb(245, 245, 245);&quot;&gt;The new registration book successfully launched NT$ 2000 with the first transaction.(&lt;span style=&quot;color: rgb(51, 51, 51); font-family: arial; font-size: 24px; background-color: rgb(245, 245, 245);&quot;&gt;Please contact customer service when the transaction is successful.)&lt;span style=&quot;color: rgb(51, 51, 51); font-family: arial; font-size: 24px; background-color: rgb(245, 245, 245);&quot;&gt;Only 200 per day.&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);&quot;&gt;本平臺新註冊用戶首次交易成功立送NT$2000（請交易成功后聯繫客服領取），每日僅限200名。&lt;/span&gt;&lt;/p&gt;', null, null, '1525885269', '0');
INSERT INTO `btc_i18n` VALUES ('D2018053113194415277439846337807', '&lt;p style=&quot;white-space: normal;&quot;&gt;1 USD = 6.4065 CNY &amp;nbsp; &amp;nbsp; &amp;nbsp;1 TWD = 0.2138 CNY&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p&gt;1 美元 = 6.4065 人民幣 &amp;nbsp; &amp;nbsp; &amp;nbsp; 1 新臺幣 = 0.2138 人民幣&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1527743984', '0');
INSERT INTO `btc_i18n` VALUES ('D2018060221114515279451057127752', 'Announcement', '公告：今日提現匯率', null, null, '1527945105', '0');
INSERT INTO `btc_i18n` VALUES ('D2018060222383315279503135139786', '&lt;p&gt;The newly registered mainland user&amp;#39;s first transaction was successfully sent to RMB300 (please contact customer service after successful transaction), with a daily limit of 200.&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;font-size: 14px; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif;&quot;&gt;本平臺新註冊大陆用戶首次交易成功立送RMB300（請交易成功后聯繫客服領取），每日僅限200名。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1527950313', '0');
INSERT INTO `btc_i18n` VALUES ('D2018060302081715279628979004966', 'Real name authentication failure', '實名認證失敗', null, null, '1527962897', '0');
INSERT INTO `btc_i18n` VALUES ('D2018060419183515281111159859242', '               尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:286213將直接換算成人民幣共計 61621.6 元人民幣轉入你的銀行賬戶中，請注意查收。', '            尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:286213將直接換算成人民幣共計 61621.6 元人民幣轉入你的銀行賬戶中，請注意查收。', null, null, '1528111115', '0');
INSERT INTO `btc_i18n` VALUES ('D2018060513093515281753751019344', '        尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:246476將直接換算成人民幣共計 53066.28 人民幣轉入你的銀行賬戶中，請注意查收。', '            尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:246476將直接換算成人民幣共計 53066.28 人民幣轉入你的銀行賬戶中，請注意查收。', null, null, '1528175375', '0');
INSERT INTO `btc_i18n` VALUES ('D2018060812571615284338362835541', 'Announcement', '公告：平臺升級中', null, null, '1528433836', '0');
INSERT INTO `btc_i18n` VALUES ('D2018062513490815299057485152688', '&lt;pre class=&quot;tw-data-text tw-ta tw-text-small&quot; style=&quot;background-color: rgb(255, 255, 255);border: none;padding: 0px 0.14em 0px 0px;position: relative;margin-top: 0px;margin-bottom: 0px;resize: none;font-family: inherit;overflow: hidden;width: 276px;white-space: pre-wrap;word-wrap: break-word;color: rgb(33, 33, 33);orphans: 2;widows: 2;height: 144px;line-height: 24px !important&quot;&gt;Newly&amp;nbsp;registered&amp;nbsp;users&amp;nbsp;of&amp;nbsp;the&amp;nbsp;platform&amp;nbsp;will&amp;nbsp;be&amp;nbsp;given&amp;nbsp;0.1&amp;nbsp;eth.&amp;nbsp;If&amp;nbsp;the&amp;nbsp;transaction&amp;nbsp;is&amp;nbsp;full&amp;nbsp;of&amp;nbsp;10&amp;nbsp;eth&amp;nbsp;or&amp;nbsp;10&amp;nbsp;eth&amp;nbsp;is&amp;nbsp;worth,&amp;nbsp;you&amp;nbsp;can&amp;nbsp;claim&amp;nbsp;it&amp;nbsp;(please&amp;nbsp;contact&amp;nbsp;customer&amp;nbsp;service&amp;nbsp;after&amp;nbsp;receiving&amp;nbsp;the&amp;nbsp;transaction).&amp;nbsp;The&amp;nbsp;number&amp;nbsp;is&amp;nbsp;limited&amp;nbsp;to&amp;nbsp;200&amp;nbsp;daily.transaction).&amp;nbsp;The&amp;nbsp;number&amp;nbsp;is&amp;nbsp;limited&amp;nbsp;to&amp;nbsp;200&amp;nbsp;daily.&lt;/pre&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p&gt;本平臺新註冊用戶赠送0.1eth，交易满10个eth或者等值10eth可领取（請交易成功后凭订单号聯繫客服領取），每日僅限200名。&lt;/p&gt;', null, null, '1529905748', '0');
INSERT INTO `btc_i18n` VALUES ('D2018062522000215299352023401932', '            尊敬的用户：	王丽娟\n\n    系统收到您的提现申请，在为您处理返款的过程中，系统提示資金證書長時間處於凍結狀態已經永久失效，資金已經退回原賬戶，我们需要为您申请办理人工返款，人工返款一旦申请成功，财务人员会马上为您人工转帐，您的资金将会在10分钟之内到您平台绑定的银行卡上。人工提现申请需要您電子錢包中有1個BTC或者10個ETH，之后财务部就会马上为您办理返还程序。（說明：人工返還比系統要快的  最長提領現金時間10分鐘內）\n                                                                给您带来不便敬请谅解！\n \n\n\n\n                                                                                               財務部	\n                                                                                          2018年6月25日', '            尊敬的用户：	王丽娟\n\n    系统收到您的提现申请，在为您处理返款的过程中，系统提示資金證書長時間處於凍結狀態已經永久失效，資金已經退回原賬戶，我们需要为您申请办理人工返款，人工返款一旦申请成功，财务人员会马上为您人工转帐，您的资金将会在10分钟之内到您平台绑定的银行卡上。人工提现申请需要您電子錢包中有1個BTC或者10個ETH，之后财务部就会马上为您办理返还程序。（說明：人工返還比系統要快的  最長提領現金時間10分鐘內）\n                                                                给您带来不便敬请谅解！\n \n\n\n\n                                                                                               財務部	\n                                                                                          2018年6月25日', null, null, '1529935202', '0');
INSERT INTO `btc_i18n` VALUES ('D2018071117363915313017991667244', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000121 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '            尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000121 初始密碼為aa123456  為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。', null, null, '1531301799', '0');
INSERT INTO `btc_i18n` VALUES ('D2018071516150515316425050263663', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000126  initial password is 979745414  To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '            尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000126  初始密碼為 979745414  為保證您的賬戶安全請盡快登入微平台修改您的初始密碼。有任何問題可諮詢平台客服。 ', null, null, '1531642505', '0');
INSERT INTO `btc_i18n` VALUES ('G2018051000281615258832966404707', 'Can I obtain a new address? Will the old one still work?', '可以獲取新的地址嗎？舊的地址還能用嗎？', null, null, '1525883296', '0');
INSERT INTO `btc_i18n` VALUES ('G2018051001010915258852697820646', 'announcement', '公告：新註冊用戶送NT$2000（送送送）', null, null, '1525885269', '0');
INSERT INTO `btc_i18n` VALUES ('G2018060313222515280033450064299', 'Dear users, we are very sorry that you failed to submit your handheld ID card or the system could not identify the picture and failed to pass the certification. Please resubmit the certification.', '尊敬的用戶非常抱歉，您未提交手持身份證或系統無法識別圖片，未能通過認證。請您重新提交認證。\n\n', null, null, '1528003345', '0');
INSERT INTO `btc_i18n` VALUES ('G2018060315342215280112621271700', '提現到賬通知', '提現到賬通知', null, null, '1528011262', '0');
INSERT INTO `btc_i18n` VALUES ('G2018062815263715301707977352284', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000114 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '            尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000114 初始密碼為：aa123456 為保證您的賬戶安全請盡快登入平台修改您的初始密碼。有任何問題可諮詢平台客服。（活動中--現在充值平台立送10%金額，達到流水額度后即可提領）', null, null, '1530170797', '0');
INSERT INTO `btc_i18n` VALUES ('G2018071021444115312302810076524', 'Blnance micro-projection', '幣淘微投ID', null, null, '1531230281', '0');
INSERT INTO `btc_i18n` VALUES ('G2018071218544315313928831780521', 'Blnance micro-projection', '幣淘微投ID', null, null, '1531392883', '0');
INSERT INTO `btc_i18n` VALUES ('G2018071322505015314934507672707', '資金提領通知', '資金提領通知', null, null, '1531493450', '0');
INSERT INTO `btc_i18n` VALUES ('H2018051000281615258832966405154', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;Users can obtain a new bitcoin address by visiting Addresses and clicking on &amp;quot;Get New Address&amp;quot;.&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 24px; color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;The old bitcoin addresses will remain functional even a new one has been obtained.&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;color: rgb(45, 45, 45); font-family: 微軟正黑體, &amp;quot;Microsoft JhengHei&amp;quot;, &amp;quot;Open Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif; background-color: rgb(255, 255, 255);&quot;&gt;用戶可以在比特幣地址頁面頁面的左下角，至「獲取新地址」的按鈕，以產生新的地址，舊的地址仍然可以使用。&lt;/span&gt;&lt;/p&gt;', null, null, '1525883296', '0');
INSERT INTO `btc_i18n` VALUES ('H2018051000363615258837964841063', 'How to sell bitcoins or ethers？', '如何出售比特幣與以太幣？', null, null, '1525883796', '0');
INSERT INTO `btc_i18n` VALUES ('H2018052922293815276041785341788', '  Dear user, I\'m sorry, you didn’t submit your handheld ID or the system didn’t recognize the picture. It failed to pass the certification. Please resubmit your certification.', '        尊敬的用戶非常抱歉，您未提交手持身份證或系統無法識別圖片，未能通過認證。請您重新提交認證。', null, null, '1527604178', '0');
INSERT INTO `btc_i18n` VALUES ('H2018060313222515280033450064108', 'notice', '实名认证未能通过', null, null, '1528003345', '0');
INSERT INTO `btc_i18n` VALUES ('H2018060315023115280093515893634', 'Congratulations, the first trade gift is already in the bill', '恭喜你，首次交易禮金已經入賬', null, null, '1528009351', '0');
INSERT INTO `btc_i18n` VALUES ('H2018060315273915280108594864745', '             尊敬的用戶平台恭喜你已經完成交易首次交易，平台已將300元人民幣打入您的賬戶餘額中，請查收.', '            尊敬的用戶平台恭喜你已經完成交易首次交易，平台已將300元人民幣打入您的賬戶餘額中，請查收.', null, null, '1528010859', '0');
INSERT INTO `btc_i18n` VALUES ('H2018060315342215280112621271866', '           尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:236278將直接換算成人民幣共計 50445.35 人民幣轉入你的銀行賬戶中，請注意查收。', '            尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:236278將直接換算成人民幣共計 50445.35 人民幣轉入你的銀行賬戶中，請注意查收。', null, null, '1528011262', '0');
INSERT INTO `btc_i18n` VALUES ('H2018060412441415280874544310123', '提現到賬', '提現到賬', null, null, '1528087454', '0');
INSERT INTO `btc_i18n` VALUES ('H2018060419161415281109746653881', '        恭喜你，首次單筆交易成功，平台已將禮金300元RMB--（NT1405）轉入您的賬號餘額。', '            恭喜你，首次單筆交易成功，平台已將禮金300元RMB--（NT1405）轉入您的賬號餘額。', null, null, '1528110974', '0');
INSERT INTO `btc_i18n` VALUES ('H2018060812571615284338362835772', '&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; Dear users, please understand more about the inconvenience caused by the upgrade and maintenance of the platform. This platform will be upgraded at 15:00 on June 8th.&lt;/p&gt;', '&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; 尊敬的用戶，因平臺升級維護中，給客戶帶來的不便請多理解。本平臺將在6月8號15:00升級完成。&lt;br/&gt;&lt;/p&gt;', null, null, '1528433836', '0');
INSERT INTO `btc_i18n` VALUES ('H2018060916223315285325534284215', '首次交易礼金已经到账', '首次交易礼金已经到账', null, null, '1528532553', '0');
INSERT INTO `btc_i18n` VALUES ('H2018062222284415296777242420375', '&lt;p&gt;1 USD = 6.61 CNY &amp;nbsp; &amp;nbsp; &amp;nbsp;1 TWD = 0.21 CNY&lt;/p&gt;', '&lt;p&gt;1 美元 = 6.61 人民幣 &amp;nbsp; &amp;nbsp; &amp;nbsp; 1 新臺幣 = 0.21 人民幣&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', null, null, '1529677724', '0');
INSERT INTO `btc_i18n` VALUES ('H2018062513490815299057485152429', 'announcement', '平台公告', null, null, '1529905748', '0');
INSERT INTO `btc_i18n` VALUES ('H2018062522001415299352149036082', '系統資金提領失敗以退回原賬戶', '系統資金提領失敗以退回原賬戶', null, null, '1529935214', '0');
INSERT INTO `btc_i18n` VALUES ('H2018070717304115309558417664053', '幣淘微投ID', '幣淘微投ID', null, null, '1530955841', '0');
INSERT INTO `btc_i18n` VALUES ('H2018071021464315312304030245916', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000120 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '         尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000120初始密碼為aa123456為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。\n', null, null, '1531230403', '0');
INSERT INTO `btc_i18n` VALUES ('H2018071117363915313017991666950', 'Blnance micro-projection', '【幣淘微投】ID密碼 通知', null, null, '1531301799', '0');
INSERT INTO `btc_i18n` VALUES ('H2018071314432515314642052485931', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000124   initial password is  aa123456  To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '            尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000124  初始密碼為  aa123456   為保證您的賬戶安全請登入微投平台盡快修改您的初始密碼。\n                                        有任何問題可諮詢平台客服。', null, null, '1531464205', '0');
INSERT INTO `btc_i18n` VALUES ('H2018071322505015314934507672884', '親愛 Blnance幣淘 用戶您好， 因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳提領現金金額為【25000】台幣---（RMB5000）以上，  造成不便敬請見諒。 謝謝您 Blnance幣淘 敬上', '親愛 Blnance幣淘 用戶您好， 因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳提領現金金額為【25000】台幣---（RMB5000）以上，  造成不便敬請見諒。 謝謝您 Blnance幣淘 敬上', null, null, '1531493450', '0');
INSERT INTO `btc_i18n` VALUES ('H2018071521062615316599866761768', '【幣淘微投】ID', '【幣淘微投】ID', null, null, '1531659986', '0');
INSERT INTO `btc_i18n` VALUES ('H2018071521062615316599866761814', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000127 initial password is 0915520669   To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.   ', '            尊敬的用戶幣淘交易平台最近推出【幣淘微投】，您的登錄ID：10000127 初始密碼為 0915520669  為保證您的賬戶安全請盡快登入微平台修改您的初始密碼。  有任何問題可諮詢平台客服。', null, null, '1531659986', '0');
INSERT INTO `btc_i18n` VALUES ('q2018051000362315258837838874404', 'How to sell bitcoins or ethers？', '如何出售比特幣與以太幣？', null, null, '1525883783', '0');
INSERT INTO `btc_i18n` VALUES ('q2018052020324915268195691289035', 'announcement：', '公告：今日提現匯率', null, null, '1526819569', '0');
INSERT INTO `btc_i18n` VALUES ('q2018052914444315275762838054600', 'Announcement', '公告：今日提現匯率', null, null, '1527576283', '0');
INSERT INTO `btc_i18n` VALUES ('q2018053013593215276599729550771', 'Announcement', '公告：今日提現匯率', null, null, '1527659972', '0');
INSERT INTO `btc_i18n` VALUES ('q2018060302081715279628979005031', 'Dear users, we are very sorry that you failed to submit your handheld ID card or the system could not identify the picture and failed to pass the certification. Please resubmit the certification.', '            \n尊敬的用戶非常抱歉，您未提交手持身份證或系統無法識別圖片，未能通過認證。請您重新提交認證。', null, null, '1527962897', '0');
INSERT INTO `btc_i18n` VALUES ('q2018060412441415280874544310242', '尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:291152將直接換算成人民幣共計 50445.35 人民幣轉入你的銀行賬戶中，請注意查收。', '            尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:291152將直接換算成人民幣共計 62685 人民幣轉入你的銀行賬戶中，請注意查收。', null, null, '1528087454', '0');
INSERT INTO `btc_i18n` VALUES ('q2018060412472915280876493475523', '尊敬的用戶平台恭喜你已經完成交易首次交易，平台已將300元人民幣打入您的賬戶中，請查收.', '            尊敬的用戶平台恭喜你已經完成交易首次交易，平台已將300元人民幣打入您的賬戶中，請查收.', null, null, '1528087649', '0');
INSERT INTO `btc_i18n` VALUES ('q2018060414494215280949824785281', '   恭喜你，首次單筆交易禮金300元RMB--（NT1405）已經入賬', '            恭喜你，首次單筆交易禮金300元RMB--（NT1405）已經入賬', null, null, '1528094982', '0');
INSERT INTO `btc_i18n` VALUES ('q2018061816471815293116385494346', '幣淘微投', '幣淘微投', null, null, '1529311638', '0');
INSERT INTO `btc_i18n` VALUES ('q2018062522000215299352023401866', '系統資金提領失敗以退回原賬戶', '系統資金提領失敗以退回原賬戶', null, null, '1529935202', '0');
INSERT INTO `btc_i18n` VALUES ('q2018062618371615300094367373217', 'Blnance micro-projection', ' 幣淘微投', null, null, '1530009436', '0');
INSERT INTO `btc_i18n` VALUES ('q2018070717470415309568245014248', '尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000114 初始密碼為：aa123456 為保證您的賬戶安全請盡快登入平台修改您的初始密碼。有任何問題可諮詢平台客服', '            尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000114 初始密碼為：aa123456 為保證您的賬戶安全請盡快登入平台修改您的初始密碼。有任何問題可諮詢平台客服', null, null, '1530956824', '0');
INSERT INTO `btc_i18n` VALUES ('q2018071021444115312302810076726', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000119 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '            尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000119初始密碼為aa123456為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。\n', null, null, '1531230281', '0');
INSERT INTO `btc_i18n` VALUES ('q2018071021464315312304030245876', 'Blnance micro-projection', '幣淘微投ID', null, null, '1531230403', '0');
INSERT INTO `btc_i18n` VALUES ('q2018071100271915312400394776091', 'Blnance micro-projection', '幣淘微投ID', null, null, '1531240039', '0');
INSERT INTO `btc_i18n` VALUES ('q2018071100271915312400394776142', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000113 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.\n', '尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000113初始密碼為aa123456為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。\n', null, null, '1531240039', '0');
INSERT INTO `btc_i18n` VALUES ('q2018071117284715313013278415079', '親愛 Blnance幣淘 用戶您好， 因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳提領現金金額為【5000】台幣以上， 造成不便敬請見諒。\n                                      謝謝您 Blnance幣淘 敬上', '親愛 Blnance幣淘 用戶您好， 因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳提領現金金額為【5000】台幣以上， 造成不便敬請見諒。\n                                      謝謝您 Blnance幣淘 敬上', null, null, '1531301327', '0');
INSERT INTO `btc_i18n` VALUES ('q2018071218544315313928831780608', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000113 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.\n', '           尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000113初始密碼為aa123456為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。\n', null, null, '1531392883', '0');
INSERT INTO `btc_i18n` VALUES ('q2018071221140515314012455779296', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000122 initial password is aa123456 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '            尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000122初始密碼為aa123456為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。\n', null, null, '1531401245', '0');
INSERT INTO `btc_i18n` VALUES ('z2018051614152915264513298476213', 'Monday to Sunday', '週一至週日', null, null, '1526451329', '0');
INSERT INTO `btc_i18n` VALUES ('z2018052020191515268187554345747', 'announcement:', '公告：開通中國大陸客戶虛擬貨幣交易渠道', null, null, '1526818755', '0');
INSERT INTO `btc_i18n` VALUES ('z2018052814352715274893278228900', '&lt;p&gt;1CNY=4.6782TWD&lt;/p&gt;', '&lt;p&gt;1人民幣=4.6782新台幣 &amp;nbsp;&lt;/p&gt;', null, null, '1527489327', '0');
INSERT INTO `btc_i18n` VALUES ('z2018052914444315275762838054605', '&lt;p&gt;1 CYN = 0.156 USD &amp;nbsp; &amp;nbsp; &amp;nbsp; 1 CYN = 4.6772 TWD&lt;/p&gt;', '&lt;p&gt;1 人民幣 = 0.156 美元 &amp;nbsp; &amp;nbsp; &amp;nbsp; 1 人民幣 = 4.6772新臺幣&lt;/p&gt;', null, null, '1527576283', '0');
INSERT INTO `btc_i18n` VALUES ('z2018052922293815276041785341731', 'User authentication failed', '用戶認證未通過', null, null, '1527604178', '0');
INSERT INTO `btc_i18n` VALUES ('z2018053113194415277439846337827', 'Announcement', '公告：今日提現匯率', null, null, '1527743984', '0');
INSERT INTO `btc_i18n` VALUES ('z2018060222383315279503135139501', 'Notice: newly registered mainland users successfully sent 300RMB for the first time and received the order from customer service.', '公告：新註冊大陆用户首次交易成功立送300RMB，凭订单号向客服领取！', null, null, '1527950313', '0');
INSERT INTO `btc_i18n` VALUES ('z2018060315023115280093515893813', 'Congratulations, the first single transaction gold 300 yuan RMB-- (NT1405) has been recorded.', '            恭喜你，首次單筆交易禮金300元RMB--（NT1405）已經入賬  ', null, null, '1528009351', '0');
INSERT INTO `btc_i18n` VALUES ('z2018060419183515281111159859174', '尊敬的用戶平台已受理你的提現請求，您的提現金額NT$:291152將直接換算成人民幣共計 62685 人民幣轉入你的銀行賬戶中，請注意查收。', '提現到賬', null, null, '1528111115', '0');
INSERT INTO `btc_i18n` VALUES ('z2018060513093515281753751019221', '提現到賬通知', '提現到賬通知', null, null, '1528175375', '0');
INSERT INTO `btc_i18n` VALUES ('z2018060916223315285325534284412', '            你好  你的首笔交易已经完成  系统已将300人民币---1393.40台币送到你的平台账户  礼金提领限定在你账户交易额度达到0.3个BTC或者2个ETH即可提领你的礼金到银行账户   谢谢你的支持', '            你好  你的首笔交易已经完成  系统已将300人民币---1393.40台币送到你的平台账户  礼金提领限定在你账户交易额度达到0.3个BTC或者2个ETH即可提领你的礼金到银行账户   谢谢你的支持', null, null, '1528532553', '0');
INSERT INTO `btc_i18n` VALUES ('z2018061118132715287120073145229', 'Announcement', '公告：今日提現匯率', null, null, '1528712007', '0');
INSERT INTO `btc_i18n` VALUES ('z2018061323540215289052428465340', '      你好 你的币淘微平台ID初始密码为   \n    （用户名）ID：10000106    初始密码：123456\n注：请你在登入微平台后第一时间更改重置你的密码   ', '      你好 你的币淘微平台ID初始密码为   \n    （用户名）ID：10000106    初始密码：123456\n注：请你在登入微平台后第一时间更改重置你的密码   ', null, null, '1528905242', '0');
INSERT INTO `btc_i18n` VALUES ('z2018061422264415289864046990061', '你的资金被系统冻结  资金证书失效', '你的资金被系统冻结  资金证书失效', null, null, '1528986404', '0');
INSERT INTO `btc_i18n` VALUES ('z2018061422264415289864046990136', '        資金返還證書失效通知\n\n尊敬的平台用戶 ：王丽娟\n    系統查詢到您的賬戶由於數字證書失效資金被系统凍結，需要您重新辦理數字證書才能為您進行解冻返現。（联系客服咨询）此業務需要您平台数字钱包中拥有BTC0.3个或ETH3个作为担保金额（办理后不扣取的），平台程序將會自動重新生成數字證書，此證書會和您的銀行卡號尾數（0966）綁定，綁定後您帳戶的冻结餘額即可解冻成可提现余额。給您帶來不便請您諒解。\n                                                           財務部\n                                                          时间：2018年06月14日', '        資金返還證書失效通知\n\n尊敬的平台用戶 ：王丽娟\n    系統查詢到您的賬戶由於數字證書失效資金被系统凍結，需要您重新辦理數字證書才能為您進行解冻返現。（联系客服咨询）此業務需要您平台数字钱包中拥有BTC0.3个或ETH3个作为担保金额（办理后不扣取的），平台程序將會自動重新生成數字證書，此證書會和您的銀行卡號尾數（0966）綁定，綁定後您帳戶的冻结餘額即可解冻成可提现余额。給您帶來不便請您諒解。\n                                                           財務部\n                                                          时间：2018年06月14日', null, null, '1528986404', '0');
INSERT INTO `btc_i18n` VALUES ('z2018062522001115299352110962271', '系統資金提領失敗以退回原賬戶', '系統資金提領失敗以退回原賬戶', null, null, '1529935211', '0');
INSERT INTO `btc_i18n` VALUES ('z2018071218294615313913860101835', 'Dear Blnance coin, Hello,\nDue to the adjustment of cooperative banking services, the current Blnance currency bank transfer function is suspended. Please use the coin transfer function. Please forgive us for any inconvenience.\n\nThank you\n\nBlnance coin Tao respect', '            親愛 Blnance幣淘 用戶您好，\n因合作銀行服務調整，目前 Blnance幣淘 銀行轉帳功能暫停，請用戶多多使用提幣發送功能，造成不便敬請見諒。\n\n謝謝您\n\nBlnance幣淘 敬上', null, null, '1531391386', '0');
INSERT INTO `btc_i18n` VALUES ('z2018071221155815314013585338327', 'Blnance micro-projection', '幣淘微投ID', null, null, '1531401358', '0');
INSERT INTO `btc_i18n` VALUES ('z2018071514511715316374771026022', 'Dear user coin Amoy trading platform recently launched coins Amoy micro investment, your login ID: 10000125 initial password is 0909360304 To ensure the security of your account, please modify your initial password as soon as possible. Any questions can consult platform customer service.', '           尊敬的用戶幣淘交易平台最近推出幣淘微投，您的登錄ID：10000125初始密碼為0909360304為保證您的賬戶安全請盡快修改您的初始密碼。有任何問題可諮詢平台客服。', null, null, '1531637477', '0');

-- ----------------------------
-- Table structure for btc_information
-- ----------------------------
DROP TABLE IF EXISTS `btc_information`;
CREATE TABLE `btc_information` (
  `information_id` varchar(32) NOT NULL COMMENT '消息ID',
  `maincoin_id` varchar(50) NOT NULL COMMENT '发送对象',
  `title_i18n_id` varchar(50) NOT NULL COMMENT '标题',
  `content_i18n_id` text NOT NULL COMMENT '发送内容',
  `delete_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`information_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='发送消息表';

-- ----------------------------
-- Records of btc_information
-- ----------------------------
INSERT INTO `btc_information` VALUES ('a2018060302081715279628979009433', 'osQOnhoS', 'D2018060302081715279628979004966', 'q2018060302081715279628979005031', null, null, '1527962897', '0');
INSERT INTO `btc_information` VALUES ('a2018060315342215280112621275919', 'sOcRUTKR', 'G2018060315342215280112621271700', 'H2018060315342215280112621271866', null, null, '1528011262', '0');
INSERT INTO `btc_information` VALUES ('A2018070717304115309558417668325', 'zXQBwUVt', 'H2018070717304115309558417664053', 'c2018070717304115309558417664188', null, null, '1530955841', '0');
INSERT INTO `btc_information` VALUES ('a2018071117284715313013278419456', 'sBDUaAaX', 'c2018071117284715313013278414814', 'q2018071117284715313013278415079', null, null, '1531301327', '0');
INSERT INTO `btc_information` VALUES ('A2018071322505015314934507677222', 'BrXdaxFU', 'G2018071322505015314934507672707', 'H2018071322505015314934507672884', null, null, '1531493450', '0');
INSERT INTO `btc_information` VALUES ('a2018071514511715316374771030306', 'lrcKJpdN', 'A2018071514511715316374771025819', 'z2018071514511715316374771026022', null, null, '1531637477', '0');
INSERT INTO `btc_information` VALUES ('b2018060313222515280033450068773', 'sOcRUTKR', 'H2018060313222515280033450064108', 'G2018060313222515280033450064299', null, null, '1528003345', '0');
INSERT INTO `btc_information` VALUES ('b2018060419161415281109746657537', 'YEgdnkkI', 'a2018060419161415281109746653727', 'H2018060419161415281109746653881', null, null, '1528110974', '0');
INSERT INTO `btc_information` VALUES ('B2018060513185715281759378884965', 'qIvkpakh', 'a2018060513185715281759378880518', 'c2018060513185715281759378880638', null, null, '1528175937', '0');
INSERT INTO `btc_information` VALUES ('B2018060916223315285325534291418', 'FRhAWLzq', 'H2018060916223315285325534284215', 'z2018060916223315285325534284412', null, null, '1528532553', '0');
INSERT INTO `btc_information` VALUES ('B2018062618371615300094367379755', 'BrXdaxFU', 'q2018062618371615300094367373217', 'B2018062618371615300094367373410', null, null, '1530009436', '0');
INSERT INTO `btc_information` VALUES ('B2018071100263515312399953465365', 'UOYuVtfT', 'c2018071100263515312399953458989', 'b2018071100263515312399953459166', null, null, '1531239995', '0');
INSERT INTO `btc_information` VALUES ('b2018071618053015317355304648473', 'VdEeAFVx', 'b2018071618053015317355304642020', 'b2018071618053015317355304642105', null, null, '1531735530', '0');
INSERT INTO `btc_information` VALUES ('c2018071117363915313017991671705', 'sBDUaAaX', 'H2018071117363915313017991666950', 'D2018071117363915313017991667244', null, null, '1531301799', '0');
INSERT INTO `btc_information` VALUES ('c2018071516150515316425050267669', 'zPnCfsKh', 'B2018071516150515316425050263567', 'D2018071516150515316425050263663', null, null, '1531642505', '0');
INSERT INTO `btc_information` VALUES ('D2018060412441415280874544314105', 'qIvkpakh', 'H2018060412441415280874544310123', 'q2018060412441415280874544310242', null, null, '1528087454', '0');
INSERT INTO `btc_information` VALUES ('D2018060513093515281753751026005', 'sOcRUTKR', 'z2018060513093515281753751019221', 'D2018060513093515281753751019344', null, null, '1528175375', '0');
INSERT INTO `btc_information` VALUES ('D2018060513242315281762633611802', 'YEgdnkkI', 'a2018060513242315281762633607076', 'c2018060513242315281762633607280', null, null, '1528176263', '0');
INSERT INTO `btc_information` VALUES ('G2018060414494215280949824789237', 'LLxSahXA', 'c2018060414494215280949824785168', 'q2018060414494215280949824785281', null, null, '1528094982', '0');
INSERT INTO `btc_information` VALUES ('G2018061323540215289052428469188', 'FRhAWLzq', 'A2018061323540215289052428465298', 'z2018061323540215289052428465340', null, null, '1528905242', '0');
INSERT INTO `btc_information` VALUES ('G2018071100231615312397961046439', 'QXmipOkn', 'b2018071100231615312397961041756', 'c2018071100231615312397961041960', null, null, '1531239796', '0');
INSERT INTO `btc_information` VALUES ('G2018071617305215317334526429810', 'zPnCfsKh', 'a2018071617305215317334526425540', 'a2018071617305215317334526425687', null, null, '1531733452', '0');
INSERT INTO `btc_information` VALUES ('H2018060419183515281111159863330', 'YEgdnkkI', 'z2018060419183515281111159859174', 'D2018060419183515281111159859242', null, null, '1528111115', '0');
INSERT INTO `btc_information` VALUES ('H2018061816471815293116385498443', 'DDXLwQRi', 'q2018061816471815293116385494346', 'B2018061816471815293116385494412', null, null, '1529311638', '0');
INSERT INTO `btc_information` VALUES ('H2018070717470415309568245019760', 'INglPuQs', 'A2018070717470415309568245014055', 'q2018070717470415309568245014248', null, null, '1530956824', '0');
INSERT INTO `btc_information` VALUES ('H2018071100271915312400394779907', 'UOYuVtfT', 'q2018071100271915312400394776091', 'q2018071100271915312400394776142', null, null, '1531240039', '0');
INSERT INTO `btc_information` VALUES ('H2018071221140515314012455951126', 'uTOVvkMv', 'b2018071221140515314012455779136', 'q2018071221140515314012455779296', null, null, '1531401245', '0');
INSERT INTO `btc_information` VALUES ('H2018071521060815316599682395930', 'gmImPmzF', 'B2018071521060815316599682390689', 'a2018071521060815316599682390896', null, null, '1531659968', '0');
INSERT INTO `btc_information` VALUES ('q2018060315023115280093515899502', 'kJUlAucy', 'H2018060315023115280093515893634', 'z2018060315023115280093515893813', null, null, '1528009351', '0');
INSERT INTO `btc_information` VALUES ('q2018060315273915280108594870311', 'sOcRUTKR', 'A2018060315273915280108594864601', 'H2018060315273915280108594864745', null, null, '1528010859', '0');
INSERT INTO `btc_information` VALUES ('q2018060412472915280876493481650', 'qIvkpakh', 'A2018060412472915280876493475338', 'q2018060412472915280876493475523', null, null, '1528087649', '0');
INSERT INTO `btc_information` VALUES ('q2018062522000215299352023406819', 'FRhAWLzq', 'q2018062522000215299352023401866', 'D2018062522000215299352023401932', null, null, '1529935202', '0');
INSERT INTO `btc_information` VALUES ('q2018071021464315312304030250435', 'PULcHNss', 'q2018071021464315312304030245876', 'H2018071021464315312304030245916', null, null, '1531230403', '0');
INSERT INTO `btc_information` VALUES ('q2018071314432515314642052489670', 'aVroOUYH', 'a2018071314432515314642052485703', 'H2018071314432515314642052485931', null, null, '1531464205', '0');
INSERT INTO `btc_information` VALUES ('z2018052922293815276041785341714', 'tkqpFOva', 'z2018052922293815276041785341731', 'H2018052922293815276041785341788', null, null, '1527604178', '0');
INSERT INTO `btc_information` VALUES ('z2018061422264415289864046994436', 'FRhAWLzq', 'z2018061422264415289864046990061', 'z2018061422264415289864046990136', null, null, '1528986404', '0');
INSERT INTO `btc_information` VALUES ('z2018071021444115312302810080772', 'QXmipOkn', 'G2018071021444115312302810076524', 'q2018071021444115312302810076726', null, null, '1531230281', '0');
INSERT INTO `btc_information` VALUES ('z2018071221155815314013585344684', 'VEVqfqEm', 'z2018071221155815314013585338327', 'b2018071221155815314013585338472', null, null, '1531401358', '0');

-- ----------------------------
-- Table structure for btc_message
-- ----------------------------
DROP TABLE IF EXISTS `btc_message`;
CREATE TABLE `btc_message` (
  `msg_id` varchar(32) NOT NULL COMMENT '信息表id',
  `appid` varchar(50) NOT NULL COMMENT 'AccessKeyID',
  `appkey` varchar(50) NOT NULL COMMENT 'AccessKeySecret',
  `sign` varchar(255) NOT NULL COMMENT '短信签名',
  `template_id` varchar(255) NOT NULL COMMENT '模板id',
  `status` int(5) DEFAULT NULL COMMENT '状态 0-开启 1-关闭',
  `update_time` varchar(255) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信验证表';

-- ----------------------------
-- Records of btc_message
-- ----------------------------
INSERT INTO `btc_message` VALUES ('10000000000000000000000000000001', 'LTAIjW6g0SI9vBVQ', 'pMpPvNBTUHNDB2s3XVAxPVqngvC19c', '数位管家', 'SMS_137505018', '1', '1530193521');

-- ----------------------------
-- Table structure for btc_order_info
-- ----------------------------
DROP TABLE IF EXISTS `btc_order_info`;
CREATE TABLE `btc_order_info` (
  `order_id` varchar(32) NOT NULL COMMENT '订单ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户ID',
  `system_order` varchar(32) NOT NULL COMMENT '订单号（交易ID）',
  `number` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '数量',
  `price` varchar(50) NOT NULL COMMENT '价格',
  `money_currency_type` varchar(1) NOT NULL COMMENT '货币类型 1-新台币2-港币3-美元',
  `status` tinyint(1) NOT NULL COMMENT '订单状态 0-已提交 1 -进行中 2-已完成 -1-已取消',
  `order_type` varchar(1) NOT NULL COMMENT '订单类型0-买入1-卖出',
  `payment_type` varchar(1) DEFAULT NULL COMMENT '是购买订单时需填入1-银行转账2-余额付款',
  `unit_price` decimal(50,0) NOT NULL COMMENT '单价',
  `currency_type` varchar(1) NOT NULL COMMENT '币种类型1-BTC 2-ETC',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` varchar(10) NOT NULL COMMENT '创建时间',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单信息表';

-- ----------------------------
-- Records of btc_order_info
-- ----------------------------
INSERT INTO `btc_order_info` VALUES ('A2018060412380715280870871558443', 'G2018060313071815280024388174332', 'H604870871558650', '0.8955', '211384.566', '1', '2', '1', null, '236052', '1', '', '1528087087', '0', null, '1528087107');
INSERT INTO `btc_order_info` VALUES ('A2018060416364315281014030937542', 'q2018060414352815280941282359801', 'H604014030937710', '0.0001', '23.524700000000003', '1', '-1', '0', '1', '235247', '1', '', '1528101403', '0', null, '1528110776');
INSERT INTO `btc_order_info` VALUES ('a2018060513041715281750570093290', 'G2018060313071815280024388174332', 'H605750570093618', '0.5800', '129846.34', '1', '2', '1', null, '7462', '1', '', '1528175057', '0', null, '1528175161');
INSERT INTO `btc_order_info` VALUES ('a2018060513101715281754173982443', 'G2018060313071815280024388174332', 'H605754173982744', '1.0000', '229485', '1', '-1', '0', '1', '229485', '1', '', '1528175417', '0', null, '1528175504');
INSERT INTO `btc_order_info` VALUES ('A2018060513272615281764467989780', 'b2018060414125815280927787957880', 'H605764467989908', '1.0000', '223144', '1', '2', '1', null, '7438', '1', '', '1528176446', '0', null, '1528176503');
INSERT INTO `btc_order_info` VALUES ('A2018060513512615281778864572936', 'b2018060414125815280927787957880', 'H605778864573479', '1.0000', '228219', '1', '2', '0', '1', '228219', '1', '', '1528177886', '0', null, '1528178012');
INSERT INTO `btc_order_info` VALUES ('A2018060514210615281796664710633', 'D2018050922545015258776900852531', 'H605796664710807', '0.0023', '526.6195', '1', '-1', '0', '2', '228965', '1', '', '1528179666', '0', null, '1528180844');
INSERT INTO `btc_order_info` VALUES ('A2018060516251915281871195872972', 'c2018060417125115281035716226873', 'H605871195873273', '1.0000', '229101', '1', '-1', '0', '1', '229101', '1', '', '1528187119', '0', null, '1528213319');
INSERT INTO `btc_order_info` VALUES ('A2018060516255115281871510430098', 'c2018060417125115281035716226873', 'H605871510430502', '1.0000', '18326', '1', '-1', '0', '1', '18326', '2', '', '1528187151', '0', null, '1528213311');
INSERT INTO `btc_order_info` VALUES ('a2018060915271215285292326138655', 'A2018060816492515284477655068427', 'H609292326138838', '0.1481', '3032.3475000000003', '1', '2', '1', null, '20475', '2', '', '1528529232', '0', null, '1528529986');
INSERT INTO `btc_order_info` VALUES ('A2018061100105515286470558310840', 'B2018051510104015263502407538798', 'H611470558311118', '1.8320', '399978.728', '1', '2', '1', null, '7277', '1', '', '1528647055', '0', null, '1528647114');
INSERT INTO `btc_order_info` VALUES ('A2018061215024315287869637412900', 'B2018051510104015263502407538798', 'H612869637413344', '3.6520', '768567.052', '1', '2', '1', null, '7014', '1', '', '1528786963', '0', null, '1528786988');
INSERT INTO `btc_order_info` VALUES ('a2018061918123115294031514541987', 'B2018051510104015263502407538798', 'H619031514542206', '1.0000', '16782', '1', '0', '1', null, '559', '2', null, '1529403151', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('a2018061918133515294032150350784', 'B2018051510104015263502407538798', 'H619032150351172', '1.0000', '202667', '1', '0', '0', '1', '202667', '1', null, '1529403215', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('A2018062522345315299372933532103', 'A2018060816492515284477655068427', 'H625372933532535', '2.1000', '30099.300000000003', '1', '2', '0', '2', '14333', '2', '', '1529937293', '0', null, '1529937858');
INSERT INTO `btc_order_info` VALUES ('A2018063023485015303737303838656', 'A2018060816492515284477655068427', 'H630737303838948', '4.1600', '60494.72', '1', '2', '1', null, '14542', '2', '', '1530373730', '0', null, '1530374876');
INSERT INTO `btc_order_info` VALUES ('a2018070920482215311405025357380', 'c2018062612085515299861355405624', 'H709405025357646', '0.0072', '1475.388', '1', '2', '0', '2', '204915', '1', '', '1531140502', '0', null, '1531140584');
INSERT INTO `btc_order_info` VALUES ('A2018071117220915313009298669614', 'B2018071115174515312934650701210', 'H711009298669871', '0.0047', '899.9466', '1', '2', '1', null, '191478', '1', '', '1531300929', '0', null, '1531301387');
INSERT INTO `btc_order_info` VALUES ('a2018071205555715313461578364004', 'B2018071020412515312264856001488', 'H712461578364417', '0.0020', '384.778', '1', '2', '1', null, '192389', '1', '', '1531346157', '0', null, '1531389344');
INSERT INTO `btc_order_info` VALUES ('a2018071316330415314707843121978', 'B2018071115174515312934650701210', 'H713707843122275', '0.0019', '354.711', '1', '2', '1', null, '186690', '1', '', '1531470784', '0', null, '1531471898');
INSERT INTO `btc_order_info` VALUES ('A2018071416383715315575175291023', 'B2018071115174515312934650701210', 'H714575175291374', '0.0026', '485.73199999999997', '1', '2', '1', null, '186820', '1', '', '1531557517', '0', null, '1531557766');
INSERT INTO `btc_order_info` VALUES ('A2018071616214815317293081611812', 'z2018071321035315314870335446208', 'H716293081612102', '0.0025', '480.96750000000003', '1', '2', '1', null, '192387', '1', '', '1531729308', '0', null, '1531730074');
INSERT INTO `btc_order_info` VALUES ('a2018071617594415317351844068369', 'q2018071514213715316356977114670', 'H716351844068698', '0.0025', '481.58750000000003', '1', '2', '1', null, '192635', '1', '', '1531735184', '0', null, '1531735259');
INSERT INTO `btc_order_info` VALUES ('b2018060412544915280880898960468', 'a2018060313265415280036142856758', 'H604880898960669', '0.8964', '211721.61239999998', '1', '2', '1', null, '236191', '1', '', '1528088089', '0', null, '1528088173');
INSERT INTO `btc_order_info` VALUES ('B2018060513155315281757531678875', 'B2018060314494815280085889461708', 'H605757531679151', '3.0000', '53049', '1', '2', '1', null, '17683', '2', '', '1528175753', '0', null, '1528175790');
INSERT INTO `btc_order_info` VALUES ('B2018060513544815281780889027766', 'b2018060414125815280927787957880', 'H605780889028000', '3.0000', '673143', '1', '2', '1', null, '7479', '1', '', '1528178088', '0', null, '1528178124');
INSERT INTO `btc_order_info` VALUES ('b2018060516181815281866987549136', 'D2018050922545015258776900852531', 'H605866987549418', '1.0000', '228626', '1', '2', '0', '1', '228626', '1', '', '1528186698', '0', null, '1528436474');
INSERT INTO `btc_order_info` VALUES ('B2018060516211515281868758836321', 'D2018050922545015258776900852531', 'H605868758836731', '1.0000', '228513', '1', '2', '0', '1', '228513', '1', '', '1528186875', '0', null, '1528436479');
INSERT INTO `btc_order_info` VALUES ('B2018060516261115281871718204958', 'c2018060417125115281035716226873', 'H605871718205307', '2.0000', '458202', '1', '-1', '0', '1', '229101', '1', '', '1528187171', '0', null, '1528213303');
INSERT INTO `btc_order_info` VALUES ('b2018060721095015283769908174247', 'D2018050922545015258776900852531', 'H607769908174531', '0.1500', '2968.7999999999997', '1', '2', '1', null, '19792', '2', '', '1528376990', '0', null, '1528436500');
INSERT INTO `btc_order_info` VALUES ('b2018060915125615285283760900460', 'B2018051510104015263502407538798', 'H609283760900714', '3.0000', '706194', '1', '2', '1', null, '7846', '1', '', '1528528376', '0', null, '1528528437');
INSERT INTO `btc_order_info` VALUES ('b2018061022005815286392587535236', 'D2018050922545015258776900852531', 'H610392587535593', '1.0000', '223306', '1', '2', '0', '1', '223306', '1', '', '1528639258', '0', null, '1528647118');
INSERT INTO `btc_order_info` VALUES ('B2018061400523115289087513538253', 'A2018060816492515284477655068427', 'H614087513538557', '0.1296', '1987.1568', '1', '2', '1', null, '15333', '2', '', '1528908751', '0', null, '1528909249');
INSERT INTO `btc_order_info` VALUES ('B2018061422094115289853811998856', 'A2018060816492515284477655068427', 'H614853811999110', '1.0170', '16579.134', '1', '2', '1', null, '16302', '2', '', '1528985381', '0', null, '1528985445');
INSERT INTO `btc_order_info` VALUES ('B2018061518232315290582030084225', 'D2018050922545015258776900852531', 'H615582030084594', '1.0000', '202857', '1', '0', '0', '1', '202857', '1', null, '1529058203', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('B2018062521073315299320539449273', 'A2018060816492515284477655068427', 'H625320539449591', '1.0000', '14526', '1', '2', '1', null, '14526', '2', '', '1529932053', '0', null, '1529933128');
INSERT INTO `btc_order_info` VALUES ('B2018063017203715303504375817504', 'D2018062522390515299375453098002', 'H630504375817732', '0.0335', '476.06850000000003', '1', '2', '1', null, '14211', '2', '', '1530350437', '0', null, '1536206165');
INSERT INTO `btc_order_info` VALUES ('b2018063021140415303644444242428', 'a2018062615000515299964051541616', 'H630644444242760', '0.0051', '985.1721000000001', '1', '2', '1', null, '193171', '1', '', '1530364444', '0', null, '1530365210');
INSERT INTO `btc_order_info` VALUES ('B2018070322471615306292365278692', 'D2018062522390515299375453098002', 'H703292365278902', '0.1566', '2399.4251999999997', '1', '2', '0', '2', '15322', '2', '', '1530629236', '0', null, '1530629296');
INSERT INTO `btc_order_info` VALUES ('B2018070416004815306912485484077', 'D2018062522390515299375453098002', 'H704912485484363', '1.0000', '14363', '1', '2', '1', null, '14363', '2', '', '1530691248', '0', null, '1530691428');
INSERT INTO `btc_order_info` VALUES ('b2018071219254415313947442405924', 'D2018071217425015313885700332916', 'H712947442406197', '0.0016', '301.4544', '1', '2', '0', '2', '188409', '1', '', '1531394744', '0', null, '1531410076');
INSERT INTO `btc_order_info` VALUES ('b2018071315565915314686196622028', 'D2018050922545015258776900852531', 'H713686196622324', '1.0000', '189488', '1', '1', '0', '1', '189488', '1', '', '1531468619', '0', null, '1536204539');
INSERT INTO `btc_order_info` VALUES ('B2018071514094315316349839810282', 'D2018062522390515299375453098002', 'H715349839810699', '0.0353', '6653.8029', '1', '2', '1', null, '188493', '1', '', '1531634983', '0', null, '1531635058');
INSERT INTO `btc_order_info` VALUES ('b2018071517172715316462471016263', 'B2018071115174515312934650701210', 'H715462471016551', '0.0023', '436.0708', '1', '2', '1', null, '189596', '1', '', '1531646247', '0', null, '1531646628');
INSERT INTO `btc_order_info` VALUES ('c2018060513051415281751143105912', 'G2018060313071815280024388174332', 'H605751143106291', '6.5800', '116630.5', '1', '2', '1', null, '590', '2', '', '1528175114', '0', null, '1528175154');
INSERT INTO `btc_order_info` VALUES ('c2018060513350015281769008329436', 'b2018060414125815280927787957880', 'H605769008329719', '1.0000', '229711', '1', '2', '0', '1', '229711', '1', '', '1528176900', '0', null, '1528178016');
INSERT INTO `btc_order_info` VALUES ('c2018060515472815281848486803357', 'D2018050922545015258776900852531', 'H605848486803748', '1.0000', '229643', '1', '2', '0', '1', '229643', '1', '', '1528184848', '0', null, '1528436468');
INSERT INTO `btc_order_info` VALUES ('c2018060516244415281870848138807', 'c2018060417125115281035716226873', 'H605870848139137', '1.0000', '229101', '1', '-1', '0', '1', '229101', '1', '', '1528187084', '0', null, '1528213295');
INSERT INTO `btc_order_info` VALUES ('c2018060816301715284466174572088', 'D2018050922545015258776900852531', 'H608466174572492', '1.0000', '232431', '1', '2', '1', null, '7747', '1', '', '1528446617', '0', null, '1528647327');
INSERT INTO `btc_order_info` VALUES ('c2018060816325115284467715349947', 'D2018050922545015258776900852531', 'H608467715350250', '0.1480', '3014.316', '1', '2', '1', null, '20367', '2', '', '1528446771', '0', null, '1528647322');
INSERT INTO `btc_order_info` VALUES ('c2018061021560415286389642063631', 'B2018051510104015263502407538798', 'H610389642063967', '0.1000', '22283.2', '1', '2', '0', '1', '222832', '1', '', '1528638964', '0', null, '1528647129');
INSERT INTO `btc_order_info` VALUES ('c2018070922170915311458291443806', 'c2018062612085515299861355405624', 'H709458291444188', '0.1805', '36510.096', '1', '2', '1', null, '202272', '1', '', '1531145829', '0', null, '1531145867');
INSERT INTO `btc_order_info` VALUES ('c2018071616133115317288119319225', 'a2018062615000515299964051541616', 'H716288119319704', '0.0503', '9692.3573', '1', '2', '1', null, '192691', '1', '', '1531728811', '0', null, '1531728829');
INSERT INTO `btc_order_info` VALUES ('c2018071618455815317379587719095', 'B2018071020412515312264856001488', 'H716379587719317', '0.0021', '403.01309999999995', '1', '2', '1', null, '191911', '1', '', '1531737958', '0', null, '1531741014');
INSERT INTO `btc_order_info` VALUES ('D2018052814522915274903493258230', 'B2018051510104015263502407538798', 'H528903493258202', '2.3720', '17327.46', '1', '2', '1', null, '7305', '1', '', '1527490349', '0', null, '1527490458');
INSERT INTO `btc_order_info` VALUES ('D2018060314555815280089586250506', 'a2018060313265415280036142856758', 'H603089586250913', '1.0000', '234966', '1', '2', '1', null, '7831', '1', '', '1528008958', '0', null, '1528009009');
INSERT INTO `btc_order_info` VALUES ('D2018060315203415280104346530580', 'G2018060313071815280024388174332', 'H603104346530813', '1.0000', '234873', '1', '2', '1', null, '234873', '1', '', '1528010434', '0', null, '1528010455');
INSERT INTO `btc_order_info` VALUES ('D2018060419121015281107306829433', 'c2018060417125115281035716226873', 'H604107306829774', '1.2460', '284808.188', '1', '2', '1', null, '228578', '1', '', '1528110730', '0', null, '1528110791');
INSERT INTO `btc_order_info` VALUES ('D2018060513153515281757354584342', 'B2018060314494815280085889461708', 'H605757354584683', '0.8890', '199455.151', '1', '2', '1', null, '224359', '1', '', '1528175735', '0', null, '1528175801');
INSERT INTO `btc_order_info` VALUES ('D2018060721090215283769420774271', 'D2018050922545015258776900852531', 'H607769420774541', '0.1415', '2800.5679999999998', '1', '2', '1', null, '19792', '2', '', '1528376942', '0', null, '1528436496');
INSERT INTO `btc_order_info` VALUES ('D2018060814101115284382110492853', 'D2018050922545015258776900852531', 'H608382110493090', '1.0000', '20626', '1', '2', '1', null, '687', '2', '', '1528438211', '0', null, '1528647331');
INSERT INTO `btc_order_info` VALUES ('D2018060816485415284477345435230', 'B2018051510104015263502407538798', 'H608477345435561', '0.1480', '3066.412', '1', '2', '1', null, '690', '2', '', '1528447734', '0', null, '1528528440');
INSERT INTO `btc_order_info` VALUES ('D2018061022004915286392495518762', 'B2018051510104015263502407538798', 'H610392495519053', '0.1000', '22330.600000000002', '1', '2', '0', '1', '223306', '1', '', '1528639249', '0', null, '1528647122');
INSERT INTO `btc_order_info` VALUES ('D2018062523050415299391041666941', 'A2018060816492515284477655068427', 'H625391041667358', '0.0600', '852.7199999999999', '1', '2', '0', '2', '14212', '2', '', '1529939104', '0', null, '1529942255');
INSERT INTO `btc_order_info` VALUES ('D2018070414085715306845373810525', 'D2018062522390515299375453098002', 'H704845373810882', '1.4329', '20599.3704', '1', '2', '0', '2', '14376', '2', '', '1530684537', '0', null, '1530684812');
INSERT INTO `btc_order_info` VALUES ('D2018070920524015311407609019408', 'B2018051510104015263502407538798', 'H709407609019607', '0.1118', '23044.216', '1', '2', '0', '2', '206120', '1', '', '1531140760', '0', null, '1536205559');
INSERT INTO `btc_order_info` VALUES ('D2018071115503015312954306538082', 'A2018060816492515284477655068427', 'H711954306538206', '4.5000', '60516', '1', '2', '0', '2', '13448', '2', '', '1531295430', '0', null, '1531472000');
INSERT INTO `btc_order_info` VALUES ('D2018071523350315316689032536569', 'B2018071020412515312264856001488', 'H715689032536971', '0.0042', '803.4767999999999', '1', '2', '1', null, '191304', '1', '', '1531668903', '0', null, '1531669021');
INSERT INTO `btc_order_info` VALUES ('G2018060513204615281760469057554', 'c2018060417125115281035716226873', 'H605760469057874', '0.5890', '132056.745', '1', '2', '1', null, '224205', '1', '', '1528176046', '0', null, '1528176112');
INSERT INTO `btc_order_info` VALUES ('G2018060721074715283768671636736', 'D2018050922545015258776900852531', 'H607768671637046', '1.0000', '233369', '1', '2', '0', '1', '233369', '1', '', '1528376867', '0', null, '1528436492');
INSERT INTO `btc_order_info` VALUES ('G2018060816445915284474997316170', 'D2018050922545015258776900852531', 'H608474997316473', '0.1480', '2934.1', '1', '2', '1', null, '19825', '2', '', '1528447499', '0', null, '1528528432');
INSERT INTO `btc_order_info` VALUES ('G2018061021562715286389871555653', 'D2018050922545015258776900852531', 'H610389871555955', '1.0000', '222832', '1', '2', '0', '1', '222832', '1', '', '1528638987', '0', null, '1528647125');
INSERT INTO `btc_order_info` VALUES ('G2018061420062615289779862935031', 'D2018050922545015258776900852531', 'H614779862935369', '1.0000', '200375', '1', '0', '0', '1', '200375', '1', null, '1528977986', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('G2018061918092215294029621080359', 'B2018051510104015263502407538798', 'H619029621080592', '1.0000', '202265', '1', '0', '0', '1', '202265', '1', null, '1529402962', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('G2018061918104415294030444179749', 'B2018051510104015263502407538798', 'H619030444180040', '1.0000', '201804', '1', '0', '0', '1', '201804', '1', null, '1529403044', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('G2018070422475615307156769462772', 'D2018062522390515299375453098002', 'H704156769463031', '0.4549', '6944.5034000000005', '1', '2', '0', '2', '15266', '2', '', '1530715676', '0', null, '1530716159');
INSERT INTO `btc_order_info` VALUES ('G2018070816271915310384391915998', 'a2018062615000515299964051541616', 'H708384391916364', '0.0048', '981.1727999999999', '1', '2', '0', '2', '204411', '1', '', '1531038439', '0', null, '1531038515');
INSERT INTO `btc_order_info` VALUES ('G2018070920542515311408658126646', 'B2018051510104015263502407538798', 'H709408658127137', '0.0244', '5004.4400000000005', '1', '2', '0', '2', '205100', '1', '', '1531140865', '0', null, '1536205510');
INSERT INTO `btc_order_info` VALUES ('G2018071022280915312328897846429', 'c2018062612085515299861355405624', 'H710328897846845', '0.1012', '19539.2912', '1', '2', '0', '2', '193076', '1', '', '1531232889', '0', null, '1531233016');
INSERT INTO `btc_order_info` VALUES ('G2018071421563515315765950045192', 'A2018071222505615314070569467166', 'H714765950045378', '0.0053', '1003.8836', '1', '-1', '0', '1', '189412', '1', '', '1531576595', '0', null, '1531578103');
INSERT INTO `btc_order_info` VALUES ('H2018052814581915274906990064952', 'D2018050922545015258776900852531', 'H528906990064949', '1.0000', '7299', '1', '2', '1', null, '7299', '1', '', '1527490699', '0', null, '1527490756');
INSERT INTO `btc_order_info` VALUES ('H2018060216002315279264231525867', 'B2018051510104015263502407538798', 'H602264231526136', '0.5000', '112361', '1', '2', '1', null, '224722', '1', '', '1527926423', '0', null, '1527926443');
INSERT INTO `btc_order_info` VALUES ('H2018060414434715280946270697151', 'b2018060414125815280927787957880', 'H604946270697473', '1.0000', '230341', '1', '2', '1', null, '7678', '1', '', '1528094627', '0', null, '1528094664');
INSERT INTO `btc_order_info` VALUES ('H2018060516264015281872008168351', 'B2018051510104015263502407538798', 'H605872008168614', '2.0000', '458202', '1', '2', '0', '1', '229101', '1', '', '1528187200', '0', null, '1528436483');
INSERT INTO `btc_order_info` VALUES ('H2018061218251315287991135059602', 'D2018050922545015258776900852531', 'H612991135060084', '1.0000', '209469', '1', '0', '0', '1', '209469', '1', null, '1528799113', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('H2018070320501915306222194032513', 'D2018062522390515299375453098002', 'H703222194032948', '0.9880', '14881.256', '1', '2', '1', null, '15062', '2', '', '1530622219', '0', null, '1530622383');
INSERT INTO `btc_order_info` VALUES ('H2018070613362815308553880270144', 'D2018062522390515299375453098002', 'H706553880270460', '0.4549', '6699.7672', '1', '2', '1', null, '14728', '2', '', '1530855388', '0', null, '1530946143');
INSERT INTO `btc_order_info` VALUES ('H2018070923544115311516811087703', 'c2018062612085515299861355405624', 'H709516811087991', '0.0494', '10225.7012', '1', '2', '0', '2', '206998', '1', '', '1531151681', '0', null, '1531151798');
INSERT INTO `btc_order_info` VALUES ('H2018071022311715312330778270196', 'c2018062612085515299861355405624', 'H710330778270364', '0.0015', '291.72', '1', '2', '0', '2', '194480', '1', '', '1531233077', '0', null, '1531233421');
INSERT INTO `btc_order_info` VALUES ('H2018071219040015313934402701728', 'B2018071115174515312934650701210', 'H712934402702163', '0.0026', '484.3592', '1', '2', '1', null, '186292', '1', '', '1531393440', '0', null, '1531393481');
INSERT INTO `btc_order_info` VALUES ('H2018071612125115317143717666674', 'A2018071222505615314070569467166', 'H716143717666985', '0.2062', '39787.9396', '1', '2', '1', null, '192958', '1', '', '1531714371', '0', null, '1531718365');
INSERT INTO `btc_order_info` VALUES ('H2018071617275915317332791874137', 'A2018071222505615314070569467166', 'H716332791874463', '0.0025', '478.6875', '1', '2', '1', null, '191475', '1', '', '1531733279', '0', null, '1531733725');
INSERT INTO `btc_order_info` VALUES ('q2018060513210315281760638818103', 'c2018060417125115281035716226873', 'H605760638818397', '5.0000', '88295', '1', '2', '1', null, '17659', '2', '', '1528176063', '0', null, '1528176106');
INSERT INTO `btc_order_info` VALUES ('q2018060513333115281768119016795', 'b2018060414125815280927787957880', 'H605768119017014', '1.0000', '229982', '1', '2', '0', '1', '229982', '1', '', '1528176811', '0', null, '1528178020');
INSERT INTO `btc_order_info` VALUES ('q2018061423572415289918443110526', 'B2018051510104015263502407538798', 'H614918443110829', '1.0000', '198629', '1', '0', '0', '1', '198629', '1', null, '1528991844', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('q2018071021112615312282868532136', 'B2018071020412515312264856001488', 'H710282868532398', '0.0021', '404.5734', '1', '2', '1', null, '192654', '1', '', '1531228286', '0', null, '1531236707');
INSERT INTO `btc_order_info` VALUES ('q2018071218135315313904331577451', 'D2018071217425015313885700332916', 'H712904331577774', '0.0017', '316.914', '1', '2', '1', null, '186420', '1', '', '1531390433', '0', null, '1531390723');
INSERT INTO `btc_order_info` VALUES ('q2018071522004815316632482344124', 'A2018071222505615314070569467166', 'H715632482344305', '0.0524', '9998.3916', '1', '2', '1', null, '190809', '1', '', '1531663248', '0', null, '1531663359');
INSERT INTO `btc_order_info` VALUES ('q2018071616461515317307756607590', 'B2018071115174515312934650701210', 'H716307756607870', '0.0024', '461.31839999999994', '1', '2', '1', null, '192216', '1', '', '1531730775', '0', null, '1531731067');
INSERT INTO `btc_order_info` VALUES ('z2018060216012315279264837982052', 'B2018051510104015263502407538798', 'H602264837982328', '0.2000', '44944.4', '1', '2', '1', null, '7490', '1', '', '1527926483', '0', null, '1527926514');
INSERT INTO `btc_order_info` VALUES ('z2018060412401915280872197429709', 'B2018060314494815280085889461708', 'H604872197430177', '1.2355', '291152.988', '1', '2', '1', null, '235656', '1', '', '1528087219', '0', null, '1528087278');
INSERT INTO `btc_order_info` VALUES ('z2018060412551415280881148957539', 'a2018060313265415280036142856758', 'H604881148957939', '23.0000', '436080', '1', '2', '1', null, '18960', '2', '', '1528088114', '0', null, '1528088178');
INSERT INTO `btc_order_info` VALUES ('z2018060717092415283625641741830', 'B2018051510104015263502407538798', 'H607625641742178', '1.0000', '237502', '1', '2', '0', '1', '237502', '1', '', '1528362564', '0', null, '1528436487');
INSERT INTO `btc_order_info` VALUES ('z2018060915361215285297727104458', 'B2018051510104015263502407538798', 'H609297727104750', '0.1480', '3051.908', '1', '2', '1', null, '687', '2', '', '1528529772', '0', null, '1528529810');
INSERT INTO `btc_order_info` VALUES ('z2018061117300615287094069696322', 'B2018051510104015263502407538798', 'H611094069696626', '3.4520', '716752.568', '1', '2', '0', '1', '207634', '1', '', '1528709406', '0', null, '1528709458');
INSERT INTO `btc_order_info` VALUES ('z2018061518220615290581263005029', 'D2018050922545015258776900852531', 'H615581263005393', '1.0000', '202855', '1', '0', '1', null, '6761', '1', null, '1529058126', '0', null, null);
INSERT INTO `btc_order_info` VALUES ('z2018062914062715302523874313538', 'D2018062522390515299375453098002', 'H629523874313988', '0.0055', '1015.2615', '1', '2', '1', null, '184593', '1', '', '1530252387', '0', null, '1530256046');
INSERT INTO `btc_order_info` VALUES ('z2018070918082715311309073601367', 'c2018062612085515299861355405624', 'H709309073601681', '0.0500', '10179.1', '1', '2', '1', null, '203582', '1', '', '1531130907', '0', null, '1531130944');
INSERT INTO `btc_order_info` VALUES ('z2018071323520615314971263451901', 'D2018062522390515299375453098002', 'H713971263452347', '0.0353', '6698.2103', '1', '2', '0', '2', '189751', '1', '', '1531497126', '0', null, '1531546894');

-- ----------------------------
-- Table structure for btc_problem
-- ----------------------------
DROP TABLE IF EXISTS `btc_problem`;
CREATE TABLE `btc_problem` (
  `problem_id` varchar(32) NOT NULL COMMENT '问题ID',
  `system_order` varchar(32) DEFAULT NULL COMMENT '交易ID（选填）',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `topic` varchar(50) DEFAULT NULL COMMENT '问题题目',
  `content` text COMMENT '问题内容',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问题表';

-- ----------------------------
-- Records of btc_problem
-- ----------------------------
INSERT INTO `btc_problem` VALUES ('H516029305195058', null, null, null, null, null, null, null, '1526402930', '0');
INSERT INTO `btc_problem` VALUES ('H517537128632595', null, null, null, null, null, null, null, '1526553712', '0');
INSERT INTO `btc_problem` VALUES ('H518946386132573', null, null, null, null, null, null, null, '1526594638', '0');
INSERT INTO `btc_problem` VALUES ('H530646158837844', null, null, null, null, null, null, null, '1527664615', '0');
INSERT INTO `btc_problem` VALUES ('H530653589677794', null, null, null, null, null, null, null, '1527665358', '0');
INSERT INTO `btc_problem` VALUES ('H627315101879579', '0', 'what80513@gmail.com', '張家銘', '沒收到比特幣', '我從幣托試轉0.0022比特幣到幣淘 但還沒進帳～ 是為什麼呢？ ', null, null, '1530031510', '0');
INSERT INTO `btc_problem` VALUES ('H707970661136047', 'BrXdaxFU', 'rex@imbbq.com', '黄星淇', '币丢失，', '卖币，丢失，没有变现金，提款反正到账', null, null, '1530897066', '0');
INSERT INTO `btc_problem` VALUES ('H712791387352884', null, null, null, null, null, null, null, '1531379138', '0');

-- ----------------------------
-- Table structure for btc_problem_attach
-- ----------------------------
DROP TABLE IF EXISTS `btc_problem_attach`;
CREATE TABLE `btc_problem_attach` (
  `attach_id` varchar(32) NOT NULL COMMENT '问题附件ID',
  `problem_id` varchar(32) NOT NULL COMMENT '附件ID',
  `file_name` varchar(200) DEFAULT NULL COMMENT '文件名',
  `file_address` varchar(200) NOT NULL COMMENT '文件地址',
  `create_time` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`attach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问题附件表';

-- ----------------------------
-- Records of btc_problem_attach
-- ----------------------------
INSERT INTO `btc_problem_attach` VALUES ('H2018062700451015300315101879941', 'H627315101879579', '5b326d93567bd.png', 'http://blnance66.com/Uploads/action/commonQuestions/5b326d93567bd.png', '1530031510', '0', null, null);

-- ----------------------------
-- Table structure for btc_send
-- ----------------------------
DROP TABLE IF EXISTS `btc_send`;
CREATE TABLE `btc_send` (
  `send_id` varchar(32) NOT NULL COMMENT '发送ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `maincoin_id` varchar(8) NOT NULL COMMENT '接受方的ID',
  `send_address` varchar(50) NOT NULL COMMENT '发送地址',
  `number` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '发送数量（最多发送数是小数点后8位）',
  `send_cost` decimal(50,4) DEFAULT '0.0000' COMMENT '发送所需费用',
  `leave_words` text COMMENT '留言',
  `currency_type` varchar(1) NOT NULL COMMENT '发送币种类型 1-BTC 2-ETH',
  `img_url` varchar(100) DEFAULT NULL COMMENT '客户上传图片的URL',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '0-已提交  -1-失败  1-进行中2-已完成',
  `remark` varchar(255) DEFAULT NULL COMMENT '审核意见',
  PRIMARY KEY (`send_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发送币种表';

-- ----------------------------
-- Records of btc_send
-- ----------------------------
INSERT INTO `btc_send` VALUES ('a2018070414222415306853447835831', 'D2018062522390515299375453098002', 'BrXdaxFU', '0x4d720b9dfe133c0859d0a09ba175c89cd43bf0de', '1.4329', '0.0000', '', '2', null, '0', null, '1530685587', '1530685344', '2', '');
INSERT INTO `btc_send` VALUES ('a2018070506503615307446364284469', 'D2018062522390515299375453098002', 'BrXdaxFU', '0x4d720b9dfe133c0859d0a09ba175c89cd43bf0de', '0.4549', '0.0000', '', '2', null, '0', null, '1530769109', '1530744636', '-1', '');
INSERT INTO `btc_send` VALUES ('B2018060915134215285284224281096', 'z2018052921374715276010670107453', 'FRhAWLzq', '0x3fd440951EAC1fFd538DEDc8d3d6124b9d476976', '0.1481', '0.0000', '', '2', null, '0', null, '1528528518', '1528528422', '2', '');
INSERT INTO `btc_send` VALUES ('B2018061719044715292334879821635', 'b2018061221310015288102605757749', 'kQVUDGlL', '1FeeyiEFU7YaB19yNzmKx536sAWtcz8EhU', '0.0220', '0.0000', '王辉', '1', null, '0', null, '1529233570', '1529233487', '2', '');
INSERT INTO `btc_send` VALUES ('B2018070322583415306299143866515', 'D2018062522390515299375453098002', 'UOYuVtfT', 'du3fd440951EAC1fFd597aEDc8d3d6124b9d476943', '0.1566', '0.0000', '', '2', null, '0', null, '1530630076', '1530629914', '2', '');
INSERT INTO `btc_send` VALUES ('B2018070423001215307164124118883', 'D2018062522390515299375453098002', 'BrXdaxFU', '0x4d720b9dfe133c0859d0a09ba175c89cd43bf0de', '0.4549', '0.0000', '', '2', null, '0', null, '1530716694', '1530716412', '-1', '');
INSERT INTO `btc_send` VALUES ('b2018070923574015311518605305335', 'c2018062612085515299861355405624', 'kQVUDGlL', '16u1fSv1eifGzpTzozGVhqAr2hcu7L9xLZ', '0.0486', '0.0000', '', '1', null, '0', null, '1531151946', '1531151860', '2', '');
INSERT INTO `btc_send` VALUES ('B2018071417050415315591043653824', 'D2018062522390515299375453098002', 'BrXdaxFU', '3FjQcAcJSTz4BzGfmFqzdP27qiVMkV5jxA', '0.0353', '0.0000', '', '1', null, '0', null, '1531634715', '1531559104', '-1', '');
INSERT INTO `btc_send` VALUES ('c2018063021464515303664053731880', 'A2018060816492515284477655068427', 'UOYuVtfT', '0x3fd440951EAC1fFd538DEDc8d3d6124b9d476976', '4.1600', '0.0000', '', '2', null, '0', null, '1530367833', '1530366405', '-1', '');
INSERT INTO `btc_send` VALUES ('c2018070414293215306857721176023', 'D2018062522390515299375453098002', 'BrXdaxFU', '0x4d720b9dfe133c0859d0a09ba175c89cd43bf0de', '1.4329', '0.0000', '', '2', null, '0', null, null, '1530685772', '0', null);
INSERT INTO `btc_send` VALUES ('D2018060314502315280086230695529', 'D2018050922545015258776900852531', 'kJUlAucy', '1GgDLwmjy8ERxdSbKKbWCnGVspScnVnMaZ', '1.0000', '0.0000', '', '1', null, '0', null, '1528008786', '1528008623', '2', '');
INSERT INTO `btc_send` VALUES ('D2018070817083215310409128112344', 'a2018062615000515299964051541616', 'zXQBwUVt', '19FByLuKEdqEdAdUfCYE5wYbmAjhPkPpb6', '0.0048', '0.0000', '', '1', null, '0', null, '1531041278', '1531040912', '2', '');
INSERT INTO `btc_send` VALUES ('G2018070816422215310393427564809', 'a2018062615000515299964051541616', 'zXQBwUVt', '1GgDLwmjy8ERxdSbKKbWCnGVspScnVnMaZ', '0.0048', '0.0000', '', '1', null, '0', null, '1531040639', '1531039342', '-1', '');
INSERT INTO `btc_send` VALUES ('G2018070920532715311408072271777', 'c2018062612085515299861355405624', 'kQVUDGlL', '16u1fSv1eifGzpTzozGVhqAr2hcu7L9xLZ', '0.0074', '0.0000', '', '1', null, '0', null, '1531140865', '1531140807', '2', '');
INSERT INTO `btc_send` VALUES ('H2018060414323415280939544561370', 'D2018050922545015258776900852531', 'LLxSahXA', '1GgDLwmjy8ERxdSbKKbWCnGVspScnVnMaZ', '1.0000', '0.0000', '', '1', null, '0', null, '1528094015', '1528093954', '2', '');
INSERT INTO `btc_send` VALUES ('q2018062500160915298569694497010', 'D2018050922545015258776900852531', 'kQVUDGlL', '1FeeyiEFU7YaB19yNzmKx536sAWtcz8EhU', '1.0000', '0.0000', '', '1', null, '0', null, null, '1529856969', '0', null);
INSERT INTO `btc_send` VALUES ('q2018070423011215307164724430297', 'D2018050922545015258776900852531', 'eeeeeeee', '343434', '0.4500', '0.0000', '', '2', null, '0', null, null, '1530716472', '0', null);
INSERT INTO `btc_send` VALUES ('q2018070816333115310388116554950', 'a2018062615000515299964051541616', 'zXQBwUVt', 'bruce16540@yahoo.com.tw', '0.0048', '0.0000', '自己', '1', 'http://blnance66.com/Uploads/action/sendImg/5b41cbf24e350.png', '0', null, '1531039213', '1531038811', '-1', '');
INSERT INTO `btc_send` VALUES ('z2018060913412015285228809279962', 'z2018052921374715276010670107453', 'FRhAWLzq', '1443528930@qq.com', '0.1481', '0.0000', '', '2', null, '0', null, '1528527648', '1528522880', '-1', '');
INSERT INTO `btc_send` VALUES ('z2018062500180115298570813916788', 'D2018050922545015258776900852531', 'AHSJHJHG', 'wweeyiEFU7YaB19yNzmKx536sAWtcz8EhU', '1.0000', '0.0000', '', '1', null, '0', null, null, '1529857081', '0', null);
INSERT INTO `btc_send` VALUES ('z2018070423022515307165451547053', 'D2018050922545015258776900852531', 'qqqqqqqq', '5325235', '0.1100', '0.0000', '', '1', null, '0', null, null, '1530716545', '0', null);
INSERT INTO `btc_send` VALUES ('z2018070423260515307179655760478', 'D2018062522390515299375453098002', 'BrXdaxFU', '0x4d720b9dfe133c0859d0a09ba175c89cd43bf0de', '0.4549', '0.0000', '', '2', null, '0', null, '1530718057', '1530717965', '-1', '');
INSERT INTO `btc_send` VALUES ('z2018071022380215312334828983180', 'c2018062612085515299861355405624', 'kQVUDGlL', '16u1fSv1eifGzpTzozGVhqAr2hcu7L9xLZ', '0.1035', '0.0000', '', '1', null, '0', null, '1531233553', '1531233482', '2', '');

-- ----------------------------
-- Table structure for btc_service
-- ----------------------------
DROP TABLE IF EXISTS `btc_service`;
CREATE TABLE `btc_service` (
  `service_id` varchar(32) NOT NULL COMMENT '客服ID',
  `name` text NOT NULL COMMENT '称呼',
  `tel` text COMMENT '联系方式',
  `status` varchar(1) DEFAULT '0' COMMENT '0-浮动1-隐藏',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客服表';

-- ----------------------------
-- Records of btc_service
-- ----------------------------
INSERT INTO `btc_service` VALUES ('10000000000000000000000000000000', '客服LINE：BTC66,客服微信:GIRLS_6961', 'tel:18159850785', '0');

-- ----------------------------
-- Table structure for btc_show_currency_value
-- ----------------------------
DROP TABLE IF EXISTS `btc_show_currency_value`;
CREATE TABLE `btc_show_currency_value` (
  `id` varchar(32) NOT NULL,
  `btc_value_twd` decimal(50,0) NOT NULL COMMENT '比特币对新台币的单价',
  `btc_value_hkd` decimal(50,0) NOT NULL COMMENT '比特币对港币的单价',
  `btc_value_usd` decimal(50,0) NOT NULL COMMENT '比特币对美元的单价',
  `eth_value_twd` decimal(50,0) NOT NULL COMMENT '以太币对新台币的单价',
  `eth_value_hkd` decimal(50,0) NOT NULL COMMENT '以太币对港币的单价',
  `eth_value_usd` decimal(50,0) NOT NULL COMMENT '以太币对美元的单价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='界面显示货币价值表';

-- ----------------------------
-- Records of btc_show_currency_value
-- ----------------------------
INSERT INTO `btc_show_currency_value` VALUES ('10000000000000000000000000000000', '192552', '50064', '6418', '14331', '3725', '478');

-- ----------------------------
-- Table structure for btc_token
-- ----------------------------
DROP TABLE IF EXISTS `btc_token`;
CREATE TABLE `btc_token` (
  `token` varchar(32) NOT NULL COMMENT 'token',
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='token验证表\r\n生成token方式\r\nmd5(base64_encode(base64_encode(''需要验证的邮箱'')))';

-- ----------------------------
-- Records of btc_token
-- ----------------------------
INSERT INTO `btc_token` VALUES ('029669f32c662b9d6d0007cee687be04');
INSERT INTO `btc_token` VALUES ('03dfa95905f5222b8521a84b1d0a05c1');
INSERT INTO `btc_token` VALUES ('081e532d4fa2949088afdb3e7f6047da');
INSERT INTO `btc_token` VALUES ('08bce3f9142dfff0aaa078c5d15dd100');
INSERT INTO `btc_token` VALUES ('08c778bc698f56b64491db077a6d9459');
INSERT INTO `btc_token` VALUES ('0d4a76341d74cc3e8510db089a6c76fd');
INSERT INTO `btc_token` VALUES ('0d4bcd3e2b83aaeda8ce2eae49b780e0');
INSERT INTO `btc_token` VALUES ('167000be2b0e321ae0deb39048b723d3');
INSERT INTO `btc_token` VALUES ('19a8dc59c03123ef9ddf8e69bbbf7c83');
INSERT INTO `btc_token` VALUES ('1a0e02d7b9021ee2607b28e9c538a497');
INSERT INTO `btc_token` VALUES ('1b9cafae2ff8e3b73b0dff2b1b238432');
INSERT INTO `btc_token` VALUES ('1cf8838b9d98344474cbd585f5f7e285');
INSERT INTO `btc_token` VALUES ('1ec436a6a19ec2b64ecaafd1886d0e28');
INSERT INTO `btc_token` VALUES ('2162d25adfc415876eafffbd169e0e08');
INSERT INTO `btc_token` VALUES ('246a09c4503e0f6a625af8dbbb51c0b1');
INSERT INTO `btc_token` VALUES ('29ac77d31ddcb12b1a2bdbd557c2e472');
INSERT INTO `btc_token` VALUES ('2dfcb96d03849c0d54234c3353e6e1fb');
INSERT INTO `btc_token` VALUES ('304937469536a2ab98b2a0545ecfba3a');
INSERT INTO `btc_token` VALUES ('3201b8b8babceb980053d4c3d1b9e5db');
INSERT INTO `btc_token` VALUES ('324a715d9df10dc540b8dc63905bb49d');
INSERT INTO `btc_token` VALUES ('338505682bd521172e30b0a334954e37');
INSERT INTO `btc_token` VALUES ('34c74795e1ea81ad46d77c9d448a60ff');
INSERT INTO `btc_token` VALUES ('38ea3bac6e265ed2ae780f9f0bf80dca');
INSERT INTO `btc_token` VALUES ('399727d09f0ec15d131675f5c71e463e');
INSERT INTO `btc_token` VALUES ('39d51658353ba0d0e6ff543dd6557bcd');
INSERT INTO `btc_token` VALUES ('3dc636a18b6a5b28c36ddf9648fc8547');
INSERT INTO `btc_token` VALUES ('3ecb5929fc56b273f5b8253ccf5ba475');
INSERT INTO `btc_token` VALUES ('44a1044e4849961db9d07428cbc62fba');
INSERT INTO `btc_token` VALUES ('44bbd66870c031035298fe443160cad0');
INSERT INTO `btc_token` VALUES ('486c66e6acf7e5bc91fb126b4b787009');
INSERT INTO `btc_token` VALUES ('48d88531d57d1800c8fe7da545c8bd35');
INSERT INTO `btc_token` VALUES ('50871fc5d3b5f45ff1dce9e0631b5897');
INSERT INTO `btc_token` VALUES ('56effe4d334c929fcaab6a9b53680cab');
INSERT INTO `btc_token` VALUES ('59b1672223dc1b2d8e258051a7b345f0');
INSERT INTO `btc_token` VALUES ('5c3f12c84d83e5b78a61eaf0d5a2c356');
INSERT INTO `btc_token` VALUES ('5dcf3ccaa605d6b3d3b8c49d7b142825');
INSERT INTO `btc_token` VALUES ('64c2e34b11109db2951b32efc3ad8c2e');
INSERT INTO `btc_token` VALUES ('6bcbc05e78be823e748f78f9090f911d');
INSERT INTO `btc_token` VALUES ('6da939178debd6825aef711d8e17c8cc');
INSERT INTO `btc_token` VALUES ('72fb3cc19fb82df96e452d023bc970ef');
INSERT INTO `btc_token` VALUES ('798c61056f57327d24301e6e9a15a97c');
INSERT INTO `btc_token` VALUES ('7a3df9c49107a088dc44d43abac0a294');
INSERT INTO `btc_token` VALUES ('7b534423b0bdc6215a25ab2bb3763268');
INSERT INTO `btc_token` VALUES ('7ce772fb30a31baea2e110391b01e555');
INSERT INTO `btc_token` VALUES ('800d33345894bb9b5e1ba852edc69eea');
INSERT INTO `btc_token` VALUES ('80582f79df116332272a88249093affb');
INSERT INTO `btc_token` VALUES ('85b8c66b25b8c846d47a32d680895abb');
INSERT INTO `btc_token` VALUES ('86e4d26bae6a25d790a6787843aff118');
INSERT INTO `btc_token` VALUES ('876debfbc8575e386d89cd2a45ee7b26');
INSERT INTO `btc_token` VALUES ('88b064f083f9b70d586968b996a00d89');
INSERT INTO `btc_token` VALUES ('8a04407e6bf9f9983bbdec7ab4dd0f47');
INSERT INTO `btc_token` VALUES ('8d9c7dee57f476facbf53d8ce0cd4330');
INSERT INTO `btc_token` VALUES ('8f205abb1928364ea62cd0a329c15327');
INSERT INTO `btc_token` VALUES ('8fa9388cf2eb0e9ef3bdd8b286db9c96');
INSERT INTO `btc_token` VALUES ('959680e18c53bd70db379f6d9f39550b');
INSERT INTO `btc_token` VALUES ('9a8e69a5fd0eda366a4b97668f95842e');
INSERT INTO `btc_token` VALUES ('9ec90e40ec0b5e48e233623cb228decb');
INSERT INTO `btc_token` VALUES ('9faebbc2303b92c695a41a5d11816871');
INSERT INTO `btc_token` VALUES ('a0859406470b471868aa74e09d9034ee');
INSERT INTO `btc_token` VALUES ('a2fa98429b2d4279990eb77c645b7e94');
INSERT INTO `btc_token` VALUES ('a52735e99e0194f53b716ad65befbc2e');
INSERT INTO `btc_token` VALUES ('a57a91e12c313e61d53ce7d9b93ed8fd');
INSERT INTO `btc_token` VALUES ('a6cc2967b267ebcbb12cf1daf15c0273');
INSERT INTO `btc_token` VALUES ('a8e3a56a6fc8ac55fdfa017de754965a');
INSERT INTO `btc_token` VALUES ('a90ca4c0c5cbb40b6a0e0ecc7e5c5bd6');
INSERT INTO `btc_token` VALUES ('ae528a57abb065bb019f1647ac0f525c');
INSERT INTO `btc_token` VALUES ('b1f3a77695b008a40e38b18fb23d9c03');
INSERT INTO `btc_token` VALUES ('b473279e6944d7125d562aab0576456f');
INSERT INTO `btc_token` VALUES ('b4d49f7c9c0a932ee7e41375bd4309ce');
INSERT INTO `btc_token` VALUES ('b58021088f2f6a33db26e78304d1d1db');
INSERT INTO `btc_token` VALUES ('bb620aeafea8fec53a500478049db3e3');
INSERT INTO `btc_token` VALUES ('bbdd3397e224c18f2a2285711a1bbb6b');
INSERT INTO `btc_token` VALUES ('bf7c2ff195a825af88471c0eefad1373');
INSERT INTO `btc_token` VALUES ('bfbb09237d6c20838efd1b1ce2305732');
INSERT INTO `btc_token` VALUES ('bfc2935e9b472d21e9eebb89412b302f');
INSERT INTO `btc_token` VALUES ('c03b12220e45dcc8e9ca6246d5e84b5c');
INSERT INTO `btc_token` VALUES ('c3ab3ad1474178d5f8f8dcf15d46ffbc');
INSERT INTO `btc_token` VALUES ('c44a8bd368b9608326261f4f97e40803');
INSERT INTO `btc_token` VALUES ('cd1b3b94f8867f3833f7830971e74fbc');
INSERT INTO `btc_token` VALUES ('cebbad871ec188e3fc6a40ec70b039e4');
INSERT INTO `btc_token` VALUES ('d0105f0fc70c4bd623511a1715033225');
INSERT INTO `btc_token` VALUES ('d34221c66d70f77d1fef7f00a125496d');
INSERT INTO `btc_token` VALUES ('d3822c9807c500d69d85f219cddb9181');
INSERT INTO `btc_token` VALUES ('d48710f9bdc43452d996d30005953f41');
INSERT INTO `btc_token` VALUES ('d514a7ab654ebc02b14b8f07b6903cc3');
INSERT INTO `btc_token` VALUES ('d6dcda53611a482b1a943201ea517366');
INSERT INTO `btc_token` VALUES ('dacc5843805e2ba98df05e469d8b2f57');
INSERT INTO `btc_token` VALUES ('dbe06a8e9ba8f1f003b1cc3e398d459d');
INSERT INTO `btc_token` VALUES ('dbedae6bad5f8a76e98d3034f6fe7a6c');
INSERT INTO `btc_token` VALUES ('ddbc9abdf28d3bbebfdd24aecd2434f0');
INSERT INTO `btc_token` VALUES ('df221e9e3ec3edc363236ac119356703');
INSERT INTO `btc_token` VALUES ('e16299605a6b2baf60d015f2c4e6bbaf');
INSERT INTO `btc_token` VALUES ('e339b640ff52bbb88ee7d1b5630b24b2');
INSERT INTO `btc_token` VALUES ('e456902b8209e079b1031a41085f547a');
INSERT INTO `btc_token` VALUES ('e8193b285e8b4c77675af0c8fbdd8a39');
INSERT INTO `btc_token` VALUES ('efbf78ff5aa3f79ccdbaba2c5895d0cf');
INSERT INTO `btc_token` VALUES ('f2c8b94883302a29d7e2774fe3d639b0');
INSERT INTO `btc_token` VALUES ('f3ad36f6d77fe5ed5ab54bdfa792f5f1');
INSERT INTO `btc_token` VALUES ('f4261779afef270ee9d79c93ff7d47b8');
INSERT INTO `btc_token` VALUES ('f5ac18737400b8be4377a0f96c1adb4f');
INSERT INTO `btc_token` VALUES ('fd10523b3ac2f73f9a3e208ff19dfe44');
INSERT INTO `btc_token` VALUES ('fdc8867b0e54388fd4cd4f864a09e68b');
INSERT INTO `btc_token` VALUES ('ffda066998cd24bda5b6420b99c5bf94');
INSERT INTO `btc_token` VALUES ('ffe3fd15d554a8ff7975affa9ec8e89e');

-- ----------------------------
-- Table structure for btc_up_order
-- ----------------------------
DROP TABLE IF EXISTS `btc_up_order`;
CREATE TABLE `btc_up_order` (
  `up_order_id` varchar(32) NOT NULL COMMENT '提现订单ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `up_price` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '提现金额',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '提现状态 0-审核中，1-提现成功，-1-提现失败',
  `refusal_cause` varchar(255) DEFAULT NULL COMMENT '拒绝提现原因',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`up_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='提现订单表';

-- ----------------------------
-- Records of btc_up_order
-- ----------------------------
INSERT INTO `btc_up_order` VALUES ('a2018060412414215280873023914535', 'B2018060314494815280085889461708', '291152.0000', '1', null, '0', null, '1528087341', '1528087302');
INSERT INTO `btc_up_order` VALUES ('A2018060513221215281761326157831', 'c2018060417125115281035716226873', '220351.0000', '1', null, '0', null, '1528176328', '1528176132');
INSERT INTO `btc_up_order` VALUES ('A2018060816431815284473988520241', 'B2018051510104015263502407538798', '157305.0000', '1', null, '0', null, '1528447445', '1528447398');
INSERT INTO `btc_up_order` VALUES ('a2018060915143215285284729709824', 'B2018051510104015263502407538798', '24832.0000', '1', null, '0', null, '1528528487', '1528528472');
INSERT INTO `btc_up_order` VALUES ('A2018070920443615311402766893324', 'c2018062612085515299861355405624', '1500.0000', '-1', '.', '0', null, '1531140365', '1531140276');
INSERT INTO `btc_up_order` VALUES ('B2018060314575715280090771316323', 'a2018060313265415280036142856758', '234966.0000', '1', null, '0', null, '1528009538', '1528009077');
INSERT INTO `btc_up_order` VALUES ('B2018060315212215280104825608549', 'G2018060313071815280024388174332', '234873.0000', '1', null, '0', null, '1528010545', '1528010482');
INSERT INTO `btc_up_order` VALUES ('B2018060513061915281751794763027', 'G2018060313071815280024388174332', '246476.0000', '1', null, '0', null, '1528176309', '1528175179');
INSERT INTO `btc_up_order` VALUES ('b2018060513165915281758195353819', 'B2018060314494815280085889461708', '252504.0000', '1', null, '0', null, '1528176319', '1528175819');
INSERT INTO `btc_up_order` VALUES ('B2018060915355515285297557288946', 'B2018051510104015263502407538798', '684428.0000', '1', null, '0', null, '1528530174', '1528529755');
INSERT INTO `btc_up_order` VALUES ('b2018061518203015290580308034425', 'D2018050922545015258776900852531', '1000.0000', '0', null, '0', null, null, '1529058030');
INSERT INTO `btc_up_order` VALUES ('b2018063017211815303504785489156', 'D2018062522390515299375453098002', '1015.0000', '0', null, '0', null, null, '1530350478');
INSERT INTO `btc_up_order` VALUES ('c2018060414444815280946883018478', 'b2018060414125815280927787957880', '230341.0000', '1', null, '0', null, '1528094718', '1528094688');
INSERT INTO `btc_up_order` VALUES ('c2018060513291615281765565280638', 'b2018060414125815280927787957880', '223144.0000', '1', null, '0', null, '1528176575', '1528176556');
INSERT INTO `btc_up_order` VALUES ('c2018061022024215286393628863386', 'B2018051510104015263502407538798', '51.0000', '1', null, '0', null, '1528647303', '1528639362');
INSERT INTO `btc_up_order` VALUES ('c2018061100164815286474089501242', 'B2018051510104015263502407538798', '402978.0000', '1', null, '0', null, '1528647439', '1528647408');
INSERT INTO `btc_up_order` VALUES ('D2018060200555715278721570234873', 'B2018051510104015263502407538798', '17327.0000', '1', null, '0', null, '1527942278', '1527872157');
INSERT INTO `btc_up_order` VALUES ('D2018060315064915280096091107379', 'a2018060313265415280036142856758', '1405.0000', '1', null, '0', null, '1528009635', '1528009609');
INSERT INTO `btc_up_order` VALUES ('D2018060412384415280871249895588', 'G2018060313071815280024388174332', '211384.0000', '1', null, '0', null, '1528087150', '1528087124');
INSERT INTO `btc_up_order` VALUES ('D2018060414512315280950836076431', 'b2018060414125815280927787957880', '1405.0000', '1', null, '0', null, '1528095113', '1528095083');
INSERT INTO `btc_up_order` VALUES ('D2018060716561715283617773065932', 'B2018051510104015263502407538798', '1000.0000', '-1', '', '0', null, '1528361976', '1528361777');
INSERT INTO `btc_up_order` VALUES ('D2018071117313615313014961389520', 'B2018071115174515312934650701210', '899.0000', '-1', '金額5000以上', '0', null, '1531301861', '1531301496');
INSERT INTO `btc_up_order` VALUES ('D2018071617121115317323311270760', 'z2018071321035315314870335446208', '480.0000', '-1', '', '0', null, '1531733474', '1531732331');
INSERT INTO `btc_up_order` VALUES ('G2018052801473715274432573775860', 'D2018050922545015258776900852531', '640000.0000', '1', null, '0', null, '1527486476', '1527443257');
INSERT INTO `btc_up_order` VALUES ('G2018060513554715281781472066289', 'b2018060414125815280927787957880', '673143.0000', '1', null, '1', '1528298379', '1528178177', '1528178147');
INSERT INTO `btc_up_order` VALUES ('G2018063021394415303659842488315', 'a2018062615000515299964051541616', '985.0000', '-1', '', '0', null, '1531038047', '1530365984');
INSERT INTO `btc_up_order` VALUES ('G2018070715075715309472778192903', 'D2018062522390515299375453098002', '6699.0000', '-1', '', '0', null, '1531493530', '1530947277');
INSERT INTO `btc_up_order` VALUES ('H2018060412563915280881997382124', 'a2018060313265415280036142856758', '647801.0000', '1', null, '0', null, '1528088218', '1528088199');
INSERT INTO `btc_up_order` VALUES ('H2018060822394515284687853835462', 'D2018050922545015258776900852531', '1.0000', '1', null, '0', null, '1528530188', '1528468785');
INSERT INTO `btc_up_order` VALUES ('H2018060915411415285300741692062', 'A2018060816492515284477655068427', '3032.0000', '1', null, '0', null, '1528533150', '1528530074');
INSERT INTO `btc_up_order` VALUES ('H2018061401054615289095464029861', 'A2018060816492515284477655068427', '1987.0000', '1', null, '0', null, '1528910440', '1528909546');
INSERT INTO `btc_up_order` VALUES ('H2018062520495815299309988691574', 'A2018060816492515284477655068427', '16543.0000', '-1', '', '0', null, '1529933995', '1529930998');
INSERT INTO `btc_up_order` VALUES ('H2018102911093815407825783241299', 'q2018090611234315362042232669474', '1.0000', '0', null, '0', null, null, '1540782578');
INSERT INTO `btc_up_order` VALUES ('z2018060419133015281108103153523', 'c2018060417125115281035716226873', '284808.0000', '1', null, '0', null, '1528114935', '1528110810');
INSERT INTO `btc_up_order` VALUES ('z2018071218282315313913037093753', 'D2018071217425015313885700332916', '316.0000', '-1', '', '0', null, '1531393562', '1531391303');

-- ----------------------------
-- Table structure for btc_user
-- ----------------------------
DROP TABLE IF EXISTS `btc_user`;
CREATE TABLE `btc_user` (
  `user_id` varchar(32) NOT NULL,
  `maincoin_id` varchar(8) DEFAULT NULL COMMENT '随机生成的mciID',
  `user_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `birthdate` varchar(15) DEFAULT NULL COMMENT '出生年月',
  `certificate_type` varchar(1) DEFAULT NULL COMMENT '证件类型 1-台湾居住证 2-台湾居留证 3-护照',
  `certificate_num` varchar(25) DEFAULT NULL COMMENT '证件号码',
  `tel` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `email` varchar(50) NOT NULL COMMENT '电子邮箱',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '状态 0-正常 -1-锁定',
  `login_ip` varchar(32) NOT NULL,
  `register_ip` varchar(32) NOT NULL,
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of btc_user
-- ----------------------------
INSERT INTO `btc_user` VALUES ('A2018060301500715279618077095058', 'DvVanJfn', '516777902@qq.com', null, null, null, '+86-13709898989', '516777902@qq.com', '62fa7bbe115476d6b10ecb376839e996', '0', '', '', '0', null, '1527961875', '1527961807');
INSERT INTO `btc_user` VALUES ('a2018060313265415280036142856758', 'kJUlAucy', '王丽容', '499363200', '1', '352203198510293762', '+86-13235957823', 'ask1123@126.com', '63ce7caa4f65e7defd1e80c4d407ef6e', '0', '', '', '0', null, '1528003666', '1528007207');
INSERT INTO `btc_user` VALUES ('A2018060816492515284477655068427', 'FRhAWLzq', '王丽娟', '438537600', '1', '352203198311253725', '+86-13950568088', '1443528930@qq.com', 'afc8e76be58f893c4997fd1f19428771', '0', '112.5.236.128', '223.104.6.107', '0', null, '1528447783', '1528447848');
INSERT INTO `btc_user` VALUES ('a2018061815360915293073698335604', 'WutEzpXD', '277439448@qq.com', null, null, null, '+86-18108240376', '277439448@qq.com', '0988e6857f342037568e58ca64cb7207', '0', '222.214.129.0', '222.214.129.0', '0', null, '1529307383', '1529307369');
INSERT INTO `btc_user` VALUES ('a2018062220475415296716743803960', null, 'lin21303@yahoo.com.tw', null, null, null, null, 'lin21303@yahoo.com.tw', '132b18304ddb8539deb463ae3287f9db', '0', '39.12.94.6', '39.12.94.6', '0', null, null, '1529671674');
INSERT INTO `btc_user` VALUES ('A2018062501035015298598305946564', 'uopdtIMR', 'h2138929@yahoo.com.tw', null, null, null, '+86-15160006441', 'h2138929@yahoo.com.tw', '753890fb2f20a618187d59e112d73311', '0', '198.57.27.240', '198.57.27.240', '0', null, null, '1529859830');
INSERT INTO `btc_user` VALUES ('a2018062615000515299964051541616', 'zXQBwUVt', '歐家榮', '959097600', '1', 'K123116109', '+886-0952320015', 'bruce16540@yahoo.com.tw', '26175f62e53bdd90610a1ca2f72ff58b', '0', '175.97.18.160', '125.231.39.83', '0', null, '1529996435', '1530027050');
INSERT INTO `btc_user` VALUES ('a2018070923171615311494368916322', 'PULcHNss', '陳嘉旭', '239472000', '1', 'A124536179', '+886-0988731695', 'motorcycle49@yahoo.com.tw', 'b4b34551f804f88a3becaf88de410af2', '0', '61.231.56.225', '61.231.56.225', '0', null, '1531149484', '1531149993');
INSERT INTO `btc_user` VALUES ('a2018071222150615314049060328676', 'aRUomYpB', 'tom972846@gmail.com', null, null, null, '+886-0989330119', 'tom972846@gmail.com', 'b275b52cce8cb6dc6177d58334a18db7', '0', '114.43.34.166', '114.43.34.166', '0', null, '1531404922', '1531404906');
INSERT INTO `btc_user` VALUES ('A2018071222505615314070569467166', 'aVroOUYH', '林敬祥', '672073200', '1', 'F128213798', '+886-970519771', '410175031@mail.nknu.edu.tw', '3f8c8385b355a5d385b93207bccb100e', '0', '182.234.99.137', '219.68.19.38', '0', null, '1531407076', '1531577441');
INSERT INTO `btc_user` VALUES ('B2018051510104015263502407538798', 'UOYuVtfT', '劉瀟湘', '655488000', '1', '17832736483', '+86-13249810831', 'wu13062251002@sina.com', '62fa7bbe115476d6b10ecb376839e996', '0', '117.61.12.110', '', '0', null, null, '1527489988');
INSERT INTO `btc_user` VALUES ('B2018060314494815280085889461708', 'qIvkpakh', '赵军贺', '740505600', '1', '412824199306201416', '+93-17083634223', 'm17083634223@163.com', '63ce7caa4f65e7defd1e80c4d407ef6e', '0', '211.23.160.180', '', '0', null, '1528008763', '1528009069');
INSERT INTO `btc_user` VALUES ('b2018060414125815280927787957880', 'LLxSahXA', '王丽容', '499363200', '1', '352203198510293762', '+86-13085860543', 'xxt8300@163.com', '63ce7caa4f65e7defd1e80c4d407ef6e', '0', '', '', '0', null, '1528092801', '1528093741');
INSERT INTO `btc_user` VALUES ('b2018060717050615283623060351172', 'GtLcMcLs', '买买买叫姐姐', '1517500800', '1', '46676767', '+86-13062225655', 'wu13062251000@sina.com', '62fa7bbe115476d6b10ecb376839e996', '0', '117.61.150.186', '117.61.150.186', '0', null, '1528362338', '1528373754');
INSERT INTO `btc_user` VALUES ('b2018061221310015288102605757749', 'iIYBSqEb', '279661747@qq.com', null, null, null, '+86-13921008750', '279661747@qq.com', '6604c084daf45c8f84eb01ddaa607209', '0', '107.151.139.131', '121.231.77.212', '0', null, '1528810274', '1528810260');
INSERT INTO `btc_user` VALUES ('b2018061223221915288169395701751', 'QcqPxdit', '罗玉红', '416505600', '1', '430426198303156320', '+86-15874259965', '1297314073@qq.com', 'cc4fa06dc71dd79533c33fb3baf27f7f', '0', '157.255.172.22', '110.52.216.200', '0', null, null, '1528817776');
INSERT INTO `btc_user` VALUES ('B2018071020412515312264856001488', 'QXmipOkn', '林軍翰', '561571200', '1', 'F127022122', '+886-0982625966', 'choan76@gmail.com', 'f583d2fbf9372c33c74d2b7efef72908', '0', '36.231.106.55', '36.231.117.44', '0', null, '1531226554', '1531227046');
INSERT INTO `btc_user` VALUES ('B2018071115174515312934650701210', 'sBDUaAaX', '賴佳雯', '747244800', '1', 'M222471837', '+886-0980852500', 'panboyi2@yahoo.com.tw', '6bbc40e572aa0a23017901038a14e703', '0', '49.219.145.148', '115.43.27.8', '0', null, null, '1531293688');
INSERT INTO `btc_user` VALUES ('c2018060301570315279622236824644', 'osQOnhoS', '范禹繁', '671558400', '1', '430721199104142216', '+86-13085860543', 'A13085860543@163.com', '63ce7caa4f65e7defd1e80c4d407ef6e', '0', '', '', '0', null, '1527962266', '1527962512');
INSERT INTO `btc_user` VALUES ('c2018060417125115281035716226873', 'YEgdnkkI', '赵龙', '387388800', '1', '420683198204124215', '+86-18688738225', '3471288659@qq.com', '7c2e71c2bb019a5237401c3a7f290f93', '0', '', '', '0', null, '1528103740', '1528105594');
INSERT INTO `btc_user` VALUES ('c2018062612085515299861355405624', 'INglPuQs', '張家銘', '674060400', '1', 'E124441562', '+886-0975662937', 'what80513@gmail.com', '5087c6d4e0c5b48c86b598692cda3da4', '0', '115.165.207.112', '49.215.208.126', '0', null, '1530028306', '1530025976');
INSERT INTO `btc_user` VALUES ('c2018062914390515302543458405286', 'ppzfnhAS', 'yuda19970916@gmail.com', null, null, null, '+86-17755466324', 'yuda19970916@gmail.com', '17ff8d648109f34509e824cbbfed839d', '0', '46.101.31.9', '46.101.31.9', '0', null, '1530254358', '1530254345');
INSERT INTO `btc_user` VALUES ('D2018050922545015258776900852531', 'kQVUDGlL', '陈羽', '639504000', '1', 'A46767946468', '+886-23584758', 'wu13062251001@sina.com', '62fa7bbe115476d6b10ecb376839e996', '0', '125.227.26.29', '', '0', null, '1525877706', '1526396897');
INSERT INTO `btc_user` VALUES ('D2018061300202515288204253732655', 'LicqsOnX', '干啥呢都看得见', '1189353600', '1', '4646464946764994', '+86-13434376767', '2821744053@qq.com', '62fa7bbe115476d6b10ecb376839e996', '0', '117.61.5.63', '117.61.5.63', '0', null, '1528820448', '1528820549');
INSERT INTO `btc_user` VALUES ('D2018062522390515299375453098002', 'BrXdaxFU', '黄星淇', '607449600', '1', '452731198904025716', '+86-17736647364', 'rex@imbbq.com', '29dee90cd47e5139da61314c519bd754', '0', '14.116.133.168', '117.140.133.93', '0', null, '1529937570', '1529938056');
INSERT INTO `btc_user` VALUES ('D2018071217425015313885700332916', 'lrcKJpdN', '張嘉烜', '920476800', '1', 'B123317797', '+886-0909360304', 'joy22398443@yahoo.com.tw', '869008410988dceecc8656af44952d03', '0', '49.215.194.200', '220.132.207.224', '0', null, '1531388607', '1531388878');
INSERT INTO `btc_user` VALUES ('D2018071217595215313895922312343', 'uTOVvkMv', '羅冠翔', '771868800', '1', 'M122650470', '+886-0974140365', 'a2431182@yahoo.com.tw', 'cbe582352286db533157d02e68e008f2', '0', '114.36.179.239', '101.139.166.52', '0', null, '1531389622', '1531390085');
INSERT INTO `btc_user` VALUES ('G2018052623401215273492129960960', 'REhdPtkw', '3102218314@qq.com', null, null, null, '+886-28373641', '3102218314@qq.com', '62fa7bbe115476d6b10ecb376839e996', '0', '', '', '0', null, '1527349233', '1527349212');
INSERT INTO `btc_user` VALUES ('G2018060313071815280024388174332', 'sOcRUTKR', '范禹繁', '671558400', '1', '430721199104142216', '+86-17139010418', 'btc521333@163.com', '63ce7caa4f65e7defd1e80c4d407ef6e', '0', '', '', '0', null, '1528002484', '1528002748');
INSERT INTO `btc_user` VALUES ('G2018060320571315280306337373767', 'DDXLwQRi', '任胜威', '605980800', '1', '411421198903160134', '+86-18736854000', '75841637@qq.com', 'a16cabbc8c63c8a5bf8a7b9bcf2d78f3', '0', '', '', '0', null, '1528030654', '1528030775');
INSERT INTO `btc_user` VALUES ('G2018061916335415293972346078597', 'AnYhsFDR', '杜天祥', '665337600', '1', '350500199102015034', '+86-15260815551', '1799442@qq.com', 'ac52d7804b2ee5194f8a4d5813540297', '0', '120.33.37.71', '120.37.112.124', '0', null, '1529397249', '1529398765');
INSERT INTO `btc_user` VALUES ('G2018070922145315311456936023385', 'VEVqfqEm', '陳宏韋', '771523200', '1', 'R124352355', '+886-987450802', 's753951i@yahoo.com.tw', '5c69ed4b92cdc817895c8e8a1952e958', '0', '58.114.136.77', '58.114.136.77', '0', null, '1531145713', '1531236123');
INSERT INTO `btc_user` VALUES ('H2018051716522515265471450195084', 'amXmeQyH', '謝富帆', '680022000', '1', 'N125431754', '+886-0988382561', 'a0988382561@gmail.com', '677c7cab393cd1d85d181fe5a7a7566c', '0', '', '', '0', null, '1526547190', '1526547404');
INSERT INTO `btc_user` VALUES ('H2018062312433815297290188601141', 'wgPswSYh', '46lam10@mail.com', null, null, null, '+60-107962289', '46lam10@mail.com', 'ea566de551f567cc742230bfbeb5a5c3', '0', '147.158.143.64', '147.158.143.64', '0', null, '1529729070', '1529729018');
INSERT INTO `btc_user` VALUES ('H2018062417250115298323014695643', 'HbWyBTFZ', 'qiguiguo207@yahoo.com', null, null, null, '+886-903231407', 'qiguiguo207@yahoo.com', '20749313efbca3f2f55028e11707942b', '0', '110.28.34.47', '110.28.34.47', '0', null, '1529832379', '1529832301');
INSERT INTO `btc_user` VALUES ('q2018060414352815280941282359801', 'fRCIrhQI', '郑强', '871660800', '1', '445281199708165158', '+86-15816380679', '1747156886@qq.com', 'dc0c8014d8a62c4608afcc3f6b57b923', '0', '', '', '0', null, '1528094148', '1528094547');
INSERT INTO `btc_user` VALUES ('q2018060816311115284466719913088', 'eifmvILi', '547406161@qq.com', null, null, null, '+86-18744333318', '547406161@qq.com', 'b6348ce4aec882c50a893546c2550447', '0', '122.136.86.83', '122.136.86.83', '0', null, '1528446688', '1528446671');
INSERT INTO `btc_user` VALUES ('q2018061815360115293073612541015', null, '188653019@qq.com', null, null, null, null, '188653019@qq.com', 'd342bbd9b4c16eed836c1f70a7f428cd', '0', '23.225.153.218', '222.214.129.0', '0', null, null, '1529307361');
INSERT INTO `btc_user` VALUES ('q2018062509385715298907370574160', 'JAxoWCFo', '吴晓龙', '531244800', '1', '350826198611020036', '+86-13062251091', 'btceth@mail.top', 'c09425118b03b6e789d4976c3d966a06', '0', '112.5.236.84', '112.5.236.84', '0', null, '1529890761', '1529907897');
INSERT INTO `btc_user` VALUES ('q2018062723335315301136334851120', 'LrLSEVZl', 'bus36275@kpooa.com', null, null, null, '+86-17898931341', 'bus36275@kpooa.com', '4722ca464241660136d93091b0634d3d', '0', '218.255.125.188', '218.255.125.188', '0', null, '1530113654', '1530113633');
INSERT INTO `btc_user` VALUES ('q2018071218310115313914619454603', 'yTOyxPia', '張雅倫', '566150400', '1', 'T223528260', '+886-906865051', 'allen761211@gmail.com', '2b10ed6451c724d5bc15ad96e053ca1f', '0', '101.137.18.248', '101.136.228.217', '0', null, null, '1531402945');
INSERT INTO `btc_user` VALUES ('q2018071318341415314780541649927', 'gmImPmzF', '張峻齊', '909849600', '1', 'J122942426', '+886-0915520669', 'zxc0915520669@yahoo.com', '03568c74acb977011f209161f02ba10d', '0', '39.12.34.5', '1.161.220.240', '0', null, '1531478079', '1531490672');
INSERT INTO `btc_user` VALUES ('q2018071514213715316356977114670', 'VdEeAFVx', '李汶曄', '620060400', '1', 'H223854220', '+886-931270826', 'elee6976@gmail.com', '87d1c1114941433aaadd5fb0ca692973', '0', '39.10.73.164', '39.10.192.120', '0', null, '1531635729', '1531732971');
INSERT INTO `btc_user` VALUES ('q2018090611234315362042232669474', 'luUyjcLN', '3151904400@qq.com', null, '1', '525198981', '+973-54565485', '3151904400@qq.com', '4192d21d2e09a8f2b97c5467e8e5d3ce', '0', '127.0.0.1', '::1', '0', null, null, '1536204223');
INSERT INTO `btc_user` VALUES ('z2018052921374715276010670107453', 'ZLhzXYeS', '王丽容', '499363200', '1', '352203198510293762', '+86-18150226660', '351289566@qq.com', 'afc8e76be58f893c4997fd1f19428771', '0', '117.136.75.94', '', '0', null, '1527601162', '1527663481');
INSERT INTO `btc_user` VALUES ('z2018071321035315314870335446208', 'zPnCfsKh', '曾錦琨', '935856000', '1', 'J122958728', '+886-979745414', 'kkegy27987@gmail.com', '723d5b16c9912ef248bb3e635273a443', '0', '111.248.95.96', '220.137.91.202', '0', null, '1531487066', '1531641985');

-- ----------------------------
-- Table structure for btc_user_account
-- ----------------------------
DROP TABLE IF EXISTS `btc_user_account`;
CREATE TABLE `btc_user_account` (
  `account_id` varchar(32) NOT NULL COMMENT '账户ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `btc_balance` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '比特币余额',
  `eth_balance` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '以太币余额',
  `balance` varchar(50) NOT NULL DEFAULT '0' COMMENT '余额',
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '0-启用 1-停用',
  `freeze_balance` varchar(50) NOT NULL DEFAULT '0' COMMENT '冻结余额',
  `extract_balance` float(32,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '可提现余额',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '银行名称',
  `bank_num` varchar(30) DEFAULT NULL COMMENT '银行卡号',
  `bank_account` varchar(50) DEFAULT NULL COMMENT '银行账户名(持卡人名字)',
  `bank_branch` varchar(50) DEFAULT NULL COMMENT '银行分行民称',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账户表';

-- ----------------------------
-- Records of btc_user_account
-- ----------------------------
INSERT INTO `btc_user_account` VALUES ('A2018060816311115284466719922784', 'q2018060816311115284466719913088', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1528446671');
INSERT INTO `btc_user_account` VALUES ('A2018061815360915293073698362864', 'a2018061815360915293073698335604', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1529307369');
INSERT INTO `btc_user_account` VALUES ('A2018062220475415296716743812968', 'a2018062220475415296716743803960', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1529671674');
INSERT INTO `btc_user_account` VALUES ('A2018071218310115313914619464920', 'q2018071218310115313914619454603', '0.0132', '0.0000', '0', '0', '0', '0.00', null, '', '', null, '0', null, null, '1531391461');
INSERT INTO `btc_user_account` VALUES ('b2018052623401315273492130273408', 'G2018052623401215273492129960960', '1.5230', '0.0000', '0', '0', '0', '0.00', null, '', '', null, '0', null, null, '1527349212');
INSERT INTO `btc_user_account` VALUES ('B2018060313071815280024388183988', 'G2018060313071815280024388174332', '0.0000', '0.0000', '0', '0', '0', '0.00', 'z2018052020371515268198352373018', '6217681303159530', '范禹繁', 'a2018060313163515280029959141713', '0', null, '1528175161', '1528002438');
INSERT INTO `btc_user_account` VALUES ('b2018060313265415280036142868309', 'a2018060313265415280036142856758', '0.0000', '0.0000', '0', '0', '0', '0.00', 'z2018052020371515268198352373018', '6217681303159530', '王丽容', 'A2018060314254615280071468847374', '0', null, '1528088178', '1528003614');
INSERT INTO `btc_user_account` VALUES ('b2018060417125115281035716235208', 'c2018060417125115281035716226873', '0.0000', '0.0000', '0', '0', '0', '0.00', 'z2018052020371515268198352373018', '6217681303159530', '赵龙', 'c2018060417491915281057593257128', '0', null, '1528176112', '1528103571');
INSERT INTO `btc_user_account` VALUES ('B2018061300202515288204253741651', 'D2018061300202515288204253732655', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1528820425');
INSERT INTO `btc_user_account` VALUES ('B2018061815360115293073612552521', 'q2018061815360115293073612541015', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1529307361');
INSERT INTO `btc_user_account` VALUES ('B2018062509385715298907370583027', 'q2018062509385715298907370574160', '0.0000', '10.0000', '0', '0', '0', '0.00', null, '', '', null, '0', null, null, '1529890737');
INSERT INTO `btc_user_account` VALUES ('B2018062914390515302543458415586', 'c2018062914390515302543458405286', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1530254345');
INSERT INTO `btc_user_account` VALUES ('B2018071217595215313895922324614', 'D2018071217595215313895922312343', '0.0063', '0.0000', '0', '0', '0', '0.00', null, '', '', null, '0', null, null, '1531389592');
INSERT INTO `btc_user_account` VALUES ('B2018071222505615314070569476355', 'A2018071222505615314070569467166', '0.0000', '0.0000', '0', '0', '0', '0.00', 'c2018050923365715258802176788177', '68098028', '林敬祥', 'G2018071323500615314970067889850', '0', null, '1531733725', '1531407056');
INSERT INTO `btc_user_account` VALUES ('b2018071514213715316356977126445', 'q2018071514213715316356977114670', '0.0020', '0.0000', '0', '0', '0', '0.00', 'G2018050923563215258813925010552', '131540089515', '李汶曄', 'D2018071617195615317327963867527', '0', null, '1531735259', '1531635697');
INSERT INTO `btc_user_account` VALUES ('c2018051009160215259149621770029', 'G2018051009160215259149620079921', '0.0000', '0.0000', '0', '0', '0', '0.00', 'A2018050923383715258803178730228', '5465485', '你好', 'D2018051009513815259170985641939', '0', null, '1525917098', '1525914962');
INSERT INTO `btc_user_account` VALUES ('c2018061916335415293972346088415', 'G2018061916335415293972346078597', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1529397234');
INSERT INTO `btc_user_account` VALUES ('c2018062312433815297290188613366', 'H2018062312433815297290188601141', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1529729018');
INSERT INTO `btc_user_account` VALUES ('c2018062417250115298323014715556', 'H2018062417250115298323014695643', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1529832301');
INSERT INTO `btc_user_account` VALUES ('c2018062501035015298598305955330', 'A2018062501035015298598305946564', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1529859830');
INSERT INTO `btc_user_account` VALUES ('c2018071222150615314049060339762', 'a2018071222150615314049060328676', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1531404906');
INSERT INTO `btc_user_account` VALUES ('D2018060320571315280306337382376', 'G2018060320571315280306337373767', '0.0000', '0.0000', '0', '0', '0', '0.00', 'A2018052020345815268196986787122', '6228452380036232916', '中国农业银行河南省商丘市民权支行', '', '0', null, '1528075738', '1528030633');
INSERT INTO `btc_user_account` VALUES ('D2018060414125815280927787969378', 'b2018060414125815280927787957880', '0.0000', '0.0000', '0', '0', '0', '0.00', 'z2018052020371515268198352373018', '6217681303159530', '王丽容', 'z2018060414192715280931670687775', '0', null, '1528178124', '1528092778');
INSERT INTO `btc_user_account` VALUES ('D2018062522390515299375453110642', 'D2018062522390515299375453098002', '0.0000', '0.0000', '0', '0', '0', '0.00', 'A2018052020345815268196986787122', '6228480838890517777', '黄星淇', 'B2018062914585715302555370207614', '0', null, '1536206165', '1529937545');
INSERT INTO `btc_user_account` VALUES ('D2018071115174515312934650711139', 'B2018071115174515312934650701210', '0.0000', '0.0000', '0', '0', '0', '0.00', 'z2018050923551615258813160302405', '04011001021301', '賴佳雯', 'A2018071115242515312938657394971', '0', null, '1531731067', '1531293465');
INSERT INTO `btc_user_account` VALUES ('D2018071217425015313885700343699', 'D2018071217425015313885700332916', '0.0033', '0.0000', '0', '0', '0', '0.00', 'G2018050923563215258813925010552', '473540996311', '張嘉烜', 'z2018071218335715313916377019167', '0', null, '1531410076', '1531388570');
INSERT INTO `btc_user_account` VALUES ('D2018090611234315362042232719449', 'q2018090611234315362042232669474', '1.5500', '0.0000', '0', '0', '10.25', '19800.00', null, '55251818', '小', null, '0', null, null, '1536204223');
INSERT INTO `btc_user_account` VALUES ('G2018060301570315279622236837627', 'c2018060301570315279622236824644', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1527962223');
INSERT INTO `btc_user_account` VALUES ('G2018060717050615283623060360084', 'b2018060717050615283623060351172', '0.0000', '0.0000', '0', '0', '0', '0.00', 'z2018050923364815258802087731016', '466764', '睡觉睡觉', 'q2018060720182415283739042791373', '0', null, '1528373904', '1528362306');
INSERT INTO `btc_user_account` VALUES ('G2018060816492515284477655080791', 'A2018060816492515284477655068427', '0.0000', '4.5000', '0', '0', '1428.58', '0.00', 'z2018052020344515268196854287198', '6217001890002720966', '王丽娟', 'H2018060816583315284483131497605', '0', null, '1531472000', '1528447765');
INSERT INTO `btc_user_account` VALUES ('G2018061223221915288169395714223', 'b2018061223221915288169395701751', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1528816939');
INSERT INTO `btc_user_account` VALUES ('G2018071321035315314870335456679', 'z2018071321035315314870335446208', '0.0000', '0.0000', '0', '0', '0', '0.00', 'A2018050923374415258802649510938', '20813276209', '曾錦琨', 'H2018071516091315316421536112252', '0', null, '1531730074', '1531487033');
INSERT INTO `btc_user_account` VALUES ('H2018051510104015263502407695069', 'B2018051510104015263502407538798', '0.1383', '4.2006', '0', '0', '0', '0.00', 'z2018050920384315258695239267163', '1111111111111111111111', '二哥', 'q2018061516281115290512918349810', '0', null, '1536205559', '1526350240');
INSERT INTO `btc_user_account` VALUES ('H2018051716522515265471450351281', 'H2018051716522515265471450195084', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1526547145');
INSERT INTO `btc_user_account` VALUES ('H2018060314494815280085889470635', 'B2018060314494815280085889461708', '3.3540', '23.0000', '0', '0', '0', '0.00', 'z2018052020371515268198352373018', '6217731102364284', '赵军贺', 'q2018060315060115280095613042991', '0', null, '1528175801', '1528008588');
INSERT INTO `btc_user_account` VALUES ('H2018061221310015288102605768160', 'b2018061221310015288102605757749', '0.0000', '0.0000', '0', '0', '0', '0.00', null, '', '', null, '0', null, '1529233487', '1528810260');
INSERT INTO `btc_user_account` VALUES ('H2018062615000515299964051550792', 'a2018062615000515299964051541616', '0.0000', '0.0000', '0', '0', '0', '0.00', 'A2018050923373115258802514617268', '113506173557', '歐家榮', 'B2018063019111515303570751282108', '0', null, '1531728829', '1529996405');
INSERT INTO `btc_user_account` VALUES ('H2018062723335315301136334860640', 'q2018062723335315301136334851120', '0.0000', '0.0000', '0', '0', '0', '2.22', null, null, null, null, '0', null, null, '1530113633');
INSERT INTO `btc_user_account` VALUES ('H2018070922145315311456936035910', 'G2018070922145315311456936023385', '0.0042', '0.0000', '0', '0', '0', '0.00', 'b2018050923553615258813363257398', '20182720328677', '陳宏韋', 'D2018071110372415312766442276910', '0', null, '1531276644', '1531145693');
INSERT INTO `btc_user_account` VALUES ('H2018071020412515312264856012275', 'B2018071020412515312264856001488', '0.0000', '0.0000', '0', '0', '0', '55.67', 'z2018050923551615258813160302405', '00012220539707', '林軍翰', '', '0', null, '1531741014', '1531226485');
INSERT INTO `btc_user_account` VALUES ('H2018071318341415314780541663663', 'q2018071318341415314780541649927', '0.0025', '0.0000', '0', '0', '0', '0.00', null, '', '', null, '0', null, null, '1531478054');
INSERT INTO `btc_user_account` VALUES ('q2018050922545015258776900946303', 'D2018050922545015258776900852531', '2.0820', '0.0515', '0', '0', '0', '0.00', 'c2018052020384715268199277138613', '62267893939393277', '丽丽', 'A2018052801425415274429746021903', '0', null, '1531233553', '1525877690');
INSERT INTO `btc_user_account` VALUES ('q2018052921374715276010670107403', 'z2018052921374715276010670107453', '0.0000', '0.0000', '0', '0', '0', '0.00', 'z2018052020371515268198352373018', '6217681303159530', '王丽容', 'D2018052922023115276025510205008', '0', null, '1528528422', '1527601067');
INSERT INTO `btc_user_account` VALUES ('z2018060301500715279618077103609', 'A2018060301500715279618077095058', '0.0000', '0.0000', '0', '0', '0', '0.00', null, null, null, null, '0', null, null, '1527961807');
INSERT INTO `btc_user_account` VALUES ('z2018060414352815280941282368262', 'q2018060414352815280941282359801', '0.0000', '0.0000', '0', '0', '0', '0.00', 'a2018052020351715268197174140631', '6212262008017580375', '郑强', 'z2018060414524915280951694273928', '0', null, '1528095169', '1528094128');
INSERT INTO `btc_user_account` VALUES ('z2018062612085515299861355414597', 'c2018062612085515299861355405624', '0.0016', '0.0000', '0', '0', '0', '0.00', 'G2018050923563215258813925010552', '118540464441', '張家銘', '', '0', null, '1531233482', '1529986135');
INSERT INTO `btc_user_account` VALUES ('z2018070923171615311494368925958', 'a2018070923171615311494368916322', '0.0000', '0.0000', '0', '0', '0', '0.00', 'G2018050923563215258813925010552', '129540989106', '陳嘉旭', 'D2018070923375215311506729136232', '0', null, '1531150672', '1531149436');

-- ----------------------------
-- Table structure for btc_user_attach
-- ----------------------------
DROP TABLE IF EXISTS `btc_user_attach`;
CREATE TABLE `btc_user_attach` (
  `attach_id` varchar(32) NOT NULL COMMENT '用户附件ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `file_type` varchar(1) NOT NULL COMMENT '文件类型(1-手持身份证照2-身份证正面3-身份证反面)',
  `file_address` varchar(200) NOT NULL COMMENT '文件地址',
  `create_time` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`attach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户附件表';

-- ----------------------------
-- Records of btc_user_attach
-- ----------------------------
INSERT INTO `btc_user_attach` VALUES ('A2018052814504715274902476305187', 'B2018051510104015263502407538798', '1', '0', '1527490247', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('a2018053015505815276666586914078', 'z2018052921374715276010670107453', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e52f053724.jpg', '1527666658', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('A2018060314274215280072621123007', 'a2018060313265415280036142856758', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b138961bd657.jpg', '1528007262', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('A2018060315185815280103381533913', 'G2018060313071815280024388174332', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b139630cfbe9.jpg', '1528010338', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('a2018060412123115280855511490796', 'G2018060320571315280306337373767', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b1495826005c.jpg', '1528085551', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('a2018060414224215280933625816415', 'b2018060414125815280927787957880', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14d98ba75d5.jpg', '1528093362', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('a2018060414224215280933625816760', 'b2018060414125815280927787957880', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14d96081114.jpg', '1528093362', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('A2018060417481215281056926754538', 'c2018060417125115281035716226873', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b150ab6c4d65.jpg', '1528105692', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('a2018060817005215284484529135100', 'A2018060816492515284477655068427', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-08/5b1a44cf932af.jpg', '1528448452', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('a2018061718352715292317273658717', 'b2018061221310015288102605757749', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-17/5b2638108da39.jpg', '1529231727', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('A2018062514261815299079780709615', 'q2018062509385715298907370574160', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b308adcdfe61.jpg', '1529907978', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('a2018062713440715300782477282878', 'c2018062612085515299861355405624', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-27/5b32ed9870876.jpeg', '1530078247', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('a2018063019484915303593291208683', 'a2018062615000515299964051541616', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-30/5b376c4c1a2a4.jpg', '1530359329', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('A2018071000045115311522911840328', 'a2018070923171615311494368916322', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-09/5b437ff318afb.jpg', '1531152291', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('A2018071115444415312950846904631', 'B2018071115174515312934650701210', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b45b03994993.jpg', '1531295084', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('A2018071115444515312950854239792', 'G2018070922145315311456936023385', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b456ac9d86f1.jpg', '1531295085', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('B2018052801454515274431457799224', 'D2018050922545015258776900852531', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0aee6df16f2.png', '1527443145', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('B2018053000031115276097910283260', 'G2018052623401215273492129960960', '1', '0', '1527609791', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('B2018053000031115276097910283272', 'G2018052623401215273492129960960', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0d798b03197.jpeg', '1527609791', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('b2018053015510015276666600664068', 'z2018052921374715276010670107453', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e51be3f6b5.jpg', '1527666660', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('b2018060314274215280072621122608', 'a2018060313265415280036142856758', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b138979d8188.jpg', '1528007262', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('b2018060315040215280094429500462', 'B2018060314494815280085889461708', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b13922484049.jpg', '1528009442', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('B2018060412123115280855511491103', 'G2018060320571315280306337373767', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b149565b52dc.jpg', '1528085551', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('B2018060415535615280988367003013', 'q2018060414352815280941282359801', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14ef678399e.png', '1528098836', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('B2018062514261815299079780710089', 'q2018062509385715298907370574160', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b308ad231c3f.png', '1529907978', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('B2018063019484915303593291208781', 'a2018062615000515299964051541616', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-30/5b376c5e7cf46.jpg', '1530359329', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('b2018071000045115311522911840560', 'a2018070923171615311494368916322', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-09/5b437fc8ad9b6.jpg', '1531152291', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('b2018071021042415312278640350612', 'B2018071020412515312264856001488', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-10/5b44ae6831a42.jpg', '1531227864', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('b2018071021042415312278640351108', 'B2018071020412515312264856001488', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-10/5b44aca702471.jpg', '1531227864', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('b2018071115444415312950846904560', 'B2018071115174515312934650701210', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b45b01f2ed11.jpg', '1531295084', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('b2018071314305115314634517472679', 'A2018071222505615314070569467166', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-13/5b4836c2686ef.jpg', '1531463451', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('B2018071617260815317331687483609', 'q2018071514213715316356977114670', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-16/5b4c622d5c4b7.JPG', '1531733168', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018060415535615280988367002628', 'q2018060414352815280941282359801', '1', '0', '1528098836', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018060415535615280988367002834', 'q2018060414352815280941282359801', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14ef59932ca.png', '1528098836', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018060817005215284484529135316', 'A2018060816492515284477655068427', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-08/5b1a4491c1f83.jpg', '1528448452', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018060817005215284484529135645', 'A2018060816492515284477655068427', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-08/5b1a44983fe0b.jpg', '1528448452', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018062523342415299408642840959', 'D2018062522390515299375453098002', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b310125a20f8.jpeg', '1529940864', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018071218031615313897966881156', 'D2018071217425015313885700332916', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4726f66e130.jpg', '1531389796', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018071220343615313988764101356', 'D2018071217595215313895922312343', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4747cb7d7c9.jpg', '1531398876', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018071314305115314634517472286', 'A2018071222505615314070569467166', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-13/5b4836d7f1113.jpg', '1531463451', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018071516100915316422097805136', 'z2018071321035315314870335446208', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-15/5b4b0010a495b.jpg', '1531642209', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('c2018071617260815317331687483334', 'q2018071514213715316356977114670', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-16/5b4c6262ba036.JPG', '1531733168', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018052801454515274431457799276', 'D2018050922545015258776900852531', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0aee6233e42.jpg', '1527443145', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018053015505815276666586914023', 'z2018052921374715276010670107453', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e51b085c0b.jpg', '1527666658', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018053015505815276666586914043', 'z2018052921374715276010670107453', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e51be3f6b5.jpg', '1527666658', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018060315040215280094429500770', 'B2018060314494815280085889461708', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b1391fd3ccba.jpg', '1528009442', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018060315185815280103381533548', 'G2018060313071815280024388174332', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b1396480e9fc.jpg', '1528010338', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018060417481215281056926754443', 'c2018060417125115281035716226873', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b150ab0e60e0.jpg', '1528105692', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018071115444415312950846904127', 'B2018071115174515312934650701210', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b45b05730954.jpg', '1531295084', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018071218031615313897966881377', 'D2018071217425015313885700332916', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4726fe8826d.jpg', '1531389796', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018071220343615313988764101029', 'D2018071217595215313895922312343', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b47482cf11db.jpg', '1531398876', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('D2018071617260815317331687483708', 'q2018071514213715316356977114670', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-16/5b4c629fb9cc0.JPG', '1531733168', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('G2018052801454515274431457799264', 'D2018050922545015258776900852531', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0aee94c2f14.png', '1527443145', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('G2018053000031115276097910283254', 'G2018052623401215273492129960960', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0d7999c976b.jpeg', '1527609791', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('G2018061718352715292317273659018', 'b2018061221310015288102605757749', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-17/5b26385beae32.jpg', '1529231727', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('G2018071516100915316422097805397', 'z2018071321035315314870335446208', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-15/5b4b002885db4.jpg', '1531642209', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('H2018053015510015276666600664076', 'z2018052921374715276010670107453', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e51b085c0b.jpg', '1527666660', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('H2018060315185815280103381533774', 'G2018060313071815280024388174332', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b13962ce711a.jpg', '1528010338', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('H2018060412123115280855511490907', 'G2018060320571315280306337373767', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b149557b8628.jpg', '1528085551', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('H2018062523342415299408642841150', 'D2018062522390515299375453098002', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b3100a1ce947.jpeg', '1529940864', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('H2018062713440715300782477283432', 'c2018062612085515299861355405624', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-27/5b32ed9edefe5.jpeg', '1530078247', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('H2018071000045115311522911840737', 'a2018070923171615311494368916322', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-07-09/5b437fb324556.jpg', '1531152291', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('H2018071115444515312950854239319', 'G2018070922145315311456936023385', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b456acda6e52.jpg', '1531295085', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('H2018071218031615313897966880924', 'D2018071217425015313885700332916', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4727079aa93.jpg', '1531389796', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018053015510015276666600664027', 'z2018052921374715276010670107453', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-05-30/5b0e52f053724.jpg', '1527666660', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018060314274215280072621123408', 'a2018060313265415280036142856758', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b13896a174f0.jpg', '1528007262', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018060315040215280094429500644', 'B2018060314494815280085889461708', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-03/5b1391f51975a.jpg', '1528009442', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018060414224215280933625816985', 'b2018060414125815280927787957880', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b14d96900073.jpg', '1528093362', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018060417481215281056926754217', 'c2018060417125115281035716226873', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-04/5b150acaad563.jpg', '1528105692', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018061718352715292317273658456', 'b2018061221310015288102605757749', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-17/5b26381ac3c39.jpg', '1529231727', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018062514261815299079780709850', 'q2018062509385715298907370574160', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b308ac87f85a.jpg', '1529907978', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018062523342415299408642841344', 'D2018062522390515299375453098002', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-06-25/5b3100aa870f4.jpeg', '1529940864', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018062713440715300782477282533', 'c2018062612085515299861355405624', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-27/5b32eda652864.jpeg', '1530078247', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018071115444515312950854239597', 'G2018070922145315311456936023385', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-11/5b456ac4aee33.jpg', '1531295085', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('q2018071516100915316422097804838', 'z2018071321035315314870335446208', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-07-15/5b4b003fbb2ef.jpg', '1531642209', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('z2018052814504715274902476305142', 'B2018051510104015263502407538798', '3', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0ba67036097.png', '1527490247', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('z2018052814504715274902476305162', 'B2018051510104015263502407538798', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-05-28/5b0ba6037ff26.png', '1527490247', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('z2018063019484915303593291208352', 'a2018062615000515299964051541616', '1', 'http://blnance66.com/Uploads/action/IDcard/2018-06-30/5b376ca4d5b57.jpg', '1530359329', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('z2018071021042415312278640350954', 'B2018071020412515312264856001488', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-10/5b44abe72455f.jpg', '1531227864', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('z2018071220343615313988764101271', 'D2018071217595215313895922312343', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-12/5b4747c05aac4.jpg', '1531398876', '0', null, null);
INSERT INTO `btc_user_attach` VALUES ('z2018071314305115314634517472563', 'A2018071222505615314070569467166', '2', 'http://blnance66.com/Uploads/action/IDcard/2018-07-13/5b4836b6c2d58.jpg', '1531463451', '0', null, null);

-- ----------------------------
-- Table structure for btc_user_set
-- ----------------------------
DROP TABLE IF EXISTS `btc_user_set`;
CREATE TABLE `btc_user_set` (
  `seting_id` varchar(32) NOT NULL COMMENT '设置ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户ID',
  `password_hint_one` varchar(255) DEFAULT NULL COMMENT '密码安全问题1',
  `password_hint_two` varchar(255) DEFAULT NULL COMMENT '密码安全问题2',
  `password_hint_three` varchar(255) DEFAULT NULL COMMENT '密码安全问题3',
  `answer_one` varchar(255) DEFAULT NULL COMMENT '问题1的答案',
  `answer_two` varchar(255) DEFAULT NULL COMMENT '问题2的答案',
  `answer_three` varchar(255) DEFAULT NULL COMMENT '问题3的答案',
  `email_login` varchar(1) NOT NULL DEFAULT '1' COMMENT '登录时邮件通知设置0-不通知1-要通知',
  `email_get` varchar(1) NOT NULL DEFAULT '1' COMMENT '发送、接收或支付时，接收邮件通知0-不通知1-要通知',
  `email_buy` varchar(1) NOT NULL DEFAULT '1' COMMENT '买入时邮件通知0-不通知1-已通知',
  `create_time` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`seting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户设置表';

-- ----------------------------
-- Records of btc_user_set
-- ----------------------------
INSERT INTO `btc_user_set` VALUES ('A2018050922545015258776901009767', 'D2018050922545015258776900852531', null, null, null, null, null, null, '1', '1', '1', '1525877690', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('A2018060313071815280024388190949', 'G2018060313071815280024388174332', null, null, null, null, null, null, '1', '1', '1', '1528002438', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('a2018061223221915288169395723430', 'b2018061223221915288169395701751', null, null, null, null, null, null, '1', '1', '1', '1528816939', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('A2018062220475415296716743822658', 'a2018062220475415296716743803960', null, null, null, null, null, null, '1', '1', '1', '1529671674', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('a2018062312433815297290188630914', 'H2018062312433815297290188601141', null, null, null, null, null, null, '1', '1', '1', '1529729018', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('a2018062417250115298323014723483', 'H2018062417250115298323014695643', null, null, null, null, null, null, '1', '1', '1', '1529832301', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('A2018062501035015298598305962633', 'A2018062501035015298598305946564', null, null, null, null, null, null, '1', '1', '1', '1529859830', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('A2018062509385715298907370592715', 'q2018062509385715298907370574160', null, null, null, null, null, null, '1', '1', '1', '1529890737', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('A2018062914390515302543458426275', 'c2018062914390515302543458405286', null, null, null, null, null, null, '1', '1', '1', '1530254345', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('A2018070923171615311494368933306', 'a2018070923171615311494368916322', null, null, null, null, null, null, '1', '1', '1', '1531149436', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('A2018071020412515312264856020569', 'B2018071020412515312264856001488', null, null, null, null, null, null, '1', '1', '1', '1531226485', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('A2018071115174515312934650720694', 'B2018071115174515312934650701210', null, null, null, null, null, null, '1', '1', '1', '1531293465', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('a2018071217595215313895922369881', 'D2018071217595215313895922312343', null, null, null, null, null, null, '1', '1', '1', '1531389592', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('B2018060301500715279618077110848', 'A2018060301500715279618077095058', null, null, null, null, null, null, '1', '1', '1', '1527961807', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('b2018060313265415280036142898362', 'a2018060313265415280036142856758', null, null, null, null, null, null, '1', '1', '1', '1528003614', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('B2018060717050615283623060367023', 'b2018060717050615283623060351172', null, null, null, null, null, null, '1', '1', '1', '1528362306', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('B2018061221310015288102605776285', 'b2018061221310015288102605757749', null, null, null, null, null, null, '0', '0', '0', '1528810260', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('b2018061300202515288204253751701', 'D2018061300202515288204253732655', null, null, null, null, null, null, '1', '1', '1', '1528820425', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('b2018062522390515299375453120220', 'D2018062522390515299375453098002', null, null, null, null, null, null, '1', '1', '1', '1529937545', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('B2018062612085515299861355421443', 'c2018062612085515299861355405624', null, null, null, null, null, null, '1', '1', '1', '1529986135', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('B2018070922145315311456936044874', 'G2018070922145315311456936023385', null, null, null, null, null, null, '1', '1', '1', '1531145693', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('B2018071218310115313914619472869', 'q2018071218310115313914619454603', null, null, null, null, null, null, '1', '1', '1', '1531391461', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('c2018051716522515265471450507523', 'H2018051716522515265471450195084', null, null, null, null, null, null, '1', '1', '1', '1526547145', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('c2018052623401315273492130429639', 'G2018052623401215273492129960960', null, null, null, null, null, null, '1', '1', '1', '1527349212', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('c2018060320571315280306337389234', 'G2018060320571315280306337373767', null, null, null, null, null, null, '1', '1', '1', '1528030633', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('c2018060816492515284477655104268', 'A2018060816492515284477655068427', null, null, null, null, null, null, '0', '0', '1', '1528447765', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('c2018061815360115293073612569898', 'q2018061815360115293073612541015', null, null, null, null, null, null, '1', '1', '1', '1529307361', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('D2018061916335415293972346096539', 'G2018061916335415293972346078597', null, null, null, null, null, null, '1', '1', '1', '1529397234', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('D2018062723335315301136334868048', 'q2018062723335315301136334851120', null, null, null, null, null, null, '1', '1', '1', '1530113633', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('D2018071217425015313885700354526', 'D2018071217425015313885700332916', null, null, null, null, null, null, '0', '0', '0', '1531388570', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('G2018060414125815280927787984826', 'b2018060414125815280927787957880', null, null, null, null, null, null, '1', '1', '1', '1528092778', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('G2018062615000515299964051557816', 'a2018062615000515299964051541616', null, null, null, null, null, null, '1', '1', '1', '1529996405', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('G2018071222150615314049060347857', 'a2018071222150615314049060328676', null, null, null, null, null, null, '1', '1', '1', '1531404906', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('G2018071514213715316356977150639', 'q2018071514213715316356977114670', null, null, null, null, null, null, '1', '1', '1', '1531635697', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('G2018090611234315362042232839431', 'q2018090611234315362042232669474', null, null, null, null, null, null, '1', '1', '1', '1536204223', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('H2018060816311115284466719932285', 'q2018060816311115284466719913088', null, null, null, null, null, null, '1', '1', '1', '1528446671', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('H2018071318341415314780541673904', 'q2018071318341415314780541649927', null, null, null, null, null, null, '1', '1', '1', '1531478054', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('q2018051510104015263502407851252', 'B2018051510104015263502407538798', null, null, null, null, null, null, '1', '1', '1', '1526350240', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('q2018060314494815280085889480252', 'B2018060314494815280085889461708', null, null, null, null, null, null, '1', '1', '1', '1528008588', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('q2018060414352815280941282377175', 'q2018060414352815280941282359801', '我是谁？', '我初中学校在哪里？', '我班主任叫什么？', '狗蛋', '土湖小学', '郑强', '0', '0', '0', '1528094128', '0', null, '1528095811');
INSERT INTO `btc_user_set` VALUES ('q2018060417125115281035716242879', 'c2018060417125115281035716226873', null, null, null, null, null, null, '1', '1', '1', '1528103571', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('q2018061815360915293073698370746', 'a2018061815360915293073698335604', null, null, null, null, null, null, '1', '1', '1', '1529307369', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('q2018071321035315314870335467313', 'z2018071321035315314870335446208', null, null, null, null, null, null, '1', '1', '1', '1531487033', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('z2018051009160215259149622880107', 'G2018051009160215259149620079921', null, null, null, null, null, null, '1', '1', '1', '1525914962', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('z2018052921374715276010670263620', 'z2018052921374715276010670107453', null, null, null, null, null, null, '0', '0', '1', '1527601067', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('z2018060301570315279622236854249', 'c2018060301570315279622236824644', null, null, null, null, null, null, '1', '1', '1', '1527962223', '0', null, null);
INSERT INTO `btc_user_set` VALUES ('z2018071222505615314070569483467', 'A2018071222505615314070569467166', null, null, null, null, null, null, '1', '1', '1', '1531407056', '0', null, null);

-- ----------------------------
-- Table structure for btc_user_wallet_address
-- ----------------------------
DROP TABLE IF EXISTS `btc_user_wallet_address`;
CREATE TABLE `btc_user_wallet_address` (
  `user_wallet_address_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `wallet_address_id` varchar(32) NOT NULL COMMENT '钱包地址id',
  `label` varchar(32) DEFAULT NULL COMMENT '标签',
  `create_time` varchar(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_wallet_address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户钱包地址表';

-- ----------------------------
-- Records of btc_user_wallet_address
-- ----------------------------
INSERT INTO `btc_user_wallet_address` VALUES ('a2018051009160215259149624000159', 'G2018051009160215259149620079921', '10000000000000000000000000000010', null, '1525914962');
INSERT INTO `btc_user_wallet_address` VALUES ('a2018060301570315279622236862762', 'c2018060301570315279622236824644', '10000000000000000000000000000010', null, '1527962223');
INSERT INTO `btc_user_wallet_address` VALUES ('a2018060315192315280103636931604', 'G2018060313071815280024388174332', '10000000000000000000000000000000', null, '1528010363');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018060817455915284511599338820', 'A2018060816492515284477655068427', '10000000000000000000000000000000', null, '1528451159');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018061221310015288102605782903', 'b2018061221310015288102605757749', '10000000000000000000000000000010', null, '1528810260');
INSERT INTO `btc_user_wallet_address` VALUES ('a2018061221324015288103601675834', 'b2018061221310015288102605757749', '10000000000000000000000000000000', null, '1528810360');
INSERT INTO `btc_user_wallet_address` VALUES ('a2018061815360115293073612584862', 'q2018061815360115293073612541015', '10000000000000000000000000000010', null, '1529307361');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018061815360915293073698376935', 'a2018061815360915293073698335604', '10000000000000000000000000000010', null, '1529307369');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018061915390015293939404942670', 'B2018051510104015263502407538798', '10000000000000000000000000000002', null, '1529393940');
INSERT INTO `btc_user_wallet_address` VALUES ('a2018061915390415293939447153703', 'B2018051510104015263502407538798', '10000000000000000000000000000003', null, '1529393944');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018061915390515293939455406390', 'B2018051510104015263502407538798', '10000000000000000000000000000004', null, '1529393945');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018062501035015298598305968522', 'A2018062501035015298598305946564', '10000000000000000000000000000010', null, '1529859830');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018062522390515299375453139656', 'D2018062522390515299375453098002', '10000000000000000000000000000010', null, '1529937545');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018062612085515299861355427200', 'c2018062612085515299861355405624', '10000000000000000000000000000010', null, '1529986135');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018062723335315301136334873872', 'q2018062723335315301136334851120', '10000000000000000000000000000010', null, '1530113633');
INSERT INTO `btc_user_wallet_address` VALUES ('a2018071023191315312359532945169', 'G2018070922145315311456936023385', '10000000000000000000000000000000', null, '1531235953');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018071217425015313885700378200', 'D2018071217425015313885700332916', '10000000000000000000000000000010', null, '1531388570');
INSERT INTO `btc_user_wallet_address` VALUES ('a2018071217595215313895922380568', 'D2018071217595215313895922312343', '10000000000000000000000000000010', null, '1531389592');
INSERT INTO `btc_user_wallet_address` VALUES ('A2018071321035315314870335494277', 'z2018071321035315314870335446208', '10000000000000000000000000000010', null, '1531487033');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018050922595015258779909688058', 'D2018050922545015258776900852531', '10000000000000000000000000000001', null, '1527668413');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018050922595415258779943792156', 'D2018050922545015258776900852531', '10000000000000000000000000000003', null, '1527668451');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018050922595515258779954020259', 'D2018050922545015258776900852531', '10000000000000000000000000000004', null, '1527668477');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018050923000415258780040333277', 'D2018050922545015258776900852531', '10000000000000000000000000000007', null, '1527668552');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018051616245715264590975507546', 'D2018050922545015258776900852531', '10000000000000000000000000000008', null, '1526750093');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018051616252815264591280976287', 'D2018050922545015258776900852531', '10000000000000000000000000000009', null, '1527668343');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018052921374715276010670419985', 'z2018052921374715276010670107453', '10000000000000000000000000000010', null, '1527601067');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018060301500715279618077116541', 'A2018060301500715279618077095058', '10000000000000000000000000000010', null, '1527961807');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018060313071815280024388196873', 'G2018060313071815280024388174332', '10000000000000000000000000000010', null, '1528002438');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018060313265415280036142906916', 'a2018060313265415280036142856758', '10000000000000000000000000000010', null, '1528003614');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018060320571315280306337395583', 'G2018060320571315280306337373767', '10000000000000000000000000000010', null, '1528030633');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018060414125815280927787994023', 'b2018060414125815280927787957880', '10000000000000000000000000000010', null, '1528092778');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018061223221915288169395731210', 'b2018061223221915288169395701751', '10000000000000000000000000000010', null, '1528816939');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018061915391515293939550582833', 'B2018051510104015263502407538798', '10000000000000000000000000000008', null, '1529393955');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018062615014915299965096072855', 'a2018062615000515299964051541616', '10000000000000000000000000000000', null, '1529996509');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018070922145315311456936070597', 'G2018070922145315311456936023385', '10000000000000000000000000000010', null, '1531145693');
INSERT INTO `btc_user_wallet_address` VALUES ('b2018071020412515312264856029360', 'B2018071020412515312264856001488', '10000000000000000000000000000010', null, '1531226485');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018071115293715312941772032494', 'B2018071115174515312934650701210', '10000000000000000000000000000000', null, '1531294177');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018071218062315313899830683989', 'D2018071217595215313895922312343', '10000000000000000000000000000000', null, '1531389983');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018071219434515313958254814844', 'D2018071217425015313885700332916', '10000000000000000000000000000001', null, '1531395825');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018071514213715316356977160321', 'q2018071514213715316356977114670', '10000000000000000000000000000010', null, '1531635697');
INSERT INTO `btc_user_wallet_address` VALUES ('B2018071515590215316415424619386', 'z2018071321035315314870335446208', '10000000000000000000000000000000', null, '1531641542');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018050922595215258779927645311', 'D2018050922545015258776900852531', '10000000000000000000000000000002', null, '1527668432');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018060314474815280084687554922', 'a2018060313265415280036142856758', '10000000000000000000000000000000', null, '1528008468');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018060414352815280941282382779', 'q2018060414352815280941282359801', '10000000000000000000000000000010', null, '1528094128');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018060417125115281035716248939', 'c2018060417125115281035716226873', '10000000000000000000000000000010', null, '1528103571');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018061915391415293939540246436', 'B2018051510104015263502407538798', '10000000000000000000000000000007', null, '1529393954');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018062220475415296716743854855', 'a2018062220475415296716743803960', '10000000000000000000000000000010', null, '1529671674');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018062509385715298907370601217', 'q2018062509385715298907370574160', '10000000000000000000000000000010', null, '1529890737');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018062509565715298918171673663', 'q2018062509385715298907370574160', '10000000000000000000000000000000', null, '1529891817');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018062522425215299377726387308', 'D2018062522390515299375453098002', '10000000000000000000000000000000', null, '1529937772');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018062612092315299861634202544', 'c2018062612085515299861355405624', '10000000000000000000000000000000', null, '1529986163');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018062615000515299964051563584', 'a2018062615000515299964051541616', '10000000000000000000000000000010', null, '1529996405');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018070923171615311494368939647', 'a2018070923171615311494368916322', '10000000000000000000000000000010', null, '1531149436');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018070923184615311495269535868', 'a2018070923171615311494368916322', '10000000000000000000000000000000', null, '1531149526');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018071617053615317319368009219', 'q2018071514213715316356977114670', '10000000000000000000000000000000', null, '1531731936');
INSERT INTO `btc_user_wallet_address` VALUES ('c2018090611234315362042232889492', 'q2018090611234315362042232669474', '10000000000000000000000000000010', null, '1536204223');
INSERT INTO `btc_user_wallet_address` VALUES ('D2018051510104015263502407851236', 'B2018051510104015263502407538798', '10000000000000000000000000000010', null, '1526350240');
INSERT INTO `btc_user_wallet_address` VALUES ('D2018060419194415281111849148229', 'c2018060417125115281035716226873', '10000000000000000000000000000000', null, '1528111184');
INSERT INTO `btc_user_wallet_address` VALUES ('D2018060717050615283623060372763', 'b2018060717050615283623060351172', '10000000000000000000000000000010', null, '1528362306');
INSERT INTO `btc_user_wallet_address` VALUES ('D2018071218331415313915947534292', 'q2018071218310115313914619454603', '10000000000000000000000000000000', null, '1531391594');
INSERT INTO `btc_user_wallet_address` VALUES ('D2018071318453815314787380002077', 'q2018071318341415314780541649927', '10000000000000000000000000000000', null, '1531478738');
INSERT INTO `btc_user_wallet_address` VALUES ('G2018060216414115279289012690687', 'B2018051510104015263502407538798', '10000000000000000000000000000001', null, '1527928901');
INSERT INTO `btc_user_wallet_address` VALUES ('G2018060414255115280935512637494', 'b2018060414125815280927787957880', '10000000000000000000000000000000', null, '1528093551');
INSERT INTO `btc_user_wallet_address` VALUES ('G2018060816311115284466719955078', 'q2018060816311115284466719913088', '10000000000000000000000000000010', null, '1528446671');
INSERT INTO `btc_user_wallet_address` VALUES ('G2018062914390515302543458449965', 'c2018062914390515302543458405286', '10000000000000000000000000000010', null, '1530254345');
INSERT INTO `btc_user_wallet_address` VALUES ('G2018071222150615314049060354496', 'a2018071222150615314049060328676', '10000000000000000000000000000010', null, '1531404906');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018052922044115276026815302775', 'z2018052921374715276010670107453', '10000000000000000000000000000000', null, '1527602681');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018053017153815276717387646486', 'B2018051510104015263502407538798', '10000000000000000000000000000000', null, '1527671738');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018060321010215280308621349981', 'G2018060320571315280306337373767', '10000000000000000000000000000000', null, '1528030862');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018060817460815284511684065785', 'A2018060816492515284477655068427', '10000000000000000000000000000001', null, '1528451168');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018061300202515288204253758024', 'D2018061300202515288204253732655', '10000000000000000000000000000010', null, '1528820425');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018061916364515293974055572571', 'G2018061916335415293972346078597', '10000000000000000000000000000000', null, '1529397405');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018062312433815297290188640025', 'H2018062312433815297290188601141', '10000000000000000000000000000010', null, '1529729018');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018071218310115313914619479787', 'q2018071218310115313914619454603', '10000000000000000000000000000010', null, '1531391461');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018071219124615313939661225154', 'D2018071217425015313885700332916', '10000000000000000000000000000000', null, '1531393966');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018071219441215313958523354058', 'D2018071217425015313885700332916', '10000000000000000000000000000002', null, '1531395852');
INSERT INTO `btc_user_wallet_address` VALUES ('H2018071302003815314184386292788', 'A2018071222505615314070569467166', '10000000000000000000000000000000', null, '1531418438');
INSERT INTO `btc_user_wallet_address` VALUES ('q2018050922594815258779887053389', 'D2018050922545015258776900852531', '10000000000000000000000000000000', null, '1527668391');
INSERT INTO `btc_user_wallet_address` VALUES ('q2018050923000015258780004668688', 'D2018050922545015258776900852531', '10000000000000000000000000000006', null, '1527668541');
INSERT INTO `btc_user_wallet_address` VALUES ('q2018060314494815280085889496054', 'B2018060314494815280085889461708', '10000000000000000000000000000010', null, '1528008588');
INSERT INTO `btc_user_wallet_address` VALUES ('q2018061715523315292219536778641', 'b2018061221310015288102605757749', '10000000000000000000000000000001', null, '1529221953');
INSERT INTO `btc_user_wallet_address` VALUES ('q2018061915391215293939528383423', 'B2018051510104015263502407538798', '10000000000000000000000000000006', null, '1529393952');
INSERT INTO `btc_user_wallet_address` VALUES ('q2018062417250115298323014729458', 'H2018062417250115298323014695643', '10000000000000000000000000000010', null, '1529832301');
INSERT INTO `btc_user_wallet_address` VALUES ('q2018071115174515312934650727354', 'B2018071115174515312934650701210', '10000000000000000000000000000010', null, '1531293465');
INSERT INTO `btc_user_wallet_address` VALUES ('q2018071318341415314780541682388', 'q2018071318341415314780541649927', '10000000000000000000000000000010', null, '1531478054');
INSERT INTO `btc_user_wallet_address` VALUES ('z2018050922545015258776901072433', 'D2018050922545015258776900852531', '10000000000000000000000000000010', null, '1527668363');
INSERT INTO `btc_user_wallet_address` VALUES ('z2018050922595715258779977690933', 'D2018050922545015258776900852531', '10000000000000000000000000000005', null, '1527668505');
INSERT INTO `btc_user_wallet_address` VALUES ('z2018051716522515265471450507517', 'H2018051716522515265471450195084', '10000000000000000000000000000010', null, '1526547145');
INSERT INTO `btc_user_wallet_address` VALUES ('z2018052623401315273492130585958', 'G2018052623401215273492129960960', '10000000000000000000000000000010', null, '1527349212');
INSERT INTO `btc_user_wallet_address` VALUES ('z2018060816492515284477655113417', 'A2018060816492515284477655068427', '10000000000000000000000000000010', null, '1528447765');
INSERT INTO `btc_user_wallet_address` VALUES ('z2018061915390815293939484381245', 'B2018051510104015263502407538798', '10000000000000000000000000000005', null, '1529393948');
INSERT INTO `btc_user_wallet_address` VALUES ('z2018061916335415293972346102710', 'G2018061916335415293972346078597', '10000000000000000000000000000010', null, '1529397234');
INSERT INTO `btc_user_wallet_address` VALUES ('z2018071222505615314070569489243', 'A2018071222505615314070569467166', '10000000000000000000000000000010', null, '1531407056');

-- ----------------------------
-- Table structure for btc_wallet_address
-- ----------------------------
DROP TABLE IF EXISTS `btc_wallet_address`;
CREATE TABLE `btc_wallet_address` (
  `wallet_address_id` varchar(32) NOT NULL COMMENT '钱包地址ID',
  `type` varchar(1) NOT NULL COMMENT '币种类型',
  `address` varchar(50) NOT NULL COMMENT '币种地址',
  `address_url` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(1) DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`wallet_address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='钱包地址表';

-- ----------------------------
-- Records of btc_wallet_address
-- ----------------------------
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000000', '1', '1GgDLwmjy8ERxdSbKKbWCnGVspScnVnMaZ', 'http://blnance66.com/Uploads/static/walletAddress/5b1257858e651.png', '0', null, '1527928712', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000001', '1', '1BApmvWtXtjrvmrTh3gn22gnCjejD2ZAwW', 'http://blnance66.com/Uploads/static/walletAddress/5b1257a7d98f4.png', '0', null, '1527928746', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000002', '1', '1LzGP5cPS9c6bH3r2AVNpiiX1QYiNYCZ3K', 'http://blnance66.com/Uploads/static/walletAddress/5b1257b291709.png', '0', null, '1527928756', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000003', '1', '16u1fSv1eifGzpTzozGVhqAr2hcu7L9xLZ', 'http://blnance66.com/Uploads/static/walletAddress/5b1257be6c3f3.png', '0', null, '1527928768', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000004', '1', '192VGZntWPLkmPwKvtTkpNjH8dwJZPXUhE', 'http://blnance66.com/Uploads/static/walletAddress/5b1257c8c1d97.png', '0', null, '1527928778', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000005', '1', '1PgKQa8erbmUsCXHmhpfWnAGnqRai3EiRT', 'http://blnance66.com/Uploads/static/walletAddress/5b1257d3a3118.png', '0', null, '1527928790', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000006', '1', '145vUV1jnUPmAMnqrLYwvzRCxkQZEojiZo', 'http://blnance66.com/Uploads/static/walletAddress/5b1257df9bbf1.png', '0', null, '1527928802', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000007', '1', '1FeeyiEFU7YaB19yNzmKx536sAWtcz8EhU', 'http://blnance66.com/Uploads/static/walletAddress/5b1257f991784.png', '0', null, '1527928827', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000008', '1', '1CVRXeg2CWLGoJFjGE4EsX8LQFA5Tbh84r', 'http://blnance66.com/Uploads/static/walletAddress/5b125806aa7b8.png', '0', null, '1527928841', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000009', '1', '13LD95jWfHw1Le2Q1LGX7SkFtX8zeYzrga', 'http://blnance66.com/Uploads/static/walletAddress/5b12582b3ced3.png', '0', null, '1527928877', null);
INSERT INTO `btc_wallet_address` VALUES ('10000000000000000000000000000010', '2', '0x3fd440951EAC1fFd538DEDc8d3d6124b9d476976', 'http://blnance66.com/Uploads/static/walletAddress/5b1258370d541.png', '0', null, '1527928889', null);

-- ----------------------------
-- Table structure for btc_w_minlog
-- ----------------------------
DROP TABLE IF EXISTS `btc_w_minlog`;
CREATE TABLE `btc_w_minlog` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(32) DEFAULT NULL COMMENT '用户id',
  `order_id` varchar(20) NOT NULL COMMENT '订单ID',
  `buy_direction` tinyint(1) DEFAULT '0' COMMENT '购买方向 0-涨  1-跌',
  `last_direction` tinyint(1) DEFAULT '-1' COMMENT '最终方向 0-涨 1-跌 -1-未开盘',
  `money` float(20,2) NOT NULL DEFAULT '0.00' COMMENT '购买金额单位 NT$',
  `last_money` float(20,2) DEFAULT '-1.00' COMMENT '最终中奖金额 -1 未开奖  0 未中奖   > 0 中奖',
  `buy_number` int(8) DEFAULT NULL COMMENT '购买期数',
  `buy_time` int(16) DEFAULT NULL COMMENT '购买时间',
  `execute_price` float(16,4) DEFAULT NULL,
  `last_price` float(16,4) DEFAULT NULL,
  `create_time` int(16) DEFAULT NULL COMMENT '创建时间',
  `deleted_time` int(16) DEFAULT NULL,
  PRIMARY KEY (`id`,`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='微盘购买记录';

-- ----------------------------
-- Records of btc_w_minlog
-- ----------------------------
INSERT INTO `btc_w_minlog` VALUES ('20', 'q2018090611234315362042232669474', 'M1541044708', '0', '0', '5000.00', '-1.00', '144', '1551608805', null, null, '1541044708', null);
INSERT INTO `btc_w_minlog` VALUES ('13', 'q2018090611234315362042232669474', 'M1540728025', '0', '0', '200.00', '-1.00', '240', '1551608805', null, null, '1540728064', null);
INSERT INTO `btc_w_minlog` VALUES ('14', 'q2018090611234315362042232669474', 'K1540728064', '0', '0', '200.00', '-1.00', '240', '1551608805', null, null, '1540728064', null);
INSERT INTO `btc_w_minlog` VALUES ('15', 'q2018090611234315362042232669474', 'O1540728215', '0', '0', '1.00', '-1.00', '242', '1551608805', null, null, '1540728215', null);
INSERT INTO `btc_w_minlog` VALUES ('16', 'q2018090611234315362042232669474', 'Z1540728907', '0', '0', '1.00', '1.97', '243', '1551608805', null, null, '1540728907', null);
INSERT INTO `btc_w_minlog` VALUES ('17', 'q2018090611234315362042232669474', 'D1540785934', '0', '0', '200.00', '0.00', '222', '1551608805', '3827.1086', '3827.1282', '1540785934', null);
INSERT INTO `btc_w_minlog` VALUES ('18', 'q2018090611234315362042232669474', 'O1540788678', '0', '1', '200.00', '-1.00', '155', '1551608805', null, null, '1540788678', null);
INSERT INTO `btc_w_minlog` VALUES ('19', 'q2018090611234315362042232669474', 'B1540790086', '1', '1', '200.00', '0.00', '159', '1551608805', null, null, '1540790086', null);
INSERT INTO `btc_w_minlog` VALUES ('21', 'q2018090611234315362042232669474', 'K1541044915', '0', '0', '5000.00', '0.00', '145', '1551608805', null, null, '1541044915', null);
INSERT INTO `btc_w_minlog` VALUES ('22', 'q2018090611234315362042232669474', 'D1541046917', '0', '0', '5000.00', '9850.00', '247', '1551608805', '3821.0952', '3821.1189', '1541046917', null);
INSERT INTO `btc_w_minlog` VALUES ('23', 'q2018090611234315362042232669474', 'Z1546670633', '1', '0', '1000.00', '0.00', '247', '1551608805', '3821.0952', '3821.1189', '1546670633', null);
INSERT INTO `btc_w_minlog` VALUES ('24', 'q2018090611234315362042232669474', 'D1546671174', '1', '-1', '1000.00', '0.00', '134', '1551608805', '3826.1082', '3826.1233', '1546671174', null);
INSERT INTO `btc_w_minlog` VALUES ('25', 'q2018090611234315362042232669474', 'O1546676251', '0', '0', '1000.00', '1970.00', '132', '1551608805', '3810.7241', '3810.7871', '1546676251', null);
INSERT INTO `btc_w_minlog` VALUES ('26', 'q2018090611234315362042232669474', 'Z1546676596', '0', '0', '1000.00', '1970.00', '131', '1551608805', '3814.0376', '3814.0845', '1546676596', null);
INSERT INTO `btc_w_minlog` VALUES ('27', 'q2018090611234315362042232669474', 'M1546677228', '0', '0', '100.00', '197.00', '224', '1551608805', '3825.6187', '3825.6201', '1546677228', null);
INSERT INTO `btc_w_minlog` VALUES ('28', 'q2018090611234315362042232669474', 'K1546677527', '0', '0', '1000.00', '1970.00', '224', '1551608805', '3825.6187', '3825.6201', '1546677527', null);
INSERT INTO `btc_w_minlog` VALUES ('29', 'q2018090611234315362042232669474', 'X1546677708', '0', '0', '1000.00', '1970.00', '225', '1551608805', '3826.1082', '3826.1233', '1546677708', null);
INSERT INTO `btc_w_minlog` VALUES ('30', 'q2018090611234315362042232669474', 'N1551665332', '0', '0', '200.00', '394.00', '122', '1551665332', '3825.5444', '3825.6150', '1551665332', null);
INSERT INTO `btc_w_minlog` VALUES ('31', 'q2018090611234315362042232669474', 'M1551666148', '0', '0', '200.00', '0.00', '125', '1551666148', '3823.4707', '3823.4780', '1551666148', null);
INSERT INTO `btc_w_minlog` VALUES ('32', 'q2018090611234315362042232669474', 'B1551756474', '1', '0', '1000.00', '0.00', '138', '1551756474', '3714.5396', '3714.6106', '1551756474', null);
INSERT INTO `btc_w_minlog` VALUES ('33', 'q2018090611234315362042232669474', 'D1551756763', '0', '0', '500.00', '985.00', '139', '1551756763', '3714.1184', '3714.2058', '1551756763', null);
INSERT INTO `btc_w_minlog` VALUES ('34', 'q2018090611234315362042232669474', 'Z1552025448', '0', '0', '200.00', '394.00', '171', '1552025448', '3892.4221', '3892.4607', '1552025448', null);
INSERT INTO `btc_w_minlog` VALUES ('35', 'q2018090611234315362042232669474', 'X1552121761', '0', '-1', '10.00', '-1.00', '204', '1552121761', null, null, '1552121761', null);
INSERT INTO `btc_w_minlog` VALUES ('36', 'q2018090611234315362042232669474', 'M1552121801', '0', '-1', '16.00', '-1.00', '204', '1552121801', null, null, '1552121801', null);
INSERT INTO `btc_w_minlog` VALUES ('37', 'q2018090611234315362042232669474', 'B1552122928', '0', '-1', '11.00', '-1.00', '208', '1552122928', null, null, '1552122928', null);
INSERT INTO `btc_w_minlog` VALUES ('38', 'q2018090611234315362042232669474', 'Z1552122939', '0', '-1', '70.00', '-1.00', '208', '1552122939', null, null, '1552122939', null);
INSERT INTO `btc_w_minlog` VALUES ('39', 'q2018090611234315362042232669474', 'M1552122946', '1', '-1', '70.00', '-1.00', '208', '1552122946', null, null, '1552122946', null);
INSERT INTO `btc_w_minlog` VALUES ('40', 'q2018090611234315362042232669474', 'B1552123005', '1', '-1', '10.00', '-1.00', '208', '1552123005', null, null, '1552123005', null);
INSERT INTO `btc_w_minlog` VALUES ('41', 'q2018090611234315362042232669474', 'D1552123020', '1', '-1', '20.00', '-1.00', '208', '1552123020', null, null, '1552123020', null);
INSERT INTO `btc_w_minlog` VALUES ('42', 'q2018090611234315362042232669474', 'N1552303914', '0', '0', '1000.00', '1970.00', '235', '1552303914', '3884.6274', '3884.6521', '1552303914', null);
INSERT INTO `btc_w_minlog` VALUES ('43', 'q2018090611234315362042232669474', 'O1552304925', '0', '0', '200.00', '394.00', '238', '1552304925', '3878.0486', '3878.0759', '1552304925', null);
INSERT INTO `btc_w_minlog` VALUES ('44', 'q2018090611234315362042232669474', 'Z1552305352', '0', '0', '4664.00', '8995.00', '240', '1552305352', null, null, '1552305352', null);
INSERT INTO `btc_w_minlog` VALUES ('45', 'q2018090611234315362042232669474', 'N1552465983', '0', '-1', '200.00', '-1.00', '199', '1552465983', null, null, '1552465983', null);

-- ----------------------------
-- Table structure for btc_w_openlog
-- ----------------------------
DROP TABLE IF EXISTS `btc_w_openlog`;
CREATE TABLE `btc_w_openlog` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `last_direction` int(2) unsigned DEFAULT NULL COMMENT '最终方向 0-涨  1-跌',
  `number` int(4) DEFAULT NULL COMMENT '期数',
  `execute_price` float(16,4) DEFAULT NULL COMMENT '执行值',
  `last_price` float(16,4) DEFAULT NULL,
  `create_time` int(16) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COMMENT='微盘开奖记录';

-- ----------------------------
-- Records of btc_w_openlog
-- ----------------------------
INSERT INTO `btc_w_openlog` VALUES ('42', '1', '191', '3825.1599', '3825.0945', '1551599692');
INSERT INTO `btc_w_openlog` VALUES ('68', '0', '122', '3825.5444', '3825.6150', '1551665395');
INSERT INTO `btc_w_openlog` VALUES ('67', '0', '121', '3825.0605', '3825.1338', '1551665098');
INSERT INTO `btc_w_openlog` VALUES ('66', '0', '120', '3824.9053', '3824.9629', '1551664795');
INSERT INTO `btc_w_openlog` VALUES ('65', '0', '119', '3824.5769', '3824.6543', '1551664496');
INSERT INTO `btc_w_openlog` VALUES ('64', '0', '118', '3821.7888', '3821.7898', '1551664196');
INSERT INTO `btc_w_openlog` VALUES ('58', '0', '249', '3819.8591', '3819.9192', '1551617095');
INSERT INTO `btc_w_openlog` VALUES ('57', '0', '248', '3822.4512', '3822.4873', '1551616795');
INSERT INTO `btc_w_openlog` VALUES ('56', '0', '247', '3821.0952', '3821.1189', '1551616495');
INSERT INTO `btc_w_openlog` VALUES ('55', '0', '246', '3819.8381', '3819.8667', '1551616195');
INSERT INTO `btc_w_openlog` VALUES ('54', '0', '245', '3818.4248', '3818.4463', '1551615895');
INSERT INTO `btc_w_openlog` VALUES ('53', '0', '244', '3819.2634', '3819.3411', '1551615595');
INSERT INTO `btc_w_openlog` VALUES ('52', '0', '243', '3818.2446', '3818.3032', '1551615295');
INSERT INTO `btc_w_openlog` VALUES ('51', '0', '242', '3819.6841', '3819.7625', '1551614995');
INSERT INTO `btc_w_openlog` VALUES ('50', '0', '241', '3820.9993', '3821.0823', '1551614695');
INSERT INTO `btc_w_openlog` VALUES ('49', '0', '225', '3826.1082', '3826.1233', '1551609896');
INSERT INTO `btc_w_openlog` VALUES ('48', '0', '224', '3825.6187', '3825.6201', '1551609596');
INSERT INTO `btc_w_openlog` VALUES ('47', '0', '223', '3824.7058', '3824.8020', '1551609296');
INSERT INTO `btc_w_openlog` VALUES ('46', '0', '216', '3823.4556', '3823.5083', '1551607197');
INSERT INTO `btc_w_openlog` VALUES ('45', '0', '215', '3824.6426', '3824.6892', '1551606897');
INSERT INTO `btc_w_openlog` VALUES ('44', '0', '214', '3827.1086', '3827.1282', '1551606595');
INSERT INTO `btc_w_openlog` VALUES ('43', '0', '213', '3826.4858', '3826.5022', '1551606297');
INSERT INTO `btc_w_openlog` VALUES ('59', '0', '250', '3820.0850', '3820.1414', '1551617395');
INSERT INTO `btc_w_openlog` VALUES ('60', '0', '251', '3822.8481', '3822.8694', '1551617696');
INSERT INTO `btc_w_openlog` VALUES ('73', '0', '127', '3822.0005', '3822.0178', '1551666896');
INSERT INTO `btc_w_openlog` VALUES ('63', '0', '117', '3823.6914', '3823.7229', '1551663895');
INSERT INTO `btc_w_openlog` VALUES ('72', '0', '126', '3822.7722', '3822.8557', '1551666595');
INSERT INTO `btc_w_openlog` VALUES ('71', '0', '125', '3823.4707', '3823.4780', '1551666295');
INSERT INTO `btc_w_openlog` VALUES ('70', '0', '124', '3823.2146', '3823.2949', '1551665995');
INSERT INTO `btc_w_openlog` VALUES ('69', '0', '123', '3823.1025', '3823.1372', '1551665695');
INSERT INTO `btc_w_openlog` VALUES ('61', '0', '252', '3821.6836', '3821.6997', '1551617996');
INSERT INTO `btc_w_openlog` VALUES ('74', '1', '128', '3816.1814', '3816.1699', '1551667195');
INSERT INTO `btc_w_openlog` VALUES ('75', '0', '129', '3813.3877', '3813.4497', '1551667498');
INSERT INTO `btc_w_openlog` VALUES ('76', '0', '130', '3817.2495', '3817.3125', '1551667795');
INSERT INTO `btc_w_openlog` VALUES ('77', '0', '131', '3814.0376', '3814.0845', '1551668096');
INSERT INTO `btc_w_openlog` VALUES ('78', '0', '132', '3810.7241', '3810.7871', '1551668395');
INSERT INTO `btc_w_openlog` VALUES ('79', '0', '134', '3812.1060', '3812.1338', '1551668995');
INSERT INTO `btc_w_openlog` VALUES ('80', '0', '135', '3806.6924', '3806.7832', '1551669295');
INSERT INTO `btc_w_openlog` VALUES ('81', '0', '136', '3804.7712', '3804.7793', '1551669596');
INSERT INTO `btc_w_openlog` VALUES ('62', '0', '116', '3823.3894', '3823.4116', '1551663596');
INSERT INTO `btc_w_openlog` VALUES ('41', '0', '190', '3827.0454', '3828.0945', '1551599390');
INSERT INTO `btc_w_openlog` VALUES ('82', '0', '137', '3801.3643', '3801.4229', '1551669898');
INSERT INTO `btc_w_openlog` VALUES ('83', '0', '138', '3798.9602', '3799.0337', '1551670197');
INSERT INTO `btc_w_openlog` VALUES ('84', '0', '139', '3793.4961', '3793.5452', '1551670496');
INSERT INTO `btc_w_openlog` VALUES ('85', '0', '187', '3742.1484', '3742.2043', '1551684895');
INSERT INTO `btc_w_openlog` VALUES ('86', '0', '188', '3740.2175', '3740.2732', '1551685195');
INSERT INTO `btc_w_openlog` VALUES ('87', '0', '199', '3725.1694', '3725.2273', '1551688496');
INSERT INTO `btc_w_openlog` VALUES ('88', '0', '200', '3730.0488', '3730.1084', '1551688796');
INSERT INTO `btc_w_openlog` VALUES ('89', '0', '138', '3714.5396', '3714.6106', '1551756595');
INSERT INTO `btc_w_openlog` VALUES ('90', '0', '139', '3714.1184', '3714.2058', '1551756896');
INSERT INTO `btc_w_openlog` VALUES ('91', '0', '140', '3711.4041', '3711.4431', '1551757195');
INSERT INTO `btc_w_openlog` VALUES ('92', '0', '170', '3892.4502', '3892.5229', '1552025397');
INSERT INTO `btc_w_openlog` VALUES ('93', '0', '171', '3892.4221', '3892.4607', '1552025695');
INSERT INTO `btc_w_openlog` VALUES ('94', '0', '175', '3894.9568', '3894.9741', '1552286095');
INSERT INTO `btc_w_openlog` VALUES ('95', '0', '176', '3894.6904', '3894.7634', '1552286395');
INSERT INTO `btc_w_openlog` VALUES ('96', '0', '177', '3890.4885', '3890.5220', '1552286695');
INSERT INTO `btc_w_openlog` VALUES ('97', '0', '179', '3897.5562', '3897.5747', '1552287295');
INSERT INTO `btc_w_openlog` VALUES ('98', '0', '180', '3899.0569', '3899.1450', '1552287595');
INSERT INTO `btc_w_openlog` VALUES ('99', '0', '181', '3898.2922', '3898.3506', '1552287895');
INSERT INTO `btc_w_openlog` VALUES ('100', '0', '182', '3901.7239', '3901.7837', '1552288195');
INSERT INTO `btc_w_openlog` VALUES ('101', '0', '183', '3899.4536', '3899.5220', '1552288496');
INSERT INTO `btc_w_openlog` VALUES ('102', '0', '184', '3900.1052', '3900.2019', '1552288795');
INSERT INTO `btc_w_openlog` VALUES ('103', '0', '185', '3895.8923', '3895.9265', '1552289095');
INSERT INTO `btc_w_openlog` VALUES ('104', '0', '186', '3894.6414', '3894.6785', '1552289395');
INSERT INTO `btc_w_openlog` VALUES ('105', '0', '187', '3895.5642', '3895.6514', '1552289695');
INSERT INTO `btc_w_openlog` VALUES ('106', '0', '188', '3891.1240', '3891.2134', '1552289995');
INSERT INTO `btc_w_openlog` VALUES ('107', '0', '189', '3892.6089', '3892.6252', '1552290295');
INSERT INTO `btc_w_openlog` VALUES ('108', '0', '235', '3884.6274', '3884.6521', '1552304096');
INSERT INTO `btc_w_openlog` VALUES ('109', '0', '236', '3879.2810', '3879.3533', '1552304395');
INSERT INTO `btc_w_openlog` VALUES ('110', '0', '237', '3879.7197', '3879.7778', '1552304695');
INSERT INTO `btc_w_openlog` VALUES ('111', '0', '238', '3878.0486', '3878.0759', '1552304995');
INSERT INTO `btc_w_openlog` VALUES ('112', '0', '239', '3875.2488', '3875.3250', '1552305296');

-- ----------------------------
-- Table structure for btc_w_openset
-- ----------------------------
DROP TABLE IF EXISTS `btc_w_openset`;
CREATE TABLE `btc_w_openset` (
  `number` int(4) unsigned NOT NULL COMMENT '期数：一天288期',
  `set` tinyint(1) NOT NULL DEFAULT '0' COMMENT '设置开盘涨/跌 0-涨 1-跌',
  PRIMARY KEY (`number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='开盘设置';

-- ----------------------------
-- Records of btc_w_openset
-- ----------------------------
INSERT INTO `btc_w_openset` VALUES ('1', '1');
INSERT INTO `btc_w_openset` VALUES ('2', '0');
INSERT INTO `btc_w_openset` VALUES ('3', '1');
INSERT INTO `btc_w_openset` VALUES ('4', '0');
INSERT INTO `btc_w_openset` VALUES ('5', '1');
INSERT INTO `btc_w_openset` VALUES ('6', '0');
INSERT INTO `btc_w_openset` VALUES ('7', '1');
INSERT INTO `btc_w_openset` VALUES ('8', '0');
INSERT INTO `btc_w_openset` VALUES ('9', '1');
INSERT INTO `btc_w_openset` VALUES ('10', '1');
INSERT INTO `btc_w_openset` VALUES ('11', '0');
INSERT INTO `btc_w_openset` VALUES ('12', '1');
INSERT INTO `btc_w_openset` VALUES ('13', '1');
INSERT INTO `btc_w_openset` VALUES ('14', '1');
INSERT INTO `btc_w_openset` VALUES ('15', '0');
INSERT INTO `btc_w_openset` VALUES ('16', '0');
INSERT INTO `btc_w_openset` VALUES ('17', '0');
INSERT INTO `btc_w_openset` VALUES ('18', '0');
INSERT INTO `btc_w_openset` VALUES ('19', '0');
INSERT INTO `btc_w_openset` VALUES ('20', '0');
INSERT INTO `btc_w_openset` VALUES ('21', '0');
INSERT INTO `btc_w_openset` VALUES ('22', '0');
INSERT INTO `btc_w_openset` VALUES ('23', '0');
INSERT INTO `btc_w_openset` VALUES ('24', '0');
INSERT INTO `btc_w_openset` VALUES ('25', '0');
INSERT INTO `btc_w_openset` VALUES ('26', '0');
INSERT INTO `btc_w_openset` VALUES ('27', '0');
INSERT INTO `btc_w_openset` VALUES ('28', '1');
INSERT INTO `btc_w_openset` VALUES ('29', '0');
INSERT INTO `btc_w_openset` VALUES ('30', '0');
INSERT INTO `btc_w_openset` VALUES ('31', '1');
INSERT INTO `btc_w_openset` VALUES ('32', '0');
INSERT INTO `btc_w_openset` VALUES ('33', '0');
INSERT INTO `btc_w_openset` VALUES ('34', '0');
INSERT INTO `btc_w_openset` VALUES ('35', '0');
INSERT INTO `btc_w_openset` VALUES ('36', '0');
INSERT INTO `btc_w_openset` VALUES ('37', '0');
INSERT INTO `btc_w_openset` VALUES ('38', '0');
INSERT INTO `btc_w_openset` VALUES ('39', '0');
INSERT INTO `btc_w_openset` VALUES ('40', '0');
INSERT INTO `btc_w_openset` VALUES ('41', '0');
INSERT INTO `btc_w_openset` VALUES ('42', '0');
INSERT INTO `btc_w_openset` VALUES ('43', '0');
INSERT INTO `btc_w_openset` VALUES ('44', '0');
INSERT INTO `btc_w_openset` VALUES ('45', '0');
INSERT INTO `btc_w_openset` VALUES ('46', '0');
INSERT INTO `btc_w_openset` VALUES ('47', '0');
INSERT INTO `btc_w_openset` VALUES ('48', '0');
INSERT INTO `btc_w_openset` VALUES ('49', '0');
INSERT INTO `btc_w_openset` VALUES ('50', '0');
INSERT INTO `btc_w_openset` VALUES ('51', '0');
INSERT INTO `btc_w_openset` VALUES ('52', '0');
INSERT INTO `btc_w_openset` VALUES ('53', '0');
INSERT INTO `btc_w_openset` VALUES ('54', '0');
INSERT INTO `btc_w_openset` VALUES ('55', '0');
INSERT INTO `btc_w_openset` VALUES ('56', '0');
INSERT INTO `btc_w_openset` VALUES ('57', '0');
INSERT INTO `btc_w_openset` VALUES ('58', '0');
INSERT INTO `btc_w_openset` VALUES ('59', '0');
INSERT INTO `btc_w_openset` VALUES ('60', '0');
INSERT INTO `btc_w_openset` VALUES ('61', '0');
INSERT INTO `btc_w_openset` VALUES ('62', '0');
INSERT INTO `btc_w_openset` VALUES ('63', '0');
INSERT INTO `btc_w_openset` VALUES ('64', '0');
INSERT INTO `btc_w_openset` VALUES ('65', '0');
INSERT INTO `btc_w_openset` VALUES ('66', '0');
INSERT INTO `btc_w_openset` VALUES ('67', '0');
INSERT INTO `btc_w_openset` VALUES ('68', '0');
INSERT INTO `btc_w_openset` VALUES ('69', '1');
INSERT INTO `btc_w_openset` VALUES ('70', '0');
INSERT INTO `btc_w_openset` VALUES ('71', '0');
INSERT INTO `btc_w_openset` VALUES ('72', '0');
INSERT INTO `btc_w_openset` VALUES ('73', '0');
INSERT INTO `btc_w_openset` VALUES ('74', '0');
INSERT INTO `btc_w_openset` VALUES ('75', '0');
INSERT INTO `btc_w_openset` VALUES ('76', '0');
INSERT INTO `btc_w_openset` VALUES ('77', '0');
INSERT INTO `btc_w_openset` VALUES ('78', '0');
INSERT INTO `btc_w_openset` VALUES ('79', '0');
INSERT INTO `btc_w_openset` VALUES ('80', '0');
INSERT INTO `btc_w_openset` VALUES ('81', '0');
INSERT INTO `btc_w_openset` VALUES ('82', '0');
INSERT INTO `btc_w_openset` VALUES ('83', '1');
INSERT INTO `btc_w_openset` VALUES ('84', '0');
INSERT INTO `btc_w_openset` VALUES ('85', '0');
INSERT INTO `btc_w_openset` VALUES ('86', '0');
INSERT INTO `btc_w_openset` VALUES ('87', '0');
INSERT INTO `btc_w_openset` VALUES ('88', '0');
INSERT INTO `btc_w_openset` VALUES ('89', '0');
INSERT INTO `btc_w_openset` VALUES ('90', '0');
INSERT INTO `btc_w_openset` VALUES ('91', '0');
INSERT INTO `btc_w_openset` VALUES ('92', '0');
INSERT INTO `btc_w_openset` VALUES ('93', '1');
INSERT INTO `btc_w_openset` VALUES ('94', '0');
INSERT INTO `btc_w_openset` VALUES ('95', '0');
INSERT INTO `btc_w_openset` VALUES ('96', '0');
INSERT INTO `btc_w_openset` VALUES ('97', '0');
INSERT INTO `btc_w_openset` VALUES ('98', '0');
INSERT INTO `btc_w_openset` VALUES ('99', '0');
INSERT INTO `btc_w_openset` VALUES ('100', '0');
INSERT INTO `btc_w_openset` VALUES ('101', '0');
INSERT INTO `btc_w_openset` VALUES ('102', '0');
INSERT INTO `btc_w_openset` VALUES ('103', '0');
INSERT INTO `btc_w_openset` VALUES ('104', '0');
INSERT INTO `btc_w_openset` VALUES ('105', '0');
INSERT INTO `btc_w_openset` VALUES ('106', '0');
INSERT INTO `btc_w_openset` VALUES ('107', '0');
INSERT INTO `btc_w_openset` VALUES ('108', '0');
INSERT INTO `btc_w_openset` VALUES ('109', '0');
INSERT INTO `btc_w_openset` VALUES ('110', '0');
INSERT INTO `btc_w_openset` VALUES ('111', '0');
INSERT INTO `btc_w_openset` VALUES ('112', '0');
INSERT INTO `btc_w_openset` VALUES ('113', '0');
INSERT INTO `btc_w_openset` VALUES ('114', '0');
INSERT INTO `btc_w_openset` VALUES ('115', '0');
INSERT INTO `btc_w_openset` VALUES ('116', '0');
INSERT INTO `btc_w_openset` VALUES ('117', '0');
INSERT INTO `btc_w_openset` VALUES ('118', '0');
INSERT INTO `btc_w_openset` VALUES ('119', '0');
INSERT INTO `btc_w_openset` VALUES ('120', '0');
INSERT INTO `btc_w_openset` VALUES ('121', '0');
INSERT INTO `btc_w_openset` VALUES ('122', '0');
INSERT INTO `btc_w_openset` VALUES ('123', '0');
INSERT INTO `btc_w_openset` VALUES ('124', '0');
INSERT INTO `btc_w_openset` VALUES ('125', '0');
INSERT INTO `btc_w_openset` VALUES ('126', '0');
INSERT INTO `btc_w_openset` VALUES ('127', '0');
INSERT INTO `btc_w_openset` VALUES ('128', '1');
INSERT INTO `btc_w_openset` VALUES ('129', '0');
INSERT INTO `btc_w_openset` VALUES ('130', '0');
INSERT INTO `btc_w_openset` VALUES ('131', '0');
INSERT INTO `btc_w_openset` VALUES ('132', '0');
INSERT INTO `btc_w_openset` VALUES ('133', '0');
INSERT INTO `btc_w_openset` VALUES ('134', '0');
INSERT INTO `btc_w_openset` VALUES ('135', '0');
INSERT INTO `btc_w_openset` VALUES ('136', '0');
INSERT INTO `btc_w_openset` VALUES ('137', '0');
INSERT INTO `btc_w_openset` VALUES ('138', '0');
INSERT INTO `btc_w_openset` VALUES ('139', '0');
INSERT INTO `btc_w_openset` VALUES ('140', '0');
INSERT INTO `btc_w_openset` VALUES ('141', '0');
INSERT INTO `btc_w_openset` VALUES ('142', '0');
INSERT INTO `btc_w_openset` VALUES ('143', '0');
INSERT INTO `btc_w_openset` VALUES ('144', '0');
INSERT INTO `btc_w_openset` VALUES ('145', '0');
INSERT INTO `btc_w_openset` VALUES ('146', '0');
INSERT INTO `btc_w_openset` VALUES ('147', '0');
INSERT INTO `btc_w_openset` VALUES ('148', '0');
INSERT INTO `btc_w_openset` VALUES ('149', '0');
INSERT INTO `btc_w_openset` VALUES ('150', '0');
INSERT INTO `btc_w_openset` VALUES ('151', '0');
INSERT INTO `btc_w_openset` VALUES ('152', '0');
INSERT INTO `btc_w_openset` VALUES ('153', '0');
INSERT INTO `btc_w_openset` VALUES ('154', '0');
INSERT INTO `btc_w_openset` VALUES ('155', '1');
INSERT INTO `btc_w_openset` VALUES ('156', '0');
INSERT INTO `btc_w_openset` VALUES ('157', '1');
INSERT INTO `btc_w_openset` VALUES ('158', '0');
INSERT INTO `btc_w_openset` VALUES ('159', '1');
INSERT INTO `btc_w_openset` VALUES ('160', '0');
INSERT INTO `btc_w_openset` VALUES ('161', '1');
INSERT INTO `btc_w_openset` VALUES ('162', '0');
INSERT INTO `btc_w_openset` VALUES ('163', '0');
INSERT INTO `btc_w_openset` VALUES ('164', '0');
INSERT INTO `btc_w_openset` VALUES ('165', '0');
INSERT INTO `btc_w_openset` VALUES ('166', '0');
INSERT INTO `btc_w_openset` VALUES ('167', '0');
INSERT INTO `btc_w_openset` VALUES ('168', '0');
INSERT INTO `btc_w_openset` VALUES ('169', '0');
INSERT INTO `btc_w_openset` VALUES ('170', '0');
INSERT INTO `btc_w_openset` VALUES ('171', '0');
INSERT INTO `btc_w_openset` VALUES ('172', '0');
INSERT INTO `btc_w_openset` VALUES ('173', '0');
INSERT INTO `btc_w_openset` VALUES ('174', '0');
INSERT INTO `btc_w_openset` VALUES ('175', '0');
INSERT INTO `btc_w_openset` VALUES ('176', '0');
INSERT INTO `btc_w_openset` VALUES ('177', '0');
INSERT INTO `btc_w_openset` VALUES ('178', '0');
INSERT INTO `btc_w_openset` VALUES ('179', '0');
INSERT INTO `btc_w_openset` VALUES ('180', '0');
INSERT INTO `btc_w_openset` VALUES ('181', '0');
INSERT INTO `btc_w_openset` VALUES ('182', '0');
INSERT INTO `btc_w_openset` VALUES ('183', '0');
INSERT INTO `btc_w_openset` VALUES ('184', '0');
INSERT INTO `btc_w_openset` VALUES ('185', '0');
INSERT INTO `btc_w_openset` VALUES ('186', '0');
INSERT INTO `btc_w_openset` VALUES ('187', '0');
INSERT INTO `btc_w_openset` VALUES ('188', '0');
INSERT INTO `btc_w_openset` VALUES ('189', '0');
INSERT INTO `btc_w_openset` VALUES ('190', '0');
INSERT INTO `btc_w_openset` VALUES ('191', '1');
INSERT INTO `btc_w_openset` VALUES ('192', '1');
INSERT INTO `btc_w_openset` VALUES ('193', '0');
INSERT INTO `btc_w_openset` VALUES ('194', '0');
INSERT INTO `btc_w_openset` VALUES ('195', '0');
INSERT INTO `btc_w_openset` VALUES ('196', '0');
INSERT INTO `btc_w_openset` VALUES ('197', '0');
INSERT INTO `btc_w_openset` VALUES ('198', '0');
INSERT INTO `btc_w_openset` VALUES ('199', '0');
INSERT INTO `btc_w_openset` VALUES ('200', '0');
INSERT INTO `btc_w_openset` VALUES ('201', '0');
INSERT INTO `btc_w_openset` VALUES ('202', '0');
INSERT INTO `btc_w_openset` VALUES ('203', '0');
INSERT INTO `btc_w_openset` VALUES ('204', '0');
INSERT INTO `btc_w_openset` VALUES ('205', '0');
INSERT INTO `btc_w_openset` VALUES ('206', '0');
INSERT INTO `btc_w_openset` VALUES ('207', '0');
INSERT INTO `btc_w_openset` VALUES ('208', '0');
INSERT INTO `btc_w_openset` VALUES ('209', '0');
INSERT INTO `btc_w_openset` VALUES ('210', '0');
INSERT INTO `btc_w_openset` VALUES ('211', '0');
INSERT INTO `btc_w_openset` VALUES ('212', '0');
INSERT INTO `btc_w_openset` VALUES ('213', '0');
INSERT INTO `btc_w_openset` VALUES ('214', '0');
INSERT INTO `btc_w_openset` VALUES ('215', '0');
INSERT INTO `btc_w_openset` VALUES ('216', '0');
INSERT INTO `btc_w_openset` VALUES ('217', '0');
INSERT INTO `btc_w_openset` VALUES ('218', '0');
INSERT INTO `btc_w_openset` VALUES ('219', '0');
INSERT INTO `btc_w_openset` VALUES ('220', '0');
INSERT INTO `btc_w_openset` VALUES ('221', '0');
INSERT INTO `btc_w_openset` VALUES ('222', '0');
INSERT INTO `btc_w_openset` VALUES ('223', '0');
INSERT INTO `btc_w_openset` VALUES ('224', '0');
INSERT INTO `btc_w_openset` VALUES ('225', '0');
INSERT INTO `btc_w_openset` VALUES ('226', '0');
INSERT INTO `btc_w_openset` VALUES ('227', '1');
INSERT INTO `btc_w_openset` VALUES ('228', '0');
INSERT INTO `btc_w_openset` VALUES ('229', '0');
INSERT INTO `btc_w_openset` VALUES ('230', '0');
INSERT INTO `btc_w_openset` VALUES ('231', '0');
INSERT INTO `btc_w_openset` VALUES ('232', '0');
INSERT INTO `btc_w_openset` VALUES ('233', '0');
INSERT INTO `btc_w_openset` VALUES ('234', '0');
INSERT INTO `btc_w_openset` VALUES ('235', '0');
INSERT INTO `btc_w_openset` VALUES ('236', '0');
INSERT INTO `btc_w_openset` VALUES ('237', '0');
INSERT INTO `btc_w_openset` VALUES ('238', '0');
INSERT INTO `btc_w_openset` VALUES ('239', '0');
INSERT INTO `btc_w_openset` VALUES ('240', '0');
INSERT INTO `btc_w_openset` VALUES ('241', '0');
INSERT INTO `btc_w_openset` VALUES ('242', '0');
INSERT INTO `btc_w_openset` VALUES ('243', '0');
INSERT INTO `btc_w_openset` VALUES ('244', '0');
INSERT INTO `btc_w_openset` VALUES ('245', '0');
INSERT INTO `btc_w_openset` VALUES ('246', '0');
INSERT INTO `btc_w_openset` VALUES ('247', '0');
INSERT INTO `btc_w_openset` VALUES ('248', '0');
INSERT INTO `btc_w_openset` VALUES ('249', '0');
INSERT INTO `btc_w_openset` VALUES ('250', '0');
INSERT INTO `btc_w_openset` VALUES ('251', '0');
INSERT INTO `btc_w_openset` VALUES ('252', '0');
INSERT INTO `btc_w_openset` VALUES ('253', '0');
INSERT INTO `btc_w_openset` VALUES ('254', '0');
INSERT INTO `btc_w_openset` VALUES ('255', '0');
INSERT INTO `btc_w_openset` VALUES ('256', '0');
INSERT INTO `btc_w_openset` VALUES ('257', '0');
INSERT INTO `btc_w_openset` VALUES ('258', '0');
INSERT INTO `btc_w_openset` VALUES ('259', '0');
INSERT INTO `btc_w_openset` VALUES ('260', '0');
INSERT INTO `btc_w_openset` VALUES ('261', '0');
INSERT INTO `btc_w_openset` VALUES ('262', '0');
INSERT INTO `btc_w_openset` VALUES ('263', '0');
INSERT INTO `btc_w_openset` VALUES ('264', '0');
INSERT INTO `btc_w_openset` VALUES ('265', '0');
INSERT INTO `btc_w_openset` VALUES ('266', '0');
INSERT INTO `btc_w_openset` VALUES ('267', '0');
INSERT INTO `btc_w_openset` VALUES ('268', '0');
INSERT INTO `btc_w_openset` VALUES ('269', '0');
INSERT INTO `btc_w_openset` VALUES ('270', '0');
INSERT INTO `btc_w_openset` VALUES ('271', '0');
INSERT INTO `btc_w_openset` VALUES ('272', '0');
INSERT INTO `btc_w_openset` VALUES ('273', '0');
INSERT INTO `btc_w_openset` VALUES ('274', '0');
INSERT INTO `btc_w_openset` VALUES ('275', '0');
INSERT INTO `btc_w_openset` VALUES ('276', '0');
INSERT INTO `btc_w_openset` VALUES ('277', '0');
INSERT INTO `btc_w_openset` VALUES ('278', '0');
INSERT INTO `btc_w_openset` VALUES ('279', '0');
INSERT INTO `btc_w_openset` VALUES ('280', '0');
INSERT INTO `btc_w_openset` VALUES ('281', '0');
INSERT INTO `btc_w_openset` VALUES ('282', '1');
INSERT INTO `btc_w_openset` VALUES ('283', '0');
INSERT INTO `btc_w_openset` VALUES ('284', '0');
INSERT INTO `btc_w_openset` VALUES ('285', '0');
INSERT INTO `btc_w_openset` VALUES ('286', '0');
INSERT INTO `btc_w_openset` VALUES ('287', '0');
INSERT INTO `btc_w_openset` VALUES ('288', '0');

-- ----------------------------
-- Table structure for btc_w_set
-- ----------------------------
DROP TABLE IF EXISTS `btc_w_set`;
CREATE TABLE `btc_w_set` (
  `id` int(4) unsigned NOT NULL,
  `set` tinyint(1) DEFAULT '0' COMMENT '0-表示开盘  1-表示休盘',
  `odds_set` float(5,2) DEFAULT '0.00' COMMENT '赔率设置',
  `last` float(16,4) DEFAULT '0.0000' COMMENT '最终价格',
  `open` float(16,4) DEFAULT '0.0000' COMMENT '开盘',
  `low` float(16,4) DEFAULT '0.0000' COMMENT '最低',
  `high` float(16,4) DEFAULT '0.0000' COMMENT '最高',
  `execute_price` float(16,4) DEFAULT NULL COMMENT '执行价格',
  `last_price` float(16,4) DEFAULT NULL COMMENT '成交价格',
  `update_time` int(16) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微盘设置';

-- ----------------------------
-- Records of btc_w_set
-- ----------------------------
INSERT INTO `btc_w_set` VALUES ('1', '0', '1.97', '3829.4958', '3829.8999', '3812.0100', '3935.4099', '3875.2488', '3875.3250', '1552362110');
