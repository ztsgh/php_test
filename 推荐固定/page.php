	<?php
       //1传入页码	         	   
       $page=(isset($_GET['p']))?$_GET['p']:1;//$page默认值为1
       $page_Size=20;//配置每页条数
       $showpage=7;
       //2根据页码取出数据php,Sqlite 链接数据库，连接数据表的处理
       include_once('sqlite.php');
       $DB=new SQLite( 'data_source_listnew.db' );
       //编写sql获取分页数据 select * from 表名 Limit条数offset起始位置
       $sql='select * from list_source where status = 1 order by id desc limit "'.$page_Size.'" offset '.($page-1)*$page_Size;
       $data= $DB->getlist($sql);
       $total= $DB->RecordCount('select id from list_source where status = 1');//获取数据总数
       $total_page=ceil($total/$page_Size);//获取总页数
       
	   /*for($i=0;$i<count($data);$i++){
       echo $data[$i]['id'].'='.$data[$i]['string_name'].'<br>';
       }*/
       //释放结果 关闭链接
	   /*for($i=0;$i<count($data);$i++){
       echo '<tr>';
       echo '<td>'.$data[$i]['id'].'</td><td>'.$data[$i]['string_name'].'</td><td>'.$data[$i]['spare01'].'</td>';
       echo '</tr>';
       }*/
       
    ?>
    
    <!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html">
    <meta charset="utf-8">
    <title>分页显示</title>
    </head>	
    <style>
	body{
		font-size:15px;
		font-family:Verdana, Geneva, sans-serif;
		width:90%;
		}
	div.page{
		text-align:center;
		}
    div.content{
		height:550px;
		}
    div.page a{
        border:#aaaadd 1px solid;
        text-decoration:none;
        padding:2px 5px 2px 5px;
        margin:2px;
        }
    div.page span.current{		
        border:#000099 1px solid;
        background-color:#000099;
        padding:5px 5px 5px 5px;
        margin:2px;
        color:#fff;
        font-weight:bold;
        }
	div.page span.disable{
		color:#666;
		border:#eee 1px solid;
		padding:2px 5px 2px 5px;
		margin:2px;
		
		}
	div.page form{
		display:inline;
		}
    </style>
<body>
<div class="content">
  <h2 align="center">视频后台编辑|<a href="position.php">配置固定位与推荐位</a></h2>
  <table border=1 cellspacing="0" width=50% align="center">
    <tr bgcolor="#ABCDEF">  
    <td>视频编号</td>
    <td>视频名称</td>
    <td>固定</td>
    <td>推荐</td>
    <td>是否推荐固定</td> 
   
    </tr>
    <?php foreach($data as $row):?>
    <tr>    
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['string_name'];?></td>
    <td><?php echo $row['spare01']==1 ? '是' : '';	//$id = isset($_GET['id']) ? $_GET['id'] : false;
	//if ($row['spare01']==1){echo '是';}else{echo '';}	    
	?></td>
    <td><?php echo $row['spare03']==1 ? '是' : '';  ?></td>
    <td><a href="doaction.php?id=<?php echo $row['id'];?>&ac=add">固定</a>|<a href="doaction.php?id=<?php echo $row['id'];?>&ac=add_1">推荐</a></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php
      //3显示数据 数据+分页条
      /*$pp=1;
        if( $page-1<1 ){
            $pp=1;
        }else{
            $pp=$page-1;
        }*/
       $page_banner="<div class='page'>";//分页条
       $pageoffset=($showpage-1)/2;//计算偏移量
       if($page>1){
           $page_banner .="<a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";	
           $page_banner .="<a href='".$_SERVER['PHP_SELF']."?p=".($page-1)."'><上一页</a>";
       }else{
           $page_banner .="<span class='disable'>首页</span>";
           $page_banner .="<span class='disable'><上一页</span>"; 
       }
       $start=1;$end=$total_page;//初始化数据
       if($total_page>$showpage){
           if($page>$pageoffset+1){
              $page_banner .="...";
           }
           
           if($page>$pageoffset){
              $start=$page-$pageoffset;
              $end= $total_page>$page+$pageoffset?$page+$pageoffset:$total_page;            
           }else{
              $start=1;
              $end =$total_page>$showpage?$showpage:$total_page; 
           }
           if($page+$pageoffset>$total_page){
              $start=$start-($page+$pageoffset-$end);
           }
        }
         for($i=$start;$i<=$end;$i++){
             if($page==$i){
                 $page_banner .="<span class='current'>{$i}</span>";
             }else{
                 $page_banner .="<a href='".$_SERVER['PHP_SELF']."?p=".$i."'>{$i}</a>";
                 }
       }
       if($total_page>$showpage && $total_page>$page + $pageoffset){
           $page_banner .="...";
       }	   
       if($page<$total_page){
           $page_banner .="<a href='".$_SERVER['PHP_SELF']."?p=".($page+1)."'>下一页></a>";
           $page_banner .="<a href='".$_SERVER['PHP_SELF']."?p=".($total_page)."'>尾页</a>";
       }else{
           $page_banner .="<span class='disable'>下一页></span>";
           $page_banner .="<span class='disable'>尾页</span>"; 
       }
       $page_banner .="共{$total_page}页,"; 
       $page_banner .="<form action='page.php' method='get'>";
       $page_banner .="到第<input type='text' size='2' name='p'>页";
       $page_banner .="<input type='submit' value='确定'>";
       $page_banner .="</form></div>";
       echo $page_banner;
    
?>
    <!--form name="form1" method="post" action="../?p=">
      第
    <label for="page"></label>
      <input name="page" type="text" id="page" size="4" value="">
      页
    <input type="submit" name="sub" id="sub" value="提交">
    
    </form-->
</body>
</html>