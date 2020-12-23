<?php
session_start();
?>

<!--Produkty-->
    
    <div class="container" id="produkty">    
        <div class="row">
            <div class="col-sm-4">
                <a href="./index.php?p=produkt1" style="text-decoration:none;">
                    <div class="panel panel-default">
                    <div class="panel-heading" style=" text-decoration:none">Epiphyllum Anguliger</div>
                    <div class="panel-body"><img src="./img/epiphyllum-anguliger-1.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
                    <div class="panel-footer">
                        <p>Všeobecne známy ako kaktus rybej kosti alebo kaktus cik cak, je druh kaktusu pôvodom z Mexika.</p>
                        <p>Tento druh sa bežne pestuje ako ozdoba pre svoje voňavé kvety na jeseň.</p></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4"> 
                <a href="./index.php?p=produkt2" style="text-decoration:none;">
                    <div class="panel panel-default">
                    <div class="panel-heading">Pilea</div>
                    <div class="panel-body"><img src="./img/pilea-1.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
                    <div class="panel-footer">
                        <p>Pilea je nenáročná rastlina vhodná aj pre začiatočníkov.</p>
                        <p>Nikdy sa nebude rozrastať do šírky - má len jednu stonku.</p></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4"> 
                <a href="./index.php?p=produkt3" style="text-decoration:none;">
                    <div class="panel panel-default">
                    <div class="panel-heading">Monstera</div>
                    <div class="panel-body"><img src="./img/monstera-1.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
                    <div class="panel-footer">
                        <p>Monstera deliciosa je druh kvitnúcej rastliny pochádzajúcej z tropických lesov južného Mexika, južne od Panamy.</p>
                        <p>Monstera je toxická pre domácich miláčikov.</p></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

<br>
    
<script>
    $(document).ready(function(){
    // Add smooth scrolling to all links
        $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
    // Prevent default anchor click behavior
                event.preventDefault();
    // Store hash
                var hash = this.hash;
    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){
    // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
                });
            } // End if
        });
    });
</script>
<?php
 $_SESSION["uzivatel"] = $uzivatel;
?>

