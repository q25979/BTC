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






<style>
    .layui-elem-quote {font-size: 15px;}
    span{font-size: 14px; letter-spacing: 2px; display: inline-block; padding: 10px 0 10px 0;}
    #demo{width: 240px; height: 240px;}
    .layui-input{width: 400px; font-size: 18px;}
    .submit {width: 110px;}
    #content{width: 400px; font-size: 16px;}
    #upload-img2{width: 50%;height: 20%;}
</style>

<body>
    <div class="x-body">
        
        <div class="layui-form-item">

            <span>网站名称：</span>
            <input type="text" class="layui-input" name="net_name" id="net_name"/>

            <div class="layui-upload" style="margin: 10px 0 10px 0;">
                <span>网站LOGO：</span>
                <button type="button" class="layui-btn" id="upload-btn">上传LOGO</button>
                <div id="systemLogo" class="layui-upload-list">
                    <img class="layui-upload-img" id="upload-img">
                    <p id="upload-err"></p>
                </div>
            </div>

            <div class="layui-upload" style="margin: 10px 0 10px 0;">
                <span>背景图片：</span>
                <button type="button" class="layui-btn" id="upload-btn2">上传背景</button>
                <div id="bgLogo" class="layui-upload-list">
                    <img class="layui-upload-img" id="upload-img2">
                    <p id="upload-err"></p>
                </div>
            </div>

        </div>
        <button class="layui-btn layui-btn-normal submit">提交</button>
    </div>
</body>

<script>

    // 保存二维码临时路径
    var LOGO;
    var BACK;

    layui.use('upload', function(){
        var $ = layui.jquery,
            upload = layui.upload,
            qnurl = "<?php echo U(uploadFile);?>";
      
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#upload-btn',
            url: qnurl,
            data: {
                type: "1"
            },
            before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result) {
                    $('#upload-img').attr('src', result); //图片链接（base64）
                    console.log(index);
                    console.log(result);
                });
            },
            choose: function() {
                layer.load(2);
            },
            done: function(res){
                layer.closeAll();
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败，请重试！');
                }
                //上传成功
                layer.msg("图片上传成功!");

                LOGO ="http://localhost:8081/Uploads/" + res.data.img_url;       // 保存二维码临时路径
            },
            error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#upload-err');
                    demoText.html('<span style="color: #FF5722; margin: 10px 0 0 0; font-weight: bold;">上传失败，请重试！</span> <a class="layui-btn layui-btn-radius layui-btn-normal demo-reload">重试</a>');

                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
        //普通图片上传(背景图片)
        var uploadInst = upload.render({
            elem: '#upload-btn2',
            url: qnurl,
            data: {
                type: "1"
            },
            before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result) {
                    $('#upload-img2').attr('src', result); //图片链接（base64）
                });
            },
            choose: function() {
                layer.load(2);
            },
            done: function(res){
                layer.closeAll();
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败，请重试！');
                }
                //上传成功
                layer.msg("图片上传成功!");

                BACK ="http://localhost:8081/Uploads/" + res.data.img_url;       // 保存二维码临时路径
            },
            error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#upload-err');
                    demoText.html('<span style="color: #FF5722; margin: 10px 0 0 0; font-weight: bold;">上传失败，请重试！</span> <a class="layui-btn layui-btn-radius layui-btn-normal demo-reload">重试</a>');

                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    });


    // 提交
    $('.submit').click(function(){

        var net_name = $('[name=net_name]').val();    // 网站名称

        // 判断
        if (net_name == '') {
            layer.msg("网站名称不能为空！", {icon: 2});
            return ;
        }

        var url = "<?php echo U(updataLogo);?>"; // 请求接口
        var data = {
            name: net_name,         // 网站名称     
            logo_url: LOGO,             // LOGO图片url
            background_url: BACK        // 背景图片url
        };

        layer.load(2);
        // 数据请求
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            success: function (res) {
                layer.closeAll();
                if (parseInt(res.code) == 0) {
                    layer.msg("修改成功！", {icon: 6});
                    layer.closeAll();
                    window.parent.location.reload();

                } else {
                    layer.msg("修改失败！", {icon: 2});
                }
            }
        });
    });

    $.ajax({
        url: '<?php echo U(Logo);?>',
        type: 'get',
        success: function (res) {
            $("#net_name").val(res.data[0]['name']);
            $('#systemLogo').val('src', res.data[0]['logo_url']);
            $('#bgLogo').attr('src', res.data[0]['background_url']);
            layer.closeAll();
        }
    });


</script>