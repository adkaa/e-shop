<?php
define ("DBJMENO","objednajkval6873");
define ("DBLOGIN","objednajkval6873");
define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
define ("DBTYP","sql4.webzdarma.cz");
 
$db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
mysqli_query($db,"SET NAMES utf8");
?>