<?php
    session_start();
    include ('database.php');
    $db = new database();

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
            include_once ('views/form.php');
        break;
        case 'upravitKapelu':
            $data = $db->getKapeluById($_GET["idKapely"]);
            include_once ('views/form.php');
        break;
        case 'smazatKapelu':
            $data = $db->delKapeluById($_GET["idKapely"]);
            header('location: index.php?alert=1');
        break;
        case 'getPDF':
            include ('views/pdf.php');
            $pdf = new pdf();
            $pdf->setVykreslitdata($db->getKapelyArray());
            $pdf->rendrujPdf();
        break;
        case 'hledej':
            $db->setVyhledat($_POST["vyhledat"]);
        default:
            include_once ('views/index.php');
    }

    SWITCH ($_GET['alert']){
        case 1:
            $alert['type'] = 'danger';
            $alert['text'] = 'Kapela byla odstraněna.';
        break;
        case 2:
            $alert['type'] = 'success';
            $alert['text'] = 'Údaje o kapele byly uloženy.';
        break;
        default:
            $alert['type'] = null;
            $alert['text'] = null;
    }

include_once 'layout.php';
    
