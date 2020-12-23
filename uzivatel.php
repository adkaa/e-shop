<?php
class uzivatel {

    var $email;
    var $heslo ;
    var $meno;
    var $priezvisko;
    var $prihlaseny;
    var $produkt1;
    var $produkt2;
    var $produkt3;

    function uzivatel() {
        $this->email = "";
        $this->heslo = "";
        $this->meno = "";
        $this->priezvisko = "";
        $this->prihlaseny = false;
        $this->produkt1= 0;
        $this->produkt2 = 0;
        $this->produkt3 = 0;
    }

    function registrace_form() {
        echo "<div class=\"panel panel-default\">";
        echo "<div class=\"panel-heading\">";
        echo "<h3 class=\"panel-title\">Registrácia nového zákazníka</h3>";
        echo "</div>";

        echo "<div class=\"panel-body\">";
        echo "<form role=\"form\" method=post action =\"\">";
        echo "<input type=\"hidden\" name=\"akce\" value=\"registrace\">";

        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"email\">E-mail</label>";
        echo "<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" value=\"". $_REQUEST["email"] ."\" placeholder=\"jana.mala@seznam.cz\">";
        echo "</div>";
        echo "</div>";

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
        echo "<label for=\"heslo\">Heslo</label>";
        echo "<input type=\"password\" class=\"form-control\" id=\"heslo\" name=\"heslo\" value=\"". $_REQUEST["heslo"] ."\" placeholder=\"******\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"heslo1\">Potvrdenie hesla</label>";
        echo "<input type=\"password\" class=\"form-control\" id=\"heslo1\" name=\"heslo1\" value=\"". $_REQUEST["heslo1"] ."\" placeholder=\"******\">";
        echo "</div>";
        echo "</div>";
        echo "<br><br><br>";

        echo "<button type=\"submit\" class=\"btn btn-default\" style=\"margin-left:2%;\">Zaregistrovať sa</button>";

        echo "</form>";
        echo "<br>";
        echo "</div>";
        echo "</div>";
    }

    function login_form() {
        echo "<div class=\"panel panel-default\">";
        echo "<div class=\"panel-heading\">";
        echo "<h3 class=\"panel-title\">Prihlásenie užívateľa</h3>";
        echo "</div>";

        echo "<div class=\"panel-body\">";
        echo "<form role=\"form\" method=post action =\"\">";
        echo "<input type=\"hidden\" name=\"akce\" value=\"login\">";

        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"email\">E-mail</label>";
        echo "<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" value=\"". $_REQUEST["email"] ."\" placeholder=\"jana.mala@seznam.cz\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"col-md-12\">";
        echo "<div class=\"form-group\">";
        echo "<label for=\"meno\">Heslo</label>";
        echo "<input type=\"password\" class=\"form-control\" id=\"heslo\" name=\"heslo\" value=\"". $_REQUEST["meno"] ."\" placeholder=\"******\">";
        echo "</div>";
        echo "</div>";

        echo "<button type=\"submit\" class=\"btn btn-default\" style=\"margin-left:2%;\">Prihlásiť sa</button>";

        echo "</form>";
        echo "</div>";
        echo "</div>";
    }

    function registrace() {
        $email = $_POST["email"];
        $email = trim($email);
        $heslo = $_POST["heslo"];
        $heslo1 = $_POST["heslo1"];
        $meno = $_POST["meno"];
        $priezvisko = $_POST["priezvisko"];

        $hesloH = hash('sha256',$heslo);

        define ("DBJMENO","objednajkval6873");
        define ("DBLOGIN","objednajkval6873");
        define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
        define ("DBTYP","sql4.webzdarma.cz");

        $db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
        mysqli_query($db,"SET NAMES utf8");

        $sql = "SELECT * FROM zakaznik WHERE email = '$email'";
        $v = mysqli_query($db,$sql);
        $pocet = mysqli_num_rows($v);

        if ($pocet > 0) {
            $txt = "Užívateľ s týmto e-mailom už existuje.";
            $this->chyba($txt);
            return;
        }

        if (strlen($heslo)<6) {
            $txt = "Zadané heslo je kratšie než 6 znakov, vymyslite si iné heslo.";
            $this->chyba($txt);
            return;
        }

        if ($heslo <> $heslo1) {
            $txt = "Zadané heslá nie sú rovnaké. Opravte ich prosím.";
            $this->chyba($txt);
            return;
        }

        $sql= "INSERT INTO zakaznik SET 
            meno = '$meno',
            priezvisko = '$priezvisko',
            email = '$email',
            heslo = '$hesloH'
            ";

        mysqli_query($db,$sql);

        $this->email = $email;
        $this->meno = $meno;
        $this->priezvisko = $priezvisko;
        $this->prihlaseny = true;
    }

    function login() {
        $email = $_POST["email"];
        $email = trim($email);
        $heslo = $_POST["heslo"];

        $hesloH = hash('sha256',$heslo);

        define ("DBJMENO","objednajkval6873");
        define ("DBLOGIN","objednajkval6873");
        define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
        define ("DBTYP","sql4.webzdarma.cz");

        $db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
        mysqli_query($db,"SET NAMES utf8");

        $sql = "SELECT * FROM zakaznik WHERE email = '$email'";
        $v = mysqli_query($db,$sql);
        $pocet = mysqli_num_rows($v);

        if ($pocet == 0) {
            $txt = "Užívateľ s týmto e-mailom neexistuje.";
            $this->chyba($txt);
            return;
        }

        $v1 = mysqli_fetch_object($v);
        if ($hesloH <> $v1->heslo) {
            $txt = "Heslo nie je správne.";
            $this->chyba($txt);
            return;
        }

        $this->email = $email;
        $this->meno = $v1->meno;
        $this->priezvisko = $v1->priezvisko;
        $this->prihlaseny = true;
    }

    function chyba($txt) {
        echo "<div class=\"alert alert-danger\">";
        echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">X</a>";
        echo $txt;
        echo "</div>";
    }

    function hlaseni($txt) {
        echo "<div class=\"alert alert-success\">";
        echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">X</a>";
        echo $txt;
        echo "</div>";
    }
    
    function zavazna_objednavka_prihlaseny() {
        
            define ("DBJMENO","objednajkval6873");
            define ("DBLOGIN","objednajkval6873");
            define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
            define ("DBTYP","sql4.webzdarma.cz");
    
            $db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
            mysqli_query($db,"SET NAMES utf8");
        
            $sql = "SELECT * FROM produkty WHERE id=1";
            $p = mysqli_query($db,$sql);
            $pr1 = mysqli_fetch_assoc($p);
            
            $sql = "SELECT * FROM produkty WHERE id=2";
            $p = mysqli_query($db,$sql);
            $pr2 = mysqli_fetch_assoc($p);
            
            $sql = "SELECT * FROM produkty WHERE id=3";
            $p = mysqli_query($db,$sql);
            $pr3 = mysqli_fetch_assoc($p);
            
            $sql = "SELECT id FROM zakaznik WHERE email = '$this->email'";
            $q = mysqli_query($db,$sql);
            $row = mysqli_fetch_assoc($q);
            $id_zakaznik = $row['id']; 
    
            $email = $_POST["email"];
            $email = trim($email);
            $meno = $_POST["meno"];
            $priezvisko = $_POST["priezvisko"];
            $ulica = $_POST["ulica"];
            $mesto = $_POST["mesto"];
            $psc = $_POST["psc"];
            $tel = $_POST["tel"];
            $platba = $_POST["platba"];
            $dorucenie = $_POST["dorucenie"];
            $datum = date("Y-m-d");
            $cena = ((($this->produkt3*$pr3['cena']) + ($this->produkt2*$pr2['cena'])) + ($this->produkt1*$pr1['cena'])) ;
            $stav = "Spracováva sa";

        if ((($this->produkt1 > $pr1['mnozstvo'] || $this->produkt2 > $pr2['mnozstvo']) || $this->produkt3 > $pr3['mnozstvo'])) {
            $txt = "V košíku máte viac tovaru než je na sklade. Odoberte ho prosím.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($email)<1) {
            $txt = "Nezadali ste email.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($meno)<1) {
            $txt = "Nezadali ste meno.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($priezvisko)<1) {
            $txt = "Nezadali ste priezvisko.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($tel)<1) {
            $txt = "Nezadali ste telefónne číslo.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($ulica)<1) {
            $txt = "Nezadali ste ulicu.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($mesto)<1) {
            $txt = "Nezadali ste mesto.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($psc)<1) {
            $txt = "Nezadali ste psc.";
            $this->chyba($txt);
            return;
        }
        
        
        $sql= "INSERT INTO objednavka SET 
            id_zakaznik = '$id_zakaznik',
            meno = '$meno',
            priezvisko = '$priezvisko',
            email = '$email',
            telefon = '$tel',
            produkt_1 = '$this->produkt1',
            produkt_2 = '$this->produkt2',
            produkt_3 = '$this->produkt3',
            id_dorucenie = '$dorucenie',
            id_platba = '$platba',
            poznamka = '',
            datum = '$datum',
            cena = '$cena',
            stav = '$stav'   
            ";

        mysqli_query($db,$sql);
          
        $vys1=$pr1['mnozstvo'] - $this->produkt1;
        $vys2=$pr2['mnozstvo'] - $this->produkt2;
        $vys3=$pr3['mnozstvo'] - $this->produkt3;
        
        $sql="UPDATE produkty SET mnozstvo=$vys1 WHERE id=1";
        mysqli_query($db,$sql);
        $sql="UPDATE produkty SET mnozstvo=$vys2 WHERE id=2";
        mysqli_query($db,$sql);
        $sql="UPDATE produkty SET mnozstvo=$vys3 WHERE id=3";
        mysqli_query($db,$sql);
        
        
        $this->produkt1= 0;
        $this->produkt2 = 0;
        $this->produkt3 = 0;
    
        
        $this->hlaseni("Vašu objednávku sme zaevidovali. O jej ďalšom spracovaní Vás budeme informovat e-mailom.");
        
      }  
      
      
      function zavazna_objednavka_neprihlaseny() {
        
            define ("DBJMENO","objednajkval6873");
            define ("DBLOGIN","objednajkval6873");
            define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
            define ("DBTYP","sql4.webzdarma.cz");
    
            $db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
            mysqli_query($db,"SET NAMES utf8");
        
            $sql = "SELECT * FROM produkty WHERE id=1";
            $p = mysqli_query($db,$sql);
            $pr1 = mysqli_fetch_assoc($p);
            
            $sql = "SELECT * FROM produkty WHERE id=2";
            $p = mysqli_query($db,$sql);
            $pr2 = mysqli_fetch_assoc($p);
            
            $sql = "SELECT * FROM produkty WHERE id=3";
            $p = mysqli_query($db,$sql);
            $pr3 = mysqli_fetch_assoc($p);
            
            
    
            $email = $_POST["email"];
            $email = trim($email);
            $meno = $_POST["meno"];
            $priezvisko = $_POST["priezvisko"];
            $ulica = $_POST["ulica"];
            $mesto = $_POST["mesto"];
            $psc = $_POST["psc"];
            $tel = $_POST["tel"];
            $platba = $_POST["platba"];
            $dorucenie = $_POST["dorucenie"];
            $datum = date("Y-m-d");
            $cena = ((($this->produkt3*$pr3['cena']) + ($this->produkt2*$pr2['cena'])) + ($this->produkt1*$pr1['cena'])) ;
            $stav = "Spracováva sa";

        if ((($this->produkt1 > $pr1['mnozstvo'] || $this->produkt2 > $pr2['mnozstvo']) || $this->produkt3 > $pr3['mnozstvo'])) {
            $txt = "V košíku máte viac tovaru než je na sklade. Odoberte ho prosím.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($email)<1) {
            $txt = "Nezadali ste email.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($meno)<1) {
            $txt = "Nezadali ste meno.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($priezvisko)<1) {
            $txt = "Nezadali ste priezvisko.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($tel)<1) {
            $txt = "Nezadali ste telefónne číslo.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($ulica)<1) {
            $txt = "Nezadali ste ulicu.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($mesto)<1) {
            $txt = "Nezadali ste mesto.";
            $this->chyba($txt);
            return;
        }
        
        if (strlen($psc)<1) {
            $txt = "Nezadali ste psc.";
            $this->chyba($txt);
            return;
        }
        
        
        $sql= "INSERT INTO objednavka SET
            id_zakaznik = '1',  
            meno = '$meno',
            priezvisko = '$priezvisko',
            email = '$email',
            telefon = '$tel',
            produkt_1 = '$this->produkt1',
            produkt_2 = '$this->produkt2',
            produkt_3 = '$this->produkt3',
            id_dorucenie = '$dorucenie',
            id_platba = '$platba',
            poznamka = '',
            datum = '$datum',
            cena = '$cena',
            stav = '$stav'   
            ";

        mysqli_query($db,$sql);
        
        $vys1=$pr1['mnozstvo'] - $this->produkt1;
        $vys2=$pr2['mnozstvo'] - $this->produkt2;
        $vys3=$pr3['mnozstvo'] - $this->produkt3;
        
        $sql="UPDATE produkty SET mnozstvo=$vys1 WHERE id=1";
        mysqli_query($db,$sql);
        $sql="UPDATE produkty SET mnozstvo=$vys2 WHERE id=2";
        mysqli_query($db,$sql);
        $sql="UPDATE produkty SET mnozstvo=$vys3 WHERE id=3";
        mysqli_query($db,$sql);
        
        $this->produkt1= 0;
        $this->produkt2 = 0;
        $this->produkt3 = 0;
    
        
        $this->hlaseni("Vašu objednávku sme zaevidovali. O jej ďalšom spracovaní Vás budeme informovat e-mailom.");
        
      }  
      
      
    
    function pridanie1() {
            define ("DBJMENO","objednajkval6873");
            define ("DBLOGIN","objednajkval6873");
            define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
            define ("DBTYP","sql4.webzdarma.cz");
    
            $db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
            mysqli_query($db,"SET NAMES utf8");

            $sql = "SELECT produkt_1 FROM kosik WHERE id=1";
            $p = mysqli_query($db,$sql);
            $vys = mysqli_fetch_assoc($p);
            $pocet = $vys['produkt_1'];
            
            $pocet = $pocet + 1;
            $this->produkt1 = $this->produkt1 + 1; 
           
            $sql= "UPDATE kosik SET produkt_1='$pocet'";
            mysqli_query($db,$sql);
        }
        
        function pridanie2() {
            define ("DBJMENO","objednajkval6873");
            define ("DBLOGIN","objednajkval6873");
            define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
            define ("DBTYP","sql4.webzdarma.cz");
    
            $db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
            mysqli_query($db,"SET NAMES utf8");

            $sql = "SELECT produkt_2 FROM kosik WHERE id=2";
            $p = mysqli_query($db,$sql);
            $vys = mysqli_fetch_assoc($p);
            $pocet = $vys['produkt_2'];
            
            $pocet = $pocet + 1;
            $this->produkt2 = $this->produkt2 + 1; 
           
            $sql= "UPDATE kosik SET produkt_2='$pocet'";
            mysqli_query($db,$sql);
        }
        
        function pridanie3() {
            define ("DBJMENO","objednajkval6873");
            define ("DBLOGIN","objednajkval6873");
            define ("DBHESLO","#8530FVf9k#m6Q&@7z2*");
            define ("DBTYP","sql4.webzdarma.cz");
    
            $db = mysqli_connect(DBTYP, DBLOGIN, DBHESLO, DBJMENO);
            mysqli_query($db,"SET NAMES utf8");

            $sql = "SELECT produkt_3 FROM kosik WHERE id=3";
            $p = mysqli_query($db,$sql);
            $vys = mysqli_fetch_assoc($p);
            $pocet = $vys['produkt_3'];
            
            $pocet = $pocet + 1;
            $this->produkt3 = $this->produkt3 + 1; 
           
            $sql= "UPDATE kosik SET produkt_3='$pocet'";
            mysqli_query($db,$sql);
        }
        
        function minus1() {
            $this->produkt1=0;
        }
        
        function minus2() {
            $this->produkt2=0;
        }
        
        function minus3() {
            $this->produkt3=0;
        }
    
}
?>

