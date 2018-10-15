<?php
// GitHub Webhook Secret.
// Keep it the same with the 'Secret' field on your Webhooks / Manage webhook page of your respostory.
$secret = "123";
// Path to your respostory on your server.
// e.g. "/var/www/respostory"
$path = "";
// Headers deliveried from GitHub
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
if ($signature) {
  $hash = "sha1=".hash_hmac('sha1', file_get_contents("php://input"), $secret);
  if (strcmp($signature, $hash) == 0) {
  // echo shell_exec("cd {$path} && /usr/bin/git reset --hard origin/master && /usr/bin/git clean -f && /usr/bin/git pull 2>&1");
 // echo '222';
// $shell = 'echo  123 > date.log';
  file_put_contents('date.log','SUSCCESS '.date('Y-m-d h:i:s').'/n' ,FILE_APPEND);
 // exec($shell);
       //var_dump($a); 
    
  }else{
  file_put_contents('date.log','ERROR '. date('Y-m-d h:i:s'),FILE_APPEND);
  http_response_code(404);
 }
}
?>
