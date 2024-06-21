<?php 

include 'modules.php'; 

@$id = $_POST['id']; 

$getdocid = loadtextreturn("userdocuments","docid","Where `ID` Like '$id'"); 

echo loaddoctype($getdocid);

?>