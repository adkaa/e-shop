<?php
session_start();
?>

<div class="container">
<div class="row">
  <div class="col-sm-6">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="d-block w-70"  src="./img/monstera-1.jpg"" alt="Image">
          <div class="carousel-caption">
          </div>      
        </div>

        <div class="item">
          <img src="./img/monstera-2.jpg"" alt="Image">
          <div class="carousel-caption">
          </div>      
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  
  <div class="col-sm-6">
            <h1>Monstera</h1>
    
            <div class="well" style=" width:110%;">
                <h4>Dostupnosť:</h4> 
                <p>Pokiaľ je rastlinka skladom posielame ju do 7 pracovných dní. </p>
                <br>
                <h4>Starostlivosť:</h4>
                    <li>Kaktus umiestnite na svetlé miesto, má rád filtrované slnečné svetlo alebo čiastočný tieň. </li>
                    <li>Od jari do jesene polievajte pravidelne a vždy nechajte vrchnú časť zeminy preschnúť. </li>
                    <li>V zime udržujte listy vlhké – môžete ich rosiť odstátou vodou aj každý deň.   </li>
                    <li>Teplota v miestnosti by mala byť 11 – 25 stupňov. </li>
                    <li>V lete môžete hnojiť každé 2 týždne až do kvitnutia.    </li>
                    <li>Epiphyllum nie je jedovaté pre domáce zvieratá. </li>
                    <li>Priemer kvetináča: 12 cm, dĺžka rastliny: cca 30 cm.</li>
            </div>
        </div>
    
    
    <?php
require("pripojenie.php");
$sql = 'select cena from produkty where id=3';
$v = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($v);
echo "<div>";
    echo "<h2>" .$row['cena'] ." € </h2>";
        $sql = 'select mnozstvo from produkty where id=3';
        $v = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($v) ;
        if ($row['mnozstvo'] !=0){
        echo "<form role=\"form\" method=post action =\"\">";
            echo "<input type=\"hidden\" name=\"akce\" value=\"produkt3\">";
            echo "<button type=\"submit\" class=\"btn btn-default\" >Pridať do košíka</button>";
        echo "</form>";
        } else {
            echo "<button type=\"submit\" disabled class=\"btn btn-default\" >Vypredané</button>";
        }
echo"</div>";
        
$sql = 'select mnozstvo from produkty where id=3';
$v = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($v) ;
switch ($row['mnozstvo']){
    case "0": echo "Momentálne vypredané";
              echo "<br>";
              break;
    case "1": echo "Na sklade je: 1 kus";
              echo "<br>";
              break;
    case "2": echo "Na sklade sú: 2 kusy";
              echo "<br>";
              break;
    case "3": echo "Na sklade sú: 3 kusy";
              echo "<br>";
              break;
    case "4": echo "Na sklade sú: 4 kusy";
              echo "<br>";
              break;
    default: echo "Na sklade je: " .$row['mnozstvo'] ." kusov";
             echo "<br>";
             break;         	
}
?>
    
    </div>
  </div>
</div>
<hr>
</div>  

