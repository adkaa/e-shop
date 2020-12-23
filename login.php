<?php 
session_start();


if ($uzivatel->prihlaseny === false) {
    echo "<div class=\"row\">";
    echo "<div class=\"col-md-4\">";
    echo "</div>";
    echo "<div class=\"col-md-4\">";
        $uzivatel->login_form();
    echo "</div>";
    echo "<div class=\"col-md-4\">";
    echo "</div>";
    echo "</div>";
} else {
    echo "<h3 style=\"text-align:center; margin:3%;\"> Vitajte, " .$uzivatel->meno ." " .$uzivatel->priezvisko .". Boli ste úspešne prihlásený(-á).</h3>";
    echo "<h3 style=\"text-align:center; margin:3%;\">Prajeme Vám príjemný nákup.</h3>";
}     

$_SESSION["uzivatel"] = $uzivatel;
?>

