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
    .navbar>input {width: 10%; display: inline;}
    .navbar>button {height: 34px; transform: translateY(-2px);}
    .layui-elem-quote {font-size: 15px;}
    .layui-form-label {padding: 9px 10px;}
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">常见问题设置</blockquote>
        <nav class="navbar navbar-default">
                <label class="layui-form-label" style="margin-top: 6px;">选择类型</label>
                <div class="layui-input-inline">
                    <select name="promble_type" lay-verify="required" style="height:5%" lay-search>
                        <option value="0">请选择问题类型</option>
                        <option value="1">发送与接收</option>
                        <option value="2">购买与出售</option>
                    </select>
                </div>
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
            <button typr="button" class="layui-btn layui-btn-normal" id="addBtn"><i class="layui-icon">&#xe608;</i> 添加</button>
        </nav>
        <table id="CoinList" lay-filter="CoinList"></table>
    </div>
</body>

<script>

    layui.use('table', function () {
        var table = layui.table;
   
        var tableReload = table.render({
            elem: "#CoinList",
            url: "<?php echo U('System/Problem');?>",
            page: true,
            cols: [[
                 {field: 'type_name', title: '问题类型', align: 'center', width: 150, fixed: 'left'}
                ,{field: 'en_content', title: '英文题目', align: 'center', width: 150, templet: '#showicon'}
                ,{field: 'tw_content', title: '繁体题目', align: 'center', width: 150,templet: '#showimg'}
                ,{field: 'en_content2', title: '英文内容', align: 'center', width: 150, templet: '#showicon'}
                ,{field: 'tw_content2', title: '繁体内容', align: 'center', width: 150,templet: '#showimg'}
                ,{field: 'create_time', title: '创建时间', align: 'center', width: 150,templet: '#showimg'}
                ,{title: '操作', width: 180, align: 'center', toolbar: '#operation'}   
            ]],
            done: function (res) {
            }

        });

    // 32位随机数
    var nonce_str = nonceStr(32);

        // 监听工具栏事件
        table.on('tool(CoinList)', function (obj) {
            var data = obj.data;    // 获得当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前行 tr 的 dom 对象

            //删除
            if(layEvent == "detele"){
                layer.open({
                     title: "提示",
                     content: '确认删除当前记录！',
                     btn: ["确认", "取消"],
                     yes: function (res){
                         layer.closeAll();
                         delRecord(data.common_problem_id, 1);
                     }
                });
            }
            // 查看
            if(layEvent == "lookBtn") {
                var l = /&lt;/g,
                    r = /&gt;/g,
                    f = /&quot;/g;

                data.tw_content2 = data.tw_content2
                    .replace(l, '<')
                    .replace(r, '>')
                    .replace(f, '"');
                    
                data.en_content2 = data.en_content2
                    .replace(l, '<')
                    .replace(r, '>')
                    .replace(f, '"');

                layer.open({
                    title: "问题详细",
                    content:"问题内容繁体：</br>" + data.tw_content2 + "</br></br></br></br>" + "问题内容英文：</br>" + data.en_content2,
                    btn: ["关闭"],
                    area:['100%','100%'],
                    yes: function (res){
                        layer.closeAll();
                    }
                });
            }

            // 删除
            function delRecord(id , status) {
                if(status) {
                    var data = {
                        common_problem_id : id,
                        nonce_str : nonce_str,
                        sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + id + nonce_str)
                    };
                }else {
                    data = {
                        common_problem_id : id,
                        nonce_str : nonce_str,
                        sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + id + nonce_str)
                    };
                }

                var url = "<?php echo U(deleteProblem);?>";

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

        var url = '<?php echo U(biscProblemAdd);?>';

            $("#addBtn").click(function(){
                layer.open({
                    type: 2,
                    title: "常见问题添加：",
                    content: url,
                    area: ['100%', '100%']
                });
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

            var url = "<?php echo U(searchProblem);?>";
            var data = {
                type: $('[name=promble_type]').val()
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
    <a class="layui-btn layui-btn-normal layui-btn-mini" lay-event="lookBtn">查看</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="detele">删除</a>
</script>