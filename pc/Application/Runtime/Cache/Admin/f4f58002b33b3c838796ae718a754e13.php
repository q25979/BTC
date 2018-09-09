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
<script type="text/javascript" src="http://blnance66.com/Public/plug-in/qiniu_uedit/ueditor.config.js"></script>
<script type="text/javascript" src="http://blnance66.com/Public/plug-in/qiniu_uedit/ueditor.all.min.js"></script>

<style>
    .layui-form{width: 40%; padding: 15px;}
    .layui-input, .layui-textarea { width: 50%;}
    .layui-form-label, .layui-elem-quote{font-size: 15px;}
    .layui-form-label {padding: 9px 0 0 0;}
    .xy-navbar {padding: 15px;}
    #edui1_iframeholder {height: 200px;}
</style>
<body>
    
    <div class="x-body">
        <nav class="navbar navbar-default xy-navbar">
            <div class="layui-form-item">
                <label class="layui-form-label">繁体标题：</label>

                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="leftTitle" placeholder="请输入问题标题" />
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">繁体内容：</label>

                <div class="layui-input-block">
                    <!--富文本编辑器-->
                    <script id="leftContent" name="leftContent" type="text/plain"></script>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-default xy-navbar">
            <div class="layui-form-item">
                <label class="layui-form-label">英文标题：</label>

                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="rightTitle" placeholder="请输入问题标题" />
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">英文内容：</label>

                <div class="layui-input-block">
                    <!--富文本编辑器-->
                    <script id="rightContent" name="rightContent" type="text/plain"></script>
                </div>
            </div>
        </nav>
        <div class="layui-form-item">
            <div class="layui-input-block float">
                <button class="layui-btn layui-btn-normal" lay-filter="form-author" id="save">　发布　</button>
                <button type="reset" class="layui-btn layui-btn-primary clear">清空内容</button>
            </div>
        </div>
    </div>
</body>


<script>
    // 百度富文本编辑器
    var ue1 = UE.getEditor('leftContent');
    var ue2 = UE.getEditor('rightContent');

     // 验证数据是否是否为空
    function verifyData() {
        if ($("[name=problemType]").val() == "") {
            layer.msg("问题类型不能为空", {icon: 2});
            return false;
        }

        if ($("[name=leftTitle]").val() == "") {
            layer.msg("繁体常见问题标题不能为空", {icon: 2});
            return false;
        }

        if ($("[name=rightTitle]").val() == "") {
            layer.msg("英文常见问题标题不能为空", {icon: 2});
            return false;
        }

        if ($("[name=leftContent]").val() == "") {
            layer.msg("繁体问题内容不能为空", {icon: 2});
            return false;
        }

        if ($("[name=rightContent]").val() == "") {
            layer.msg("英文问题内容不能为空", {icon: 2});
            return false;
        }

        return true;
    }

    $("#save").click(function() {
        if (!verifyData()) {
            return false;
        }

        var url = "<?php echo U(addNotice);?>";
        var data = {
            left_content: ue1.getContentTxt(),
            right_content: ue2.getContentTxt(),
            left_title: $("[name=leftTitle]").val(),
            right_title: $("[name=rightTitle]").val(),
            html1: ue1.getContent(),
            html2: ue2.getContent()
        };

        layer.load(2);
            $.ajax({
                url: url,
                data: data,
                type: 'post',
                success: function(res) {
                    layer.closeAll();

                    if (res.code == 0) {
                        // 表示表示成功
                        layer.msg("添加成功", {icon: 1}, function() {
                            // 刷新
                            window.parent.location.reload();
                        });

                    } else {
                        layer.msg("添加失败", {icon: 6});
                    }
                }
            });
        });

    //清空按钮清空所有文本框
    $('.clear').click(function(){
        $('[name=rightTitle]').val('');
        $('[name=leftTitle]').val('');
        ue1.ready(function() {//编辑器初始化完成再赋值
            ue1.setContent('');  //赋值给UEditor
        });
        ue2.ready(function() {//编辑器初始化完成再赋值
            ue2.setContent('');  //赋值给UEditor
        });

    });
</script>