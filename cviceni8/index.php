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
        PHP Formulář - překladač
	</title>
</head>
<body class="bg-light">
    <div class="jumbotron justify-content-md-around text-center">
        <h1>PHP Formulář - překladač</h1>
        <a class="btn btn-info" href="../index.php">Zpět na rozcestník</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Překladač</h2>
            <?php
            $slovnik = ['ring' => 'kruh', 'summer' => 'léto', 'turtle' => 'želva', 'motorcycle' => 'motocykl', 'town' => 'město'];
            ?>
            <form name="prekladac" method="get" action="index.php">
                <div class="row">
                    <div class="offset-1 col-sm-2 text-right">
                        <select name="preloz">
                            <?php
                            foreach($slovnik as $key => $val){
                                echo "<option>" . $key . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-7 text-left"><button type="submit" class="btn btn-success" title="Odesdlat formulář">Přeložit</button></div>
                </div>
            </form>
            <?php
            if(strlen($_GET["preloz"]) > 0){
                echo '<hr><div class="row"><div class="col-sm-3 offset-1">Bylo zadano anglické slovo: ' . $_GET["preloz"] . ' </div>';
                echo '<div class="col-sm-3 offset-1">Český překlad: ' . $slovnik[$_GET["preloz"]] . '</div></div><hr>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Výpočet obvodu kruhu</h2>
            <form name="obvodKruhu" method="get" action="index.php">
                <div class="row">
                    <div class="offset-1 col-sm-2 text-right">
                        Zadejte poloměr kruhu:<input type="text" name="spocti" size="10" required>
                    </div>
                    <div class="col-sm-7 text-left"><br><button type="submit" class="btn btn-success" title="Odesdlat formulář">spočti</button></div>
                </div>
            </form>
            <?php
            if(is_numeric($_GET["spocti"])){
                $obvod = round(2*pi()*$_GET["spocti"]*100)/100;
                echo '<hr><div class="row"><div class="col-sm-12 offset-1">Kruh s poloměrem: ' . $_GET["spocti"] . ' má obvod: ' . $obvod . '</div></div><hr>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Výpočet ceny jízdného</h2>
            <form name="obvodKruhu" method="get" action="index.php">
                <div class="row">
                    <div class="offset-1 col-sm-2 text-right">
                        Zadejte vzdálenost v km:<input type="number" name="vzdalenost" required>
                    </div>
                    <div class="col-sm-7 text-left"><br><button type="submit" class="btn btn-success" title="Odesdlat formulář">spočti</button></div>
                </div>
            </form>
            <?php
            if(is_numeric($_GET["vzdalenost"])){
                $cena = 0;
                if($_GET["vzdalenost"] > 20){
                    $cena = 'nelze určit ';
                }elseif($_GET["vzdalenost"] > 10){
                    $cena = 15;
                }elseif ($_GET["vzdalenost"] > 5){
                    $cena = 10;
                }elseif ($_GET["vzdalenost"] > 2){
                    $cena = 6;
                }else{
                    $cena = 4;
                }
                echo '<hr><div class="row"><div class="col-sm-12 offset-1">Cena jízdného pro vzdálenost ' . $_GET["vzdalenost"] . 'km je ' . $cena . 'Kč</div></div><hr>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>IP adresa serveru</h2>
            <div class="row">
                <div class="offset-1 col-sm-2 text-right">
                    <?php echo $_SERVER['REMOTE_ADDR'];?>
                </div>
            </div>
        </div>
    </div>
    <p>&nbsp</p>
    <div class="row bg-dark fixed-bottom">
        <div class="col-sm-12 text-success text-right">Datum vytvoření: 27. 1. 2020  </div>
    </div>
</body>
</html>