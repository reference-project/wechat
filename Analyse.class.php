<?php
include('Spider.class.php');
include('simple_html_dom.php');

/**
 * analyse html string
 */
class Analyse extends Spider{
	/*results*/
	private $_dom=null;
	/* total number */
	private $_total;
	/*total results number of this page*/
	private $_number=null;
	function __construct($keyword,$page){
		parent::__construct($keyword);
		$this->_dom=new simple_html_dom();
		$this->_dom->load($this->get($page));// convert to dom
		// get total number of this keyword
		$this->_total=$this->_dom->find('#scd_num',0)->innertext;
		// get total number of this page
		$this->_number=$this->_dom->find('.wx-rb3');
		$this->_number=count($this->_number);
		// find results
		$this->_dom=$this->_dom->find('.results',0);
		
	}
	function __destruct(){
		parent::__destruct();
	}
	/**
	 * filter some waste html mark
	 * @param  string $str origin string
	 * @return string      new string
	 */
	private function filter($str){
 		$str=str_replace('<em><!--red_beg-->', '', $str);
 		$str=str_replace('<!--red_end--></em>', '', $str);
 		$str=str_replace('&rdquo;', '', $str);
 		$str=str_replace('&ldquo;', '', $str);
 		$str=str_replace('...', '', $str);
 		$str=str_replace('&mdash;', '', $str);
 		return $str;
	}
	/**
	 * analyse single data
	 * @param  integer $num result number
	 * @return array      analysed data
	 */
	private function single($num){
		$dom=$this->_dom->find('.wx-rb3 .txt-box',$num);
		// get title
		$result['title']=$dom->find('h4 a',0)->innertext;
		$result['title']=$this->filter($result['title']);
		// get content
		$result['content']=$dom->find('p',0)->innertext;
		$result['content']=$this->filter($result['content']);
		// get time
		$result['time']=$dom->find('.s-p script',1)->innertext;
		preg_match("/(?<=vrTimeHandle552write\(')(.*)(?='\))/",$result['time'],$result['time']);
		$result['time']=$result['time'][1];
		// get from
		$result['from']=$dom->find('.s-p script',0)->innertext;
		preg_match("/(?<=document.write\(cutLength\(')(.*)(?=', 16\)\))/",$result['from'],$result['from']);
		$result['from']=$result['from'][1];
		return $result;
	}
	/**
	 * get total number of this keyword
	 * @return integer total number
	 */
	public function total(){
		return str_replace(',', '', $this->_total);
	}
	/**
	 * get analysed data
	 * @param  integer $page result page number
	 * @return array       data array with analysed results
	 */
	public function results(){
		for($i=0;$i<$this->_number;$i++) $result[]=$this->single($i);
		return $result;
	}
}