<?php 
require_once '../include.php';
checkLogined();
$issuper=checkSuper();
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>后台管理系统</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-inverse .navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">校园头条</a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-inverse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">校园活动后台管理系统<span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动管理<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="addAct.php" target="mainFrame">添加活动</a></li>
                <li><a href="listAct.php" target="mainFrame">活动列表</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="listRev.php" target="mainFrame">评论列表</a></li>
              </ul>
            </li>
            <?php if($issuper):?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员管理<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="addUser.php" target="mainFrame">添加用户</a></li>
                <li><a href="listUser.php" target="mainFrame">用户列表</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="addAdmin.php" target="mainFrame">添加管理员</a></li>
                <li><a href="listAdmin.php" target="mainFrame">管理员列表</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="listApply.php" target="mainFrame">申请列表</a></li>
              </ul>
            </li>
            <?php endif;?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><p class="navbar-text">欢迎您&nbsp;
            <?php 
				if(isset($_SESSION['adminName'])){
					echo $_SESSION['adminName'];
				}elseif(isset($_COOKIE['adminName'])){
					echo $_COOKIE['adminName'];
				}
            ?>
            </p></li>
            <?php if(isset($_SESSION['adminName'])||isset($_COOKIE['adminName'])):?>
            <li><a href="doAdminAction.php?act=logout">退出</a></li>
            <?php endif;?>
            <?php if(!(isset($_SESSION['adminName'])||isset($_COOKIE['adminName']))):?>
            <li><a href="login.php">登录</a></li>
            <?php endif;?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
      <!-- 嵌套网页开始 -->         
      <iframe src="start.html"  name="mainFrame" width="100%" height="522"></iframe>
      <!-- 嵌套网页结束 -->
    </div>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
  </body>
</html>