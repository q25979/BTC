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





<script type="text/javascript" src="http://blnance66.com/Public/js/jquery.qrcode.min.js"></script>
<script type="text/javascript" src="http://blnance66.com/Public/plug-in/layui-v2.3.0/layui/layui.js"></script>

<style>
    .layui-elem-quote{font-size: 15px;display: flex;flex-direction: row;justify-content: space-between;align-items: center;}
    .num, .name, .wx_access{font-size: 18px; color: #666; font-family: '微软雅黑';}
    .right {margin: 0 15px 0 30px;}
    .layui-btn {background-color: #62b900;}
    .item {height: 40px; line-height: 40px;}
    .show-cotent {width: 100%; height: 100%; padding-top: 20px; box-sizing: border-box; text-align: center;}
    .show-code {width: 180px; height: 180px; margin: 0 auto;}
    .layui-icon, .iconfont {color: #505050;}
    .oldpass,.newpass,.surepass{font-size:16px; margin-left:15%; display:inline-block;}
    .layui-input {display: inline; width: 65%; position: relative; left: 20%; border:1px solid #ddd; font-size:13px; }
    .layui-btn-normal{position: relative; left: 60%; margin: 20px 0 0 0; width: 100px;}
    .changepass {padding: 20px; }
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">短信验证
        	<div class="layui-form layui-switch" lay-filter="switchFilter">
                <input 
                    type="checkbox" 
                    id="SMS-switch" 
                    lay-filter= "service_switch" 
                    lay-skin="switch" 
                    lay-text="开启|关闭"
                    name="SMSswitch"
                />
            </div>
        </blockquote>	
        	
        
        
        <div>
            <div class="item">
                <i class="iconfont" >&#xe6b8;</i>
                <span style="font-size: 17px; color: #666;">AccessKeyID：</span>
                <span id="MSG-info1"></span>
            </div>
            <span class="site-demo-button" >
                <button data-method="offset" id="AccessKeyID-btn" data-type="auto" class="layui-btn" style="background-color: #009688 !important;">AccessKeyID修改</button>
                <span class="right"></span>     <!--添加空格防止拥挤-->
            </span>
            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon">&#xe63b;</i>
                <span style="font-size: 17px; color: #666;">AccessKeySecret：</span>
                <span id="MSG-info2"></span>
            </div>
            <span class="site-demo-button" >
                <button data-method="offset" id="AccessKeySecret-btn" data-type="auto" class="layui-btn" style="background-color: #009688 !important;">AccessKeySecret修改</button>
                <span class="right"></span>     <!--添加空格防止拥挤-->
            </span>
            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon">&#xe630;</i>
                <span style="font-size: 17px; color: #666;">短信签名：</span>
                <span id="MSG-info3"></span>
            </div>
            <span class="site-demo-button" >
                <button data-method="offset" id="signature-btn" data-type="auto" class="layui-btn" style="background-color: #009688 !important;">短信签名修改</button>
                <span class="right"></span>     <!--添加空格防止拥挤-->
            </span>
            <hr class="hr15"/>

            <div class="item">
                <i class="layui-icon">&#xe630;</i>
                <span style="font-size: 17px; color: #666;">模板ID：</span>
                <span id="MSG-info4"></span>
            </div>
			<span class="site-demo-button" >
	            <button data-method="offset" id="template-btn" data-type="auto" class="layui-btn" style="background-color: #009688 !important;">模板ID修改</button>
	            <span class="right"></span>     <!--添加空格防止拥挤-->
	        </span>
	        <hr class="hr15"/>
        </div>
    </div>
</body>

<script>
    var code; 
   
   	var appid;
   	var appkey;
   	var sign;
   	var template_id;

    //var oSwitch = $('[lay-filter=switchFilter] layui-form-switch');

    //console.log(oSwitch);

    //$('#SMSswitchD>div').addClass('layui-form-onswitch');
    
    // 获取信息
	function getInfo(form) {
        var url_msg = 'http://blnance66.com/Admin/System/getInfo';
		
        layer.load(2);
		$.ajax({
            url: url_msg,
            type: 'get',
            success: function(res){
                layer.closeAll();
                if( parseInt(res.code) == 0 ){
                	appid = res.data.appid;
                	appkey = res.data.appkey;
                	sign = res.data.sign;
                	template_id = res.data.template_id;

                	$("#MSG-info1").html(appid);
                	$("#MSG-info2").html(appkey);
                	$("#MSG-info3").html(sign);
                	$("#MSG-info4").html(template_id);
                }

                var SMSbool = parseInt(res.data.status) == 0 ? true : false;
                form.val('switchFilter', {
                    'SMSswitch': SMSbool
                });
            }
        });
	}


    // 修改邮箱信息
    layui.use(['layer', 'form'],function(){
        var $ = layui.jquery, layer = layui.layer;
        var form = layui.form;

        var update1 = "<?php echo U(AccessKeyID);?>";
        var update2 = "<?php echo U(AccessKeySecret);?>";
        var update3 = "<?php echo U(signature);?>";
        var update4 = "<?php echo U(template);?>";
		
		//AccessKeyID
        $('#AccessKeyID-btn').on('click', function () {

            layer.open({
                type: 2,
                title: 'AccessKeyID信息',
                area: ['50%', '40%'],
                content: update1,
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });
        
        // AccessKeySecret
        $('#AccessKeySecret-btn').on('click', function () {

            layer.open({
                type: 2,
                title: 'AccessKeySecret信息',
                area: ['50%', '40%'],
                content: update2,
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });
        
        //短信签名
        $('#signature-btn').on('click', function () {

            layer.open({
                type: 2,
                title: '短信签名信息',
                area: ['50%', '40%'],
                content: update3,
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });
        
        //模板id
        $('#template-btn').on('click', function () {

            layer.open({
                type: 2,
                title: '模板ID信息',
                area: ['50%', '40%'],
                content: update4,
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });

        // switch
        form.on('switch(service_switch)', function(res) {
            var status = res.elem.checked == true ? 0 : 1;
            var u = 'http://blnance66.com/Admin/System/setSwitch',
                d = {
                    status: status
                };

            layer.load(2);
            $.post(u, d, function(res) {
                layer.closeAll();
                var errmsg = d.status == 0 ? '开启' : '关闭';
                
                if (res.code != 0) {
                    layer.msg('短信验证' + errmsg + '失败', { icon: 5 });

                } else {
                    layer.msg('短信验证' + errmsg + '成功', { icon: 6 });
                }
            });
        });
        
        getInfo(form);
    });

    
</script>