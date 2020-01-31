<?php
class loginForm{
    private $stav;
    private $userName;
    
    public function __construct()
    {
    }
    
    public function getLogin(){
        return "
<form action='index.php' METHOD='post'  onsubmit='return zabezpecit();'>
    <div class='row offset-1'>
        <div class='col-sm-4'>
            Můžete se přihlásit do systému:
        </div>
        <div class='col-sm-3'>
            jméno: <input type='text' size='20' name='login' >
        </div>
        <div class='col-sm-3'>
            heslo: <input type='password' size='20' name='password'  title='Vaše heslo se neodesílá jako prostý text!'>
        </div>
        <div class='col-sm-2'>
            <button type='submit' class='btn btn-success'>Přihlásit</button>
        </div>
        <div id='casch'>
        <input type='hidden' name='cas' id='cas' value='" . $_SESSION["casSifrovani"] . "'>
        </div>
    </div>
</form>
<script src='../js/sha256.js'></script>
<script src='../js/security.js'></script>
        ";
    }
    
    public function getLogout(){
        return "
    <div class='row offset-1'>
        <div class='col-sm-10 text-sm-right'>Přihlášený uživatel: " . $this->userName . "</div>
        <div class='col-sm-2'><a href='?akce=logout' class='btn btn-danger'>Odhlásit</a></div>
    </div>
        ";
    }
    
    public function getForm()
    {
        if($this->stav){
            return $this->getLogin();
        }else{
            return $this->getLogout();
        }
    }
    
    public function setStav($stav)
    {
        $this->stav = $stav;
    }
    
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    
    
}
