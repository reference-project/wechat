<?php
// class Sort extends Db{
// 	function __construct(){

// 	}
// 	function __destruct(){
		
// 	}
// }

$db = new mysqli('localhost','root','321huhuhu','sogou_wechat'); 
if (mysqli_connect_errno()) die('Unable to connect!').mysqli_connect_error();// check connection
$db->set_charset ( 'utf8' );

$start=strtotime("2014-02-01 05:00:00");
$end=strtotime("2015-02-01 05:00:00");
$tableName="data_all";
$source='result_1';

$sql3=<<<EOT
CREATE TABLE `sogou_wechat`.`$tableName` (
  `id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(45) NOT NULL COMMENT '标题',
  `content` TEXT NOT NULL COMMENT '内容概述',
  `from` VARCHAR(45) NOT NULL COMMENT '来源',
  `time` VARCHAR(45) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`));
EOT;
$db->query($sql3);

$sql="select * from $source where `time`>=$start and `time`<$end";
$result=$db->query($sql);

while($row=$result->fetch_array()){
	$id=$row['id'];
	$title=$row['title'];
	$content=$row['content'];
	$from=$row['from'];
	$time=$row['time'];
	$time=date('Y-m-d H:i:s', $time);
	$sql2="insert into $tableName (`id`,`title`,`content`,`from`,`time`) values ($id,'$title','$content','$from','$time')";
	$db->query($sql2);
}

