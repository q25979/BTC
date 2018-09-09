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
        <blockquote class="layui-elem-quote">我的钱包地址</blockquote>
        <table id="AddressList" lay-filter="AddressList"></table>
    </div>
</body>

<script>

    layui.use('table', function () {
        var table = layui.table;
   
        table.render({
            elem: "#AddressList",
            url: "<?php echo U('address');?>",
            cols: [[
                {field: 'address', title: '地址', align: 'center', width:300, sort: true, fixed: 'left'}
                ,{field: 'address_url', title: '地址二维码', align: 'center', width: 150,templet: '#showimg' }
                ,{field: 'type_name', title: '币种种类', align: 'center', width: 140, }
                ,{field: 'update_time', title: '时间', align: 'center', width: 140,}
                ,{title: '操作', width: 150, align: 'center', toolbar: '#operation'}   
            ]],
            done: function (res) {
                
            }

        });

        // 监听工具栏事件
        table.on('tool(AddressList)', function (obj) {
            var data = obj.data;    // 获得当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前行 tr 的 dom 对象
            var url = 'http://blnance66.com/Admin/Walletaddress/AddreUpdate.html?id='+data.wallet_address_id;

            if (layEvent == 'sealNumber') {
                layer.open({
                    type: 2,
                    title: '地址信息',
                    area: ['60%', '80%'],
                    content: url,
                    yes: function () {
                        layer.closeAll();
                    }
                });
            }
        });
            
    });

</script>


<script type="text/html" id="operation" >
    <a class="layui-btn  layui-btn-mini" lay-event="sealNumber">编辑</a>
</script>

<script type="text/html" id="showimg">
    <img src="{{ d.address_url }}" alt="" style="width:100px ;height:50px ;">
</script>