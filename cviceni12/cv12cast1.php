<?php
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) &&
    $_SERVER['PHP_AUTH_USER'] == 'test' && $_SERVER['PHP_AUTH_PW'] == 'test') {
    echo '<!DOCTYPE html>
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
Zabezpečení stránek
</title>

</head>
<body class="bg-light">
    <div class="jumbotron justify-content-md-around text-center">
        <h1>Zabezpečení stránek </h1>
        <a class="btn btn-info" href="index.php">Zpět na cičení 13</a>
    </div>
    <div></div>
    <div class="row offset-1 col-sm-10"><div>Přihlášení proběhlo úspěšně!</div></div>
    <p>&nbsp;</p>
    <div class="row bg-dark fixed-bottom">
        <div class="col-sm-12 text-success text-right">Datum vytvoření: 27. 1. 2020  </div>
    </div>
</body>
</html>';
}
else { // chyba prihlaseni
    header('HTTP/1.0 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Login"');
    echo 'Chyba prihlaseni - zadejte platne uzivatelske jmeno a heslo!';
    exit;
}
