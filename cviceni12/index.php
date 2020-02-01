<?php
    session_start();
    include ('database2.php');
    include ('security.php');
    include_once 'views/loginForm.php';
    $db = new database2();
    $security = new security();
    $form = new loginForm();

    $alerts = $_GET["alert"];

    if($_POST["login"] and $_POST["pwd"]) {
        $db->setPassword($_POST["pwd"]);
        $db->setLogin($_POST["login"]);
        if($db->loginUser()){
            $security->setRole();
            header('location: index.php?alert=5');
        }else{
            $security->setRole();
            header('location: index.php?alert=6');
        }
    }
    
    $security->setRole();
    $form->setStav($security->getLoginFom());
    $form->setUserName($db->getUserName());
    
    SWITCH ($_GET['podle']){
        case 'zalozeni': $db->setRaditPodle('rok_zalozeni'); break;
        case 'ukonceni': $db->setRaditPodle('rok_ukonceni'); break;
        case 'zanr': $db->setRaditPodle('z.popis'); break;
        case 'mesto': $db->setRaditPodle('mesto'); break;
        case 'stat': $db->setRaditPodle('s.nazev'); break;
        default: $db->setRaditPodle('nazev_kapely');
    }

    if($_POST['nazev_kapely'] !== null
        && $_POST['rok_z'] >= 1900
        && $_POST['rok_z'] <= date('Y')
        && $_POST['zanr'] !== null
        && $_POST['stat'] !== null
    ){
        $db->setRokZ($_POST['rok_z']);
        $db->setRokU($_POST['rok_u']);
        $db->setNazevKapely($_POST['nazev_kapely']);
        $db->setZanr($_POST['zanr']);
        $db->setMesto($_POST['mesto']);
        $db->setStat($_POST['stat']);
        $db->setIdKapely($_POST['id']);
        $db->ulozitKapelu();
        header('location: index.php?alert=2');
    }
    switch ($_GET['akce'])
    {
        case 'pridatKapelu':
            if($security->getRole() == 'admin'){
                include_once ('views/form.php');
            }else{
                header('location: index.php?alert=4');
            }
        break;
        case 'upravitKapelu':
            if($security->getRole() == 'admin'){
                $data = $db->getKapeluById($_GET["idKapely"]);
                include_once ('views/form.php');
            }else{
                header('location: index.php?alert=4');
            }
        break;
        case 'smazatKapelu':
            if($security->getRole() == 'admin'){
                $data = $db->delKapeluById($_GET["idKapely"]);
                header('location: index.php?alert=1');
            }else{
                header('location: index.php?alert=4');
            }
        break;
        case 'getPDF':
            include ('views/pdf.php');
            $pdf = new pdf();
            $pdf->setVykreslitdata($db->getKapelyArray());
            $pdf->rendrujPdf();
        break;
        case 'logout':
            $_SESSION = array();
            session_destroy();
            header('location: index.php?alert=3');
        break;
        case 'oblibit':
            $db->setOblibit();
            header('location: index.php?alert=7');
            break;
        case 'odlibit':
            $db->setOdlibit();
            header('location: index.php?alert=8');
            break;
        case 'hledej':
            $db->setVyhledat($_POST["vyhledat"]);
        default:
            require_once ('views/index.php');
    }

    SWITCH ($alerts){
        case 1:
            $alert['type'] = 'danger';
            $alert['text'] = 'Kapela byla odstraněna.';
        break;
        case 2:
            $alert['type'] = 'success';
            $alert['text'] = 'Údaje o kapele byly uloženy.';
        break;
        case 3:
            $alert['type'] = 'success';
            $alert['text'] = 'Odhlášení proběhlo úspěšně.';
        break;
        case 4:
            $alert['type'] = 'danger';
            $alert['text'] = 'Nemáte dostatečná oprávnění pro tuto činnost.';
        break;
        case 5:
            $alert['type'] = 'success';
            $alert['text'] = 'Přihlášení proběhlo úspěšně.';
        break;
        case 6:
            $alert['type'] = 'danger';
            $alert['text'] = 'Tento pokus o přihlášení nebul úspěšný!';
        break;
        case 7:
            $alert['type'] = 'success';
            $alert['text'] = 'Kapela byla přidána do oblíbených!';
        break;
        case 7:
            $alert['type'] = 'warning';
            $alert['text'] = 'Kapela byla odebrána z oblíbených!';
        break;
        default:
            $alert['type'] = null;
            $alert['text'] = null;
    }

include_once 'layout.php';

