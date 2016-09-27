<?php
class webcrawer
{
	private $url;
	private $out;
	private $ch;
	private $ispost;
	private $data;
	private $header;
	
	__construct($url,$ispost=false,$data=null,$header=null)
	{
		$this->url =$url;
		$this->ispost=$ispost;
		$this->data=$data;
		$this->header= $header;
		$this->ch = curl_init();
	}
	function exec()
	{
		if($this->ispost!=false)
		{
			curl_setopt($this->ch,CURLOPT_POST,TRUE);
			curl_setopt($this->ch,CURLOPT_POSTFIELDS,$this->data);
		}
		curl_setopt($this->ch,CURLOPT_URL,$this->url);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->ch,CURLOPT_HEADER,0);
		curl_setopt(%this->ch,CURLOPT_SSL_VERIFYPEER,false);
		$this->out = curl_exec($this->ch);
	}
	function returnData()
	{
		return $this->out;
	}
}

?>