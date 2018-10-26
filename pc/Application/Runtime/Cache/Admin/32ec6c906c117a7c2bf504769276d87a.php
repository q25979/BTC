<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/xy.css" />
    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/plug-in/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/xadmin.css" />

	<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/plug-in/layui/layui.js"></script>
	<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/xadmin.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/config.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/function.js"></script>
    

	<!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>






<style>
    .xy-verify {
        width: 49%;
        height: 50px;
    }
    .login {
        margin: 120px auto 0 auto;
        min-height: 420px;
        max-width: 420px;
        padding: 40px;
        background-color: #ffffff;
        margin-left: auto;
        margin-right: auto;
        border-radius: 4px;
        /* overflow-x: hidden; */
        box-sizing: border-box;
    }

    .login .message {
        margin: 10px 0 0 -58px;
        padding: 18px 10px 18px 60px;
        background: #189F92;
        position: relative;
        text-align: left;
        color: #fff;
        font-size: 16px;
        margin-bottom: 16px;
    }
    .login input[type="text"], .login input[type="file"], .login input[type="password"], .login input[type="email"], select {
        vertical-align: middle;
        height: 50px;
        font-size: 14px;
        color: rgb(85, 85, 85);
        width: 100%;
        box-sizing: border-box;
        border-width: 1px;
        border-style: solid;
        border-color: rgb(220, 222, 224);
        border-image: initial;
        border-radius: 3px;
        /*padding: 0px 16px;*/
        outline: none;
    }
</style>

<body class="login-bg">
<div class="login">
    <div class="message">管理登录</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class="layui-form" action="javascript:">
        <input name="username" placeholder="用户名" type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">
        <input type="text" style="width: 50%" lay-verify="required" placeholder="验证码" name="code" id="code">
        <img src="<?php echo U('Login/verify', '', '');?>" class="xy-verify pull-left">
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit" />
        <hr class="hr20" >
    </form>
</div>

<script>
    // 登录
    $("[value=登录]").click(function () {
        userVerify();
    });

    function userVerify() {
        var url = "<?php echo U(getAccount);?>";
        var data = {
            user_name: $("[name=username]").val(),
            pass_word: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + $("[name=password]").val()),
            code: $("[name=code]").val()
        };

        layer.load(2);
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function(res) {
                layer.closeAll();
                updataVerify();

                if (res.code == 0) {
                    layer.msg("登录成功", {icon: 1}, function() {
                        location.href = "http://192.168.0.128:8081" + "/Admin/Index";
                    });

                } else {
                    layer.msg(res.msg, {icon: 2});
                }
            },
            fail: function() {
                layer.msg("登录超时", {icon: 5});
            }
        });
    }

    // 点击刷新验证码
    $(".xy-verify").click(function () {
        updataVerify();
    });

    // 刷新验证码
    function updataVerify() {
        $(".xy-verify").attr('src', $(".xy-verify").attr('src') + "?" + Math.random());
    }
</script>
<!-- 底部结束 -->
</body>
</html>