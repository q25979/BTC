<?php if (!defined('THINK_PATH')) exit();?><head>
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






<link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/bootstrap.min.css" />

<style>
    .navbar {margin-bottom: 0; line-height: 50px; padding: 0 10px;}
    .navbar>input {width: 20%; display: inline;}
    .navbar>button {height: 34px; transform: translateY(-2px);}
    .layui-elem-quote {font-size: 15px;}
    .layui-form-label {padding: 9px 10px;}
    .main{margin: 0 50px ;}
</style>
<body>
    <div class="main">
        <div class="layui-form">
            <label class="layui-form-label"></label>
            <div class="layui-form-item">
                <label class="layui-form-label">用户名称</label>
                <div class="layui-input-inline">
                    <input type="text" id="user_name" name="title" required  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱号码</label>
                <div class="layui-input-inline">
                    <input type="text" id="user_email" name="title" required  lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">手机号码</label>
                <div class="layui-input-inline">
                    <input type="text" id="user_phone" name="title"  placeholder="请输入手机" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux"></div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">证件类型</label>
                <div class="layui-input-inline">
                    <input type="text" id="idcard_type" name="title"  autocomplete="off" class="layui-input">
                    <div class="layui-form-mid layui-word-aux">1.身份证、2.护照、3.其他</div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">证件号码</label>
                <div class="layui-input-inline">
                    <input type="text" id="idcard_num" name="title" placeholder="请输入证件号码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn saveData" lay-submit lay-filter="formDemo">立即提交</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function GetRequest() {
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

    var user_id = GetRequest().id;
    var SetInfo_url = 'http://192.168.0.128:8081/Admin/User/UserInfo';

    $.ajax({
        url: SetInfo_url,
        data:{
                user_id : user_id,
            },
        type: 'post',
        success: function (res) {
            $("#user_name").val(res.data[0]['user_name']);
            $('#user_email').val(res.data[0]['email']);
            $('#user_phone').val(res.data[0]['tel']);
            $('#idcard_type').val(res.data[0]['certificate_type']);
            $('#idcard_num').val(res.data[0]['certificate_num']);

            var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var h = res.data[0].html;
            var l = /&lt;/g;
            var r = /&gt;/g;
            var f = /&quot;/g;
            h = h.replace(l, '<').replace(r, '>').replace(f, '"');

            // 渲染页面
            $("#html").html(h);
        }
    });

    // 提交
    $('.saveData').click(function(){
        var url_saveuser = "<?php echo U(saveUser);?>"; // 请求接口
        var data_saveuser = {
            user_id: user_id,
            user_name: $('#user_name').val(),
            email: $('#user_email').val(),
            tel: $('#user_phone').val(),
            certificate_type: $('#idcard_type').val(),
            certificate_num: $('#idcard_num').val()
        };

        // 数据请求
        layer.load(2);
        $.ajax({
            url: url_saveuser,
            data: data_saveuser,
            type: 'post',
            success: function (res) {
                layer.closeAll();
                if (parseInt(res.code) == 0) {
                    layer.closeAll();
                    layer.msg("修改成功！", {icon: 6});
                    window.parent.location.reload();
                } else {
                    layer.msg("修改失败！", {icon: 2});
                }
            }
        });
    });

    switchSite();
    //获取权限，identity为1是显示钱包地址，其他隐藏
    function switchSite(){
        var url_switchSite = "http://192.168.0.128:8081/Admin/Index/identity";
        $.ajax({
            type:"post",
            url:url_switchSite,
            data: {
                empty: 'yes'
            },
            success:function(res){
                var status = res.data.identity;
                if(parseInt(status) == 1){
                    $("#UserPWD").css("display","block");
                }else{
                    $("#UserPWD").css("display","none");
                }
            }
        });
    }
</script>