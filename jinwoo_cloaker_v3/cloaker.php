<?php
$a="https://your-money-page.com";
$b="https://example.com/blank.html";
$c=["123.123.123.123","8.8.8.8"];
$d=$_SERVER['REMOTE_ADDR']??'UNKNOWN';
$e=strtolower($_SERVER['HTTP_USER_AGENT']??'');
$f=date("Y-m-d H:i:s");
$g=['google','facebook','twitter','bing','semrush','ahrefs'];
$h=false;
foreach($g as $i){if(strpos($e,$i)!==false){$h=true;break;}}
$j=in_array($d,$c);
$k="[$f] IP:$d | UA:$e | TYPE:".($j?"WHITELIST":($h?"BOT":"HUMAN"));
file_put_contents("logs.txt",$k."\n",FILE_APPEND);
header("Location:".($j||!$h?$a:$b));exit;
?>