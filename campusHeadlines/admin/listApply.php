<?php 
require_once '../include.php';
checkLogined();
//得到数据库中的所有申请信息
$sql="select * from act_apply";
$totalRows=getResultNum($sql);
//print_r($totalRows);
//die();
$pageSize=5;
$totalPage=ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select * from act_apply limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>申请列表</title>

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
      <h3 class="manageTitle">申请列表</h3>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">编号</th>
              <th width="10%">学校名称</th>
              <th width="10%">用户名</th>
              <th width="20%">申请原因</th>
              <th width="15%">申请时间</th>
              <th width="30%">图片</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($rows as $row):
          $sql2="select * from act_admin where adminName='{$row['userName']}'";
          $row2=fetchOne($sql2);
          ?>
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><?php echo $row['university']; ?></td>
              <td><?php echo $row['userName']; ?></td>
              <td><?php echo $row['cause']; ?></td>
              <td><?php echo date("Y-m-d H:i:s",$row['applyTime']);?></td>
              <td>
              <img class="big" width="200" height="200" alt="image" src="../uploads/<?php echo $row['applyImg'];?>" />
			  </td>
              <td class="doOperate">
              <?php if(!$row2):?>
              <input type="button" value="批准" class="btn" onclick="addAdminbyUser('<?php echo $row['userName'];?>')">
              <?php endif;?>
              <?php if($row2):?>
              <input type="button" value="已批准" class="btn" disabled>
              <?php endif;?>
              <input type="button" value="删除" class="btn" onclick="delApply(<?php echo $row['id'];?>)">
              </td>
            </tr>
          <?php endforeach;?>
          <?php if($totalRows>$pageSize):?>
            <tr>
            <td colspan="7"><?php echo showPage($page,$totalPage,"keywords={$keywords}&order={$order}");?></td>
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
    function delApply(id){
		if(window.confirm("您确认要删除吗？")){
			window.location="doAdminAction.php?act=delApply&id="+id;
		}
	}
    function addAdminbyUser($userName){
		window.location="doAdminAction.php?act=addAdminbyUser&userName="+$userName;
		//this.setAttribute("disabled", true);
	}
    </script>
  </body>
</html>