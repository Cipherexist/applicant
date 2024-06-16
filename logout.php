<?php 
$huan = "0";
$two = "0";
$account = "";

setcookie('usname', $huan, time() - 3600);
setcookie('psword', $two, time() - 3600);
setcookie('account', $account, time() - 3600);

echo '<script> window.location.replace("index.html");</script> ';

?> 
