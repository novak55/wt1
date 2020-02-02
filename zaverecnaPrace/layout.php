<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="css/my.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <title>
        <?= $stranka->getTitulek()?>
    </title>
</head>
<body class="bg-white">
    <ul class="list-group">
        <li class="list-group-item list-group-item-dark"><h2>Závěrečná práce - diskografie</h2></li>
    </ul>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="../index.php" title="Zpět na seznam projektů">Zpět</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="?">Seznam kapel</a>
                </li>
            </ul>
    
            <form class="form-inline my-2 my-lg-0" action="?akce=hledej" method="post">
                <input class="form-control mr-sm-2" type="search" placeholder="Hledat všude" name="vyhledat" aria-label="Search" value="<?=$_POST["vyhledat"]?>" required>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Hledat</button>
                <a class="btn btn-outline-info" href="?" title="Zrušit hledání">Zruš</a>
            </form>
        </div>
    </nav>
    <?php include_once ($stranka->getObsah()); ?>
    <p>&nbsp</p>
    <div class="row bg-dark fixed-bottom">
        <div class="col-sm-12 text-success text-right">Vytvořil Milan Novák dne: 2. 2. 2020  </div>
    </div>
</body>
</html>

