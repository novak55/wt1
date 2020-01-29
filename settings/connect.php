<?php
function connectToDb(){
    $servername = "localhost";
    //$username = "smrcka";
    //$password = "heslo";
    //$dbname = "smrcka";
    //$spojeni = mysqli_connect($servername, $username, $password, $dbname);
    // mysqli_set_charset($spojeni, "utf8");
    try {
        $postgres = new PDO('pgsql:host=' . $servername . ';port=5432; dbname=postgres');
    }catch (Exception $exception){
        exit ('Nelze se připojit k DB');
    }
    $postgres->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $postgres->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $postgres;
}