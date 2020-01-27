<?php
//    mt_srand((double)microtime()*1000000);
    function generujHeslo($delka){
        $znakovaSada='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $heslo='';
        while(strlen($heslo) < $delka) {
            $heslo .= substr($znakovaSada, rand(0, strlen($znakovaSada)-1), 1);
        }
        return($heslo);
    }
    