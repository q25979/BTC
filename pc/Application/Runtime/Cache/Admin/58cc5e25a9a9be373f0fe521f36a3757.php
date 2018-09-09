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





<script type="text/javascript" src="http://localhost:8081/Public/js/jquery.qrcode.min.js"></script>
<style>
    .layui-elem-quote{font-size: 15px;}
    .num, .name, .wx_access{font-size: 18px; color: #666; font-family: '微软雅黑';}
    .right {margin: 0 15px 0 30px;}
    .layui-btn {background-color: #62b900;}
    .item {height: 40px; line-height: 40px;}
    .show-cotent {width: 100%; height: 100%; padding-top: 20px; box-sizing: border-box; text-align: center;}
    .show-code {width: 180px; height: 180px; margin: 0 auto;}
    .layui-icon, .iconfont {color: #505050;}

    .logo {height: 40px;}
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">网站管理</blockquote>
        
        <div>
            <div class="item">
                <i class="layui-icon" >&#xe63b;</i>
                <span style="font-size: 17px; color: #666;">系统名称:</span>
                <span class="name right"></span>
            </div>

            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon">&#xe64a;;</i>
                <span style="font-size: 17px; color: #666;">系统图标:</span>
                <!-- <span id="showicon" class="logo right"></span> -->
                <img class="logo right systemLogo" src="" alt="">
            </div>

            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon">&#xe64a;</i>
                <span style="font-size: 17px; color: #666;">背景图片:</span>
                <!-- <span id="showicon" class="bc right"></span> -->
                <img class="logo right bgLogo" src="" alt="">
            </div>

        </div>

        <hr class="hr15"/>
        <span class="site-demo-button" id="layerDemo">
            <button data-method="offset" data-type="auto" class="layui-btn" style="background-color: #009688 !important;">修改</button>
            <button onclick="refresh()" class="layui-btn">刷新缓存</button>
            <span class="right"></span>     <!--添加空格防止拥挤-->
        </span>
    </div>
</body>

<script>
    var code;
   
    var url = "<?php echo U(Logo);?>";
    $.ajax({
        url : url,
        type: 'get',
        success: function (res) {

            if ( res.data.length == 0 ) {
                layer.msg('信息！', {icon: 5});
                return false;
            }

            $(".name").html(res.data[0]['name']);
            $('.systemLogo').attr('src', res.data[0]['logo_url']);
            $('.bgLogo').attr('src', res.data[0]['background_url']);

            layer.closeAll();
        }
    });

    // 修改网站信息
    layui.use('layer',function() {

        var $ = layui.jquery, layer = layui.layer;

        $('#layerDemo').on('click', function () {

            layer.open({
                type: 2,
                title: '网站信息',
                area: ['40%', '80%'],
                content: '<?php echo U(LogoUpdate);?>',
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });
    });

    // 刷新缓存
    function refresh() {
        layer.load(2)
        $.get('http://localhost:8081', { name: 'logo' }, function() {
            layer.closeAll()
            layer.msg('刷新成功', {time: 1500, icon: 6})
        })
    }
</script>