<?php
    $stranka = "
    <div class='row offset-1'>
        <div class='col col-sm-9'><h2>Správa kapely</h2></div>
        <div class='col col-sm-2'>
            <a href='index.php' class='btn btn-warning'>Zpět na přehled kapel</a>
        </div>
    </div>
    <p> </p>
    <form action='index.php' method='post'>
        <input type='hidden' name='id' value='" . $data[0]["id"] . "'>
        <div class='row offset-1'>
            <div class='col col-sm-4' >Název kapely*: <input type='text' name='nazev_kapely' value='" . $data[0]["nazev_kapely"] . "' required></div>
            <div class='col col-sm-4'>Rok založení*: <input type='number' min='1900' max='2020' maxlength='4' name='rok_z' value='" . $data[0]["rok_zalozeni"] . "' required></div>
            <div class='col col-sm-4'>Rok ukončení: <input type='number' min='1900' max='2020' maxlength='4' name='rok_u' value='" . $data[0]["rok_ukonceni"] . "'></div>
        </div>
        <p> </p>
        <div class='row offset-1'>
            <div class='col col-sm-4'>Žánr*: <select name='zanr' required><option></option>";
    foreach ($db->getZanr() as $zanr){
        $stranka .= "<option  value='" . $zanr["zanr_id"] . "'";
        if($data[0]['zanr_id'] == $zanr['zanr_id']){ $stranka = 'selected';}
        $stranka .= ">" . $zanr["popis"] . "</option>";
    }
    $stranka .= "</select></div>
            <div class='col col-sm-4'>Město: <input type='text' name='mesto' value='" . $data[0]["mesto"] . "'></div>
            <div class='col col-sm-4'>Stát*: <select name='stat' required><option></option>";
    foreach ($db->getStaty() as $stat){
        $stranka .= "<option value='" . $stat["stat_id"] . "' ";
        if($data[0]['stat_id'] == $stat['stat_id']){ $stranka = 'selected';}
        $stranka .= ">" . $stat["popis"] . "</option>";
    }
    $stranka .= "</select>
            </div>
        </div>
        <p> </p>
        <div class='row text-center'>
            <div class='col-sm-12'>
            <button type='submit' class='btn btn-success'>Odeslat kapelu</button>
            </div>
        </div>
    </form>";