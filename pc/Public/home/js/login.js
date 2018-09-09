/**
 * Created by MonstarShen on 2018/4/19.
 */

var loginVm = new Vue({
    el: '#index-box',
    data: {
        reminder: '',
        status  : 0,
        nonce_str: nonceStr(32),
        companyName : '',       // 公司名
        companyPhone: '',       // 联系电话
        companyEmail: '',       // 联系邮箱
        serviceTime : '',       // 服务时间
        questionList : [],       // 常见问题
        time: ''
    },
    created: function() {
        var _this = this;
        this.getQuestion();
        this.basics();

        /**
         * 监听键盘
         */
        document.onkeydown = function () {
            var key = window.event.keyCode;
            if (key === 13) {
                //_this.BTCLogin();
            }
        }
    },
    methods: {
        /* 获取基础信息 */
        basics: function() {
            var url   = config.host_path + '/Home/Login/getBasics';
            var _this = this;

            // 获取公司名
            $.get(url, function(res) {
                _this.companyName = res.name;
            });

            // 获取联系我们
            $.get(config.host_path + '/Home/Login/getContactUs', function(res) {
                _this.companyPhone = res.company_tel;
                _this.companyEmail = res.company_email;
                _this.serviceTime  = res.service_time;
            });

            // 判断令牌是不是错误
            this.isErrToken();
        },

        /* 令牌错误 */
        isErrToken: function() {
            var _this = this;
            var url   = window.location.href;
            var exp   = '/token_err/';
            var token = $.trim(url.split(exp)[1]);

            if (token == true || token == 'true') {
                _this.disErr('Invalid');
            }
        },

        /**
         * 重置密码
         */
        resetPass: function(type) {
            var email = type == 'pc' 
                    ? $('[name=pc-forget-email]').val() 
                    : $('[name=mobile-forget-email]').val();

            var nstr  = nonceStr();
            var sign  = config.verify_str + email + nstr;
            var _this = this;

            if (email == '') {
                _this.disErr(1);
                return ;
            }
            if (!/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(email)) {
                _this.disErr(2);
                return ;
            }
            var u = config.host_path + '/Home/Login/reset';
            var d = {
                email: email,
                nonce_str: nstr,
                sign : hex_md5(sign)
            };

            $('.forgetBtn').text('傳送中...');
            $('.forgetBtn').attr('disabled', 'true');

            var time;
            // 清空定时器
            clearTimeout(time);

            // 定时器
            time = setTimeout(function () {
                $(".nav-hd").css({
                    transition: "height 0.5s",
                    height: "0px"
                });
            }, 6000);
            $.post(u, d, function(res) {
                $('.forgetBtn').text('重置密碼');
                $('.forgetBtn').removeAttr('disabled');

                $('.tea_login_error').css({'display': 'block !important'});
                _this.disErr(8);
            });
        },

        /* pc 登录 */
        BTCLogin: function () {

            var that = this;
            var email = $('#emailName').val();
            var password = hex_md5(config.verify_str + $('#password').val());

            if (!this.verification ($('#emailName').val(), $('#password').val())) {
                return;
            }

            // 数据请求接口
            var _data = {
                email: email,
                password: password,
                nonce_str: this.nonce_str,
                sign: hex_md5(config.verify_str + email + this.nonce_str + password)
            };

            // 数据请求
            this.loginConst(_data);
        },
        /* pc 注册 */
        register: function () {
            var registerEmail = $('[name=rename]').val();

            if (registerEmail == '') {
                $('.sh-hint').css({'display': 'block'});
                return;
            }
            if (!/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(registerEmail)) {
                $('.sh-hint').css({ 'display': 'block'});
                return;
            } else {
                $('.sh-hint').css({'display': 'none'});
            }

            this.registerConst(registerEmail);

        },
        /* 手机端 登录 */
        PhoneLogin: function () {

            if (!this.verification ($('[name=emailPhone]').val(), $('[name=passPhome]').val())) {
                return;
            }

            var emailPhone = $('[name=emailPhone]').val();
            var passPhome = hex_md5(config.verify_str + $('[name=passPhome]').val());

            var _data = {
                email: emailPhone,
                password: passPhome,
                nonce_str: this.nonce_str,
                sign: hex_md5(config.verify_str + emailPhone + this.nonce_str + passPhome)
            };
            this.loginConst(_data);
        },
        /* 手机端 注册 */
        PhoneRegister: function () {
            var PhoneEmail = $('[name=username]').val();

            if (PhoneEmail == '') {
                $('.sh-small-hint').css({'display': 'block'});
                return;
            }

            if (!/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(PhoneEmail)) {
                $('.sh-small-hint').css({'display': 'block'});
                return;
            } else {
                $('.sh-small-hint').css({'display': 'none'});
            }

            this.registerConst(PhoneEmail);
        },
        /* 验证 */
        verification: function (emailName, passworld) {

            var time;
            // 清空定时器
            clearTimeout(time);

            // 定时器
            time = setTimeout(function () {
                $(".nav-hd").css({
                    transition: "height 0.5s",
                    height: "0px"
                });
            }, 6000);

            if (emailName == '') {
                this.disErr(1);
                return false;
            }
            if (passworld == '') {
                this.disErr(1);
                return false;
            }
            if ( !/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(emailName) ) {
                this.disErr(2);
                return false;
            }
            /* 必须包含小写字母和数字的组合，不能使用特殊字符，长度在8-16之间 */
            /*if ( !/^(?=.*\d)(?=.*[a-z]).{8,16}$/.test(passworld) ) {
                this.disErr(2);
                return false;
            }*/
           return true;
        },
        disErr: function (status) {
            $('.nav-hd').css({
                transition: "height 0.5s",
                height: "40px"
            });

            this.status = status;
        },

        // 登入
        loginConst: function (_data) {
            var that = this;
            var url = config.host_path + '/Home/Login/login';

            // 数据请求
            // 获取按钮名字
            var btnName = $('.xy-login-login').html()

            // 加载框
            sg.loading($('.xy-login-login'));
            $.post(url, _data,{
                emulateJOSN:true
            }).then(function (res){
                // 判断是否成功
                sg.hideLoading($('.xy-login-login'), btnName);
                if (parseInt(res.code) == 0) {
                    that.disErr(3);

                    setTimeout(function() {
                        sg.jump(config.host_path);

                    }, 1000);
                    return ;

                } else {
                    that.disErr(9);
                    return ;
                }

            }, function (res){
                console.log(res);

                sg.hideLoading($('.xy-login-login'), btnName);
                that.disErr(7);
            });
        },
        // 注册
        registerConst: function (registerEmail) {


            var _this = this;
            var url   = config.host_path + "/Home/Login/register";
            var nstr  = nonceStr(); 
            var sign  = config.verify_str + registerEmail + nstr;
            var _data = {
                email: registerEmail,
                nonce_str: nstr,
                sign : hex_md5(sign)
            };

            // 获取按钮名字
            var btnName = $('.xy-login-register').html()

            // 加载框
            sg.loading($('.xy-login-register'));
            $.post(url, _data, {
                emulateJOSN:true
            }).then(function (res){
                sg.hideLoading($('.xy-login-register'), btnName);


                // 判断是否成功
                if (parseInt(res.code) == 0) {
                    // 没有错误发送邮件跳转
                    var jumpUrl = config.host_path + '/Home/Email/send?email='+ registerEmail;

                    window.location.href = jumpUrl;
                    return true;

                } else if (parseInt(res.code) == 1001) {
                    // 邮箱已被注册
                    _this.disErr(5);
                    return false;
                    
                } else {
                    // 未知错误
                    _this.disErr(6);
                    return false;
                }

            }, function (res){
                sg.hideLoading($('.xy-login-register'), btnName);

                _this.disErr(7);
            });
        },
        //到常见问题详细页面
        goQuestionContent: function (type) {
            //跳转到详细页面
            window.location.href= config.host_path + "/Home/Question/FAQ.html?type=" + type; 
        },
        //常见问题初始化
        getQuestion: function () {
            var vm = this;
            var url = config.host_path+"/Home/Question/getCommonProblemFive";
            $.get(url,function(res){
               vm.questionList = res.data;
            });
            
        },
        goQuestionMore: function () {
            //跳转到详细页面
            window.location.href= config.host_path + "/Home/Question/index.html";
        },

    }
});

/* pc登入注册切换 */
$(document).ready(function(){
    var $tab_li = $('#sh_tab ul li');
    $tab_li.on('click', function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        var index = $tab_li.index(this);
        $('div.tab_box > div').eq(index).show().siblings().hide();

        if (index == 1) {
            $('.sh-hint').css({'display': 'none'});
        }
    });
});

/**
 * 获取背景图片
 */
getBackLogo();
function getBackLogo () {
    var logoUrl = config.host_path + "/Home/Login/getupdateLogo";

    $.ajax({
        url: logoUrl,
        type: 'get',
        success: function (res) {

            $('.container-login').css({
                'background-image': 'url(' + res.data[0].background_url + ')'
            });
        }
    });
}

$(document).ready(function() {
    /* 手机登录注册切换 */
    toggleFu('#login-re', '#login-btn', '.login-small-input', '.re-small');
    /* 忘记密码电脑端 */
    toggleFu('.forget', '.gologin', '.tea_login_error', '.forget-pwd');
    /* 忘记密码手机端 */
    toggleFu('.forget-small', '.gologinsmall', '.login-small-input', '.forget-pwd-small');
});

/**
 *  btnOne  第一个按钮
 *  btnTwo  第二个按钮
 *  onePage     第一个隐藏的页面
 *  twoPage     第二个页面
 * */
function toggleFu(btnOne, btnTwo, onePage, twoPage) {
    var $login_btn_re = $(btnOne);
    $login_btn_re.click(function(){
        $(onePage).animate({
            opacity : 0
        },function(){
            $(this).css('display','none');
        });

        $(twoPage).animate({
            opacity : 1
        },function(){
            $(this).css('display','block');
        });
    });
    var $login_btn_re = $(btnTwo);
    $login_btn_re.click(function(){
        $(twoPage).animate({
            opacity : 0
        },function(){
            $(this).css('display','none');
        });

        $(onePage).animate({
            opacity : 1
        },function(){
            $(this).css('display','block');
        });
    });
    return ;
};

