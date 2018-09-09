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
    .layui-select {width : 180px;}
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">确认列表</blockquote>
        <nav class="navbar navbar-default">
            <select class="layui-select" name="currency_type">
              <option value="">请选择货币类型</option>
              <option value="1">比特币</option>
              <option value="2">以太币</option>
            </select>
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
        </nav>
        <table id="SendListAll" lay-filter="SendListAll">
        </table>
    </div>
</body>
<script>
    layui.use(['table'], function () {
        var data;
        var table = layui.table;
        var tableReload = table.render({
            elem: "#SendListAll",
            url: "<?php echo U(getSendListAll);?>",
            page: true,
            cols: [[
                 {field: 'send_address', title: '发送地址', align: 'center', width:150, sort: true, fixed: 'left'}
                ,{field: 'maincoin_id', title: '发送ID', align: 'center', width: 100, sort: true}
                ,{field: 'user_name', title: '用户名', align: 'center', width: 117, sort: true}
                ,{field: 'number', title: '数量', align: 'center', width: 100, sort: true}
                ,{field: 'currency_type_name', title: '交易币种', align: 'center', width: 100, sort: true}
                ,{field: 'status_name', title: '状态', align: 'center', width: 100, sort: true,
                  templet: '#statusInfo'}
                ,{field: 'remark', title: '审核意见', align: 'center', width: 100, sort: true}
                ,{field: 'create_time', title: '创建时间', align: 'center', width: 100, sort: true}
                ,{title: '操作', width: 200, align: 'center', toolbar: '#operation'}
            ]],
            done: function(res) {
                data = res;
            }
        });
        
        // 监听工具栏的事件
        table.on('tool(SendListAll)', function (obj) {
            var data = obj.data;    // 获取当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前 tr 的 dom 对象

            // 查看
            if(layEvent == "lookBtn") {
                layer.open({
                title: "发送详细",
                content: "留言：" + data.leave_words,
                btn: ["关闭"],
                yes: function (res){
                    layer.closeAll();
                }
             });

            }

        });

        $('#searchBtn').click(function(){
            search();
        });
        // 搜索
        function search() {

            var url = "<?php echo U(getSendListAll);?>";
            var data = {
                currency_type: $('[name=currency_type]').val(),
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

    });
</script>


<script type="text/html" id="operation" >
    <a class="layui-btn layui-btn-mini" lay-event="lookBtn">查看</a>
</script>

<script type="text/html" id="statusInfo">
    {{# if(d.status == 0) { }}
        <a style="color: green;">{{ d.status_name }}</a>
    {{# } else if(d.status == 1) { }}
        <a style="color: red;">{{ d.status_name }}</a>
    {{# } else if(d.status == 2) { }}
        <a style="color: yellow;">{{ d.status_name }}</a>
    {{# } else { }}
        <a style="color: gray;">{{ d.status_name }}</a>
    {{# } }}
</script>