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
    .main{margin: 0 50px ;}
</style>
<body>
    <div class="main">

        <label class="layui-form-label"></label>
        <div class="layui-form-item">
            <label class="layui-form-label">比特币余额</label>
            <div class="layui-input-inline">
                <input type="text" id="user_btc_balance" name="user_btc_balance" required  lay-verify="required" placeholder="请输入余额" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">以太币余额</label>
            <div class="layui-input-inline">
                <input type="text" id="user_eth_balance" name="user_eth_balance" required  lay-verify="required" placeholder="请输入余额" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">可提现余额</label>
            <div class="layui-input-inline">
                <input type="text" id="user_extract_balance" name="user_extract_balance" required  lay-verify="required" placeholder="请输入余额" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">冻结金额</label>
            <div class="layui-input-inline">
                <input type="text" id="user_freeze_balance" name="user_freeze_balance" required  lay-verify="required" placeholder="请输入金额" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">持卡人姓名</label>
            <div class="layui-input-inline">
                <input type="text" id="bank_account" name="bank_account" required  lay-verify="required" placeholder="请输入金额" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">银行卡号</label>
            <div class="layui-input-inline">
                <input type="text" id="bank_num" name="bank_num" required  lay-verify="required" placeholder="请输入金额" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" id = "account_info_submit">立即提交</button>
            </div>
        </div>

    </div>
</body>
<script>
        var nonce_str = nonceStr(32);//随机32个随机数
        var account_id = GetRequest().id;
        var url = 'http://blnance66.com/Admin/Account/getAccountById';
        $.get(url,{account_id : account_id},
            function (res) {

                $("#user_btc_balance").val(res.data[0]['btc_balance']);
                $('#user_eth_balance').val(res.data[0]['eth_balance']);
                $('#user_extract_balance').val(res.data[0]['extract_balance']);
                $('#user_freeze_balance').val(res.data[0]['freeze_balance']);
                $('#bank_account').val(res.data[0]['bank_account']);
                $('#bank_num').val(res.data[0]['bank_num']);
            
        });

        function GetRequest() {
            var url = location.search; //获取url中"?"符后的字串
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                var str = url.substr(1);
                strs = str.split("&");
                for(var i = 0; i < strs.length; i ++) {
                    theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
                }
            }
            return theRequest;
        }


    // 提交
    $('#account_info_submit').click(function(){
        var btcBalance = $("#user_btc_balance").val();
        var ethBalance = $("#user_eth_balance").val();
        var extractBalance = $("#user_extract_balance").val();
        var freezeBalance = $("#user_freeze_balance").val();
        var bankAccount = $("#bank_account").val();
        var bankNum = $("#bank_num").val();

        // 判断
        /*if (btcBalance == '' || ethBalance == '' || extractBalance == '' ||
             freezeBalance == '' || bankAccount == '' || bankNum == '') {
            layer.msg("输入不能为空！", {icon: 2});
            return ;
        }*/

        var data = {
            account_id: account_id,
            btc_balance: btcBalance, 
            eth_balance:  ethBalance,       
            extract_balance: extractBalance,           
            freeze_balance: freezeBalance,
            bank_account : bankAccount,
            bank_num : bankNum,
            nonce_str : nonce_str,
            sign: hex_md5("oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1" + btcBalance + 
            ethBalance + extractBalance + freezeBalance + nonce_str)
            };// 发送签名

        // 数据请求
        $.post('<?php echo U(updataAccount);?>',data,function(res){
            if (res.code == '0') {
                layer.msg("修改成功！", {icon: 6});
                window.parent.location.reload();
            } else {
                layer.msg("修改失败！", {icon: 2});
            }
        });
    });

</script>