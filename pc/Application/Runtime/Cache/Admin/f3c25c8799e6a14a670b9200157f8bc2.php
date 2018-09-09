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
    .layui-switch{
        position: absolute;
        right: 20px;
        top: 5px;
    }
    ..layui-form-switch em {
        width: 60px
    }
</style>
<body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">公告设置</blockquote>
        <nav class="navbar navbar-default">
            <input type="text" id="sys_name" class="form-control" placeholder="请输入公告名称"/>
            <button typr="button" class="btn btn-default" id="searchBtn">搜索</button>
            <button typr="button" class="layui-btn layui-btn-normal" id="addBtn"><i class="layui-icon">&#xe608;</i> 添加</button>
            <div class="layui-form  layui-switch">
                <input type="checkbox" id="service_switch" lay-filter= "service_switch" lay-skin="switch" lay-text="开启|关闭">
            </div>
        </nav>
        
        <table id="NoticeList" lay-filter="NoticeList"></table>
    </div>
</body>

<script>

    layui.use(['table','form'], function () {
        var table = layui.table;
        var form = layui.form;
       
        table.render({
            elem: "#NoticeList",
            url: "<?php echo U('System/Notice');?>",
            page: true,
            cols: [[
                 {field: 'tw_content', title: '公告标题繁体', align: 'center', width: 150,sort: true,fixed: 'left'}
                ,{field: 'en_content', title: '公告标题英文', align: 'center', width: 150,sort: true}
                ,{field: 'tw_content2', title: '公告内容繁体', align: 'center', width: 150,sort: true}
                ,{field: 'en_content2', title: '公告内容英文', align: 'center', width: 150,sort: true}
                ,{field: 'bulletin_issue_time', title: '发布时间', align: 'center', width: 150,sort: true}
                ,{field: 'status_name', title: '状态', align: 'center', width: 150,templet: '#showimg',sort: true}
                ,{title: '操作', width: 180, align: 'center', toolbar: '#operation'}   
            ]],
            done: function(res) {
                if (res.home == 0) {
                    $('#service_switch')[0]['checked'] = true;
                    console.log($('#service_switch')[0]['checked']);
                }else{
                    $('#service_switch')[0]['checked'] = false;
                }
                form.render('checkbox');
            }
        });

        form.on('switch(service_switch)',function(obj){

            if (obj.elem.checked) {//如果开启
                $.post('<?php echo U('noticeSwicth');?>',{bulletin_status : '0'},function(data){
                    if (data.code == '0') {
                        layer.open({
                            title: "开启状态",
                            content: "开启成功！",
                            btn: ["关闭"],
                         });
                    }else{
                        layer.open({
                            title: "开启状态",
                            content: "开启失败！",
                            btn: ["关闭"],
                         });
                    }

                });
            }else{
                $.post('<?php echo U('noticeSwicth');?>',{bulletin_status : '1'},function(data){
                    if (data.code == '0') {
                        layer.open({
                            title: "开启状态",
                            content: "关闭成功！",
                            btn: ["关闭"],
                         });
                    }else{
                        layer.open({
                            title: "开启状态",
                            content: "关闭失败！",
                            btn: ["关闭"],
                         });
                    }
                });
            }
        });

        // 32位随机数
        var nonce_str = nonceStr(32);

        // 监听工具栏事件
        table.on('tool(NoticeList)', function (obj) {
            var data = obj.data;    // 获得当前数据
            var layEvent = obj.event;   // 获得 lay-event 对应的值
            var tr = obj.tr;    // 获得当前行 tr 的 dom 对象

            // 查看
            if(layEvent == "lookBtn") {
                layer.open({
                    title: "公告内容",
                    content:"公告内容繁体：</br>" 
                    + sg.htmlShow(data.tw_content2) 
                    + "</br></br></br></br>" + "公告内容英文：</br>" 
                    + sg.htmlShow(data.en_content2),
                    
                    btn: ["关闭"],
                    area:['50%','60%'],
                    yes: function (res){
                        layer.closeAll();
                    }
                });
            }

            // 发布
            if(layEvent == "issueBtn") {
                layer.open({
                    content:"你确定要发布该公告吗？",
                    btn: ["确定"],
                    yes: function (res){
                        layer.closeAll();
                        $.post('<?php echo U('updataNotice');?>', 
                            {
                                bulletin_id : data.bulletin_id,
                                nonce_str : nonce_str,
                                sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + data.bulletin_id + nonce_str)
                            },
                            function(str){
                            if (str.code == 0) {
                                layer.open({
                                title: "发布状态",
                                content: "发布成功！",
                                btn: ["关闭"],
                                yes: function (res){
                                    layer.closeAll();
                                    location.reload();
                                }
                             });
                            }else{
                                layer.open({
                                title: "发布状态",
                                content: "发布失败！",
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

            // 删除
            if(layEvent == "deleteBtn") {
                layer.open({
                    content:"你确定要删除该公告吗？",
                    btn: ["确定"],
                    yes: function (res){
                        layer.closeAll();
                        $.post('<?php echo U('deleteNotice');?>', 
                            {
                                bulletin_id : data.bulletin_id,
                                nonce_str : nonce_str,
                                sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + data.bulletin_id + nonce_str)
                            },
                            function(str){
                            if (str.code == 0) {
                                layer.open({
                                title: "删除状态",
                                content: "删除成功！",
                                btn: ["关闭"],
                                yes: function (res){
                                    layer.closeAll();
                                    location.reload();
                                }
                             });
                            }else{
                                layer.open({
                                title: "删除状态",
                                content: "删除失败！",
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
        var url = 'http://localhost:8081/Admin/System/noticeAdd.html';

            $("#addBtn").click(function(){
                layer.open({
                    type: 2,
                    title: "公告添加：",
                    content: url,
                    area: ['100%', '100%']
                });
            });
    });

                

</script>


<script type="text/html" id="operation" >
    <a class="layui-btn layui-btn-normal layui-btn-mini" lay-event="lookBtn">查看</a>
    <a class="layui-btn layui-btn-mini" lay-event="issueBtn">发布</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="deleteBtn">删除</a>
</script>