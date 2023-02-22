<?php  
	include 'database/db_connection.php';
$file = 'document/contacts.vcf';  
header('Content-Type: application/octet-stream');  
header("Content-Transfer-Encoding: utf-8");   
header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");   
readfile($file);  
?>  