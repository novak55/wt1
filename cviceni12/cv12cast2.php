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
        Šifrování hesla
    </title>

</head>
<body class="bg-light">
<div class="jumbotron justify-content-md-around text-center">
    <h1>Šifrování hesla</h1>
    <a class="btn btn-info" href="index.php">Zpět na cičení 13</a>
</div>
<div></div>
<div class="row offset-1 col-sm-10"><div>
<?php
    $heslo="novak71";
    $zakodovane = password_hash($heslo,PASSWORD_BCRYPT);
    echo "heslo je: ". $heslo . "<br>";
    echo "heslo je zakodovane sifrou: BCRYPT pomocí funkce: password_hash: ". $zakodovane . "";
?>
</div></div>
<p>&nbsp;</p>
<div class="row bg-dark fixed-bottom">
    <div class="col-sm-12 text-success text-right">Datum vytvoření: 27. 1. 2020  </div>
</div>
</body>
</html>

