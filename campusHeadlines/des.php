<?php 
require_once 'include.php';
$id=$_REQUEST['id'];
$sql2="select * from campus_act where id=".$id;
$row2=fetchOne($sql2);
$num=intval($row2['readNum'])+1;
updateRead("campus_act",$num,$id);//浏览量加一
$actInfo=getActById($id);
$sql="select * from act_rev where actId=".$id;
$rows=fetchAll($sql);//得到该活动的所有评论
if(isset($_SESSION['userName'])){
	$userName=$_SESSION['userName'];
}elseif(isset($_COOKIE['userName'])){
	$userName=$_COOKIE['userName'];
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>高校学生活动信息发布系统</title>

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
    <div class="container des">
        <div class="page-header">
            <h1><?php echo $actInfo['title'];?></h1>
            <span class="editor"><?php echo $actInfo['pubName'];?></span>
        </div>
        <div class="page-body">
            <?php echo $actInfo['content'];?>
        </div>
    </div>
    <div class="container box clearfix">
        <div class="content">
            <div class="info clearfix">
                <span class="time"><?php echo date("Y-m-d H:i:s",$actInfo['pubTime']);?></span>
                <a class="praise" id="praise" href="javascript:praiseAct(<?php echo $actInfo['id'];?>);">赞</a>
            </div>
            <div class="praises-total" total="<?php echo $actInfo['praiseNum'];?>" style="display: <?php echo $actInfo['praiseNum']>0?'block':'none';?>"><?php echo $actInfo['praiseNum'];?>个人觉得很赞</div>
            <div class="comment-list">
                <?php 
                if($rows):
                foreach ($rows as $row):
                $pNum=$row['praiseNum'];
                $revName=$row['revName'];
                ?>
                <div class="comment-box clearfix">
                    <p class="comment-text"><span class="user"><?php echo $revName;?>：</span><?php echo $row['revContent'];?></p>
                    <p class="comment-time">
                        <?php echo date("Y-m-d H:i:s",$row['pubTime']);?>
                        <a href="javascript:praiseRev(<?php echo $row['id'];?>);" class="comment-praise" id="praiseRev_<?php echo $row['id'];?>" total="<?php echo $row['praiseNum'];?>" my="0"><?php echo $row['praiseNum']>0?$pNum:'';?>&nbsp;赞</a>
                        <?php if($revName==$userName):?>
                        <a href="javascript:delRev(<?php echo $row['id'];?>);" class="comment-operate">删除</a>
                        <?php endif;?>
                        <?php if(!($revName==$userName)):?>
                        <a href="javascript:;" class="comment-operate">回复</a>
                        <?php endif;?>
                    </p>
                </div>
                <?php 
                endforeach;
                endif;
                ?>
            </div>
            <div class="text-box">
                <?php if($userName):?>
                <textarea id="comment" autocomplete="off" placeholder="评论..."></textarea>
                <?php 
                endif;
                if(!$userName):
                ?>
                <textarea id="comment" autocomplete="off" disabled="disabled" placeholder="请先登录再发表评论..."></textarea>
                <?php endif;?>
                <button type="submit" class="btn" id="addRev" >发表评论</button>
                <span class="word"><span class="length">0</span>/140</span>
            </div>
        </div>
    </div>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script src="script/main.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){ 
      $("#addRev").click(function(){ 
		$.ajax({ 
		    type: "POST", 	
			url: "addRev.php",
			data: { 
				revContent: $("#comment").val(), 
				actId: <?php echo $id; ?>
			},
		});
	  });
	});

	  function delRev(revid){
		  $.ajax({ 
			    type: "POST", 	
				url: "delRev.php",
				data: { 
					"revId": revid,
				}, 
			});
	  }

	  function praiseAct(actid){
		  $.ajax({ 
			    type: "POST", 	
				url: "praiseAct.php",
				data: { 
					"actId": actid,
					adddel:$("#praise").text(),
				},
			});
	  }

	  function praiseRev(revid){
		  $.ajax({ 
			    type: "POST", 	
				url: "praiseRev.php",
				data: { 
					"id": revid,
					"my":$("#praiseRev_<?php echo $row['id'];?>").attr('my'),
				},
				success: function(data){
					$("#praiseRev_<?php echo $row['id'];?>").attr('my',data);
				},
			});
	  }
    </script>
</body>
</html>