<?php 
require_once '../include.php';
$sql="select id,userName,email,sex from act_user";
$rows=fetchAll($sql);
if(!$rows){
	alertMes("sorry,没有用户，请添加","addUser.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>用户列表</title>

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
      <h3 class="manageTitle">用户列表</h3>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="15%">编号</th>
              <th width="25%">用户名</th>
              <th width="30%">用户邮箱</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($rows as $row):?>
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><?php echo $row['userName'];?></td>
              <td><?php echo $row['email'];?></td>
              <td class="doOperate"><input type="button" value="修改" class="btn" onclick="editUser(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn" onclick="delUser(<?php echo $row['id'];?>)"></td>
            </tr>
          <?php endforeach;?> 
          </tbody>
        </table>
      </div>
    </div>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  function editUser(id){
    window.location="editUser.php?id="+id;
  }
  function delUser(id){
    if(window.confirm("您确定要删除吗？")){
	   window.location="doAdminAction.php?act=delUser&id="+id;
    }
  }
  </script>
  </body>
</html>