<?php 

//$sqlhost = '119.93.9.252';
$sqlhost = '163.44.242.10'; 
//$sqlhost = "localhost";

$mysql_user  = 'urzxkokt_admin';
$mysql_pass = 'virtue@00000';

$mysql_db = 'urzxkokt_vir';		
$sqlcon = mysqli_connect($sqlhost, $mysql_user , $mysql_pass, $mysql_db) or die('connection server error');


?> 
