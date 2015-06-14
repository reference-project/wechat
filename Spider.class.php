<?php
/**
 * get data from weixin.sogou.com
 */
class Spider{
	/*set url*/
	private $_url="http://weixin.sogou.com/weixin?query={keyword}&fr=sgsearch&sut=1282&lkt=0%2C0%2C0&type=2&sst0=1422717294490&page={page}&ie=utf8&w=01019900&dr=1";
	// private $_url="http://weixin.sogou.com/weixin?query={keyword}&type=2&page={page}";
	/*curl handler*/
	private $_curl=null;
	/**
	 * construct function
	 * @param string $keyword what you want to search
	 */
	function __construct($keyword){
		// disguise header
		$header[0] = "Connection: keep-alive";
		$header[] = "Pragma: no-cache";
		$header[] = "Cache-Control: no-cache";
		$header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$header[] = "Accept-Encoding: gzip, deflate, sdch";
		$header[] = "Accept-Language: zh-CN,zh;q=0.8,en;q=0.6";
		// fill keyword in url
		$this->_url=str_replace('{keyword}',urlencode($keyword),$this->_url);
		// initial curl
		$this->_curl = curl_init();
		// set options
		curl_setopt($this->_curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36');//http header user-agent 
		curl_setopt($this->_curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1); //return response rather than print
		curl_setopt($this->_curl, CURLOPT_TIMEOUT, 10); 
	}
	function __destruct(){
		// free memory
		curl_close($this->_curl);
	}
	/**
	 * get data
	 * @param  integer $page page number
	 * @return string page content
	 */
	public function get($page){
		curl_setopt($this->_curl, CURLOPT_URL, str_replace('{page}',$page,$this->_url)); 
		$output = curl_exec($this->_curl);// get respond
		return $output;
	}
}