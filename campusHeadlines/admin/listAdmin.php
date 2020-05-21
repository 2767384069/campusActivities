<?php 
require_once '../include.php';
$pageSize=10;
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$rows=getAdminByPage($page,$pageSize);
//echo $rows;
//die();
if(!$rows){
	alertMes("sorry,没有管理员，请添加","addAdmin.php");
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
    <title>管理员列表</title>

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
      <h3 class="manageTitle">管理员列表</h3>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="15%">编号</th>
              <th width="20%">管理员账号</th>
              <th width="15%">是否是超级管理员</th>
              <th width="30%">邮箱</th>
              <th width="20%">操作</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($rows as $row):?>
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><?php echo $row['adminName'];?></td>
              <td><?php echo $row['isSuper']==1?'是':'不是';?></td>
              <td><?php echo $row['email'];?></td>
              <td class="doOperate"><input type="button" value="修改" class="btn" onclick="editAdmin(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn" onclick="delAdmin(<?php echo $row['id'];?>)"></td>
            </tr>
          <?php endforeach;?>
          <?php if($totalRows>$pageSize):?>
            <tr>
              <td colspan="5"><?php echo showPage($page,$totalPage);?></td>
            </tr>  
          <?php endif;?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  function addAdmin(){
    window.location="addAdmin.php";
  }
  function editAdmin(id){
    window.location="editAdmin.php?id="+id;
  }
  function delAdmin(id){
    if(window.confirm("您确定要删除吗？")){
	   window.location="doAdminAction.php?act=delAdmin&id="+id;
    }
  }
  </script>
  </body>
</html>