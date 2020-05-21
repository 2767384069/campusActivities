<?php 
require_once '../include.php';
$id=$_REQUEST['id'];
$sql="select id,adminName,password,isSuper,email from act_admin where id='{$id}'";
$row=fetchOne($sql);

?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>编辑管理员</title>

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
    <div class="container">
      <h3 class="manageTitle">编辑管理员</h3>
        <form role="form"  action="doAdminAction.php?act=editAdmin&id=<?php echo $id;?>" method="post">
          <div class="form-group">
              <label for="adminName">管理员账号</label>
              <input type="text" name="adminName" class="form-control" id="adminName"  placeholder="<?php echo $row['adminName'];?>">
          </div>
          <div class="form-group">
              <label for="pw">密码</label>
              <input type="password" name="password" class="form-control" id="pw">
          </div>
          <div class="form-group">
            <label for="useremail">邮箱：</label>
            <input type="email" name="email" class="form-control" id="useremail" placeholder="<?php echo $row['email']?>">
          </div>
          <div class="form-group">
            <label for="isSuper">是否是超级管理员</label>
            <select class="form-control" name="isSuper" id="isSuper"> 
              <option value="1" <?php echo $row['isSuper']==1?"selected='selected'":null;?> >是</option> 
              <option value="0" <?php echo $row['isSuper']==0?"selected='selected'":null;?> >否</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">确定</button>
        </form>
    </div>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
  </body>
</html>