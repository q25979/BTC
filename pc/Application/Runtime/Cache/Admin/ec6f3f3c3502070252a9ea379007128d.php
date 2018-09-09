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
    .navbar {margin-bottom: 0; line-height: 50px; padding: 0 10px;}
    .navbar>input {width: 20%; display: inline;}
    .navbar>button {height: 34px; transform: translateY(-2px);}
    .layui-elem-quote {font-size: 15px;}
    .layui-form-label {padding: 9px 10px;}
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">银行列表</blockquote>

        <div class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">银行名称</label>
                <div class="layui-input-block">
                    <input type="text" name="bank_name_parent" required  lay-verify="required" placeholder="请输入银行名称" autocomplete="off" class="layui-input" style="width:50%">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" id="sure">立即提交</button>
                </div>
            </div>
        </div>

        <div>
            <label class="layui-form-label">所属银行</label>
            <div class="layui-input-inline">
                <select id ="bank_select"
                        class="form-control"
                        name="bank_select"
                        lay-verify=""
                        style="width: 390px; margin-left: 30px"
                >
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">分行名称</label>
            <div class="layui-input-block">
                <input type="text" name="bank_name_son" required  lay-verify="required" placeholder="请输入银行分行名称" autocomplete="off" class="layui-input" style="width:50%">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" id="son_sure">立即提交</button>
            </div>
        </div>
        
    </div>
</body>
<script>

    getdata();
    function getdata(){
        var url = "http://blnance66.com/Admin/Bank/getParentBank";
        
        $.get(url,function(res){
            if (res.code == 0) {
                var data = res.data;
                $("#bank_select").empty();
                $("#bank_select").append("<option value=''>请选择银行</option>");

                //如果是主银行名称
                for (i in data) {
                    console.log(data[i]);
                    $("#bank_select").append("<option value = "+data[i].bank_id+">"+data[i].bank_name+"</option>");
                }
            }else{
                layer.msg('获取数据失败', {icon : 2});
            }
        });

    };

    function verification_son() {
        // 判断是否为空
        if ($('[name=bank_select]').val() == '' ||
            $('[name=bank_name_son]').val() == '')
        {
            layer.msg('输入的信息不能为空！', {icon: 2});
            return false;
        }
        return true;
    }
    function verification_parent() {
        // 判断是否为空
        if ($('[name=bank_name_parent]').val() == '')
        {
            layer.msg('输入的信息不能为空！', {icon: 2});
            return false;
        }
        return true;
    }

    //主银行提交
    $('#sure').on('click', function (){

        if ( !verification_parent() ) {
                return ;
        }

        var url = "http://blnance66.com/Admin/Bank/addBank";
        var data = {
            bank_name : $('[name=bank_name_parent]').val(),
            bank_type : 1
        };

        $.post(url,data,function(res){
            if (res.code == 0) {
                layer.msg('添加成功！', {icon : 1});
                location.reload();  
            }else{
                layer.msg('添加失败！', {icon : 2});
                location.reload();  
            }
        });
      
    });

    //子银行提交
    $('#son_sure').on('click', function (){

        if ( !verification_son() ) {
                return ;
        }

        var url = "http://blnance66.com/Admin/Bank/addBank";
        var data = {
            bank_name : $('[name=bank_name_son]').val(),
            bank_type : 2,
            bank_parent : $('[name=bank_select]').val()
        };

        $.post(url,data,function(res){
            if (res.code == 0) {
                layer.msg('添加成功！', {icon : 1});
                location.reload();  
            }else{
                layer.msg('添加失败！', {icon : 2});
                location.reload();  
            }
        });
      
    });
</script>