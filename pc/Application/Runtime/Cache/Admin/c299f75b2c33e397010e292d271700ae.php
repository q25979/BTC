<?php if (!defined('THINK_PATH')) exit();?><head>
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






<link rel="stylesheet" type="text/css" href="http://blnance66.com/Public/css/bootstrap.min.css" />

<style>
    .layui-elem-quote {font-size: 15px;color: #666;margin: 30px;}
    .layui-form-item {width: 80%; margin-top: 15px;}
</style>
<div class="layui-elem-quote ">
  <div class="layui-form-item">
    <label class="layui-form-label" style="width:22%;">出售浮动设置：</label>
    <div class="layui-input-inline">
        <input type="text" name="sell" required  lay-verify="required" placeholder="请输入浮动值" autocomplete="off" class="layui-input">
    </div>
  </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" id="sure">立即提交</button>
    </div>
</div>
 
</script>

<script>
    //显示信息
    $.ajax({
        url : '<?php echo U(Trade);?>',
        type: 'get',
        success: function (res) {
            console.log(res);
            if ( res.data.length == 0 ) {
                layer.msg('无显示信息！', {icon: 5});
                return false;
            }
            $("[name=sell]").val(res.data[0]['sell_float']);
            layer.closeAll();
        }
    });

    // 32位随机数
    var nonce_str = nonceStr(32);

    layui.use('layer',function(){
        var $ = layui.jquery, layer = layui.layer;
        //提交
        $('#sure').on('click', function (){
            var data = {
                sell_float: $('[name=sell]').val(),
                nonce_str : nonce_str,
                sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + nonce_str + $('[name=sell]').val())
            };

            layer.load(2);
            // 数据请求
            $.ajax({
                url : '<?php echo U(tradeUpdate);?>',
                data : data,
                type : 'post',
                success : function(res){
                    console.log("res:", res);
                    layer.closeAll();

                    if(parseInt(res.code) == 0) {
                        layer.msg('修改成功！', {icon: 1}, function(){
                            // 刷新
                            window.parent.location.reload();
                        })
                    }else{
                        layer.msg('修改失败', {icon : 2});
                    }
                },   
            });
        });
    });

</script>