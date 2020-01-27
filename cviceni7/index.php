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
    <script>
        function kontrolaFormulare(){
            odeslat = true;
            errorText = {den:'', popis:'', spz:'',text:''};
            
            den = $('input[name="cislo"]');
            popis = $('input[name="popis"]');
            spz = $('input[name="spz"]');
            text = $('input[name="text"]');
            
            var regNumber = "^[0-9]*$";
            var regSpz = "^[0-9][A-Z][0-9] [0-9]{4}$";

            if (!den.val().match(regNumber) || den.val() < 1 || den.val() > 31) {
                den.css("border","1px solid red");
                odeslat = false;
                errorText.den = "Číslo musí být mezi 1 a 31\n";
            }else { den.css("border","1px solid black"); }
            
            if (popis.val().length <= 10){
                popis.css("border","1px solid red");
                odeslat = false;
                errorText.popis = "Popis musí mít více než 10 znaků\n";
            }else { popis.css("border","1px solid black"); }
            
            if (!spz.val().match(regSpz)){
                spz.css("border","1px solid red");
                odeslat = false;
                errorText.spz = "Tvar musí být XYX XXXX\n";
            }else { spz.css("border","1px solid black"); }

            if (text.val().length < 1){
                text.css("border","1px solid red");
                odeslat = false;
                errorText.text = "Text musí mít alespoň jeden znak";
            }else { text.css("border","1px solid black"); }

            
            if(!odeslat){
                alert(errorText.den+errorText.popis+errorText.spz+errorText.text);
            }
            action = 'mailto:milan.novak@vspj.cz&subject='+popis.val()+'&body=Dobrý den, Vaše SPZ: '+spz.val()+', zvolený den: '+den.val()+', zpráva: '+text.val();
            $('form').attr('action', action);
            return odeslat;
        }
    </script>
    <div class="jumbotron justify-content-md-around text-center">
        <h1>PHP Formulář</h1>
        <a class="btn btn-info" href="../index.php">Zpět na rozcestník</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Formulář</h2>
            <?php
            if(strlen($_GET["popis"]) >10 and $_GET["cislo"] >= 5 and $_GET["cislo"] <= 10 and $_GET["datum"] !== null){
                echo '<hr><div class="row"><div class="col-sm-2 offset-1">Bylo zadano číslo: ' . $_GET["cislo"] . ' </div>';
                echo '<div class="col-sm-5 offset-1">Byl zadan popis: ' . $_GET["popis"] . ' </div>';
                echo '<div class="col-sm-2 offset-1">Byl zadan datum: ' . $_GET["datum"] . ' </div></div><hr>';
            }
            ?>
            <form name="formular" method="get" onsubmit="return kontrolaFormulare();">
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
    <p>&nbsp</p>
    <div class="row bg-dark fixed-bottom">
        <div class="col-sm-12 text-success text-right">Datum vytvoření: 26. 1. 2020  </div>
    </div>
<script>
    $('.carousel').carousel()
</script>

</body>
</html>