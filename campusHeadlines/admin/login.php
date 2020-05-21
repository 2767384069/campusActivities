<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>管理员登录</title>

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
    <div class="container sm">
    <div class="wel"><img alt="welcome" src="../images/logo.png"></div>
    <div class="wel">欢迎登录</div>
        <form role="form" action="doLogin.php" method="post">
            <div class="form-group">
                <label for="adminName">管理员账号</label>
                <input type="text" name="adminName" class="form-control" id="adminName" placeholder="输入用户名">
            </div>
            <div class="form-group">
                <label for="pw">密码</label>
                <input type="password" name="password" class="form-control" id="pw" placeholder="请输入您的密码">
            </div>
            <div class="form-group">
                <label for="pw">验证码</label>
                <input type="text"  name="verify" class="form-control">
            </div>
            <div><img src="getVerify.php" alt="" /></div>
            <div class="checkbox">
                <label>
                <input type="checkbox" id="a1" class="checked" name="autoFlag" value="1"> 自动登录（一周内自动登录）
                </label>
            </div>
            <button type="submit" class="btn btn-success">登录</button>
        </form>
    </div>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
  </body>
</html>