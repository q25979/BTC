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
    [name=status] { width: 20%; }
    .details { padding: 10px; }
    .details span { font-size: 16px; }
    .details>.l { display: block; margin-top: 5px;margin-left: 15px; }
    .details>.l>span { color: #7358ff; }
    .cause-div { margin: 10px; }
    .cause-div>button { margin-top: 10px; }
</style>
<body>
<div class="x-body">
    <blockquote class="layui-elem-quote">提现列表</blockquote>
    <nav class="navbar navbar-default">
        <select name="status" lay-verify="required" lay-filter="form_status">
            <option value="all">全部</option>
            <option value="0">审核中</option>
            <option value="1">提现成功</option>
            <option value="-1">拒绝提现</option>
        </select>
        <!-- <button typr="button" class="btn btn-default" id="deletedBtn">批量删除</button> -->
    </nav>
    <table id="withdraw" lay-filter="orderList"></table>
</div>
</body>

<script>
    layui.use(['table', 'form'], function () {
        var form  = layui.form;
        var table = layui.table;

        layer.load(2);
        var reload = table.render({
            elem: '#withdraw',
            url: '<?php echo U(get);?>',
            page: true,
            id  : 'orderList',
            cols: [[
                {checkbox: true, type: 'checkbox', fixed: 'left'}
                ,{field: 'user_name', title: '用户名', align: 'center', width:100,fixed: 'left'}
                ,{field: 'maincoin_id', title: 'id', align: 'center', width: 90}
                ,{field: 'tel', title: '用户电话', align: 'center', width: 140}
                ,{field: 'email', title: '用户邮箱', align: 'center', width: 160}
                ,{field: 'up_price_name', title: '提现金额', align: 'center', width: 100}
                ,{field: 'create_time', title: '申请时间', align: 'center', width: 140}
                ,{field: 'update_time_name', title: '审核时间', align: 'center', width: 140, sort: true}
                ,{title: '提现状态', align: 'center', width: 120, sort: true, templet: '#status'}
                ,{title: '操作', width: 180, align: 'center', toolbar: '#operation', fixed: 'right'}
            ]],
            done: function(res) {
                layer.closeAll();
            }
        });

        table.on('tool(orderList)', function(o) {
            var d  = o.data;
            var ev = o.event;
            var tr = o.tr;

            // 删除
            if (ev == 'deleted') {
                deleted(d.up_order_id);
            }

            // 通过
            if (ev == 'pass') {
                if (isStatus(d.status) == false) return false;
                layer.confirm('确认通过审核后无法重复操作，是否继续？', function() {
                    layer.closeAll();

                    var n = nonceStr();
                    var s = config.verify_str + n + d.up_order_id;

                    var u = '<?php echo U(pass);?>';
                    var data = {
                        up_order_id: d.up_order_id,
                        nonce_str  : n,
                        sign: hex_md5(s)
                    };

                    layer.load(2);
                    $.post(u, data, function(res) {
                        layer.closeAll();

                        if (res.code == 0) {
                            layer.msg('审核通过', { icon: 6 }, function() {
                                tableReload('<?php echo U(get);?>', null);
                            });

                        } else {
                            layer.msg('操作审核失败', { icon: 5 });
                        }
                    });
                });
            }

            // 不通过
            if (ev == 'notPass') {
                if (isStatus(d.status) == false) return false;
                layer.confirm('拒绝提现后会把金额返回给用户，是否继续？', function() {
                    var h  = ''; 
                        h += '<div class="cause-div">';
                        h += '<textarea name="cause-text" class="layui-textarea"></textarea>';
                        h += '<button id="notPassBtn" class="layui-btn layui-btn-normal">确认</button>';
                        h += '</div>';

                    layer.open({
                        type : 1,
                        title: '拒绝原因',
                        area : ['40%', '30%'],
                        content: h
                    });

                    $('#notPassBtn').click(function() {
                        var u = '<?php echo U(notPass);?>';
                        var n = nonceStr();
                        var s = config.verify_str + n + d.up_price + d.up_order_id;
                        var data = {
                            up_order_id: d.up_order_id,
                            user_id: d.user_id,
                            price  : d.up_price,
                            refusal_cause: $('[name=cause-text]').val(),
                            nonce_str    : n,
                            sign: hex_md5(s)
                        };

                        layer.load(2);
                        $.post(u, data, function(res) {
                            layer.closeAll();
                            console.log(res);

                            if (res.code == 0) {
                                layer.msg('拒绝成功', { icon: 6 }, function() {
                                    tableReload('<?php echo U(get);?>', null);
                                });

                            } else {
                                layer.msg('拒绝失败', { icon: 5 });
                            }
                        });
                    });
                });
            }

            // 查看详情
            if (ev == 'details') {
                var h = `
                    <div class='details'>
                        <span class='l'>用户名: <span>${d.user_name}</span></span>
                        <span class='l'>ID: <span>${d.maincoin_id}</span></span>
                        <span class='l'>用户电话: <span>${d.tel}</span></span>
                        <span class='l'>用户邮箱: <span>${d.email}</span></span>
                        <span class='l'>提现金额: <span>${d.up_price_name}</span></span>
                        <span class='l'>申请时间: <span>${d.create_time}</span></span>
                        <span class='l'>审核时间: <span>${d.update_time_name}</span></span>
                        <span class='l'>提现状态: <span>${d.status_name}</span></span>
                        <span class='l'>银行名称: <span>${d.bank_name}</span></span>
                        <span class='l'>分行名称: <span>${d.bank_branch}</span></span>
                        <span class='l'>银行卡号: <span>${d.bank_num}</span></span>
                        <span class='l'>持卡人名字: <span>${d.bank_account}</span></span>
                        <span class='l'>拒绝原因: <span>${d.refusal_cause}</span></span>
                    </div>
                `;

                layer.open({
                    type: 1,
                    area: ['40%', '80%'],
                    title: '提现详情',
                    content: h
                });
            }
        });

        $('[name=status]').change(function() {
            var status = $('[name=status]').val()
            search(status);
        });

        // 批量删除
        $("#deletedBtn").click(function() {
            var checkStatus = table.checkStatus('orderList');
            var id = '';

            for (var i=0; i<checkStatus.data.length; i++) {
                id += "," + checkStatus.data[i].up_order_id;
            }

            if (id == '') {
                layer.msg('请选择删除对象', { icon: 5 });
                return false;
            }

            deleted(id);
        });

        /**
         * 删除
         * 
         * @param  string id
         */
        var deleted = function(id) {
            layer.confirm('确认删除商品?', {
                btn: ['是', '否']
            }, function() {
                layer.closeAll();
                var url  = '<?php echo U(deleted);?>';
                var nstr = nonceStr();
                var md5String = 'oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1' + nstr + id;
                var data = {
                    up_order_id : id,
                    nonce_str: nstr,
                    sign: hex_md5(md5String)
                };

                layer.load(2);
                $.post(url, data, function(res) {
                    layer.closeAll();

                    if (res.code == 0) {
                        layer.msg('删除成功!', { icon: 6 }, function() {
                            tableReload('<?php echo U(get);?>', null);
                        });

                    } else {
                        layer.msg('删除失败！', { icon: 5 });
                    }
                });
            });
        }

        // 绑定事件
        document.onkeyup = function(event) {
            var e = event || window.event;
            var keyCode = e.keyCode || e.which;

            if (keyCode == 13) {
                search();
            }
        };

        /**
         * 搜索
         *
         * @param string name 需要搜索的数据 
         */
        var search = function(name) {
            var url  = '<?php echo U(search);?>';
            var data = { name: name };

            tableReload(url, data);
        }

        /**
         * 状态已经改变
         *
         * @param string status 状态
         */
        var isStatus = function(status) {
            if (parseInt(status) != 0) {
                layer.msg('已经操作过的数据不能重复操作', { icon: 5 });
                return false;
            }

            return true;
        }

        // 表格重载
        var tableReload = function(url, data) {
            reload.reload({
                url: url,
                where: data,
                page: 1
            });
        }
    });
</script>

<script type="text/html" id="operation" >
    <a class="layui-btn layui-btn-mini layui-btn-normal" lay-event="details">详情</a>
    <a class="layui-btn layui-btn-mini" lay-event="pass">完成</a>
    <a class="layui-btn layui-btn-mini layui-btn-warm" lay-event="notPass">拒绝</a>
</script>

<script type="text/html" id="cause">
    <a class="layui-btn layui-btn-mini layui-btn-normal" lay-event="cause">查看</a>
</script>

<script type="text/html" id="status">
    {{# if(d.status == 0) { }}
    <a style="color: blue">{{ d.status_name }}</a>
    {{# } }}
    {{# if(d.status == 1) { }}
    <a style="color: green">{{ d.status_name }}</a>
    {{# } }}
    {{# if(d.status == -1) { }}
    <a style="color: red">{{ d.status_name }}</a>
    {{# } }}
</script>