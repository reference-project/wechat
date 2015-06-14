<?php
include('Controller.class.php');
// 有些问题还未解决，故采用手动限定进度的方式进行
// 每完成一段后查看数据是否正常
$controller=new Controller();
// 初始化任务后，手动调用sql脚本创建存放数据的数据表
// $controller->task('李克强');
for($i=0;$i<10;$i++){
	$controller->work(1);
}