<?php if (!defined('THINK_PATH')) exit();?>
<head>
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






<div class="layui-form">
  
    <div class="layui-form-item">
        <label class="layui-form-label">选择邮箱</label>
        <div class="layui-input-block" style="width:50%">
            <select name="email" lay-verify="required">
                <option value="1">QQ邮箱</option>
                <option value="2">163邮箱</option>
                <option value="3">雅虎邮箱</option>
            </select>
        </div>
    </div>

  <div class="layui-form-item">
    <label class="layui-form-label">账号</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入邮箱账号" autocomplete="off" class="layui-input" style="width:50%">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-inline">
      <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">邮箱授权码</div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" id="sure">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</div>

 
<script>
    function verification() {
        // 判断是否为空
        if ($('[name=email]').val() == '' ||
            $('[name=title]').val() == '' ||
            $('[name=password]').val() == '' )
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

        var url = "<?php echo U(setEmail);?>";
        var data = {
            email_type: $('[name=email]').val(),
            email_account: $('[name=title]').val(),
            email_password: $('[name=password]').val(),
            nonce_str : nonce_str,
            sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + $('[name=title]').val() + $('[name=password]').val() + $('[name=email]').val() + nonce_str)
            }; // 发送签名

        layer.load(2);

        $.ajax({
            url : url,
            data : data,
            type : 'post',
            success : function(res){
                console.log("res:", res);
                layer.closeAll();

                if(parseInt(res.code) == 0) {
                    layer.msg('修改成功！', {icon: 1}, function(){
                        // 刷新
                        window.parent.location.reload();
                    });
                }else{
                    layer.msg('修改失败', {icon : 2});
                }
            },
        });
    });
</script>