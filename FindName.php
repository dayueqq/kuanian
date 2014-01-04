<?php
define('DB_HOST','localhost');
define('DB_NAME','shop');
define('DB_USER','root');
define('DB_PASSWORD','root');
$conn=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD)or die("数据库连接错误:".mysql_error());
mysql_select_db(DB_NAME,$conn)or die("数据库连接错误：".mysql_error());
mysql_query("set names utf-8");

$numbers=$_GET['numbers'];

$sql_find="select * from orders where numbers='".$numbers."'";
$result_find=mysql_query($sql_find);
$num=mysql_num_rows($result_find);
if($num>0)
{
	$row=mysql_fetch_array($result_find);
	//echo $row['yes']."<br/>";
	//echo $row['type']."<br/>";
	//echo $num."<br/>";
	//echo iconv("utf-8","gbk","存在");
	
	$ary = array('num'=>$row['numbers'],'yes'=>$row['yes'],'type'=>$row['type']);
	$json = json_encode($ary);
 	//一定要这样定义输出最后的JSON数据,这是利用JS的闭包特性
	echo "var json=$json;";
	
	$sql_update="update orders set yes=0 where numbers='".$row['numbers']."'";
	mysql_query($sql_update);
}
else
{
	//echo $num;
	//echo iconv("utf-8","gbk","不存在");
	$ary = array('num'=>"",'yes'=>0,'type'=>0);
	$json = json_encode($ary);
 	//一定要这样定义输出最后的JSON数据,这是利用JS的闭包特性
	echo "var json=$json;";
}
mysql_close();

?>
