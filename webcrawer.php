<?php

class webcrawer{
	private $url;
	private $ch;
	private $out;
	private $inroduction;
	private $picpath;
	private $bookName;
	private $author;
	function __construct($bookName)
	{
		$this->bookName=$bookName;
		$this->url="https://book.douban.com/subject_search?search_text=";
		$bookName = urlencode($bookName);
		$this->url=sprintf("%s%s&cat",$this->url,$bookName);
		
	}
	
	protected function regex($pattern)
	{
		$match="";
		preg_match($pattern,$this->out,$match);
		if(!isset($match))
			return false;
		return $match;
	}
	
	public function getURL()
	{
		$this->ch=curl_init();
		curl_setopt($this->ch,CURLOPT_URL,$this->url);
		curl_setopt($this->ch,CURLOPT_POST,false);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->ch,CURLOPT_HEADER,0);
		curl_setopt($this->ch,CURLOPT_PROXY,"cmproxy.gmcc.net:8081");
		curl_setopt($this->ch,CURLOPT_SSL_VERIFYPEER,false);
		
		$this->out = curl_exec($this->ch);
		
		if(!isset($this->out))
			return false;
		return true;
	}

	public function getPicturePath()
	{
		$pattern="<img class=\"\" src=\"(.*?)\".*?>";
		$match=$this->regex($pattern);
		if(isset($match))
		{
			$this->picpath = $match[1];
			return true;
		}
		else
			return false;
	}
	
	//下面这个函数获取图书的简介。
	public function getInroduction()
	{
		#TODO....
		$pattern1= "<a href=\"(.*?)\" title=\".*?\".*?>";
		$pattern2="/<div class=\"intro\">\s+<p>(.*?)<\/div>/";
		$match=$this->regex($pattern1);
		if(!isset($match))
			return false;
		$bookRealURL=$match[1];
		
		$this->url=$bookRealURL;
		$this->getURL();
		$match2=$this->regex($pattern2);
		$this->inroduction = $match2[1];
		return true;
	}
	//下面这个函数获取图书的作者..
	public function getAuthor()
	{
		#TODO...
		$pattern="/<div class=\"pub\">\s+(.*?)\s+<\/div>/";
		$match=$this->regex($pattern);
		if(!isset($match))
			return false;
		$this->author=$match[1];
		
		return $this->author;
	}
	public function test_returnPicPath()
	{
		return $this->picpath;
	}
}

?>
