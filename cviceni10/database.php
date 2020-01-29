<?php
class database{
    
    private $connector;
    private $sql;
    private $params;
    private $idKapely;
    private $nazevKapely;
    private $rokZ;
    private $rokU;
    private $zanr;
    private $mesto;
    private $stat;
    private $raditPodle;
    private $raditSmer;
    
    
    public function __construct()
    {
        include '../settings/connect.php';
        $this->connector = connectToDb();
        $this->raditPodle = 'nazev_kapely';
        $this->raditSmer = 'ASC';
    }

    private function getData(){
        $stmt = $this->connector->prepare($this->sql);
        return[];
        $stmt->execute($this->params);
        return $stmt->fetchAll();
    }
    
    private function setSql($sql, $params = null){
        $this->sql = $sql;
        $this->params = $params;
        return $this->getData();
    }
    
    function getSkupiny(){
        return $this->setSql("SELECT id, nazev_kapely,
                    rok_zalozeni,
                    rok_ukonceni,
                    zanr,
                    mesto,
                    stat
                    FROM kapely
                    ORDER BY " . $this->raditPodle . " " . $this->raditSmer);
    }
    
    public function pridatKapelu()
    {
        $promene = ":nazev,:zalozeno,null,:zanr,:mesto,:stat";
        $params = [
            'nazev' => $this->nazevKapely,
            'zalozeno' => $this->rokZ,
            'zanr' => $this->zanr,
            'mesto' => $this->mesto,
            'stat' => $this->stat,
        ];
    
        if($this->rokU != null) {
            $promene = ":nazev,:zalozeno,:ukonceno,:zanr,:mesto,:stat";
            $params['ukonceno'] = $this->rokU;
        }


        $sql = "Insert into kapely VALUES (default," . $promene . ")";

        if($this->idKapely !== null){
            $params['idKapely'] = $this->idKapely;
            $sql = "Insert into kapely VALUES (:idKapely," . $promene . ")";
        }
        $this->setSql($sql, $params);
    }
    public function getKapeluById($idKapely)
    {
        return $this->setSql("SELECT * FROM kapely WHERE id = :idKapely", ['idKapely' => $idKapely]);
    }

    public function delKapeluById($idKapely)
    {
        $this->setSql("DELETE FROM kapely WHERE id = :idKapely", ['idKapely' => $idKapely]);
    }
    
    /**
     * @param mixed $idKapely
     */
    public function setIdKapely($idKapely)
    {
        $this->idKapely = $idKapely;
    }
    
    /**
     * @param mixed $nazevKapely
     */
    public function setNazevKapely($nazevKapely)
    {
        $this->nazevKapely = $nazevKapely;
    }
    
    /**
     * @param mixed $rokZ
     */
    public function setRokZ($rokZ)
    {
        $this->rokZ = $rokZ;
    }
    
    /**
     * @param mixed $rokU
     */
    public function setRokU($rokU)
    {
        $this->rokU = $rokU;
    }
    
    /**
     * @param mixed $zanr
     */
    public function setZanr($zanr)
    {
        $this->zanr = $zanr;
    }
    
    /**
     * @param mixed $mesto
     */
    public function setMesto($mesto)
    {
        $this->mesto = $mesto;
    }
    
    /**
     * @param mixed $stat
     */
    public function setStat($stat)
    {
        $this->stat = $stat;
    }
    
    /**
     * @param string $raditPodle
     */
    public function setRaditPodle($raditPodle)
    {
        $this->raditPodle = $raditPodle;
    }
    
    /**
     * @param string $raditSmer
     */
    public function setRaditSmer($raditSmer)
    {
        $this->raditSmer = $raditSmer;
    }
    
    
    public function getRaditOpacnySmer()
    {
        return $this->raditSmer == 'ASC' ? 'DESC' : 'ASC';
    }
    
}
