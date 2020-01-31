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
    private $vyhledat;
    
    
    public function __construct()
    {
        include '../settings/connect.php';
        $this->connector = connectToDb();
        $this->raditPodle = 'nazev_kapely';
        $this->raditSmer = 'ASC';
        if($_GET['smer']){$this->setRaditSmer($_GET['smer'] == 'ASC' ? 'ASC' : 'DESC');}
     }

    private function getData(){
        try {
            $stmt = $this->connector->prepare($this->sql);
            $stmt->execute($this->params);
        }catch (Exception $exception){
            exit ('Nelze vykonat dotaz: ' . $this->sql . '<br>' . $exception->getMessage());
        }
        return $stmt->fetchAll();
    }
    
    private function setSql($sql, $params = []){
        $this->sql = $sql;
        $this->params = $params;
        return $this->getData();
    }
    
    function getKapely(){
        $where = '';
        $params = [];
        if(isset($this->vyhledat)){
            $where = "WHERE k.nazev_kapely ilike :vyhledat or k.rok_zalozeni::VARCHAR ilike :vyhledat or k.rok_ukonceni::VARCHAR ilike :vyhledat or k.mesto ilike :vyhledat or s.nazev ilike :vyhledat or z.popis ilike :vyhledat";
            $params = ['vyhledat' => '%' . $this->vyhledat . '%'];
        }
        return $this->setSql("SELECT k.kapela_id, k.nazev_kapely, k.rok_zalozeni::VARCHAR, k.rok_ukonceni::VARCHAR, k.mesto, s.nazev AS stat_nazev, z.popis AS zanr_popis
                    FROM kapela k
                    NATURAL JOIN stat s
                    NATURAL JOIN zanr z
                    " . $where . "
                    ORDER BY " . $this->raditPodle . " " . $this->raditSmer, $params);
    }
    
    public function ulozitKapelu()
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


        $sql = "Insert into kapela VALUES (default," . $promene . ")";

        if($this->idKapely != null){
            $set = '';
            if($this->nazevKapely != null){$set .= 'nazev_kapely = :nazev, ';}
            if($this->rokZ != null){$set .= 'rok_zalozeni = :zalozeno, ';}
            if($this->rokU != null){$set .= 'rok_ukonceni = :ukonceno, ';}
            if($this->zanr != null){$set .= 'zanr_id = :zanr, ';}
            if($this->mesto != null){$set .= 'mesto = :mesto, ';}
            if($this->stat != null){$set .= 'stat_id = :stat ';}
            $params['idKapely'] = $this->idKapely;
            $sql = "Update kapela SET " . $set . " WHERE kapela_id = :idKapely";
        }
        $this->setSql($sql, $params);
    }
    public function getKapeluById($idKapely)
    {
        return $this->setSql("SELECT * FROM kapela WHERE kapela_id = :idKapely", ['idKapely' => $idKapely]);
    }

    public function delKapeluById($idKapely)
    {
        $this->setSql("DELETE FROM kapela WHERE kapela_id = :idKapely", ['idKapely' => $idKapely]);
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
    
    public function getStaty()
    {
        return $this->setSql("SELECT * FROM stat ORDER BY nazev");
    }
    
    public function getZanr()
    {
        return $this->setSql("SELECT * FROM zanr ORDER BY popis");
    }
    
    public function getKapelyArray()
    {
        $i = 0;
        foreach ($this->getKapely() as $val){
            $out[$i][0] = $val['nazev_kapely'];
            $out[$i][1] = $val['rok_zalozeni'];
            $out[$i][2] = $val['rok_ukonceni'];
            $out[$i][3] = $val['zanr_popis'];
            $out[$i][4] = $val['mesto'];
            $out[$i][5] = $val['stat_nazev'];
            $i++;
        }
        return $out;
    }
    
    public function setVyhledat($vyhledat)
    {
        $this->vyhledat = $vyhledat;
    }
    
}
