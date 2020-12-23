<?php    

class objednavka {

    var $produkt1;
    var $produkt2;
    var $produkt3;
    
    
        function objednavka() {
            
            $this->produkt1= 0;
            $this->produkt2 = 0;
            $this->produkt3 = 0;
            
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
            
            $sql = "SELECT id FROM zakaznik WHERE email = '$uzivatel->email'";
            $q = mysqli_query($db,$sql);
            $row = mysqli_fetch_assoc($q);
            $id_zakaznik = $row['id']; 
    
            $email = $_POST["email"];
            $email = trim($email);
            $meno = $_POST["meno"];
            $ulica = $_POST["ulica"];
            $mesto = $_POST["mesto"];
            $psc = $_POST["psc"];
            $tel = $_POST["tel"];
            $platba = $_POST["platba"];
            $dorucenie = $_POST["dorucenie"];
            $datum = today("Y-m-d");
            $cena = ((($objednavka->produkt3*$pr3['cena']) + ($objednavka->produkt2*$pr2['cena'])) + ($objednavka->produkt1*$pr1['cena'])) ;
            $stav = "Spracováva sa";

        if ((($objednavka->produkt1 > $pr1['mnozstvo'] || $objednavka->produkt2 > $pr2['mnozstvo']) || $objednavka->produkt3 > $pr3['mnozstvo'])) {
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
            produkt_1 = '$objednavka->produkt1',
            produkt_2 = '$objednavka->produkt2',
            produkt_3 = '$objednavka->produkt3',
            id_dorucenie = '$dorucenie',
            id_platba = '$platba',
            datum = '$datum',
            cena = '$cena',
            stav = '$stav'   
            ";

        mysqli_query($db,$sql);
    
        
        $this->hlaseni("Vašu objednávku sme zaevidovali. O jej ďalšom spracovaní Vás budeme informovat e-mailom.");
        
        $this->produkt1= 0;
        $this->produkt2 = 0;
        $this->produkt3 = 0;


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
        
}  
?>                
        
                                         