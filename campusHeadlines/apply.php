<?php 
require_once 'include.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>申请</title>

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
    <div class="container">
      <h3 class="manageTitle">申请</h3>
      <form role="form" action="addApply.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="university">学校名称</label>
            <input type="text" name="university" id="university" class="form-control" placeholder="请输入您所在学校名称，比如：广州中医药大学" />
          </div>
          <div>
            <label for="labelImg" >请上传手持校园卡正面照片</label>
          </div>
          <input type="file" name="labelImg"><br/>
          <div class="form-group">
            <label for="editor_id">申请原因</label>
            <textarea name="cause" id="editor_id" style="width:100%;height:500px;"></textarea>
          </div>
          <button type="submit" class="btn btn-success" id="addApply">提交</button>
      </form>
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
    <script type="text/javascript" charset="utf-8" src="plugins/kindeditor/kindeditor.js"></script>
    <script type="text/javascript" charset="utf-8" src="plugins/kindeditor/lang/zh_CN.js"></script>
    <script>
      KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
      });
    </script>
  </body>
</html>