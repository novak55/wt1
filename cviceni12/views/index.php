<?php
    $stranka = "<div class='row offset-1'>
        <div class='col-sm-6'><form action='?akce=hledej' METHOD='POST'><input type='text' name='vyhledat' value='" . $_POST["vyhledat"] . "' size='20' required> <button type='submit' class='btn btn-success'>Vyhledat</button></form></div>
        <div class='col-sm-2'><a href='' class='btn btn-info' title='Zrušit filtr' target='_blank'>Zrušit filtr</a></div>
        <div class='col-sm-2'><a href='?akce=getPDF' class='btn btn-warning' title='Stáhnout PDF' target='_blank'>Stáhnout PDF</a></div>";
        if($security->getRole() == 'admin'){$stranka .= "<div class='col-sm-2'><a href='?akce=pridatKapelu' class='btn btn-success' title='Přidat kapelu'>+ Kapelu</a></div>";}
    $stranka .= "</div>
    <hr>
    <div class='row offset-1'>
    <div class='col-sm-2'><a href='?podle=kapela&smer=" . $db->getRaditOpacnySmer() . "' title='seřadit'>Název kapely</a></div>
    <div class='col-sm-1'><a href='?podle=zalozeni&smer=" . $db->getRaditOpacnySmer() . "' title='seřadit'>Rok založení</a></div>
    <div class='col-sm-1'><a href='?podle=ukonceni&smer=" . $db->getRaditOpacnySmer() . "' title='seřadit'>Rok ukončení</a></div>
    <div class='col-sm-1'><a href='?podle=zanr&smer=" . $db->getRaditOpacnySmer() . "' title='seřadit'>Žánr</a></div>
    <div class='col-sm-2'><a href='?podle=mesto&smer=" . $db->getRaditOpacnySmer() . "' title='seřadit'>Město</a></div>
    <div class='col-sm-2'><a href='?podle=stat&smer=" . $db->getRaditOpacnySmer() . "' title='seřadit'>Stát</a></div>
    </div>";

$kapely = $db->getKapely();
if(count($kapely) > 0) {
    foreach ($kapely as $row) {
        $stranka .= "<hr>
        <div class='row offset-1 col-sm-10 ";
        if($row['oblibena']){$stranka .= "table-success' title='Tuto kapelu máte oblíbenou";}
            $stranka .= "'><div class='col-sm-2'>" . $row["nazev_kapely"] . "</div>
            <div class='col-sm-1'>" . $row["rok_zalozeni"] . "</div>
            <div class='col-sm-1'>" . $row["rok_ukonceni"] . "</div>
            <div class='col-sm-1'>" . $row["zanr_popis"] . "</div>
            <div class='col-sm-2'>" . $row["mesto"] . "</div>
            <div class='col-sm-2'>" . $row["stat_nazev"] . "</div><div class='col-sm-3'>";
        if ($security->getRole() == 'navstevnik' || $security->getRole()=='admin') {
            if($row['oblibena']){
                $stranka .= "<a class='btn btn-danger' href='?akce=odlibit&idKapely=" . $row["kapela_id"] . "'>Znelíbit</a>";
            }else{
                $stranka .= "<a class='btn btn-success' href='?akce=oblibit&idKapely=" . $row["kapela_id"] . "'>Oblíbit</a>";
            }
        }
        if ($security->getRole() == 'admin') {
            $stranka .= "
                <a class='btn btn-warning' href='?akce=upravitKapelu&idKapely=" . $row["kapela_id"] . "'>upravit</a>
                <a class='btn btn-danger' href='?akce=smazatKapelu&idKapely=" . $row["kapela_id"] . "'>smazat</a>
            ";
        }
        $stranka .= "</div></div>";
    }
}else{
    $stranka .= "<hr><ul class='list-group offset-1 col-sm-10'><li class='list-group-item  list-group-item-danger'>Nebyl nalezen žádný záznam.</li></ul> ";
}