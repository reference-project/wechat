<?php
include('Analyse.class.php');

/**
 * controll task create and process
 */
class Controller extends Analyse{
	/* data base object */
	private $_db=null;
	function __construct(){
		$this->_db = new mysqli('localhost','root','321huhuhu','sogou_wechat'); 
		if (mysqli_connect_errno()) die('Unable to connect!').mysqli_connect_error();// check connection
		$this->_db->set_charset ( 'utf8' );
	}
	function __destruct(){
		$this->_db->close();
	}
	/**
	 * create new task
	 * @param  string $keyword keyword to search for
	 * @return none
	 */
	public function task($keyword){
		parent::__construct($keyword,2);
		$total=$this->total();
		$this->_db->query("insert into `task` (`keyword`,`total`) values ('$keyword',$total)");
		// TODO 这里自动创建数据表
		parent::__destruct();// free memory
	}
	/**
	 * put data into database
	 * @param  array $data result data
	 * @param  integer $id   task id
	 * @return none       
	 */
	public function datain($data,$id){
		foreach($data as $ele){
			$time=$ele['time'];
			$title=$ele['title'];
			$content=$ele['content'];
			$from=$ele['from'];
			$this->_db->query("insert into `result_$id` (`time`,`title`,`content`,`from`) values ($time,'$title','$content','$from')");
		}
	}
	/**
	 * process a task only one page
	 * @param  integer $id task id
	 * @return none
	 */
	public function work($id){
		// get task infomation
		$task=$this->_db->query("select * from task where `id`=$id");
		$task=$task->fetch_array();
		$count=$task['count'];
		$page=$task['page']+1;
		$id=$task['id'];
		// get new data
		parent::__construct($task['keyword'],$page);
		$data=$this->results();
		// fill data into database
		$this->datain($data,$id);
		// update task infomation
		$count+=count($data);
		$this->_db->query("update `task` set `page`=$page ,`count`=$count where id=$id");
	}
}