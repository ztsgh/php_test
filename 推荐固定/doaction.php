<?php
header('content-type:text/html;charset=utf-8');
include_once('sqlite.php');
$DB=new SQLite( 'data_source_listnew.db' );
$sp=(isset($_GET['sp']))?$_GET['sp']:'';
$id=$_GET['id'];
$ac=$_GET['ac'];
switch($ac){
	case 'add' :
	           $sql="UPDATE list_source SET spare01=1 WHERE id=$id";
			   $res=$DB->query($sql);
	           if($res){
			      $mes='设置成功';
		       }else{
			      $mes='设置失败';
		       }
			   $url="position.php?ac=edit&id=$id"; 
			    echo "<script type='text/javascript'>
		      alert('{$mes}');
			  location.href='{$url}';      
		      </script>";
		      exit;	
	
	       break;
		   
   case 'add_1' :
	           $sql="UPDATE list_source SET spare03=1 WHERE id=$id";
			   $res=$DB->query($sql);
	           if($res){
			      $mes='设置成功';
		       }else{
			      $mes='设置失败';
		       }
			   $url='page.php';
			    echo "<script type='text/javascript'>
		      alert('{$mes}');
			  location.href='{$url}';      
		      </script>";
		      exit;	
	
	       break; 		    
	case 'edit':  
	           $sql="UPDATE list_source SET spare04=$sp WHERE id=$id";	
	           $res=$DB->query($sql);
	           if($res){
			      $mes='更新位置成功';
		       }else{
			      $mes='更新位置失败';
		       } 
			   $url='position.php';       	      
	          echo "<script type='text/javascript'>
		      alert('{$mes}');
			  location.href='{$url}';      
		      </script>";
		      exit;	
          break;		
		
	case 'del':
	         $sql="UPDATE list_source SET spare01 =0,spare04='' WHERE id=$id";			 
	         $res=$DB->query($sql);
			 if($res){
			      $mes='移除成功';
		       }else{
			      $mes='移除失败';
		       }
			   $url='position.php';
			 echo "<script type='text/javascript'>
		         alert('{$mes}');
			     location.href='{$url}';      
		         </script>";
		      exit;	
	       break;
		   
 	case 'del_1':
	          $sql="UPDATE list_source SET spare03 = 0 WHERE id=$id";
	          $res=$DB->query($sql);
			  if($res){
			      $mes='移除成功';
		       }else{
			      $mes='移除失败';
		       }
			   $url='position.php';
			   echo "<script type='text/javascript'>
		            alert('{$mes}');
			   	    location.href='{$url}';      
		            </script>";
		      exit;	
	       break;	   
	
}


?>

