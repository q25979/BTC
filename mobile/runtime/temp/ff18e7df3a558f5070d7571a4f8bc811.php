<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\btc\mobile/application/admin\view\goods\proclass.html";i:1498579498;s:59:"D:\phpStudy\WWW\btc\mobile/application/admin\view\head.html";i:1516765234;s:59:"D:\phpStudy\WWW\btc\mobile/application/admin\view\menu.html";i:1528888444;s:59:"D:\phpStudy\WWW\btc\mobile/application/admin\view\foot.html";i:1487579746;}*/ ?>
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
                  <div class="col-sm-8">
                      <section class="panel">
                          <header class="panel-heading">
                              <h4 class="left">产品分类</h4> 
                              <a href="javascript:;" onclick="addclass()"><span class="btn right btn-primary">添加分类+</span></a>
                              <br><br>
                          </header>
                          <table class="table">
                              <thead>
                              <tr>
                                  <th>编号</th>
                                  <th>标题</th>
                                  <th>操作</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <!-- <?php if(is_array($productclass) || $productclass instanceof \think\Collection || $productclass instanceof \think\Paginator): $i = 0; $__LIST__ = $productclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?> -->
                              <tr>
                                  <td><?php echo $vo['pcid']; ?></td>
                                  <td><?php echo $vo['pcname']; ?></td>
                                  <td> 
                                      <button class="btn btn-primary btn-xs" onclick="editclass('<?php echo $vo['pcid']; ?>','<?php echo $vo['pcname']; ?>')"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs" onclick="deleteclass('<?php echo $vo['pcid']; ?>')"><i class="icon-trash "></i></button>
                                  </td>
                                  
                              </tr>
                              <!-- <?php endforeach; endif; else: echo "" ;endif; ?> -->
                              </tbody>
                          </table>
                      </section>
                  </div>
          </div>       
          <div  class="row editadd" style="display:none">
            <div class="col-lg-8">
                <section class="panel">
                  
                  <div class="panel-body bio-graph-info">
                      <h1 class="f_title"></h1>
                      <form class="form-horizontal" role="form" method="post" id="formid">
                          
                          <div class="form-group">
                              <label  class="col-lg-2 control-label">分类名称</label>
                              <div class="col-lg-6">
                                  <input type="text" class="form-control" id="f-name" name="pcname" placeholder=" " value="">
                                  <input type="hidden" value="" name="pcid" id="f-id">
                              </div>
                          </div>
                         
                          <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                  <input type="submit" onclick="return formeidt(this.form)" class="btn btn-success" value="保存">
                              </div>
                          </div>
                      </form>
                  </div>
              </section> 
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

	//eidt class
	function editclass(id,data){
		$('.editadd').show();
		$('.f_title').html('编辑栏目');
		$('#f-name').val(data);
		$('#f-id').val(id);
	}

	//add class
	function addclass(){
		$('.editadd').show();
		$('.f_title').html('添加分类');
		$('#f-name').val('');
		$('#f-id').val('');
	}

	//delete class
	function deleteclass(id){
		layer.open({
		  content: '确定删除吗',
		  yes: function(index){
		    //do something
		    var url = "<?php echo url('goods/deleteclass'); ?>"+"?id="+id;
		    
		    $.get(url,function(data){
		    	if (data.type == 1) {
		          layer.msg(data.data, {icon: 1,time: 1000},function(){
		            window.location.href="<?php echo Url('admin/goods/proclass'); ?>";
		          }); 

		        }else if(data.type == -1){
		          layer.msg(data.data, {icon: 2}); 
		        }
		    });
		  }
		});
	}

  //eidt or add one class
  function formeidt(form){
    $pcname = form.pcname.value;
    if(!$pcname){
      layer.msg('请输入分类名称'); 
        return false;
    }

    var formurl = "<?php echo Url('goods/editclass'); ?>"
    var data = $('#formid').serialize();
    $.post(formurl,data,function(data){
      if (data.type == 1) {

        layer.msg(data.data, {icon: 1,time: 1000},function(){
          window.location.href="<?php echo Url('admin/goods/proclass'); ?>";
        }); 

      }else if(data.type == -1){
        layer.msg(data.data, {icon: 2}); 
      }

    });

    return false;

  }


	
</script>