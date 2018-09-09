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
        <nav class="navbar navbar-default">
            <input type="text" id="bank_name" class="form-control" placeholder="请输出银行名称" />
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
        </nav>
        <table id="BankList" lay-filter="BankList"></table>
    </div>
</body>

<script>
    var nonce_str = nonceStr(32);//随机32个随机数
    layui.use('table', function () {

        var table = layui.table;
        var tableReload = table.render({
            elem: "#BankList",
            url: "<?php echo U('getBank');?>",
            page: true,
            cols: [[
                 {field: 'bank_name', title: '银行名称', align: 'center', width: 140,fixed: 'left'}
                ,{field: 'bank_type_name', title: '银行类型', sort: true, align: 'center', width: 100}
                ,{field: 'bank_parent_name', title: '所属银行', align: 'center', width: 100}
                ,{field: 'create_time', title: '创建时间', width: 120, align: 'center'}
                ,{title: '操作', width: 150, align: 'center', toolbar: '#operation'}
            ]],
            done: function (res) {
            }

        });
        // 监听工具栏的事件
        table.on('tool(BankList)', function (obj) {
            var data = obj.data;    // 获取当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前 tr 的 dom 对象

            //删除
            if(layEvent == "detele"){
                layer.open({
                     title: "提示",
                     content: '确认删除当前记录！',
                     btn: ["确认", "取消"],
                     yes: function (res){
                         layer.closeAll();
                         delRecord(data.bank_id);
                     }
                });
            }

            // 删除
            function delRecord(id) {
               
                var data = {
                    bank_id : id,
                    nonce_str : nonce_str,
                    sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + id + nonce_str)
                };

                var url = "<?php echo U(delete);?>";

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
                        }else{
                            layer.msg("删除失败!" , {icon: 1} , function(){
                                // 刷新
                                location.reload() || window.location.reload();
                            });
                        }
                    }
                });
            }

        });


        // 搜索
        function search() {

            var url = "<?php echo U(getBank);?>";
            var data = {
                bank_name: $('#bank_name').val()
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
            search();
        });

    });

</script>


<script type="text/html" id="operation" >
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="detele">删除</a>    
</script>