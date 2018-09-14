<?php if (!defined('THINK_PATH')) exit();?><head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/font.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/xy.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/plug-in/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/xadmin.css" />

	<script type="text/javascript" src="http://localhost:8081/Public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="http://localhost:8081/Public/js/vue.min.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/plug-in/layui/layui.js"></script>
	<script type="text/javascript" src="http://localhost:8081/Public/js/xadmin.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/md5.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/config.js"></script>
    <script type="text/javascript" src="http://localhost:8081/Public/js/function.js"></script>
    

	<!--[if lt IE 9]>
        alert("你的浏览器版本，请更换浏览器，推荐谷歌");
    <![endif]-->
</head>






<link rel="stylesheet" type="text/css" href="http://localhost:8081/Public/css/bootstrap.min.css" />

<style>
    .navbar {margin-bottom: 0; line-height: 50px; padding: 0 10px;}
    .navbar>input {width: 20%; display: inline;}
    .navbar>button {height: 34px; transform: translateY(-2px);}
    .layui-elem-quote {font-size: 15px;}
    .layui-form-label {padding: 9px 10px;}
    .layui-input {width: 200px;margin-left: 50px;margin-top:30px;}
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">账户</blockquote>
        <nav class="navbar navbar-default">
            <input type="text" id="user_name" class="form-control" placeholder="请输入用户名" />
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
        </nav>
        <table id="Accountlist" lay-filter="Accountlist"></table>
    </div>
</body>

<script>

    var html = "<div class='updataInput'>";
        html += "<input class = 'layui-input' placeholder='请输入金额' name='textContent'>";
        html += "</input>";
        html += "</div>";



    layui.use('table', function () {
        var table = layui.table;
        var nonce_str = nonceStr(32);//随机32个随机数
        var tableReload = table.render({
            elem: "#Accountlist",
            url: "<?php echo U('Account/getAccountList');?>",
            page: true,
            cols: [[
                 {field: 'user_name', title: '用户名', align: 'center', width: 150,templet: '#showimg', fixed: 'left'}
                ,{field: 'btc_balance', title: '比特币余额', align: 'center', width: 100, templet: '#showicon'}
                ,{field: 'eth_balance', title: '萊特幣余额', align: 'center', width: 100,templet: '#showimg'}
                ,{field: 'freeze_balance', title: '冻结金额', align: 'center', width: 100,templet: '#showimg'}
                ,{field: 'extract_balance', title: '可提现余额', align: 'center', width: 100,templet: '#showimg'}
                ,{field: 'bank_name', title: '银行名称', align: 'center', width: 100,templet: '#showimg'}
                ,{field: 'bank_branch', title: '分行名称', align: 'center', width: 100,templet: '#showimg'}
                ,{field: 'bank_num', title: '银行卡号', align: 'center', width: 180,templet: '#showimg'}
                ,{field: 'bank_account', title: '持卡人', align: 'center', width: 100,templet: '#showimg'}

                ,{field: 'status', title: '状态', align: 'center', width: 100,templet: '#statusInfo'}
                ,{field: 'status_nam', title: '操作', align: 'center', width: 180,templet: '#operation'}
                
            ]],
            done: function (res) {
                
            }

        });

        // 监听工具栏的事件
        table.on('tool(Accountlist)', function (obj) {
            var data = obj.data;    // 获取当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前 tr 的 dom 对象

            // 详情
            if(layEvent == "recoverBtn") {
                layer.open({
                    type: 1,
                    title: "恢复金额",
                    content: html,
                    btn: ["确定"],
                    area: ['50%', '60%'],
                    yes: function (res){
                        if (isNaN(Number($("input[name ='textContent']").val()))
                         || Number($("input[name ='textContent']").val()) > data.freeze_balance
                         || $("input[name ='textContent']").val() == null) {
                            layer.msg("对不起，输入金额大于冻结金额！请重新输入", {icon: 2});
                            return;
                        }


                        var money = $("input[name ='textContent']").val();
                        layer.closeAll();
                        //Ajax获取
                        $.post('<?php echo U('Account/updataFreeze');?>', 
                        {account_id : data.account_id,type : 1, money:money,
                        nonce_str : nonce_str,
                        sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + data.account_id + nonce_str)}, // 发送签名
                         function(str){
                            if (str.code == 0) {
                                layer.open({
                                title: "恢复状态",
                                content: "恢复成功！",
                                btn: ["关闭"],
                                yes: function (res){
                                    layer.closeAll();
                                    location.reload();
                                }
                             });
                            }else{
                                layer.open({
                                title: "恢复状态",
                                content: "恢复失败！",
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

            if(layEvent == "freezeBtn") {

                layer.open({
                    type: 1,
                    title: "冻结金额",
                    content: html,
                    btn: ["确定"],
                    area: ['50%', '50%'],
                    yes: function (res){

                        if (isNaN(Number($("input[name ='textContent']").val()))
                         || Number($("input[name ='textContent']").val()) > data.extract_balance
                         || $("input[name ='textContent']").val() == null) {
                            layer.msg("对不起，输入金额大于可提现余额！请重新输入", {icon: 2});
                            return;
                        }

                        var money = $("input[name ='textContent']").val();
                        layer.closeAll();
                        //Ajax获取
                        $.post('<?php echo U('Account/updataFreeze');?>', 
                        {account_id : data.account_id,type : 2, money:money,
                        nonce_str : nonce_str,
                        sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + data.account_id + nonce_str)}, // 发送签名
                         function(str){
                            console.log(str);
                            if (str.code == 0) {
                                layer.open({
                                title: "冻结状态",
                                content: "冻结成功！",
                                btn: ["关闭"],
                                yes: function (res){
                                    layer.closeAll();
                                    console.log(res);
                                    location.reload();
                                }
                             });
                            }else{
                                layer.open({
                                title: "冻结状态",
                                content: "冻结失败！",
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

            if (layEvent == 'modification') {
                var url ="http://localhost:8081/Admin/Account/AccountUpdata.html?id=" + data.account_id;

                layer.open({
                    type: 2,
                    title:'用户信息修改',
                    content : url,
                    area: ['50%', '80%'],
                });
            }
            

        });

        // 搜索
        function searchUser() {

            var url = "<?php echo U(getAccount);?>";
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
    <a class="layui-btn layui-btn-mini" lay-event="recoverBtn">恢复</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="freezeBtn">冻结</a>

</script>

<script type="text/html" id="statusInfo">
    {{# if(d.status == 0) { }}
        <a style="color: green;">{{ d.status_name }}</a>
    {{# } else { }}
        <a style="color: red;">{{ d.status_name }}</a>
    {{# } }}
</script>