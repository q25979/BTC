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






<link rel="stylesheet" type="text/css" href="http://192.168.0.128:8081/Public/css/bootstrap.min.css" />

<style>
    .navbar {margin-bottom: 0; line-height: 50px; padding: 0 10px;}
    .navbar>input {width: 20%; display: inline;}
    .navbar>button {height: 34px; transform: translateY(-2px);}
    .layui-elem-quote {font-size: 15px;}
    .layui-form-label {padding: 9px 10px;}
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">用户问题设置</blockquote>
        <nav class="navbar navbar-default">
            <input type="text" id="username" class="form-control" placeholder="请输入用户名称" />
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
        </nav>
        <table id="ContactList" lay-filter="ContactList"></table>
    </div>
</body>

<script>

    layui.use('table', function () {
        var table = layui.table;
   
        var tableReload = table.render({
            elem: "#ContactList",
            url: "<?php echo U('System/ContactList');?>",
            page: true,
            cols: [[
                {field: 'system_order', title: '交易ID', align: 'center', width: 160,fixed: 'left' }                
                ,{field: 'email', title: '联系邮箱', align: 'center', width: 120,}
                ,{field: 'name', title: '联系人', align: 'center', width: 100,}
                ,{field: 'topic', title: '问题标题', align: 'center', width: 140,}
                ,{field: 'content', title: '问题内容', align: 'center', width: 140,}
                ,{field: 'file_address', title: '问题图片', align: 'center', width: 140,templet: '#showimg'}
                ,{field: 'create_time', title: '时间', align: 'center', width: 120,}
                ,{title: '操作', width: 180, align: 'center', toolbar: '#operation'}   
            ]],
            done: function (res) {
                console.log('res',res);
            }

        });

        // 32位随机数
        var nonce_str = nonceStr(32);

        // 监听工具栏事件
        table.on('tool(ContactList)', function (obj) {
            var data = obj.data;    // 获取当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前 tr 的 dom 对象

            var url ="<?php echo U(ProblemDetil);?>"+'?id=' + data.problem_id;  // 要发送的链接

            // 详情
            if(layEvent == "detail") {
                layer.open({
                    type: 2,
                    title: "查看详情",
                    maxmin: true,
                    area: ["65%", "90%"],
                    content: url,
                });
            }

            //删除
            if(layEvent == "detele"){
                layer.open({
                     title: "提示",
                     content: '确认删除当前记录！',
                     btn: ["确认", "取消"],
                     yes: function (res){
                         layer.closeAll();
                         delRecord(data.problem_id, 1);
                     }
                });
            }

            // 删除
            function delRecord(id , status) {
                if(status) {
                    var data = {
                        problem_id : id,
                        nonce_str : nonce_str,
                        sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + id + nonce_str)
                    };
                }else {
                    data = {
                        problem_id : id,
                        nonce_str : nonce_str,
                        sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + id + nonce_str)
                    };
                }

                var url = "<?php echo U(deleteUserProblem);?>";

                layer.load(2);
                $.ajax({
                    url : url,
                    data, data,
                    type: 'post',
                    success: function(res) {
                        layer.closeAll();

                        if(parseInt(res.code) == 0) {
                            layer.msg("删除成功!" , {icon: 1} , function(){
                                // 刷新
                                location.reload() || window.location.reload();
                            });
                            return false;
                        }
                    }
                });
            }
        });


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

            // 搜索
            function searchUser() {

                var url = "<?php echo U(UserProblemSearch);?>";
                var data = {
                    user_name: $('#username').val()
                };

                layer.load(2);
                tableReload.reload({
                    url: url,
                    where: data,
                    page: {
                        curr: 1
                    },
                    done: function(res){
                        layer.closeAll();
                    }
                });
            }
    });

</script>


<script type="text/html" id="operation" >
    <a class="layui-btn layui-btn-normal layui-btn-mini" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="detele">删除</a>
</script>

<!--状态-->
<script type="text/html" id="showimg">
    <img src="{{ d.file_address}}" style="width: 80px; height: 50px;" />
</script>