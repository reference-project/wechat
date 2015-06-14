<?php
// module test
include('Controller.class.php');
// test Spider class
$spider=new Spider('深圳娃娃鱼事件');
echo $spider->get(1);
// test Controller class
$controller=new Controller();
for($i=0;$i<2;$i++){
	$controller->work(5);
}
$controller->work(5);
$controller->task('深圳多名官员吃娃娃鱼');
// test Analyse class
$analyse=new Analyse('深圳多名官员吃娃娃鱼',1);
echo $analyse->total();
var_dump($analyse->results()); 