<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://blnance66.com/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://blnance66.com/Public/css/xy.css" />
    <link rel="stylesheet" type="text/css" href="http://blnance66.com/Public/plug-in/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/xadmin.css" />

	<script type="text/javascript" src="http://blnance66.com/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://blnance66.com/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/plug-in/layui/layui.js"></script>
	<script type="text/javascript" src="http://blnance66.com/Public/js/xadmin.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/config.js"></script>
    <script type="text/javascript" src="http://blnance66.com/Public/js/function.js"></script>
    

	<!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>






<style>
    .xy-body {
        width: 100%;
        height: 230px !important;
    }
    .layui-carousel {
        width: 400px !important;
        height: 230px !important;
        margin-left: 40px !important;
    }
</style>

<body class="xy-body">

    <!-- 轮播图管理 -->
    <div class="layui-carousel" id="slideshow" lay-filter="slideshow">
        <div carousel-item class="xy-icon-add" id="banner">
            <img style="width: 100%; height: 100%;" />
            <img style="width: 100%; height: 100%;" />
            <img style="width: 100%; height: 100%;" />
        </div>
    </div>

    <script>
        // 创建实例
        var app = new Vue({
            el: "#slideshow",
            data: {
                f_status_url: '',
                hand_status_url: '',
                r_status_url: ''
            },
            created: function() {
                this.getSlideShow();
                this.setSlideshow();
            },
            methods: {
                // 设置轮播
                setSlideshow: function() {
                    var that = this;

                    layui.use(['carousel', 'form'], function() {
                        var carousel = layui.carousel,
                            form = layui.form;

                        //常规轮播
                        carousel.render({
                            elem: '#slideshow',
                            arrow: 'always',
                            autoplay: false,
                            trigger: 'click',
                            width: '40%',
                            height: '60%',
                        });
                    });
                },

                // 获取数据
                getSlideShow: function() {
                    var param = this.getRequest();
                    var url = "http://blnance66.com/Admin/getAttestInfo";
                    var self = this;
                    var data = {
                        authentication_id: param.id
                    };
                    console.log(data);

                    $.ajax({
                        url: url,
                        data: data,
                        type: 'post',
                        success: function(res) {
                            console.log(res);

                            $("#banner>img:nth-child(1)").attr("src", res.data.f_status_url);
                            $("#banner>img:nth-child(2)").attr("src", res.data.hand_status_url);
                            $("#banner>img:nth-child(3)").attr("src", res.data.r_status_url);
                        }
                    });
                },

                getRequest: function() {  
                   var url = location.search; //获取url中"?"符后的字串  
                   var theRequest = new Object();  
                   if (url.indexOf("?") != -1) {  
                      var str = url.substr(1);  
                      strs = str.split("&");  
                      for(var i = 0; i < strs.length; i ++) {  
                         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);  
                      }  
                   }  

                   return theRequest;  
                }  
            }
        });
    </script>
</body>
</html>