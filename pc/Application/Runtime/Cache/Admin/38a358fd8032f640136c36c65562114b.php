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






    <div class="layui-form-item" style='margin-top: 15px;'>
        <label class="layui-form-label">地址</label>
        <div class="layui-input-block">
          <input type="text" name="address" required  lay-verify="required" placeholder="请输入地址名称" autocomplete="off" class="layui-input" style="width:50%" id='address' onkeyup="value=value">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">地址二维码</label>
        <button type="button" class="layui-btn" id="upload-btn">
            <i class="layui-icon">&#xe67c;</i>上传图片
        </button>
        <div id="code" class="layui-upload-list">
            <img class="layui-upload-img" id="upload-img">
            <p id="upload-err"></p>
        </div>
    </div>

    <div class="layui-input-block">
      <button class="layui-btn layui-btn-normal submit">提交</button>
    </div>

 
<script>

    // 保存地址的临时路径
    var weAddress;
    var id =  GetRequest().id;

    // 32位随机数
    var nonce_str = nonceStr(32);

     $.ajax({
        url: '<?php echo U(addressInfo);?>',
        type: 'post',
        data: {
            id:id
        },
        success: function (res) {
            $("#address").val(res.data[0]['address']);
            layer.closeAll();
        }
    });

    layui.use('upload', function(){
        var upload = layui.upload;
   
        //执行实例
        var uploadInst = upload.render({
            elem: '#upload-btn',
            url: '<?php echo U(uploadFile);?>',
            before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result) {
                    $('#upload-img').attr('src', result); //图片链接（base64）
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
                weAddress = "http://blnance66.com/Uploads/" + res.data.img_url;      // 保存二维码临时路径
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

        var address = $('[name=address]').val();             // 获取输入数据
        var url = "<?php echo U(UpdateAddress);?>";    // 请求接口
        var data = {
            address: address,              // 地址名字
            address_url: weAddress,
            wallet_address_id: id,
            nonce_str : nonce_str,
            sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + address + nonce_str + id)
        };

        layer.load(2);
        // 数据请求
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            success: function (res) {
                layer.closeAll();
                console.log(res);
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

    // 获取返回数据 id 并解析 id
    function GetRequest() {
        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for(var i = 0; i < strs.length; i ++) {
                theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    }

</script>