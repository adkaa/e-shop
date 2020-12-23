<?php   
session_start();

define ("DBJMENO","objednajkval6873");
define ("DBLOGIN","objednajkval6873");
define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
define ("DBTYP","sql4.webzdarma.cz");
 
$db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
mysqli_query($db,"SET NAMES utf8");
$pomoc =   $_SESSION['kosik'];

$sql= "DELETE FROM kosik WHERE id=$pomoc";
mysqli_query($db,$sql);

$sql= "DELETE FROM prepis WHERE id=$pomoc";
mysqli_query($db,$sql);


session_unset();
session_destroy();
$uzivatel = new uzivatel(); 
$_SESSION["uzivatel"] = $uzivatel;



    $sql = "SELECT TOP 1 * FROM kosik ORDER BY id DESC";
    $p = mysqli_query($db,$sql);
    $vys = mysqli_fetch_assoc($p);
    $posledny =$vys['id'];
    $moje = $posledny +1;
    
    $sql= "INSERT INTO kosik SET 
            id = '$moje',
            produkt_1 = '0',
            produkt_2 = '0',
            produkt_3 = '0'
            ";

        mysqli_query($db,$sql);
    $kosik = $moje;

$_SESSION["kosik"] = $kosik;

header("Location: ./index.php");
?>