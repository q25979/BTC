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
  
<div class="layui-form-item" >
    <label class="layui-form-label">BTC的TWD单价</label>
    <div class="layui-input-block">
        <input type="text" name="btc_twd_value" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id="btc_twd_value" onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item" >
    <label class="layui-form-label">BTC的HKD单价</label>
    <div class="layui-input-block">
        <input type="text" name="btc_hkd_value" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id="btc_hkd_value" onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">BTC的USD单价</label>
    <div class="layui-input-block">
        <input type="text" name="btc_usd_value" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id="btc_usd_value" onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item" >
    <label class="layui-form-label">ETH的TWD单价</label>
    <div class="layui-input-block">
        <input type="text" name="eth_twd_value" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id="eth_twd_value" onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">ETH的HKD单价</label>
    <div class="layui-input-block">
        <input type="text" name="eth_hkd_value" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id="eth_hkd_value" onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">ETH的USD单价</label>
    <div class="layui-input-block">
        <input type="text" name="eth_usd_value" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:50%" id="eth_usd_value" onkeyup="value=value">
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" id="sure">立即提交</button>
    </div>
</div>
 
<script>

    //显示信息
    $.ajax({
        url : '<?php echo U(Coin);?>',
        type: 'get',
        success: function (res) {
            console.log(res);
            $("#eth_twd_value").val(res.data[0]['eth_value_twd']);
            $("#eth_hkd_value").val(res.data[0]['eth_value_hkd']);
            $('#eth_usd_value').val(res.data[0]['eth_value_usd']);
            $('#btc_twd_value').val(res.data[0]['btc_value_twd']);
            $('#btc_hkd_value').val(res.data[0]['btc_value_hkd']);
            $('#btc_usd_value').val(res.data[0]['btc_value_usd']);

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
                $('[name=eth_twd_value]').val() == '' || 
                $('[name=eth_hkd_value]').val() == '' || 
                $('[name=eth_usd_value]').val() == '' || 
                $('[name=btc_twd_value]').val() == '' || 
                $('[name=btc_hkd_value]').val() == '' ||
                $('[name=btc_usd_value]').val() == ''
                )
            {
                layer.msg('输入的信息不能为空！', {icon: 2});
                return false;
            }
            return true;
        }

        $('#sure').on('click', function (){
            if ( !verification() ) {
                return ;
            }

            var data = {
                eth_value_twd: $('[name=eth_twd_value]').val(),
                eth_value_hkd: $('[name=eth_hkd_value]').val(),
                eth_value_usd: $('[name=eth_usd_value]').val(),
                btc_value_twd: $('[name=btc_twd_value]').val(),
                btc_value_hkd: $('[name=btc_hkd_value]').val(),
                btc_value_usd: $('[name=btc_usd_value]').val(),
                nonce_str : nonce_str,
                sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + $('[name=btc_hkd_value]').val() + $('[name=btc_twd_value]').val() + $('[name=btc_usd_value]').val()+ $('[name=eth_hkd_value]').val() + $('[name=eth_twd_value]').val() + $('[name=eth_usd_value]').val() + nonce_str)
            };

            layer.load(2);
            // 数据请求
            $.ajax({
                url : '<?php echo U(setInfoCoin);?>',
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