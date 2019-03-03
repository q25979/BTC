<?php if (!defined('THINK_PATH')) exit();?><head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/xy.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/plug-in/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/xadmin.css" />

	<script type="text/javascript" src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://localhost:8081/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/plug-in/layui/layui.js"></script>
	<script type="text/javascript" src="http://localhost:8081/Public/js/xadmin.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/config.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/function.js"></script>
    

	<!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>






<link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/bootstrap.min.css" />

<style>
    .layui-elem-quote {font-size: 15px;color: #666}
    .addAgent {margin: 20px 0 0 2%; width: 80%;;}
    .add span {font-size: 16px; line-height: 3px;display:inline-block; width: 140px;}
    .addAgent input {width: 35%; display: inline;}
    .layui-form-item {width: 80%; margin-top: 15px;}
    .layui-input-block button {width: 120px;}
    .right {margin: 0 15px 0 30px;}
    #code {width: 100px;}
    .sg-radio { margin-left: 20px; }
    .sg-radio label { margin-right: 20px; font-size: 15px; }
    .sg-radio .on  { margin-right: 10px; } 
</style>
<body>


    <div class="x-body">

        <div class="addAgent layui-form-item">
            <blockquote class="layui-elem-quote">汇率比设置</blockquote>

            <div class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">美金</label>
                    <div class="layui-input-block">
                        <input type="text" name="usd" required disabled  lay-verify="required" placeholder="请输入美金" class="layui-input layui-btn-disabled">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">港币</label>
                    <div class="layui-input-block">
                        <input type="text" name="hkd" required  lay-verify="required" placeholder="请输入港币" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">新台币</label>
                    <div class="layui-input-block">
                        <input type="text" name="twd" required  lay-verify="required" placeholder="请输入新台币" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" onclick="update()">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary" onclick="refresh()">刷新缓存</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $.get('http://localhost:8081/Admin/System/getExchange', function(res) {
        $('[name=usd]').val(1.0000)
        $('[name=hkd]').val(res.data.hkd)
        $('[name=twd]').val(res.data.twd)
    })

    // 修改
    function update() {
        var u = 'http://localhost:8081/Admin/System/updateExchange',
            d = {
                id: 1,
                usd: 1,
                hkd: $('[name=hkd]').val(),
                twd: $('[name=twd]').val()
            }

        layer.load(2)
        $.post(u, d, function(res) {
            layer.closeAll()

            if (res.code == 0) {
                layer.msg('汇率设置成功', {icon: 6, time: 1200}, function() {
                    window.location.reload()
                })
            } else {
                layer.msg('汇率设置失败', {icon: 5, time: 1500})
            }
        })
    }

    // 刷新缓存
    function refresh() {
        var u = 'http://localhost:8081/Admin/System/refresh',
            d = {
                name: 'exchange'
            }

            layer.load(2)
            $.get(u, d, function() {
                layer.closeAll()
                layer.msg('缓存刷新成功', {icon: 6, time: 1500})
            })
    }
</script>