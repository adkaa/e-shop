<?php   
session_start();
?>

<div style="margin:auto;">
<?php
if ((($uzivatel->produkt1 !=0 || $uzivatel->produkt2 !=0) || $uzivatel->produkt3 !=0)) {

    echo "<div class= \"tabulka\" style=\"width:60%; text-align:center; margin: auto; background-color:#eeee; padding:20px;\" >";
    echo "<h2 style=\"margin-bottom:50px;\"><b>Obsah košíka</b></h2>";
    require ("./pripojenie.php");
    
    $sql = "SELECT * FROM produkty WHERE id=1";
    $p = mysqli_query($db,$sql);
    $pr1 = mysqli_fetch_assoc($p);
    
    $sql = "SELECT * FROM produkty WHERE id=2";
    $p = mysqli_query($db,$sql);
    $pr2 = mysqli_fetch_assoc($p);
    
    $sql = "SELECT * FROM produkty WHERE id=3";
    $p = mysqli_query($db,$sql);
    $pr3 = mysqli_fetch_assoc($p);
    
    
        echo "<div class=\"row\">";
            echo "<div class=\"col-md-3\">";
                echo "<p><b>Produkt</b></p>";
            echo "</div>";  
        
            echo "<div class=\"col-md-2\">";
                echo "<p><b>Jednotková cena</b></p>";
            echo "</div>";
            
            echo "<div class=\"col-md-2\">";
                echo "<p><b>Množstvo</b></p>";
            echo "</div>";
                    
            echo "<div class=\"col-md-2\">";
                echo "<p><b>Cena celkom</b></p>";
            echo "</div>";        
                    
        echo "</div>";
        echo "<hr style=\"border-color:#E6E6FA;\">"; 
        
    if ($uzivatel->produkt1 > 0) {
        echo "<div class=\"row\">";
            echo "<div class=\"col-md-3\">";
                echo "<a href=\"./index.php?p=produkt1\"> ".$pr1['nazov'] ."</a>";
            echo "</div>";  
        
            echo "<div class=\"col-md-2\">";
                echo $pr1['cena'] ." €";
            echo "</div>";
            
            echo "<div class=\"col-md-2\">";
                echo $uzivatel->produkt1." ks";
            echo "</div>";
                    
            echo "<div class=\"col-md-2\">";
                echo $uzivatel->produkt1*$pr1['cena'] ." €";
            echo "</div>";    
            echo "<form role=\"form\" method=post action =\"\">";
            echo "<input type=\"hidden\" name=\"akce\" value=\"minus1\">";
            echo "<button type=\"submit\" class=\"btn btn-default\" ><span class=\"glyphicon glyphicon-trash\"></span> Odstrániť</button>";
        echo "</form>";
                    
        echo "</div>";
        echo "<hr style=\"border-color:white;\">";       
    }
    
    if ($uzivatel->produkt2 > 0) {
        echo "<div class=\"row\">";
            echo "<div class=\"col-md-3\">";
                echo "<a href=\"./index.php?p=produkt2\"> ".$pr2['nazov'] ."</a>";
            echo "</div>";  
        
            echo "<div class=\"col-md-2\">";
                echo $pr2['cena'] ." €";
            echo "</div>";
            
            echo "<div class=\"col-md-2\">";
                echo $uzivatel->produkt2." ks";
            echo "</div>";
                    
            echo "<div class=\"col-md-2\">";
                echo $uzivatel->produkt2*$pr2['cena'] ." €";
            echo "</div>";        
            echo "<form role=\"form\" method=post action =\"\">";
            echo "<input type=\"hidden\" name=\"akce\" value=\"minus2\">";
            echo "<button type=\"submit\" class=\"btn btn-default\" ><span class=\"glyphicon glyphicon-trash\"></span> Odstrániť</button>";
        echo "</form>";       
        echo "</div>";
        echo "<hr style=\"border-color:white;\">";       
    }
    
    if ($uzivatel->produkt3 > 0) {
        echo "<div class=\"row\">";
            echo "<div class=\"col-md-3\">";
                echo "<a href=\"./index.php?p=produkt3\"> ".$pr3['nazov'] ."</a>";
            echo "</div>";  
        
            echo "<div class=\"col-md-2\">";
                echo $pr3['cena'] ." €";
            echo "</div>";
            
            echo "<div class=\"col-md-2\">";
                echo $uzivatel->produkt3." ks";
            echo "</div>";
                    
            echo "<div class=\"col-md-2\">";
                echo $uzivatel->produkt3*$pr3['cena'] ." €";
            echo "</div>";        
            echo "<form role=\"form\" method=post action =\"\">";
            echo "<input type=\"hidden\" name=\"akce\" value=\"minus3\">";
            echo "<button type=\"submit\" class=\"btn btn-default\" ><span class=\"glyphicon glyphicon-trash\"></span> Odstrániť</button>";
        echo "</form>";       
        echo "</div>";
        echo "<hr style=\"border-color:white;\">";       
    }
     echo "<div class=\"row\">";
            echo "<div class=\"col-md-3\"></div>";  
        
            echo "<div class=\"col-md-2\">";
                echo "<p><b></b></p></div>";
            
            echo "<div class=\"col-md-2\">";
                echo "<h3>Celkom</h3></div>";
                    
            echo "<div class=\"col-md-2\">";
                echo "<h3>" .((($uzivatel->produkt3*$pr3['cena']) + ($uzivatel->produkt2*$pr2['cena'])) + ($uzivatel->produkt1*$pr1['cena'])) ." € </h3></div>";        
                    
        echo "</div>";
        echo "<hr style=\"border-color:#E6E6FA;\">"; 
?>

<h2><b>Potrebné údaje</b></h2>
<?php

     
        
   if ($uzivatel->prihlaseny===false){
   
         echo "<div class=\"panel-body\">";
        echo "<form role=\"form\" method=post action =\"\">";
        echo "<input type=\"hidden\" name=\"akce\" value=\"objednavka_neprihlaseny\">";
 
         
        
        echo "<div class=\"col-md-3\">";
        echo "</div>";
        
        echo "<div class=\"col-md-6\" style=\"background-color:#B0C4DE; margin:2%; padding:2%;\">";    
        
        echo "<div class=\"col-md-4\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"meno\">Meno</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"meno\" name=\"meno\" value=\"". $_REQUEST["meno"] ."\" placeholder=\"Jana\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"col-md-8\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"priezvisko\">Priezvisko</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"priezvisko\" name=\"priezvisko\" value=\"". $_REQUEST["priezvisko"] ."\" placeholder=\"Malá\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"ulica\">Ulica</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"ulica\" name=\"ulica\" value=\"". $_REQUEST["ulica"] ."\" placeholder=\"Vymyslená 123/45\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"col-md-8\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"mesto\">Mesto</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"mesto\" name=\"mesto\" value=\"". $_REQUEST["mesto"] ."\" placeholder=\"Brno\">";
        echo "</div>";
        echo "</div>";
        echo "<br><br><br>";
        
        echo "<div class=\"col-md-4\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"psc\">PSČ</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"psc\" name=\"psc\" value=\"". $_REQUEST["psc"] ."\" placeholder=\"61200\">";
        echo "</div>";
        echo "</div>";
        echo "<br><br><br>";

        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"email\">E-mail</label>";
        echo "<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" value=\"". $_REQUEST["email"] ."\" placeholder=\"jana.mala@seznam.cz\">";
        echo "</div>";
        echo "</div>";
        
        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"tel\">Telefón</label>";
        echo "<input type=\"tel\" class=\"form-control\" id=\"tel\" name=\"tel\" value=\"". $_REQUEST["tel"] ."\" placeholder=\"0912 345 678\">";
        echo "</div>";
        echo "</div>";
        
        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"dorucenie\">Spôsob doručenia</label>";
        echo  "<select name=\"dorucenie\" id=\"dorucenie\" style=\"width:100%\">";
                echo "<option value=\"1\">Osobný odber</option>";
                echo "<option value=\"2\">Slovenská pošta</option>";
        echo"</select>";
        echo "</div>";
        echo "</div>";
        
        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"platba\">Spôsob platby</label>";
        echo  "<select name=\"platba\" id=\"platba\" style=\"width:100%\">";
                echo "<option value=\"1\">dobierka (v hotovosti)</option>";
                echo "<option value=\"2\">dobierka (patba kartou)</option>";
        echo"</select>";
        echo "</div>";
        echo "</div>";
        
         echo "<br>";
          echo "<br>";
           echo "<br>";
            echo "<br>";
        
echo "<button type=\"submit\" class=\"btn btn-default\" >Záväzne objednať</button>";
        
        echo "</div>";
        
        
        
        echo "<div class=\"col-md-3\">";
        echo "</div>";

        



        echo "</form>";
       
        echo "</div>";
   
   } else {
   
    echo "<div class=\"panel-body\">";
        echo "<form role=\"form\" method=post action =\"\">";
        echo "<input type=\"hidden\" name=\"akce\" value=\"objednavka_prihlaseny\">";
 
         
        
        echo "<div class=\"col-md-3\">";
        echo "</div>";
        
        echo "<div class=\"col-md-6\" style=\"background-color:#B0C4DE; margin:2%; padding:2%;\">";    
    
        echo "<div class=\"col-md-4\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"meno\">Meno</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"meno\" name=\"meno\" value=\"". $uzivatel->meno ."\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"col-md-8\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"priezvisko\">Priezvisko</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"priezvisko\" name=\"priezvisko\" value=\"". $uzivatel->priezvisko ."\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"ulica\">Ulica</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"ulica\" name=\"ulica\" value=\"". $_REQUEST["ulica"] ."\" placeholder=\"Vymyslená 123/45\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"col-md-8\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"mesto\">Mesto</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"mesto\" name=\"mesto\" value=\"". $_REQUEST["mesto"] ."\" placeholder=\"Brno\">";
        echo "</div>";
        echo "</div>";
        echo "<br><br><br>";
        
        echo "<div class=\"col-md-4\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"psc\">PSČ</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"psc\" name=\"psc\" value=\"". $_REQUEST["psc"] ."\" placeholder=\"61200\">";
        echo "</div>";
        echo "</div>";
        echo "<br><br><br>";

        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"email\">E-mail</label>";
        echo "<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" value=\"". $uzivatel->email ."\">";
        echo "</div>";
        echo "</div>";
        
        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"tel\">Telefón</label>";
        echo "<input type=\"tel\" class=\"form-control\" id=\"tel\" name=\"tel\" value=\"". $_REQUEST["tel"] ."\" placeholder=\"0912 345 678\">";
        echo "</div>";
        echo "</div>";
        
        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"dorucenie\">Spôsob doručenia</label>";
        echo  "<select name=\"dorucenie\" id=\"dorucenie\" style=\"width:100%\">";
                echo "<option value=\"1\">Osobný odber</option>";
                echo "<option value=\"2\">Slovenská pošta</option>";
        echo"</select>";
        echo "</div>";
        echo "</div>";
        
        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"platba\">Spôsob platby</label>";
        echo  "<select name=\"platba\" id=\"platba\" style=\"width:100%\">";
                echo "<option value=\"1\">dobierka (v hotovosti)</option>";
                echo "<option value=\"2\">dobierka (patba kartou)</option>";
        echo"</select>";
        echo "</div>";
        echo "</div>";
        
         echo "<br>";
          echo "<br>";
           echo "<br>";
            echo "<br>";
        
echo "<button type=\"submit\" class=\"btn btn-default\" >Záväzne objednať</button>";
        
        echo "</div>";

        echo "<div class=\"col-md-3\">";
        echo "</div>";

        



        echo "</form>";
       
        echo "</div>";
   
   }



} else {
echo"<h2 style=\"text-align:center;\">Váš košík je prázdny :-(</h2>";
}

?>

</div>