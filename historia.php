<h1 style="text-align:center;">História objednávok</h1>

<?php   
session_start();

define ("DBJMENO","objednajkval6873");
define ("DBLOGIN","objednajkval6873");
define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
define ("DBTYP","sql4.webzdarma.cz");

$db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
mysqli_query($db,"SET NAMES utf8");

$sql = "SELECT id FROM zakaznik WHERE email = '$uzivatel->email'";
$q = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($q);
$id_zakaznik = $row['id']; 

$sql = "SELECT * FROM objednavka WHERE id_zakaznik = '$id_zakaznik'";
$p = mysqli_query($db,$sql);
$pocet = mysqli_num_rows($p);
$vys = mysqli_fetch_assoc($p);
$id_zakaznik_objednavky = $vys['id_zakaznik'];


if ($id_zakaznik != $id_zakaznik_objednavky) {
    echo "<p style=\"text-align:center;\">Ešte ste u nás nenakupovali.</p>";
} else {
    echo "<p style=\"text-align:center;\">V našom obchode ste nakupovali ".$pocet ."-krát.</p><br><br>";
    
    echo "<div class= \"tabulka\" style=\"width:70%; text-align:center; margin: auto; background-color:#eeee; padding:20px;\" >";
        echo "<div class=\"row\">";
            echo "<div class=\"col-md-3\">";
                echo "<b>Dátum objednávky</b>";
            echo "</div>";
                    
            echo "<div class=\"col-md-3\">";
                echo "<b>Položky objednávky</b>";
            echo "</div>";
                        
            echo "<div class=\"col-md-3\">";
                echo "<b>Cena objednávky</b>";
            echo "</div>";
            
            echo "<div class=\"col-md-3\">";
                echo "<b>Stav objednávky</b>";
            echo "</div>";
        
        echo "</div>";
        echo "<hr style=\"border-color:white;\">";
        
        $sql = "SELECT * FROM objednavka WHERE id_zakaznik = '$id_zakaznik'";
        $p = mysqli_query($db,$sql);
        while ($v1=mysqli_fetch_object($p)) {
            echo "<div class=\"row\">";
                echo "<div class=\"col-md-3\">";
                    echo $v1->datum;
                echo "</div>";
                
                echo "<div class=\"col-md-3\">";
                    if ($v1->produkt_1 != 0) {
                        echo "Epiphyllum Anguliger (".$v1->produkt_1 ."-krát)";
                        echo "<br>";
                    }
                    if ($v1->produkt_2 != 0) {
                        echo "Pilea (".$v1->produkt_2 ."-krát)";
                        echo "<br>";
                    }
                    if ($v1->produkt_3 != 0) {
                        echo "Monstera (".$v1->produkt_3 ."-krát)";
                        echo "<br>";
                    }
                echo "</div>";
                
                echo "<div class=\"col-md-3\">";
                    echo $v1->cena ." €";
                echo "</div>";
                
                echo "<div class=\"col-md-3\">";
                    if ($v1->stav =='V preprave') {
                        echo "<p style=\"color:#DAA520;\">" .$v1->stav ."</p>";
                    }
                    if ($v1->stav =='Spracováva sa') {
                        echo "<p style=\"color:#FA8072;\">" .$v1->stav ."</p>";
                    }
                    if ($v1->stav =='Doručené') {
                        echo "<p style=\"color:#3CB371;\">" .$v1->stav ."</p>";
                    }
                echo "</div>";
                
            echo "</div>";
            echo "<hr style=\"border-color:white;\">";
        }
      echo "</div>";
     
}



?>
