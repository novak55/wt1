<?php

class alertZP
{
    private $alerty = [];
    private $zobrazit;
    private $typ;
    private $text;
    
    public function __construct()
    {
        $this->loadAlerty();
        if($_SESSION['alert']){
            $this->typ = $this->alerty[$_SESSION['alert']]["typ"];
            $this->text = $this->alerty[$_SESSION['alert']]["text"];
            $this->zobrazit = 'show';
            $_SESSION['alert'] = null;
        }else{
            $this->typ = null;
            $this->text = null;
            $this->zobrazit = 'none';
        }
    }
    
    private function loadAlerty(){
        $this->setAlerty('success', 'Přihlášení proběhlo úspěšně', 1);
        $this->setAlerty('warning', 'Odhlášení proběhlo úspěšně', 2);
        $this->setAlerty('danger', 'Nepodařilo se Vás úspěšně ověřit. Vaše přihlašovací údaje nebyly správné.', 3);
        $this->setAlerty('success', 'Kapela byla přidána do oblíbených!', 4);
        $this->setAlerty('warning', 'Kapela byla odebrána z oblíbených!', 5);
        $this->setAlerty('warning', 'Údaje o kapele byly uloženy.', 6);
        $this->setAlerty('danger', 'Nemáte dostatečná oprávnění pro tuto činnost.', 7);
        $this->setAlerty('warning', 'Kapela byla odstraněna.', 8);
        $this->setAlerty('danger', 'Ops ... Jejda ... něco se nepovedlo! Stránka na kterou jste chtěli přistoupit zřejmě neexistuje.', 9);
        $this->setAlerty('success', 'Údaje o albu byly uloženy.', 10);
        $this->setAlerty('success', 'Údaje o písni byly do alba vloženy.', 11);
        $this->setAlerty('warning', 'Album bylo úspěšně odsteněno.', 12);
        $this->setAlerty('warning', 'Píseň byla úspěšně odsteněna.', 13);
    }
    
    private function setAlerty($typ, $text, $index = null)
    {
        $this->alerty[$index]["typ"] = $typ;
        $this->alerty[$index]["text"] = $text;
    }
    
    public function getZobrazit()
    {
        return $this->zobrazit;
    }
    
    public function getTyp()
    {
        return $this->typ;
    }
    
    public function getText()
    {
        return $this->text;
    }
    
}