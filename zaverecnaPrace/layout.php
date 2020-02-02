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
        <?=$stranka->getTitulek()?>
    </title>
</head>
<body class="bg-white">
    <ul class="list-group">
        <li class="list-group-item list-group-item-dark"><h2>Závěrečná práce - diskografie</h2></li>
    </ul>

    <div class="alert alert-<?=$alert->getTyp()?> alert-dismissible fade <?=$alert->getZobrazit()?>" role="alert">
        <?=$alert->getText()?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php include_once ($stranka->getObsah()); ?>
    <p>&nbsp</p>
    <div class="row bg-dark fixed-bottom">
        <div class="col-sm-12 text-success text-right">Vytvořil Milan Novák dne: 2. 2. 2020  </div>
    </div>
</body>
</html>

