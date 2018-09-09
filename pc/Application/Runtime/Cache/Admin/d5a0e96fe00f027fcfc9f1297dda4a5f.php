<?php if (!defined('THINK_PATH')) exit();?>
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






<div class="layui-form"> 

  <div class="layui-form-item">
  	<br />
    <label class="layui-form-label">AccessKeyID：</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入要修改的AccessKeyID" autocomplete="off" class="layui-input" style="width:50%">
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" id="sure">立即提交</button>
      <!--<button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
    </div>
  </div>
</div>

 
<script>
    function verification() {
        // 判断是否为空
        if ($('[name=title]').val() == '' )
        {
            layer.msg('输入的信息不能为空！', {icon: 2});
            return false;
        }
        return true;
    }

    // 32位随机数
    var nonce_str = nonceStr(32);

    $('#sure').on('click', function (){

        if ( !verification() ) {
                return ;
            }

        var url = 'http://blnance66.com/Admin/System/updateAppid';
        var data = {
            	appid: $('[name=title]').val()
            };

        layer.load(2);

        $.ajax({
            url : url,
            data : data,
            type : 'post',
            success : function(res){
                console.log(res);
                layer.closeAll();
                if(res == "成功") {
                    layer.msg('修改成功！', {icon: 1}, function(){
                        // 刷新
                        window.parent.location.reload();
                    });
                }else{
                    layer.msg('修改失败', {icon : 2});
                }
            }
        });
    });
</script>