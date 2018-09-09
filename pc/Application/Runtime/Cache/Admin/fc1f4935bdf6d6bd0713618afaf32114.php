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
    .layui-elem-quote {font-size: 15px;color: #666}
    .addAgent {margin: 20px 0 0 2%; width: 80%;;}
    .add span {font-size: 16px; line-height: 3px;display:inline-block; width: 140px;}
    .addAgent input {width: 35%; display: inline;}
    .layui-form-item {width: 80%; margin-top: 15px;}
    .layui-input-block {margin: 0 auto; width: 280px;}
    .layui-input-block button {width: 120px;}
    .right {margin: 0 15px 0 30px;}
    #code {width: 100px;}
    .sg-radio { margin-left: 20px; }
    .sg-radio label { margin-right: 20px; font-size: 15px; }
    .sg-radio .on  { margin-right: 10px; } 
</style>
<body>


    <div class="x-body">
        <!--<div class="layui-form-item sg-radio" id="coin-radio">-->
            <!--<label>浮动开关</label>-->
            <!--<input id="switch-on" type="radio" name="switch" value="1" /> -->
            <!--<span class="on">开</span>-->
            <!--<input id="switch-off" type="radio" name="switch" value="0" /> -->
            <!--<span class="off">关</span>-->
        <!--</div>-->

        <div class="layui-form">
            
        </div>
        <div class="addAgent layui-form-item">
            <blockquote class="layui-elem-quote">基础货币价值设置</blockquote>
            <div class="addAgent">
                
                <div class="add">
                    <span>BTC的TWD单价</span>
                    <span class="btc_twd_info right"></span>
                </div>

                <hr class="layui-bg-gray"/>
                <div class="add">
                    <span>BTC的HKD单价</span>
                    <span class="btc_hkd_info right"></span>
                </div>

                <hr class="hr15"/>
                <div class="add">
                    <span>BTC的USD单价</span>
                    <span class="btc_usd_info right"></span>
                </div>
                <hr class="hr15"/>

                <div class="add">
                    <span>ETH的TWD单价</span>
                    <span class="eth_twd_info right"></span>
                </div>

                <hr class="layui-bg-gray"/>
                <div class="add">
                    <span>ETH的HKD单价</span>
                    <span class="eth_hkd_info right"></span>
                </div>

                <hr class="hr15"/>
                <div class="add">
                    <span>ETH的USD单价</span>
                    <span class="eth_usd_info right"></span>
                </div>
                <hr class="layui-bg-gray"/>
                <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" id="valueInfo">修改</button>
                </div>
            </div>

            </div>

            <blockquote class="layui-elem-quote">显示货币价值设置</blockquote>
            <div class="addAgent">
                <div class="add">
                    <span>BTC的TWD单价</span>
                    <span class="btc_twd right"></span>
                </div>

                <hr class="layui-bg-gray"/>
                <div class="add">
                    <span>BTC的HKD单价</span>
                    <span class="btc_hkd right"></span>
                </div>

                <hr class="hr15"/>
                <div class="add">
                    <span>BTC的USD单价</span>
                    <span class="btc_usd right"></span>
                </div>
                <hr class="hr15"/>

                <div class="add">
                    <span>ETH的TWD单价</span>
                    <span class="eth_twd right"></span>
                </div>

                <hr class="layui-bg-gray"/>
                <div class="add">
                    <span>ETH的HKD单价</span>
                    <span class="eth_hkd right"></span>
                </div>

                <hr class="hr15"/>
                <div class="add">
                    <span>ETH的USD单价</span>
                    <span class="eth_usd right"></span>
                </div>  
                <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" id="value_show">修改</button>
                </div>
            </div>  
            </div>
            <blockquote class="layui-elem-quote">浮动区间设置</blockquote>
            <div class="addAgent">
                
                <div class="add">
                    <span>BTC最小值</span>
                    <span class="btc_float_min right"></span>
                </div>

                <hr class="hr15"/>
                <div class="add">
                    <span>BTC最大值</span>
                    <span class="btc_float_max right"></span>
                </div>  

                <hr class="hr15"/>
                <div class="add">
                    <span>ETH最小值</span>
                    <span class="eth_float_min right"></span>
                </div>

                <hr class="hr15"/>
                <div class="add">
                    <span>ETH最大值</span>
                    <span class="eth_float_max right"></span>
                </div> 
                <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" id="float_audit">修改</button>
                </div>
            </div>  
            </div>
        </div>
    </div>
</body>

<script>
    var code;
    $.ajax({
        url : '<?php echo U(Coin);?>',
        type: 'get',
        success: function (res) {
            console.log(res);
            $('.eth_twd_info').html(res.data[0]['eth_value_twd']);
            $('.eth_hkd_info').html(res.data[0]['eth_value_hkd']);
            $('.eth_usd_info').html(res.data[0]['eth_value_usd']);
            $('.btc_twd_info').html(res.data[0]['btc_value_twd']);
            $('.btc_hkd_info').html(res.data[0]['btc_value_hkd']);
            $('.btc_usd_info').html(res.data[0]['btc_value_usd']);

            $(".eth_float_max").html(res.data[0]['etc_float_max']);
            $(".eth_float_min").html(res.data[0]['etc_float_min']);
            $(".btc_float_max").html(res.data[0]['btc_float_max']);
            $(".btc_float_min").html(res.data[0]['btc_float_min']);

            $('.eth_twd').html(res.info[0]['eth_value_twd']);
            $('.eth_hkd').html(res.info[0]['eth_value_hkd']);
            $('.eth_usd').html(res.info[0]['eth_value_usd']);
            $('.btc_twd').html(res.info[0]['btc_value_twd']);
            $('.btc_hkd').html(res.info[0]['btc_value_hkd']);
            $('.btc_usd').html(res.info[0]['btc_value_usd']);

            var switchName = res.switch == 0
                ? $('#switch-off')
                : $('#switch-on');
            switchName.attr('checked', 'true');

            layer.closeAll();
        }
    });

    /**
     * 监听开关浮动
     */
    $('[name=switch]').change(function() {
        var u = 'http://localhost:8081/Admin/System/floatSwitch';
        var d = { 'float_status': $(this).val() };

        layer.load(2);
        $.post(u, d, function(res) {
            layer.closeAll();

            if (res.code == 0) {
                var u = 'http://localhost:8081/Float/Index/index';
                // sg.jump(u);
                $.get(u);
            }
        });
    });

    layui.use('layer',function() {

        var $ = layui.jquery, layer = layui.layer;
        $('#valueInfo').on('click', function () {

            layer.open({
                type: 2,
                title: '基础价格信息',
                area: ['60%', '90%'],
                content: '<?php echo U(infoCoin);?>',
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });

        $('#value_show').on('click', function () {

            layer.open({
                type: 2,
                title: '显示货币价值设置',
                area: ['60%', '90%'],
                content: '<?php echo U(showCoin);?>',
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });

        $('#float_audit').on('click', function () {

            layer.open({
                type: 2,
                title: 'ETH信息',
                area: ['60%', '90%'],
                content: '<?php echo U(floatCoin);?>',
                btnAlign: 'c',
                yes: function () {
                    layer.closeAll();
                }
            });
            $('#code').attr('src', code);
        });
    });

</script>