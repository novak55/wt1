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
                <? if($security->getRole() == 'admin'):?>
                <li class="nav-item">
                    <a class="nav-link" href="?akce=pridatKapelu">Přidat kapelu</a>
                </li>
                <? endif;?>
                <? if($security->isAuthenticated()):?>
                    <li class="nav-item">
                        <a class="nav-link" href="?akce=oblibeneKapely">Oblíbené kapely</a>
                    </li>
                <? endif;?>
                <li class="nav-item">
                    <a class="nav-link" href="?akce=getPDF" title="Stáhnout PDF se seznamem kapel." target="pdf">PDF</a>
                </li>
            </ul>
            <div id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown list-group">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <? if($security->isAuthenticated()):?>
                            <?= $security->getUsername();?>
                            <? else:?>
                            Přihlášení
                            <? endif;?>
                        </a>
                        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdownMenuLink">
                    <?php if($security->isAuthenticated() == false):?>

                        <form class="dropdown-item form-inline my-2 my-lg-0" method="post" onsubmit="return zabezpecit();">
                            <input class="form-control mr-sm-2" type="text" name="login" placeholder="login" aria-label="login" title="admin:Admin, milan:Novak"><br>
                            <input class="form-control mr-sm-2" type="password" name="password" placeholder="heslo" aria-label="login"><br>
                            <button class="list-group-item list-group-item-action list-group-item-success my-2 my-sm-0" type="submit">Přihlásit</button>
                            <div id='casch'>
                                <input type='hidden' name='cas' id='cas' value='<?=$_SESSION["casSifrovani"]?>'>
                            </div>
                        </form>
                        <script src="../js/sha256.js"></script>
                        <script src="../js/security.js"></script>

                    <? else: ?>
                            <a class="dropdown-item list-group-item list-group-item-action list-group-item-danger" href="?akce=logout">Odhlásit</a>
                            <a class="dropdown-item list-group-item list-group-item-action list-group-item-dark" href="?akce=profil">Zobrazit profil</a>
                        <? if($security->getRole()=='admin'):?>
                            <a class="dropdown-item list-group-item list-group-item-action list-group-item-dark" href="?akce=users">Seznam uživatelů</a>
                        <?endif;?>
                    <? endif;?>
                        </div>
                    </li>
                </ul>
            </div>
    
            <form class="form-inline my-2 my-lg-0" action="?akce=hledej" method="post">
                <input class="form-control mr-sm-2" type="search" placeholder="Hledat všude" name="vyhledat" aria-label="Search" value="<?=$_POST["vyhledat"]?>" required>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Hledat</button>
                <a class="btn btn-outline-info" href="?" title="Zrušit hledání">Zruš</a>
            </form>
        </div>
    </nav>
    <div class="alert alert-<?=$alert->getTyp()?> alert-dismissible fade <?=$alert->getZobrazit()?>" role="alert">
        <?=$alert->getText()?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?// include_once ($stranka->getObsah()); ?>
    <p>&nbsp</p>
    <div class="row bg-dark fixed-bottom">
        <div class="col-sm-12 text-success text-right">Vytvořil Milan Novák dne: 2. 2. 2020  </div>
    </div>
</body>
</html>

