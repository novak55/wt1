<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta name="HandheldFriendly" content="True">
	<meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <title>
        Klikací mapa - Obrázky - Formulář
	</title>
</head>
<body class="bg-light">
    <div class="jumbotron justify-content-md-around text-center">
        <h1>Klikací mapa - Obrázky - Formulář</h1>
        <a class="btn btn-info" href="../index.php">Zpět na rozcestník</a>
    </div>
    <div class="col-sm-12">
        <h2>Klikací mapa</h2>
        <div class="text-center">
            <img style="z-index: 1;" src="obr/Mapa.png" width="1047" height="762" alt="Planets" usemap="#mapa">
            <map name="mapa" style="z-index: 10">
                <area shape="poly" coords="227,462,298,520,151,713,76,656" href="vodni-nadrz.htm" title="Vodní nádrž" alt="Vodní nádrž">
                <area shape="poly" coords="590,281,604,309,574,321,572,315,558,320,554,306,566,299,564,290" href="kaple.htm" alt="Kaple" title="kaple">
                <area shape="poly" coords="605,494,626,553,654,541,763,740,725,760,641,617,589,632,546,513" href="dum.htm" alt="Dům" title="Dům">
            </map>
        </div>
        <h2>Savci</h2>
        <div class="col-sm-12 text-center">
        <table class="col-sm-12">
            <tr>
                <td class="text-center"><a href="klokan.htm"><img src="obr/klokan.png" alt="Klokan"></a></td>
                <td class="text-center"><a href="kalon.htm"><img src="obr/klon.png" alt="Kaloň"></a></td>
            </tr>
            <tr>
                <td class="text-center"><a href="klokan.htm">Klokan</a></td>
                <td class="text-center"><a href="kalon.htm">Kaloň</a></td>
            </tr>
            <tr>
                <td class="text-center"><a href="slon.htm"><img src="obr/slon.png" alt="Slon"></a></td>
                <td class="text-center"><a href="zirafa.htm"><img src="obr/zirafa.png" alt="Žirafa"></a></td>
            </tr>
            <tr>
                <td class="text-center"><a href="slon.htm">Slon</a></td>
                <td class="text-center"><a href="zirafa.htm">Žirafa</a></td>
            </tr>
        </table>
        </div>
    </div>
    <div class="col-sm-12">
        <h2>Formulář</h2>
        <?php
            if(strlen($_GET["popis"]) >10 and $_GET["cislo"] >= 5 and $_GET["cislo"] <= 10 and $_GET["datum"] !== null){
                echo '<hr><div class="row"><div class="col-sm-2 offset-1">Bylo zadano číslo: ' . $_GET["cislo"] . ' </div>';
                echo '<div class="col-sm-5 offset-1">Byl zadan popis: ' . $_GET["popis"] . ' </div>';
                echo '<div class="col-sm-2 offset-1">Byl zadan datum: ' . $_GET["datum"] . ' </div></div><hr>';
            }
        ?>
        <form name="formular" method="get" action="index.php">
            <div class="row">
                <div class="col-sm-3 offset-1 text-center">Zadejte číslo od 5 do 10*:<br> <input name="cislo" type="number" min="5" max="10" required></div>
                <div class="col-sm-4 text-center">Zadejte popis (delší než 10 znaků)*:<br> <input name="popis" type="text" minlength="10" size="40" required></div>
                <div class="col-sm-3 text-center">Zvolte datum*:<br> <input name="datum" type="date" required></div>
            </div>
            <div class="row">
                <div class="col-sm-3 offset-1">
                Položky označené * jsou povinné.
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center"><button type="submit" class="btn btn-success" title="Odesdlat formulář">Odeslat formulář</button></div>
            </div>
        </form>
        <p>&nbsp;</p>
    </div>
    <div class="row bg-dark">
        <div class="col-sm-12 text-success text-right">Datum vytvoření: 27. 1. 2020  </div>
    </div>
</body>
</html>