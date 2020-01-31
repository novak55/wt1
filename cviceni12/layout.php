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
        Připojení k databázi, výpis tabulek a zabezpečení
    </title>
</head>
<body class="bg-light">
<div class="jumbotron justify-content-md-around text-center">
    <h1>Připojení k databázi, výpis tabulek a zabezpečení</h1>
    <a class="btn btn-info" href="../index.php">Zpět na rozcestník</a>
</div>
<div class="offset-1 col-sm-10 alert alert-<?php echo $alert['type'];?> alert-dismissible fade <?php echo $alert['type'] != null ? 'show':'none'; ?>" role="alert">
    <?php echo $alert['text'];?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<hr>
<?php echo $form->getForm();?>
<hr>
<?php echo $stranka;?>
<p>&nbsp</p>
<div class="row bg-dark fixed-bottom">
    <div class="col-sm-12 text-success text-right">Datum vytvoření: 27. 1. 2020  </div>
</div>
<?php print_r($_SESSION); ?>
</body>
</html>