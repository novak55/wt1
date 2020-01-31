<?php

class security
{
    private $role;
    
    CONST NEPRIHLASENY_USER = 'annonymous';

    public function __construct()
    {
        $this->role = self::NEPRIHLASENY_USER;
    }
    
    public function getRole()
    {
        return $this->role;
    }
    
    public function setRole()
    {
        if(isset($_SESSION['ROLE'])){
            $this->role = $_SESSION['ROLE'];
        }else{
            $_SESSION["casSifrovani"] =  time();
        }
    }
    
    public function getLoginFom()
    {
        if($this->role === self::NEPRIHLASENY_USER){
            return true;
        }else{
            return false;
        }
    }
 }