<?php
class WechatMenu
 {
 public function getAccessToken() //获取access_token
 {
 $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".AppId."&secret=".AppSecret;

 $data = $this->getCurl($url);//通过自定义函数getCurl得到https的内容

 $resultArr = json_decode($data, true);//转为数组
 return $resultArr["access_token"];//获取access_token
 }
 
public function creatMenu()//创建菜单
 {
  echo "开始调用createMenu".date("c")."<br>";
 	//获取access_token
	$accessToken = $this->getAccessToken();
	//构造POST给微信服务器的菜单结构体

	$menuPostString = '{
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索",
               "url":"http://www.soso.com/"
            },
            {
               "type":"view",
               "name":"视频",
               "url":"http://v.qq.com/"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 	}';
	//POST的url
	$menuPostUrl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$accessToken;
 echo $menuPostUrl;
 echo "<br>";
 echo date("c")."<br>";

	$menu = $this->dataPost($menuPostString, $menuPostUrl);//将菜单结构体POST给微信服务器

 echo $menu;
 echo "<br>";
 echo date("c")."<br>";

	return $menu;
 }

 
function getCurl($url){//get https的内容


 $ch = curl_init();

 
 curl_setopt($ch, CURLOPT_URL,$url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//不输出内容
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 $result =  curl_exec($ch);
 curl_close ($ch);
 return $result;
 }
 
function dataPost($post_string, $url) {//POST方式提交数据
 echo "starting function dataPost";
 echo "<br>";
 echo date("c")."<br>";
 $context = array ('http' => array ('method' => "POST", 'header' => "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) \r\n Accept: */*", 'content' => $post_string ) );
 $stream_context = stream_context_create ( $context );
 $data = file_get_contents ( $url, FALSE, $stream_context );
 return $data;
 }


}
?>