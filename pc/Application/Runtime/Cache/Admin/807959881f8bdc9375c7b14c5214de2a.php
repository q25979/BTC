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

    .textarea {width: 300px;margin: 0 auto; margin-top: 5px;}
    textarea {width: 300px; height: 140px;}
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">审核列表</blockquote>
        <nav class="navbar navbar-default">
            <select class="layui-select" name="currency_type">
              <option value="">请选择货币类型</option>
              <option value="1">比特币</option>
              <option value="2">以太币</option>
            </select>
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
        </nav>
        <table id="SendList" lay-filter="SendList">
        </table>
    </div>
</body>
<script>

    var html = "<div class='textarea'>";
        html += "<textarea name='textContent'>";
        html += "</textarea>";
        html += "</div>";

    layui.use(['table'], function () {
        var data;
        var table = layui.table;

        // 32位随机数
        var nonce_str = nonceStr(32);

        var tableReload = table.render({
            elem: "#SendList",
            url: "<?php echo U(getSendList);?>",
            page: true,
            cols: [[
                 {field: 'send_address', title: '发送地址', align: 'center', width:150, sort: true, fixed: 'left'}
                ,{field: 'maincoin_id', title: '发送ID', align: 'center', width: 117, sort: true}
                ,{field: 'user_name', title: '用户名', align: 'center', width: 117, sort: true}
                ,{field: 'number', title: '数量', align: 'center', width: 117, sort: true}
                ,{field: 'currency_type_name', title: '交易币种', align: 'center', width: 117, sort: true}
                ,{field: 'status_name', title: '状态', align: 'center', width: 117, sort: true,
                  templet: '#statusInfo'}
                ,{field: 'remark', title: '审核意见', align: 'center', width: 117, sort: true}
                ,{field: 'create_time', title: '创建时间', align: 'center', width: 117, sort: true}
                ,{title: '操作', width: 200, align: 'center', toolbar: '#operation'}
            ]],
            done: function(res) {
                data = res;
            }
        });
        // 监听工具栏的事件
        table.on('tool(SendList)', function (obj) {
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

            // 通过
            if (layEvent == "passBtn") {
                layer.open({
                    type: 1,
                    title: "备注",
                    content: html,
                    btn: ["确定"],
                    area: ['400px', '250px'],
                    yes: function (res){
                        layer.closeAll();
                        var remark = $("textarea[name ='textContent']").val();
                        //Ajax获取
                        $.post('<?php echo U('sendAuditInfo');?>', 
                            {send_id : data.send_id,
                            status : "1",
                            remark:remark,
                            nonce_str : nonce_str,
                            sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + nonce_str + data.send_id + "1")},
                            function(str){
                            if (str.code == 0) {
                                layer.open({
                                title: "通过状态",
                                content: "审核成功！",
                                btn: ["关闭"],
                                yes: function (res){
                                    layer.closeAll();
                                    location.reload();
                                }
                             });
                            }else{
                                layer.open({
                                title: "通过状态",
                                content: "审核失败！",
                                btn: ["关闭"],
                                yes: function (res){
                                    layer.closeAll();
                                    location.reload();
                                }
                             });
                            }   
                          

                        });
                    }
                });
            }

            // 取消
            if(layEvent == "cancelBtn") {
                layer.open({
                    type: 1,
                    title: "备注",
                    content: html,
                    btn: ["确定"],
                    area: ['400px', '250px'],
                    yes: function (res){
                        layer.closeAll();
                        var remark = $("textarea[name ='textContent']").val();
                        //Ajax获取
                        $.post('<?php echo U('sendLose');?>', 
                            {send_id : data.send_id,
                            status : "-1",
                            remark:remark,
                            nonce_str : nonce_str,
                            sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + nonce_str + data.send_id + "-1")},
                            function(str){
                            if (str.code == 0) {
                                layer.open({
                                title: "通过状态",
                                content: "审核成功！",
                                btn: ["关闭"],
                                yes: function (res){
                                    layer.closeAll();
                                    location.reload();
                                }
                             });
                            }else{
                                layer.open({
                                title: "通过状态",
                                content: "审核失败！",
                                btn: ["关闭"],
                                yes: function (res){
                                    layer.closeAll();
                                    location.reload();
                                }
                             });
                            }
                          
                        });
                    }
                });
            }

        });

        $('#searchBtn').click(function(){
            search();
        });
        // 搜索
        function search() {

            var url = "<?php echo U(getSendList);?>";
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
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="passBtn">通过</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="cancelBtn">失败</a>
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