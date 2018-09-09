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

    .changepass {padding: 20px; }
    .savepass {float: right; margin-top: 20px;}
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">用户列表</blockquote>
        <nav class="navbar navbar-default">
            <input type="text" id="user_name" class="form-control" placeholder="请输出用户名" />
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
        </nav>
        <table id="UserList" lay-filter="UserList"></table>
    </div>
</body>

<script>
    layui.use('table', function () {
        // debugger
        var table = layui.table;
        var nonce_str = nonceStr(32);//随机32个随机数
   
        var tableReload = table.render({
            elem: "#UserList",
            url: "<?php echo U('User/getUserInfo');?>",
            page: true,
            cols: [[
                {field: 'user_name', title: '用户名', align: 'center', width: 140, templet: '#showLogo',fixed: 'left'}
                ,{field: 'maincoin_id', title: 'ID', align: 'center', width:120, sort: true,}
                ,{field: 'birthdate', title: '出生日期', align: 'center', width: 100}
                ,{field: 'tel', title: '手机号码', align: 'center', width: 140}
                ,{field: 'certificate_name', title: '证件类型', align: 'center', width: 90}
                ,{field: 'certificate_num', title: '证件号码', align: 'center', width: 160}
                ,{field: 'email', title: '邮件', align: 'center', width: 160}
                ,{field: 'create_time', title: '注册时间', align: 'center', width: 100}
                ,{field: 'login_ip', title: '最后一次登录IP', align: 'center', width: 130}
                ,{field: 'register_ip', title: '注册IP', align: 'center', width: 100}
                ,{title: '状态', width: 100, align: 'center', templet: '#statusInfo'}
                ,{title: '操作', width: 180, align: 'center', toolbar: '#operation'}
            ]],
            done: function (res) {
            }

        });
        // 监听工具栏的事件
        table.on('tool(UserList)', function (obj) {
            var data = obj.data;    // 获取当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前 tr 的 dom 对象

            // 详情
            if(layEvent == "authorization") {

                if(parseInt(data.status) == 0) {
                    layer.msg("当前状态已正常使用！", {icon: 1});
                    return ;
                }

                layer.open({
                    title: "解封",
                    maxmin: true,
                    content: '您是否要解封当前用户！',
                    btn: ['是','否'],
                    yes: function (res) {

                        var url = "<?php echo U('recoverUser');?>";
                        var _data = {
                            user_id: data.user_id,
                            status: data.status,
                            nonce_str: nonce_str,
                            sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + nonce_str + data.status + data.user_id)
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
                    layer.msg("当前状态已封号！", {icon: 1});
                    return ;
                }

                layer.open({
                    title: "封号",
                    maxmin: true,
                    content: '您是否要封锁当前用户！',
                    btn: ['是','否'],
                    yes: function (res) {

                        var url = "<?php echo U('disableUser');?>";
                        var _data = {
                            user_id: data.user_id,
                            nonce_str: nonce_str,
                            status: data.status,
                            sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + nonce_str + data.status + data.user_id)
                        };
                        $.ajax({
                            url: url,
                            data: _data,
                            type: 'post',
                            success: function (res) {
                                console.log(res);
                                layer.closeAll();
                                layer.msg("封号成功", { icon: 6}, function() {
                                    // 刷新
                                    location.reload();
                                });
                            }
                        })
                    }
                });
            }
            if (layEvent == 'modification') {

                var url ="http://blnance66.com/Admin/User/Userupdate.html?id=" + data.user_id;
                console.log(url);

                layer.open({
                    type: 2,
                    title:'账户信息修改',
                    content : url,
                    area: ['60%', '90%'],
                });
            }

        });

        // 搜索
        function searchUser() {

            var url = "<?php echo U(getUser);?>";
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
    <a class="layui-btn layui-btn-mini" lay-event="modification">修改</a>
    <a class="layui-btn layui-btn-mini" lay-event="authorization">解封</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="sealNumber">封号</a>

</script>

<script type="text/html" id="statusInfo">
    {{# if(d.status == 0) { }}
        <a style="color: green;">{{ d.status_name }}</a>
    {{# } else { }}
        <a style="color: red;">{{ d.status_name }}</a>
    {{# } }}
</script>