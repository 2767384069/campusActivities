<?php 
require_once '../include.php';
checkLogined();
$id=$_REQUEST['id'];
$actInfo=getActById($id);
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>编辑活动详情</title>

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
      <h3 class="manageTitle">编辑活动详情</h3>
      <form role="form" action="doAdminAction.php?act=editAct&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="pubName">活动发布方</label>
            <input type="text" name="pubName" id="pubName" class="form-control"  value="<?php echo $actInfo['pubName'];?>" />
          </div>
          <div class="form-group">
            <label for="cName">活动类别</label>
            <select class="form-control" name="cName" id="cName"> 
              <option value="学生会活动">学生会活动</option> 
              <option value="社团活动">社团活动</option> 
              <option value="名师讲座">名师讲座</option>
              <option value="精彩比赛">精彩比赛</option>
              <option value="其它">其它</option>
            </select>
          </div>
          <div>
            <label for="labelImg" >标签图</label>
          </div>
          <input type="file" name="labelImg" /><br/>
          <div class="form-group">
            <label for="title">标题</label>
            <textarea name="title" id="title" class="form-control" rows="3" ><?php echo $actInfo['title'];?></textarea>
          </div>
          <div class="form-group">
            <label for="editor_id">活动详情</label>
            <textarea name="content" id="editor_id" style="width:100%;height:500px;" ><?php echo $actInfo['content'];?></textarea>
          </div>
          <button type="submit" class="btn btn-success">确定</button>
      </form>
    </div>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
    <script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
    <script>
      KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
      });
    </script>
  </body>
</html>