<?php
 /**
  * 文件       InterfaceTest.php
  * @category  PHPUINT
  * @author    WU WEI <wuwei@joygames.cc>
  */

require_once 'CsvFileIterator.php';
require_once 'CurlPost.php';

/**
 * 用途        接口测试，用于运营后台，接收获取应用服务器的申请，返回申请的结果
 */

class InterfaceTest extends PHPUnit_Framework_TestCase
{

	protected $url = 'http://wwwapi.15166.com/server?action=listAll&';
    protected $server_interface_num = 0;  //计算一共跑了多少条测试数据
	protected $info;	

	protected function setUp()
	{
		
	}


    /**
     * @dataProvider csvProvider
     */
	public function testListAll($comments, $appid, $channel, $appkey, $expected)
	{
		$this->info = array('appid'=>$appid,'channel'=>$channel,'time'=>'','sign'=>'');
		$this->info['time'] = time();

	//	print_r($this->info['time']);	

		$strmd5 = $this->info['appid'].$this->info['time'].$appkey; 
		$this->info['sign'] = md5($strmd5);

	//	print_r($this->info['sign']); 
		print_r($this->server_interface_num);
		$json_info = CurlPost::postData($this->url, $this->info);  
		
	//	$response_array = json_decode($json_info,true); 
		print_r($json_info);	
		


		$this->assertEquals($response_array['code'],$expected); 
        
	}


	public function csvProvider()
    {
        return new CsvFileIterator('csv/server_interface_data.csv');
    }

	protected function tearDown()
	{

	}




}
?>
