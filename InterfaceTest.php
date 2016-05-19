<?php

 /**
  * 文件       InterfaceTest.php
  * @category  PHPUINT
  * @author    WU WEI <wuweihku@163.com>
  */

require_once "selfdefine/CsvFileIterator.php";  //csv文件流迭代器类
require_once "selfdefine/CurlPost.php";  //curl_post方法类

 /**
  * 用途       接口测试，用于运营后台，接收获取应用服务器的申请，返回申请的结果
  */
class InterfaceTest extends PHPUnit_Framework_TestCase  //测试类以***Test命名
{

	protected $url = "http://passportapi.15166.com/member-new?action=delUser&";  //请求的接口
	protected $csv_file = "csv/Alpha_Passport_Account.csv";  //csv文件的路径
	protected $info;  //csv每一行的测试数据，是一个数组	

	protected function setUp()
	{
		
	}


    /**
     * @dataProvider csvProvider
	 * 测试方法为public test***
	 * 测试数据由csvProvider迭代器提供，一次一行数据
     */
	public function testListAll($internal, $appId, $from, $signature, $username,$expected)  //按顺序，与csv首行字段一一对应
	{
		//$this->info为所要post的数组，接下来填充数组元素
		/**需要md5校验的使用这段代码
		$this->info = array("appid"=>$appid,"channel"=>$channel,"time"=>"","sign"=>"");
		$this->info["time"] = time();
		$strformd5 = $this->info["appid"].$this->info["time"].$appkey; 
		$this->info["sign"] = md5($strformd5);
		*/

		//不需要md5校验的使用这段代码
		$this->info = array("internal"=>$internal,"appId"=>$appId,"from"=>$from,"signature"=>$signature,"username"=>$username);

		//postData（）函数处理post请求，第一个参数填写接口地址，第二个参数填写所传数组
		$json_info = CurlPost::postData($this->url, $this->info);  

		//将$josn_info解码为数组
		$response = json_decode($json_info,true);     

		//第一个参数为$expected，第二个参数为$actual
		$this->assertEquals($expected,$response["code"]); 
        
	}

	/**
	*数据供给器方法，必须为public
	*/
	public function csvProvider()
	{
		return new CsvFileIterator($this->csv_file);
	}

	protected function tearDown()
	{

	}

}
?>
