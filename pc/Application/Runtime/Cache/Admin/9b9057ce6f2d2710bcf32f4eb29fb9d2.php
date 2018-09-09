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






<style>
    .layui-form-label {font-size: 14px; color: #505050; width: 100px}
    .layui-input {size: 50;width: 215px}
    .save {margin: 20px 0 20px 44%; width:110px;}
    .main {float:left;border:1px;   width:800;}
    .leftEdit {float:left;border:1px;  width:150px; margin-right: 167px}
    .rightEdit {float:right;border:1px; width:150px;}
   
    .text-box{width: 950px;}
     .layui-textarea {height: 300px;width: 400px; margin-top: 20px; margin-left: 16px; display: inline-block ;}
    .text-one{  margin-left: : 30px; float: left; }
    .text-two{ margin-left: 30px; float: right; }
</style>

<style>
    .layui-form-label {font-size: 14px; color: #505050; width: 100px}
    .layui-input {size: 50;width: 215px}
    .save {margin: 20px 0 20px 44%; width:110px;}
    .main {float:left;border:1px;   width:1000px;}
    .userID {border:1px;  width:350px; margin-top: 10px;}
    .leftEdit {float:left;border:1px;  width:350px; margin-right: 167px; margin-top: 10px;}
    .rightEdit {float:left;border:1px; width:350px; margin-top: 10px;}
    .layui-textarea {height: 300px;width: 450px; margin-top: 20px; margin-left: 16px;}
</style>

<body>
    <br />
    <div class = "main">
        <div class = "userID">
            <label class="layui-form-label">私信ID：</label>
            <input type="text" class="layui-input" name="userID" placeholder="请输入ID" />
        </div>
                
        <div class = "leftEdit">
            <label class="layui-form-label">繁体内容标题：</label>
            <input type="text" class="layui-input" name="leftTitle" placeholder="请输入标题" />
            <textarea name="leftContent" required lay-verify="required" placeholder="请输入公告内容" class="layui-textarea">
            </textarea>
        </div>
            
        <div class = "rightEdit">
            <label class="layui-form-label">英文内容标题：</label>
            <input type="text" class="layui-input" name="rightTitle" placeholder="请输入标题" />
            <textarea name="rightContent" required lay-verify="required" placeholder="请输入公告内容" class="layui-textarea"></textarea>
        </div>


        <button id="save" class="layui-btn layui-btn-normal save" lay-filter="form-author">发送</button>


    </div>
    
</body>



<script>

    // 验证数据是否是否为空
    function lverifyData() {
        if($("[name=userID]").val() == "") {
            layer.msg("私信的用户ID不能为空", {icon: 2});
            return false;
        }

        if ($("[name=leftTitle]").val() == "") {
            layer.msg("公告标题不能为空", {icon: 2});
            return false;
        }

        if ($("[name=leftTitle]").val().length > 255) {
            layer.msg("公告标题不能超过50个字", {icon: 2});
            return false;
        }

        if ($("[name=leftContent]").val().length < 10) {
            layer.msg("公告内容不能少于10个字", {icon: 2});
            return false;
        }

        return true;
    }
    // 验证数据是否是否为空
    function rverifyData() {
        if ($("[name=rightTitle]").val() == "") {
            layer.msg("公告标题不能为空", {icon: 2});
            return false;
        }

        if ($("[name=rightTitle]").val().length > 255) {
            layer.msg("公告标题不能超过50个字", {icon: 2});
            return false;
        }

        if ($("[name=rightContent]").val().length < 10) {
            layer.msg("公告内容不能少于10个字", {icon: 2});
            return false;
        }

        return true;
    }
    $("#save").click(function() {

        if (!lverifyData()) {
            return false;
        }
        if (!rverifyData()) {
            return false;
        }

        //var sign = hex_md5(VERIFY_STR + user_id + nonceStr);
        var url = "<?php echo U(SendInformation);?>";
        var data = {
            maincoin_id: $("[name=userID]").val(),
            left_title: $("[name=leftTitle]").val(),
            left_content: $("[name=leftContent]").val(),
            right_title: $("[name=rightTitle]").val(),
            right_content: $("[name=rightContent]").val()
            //nonce_str: nonceStr,
            //sign: sign
        };

        layer.load(2);
            $.ajax({
                url: url = "<?php echo U(SendInformation);?>",
                data: data,
                type: 'post',
                success: function(res) {
                    layer.closeAll();

                    if (res.code == 0) {
                        // 表示表示成功
                        layer.msg("发送成功", {icon: 1}, function() {
                            // 刷新
                            window.parent.location.reload();
                        });

                    } else {
                        layer.msg("发送失败", {icon: 6});
                    }
                }
            });
        });

    

</script>
<script>


</script>