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
        PHP Formulář
	</title>
</head>
<body class="bg-light">
    <div class="jumbotron justify-content-md-around text-center">
        <h1>PHP Formulář</h1>
        <a class="btn btn-info" href="../index.php">Zpět na rozcestník</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Formulář</h2>
            <form name="formular" method="get" action="index.php">
                <div class="row">
                    <div class="col-sm-5 offset-1 text-md-right text-xs-left">Zadejte číslo od 1 do 31*:</div>
                    <div class="col-sm-5 offset-1"><input name="cislo" type="text"></div>
                </div>
                <div class="row">
                    <div class="offset-1 col-sm-5 text-md-right text-xs-left">Zadejte popis (delší než 10 znaků)*:</div>
                    <div class="offset-1 col-sm-5"><input name="popis" type="text"></div>
                </div>
                <div class="row">
                    <div class="offset-1 col-sm-5 text-md-right text-xs-left">Zadejte SPZ ve tvaru [XYX XXXX]*:</div>
                    <div class="offset-1 col-sm-5"><input name="spz" type="text"></div>
                </div>
                <div class="row">
                    <div class="offset-1 col-sm-5 text-md-right text-xs-left">Zadejte libovolný text*:</div>
                    <div class="offset-1 col-sm-5"><input name="text" type="text"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        Položky označené * jsou povinné.
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-sm-12 text-center"><button type="submit" class="btn btn-success" title="Odesdlat formulář">Odeslat formulář</button></div>
                </div>
            </form>
        </div>
    </div>
    <?php
    if(strlen($_GET["popis"]) > 10
        and preg_match("/^[0-9]*$/", $_GET["cislo"], $match)
        and $_GET["cislo"] >= 1
        and $_GET["cislo"] <=31
        and preg_match("/^[0-9][A-Z][0-9] [0-9]{4}$/", $_GET["spz"], $match)
        and strlen($_GET["text"]) > 0
    ){
        echo '<hr><div class="row"><div class="col-sm-3 offset-1">Bylo zadano číslo: ' . $_GET["cislo"] . ' </div>';
        echo '<div class="col-sm-3 offset-1">Byl zadan popis: ' . $_GET["popis"] . ' </div>';
        echo '<div class="col-sm-3 offset-1">Bylo zadano SPZ: ' . $_GET["spz"] . ' </div></div>';
        echo '<div class="row"><div class="col-sm-11 offset-1">Byl zadan popis: ' . $_GET["text"] . ' </div></div>';
    }
    ?>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <h2>Generování hesla</h2>
            <form name="generujHeslo" method="get" action="index.php">
                <div class="row">
                    <div class="offset-1 col-sm-4 text-right">
                        Zadejte délku hesla:<input type="text" name="delkaHesla" size="10" required>
                    </div>
                    <div class="col-sm-7 text-left"><button type="submit" class="btn btn-success" title="Odesdlat formulář">spočti</button></div>
                </div>
            </form>
            <?php
            include_once ('heslo.php');
            if(is_numeric($_GET["delkaHesla"])){
                $heslo = generujHeslo($_GET["delkaHesla"]);
                echo '<hr><div class="row"><div class="col-sm-12 offset-1">Vaše heslo je: ' . $heslo . '</div></div><hr>';
            }
            ?>
        </div>
    </div>

    <p>&nbsp</p>
    <div class="row bg-dark fixed-bottom">
        <div class="col-sm-12 text-success text-right">Datum vytvoření: 27. 1. 2020  </div>
    </div>
</body>
</html>