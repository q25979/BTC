<?php if (!defined('THINK_PATH')) exit();?><head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/xy.css" />
    <link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/plug-in/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/xadmin.css" />

	<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/plug-in/layui/layui.js"></script>
	<script type="text/javascript" src="http://192.168.0.128:8081/Public/js/xadmin.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/config.js"></script>
    <script type="text/javascript" src="http://192.168.0.128:8081/Public/js/function.js"></script>
    

	<!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>







<link rel="stylesheet" type="text/css" href="/Public/view/ProblemDetil.css" />
<!-- <script type="text/javascript" src="http://localhost/qzxt/Public/plug-in/layui/layui.js"></script> -->

<body>
    <div class="detail" id="articleInfo">
        <h3 id="title"></h3>

        <div class="item">
            <table class="acticle-info">
                <tr>
                    <td class="fontsize acticleRight">问题标题:</td>
                    <td class="fontsize" id="topic" ></td>
                </tr>
            
                <tr>
                    <td class="fontsize acticleRight">联系人:</td>
                    <td class="fontsize" id="name" ></td>
                </tr>

            </table>
            <div class="time">时间:<span id="time"></span></div>
        </div>

        <div class="hr"></div>

        <div style="margin: 15px auto;">
            <img id='showimg' src="" alt="" style="width: 100%;height:30%;">
        </div>

        <div id="html" class="content">
        </div>
    </div>
</body>

<script>
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

    var problem_id = GetRequest().id;

    var url = '<?php echo U(Contact);?>';
    var data = {
        problem_id: problem_id,
    };

    $.ajax({
        url: url,
        data: data,
        type: 'post',
        success: function (res) {

            layer.closeAll();
            $("#topic").html(res.data[0].topic);
            $("#name").html(res.data[0].name);
            $("#time").html(res.data[0].create_time);
            $('#showimg').attr('src',res.data[0].file_address);


            var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            var h = res.data[0].content;
            var l = /&lt;/g;
            var r = /&gt;/g;
            var f = /&quot;/g;

            h = h.replace(l, '<').replace(r, '>').replace(f, '"');

            // 渲染页面
            $("#html").html(h);
        }
    });

</script>