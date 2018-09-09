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





<style type="text/css">
.layui-form-label{width: 20%;}
.layui-form-label{margin-right: 10px ;}
.layui-form-item{margin:20px;}
</style>


  
<div class="layui-form-item" style="">
    <label class="layui-form-label">BTC浮动最小值</label>
    <div class="layui-input-block">
        <input type="text" name="btc_float_min" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id='btc_float_min' onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">BTC浮动最大值</label>
    <div class="layui-input-block">
        <input type="text" name="btc_float_max" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id='btc_float_max' onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">ETH浮动最小值</label>
    <div class="layui-input-block">
        <input type="text" name="etc_float_min" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id='etc_float_min' onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">ETH浮动最大值</label>
    <div class="layui-input-block">
        <input type="text" name="etc_float_max" required  lay-verify="required" placeholder="请输入USD价格" autocomplete="off" class="layui-input" style="width:50%" id='etc_float_max' onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" id="sure">立即提交</button>
    </div>
</div>


 
<script>

    $.ajax({
        url : '<?php echo U(Coin);?>',
        type: 'get',
        success: function (res) {

            $("#btc_float_min").val(res.data[0]['btc_float_min']);
            $('#etc_float_min').val(res.data[0]['etc_float_min']);
            $('#btc_float_max').val(res.data[0]['btc_float_max']);
            $('#etc_float_max').val(res.data[0]['etc_float_max']);

            layer.closeAll();
        }
    });

    // 32位随机数
    var nonce_str = nonceStr(32);

    layui.use('layer',function(){

        var $ = layui.jquery, layer = layui.layer;
        //提交
        function verification() {
            // 判断是否为空
            if (
                $('[name=btc_float_min]').val() == '' || 
                $('[name=etc_float_min]').val() == '' || 
                $('[name=btc_float_max]').val() == '' || 
                $('[name=etc_float_max]').val() == '' 
                ) {
                layer.msg('输入的信息不能为空！', {icon: 2});
                return false;
            }
            if (($('[name=btc_float_min]').val() > $('[name=btc_float_max]').val()) || 
                ($('[name=etc_float_min]').val() > $('[name=etc_float_max]').val()) 
                ) {
                layer.msg('输入的最小值不能大于最大值！', {icon: 2});
                return false;
            }
            return true;
        }

        $('#sure').on('click', function (){
            if ( !verification() ) {
                return ;
            }

            var data = {
                btc_float_min: $('[name=btc_float_min]').val(),
                etc_float_min: $('[name=etc_float_min]').val(),
                btc_float_max: $('[name=btc_float_max]').val(),
                etc_float_max: $('[name=etc_float_max]').val(),
                nonce_str : nonce_str,
                sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + $('[name=btc_float_max]').val() + $('[name=btc_float_min]').val() + $('[name=etc_float_max]').val() + $('[name=btc_float_min]').val() + nonce_str)
            };

            layer.load(2);
            // 数据请求
            $.ajax({
                url : '<?php echo U(setFloat);?>',
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