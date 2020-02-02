<?php

class securityZP
{
    private $role;
    private $username;
    private $userId;
    private $userLogin;
    private $authenticated;

    CONST NEPRIHLASENY_USER = 'annonymous';

    public function __construct()
    {
        $this->role = self::NEPRIHLASENY_USER;
    }
    
    public function isAuthenticated()
    {
        return $this->authenticated;
    }
    
    public function setRole()
    {
        if(isset($_SESSION['ROLE'])){
            $this->setCredentials();
        }else{
            $_SESSION["casSifrovani"] =  time();
            $this->authenticated = false;
        }
    }
    
    private function setCredentials()
    {
        $this->username = $_SESSION["USER_NAME"];
        $this->role = $_SESSION['ROLE'];
        $this->userId = $_SESSION['USER_ID'];
        $this->userLogin = $_SESSION['USER_LOGIN'];
        $this->authenticated = true;
    }
    
    public function getRole()
    {
        return $this->role;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }
    
    public function getUserLogin()
    {
        return $this->userLogin;
    }
    
    
}