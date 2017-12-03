<?php
if (isset($_GET['file'])){
$file = ("$_GET[file]");
header ("Content-Type: application/octet-stream"); 
header ("Accept-Ranges: bytes"); 
header ("Content-Length: ".filesize($file)); 
header ("Content-Disposition: attachment; filename=".$file); 
readfile($file);
}
?>