<?php
session_start();
include_once 'services/databaseZP.php';
include_once 'services/securityZP.php';
include_once 'services/alertZP.php';
include_once 'services/stranka.php';
$db = new databaseZP();
$security = new securityZP();
$alert = new alertZP();
$stranka = new stranka();
/*
if(($_POST["login"] && $_POST["pwd"])){
    $db->setPassword($_POST["pwd"]);
    $db->setLogin($_POST["login"]);
    if($db->loginUser()){
        $security->setRole();
        $_SESSION['alert'] = 1;
        header('location: ?');
    }else{
        $security->setRole();
        $_SESSION['alert'] = 3;
        header('location: ?');
    }
}
$security->setRole();
$db->setDataKapely();

switch ($_GET["akce"]){
    case 'users':
        $stranka->setTitulek('Seznam uživatelů');
        $stranka->setObsah('seznamUzivatelu');
        break;
    case 'profil':
        $stranka->setTitulek('Váš profil');
        $stranka->setObsah('profil');
        break;
    case 'smazatPisen':
        if($security->getRole() == 'admin'){
            $data = $db->delPisenById($_GET["idPisne"]);
            $_SESSION['alert'] = 13;
            header('location: ?akce=pisen&idAlba='.$_GET['idAlba']);
        }else{
            $_SESSION['alert'] = 7;
            header('location: ?');
        }
        break;
    case 'smazatAlbum':
        if($security->getRole() == 'admin'){
            $data = $db->delAlbumById($_GET["idAlba"]);
            $_SESSION['alert'] = 12;
            header('location: ?akce=alba&id='.$_GET['idKapely']);
        }else{
            $_SESSION['alert'] = 7;
            header('location: ?');
        }
        break;
    case 'pridatPisen':
        $data = $db->getAbumKapelyById($_GET['idAlba']);
        $stranka->setData($data[0]);
        $stranka->setTitulek('Nová píseň alba ' . $stranka->getData()['nazev_alba'] . '<br>kapely ' . $stranka->getData()['nazev_kapely']);
        $stranka->setObsah('spravaPisneForm');
        break;
    case 'upravitPisen':
        $data = $db->getPisenAlbaById($_GET['idPisne']);
        $stranka->setData($data[0]);
        $stranka->setTitulek('Úprava písně v albu ' . $stranka->getData()['nazev_alba'] . ' kapely ' . $stranka->getData()['nazev_kapely']);
        $stranka->setObsah('spravaPisneForm');
        break;
    case 'pisen':
        if($_POST['nazev_pisne'] && $_POST['delka'] && $_POST['poradi'] ){
            if($security->getRole()=='admin') {
                $db->setPisenAlbaKapely();
                $_SESSION['alert'] = 11;
                $url = 'location: ?akce=pisen&idAlba=' . $_POST['id_alba'];
                header($url);
            }else{
                $_SESSION['alert'] = 7;
            }
        }
        $data = $db->getAbumKapelyById($_GET['idAlba']);
        $stranka->setData($data[0]);
        $stranka->setTitulek('Seznam písní alba ' . $stranka->getData()['nazev_alba'] . '<br> kapely '. $stranka->getData()['nazev_kapely']);
        $stranka->setObsah('pisen');
        break;
    case 'pridatAlbum':
        $stranka->setData($db->getKapeluById($_GET['idKapely'])[0]);
        $stranka->setTitulek('Nové album kapely ' . $stranka->getData()['nazev_kapely']);
        $stranka->setObsah('spravaAlbaForm');
        break;
    case 'upravitAlbum':
        $data = $db->getAbumKapelyById($_GET['idAlba']);
        $stranka->setData($data[0]);
        $stranka->setTitulek('Úprava alba ' . $stranka->getData()['nazev_alba'] . ' kapely ' . $stranka->getData()['nazev_kapely']);
        $stranka->setObsah('spravaAlbaForm');
        break;
    case 'alba':
        if($_POST['nazev_alba'] && is_numeric($_POST['rok_v'])){
            if($security->getRole()=='admin') {
                $db->setAlbumKapely();
                $_SESSION['alert'] = 10;
                header('location: ?akce=alba&id=' . $_GET['id']);
            }else{
                $_SESSION['alert'] = 7;
            }
        }
        $stranka->setData($db->getKapeluById($_GET['id'])[0]);
        $stranka->setTitulek('Seznam alb kapely '. $stranka->getData()['nazev_kapely']);
        $stranka->setObsah('alba');
        break;
    case 'oblibeneKapely':
        $stranka->setTitulek('Oblíbené kapely');
        $db->setOblibene(true);
        $stranka->setObsah('default');
        break;
    case 'upravitKapelu':
        if($security->getRole() == 'admin'){
            $stranka->setTitulek('Upravit kapelu');
            $data = $db->getKapeluById($_GET["idKapely"]);
            $stranka->setObsah('spravaKapely');
        }else{
            $_SESSION['alert'] = 7;
            header('location: ?');
        }
        break;
    case 'smazatKapelu':
        if($security->getRole() == 'admin'){
            $data = $db->delKapeluById($_GET["idKapely"]);
            $_SESSION['alert'] = 8;
            header('location: ?');
        }else{
            $_SESSION['alert'] = 7;
            header('location: ?');
        }
        break;
    case 'pridatKapelu':
        $stranka->setTitulek('Přidat kapelu');
        $stranka->setObsah('spravaKapely');
        break;
    case 'getPDF':
        include ('services/pdfZP.php');
        $pdf = new pdfZP();
        $pdf->setVykreslitdata($db->getKapelyArray());
        $pdf->rendrujPdf();
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();
        session_start();
        $_SESSION['alert'] = 2;
        header('location: ?');
        break;
    case 'oblibit':
        $db->setOblibit();
        $_SESSION['alert'] = 4;
        header('location: ?');
        break;
    case 'odlibit':
        $db->setOdlibit();
        $_SESSION['alert'] = 5;
        header('location: ?');
        break;
    case 'hledej':
        $db->setVyhledat($_POST["vyhledat"]);
        $stranka->setTitulek('Vyhledávání kapel');
        $stranka->setObsah('default');
        break;
    default:
        $stranka->setTitulek('Přehled kapel');
        $stranka->setObsah('default');
}
*/
//include_once 'layout.php';
echo "test";
print_r($db->getZanr());