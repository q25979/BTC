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





<script type="text/javascript" src="http://localhost:8081/Public/js/jquery.qrcode.min.js"></script>

<style>
    .tip {
        position: relative;
        left: 100px;
        top: 10px;
        color: #969696;
    }
</style>

<body>
    <div class="x-body">
        <div class="layui-form-item">
            <label class="layui-form-label" style= "font-size:13px">客服名字</label>
            <div class="layui-input-block">
                <textarea  
                    name="title" 
                    required  
                    style= "width:80%; font-size:15px; height: 200px;" 
                    id="ser_name" 
                    onkeyup="value=value" 
                >
                </textarea>
            </div>
            <div class="tip">tip:用逗号增加或修改多个客服</div>
        </div>

        

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" id="sure">立即提交</button>
            </div>
        </div>
    </div>
</body>

<script>

    $.ajax({
        url : '<?php echo U(serviceInfo);?>',
        type: 'get',
        success: function (res) {

            if ( res.data.length == 0 ) {
                layer.msg('信息！', {icon: 5});
                return false;
            }

            $("#ser_name").val(res.data[0]['name']);
            $('#ser_tel').val(res.data[0]['tel']);
            $('#ser_wechat').val(res.data[0]['wechat']);
            $('#ser_qq').val(res.data[0]['qq']);

            layer.closeAll();
        }
    });

    layui.use('layer',function(){

        var $ = layui.jquery, layer = layui.layer;
        
        $('#sure').on('click', function (){

        //提交
        var data = {
            name:$('#ser_name').val(),
            tel:$('#ser_tel').val(),
            wechat:$('#ser_wechat').val(),
            qq:$('#ser_qq').val(),
        };

        layer.load(2);
        // 数据请求
        $.ajax({
            url : '<?php echo U(setService);?>',
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