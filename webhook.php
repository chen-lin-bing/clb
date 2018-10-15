 <?php
    $target = '/www/clb'; // 生产环境web目录
    //密钥
    $secret = "";
    $wwwUser = 'root';
    $wwwGroup = 'root';

    //日志文件地址
   $fs = fopen('./date.log', 'a');

    //获取GitHub发送的内容 
    $json = file_get_contents('php://input');
    $content = json_decode($json, true);
    //github发送过来的签名  
    $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
//	var_dump($content);
  //  if (!$signature) {
    //   fclose($fs);
     //  return http_response_code(404);
   //  }
//$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
if ($signature) {
  $hash = "sha1=".hash_hmac('sha1', file_get_contents("php://input"), $secret);
  if (strcmp($signature, $hash) == 0) {
  //  echo shell_exec("cd {$path} && /usr/bin/git reset --hard origin/master && /usr/bin/git clean -f && /usr/bin/git pull 2>&1");
   // exit();
	
       // $cmd = "cd $target && git pull";
       // $res = shell_exec($cmd);
      echo 1;
	$res_log = '';
        $res_log .= 'Success:'.PHP_EOL;
        $res_log .= $content['head_commit']['author']['name'] . ' 在' . date('Y-m-d H:i:s') . '向' . $content['repository']['name'] . '项目的' . $content['ref'] . '分支push了' . count($content['commits']) . '个commit：' . PHP_EOL;
        $res_log .= $res.PHP_EOL;
        $res_log .= '======================================================================='.PHP_EOL;

        fwrite($fs, $res_log);
        $fs and fclose($fs);


      } else {
            $res_log  = 'Error:'.PHP_EOL;
            $res_log .= $content['head_commit']['author']['name'] . ' 在' . date('Y-m-d H:i:s') . '向' . $content['repository']['name'] . '项目的' . $content['ref'] . '分支push了' . count($content['commits']) . '>个commit：' . PHP_EOL;
            $res_log .= '密钥不正确不能pull'.PHP_EOL;
            $res_log .= '======================================================================='.PHP_EOL;
           fwrite($fs, $res_log);
           $fs and fclose($fs);
      
  }
}
 //   list($algo, $hash) = explode('=', $signature, 2);
    //计算签名  
   // $payloadHash = hash_hmac($algo, $json, $secret);

    // 判断签名是否匹配  
