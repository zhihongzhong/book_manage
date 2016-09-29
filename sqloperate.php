<?php

class sqloperate{
	private $conn; // 保存和mysql的连接 。
	private $res;  // 保存query之后返回的数据.
	private $db;
	function __construct($host ="localhost",$user ="root",$passwd="qingtian1",$db ="book_manage")
	{
		$this->db = $db;
		$this->conn = mysqli_connect($host,$user,$passwd,$db);
		if(!isset($this->conn))
			die();
		
	}
	
	
	// 下面这个函数在Books 表中插入一条数据
	// bookName : 书名
	// author : 作者
	// inroduction: 图书摘要
	
	function insertToBooks($bookName,$author,$inroduction,$imgPath)
	{
		#TODO...
	}
}

?>