<?php 
require_once '../include.php';
checkLogined();
$issuper=checkSuper();
if(isset($_SESSION['adminName'])){
	$adminname= $_SESSION['adminName'];
}elseif(isset($_COOKIE['adminName'])){
	$adminname=$_COOKIE['adminName'];
}
$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by ".$order:null;
$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where title like '%{$keywords}%'":null;
if(!$issuper){
	$where=$keywords?"where adminName='{$adminname}' and title like '%{$keywords}%'":"where adminName='{$adminname}'";
}
//得到数据库中的所有活动
$sql="select id,title,labelImg,cName,pubName,adminName,pubTime,readNum,praiseNum from campus_act {$where}";
$totalRows=getResultNum($sql);
//print_r($totalRows);
//die();
$pageSize=5;
$totalPage=ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select id,title,labelImg,cName,pubName,adminName,pubTime,readNum,praiseNum from campus_act {$where} {$orderBy} limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>活动列表</title>

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
      <h3 class="manageTitle">活动列表</h3>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="10%">编号</th>
              <th width="30%">标题</th>
              <th width="10%">分类</th>
              <th width="10%">发布方</th>
              <th width="15%">发布时间</th>
              <th width="10%">标签图</th>
              <th width="15%">操作</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($rows as $row):?>
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['cName']; ?></td>
              <td><?php echo $row['pubName']; ?></td>
              <td><?php echo date("Y-m-d H:i:s",$row['pubTime']);?></td>
              <td>
              <img width="100" height="100" alt="image" src="uploads/<?php echo $row['labelImg'];?>" />&nbsp;&nbsp;
			  </td>
              <td class="doOperate">
              <input type="button" value="修改" class="btn" onclick="editAct(<?php echo $row['id'];?>)">
              <input type="button" value="删除" class="btn" onclick="delAct(<?php echo $row['id'];?>)">
              </td>
            </tr>
          <?php endforeach;?>
            <tr>
            <td>排序</td>
            <td colspan="3">
                                                活动编号：
                <select id="" class="select" onchange="change(this.value)">
                <option>-请选择-</option>
                <option value="id asc" >由低到高</option>
                <option value="id desc">由高到底</option>
                </select>&nbsp;&nbsp;
                                                发布时间：
                <select id="" class="select" onchange="change(this.value)">
                <option>-请选择-</option>
                <option value="pubTime desc" >最新发布</option>
                <option value="pubTime asc">历史发布</option>
                </select>
            </td>
            <td colspan="3">
              <div class="form-horizontal">
              <div class="form-group">
                <label for="search" class="col-sm-2 control-label">搜索</label>
                <div class="col-sm-10">
                <input type="text" value="" class="search form-control"  id="search" onkeypress="search()" placeholder="请输入关键字后回车">
                </div>
              </div>                          
              </div>
            </td>
            </tr>
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
    function editAct(id){
		window.location='editAct.php?id='+id;
	}
	function delAct(id){
		if(window.confirm("您确认要删除吗？")){
			window.location="doAdminAction.php?act=delAct&id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){//回车
			var val=document.getElementById("search").value;
			window.location="listAct.php?keywords="+val;
		}
	}
	function change(val){
		window.location="listAct.php?order="+val;
	}
    </script>
  </body>
</html>