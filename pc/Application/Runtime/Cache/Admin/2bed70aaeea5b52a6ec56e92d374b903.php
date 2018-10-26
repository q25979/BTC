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





<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/jquery.qrcode.min.js"></script>
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
        
        <div>
            <blockquote class="layui-elem-quote">公司信息</blockquote>
            <div class="item">
                <i class="layui-icon" >&#xe63b;</i>
                <span style="font-size: 17px; color: #666;">营业时间：</span>
                <span class="name right tw_content"></span>
            </div>

            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon" >&#xe63b;</i>
                <span style="font-size: 17px; color: #666;">公司电话：</span>
                <span class="name right company_tel"></span>
            </div>

            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon" >&#xe63b;</i>
                <span style="font-size: 17px; color: #666;">公司邮箱：</span>
                <span class="name right company_email"></span>
            </div>

        </div>

        <div>
            <hr class="hr15"/>
            <blockquote class="layui-elem-quote">Company information：</blockquote>
            <div class="item">
                <i class="layui-icon" >&#xe63b;</i>
                <span style="font-size: 17px; color: #666;">Business Hours：</span>
                <span class="name  right en_content"></span>
            </div>

            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon" >&#xe63b;</i>
                <span style="font-size: 17px; color: #666;">Company phone：</span>
                <span class="name right company_tel"></span>
            </div>

            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon" >&#xe63b;</i>
                <span style="font-size: 17px; color: #666;">Company mailbox：</span>
                <span class="name right company_email"></span>
            </div>

        </div>

        <hr class="hr15"/>
        <span class="site-demo-button" id="layerDemo">
            <button data-method="offset" data-type="auto" class="layui-btn" style="background-color: #009688 !important;">修改</button>
            <span class="right"></span>     <!--添加空格防止拥挤-->
        </span>
    </div>
</body>

<script>

    var code;
   
    var url = "<?php echo U(companylist);?>";
    $.ajax({
        url : url,
        type: 'get',
        success: function (res) {

            if ( res.data.length == 0 ) {
                layer.msg('信息请求失败！', {icon: 5});
                return false;
            }

            $(".company_tel").html(res.data[0]['company_tel']);
            $('.en_content').html(res.data[0]['en_content']);
            $('.tw_content').html(res.data[0]['tw_content']);
            $('.company_email').html( res.data[0]['company_email']);

            layer.closeAll();
        }
    });

    // 修改网站信息
    layui.use('layer',function() {

        var $ = layui.jquery, layer = layui.layer;

        $('#layerDemo').on('click', function () {

            layer.open({
                type: 2,
                title: '公司信息',
                area: ['60%', '80%'],
                content: '<?php echo U(CompanyUpdate);?>',
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });
    });
</script>