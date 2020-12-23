<?php
require ("./uzivatel.php");
require ("./objednavka.php");
require ("./pripojenie.php");
session_start();
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="webzdarma, web, zdarma, php, freehosting, hosting, databáze, PHP, MySQL">
    <link rel="shortcut icon" href="./img/add-to-cart.png"/>
	<title>Objednaj kvalitné!</title>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    
    <style>
    
        html {
        overflow-x: hidden;
        }
        img:hover {
            opacity:80%;
        }
        
         /* Remove the jumbotron's default bottom margin */ 
        .jumbotron {
            margin-top: 0;
        }
        
       
        .navbar-inverse {
            margin: 0;
        }
        
        .panel-footer {
            text-decoration:none;
            color:black;
        }
        
        .pata {
            background-color:#eee; 
            height:auto; 
           
        }
        
        .carousel-inner {
            height:70%;
            width:auto;
        }
    
        .item active{
            height:70%;
            width:auto;
        }
    
        .carousel {
            width:500px;

        }
    </style>
   
</head>

<body>

<!-- menu -->

<?php
    if (isset($_GET["p"]))
        $page = $_GET["p"];
    else
        $page ="";
  
    if (isset($_SESSION["uzivatel"])) {  
        $uzivatel = $_SESSION["uzivatel"];      
    } else {
        $uzivatel = new uzivatel();   
    }
    
    
    
if (isset($_POST["akce"]))
    $akce = $_POST["akce"];
else
    $akce = "";
    
if (isset($_SESSION["kosik"])) {
    $kosik = $_SESSION["kosik"];
} else {
define ("DBJMENO","objednajkval6873");
define ("DBLOGIN","objednajkval6873");
define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
define ("DBTYP","sql4.webzdarma.cz");
 
$db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
mysqli_query($db,"SET NAMES utf8");

    $sql = "SELECT TOP 1 * FROM kosik ORDER BY id DESC";
    $p = mysqli_query($db,$sql);
    $vys = mysqli_fetch_assoc($p);
    $posledny =$vys['id'];
    $moje = $posledny + 1;
    
    $sql= "INSERT INTO kosik SET 
            id = '$moje',
            produkt_1 = '0',
            produkt_2 = '0',
            produkt_3 = '0'
            ";

        mysqli_query($db,$sql);
    $kosik = $moje;
}

    
    switch ($akce) {
        case "registrace" : $uzivatel->registrace(); break;
        case "login" : $uzivatel->login(); break;
        case "minus1" : $uzivatel->minus1(); break;
        case "minus2" : $uzivatel->minus2(); break;
        case "minus3" : $uzivatel->minus3(); break;
        case "objednavka_neprihlaseny" : $uzivatel->zavazna_objednavka_neprihlaseny(); break;
        case "objednavka_prihlaseny": $uzivatel->zavazna_objednavka_prihlaseny(); break;
        case "produkt1" : $uzivatel->hlaseni("Produkt bol úspešne pridaný do košíka."); $uzivatel->pridanie1(); break;
        case "produkt2" : $uzivatel->hlaseni("Produkt bol úspešne pridaný do košíka."); $uzivatel->pridanie2(); break;
        case "produkt3" : $uzivatel->hlaseni("Produkt bol úspešne pridaný do košíka."); $uzivatel->pridanie3(); break;
    }   

    $_SESSION["uzivatel"] = $uzivatel;
    $_SESSION["page"] = $page;
    $_SESSION["kosik"] = $kosik;

    echo"<nav class=\"navbar navbar-inverse\">";
        echo"<div class=\"container-fluid\">";
            echo"<div class=\"navbar-header\">";
                echo"<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">";
                    echo"<span class=\"icon-bar\"></span>";
                    echo"<span class=\"icon-bar\"></span>";
                    echo"<span class=\"icon-bar\"></span>";
                echo"</button>";
    
            echo"</div>";
            echo"<div class=\"collapse navbar-collapse\" id=\"myNavbar\">";
                echo"<ul class=\"nav navbar-nav\">";
                
                    if ($page == "domov" || $page=="")
                        echo "<li class=\"active\"><a href=\"./index.php?p=domov\">Domov</a></li>"; 
                    else 
                        echo "<li><a href=\"./index.php?p=domov\">Domov</a></li>";
                echo"</ul>";
                
                echo"<ul class=\"nav navbar-nav navbar-right\">";
                
                    if ($uzivatel->prihlaseny === false) {
                        if ($page == "login")
                            echo "<li class=\"active\"><a href=\"./index.php?p=login\"><span class=\"glyphicon glyphicon-user\"></span>" ." Log in" ."</a></li>"; 
                        else 
                            echo "<li><a href=\"./index.php?p=login\"><span class=\"glyphicon glyphicon-user\"></span>" ." Log in" ."</a></li>";
                        
                        if ($page == "registracia")
                            echo "<li class=\"active\"><a href=\"./index.php?p=registracia\"><span class=\"glyphicon glyphicon-user\"></span>" ." Registrácia" ."</a></li>"; 
                        else 
                            echo "<li><a href=\"./index.php?p=registracia\"><span class=\"glyphicon glyphicon-user\"></span>" ." Registrácia" ."</a></li>";
                        
                    } else {
                        if ($page == "historia")
                            echo "<li class=\"active\"><a href=\"./index.php?p=historia\" class=\"neklikat\"><span class=\"glyphicon glyphicon-user\"></span>" ." ".$uzivatel->meno ." " .$uzivatel->priezvisko ."</a></li>";
                        else      
                            echo "<li><a href=\"./index.php?p=historia\" class=\"neklikat\"><span class=\"glyphicon glyphicon-user\"></span>" ." ".$uzivatel->meno ." " .$uzivatel->priezvisko ."</a></li>";
                   
                        echo "<li><a href=\"./index.php?p=odhlasenie\"><span class=\"glyphicon glyphicon-user\"></span>" ."Odhlásiť sa"."</a></li>";
                    }
                    if ($page == "kosik")
                        echo"<li class=\"active\"><a href=\"./index.php?p=kosik\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> Košík</a></li>";  
                    else
                        echo"<li><a href=\"./index.php?p=kosik\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> Košík</a></li>"; 
                echo"</ul>";
            echo"</div>";   
        echo"</div>";
    echo"</nav>";
?>    
 
<!--Horná lišta-->

    <div class="jumbotron text-center">
        <a href="index.php" style="text-decoration:none;"><h1 >Rastlinky Do Vitrínky</h1></a>
        <p>Objednajte si krásne rastlinky do Vášho domova!</p> 
    </div>
     
    
<?php
    switch($page) {
        case "domov": include("./home.php"); break;
        case "registracia": include("./registracia.php"); break;
        case "odhlasenie":  include("./odhlasenie.php"); break;
        case "login": include("./login.php"); break;
        case "kosik": include("./kosik.php"); break;
        case "produkt1": include ("./produkt1.php"); break;
        case "produkt2": include ("./produkt2.php"); break;
        case "produkt3": include ("./produkt3.php"); break;
        case "historia": include("./historia.php"); break;
        default: include ("./home.php"); break;
    }
?>
                                                                                                                  

    <div id="kontakt" class="pata" >
        
        <div class="text5" style="background-color:#eee; height:auto;   margin-top:40px; padding-left:10%; padding-top:30px;padding-bottom:30px;">
        <h4>Kontakt</h4>
            <table>
                <tr>
                    <td></td>
                    <td>Vymyslená 5678/89, 05801 Poprad</td>
                </tr>
                <tr>
                    <td></td>
                    <td>IČO : 12345678</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
    
                    <td><a href="mailto:info@objednaj.kvalitne.cz">info@objednaj.kvalitne.cz</a></td>
                </tr>
            </table>
            </div>
            <?php
            echo"<p style=\" text-align:center; padding-bottom:30px; color:#DCDCDC;\">© Andrea Kumorovitzová ".date(Y) ."</p>";
           ?>
    </div>    

    

<?php
    $_SESSION["page"]=$page;
    $_SESSION["uzivatel"] = $uzivatel;
?>

</body>

</html>
