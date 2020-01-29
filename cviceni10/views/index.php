<?php
    $stranka = "<div class='row offset-1'>
    <div class='col-sm-2'><a href='#' title='seřadit'>Název kapely</a></div>
    <div class='col-sm-2'><a href='#' title='seřadit'>Rok založení</a></div>
    <div class='col-sm-2'><a href='#' title='seřadit'>Rok ukončení</a></div>
    <div class='col-sm-1'><a href='#' title='seřadit'>Žánr</a></div>
    <div class='col-sm-2'><a href='#' title='seřadit'>Město</a></div>
    <div class='col-sm-1'><a href='#' title='seřadit'>Stát</a></div>
    <div class='col-sm-1'><a href='index.php?akce=pridatKapelu' class='btn btn-success' title='Přidat kapelu'>Přidat kapelu</a></div>
    </div>";

/*    foreach ($db->getSkupiny() as $row)
    {
  */      $stranka .= "<hr><div class='row offset-1'>
        <div class='col-sm-2'>" . $row["nazev_kapely"] . "</div>
        <div class='col-sm-2'>" . $row["rok_zalozeni"] . "</div>
        <div class='col-sm-2'>" . $row["rok_ukonceni"] . "</div>
        <div class='col-sm-1'>" . $row["zanr"] . "</div>
        <div class='col-sm-2'>" . $row["mesto"] . "</div>
        <div class='col-sm-1'>" . $row["stat"] . "</div>
        <div class='col-sm-1'>
            <a class='btn btn-warning' href='?akce=upravitKapelu&idKapely=" . $row["id"] . "'>upravit</a>
            <a class='btn btn-danger' href='?akce=smazatKapelu&idKapely=" . $row["id"] . "'>smazat</a>
        </div>
        </div>";
//    }