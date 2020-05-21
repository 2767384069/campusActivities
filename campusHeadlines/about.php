<?php 
require_once 'include.php';

if(isset($_SESSION['userName'])){
	$userName= $_SESSION['userName'];
}elseif(isset($_COOKIE['userName'])){
	$userName=$_COOKIE['userName'];
}
$sql="select * from act_admin where adminName='{$userName}'";
$row=fetchOne($sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>校园活动发布系统</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

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
        <li><a href="index.php" target="_blank">首页<span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="#">关于我们</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">欢迎您&nbsp;
          <?php 
				if(isset($_SESSION['userName'])){
					echo $_SESSION['userName'];
				}elseif(isset($_COOKIE['userName'])){
					echo $_COOKIE['userName'];
				}
          ?></p></li>
        <?php 
        if(!(isset($_SESSION['userName']))):?>
        <li><a href="login.php" target="_blank">登录</a></li>
        <?php endif;?>
        <?php 
        if(isset($_SESSION['userName'])):?>
        <li><a href="doAction.php?act=userOut">退出</a></li>
        <?php endif;?>
        <li><a href="reg.php" target="_blank">注册</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>
  <div class="container about">
    <h2>欢迎来到校园头条！</h2>
    <p>大学校园中，有各种丰富多彩的校园活动，社团以及学生会，校园实践对每一个即将进入社会的大学生非常重要，所以我们提供了一个共享平台给在校的大学生进行交流和学习。</p>
    <p>校园头条网站主要发布在校园内与学生最贴近的比如社团招新活动、信息杯三球赛、心理微电影大赛、英文演讲比赛、各种讲座等。</p>
    <p>在这里，如果你想在本网站上发布自己所在学生会或者社团所组织的活动，可以点击下面的“立即申请”按钮申请成为本站的一名管理员。</p>
    <p>如果经审核通过，会在本页面出现有“立即发布”提示信息的按钮，然后就可以点击用自己目前的用户账号登录到后台啦！</p>
    <?php if(!$row&&isset($_SESSION['userName'])):?>
    <a class="btn btn-primary btn-lg" href="apply.php" role="button">立即申请</a><br />
    <?php elseif(!$row):?>
    <a class="btn btn-primary btn-lg" href="javascript:;" title="请先登录" role="button">立即申请</a><br />
    <?php 
    endif;
    if($row):?>
    <p>申请已成功，点击"立即发布"登录到后台发布活动</p>
    <a class="btn btn-primary btn-lg" href="admin/login.php" role="button">立即发布</a>
    <?php endif;?>
  </div>
  <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
  </body>
</html>