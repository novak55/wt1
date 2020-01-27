<?php
    include_once ('../settings/connect.php');
?>
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
        Připojení k databázi a výpis tabulek
	</title>
</head>
<body class="bg-light">
    <div class="jumbotron justify-content-md-around text-center">
        <h1>Připojení k databázi a výpis tabulek / Diskografie kapel</h1>
        <a class="btn btn-info" href="../index.php">Zpět na rozcestník</a>
    </div>
    <div class='row offset-1 table table-striped'>
        <div class='col-sm-3'><a href="#" title="seřadit">Název kapely</a></div>
        <div class='col-sm-3'><a href="#" title="seřadit">Datum založení</a></div>
        <div class='col-sm-3'><a href="#" title="seřadit">Město</a></div>
        <div class='col-sm-1'><a href="#" title="seřadit">Stát</a></div>
        <div class='col-sm-1'>Akce</div>
    </div>
    <?php
        $stmt = $postgres->prepare("SELECT nazev_kapely, to_char(datum_zalozeni,'DD.MM.YYYY') as datum_zalozeni, mesto, stat FROM kapely");
        $stmt->execute();
        foreach ($stmt->fetchAll() as $row)
        {
            echo "<div class='row offset-1 table table-striped'>
                <div class='col-sm-3'>" . $row["nazev_kapely"] . "</div>
                <div class='col-sm-3'>" . $row["datum_zalozeni"] . "</div>
                <div class='col-sm-3'>" . $row["mesto"] . "</div>
                <div class='col-sm-1'>" . $row["stat"] . "</div>
                <div class='col-sm-1'><a href='#'>upravit</a></div>
                </div>";
        }
    ?>
    <p>&nbsp</p>
    <div class="row bg-dark fixed-bottom">
        <div class="col-sm-12 text-success text-right">Datum vytvoření: 27. 1. 2020  </div>
    </div>
</body>
</html>