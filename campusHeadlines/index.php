<?php 
require_once 'include.php';
$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where cName='{$keywords}'":null;
$sql="select id,title,labelImg,cName,pubName,adminName,pubTime,readNum,praiseNum from campus_act {$where} limit 3";
$rows=fetchAll($sql);
$sql1="select * from campus_act {$where}";
$num=getResultNum($sql1);
$sql2="select id,title,labelImg,cName,pubName,adminName,pubTime,readNum,praiseNum from campus_act {$where} limit 3,".$num;
$rows2=fetchAll($sql2);
//print_r($rows2);
//die();
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
        <li class="active"><a href="index.php">首页<span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">校园活动<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="javascript:watch();">全部校园活动</a></li>
            <li><a href="#">学生会活动</a></li>
            <li><a href="javascript:search('社团活动');">社团活动</a></li>
            <li><a href="#">名师讲座</a></li>
            <li><a href="#">精彩比赛</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">其它</a></li>
          </ul>
        </li>
        <li><a href="about.php" target="_blank">关于我们</a></li>
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
  <!-- 图片轮播 -->
<div id="ad-carousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
      <li data-target="#ad-carousel" data-slide-to="0" class="active"></li>
      <li data-target="#ad-carousel" data-slide-to="1"></li>
      <li data-target="#ad-carousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item active">
      <a href="des.php?id=<?php echo $rows[0]['id'];?>" target="_blank"><img src="admin/uploads/<?php echo $rows[0]['labelImg'];?>" alt="1 slide"></a>
      <div class="carousel-caption">
        <h3><?php echo $rows[0]['title'];?></h3>
        <p><?php echo $rows[0]['pubName'];?></p>
      </div>
    </div>
    <div class="item">
      <a href="des.php?id=<?php echo $rows[1]['id'];?>" target="_blank"><img src="admin/uploads/<?php echo $rows[1]['labelImg'];?>" alt="1 slide"></a>
      <div class="carousel-caption">
        <h3><?php echo $rows[1]['title'];?></h3>
        <p><?php echo $rows[1]['pubName'];?></p>
      </div>
    </div>
    <div class="item">
      <a href="des.php?id=<?php echo $rows[2]['id'];?>" target="_blank"><img src="admin/uploads/<?php echo $rows[2]['labelImg'];?>" alt="1 slide"></a>
      <div class="carousel-caption">
        <h3><?php echo $rows[2]['title'];?></h3>
        <p><?php echo $rows[2]['pubName'];?></p>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#ad-carousel" data-slide="prev"><span
          class="glyphicon glyphicon-chevron-left"></span></a>
  <a class="right carousel-control" href="#ad-carousel" data-slide="next"><span
          class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!-- 新闻列表 -->
<div class="container">
<div class="cName"><h3><?php echo $keywords?"{$keywords}":"校园活动";?></h3></div>
<ul class="media-list">
  <?php foreach ($rows2 as $row2):?>
  <li class="media">
    <div class="media-left media-middle">
      <a href="des.php?id=<?php echo $row2['id'];?>" target="_blank">
        <img class="media-object" src="admin/uploads/<?php echo $row2['labelImg'];?>" alt="image">
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading intwoline"><?php echo $row2['title'];?></h4>
      <p class="pubTime clearfix">
        <span><?php echo $row2['pubName'];?></span>
        <span><?php echo date("Y-m-d",$row2['pubTime']);?></span>
        <span class="readNum fr">浏览量<em><?php echo $row2['readNum'];?></em></span>
      </p>
    </div>
  </li>
  <?php endforeach;?>
</ul>
</div>
<!--底部-->
<footer class="bs-docs-footer">
  <div class="container">
    <ul class="bs-docs-footer-links">
      <li><a href="#">GitHub 仓库</a></li>
      <li><a href="#">实例</a></li>
      <li><a href="#">优站精选</a></li>
      <li><a href="#">关于</a></li>
    </ul>

    <p>Designed and built with all the love in the world by <a href="#" target="_blank">@mdo</a> and <a href="#" target="_blank">@fat</a>. Maintained by the <a href="#">core team</a> with the help of <a href="#">our contributors</a>.</p>

    <p>
      本项目源码受 
      <a rel="license" href="#" target="_blank">MIT</a>
      开源协议保护，文档受 
      <a rel="license" href="#" target="_blank">CC BY 3.0</a> 
      开源协议保护。
    </p>

  </div>
</footer>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script type="text/javascript">
    function search($keywords){
		window.location="index.php?keywords="+$keywords;
	}
    function watch(){
		window.location="index.php";
	}
    </script>
  </body>
</html>