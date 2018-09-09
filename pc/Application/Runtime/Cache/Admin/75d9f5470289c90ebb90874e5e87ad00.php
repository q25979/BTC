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
        <blockquote class="layui-elem-quote">认证列表</blockquote>
        <nav class="navbar navbar-default">
            <input type="text" id="user_name" class="form-control" placeholder="请输出用户名" />
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
        </nav>
        <table id="AttestList" lay-filter="AttestList"></table>
    </div>
</body>

<script>

    layui.use('table', function () {
        // debugger
        var table = layui.table;
   
        var tableReload = table.render({
            elem: "#AttestList",
            url: "<?php echo U('Attest/getAttestList');?>",
            page: true,
            cols: [[
                {field: 'maincoin_id', title: 'ID', align: 'center', width: 180,fixed: 'left'}
                ,{field: 'user_name', title: '用户名', align: 'center', width: 180, templet: '#showLogo'}
                ,{title: '身份证照片', align: 'center', width: 180, toolbar: '#detail'}
                ,{title: '状态', width: 180, align: 'center', templet: '#statusInfo'}
            ]],
            done: function (res) {
                console.log(res)
            }

        });
        // 监听工具栏的事件
        table.on('tool(AttestList)', function (obj) {
            var data = obj.data;    // 获取当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前 tr 的 dom 对象

            // 详情
            if(layEvent == "authorization") {

                if(parseInt(data.status) == 1) {
                    layer.msg("当前状态已审核通过！", {icon: 1});
                    return ;
                }

                layer.open({
                    title: "审核",
                    maxmin: true,
                    content: '您是否通过该用户审核！',
                    btn: ['是','否'],
                    yes: function (res) {

                        var url = "<?php echo U('auditYes');?>";
                        var _data = {
                            authentication_id: data.authentication_id,
                            status: data.status
                        };

                        $.ajax({
                            url: url,
                            data: _data,
                            type: 'post',
                            success: function (res) {
                                layer.closeAll();
                                layer.msg("解封成功", { icon: 6}, function() {
                                    // 刷新
                                    location.reload();
                                });
                            }
                        })
                    }
                });
            }

            if(layEvent == "sealNumber") {

                if(parseInt(data.status) == -1) {
                    layer.msg("当前状态审核不通过", {icon: 1});
                    return ;
                }

                layer.open({
                    title: "不通过",
                    maxmin: true,
                    content: '您是否不通过当前用户！',
                    btn: ['是','否'],
                    yes: function (res) {

                        var url = "<?php echo U('auditNo');?>";
                        var _data = {
                            authentication_id: data.authentication_id,
                            status: data.status
                        };
                        $.ajax({
                            url: url,
                            data: _data,
                            type: 'post',
                            success: function (res) {
                                console.log(res);
                                layer.closeAll();
                                layer.msg("审核不通过", { icon: 6}, function() {
                                    // 刷新
                                    location.reload();
                                });
                            }
                        })
                    }
                });
            }

            var url = 'http://blnance66.com/Admin/Attest/banner.html?id='+data.authentication_id;

            if (layEvent == "detail") {
                layer.open({
                    type: 2,
                    title: "认证信息：",
                    content: url,
                    area: ['50%', '70%']
                });
            }

            

        });

        // 搜索
        function searchUser() {

            var url = "<?php echo U(getAttest);?>";
            var data = {
                user_name: $('#user_name').val()
            };

            layer.load(1);
            tableReload.reload({
                url: url,
                where: data,
                page: {
                    curr: 1
                },
                done: function (){
                    layer.closeAll();
                }
            });
        }

        // 搜索按钮
        $("#searchBtn").click(function () {
            searchUser();
        });

        // 当按下回车
        $(document).keypress(function (ev) {
            if( ev.keyCode == 13 ) {
                searchUser();
            }
        });
    });

</script>


<script type="text/html" id="operation" >
    <a class="layui-btn layui-btn-mini" lay-event="authorization">通过</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="sealNumber">不通过</a>

</script>

<script type="text/html" id="detail" >
    <a class="layui-btn layui-btn-mini" lay-event="detail">查看</a>
</script>


<script type="text/html" id="statusInfo">
    {{# if(d.status == 1) { }}
        <a style="color: green;">{{ d.status_name }}</a>
    {{# } else { }}
        <a style="color: red;">{{ d.status_name }}</a>
    {{# } }}
</script>