<?php
header('content-type:text/html;charset=utf-8');
include_once('sqlite.php');
$ac=(isset($_GET['ac']))?$_GET['ac']:'';
$id=(isset($_GET['id']))?$_GET['id']:'';

$DB=new SQLite( 'data_source_listnew.db' );
$sql="select * from list_source where spare01 = 1 order by id desc";
$data=$DB->getlist($sql);
$sql1="select * from list_source where spare03 = 1 order by id desc";
$data1=$DB->getlist($sql1);
$banner="";

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>展示页面</title>
</head>

<body>
<p>固定位视频展示|<a href="page.php">添加固定位</a></p>
<table border=1 cellspacing="0" width=72% >
    <tr bgcolor="#ABCDEF">
    <td>序号</td>
    <td>视频编号</td>
    <td>视频名称</td>
    <td>固定位位置</td>
    <td>操作</td>
  </tr>
    <?php $num=1; foreach($data as $row):?>
    <tr>
    <td><?php echo $num;?></td>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['string_name'];?></td>
    <td><?php if($ac=='edit'&&$id==$row['id']){ 
	$banner.= "<form action='doaction.php' method='get'><input type='text' size='2' name='sp' value='".$row['spare04']."'><input type='hidden' name='ac' id='ac' value='edit'><input type='hidden' name='id' id='id' value='".$row['id']."'><input type='submit' value='确定'></form>";
	echo $banner;
	}else{ echo $row['spare04'];} ?></td>
    <td><a href="position.php?id=<?php echo $row['id'];?>&ac=edit">编辑</a>|<a href="doaction.php?id=<?php echo $row['id'];?>&ac=del">移除</a></td>
    </tr>
    <?php $num++;endforeach;?>
</table>

<p><a href="page.php">返回展示页</a></p>
<p>推荐位视频展示|<a href="page.php">添加推荐位<a></p>
<table border=1 cellspacing="0" width=60% >
    <tr bgcolor="#ABCDEF">
    <td>序号</td>
    <td>视频编号</td>
    <td>视频名称</td>    
    <td>操作</td>
  </tr>
    <?php $no=1; foreach($data1 as $row1):?>
    <tr>
    <td><?php echo $no;?></td>
    <td><?php echo $row1['id'];?></td>
    <td><?php echo $row1['string_name'];?></td>    
    <td><a href="doaction.php?id=<?php echo $row1['id'];?>&ac=del_1">移除</a></td>
    </tr>
    <?php $no++;endforeach;?>
</table>
<p><a href="page.php">返回展示页</a></p>
</body>
</html>