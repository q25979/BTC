<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"D:\phpStudy\WWW\btc\mobile/application/admin\view\login\login.html";i:1503152914;s:59:"D:\phpStudy\WWW\btc\mobile/application/admin\view\head.html";i:1516765234;s:59:"D:\phpStudy\WWW\btc\mobile/application/admin\view\foot.html";i:1487579746;}*/ ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="/favicon.ico">

    <title>众赢后台管理系统</title>

    <!-- Bootstrap core CSS -->
    <link href="__ADMIN__/css/bootstrap.min.css" rel="stylesheet">
    <link href="__ADMIN__/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="__ADMIN__/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="__ADMIN__/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="__ADMIN__/css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="__ADMIN__/css/style.css" rel="stylesheet">
    <link href="__ADMIN__/css/style-responsive.css" rel="stylesheet" />
    <link href="__ADMIN__/css/addstyle.css" rel="stylesheet">
    
    <script src="__ADMIN__/js/jquery.js"></script>
    <script src="__ADMIN__/js/jquery-1.8.3.min.js"></script>
    <script src="/static/layer/layer.js"></script>

    <!-- 时间选择器 -->
    <link rel="stylesheet" type="text/css" href="__ADMIN__/css/jquery.datetimepicker.css"/>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="__ADMIN__/js/html5shiv.js"></script>
      <script src="__ADMIN__/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="显示/隐藏" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="#" class="logo">众赢<span>系统</span></a>
            <!--logo end-->
            
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <?php if(isset($_SESSION['username'])): ?>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            
                            <span class="username"><?php echo !empty($_SESSION['username'])?$_SESSION['username']:''; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="<?php echo Url('login/logout'); ?>"><i class="icon-signout"></i> 退出</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
<!--header end-->

<style>
.white-bg{
  background: #000;
  border-bottom:#000;
}
a.logo{
  color:#fff
}
.admin_logo{
      text-align: center;
    padding-top: 120px;
    margin-bottom: -90px;
}
.admin_logo img{
  height: 150px
}

</style>
<body class="login-body">

    <div class="container" >
  
      <form class="form-signin" action="" method="post" id="formid">
        <h2 class="form-signin-heading" >管理员登录</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" name="username" placeholder="用户名" value="<?php echo $rememberme; ?>">
            <input type="password" class="form-control" name="password" placeholder="密码">
            <label class="checkbox">
                <input type="checkbox" value="1" name="rememberme"> 记住我
            </label>
            <input type="submit" onclick="return check_admin_login(this.form)" class="btn btn-lg btn-login btn-block" placeholder="登&nbsp;&nbsp;录" />
        </div>
      </form>
    </div>


    <!-- js placed at the end of the document so the pages load faster -->
    
    <script src="__ADMIN__/js/bootstrap.min.js"></script>
    <script src="__ADMIN__/js/jquery.scrollTo.min.js"></script>
    <script src="__ADMIN__/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="__ADMIN__/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="__ADMIN__/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="__ADMIN__/js/owl.carousel.js" ></script>
    <script src="__ADMIN__/js/jquery.customSelect.min.js" ></script>

    <!--common script for all pages-->
    <script src="__ADMIN__/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="__ADMIN__/js/sparkline-chart.js"></script>
    <script src="__ADMIN__/js/easy-pie-chart.js"></script>

    <!-- active -->
    <script src="/static/public/js/function.js"></script>
    
    <!-- date -->
    <script type="text/javascript" src="__ADMIN__/js/date/jquery.datetimepicker.js" charset="UTF-8"></script>

  </body>
</html>

<script>
/*
登录验证
 */
function check_admin_login (form)
   {
      $username = form.username.value;
      $password = form.password.value;
      if (!$username) {
        layer.msg('请输入用户名'); 
        return false;
      }

      if(!$password){
        layer.msg('请输入密码'); 
        return false;
      }

      var formurl = "<?php echo Url('admin/login/login'); ?>"
      var data = $('#formid').serialize();
      $.post(formurl,data,function(data){
        if (data.type == 1) {

          layer.msg(data.data, {icon: 1,time: 1000},function(){
            window.location.href="<?php echo Url('admin/index/index'); ?>";
          }); 

        }else if(data.type == -1){
          layer.msg(data.data, {icon: 2}); 
        }

      });

      return false;
   }
</script>