<?php
define('DB_HOST','localhost');
define('DB_NAME','shop');
define('DB_USER','root');
define('DB_PASSWORD','root');
$conn=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD)or die("数据库连接错误:".mysql_error());
mysql_select_db(DB_NAME,$conn)or die("数据库连接错误：".mysql_error());
mysql_query("set names utf-8");

//统计总数
$sql_count="select count(numbers) from orders";
$result_count=mysql_query($sql_count);
$rows=mysql_fetch_row($result_count);
$count=$rows[0];

//按时间倒序查询，最新的20个记录
$sql_all="select * from orders where yes=0 order by time desc limit 0,20"; 
$result_all=mysql_query($sql_all);
$num=mysql_num_rows($result_all);

$ary=array();
while($row=mysql_fetch_array($result_all))
{
	$ary[]=$row['numbers'];
	$ary[]=$row['yes'];
	$ary[]=$row['type'];
	$ary[]=$count;
}

//$arry = array('result'=>'测试','message'=>'跨域成功');
$json = json_encode($ary);
//一定要这样定义输出最后的JSON数据,这是利用JS的闭包特性
echo "var json=$json;";
?>