<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"C:\phpStudy\WWW/application/admin\view\user\vipuseradd.html";i:1528686527;s:48:"C:\phpStudy\WWW/application/admin\view\head.html";i:1516765234;s:48:"C:\phpStudy\WWW/application/admin\view\menu.html";i:1528888444;s:48:"C:\phpStudy\WWW/application/admin\view\foot.html";i:1487579746;}*/ ?>
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


<!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li <?php if($actionname == 'index' && $contrname == 'Index'): ?> class="active" <?php endif; ?> >
                      <a class="" href="<?php echo Url('admin/index/index'); ?>">
                          <i class="icon-dashboard"></i>
                          <span>后台首页</span>
                      </a>
                  </li>
                  <!--
                  <li <?php if($contrname == 'Index' && (in_array($actionname,array('contentclass','contentlist','contentadd')))): ?> class="active" <?php else: ?> class="sub-menu " <?php endif; ?>>
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>内容管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li <?php if($actionname == 'contentclass'): ?> class="active" <?php endif; ?>><a href="<?php echo Url('admin/index/contentclass'); ?>">栏目管理</a></li>
                          <li <?php if($actionname == 'contentlist' || $actionname == 'contentadd'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/index/contentlist'); ?>">文章管理</a></li>
                          
                      </ul>
                  </li>
                  -->

                  
                  <li <?php if($contrname == 'Goods'): ?> class="active" <?php else: ?> class="sub-menu " <?php endif; ?>>
                      <a href="javascript:;" class="">
                          <i class="icon-btc"></i>
                          <span>产品管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <?php if($otype == 3): ?>
                          <li <?php if($actionname == 'prolist' || $actionname == 'proadd'): ?> class="active" <?php endif; ?>><a  href="<?php echo Url('admin/goods/prolist'); ?>">产品列表</a></li>
                          <li <?php if($actionname == 'proclass'): ?> class="active" <?php endif; ?>><a  href="<?php echo Url('admin/goods/proclass'); ?>">产品分类</a></li>
                          <li <?php if($actionname == 'huishou'): ?> class="active" <?php endif; ?>><a  href="<?php echo Url('admin/goods/huishou'); ?>">产品回收站</a></li>
                          <li <?php if($actionname == 'risk'): ?> class="active" <?php endif; ?>><a  href="<?php echo Url('admin/goods/risk'); ?>">风控管理</a></li>

                          <?php else: ?>
                          <li <?php if($actionname == 'risk'): ?> class="active" <?php endif; ?>><a  href="<?php echo Url('admin/goods/riskagency'); ?>">风控管理</a></li>
                          <?php endif; ?>
                      </ul>
                  </li>
                  
                  <li <?php if($contrname == 'Order'): ?> class="active" <?php else: ?> class="sub-menu " <?php endif; ?>>
                      <a href="javascript:;" class="">
                          <i class="icon-paste"></i>
                          <span>订单管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li <?php if($actionname == 'orderlist'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/order/orderlist'); ?>">交易流水</a></li>
                          <li <?php if($actionname == 'orderlog'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/order/orderlog'); ?>">平仓日志</a></li>
                          
                          
                      </ul>
                  </li>

                  <li <?php if($contrname == 'User' && ( in_array($actionname,array('userlist','useradd','userprice','userinfo','cash','myteam','chongzhi')) )): ?> class="active" <?php else: ?> class="sub-menu " <?php endif; ?>>
                      <a href="javascript:;" class="">
                          <i class="icon-user"></i>
                          <span>用户管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li <?php if(in_array($actionname,array('userlist','useradd'))): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/user/userlist'); ?>">客户列表</a></li>
                          
                          <li <?php if(in_array($actionname,array('myteam'))): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/user/myteam'); ?>">我的团队</a></li>

                          <li <?php if($actionname == 'userprice'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/user/userprice'); ?>">充值列表</a></li>

                          <li <?php if($actionname == 'cash'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/user/cash'); ?>">提现列表</a></li>
                          <?php if($otype == 3): ?>
                          <li <?php if($actionname == 'chongzhi'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/user/chongzhi'); ?>">手动充值</a></li>
                          <?php endif; ?>
                          <!-- <li <?php if($actionname == 'userinfo'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/user/userinfo'); ?>">资料审核</a></li> -->
                          
                          
                      </ul>
                  </li>
<!-- 
                  <li <?php if($contrname == 'User' && ( in_array($actionname,array('vipuseradd','vipuserlist','usercode')) )): ?> class="active" <?php else: ?> class="sub-menu " <?php endif; ?>>
                      <a class="" href="javascript:;">
                          <i class="icon-user-md"></i>
                          <span>代理商管理 </span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                        
                          <li <?php if($actionname == 'vipuseradd'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/user/vipuseradd'); ?>">添加代理商</a></li>

                          <li <?php if(in_array($actionname,array('vipuserlist','usercode'))): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/user/vipuserlist'); ?>">代理商列表</a></li>


                      </ul>
                  </li>
                   -->
                  
                  <li <?php if($contrname == 'Price'): ?> class="active" <?php else: ?> class="sub-menu " <?php endif; ?>>
                      <a href="javascript:;" class="">
                          <i class="icon-yen"></i>
                          <span>报表管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          
                          
                          <li <?php if($actionname == 'allot'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/price/allot'); ?>">红利报表</a></li>

                          <li <?php if($actionname == 'yongjin'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/price/yongjin'); ?>">佣金报表</a></li>

                          <li <?php if($actionname == 'pricelist'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/price/pricelist'); ?>">资金报表</a></li>

                          <li <?php if($actionname == 'myprice'): ?> class="active" <?php endif; ?>>
                          <a class="" href="<?php echo Url('admin/price/myprice'); ?>">个人报表</a></li>
                          
                      </ul>
                  </li>
                  
                  <?php if($otype == 3): ?>
                  <li <?php if($contrname == 'Setup'): ?> class="active" <?php else: ?> class="sub-menu" <?php endif; ?>>
                      <a href="javascript:;" class="">
                          <i class="icon-paste"></i>
                          <span>参数设置</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">

                          <li <?php if($contrname == 'Setup' && $actionname == 'index'): ?> class="active" <?php endif; ?> >
                            <a class="" href="<?php echo Url('admin/Setup/index'); ?>">基本设置</a>
                          </li>

                          <li <?php if($contrname == 'Setup' && $actionname == 'proportion'): ?> class="active" <?php endif; ?> >
                            <a class="" href="<?php echo Url('admin/Setup/proportion'); ?>">参数设置</a>
                          </li>
                          <li  <?php if($contrname == 'Setup' && $actionname == 'addsetup'): ?> class="active" <?php endif; ?> >
                            <a class="" href="<?php echo Url('admin/Setup/addsetup'); ?>">添加配置</a>
                          </li>
                          <li  <?php if($contrname == 'Setup' && $actionname == 'deploy'): ?> class="active" <?php endif; ?> >
                            <a class="" href="<?php echo Url('admin/Setup/deploy'); ?>">配置管理</a>
                          </li>
                      </ul>
                  </li>
                  

                  <li <?php if($contrname == 'System'): ?> class="active" <?php else: ?> class="sub-menu" <?php endif; ?>>
                      <a href="javascript:;" class="">
                          <i class="icon-cogs"></i>
                          <span>系统设置</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li <?php if($actionname == 'adminadd'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/system/adminadd'); ?>">添加管理员</a></li>
                          <li <?php if($actionname == 'adminlist'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/system/adminlist'); ?>">管理员列表</a></li>
                          <li <?php if($actionname == 'banks'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/system/banks'); ?>">提现银行卡</a></li>
                          <li <?php if($actionname == 'recharge' || $actionname ==  'addrech'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/system/recharge'); ?>">充值配置</a></li>
                          <li <?php if($actionname == 'setwx'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/system/setwx'); ?>">微信设置</a></li>
                          <li <?php if($actionname == 'dbbase'): ?> class="active" <?php endif; ?>><a class="" href="<?php echo Url('admin/system/dbbase'); ?>">数据备份</a></li>

                      </ul>
                  </li>

                  <?php endif; ?>

                  <li>
                      <a class="" href="<?php echo Url('admin/login/logout'); ?>">
                          <i class="icon-signout"></i>
                          <span>退出</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->



<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              
            
          <div class="row">
                  <div class="col-sm-12">
                      <aside class="profile-info col-lg-9">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> <?php echo !empty($isedit)?'编辑代理商':'添加代理商'; ?></h1>
                              <form class="form-horizontal" role="form" action="" method="post" id="formid">
                                  
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">代理商名称</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  value="<?php echo !empty($username)?$username:''; ?>" name="username" <?php if(isset($isedit) && $isedit == 1): ?> disabled="true"  <?php endif; ?>>（登录账号）
                                      </div>
                                  </div>
                
                                <?php if(isset($isedit) && $isedit == 1): ?>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">状态</label>
                                      <div class="col-lg-6">
                                          <select name="ustatus" class="selectpicker show-tick form-control">
                                              <option <?php if(isset($ustatus) && $ustatus == 0): ?> selected="selected" <?php endif; ?> value="1">正常</option>
                                              <option <?php if(isset($ustatus) && $ustatus == 1): ?> selected="selected" <?php endif; ?> value="2">冻结</option>
                                          </select>
                                      </div>
                                  </div>
                                <?php endif; if(isset($isedit) && $isedit == 1): ?>
                                  
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">余额</label>
                                      <div class="col-lg-6">
                                          <?php if($_SESSION['otype'] == 3): ?>
                                          <input type="text" class="form-control"  value="<?php echo !empty($usermoney)?$usermoney:'0'; ?>" name="usermoney" <?php if(isset($isedit) && $isedit != 1): ?> disabled="true"  <?php endif; ?>>
                                          <?php else: ?>
                                            <p class="form-control" disabled="true"><?php echo !empty($usermoney)?$usermoney:'0'; ?></p>
                                          <?php endif; ?>
                                      </div>
                                  </div>
                                  <?php else: endif; ?>
                                  

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">手机号</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  value="<?php echo !empty($utel)?$utel:''; ?>" name="utel">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">真实姓名</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  value="<?php echo !empty($nickname)?$nickname:''; ?>" name="nickname">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">红利比例</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"   value="<?php echo !empty($rebate)?$rebate:''; ?>" <?php if(!isset($uid) || $_SESSION['userid'] != $uid): ?> name="rebate" <?php else: ?> disabled="true" <?php endif; ?>>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">佣金比例</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  value="<?php echo !empty($feerebate)?$feerebate:''; ?>" <?php if(!isset($uid) || $_SESSION['userid'] != $uid): ?> name="feerebate" <?php else: ?> disabled="true" <?php endif; ?>>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">保证金</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  value="<?php echo !empty($minprice)?$minprice:''; ?>" name="minprice">
                                          <div class="alert alert-block alert-danger fade in" style="margin:10px 0 0 0 ">
                                         <strong>说明：</strong> 大于此保证金才可以提现。
                                    </div>
                                      </div>
                                  </div>


                <?php if(isset($isedit) && $isedit == 1): ?>

                                  <input type="hidden" class="form-control"  value="<?php echo !empty($uid)?$uid:''; ?>" name="uid">
                <?php else: ?>
                <input type="hidden" class="form-control"  value="" name="ordpwd">
                <?php endif; if($_SESSION['otype'] == 3): ?>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">密码</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  value="" name="upwd">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">确认密码</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  value="" name="upwd2">
                                      </div>
                                  </div>
                                  <?php endif; ?>
                                  
                
                                  
                                  
                                  
                                  

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-success" onclick="return edituser(this.form)" >提交</button>
                                          
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      
                  </aside>
                  </div>

          </div>       
          
          
             

          </section>
      </section>
      <!--main content end-->
  </section>


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
var c_otype = '';
var type = "<?php echo $isedit; ?>";

$('.selectotype').change(function(argument) {
  c_otype = $(this).val();
  if(c_otype == 4){
    $('.choosejl').show();
  }else{
    $('.choosejl').hide();
  }
});
  function edituser(form){
    
    var utel = form.utel.value;
    var nickname = form.nickname.value;
    var username = form.username.value;
    var upwd = form.upwd.value;
    var upwd2 = form.upwd2.value;
    // var adminpwd = form.adminpwd.value;
    //var ordpwd = form.ordpwd.value;
    // var otype = form.otype.value;
    // var oid = form.oid.value;

    
    if(!username){layer.msg('请输入用户名'); return false;}
    
    if(type == 0){
      var formurl = "<?php echo Url('user/vipuseradd'); ?>";
      if(!utel){layer.msg('请输入手机号'); return false;}
    }else{
      var formurl = "<?php echo Url('user/vipuseredit'); ?>";
    }

    if(!nickname){layer.msg('请输入真实姓名'); return false;}
    
    if(type == 0 || (type == 1 && upwd)){ 
      if(!upwd){layer.msg('请输入密码'); return false;}
      if(upwd.length < 6){layer.msg('密码长度大于6位'); return false;}
      if(!upwd2){layer.msg('请再输入密码'); return false;}
      if(upwd !== upwd2){layer.msg('两次输入密码不同'); return false;}
    }
    

      
      var data = $('#formid').serialize();
      var locurl = "<?php echo Url('user/userlist'); ?>";

      WPpost(formurl,data,locurl);

      return false;
  }



</script>