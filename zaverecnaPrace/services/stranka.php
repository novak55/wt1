<?php

class stranka
{
    private $titulek;
    private $obsah;
    private $data = [];
    
    public function __construct()
    {
        $this->titulek = 'Discografie kapel';
    }
    
    public function getTitulek()
    {
        return $this->titulek;
    }
    
    public function setTitulek($titulek)
    {
        $this->titulek = $titulek;
    }
    
    public function getObsah()
    {
        return $this->obsah;
    }
    
    public function setObsah($obsah)
    {
        $zarazeni = 'views';
        if(strpos($obsah, 'Form')) $zarazeni = forms;
        $this->obsah = $zarazeni . '/' . $obsah . '.php';
    }

    public function getData()
    {
        return $this->data;
    }
    
    public function setData($data)
    {
        $this->data = $data;
    }
    
}