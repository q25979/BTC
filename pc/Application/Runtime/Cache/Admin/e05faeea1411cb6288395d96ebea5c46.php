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
    .layui-elem-quote {font-size: 15px;color: #666;margin: 30px;}
    .layui-form-item {width: 80%; margin-top: 15px;}
</style>
<div class="layui-elem-quote ">
  <div class="layui-form-item">
    <label class="layui-form-label" style="width:22%;">出售浮动设置：</label>
    <div class="layui-input-inline">
        <span name="sell" class="layui-input"></span>
    </div>
    <button class="layui-btn" lay-submit id="sellformDemo">立即修改</button>  
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label" style="width:22%;">购买浮动设置：</label>
    <div class="layui-input-inline">
      <span name="buy" class="layui-input"></span>
    </div>
    <button class="layui-btn" lay-submit id="buyformDemo">立即修改</button>  
  </div>

</div>
 
</script>

<script>
    var code;
    $.ajax({
        url : '<?php echo U(Trade);?>',
        type: 'get',
        success: function (res) {

            if ( res.data.length == 0 ) {
                layer.msg('信息！', {icon: 5});
                return false;
            }

            $("[name=sell]").html(res.data[0]['sell_float']);
            $('[name=buy]').html(res.data[0]['buy_float']);

            layer.closeAll();
        }
    });

    layui.use('layer',function() {

        var $ = layui.jquery, layer = layui.layer;

        $('#sellformDemo').on('click', function () {

            layer.open({
                type: 2,
                title: '出售浮动设置',
                area: ['50%', '50%'],
                content: '<?php echo U(SellUpdate);?>',
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });

        $('#buyformDemo').on('click', function () {

            layer.open({
                type: 2,
                title: '购买浮动设置',
                area: ['50%', '50%'],
                content: '<?php echo U(BuyUpdate);?>',
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });
    });

</script>