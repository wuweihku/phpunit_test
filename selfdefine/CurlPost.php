<?php
/**
 *这个类用于实现php下curl的post方法
 *参考文献：http://blog.csdn.net/jallin2001/article/details/6599052
 */
class CurlPost {

public function postData($url, $data)
{
	$ch = curl_init();  //初始化一个curl会话, curl_init()函数唯一的一个参数是可选的，表示一个url地址
	$timeout = 3000; 
	curl_setopt($ch, CURLOPT_URL, $url); //为一个curl设置会话参数，这里设置你需要抓取的URL
	curl_setopt($ch, CURLOPT_REFERER, $url); 
	curl_setopt($ch, CURLOPT_POST, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //直接传数组即可，不用编译成json
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果保存到字符串中还是输出到屏幕上
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$handles = curl_exec($ch);  //执行一个curl会话，唯一的参数是curl_init()函数返回的句柄
	curl_close($ch);  //关闭一个curl会话，唯一的参数是curl_init()函数返回的句柄
	return $handles; //以上方式获取到的数据是json格式的，使用json_decode函数解释成数组,json_decode($***,true);

}

}
?>
