<?php
class databaseZP{
    
    private $connector;
    private $sql;
    private $params;
    private $idKapely;
    private $idAlba;
    private $idPisne;
    private $nazevKapely;
    private $nazevAlba;
    private $nazevPisne;
    private $rokZ;
    private $rokU;
    private $rokV;
    private $delka;
    private $poradi;
    private $zanr;
    private $mesto;
    private $stat;
    private $raditPodle;
    private $raditSmer;
    private $vyhledat;
    private $login;
    private $password;
    private $userName;
    private $userRole;
    private $userId;
    private $userLogin;
    private $oblibene;
    
    
    
    public function __construct()
    {
        include '../settings/connect.php';
        $this->connector = connectToDb();
        if($podle = $_GET['podle']){
        SWITCH ($podle) {
            case 'zalozeni':
                $this->setRaditPodle('rok_zalozeni');
                break;
            case 'ukonceni':
                $this->setRaditPodle('rok_ukonceni');
                break;
            case 'zanr':
                $this->setRaditPodle('z.popis');
                break;
            case 'mesto':
                $this->setRaditPodle('mesto');
                break;
            case 'stat':
                $this->setRaditPodle('s.nazev');
                break;
            default:
                $this->setRaditPodle('nazev_kapely');
        }
        }else{
                $this->raditPodle = 'nazev_kapely';
                $this->raditSmer = 'ASC';
        }
        if($_GET['smer']){$this->setRaditSmer($_GET['smer'] == 'ASC' ? 'ASC' : 'DESC');}
        if($_SESSION['USER_NAME']){$this->userName = $_SESSION['USER_NAME'];}
        if($_SESSION['ROLE']){$this->userRole = $_SESSION['ROLE'];}
        if($_SESSION['USER_ID']){$this->userId = $_SESSION['USER_ID'];}
     }

    private function getData(){
        try {
            $stmt = $this->connector->prepare($this->sql);
            $stmt->execute($this->params);
        }catch (Exception $exception){
            $_SESSION['alert']=9;
            $_SESSION['errors'][] = $this->sql . '\n' . $exception->getMessage();
            header('location: ?');
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
        $where = 'WHERE true';
        $join = '';
        $params = [];
        $select = '';
        if(isset($this->vyhledat)){
            $where .= " and( k.nazev_kapely ilike :vyhledat or k.rok_zalozeni::VARCHAR ilike :vyhledat or k.rok_ukonceni::VARCHAR ilike :vyhledat or k.mesto ilike :vyhledat or s.nazev ilike :vyhledat or z.popis ilike :vyhledat)";
            $params['vyhledat'] = '%' . $this->vyhledat . '%';
        }
        if($this->oblibene){
            $where .= " and ok.kapela_id is not null";
        }
        if($this->userRole == 'navstevnik' || $this->userRole == 'admin'){
            $join = "LEFT JOIN oblibena_kapela ok ON k.kapela_id = ok.kapela_id and ok.user_id = :user";
            $params['user'] = $this->userId;
            $select .= ', coalesce(ok.user_id > 0, false) as oblibena';
        }
        return $this->setSql("SELECT k.kapela_id, k.nazev_kapely, k.rok_zalozeni::VARCHAR, k.rok_ukonceni::VARCHAR, k.mesto, s.nazev AS stat_nazev, z.popis AS zanr_popis ".$select."
                    FROM kapela k
                    NATURAL JOIN stat s
                    NATURAL JOIN zanr z
                    " . $join . "
                    " . $where . "
                    ORDER BY " . $this->raditPodle . " " . $this->raditSmer, $params);
    }
    
    private function ulozitKapelu()
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
    
    private function ulozitAlbum(){
        $params = ['nazevAlba' => $this->nazevAlba,
            'rokV' => $this->rokV,
            'idKapely' => $this->idKapely,
        ];
        $sql = "INSERT INTO album VALUES (default, :idKapely, :nazevAlba, :rokV)";
        if($_POST['id_alba']){
            $sql = "UPDATE album SET nazev_alba = :nazevAlba, vydano = :rokV where album_id = :idAlba and kapela_id = :idKapely";
            $params['idAlba'] = $this->idAlba;
        }
        $this->setSql($sql, $params);
    }
    private function ulozitPisen(){
        $params = [
            'nazevPisne' => $this->nazevPisne,
            'delka' => $this->delka,
            'poradi' => $this->poradi,
            'idAlba' => $this->idAlba,
        ];
        $sql = "INSERT INTO pisen VALUES (default, :idAlba, :nazevPisne, :delka, :poradi)";
        if($_POST['id_pisne']){
            $params['idPisne'] = $this->idPisne;
            $sql = "UPDATE pisen SET album_id = :idAlba, nazev = :nazevPisne, delka = :delka, poradi = :poradi where pisen_id = :idPisne and album_id = :idAlba";
        }
        $this->setSql($sql, $params);
    }
    
    public function getKapeluById($idKapely)
    {
        return $this->setSql("SELECT * FROM kapela WHERE kapela_id = :idKapely", ['idKapely' => $idKapely]);
    }
    
    public function getAbumKapelyById($idAlba)
    {
        return $this->setSql("SELECT * FROM album NATURAL JOIN kapela WHERE album_id = :idAlba", ['idAlba' => $idAlba]);
    }
    
    public function getPisenAlbaById($idPisne)
    {
        return $this->setSql("SELECT * FROM pisen NATURAL JOIN album NATURAL JOIN kapela WHERE pisen_id = :idPisne", ['idPisne' => $idPisne]);
    }
    
    public function delKapeluById($idKapely)
    {
        $this->setSql("DELETE FROM kapela WHERE kapela_id = :idKapely", ['idKapely' => $idKapely]);
    }
    
    public function delAlbumById($idAlba)
    {
        $this->setSql("DELETE FROM album WHERE album_id = :idAlba", ['idAlba' => $idAlba]);
    }
    
    public function delPisenById($idPisne)
    {
        $this->setSql("DELETE FROM pisen WHERE pisen_id = :idPisne", ['idPisne' => $idPisne]);
    }
    
    public function setIdKapely($idKapely)
    {
        $this->idKapely = $idKapely;
    }
    
    public function setNazevKapely($nazevKapely)
    {
        $this->nazevKapely = $nazevKapely;
    }
    
    public function setRokZ($rokZ)
    {
        $this->rokZ = $rokZ;
    }
    
    public function setRokU($rokU)
    {
        $this->rokU = $rokU;
    }
    
    public function setZanr($zanr)
    {
        $this->zanr = $zanr;
    }
    
    public function setMesto($mesto)
    {
        $this->mesto = $mesto;
    }
    
    public function setStat($stat)
    {
        $this->stat = $stat;
    }
    
    public function setRaditPodle($raditPodle)
    {
        $this->raditPodle = $raditPodle;
    }
    
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
    
    public function getAlbaKapely($id)
    {
        return $this->setSql("SELECT * FROM album WHERE kapela_id = :id ORDER BY nazev_alba", ['id' => $id]);
    }
    
    public function getPisneAlba($albumId){
        return $this->setSql("SELECT * FROM pisen WHERE album_id = :id ORDER BY poradi", ['id' => $albumId]);
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
    
    public function setLogin($login)
    {
        $this->login = $login;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function loginUser()
    {
        $sql = $this->setSql("SELECT * FROM uzivatel WHERE login = :login", ['login' => $this->login]);
        $password = hash('sha256', $sql[0]["password"].$_SESSION['casSifrovani']);
        if($password == $this->password) {
            $_SESSION['ROLE'] = $sql[0]['role_id'];
            $_SESSION['USER_NAME'] = $sql[0]['user_name'];
            $_SESSION['USER_ID'] = $sql[0]['user_id'];
            $_SESSION['USER_LOGIN'] = $sql[0]['login'];
            return true;
        }
        return false;
    }
    
    public function getUsers(){
        return $this->setSql("SELECT * FROM uzivatel ORDER BY user_name");
    }

    public function getUserName()
    {
        return $this->userName;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }
    
    public function getUserRole()
    {
        return $this->userRole;
    }
    
    public function getLogin()
    {
        return $this->login;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;
    }
    
    public function setOblibit()
    {
        $this->setSql("INSERT INTO oblibena_kapela VALUES (:uzivatel, :kapela)", ['uzivatel' => $this->userId, 'kapela' => $_GET['idKapely']]);
    }
    
    public function setOdlibit()
    {
        $this->setSql("DELETE FROM oblibena_kapela WHERE user_id = :uzivatel and kapela_id = :kapela", ['uzivatel' => $this->userId, 'kapela' => $_GET['idKapely']]);
    }
    
    public function setDataKapely(){
        if($_POST['nazev_kapely'] !== null
            && $_POST['rok_z'] >= 1900
            && $_POST['rok_z'] <= date('Y')
            && $_POST['zanr'] !== null
            && $_POST['stat'] !== null
        ){
            $this->setRokZ($_POST['rok_z']);
            $this->setRokU($_POST['rok_u']);
            $this->setNazevKapely($_POST['nazev_kapely']);
            $this->setZanr($_POST['zanr']);
            $this->setMesto($_POST['mesto']);
            $this->setStat($_POST['stat']);
            $this->setIdKapely($_POST['id']);
            $this->ulozitKapelu();
            $_SESSION['alert'] = 6;
            header('location: ?');
        }
    
    }
    
    public function setOblibene($oblibene)
    {
        $this->oblibene = $oblibene;
    }
    
    public function setAlbumKapely()
    {
        if($_POST['nazev_alba'] && $_POST['rok_v']){
            $this->setIdKapely($_GET['id']);
            $this->setRokV($_POST['rok_v']);
            $this->setNazevAlba($_POST['nazev_alba']);
            $this->setIdAlba($_POST['id_alba']);
            $this->ulozitAlbum();
        }
    }
    
    public function setPisenAlbaKapely()
    {
        if($_POST['nazev_pisne'] && $_POST['delka'] && $_POST['poradi'] ){
            $this->setIdAlba($_POST['id_alba']);
            $this->setNazevPisne($_POST['nazev_pisne']);
            $this->setDelka($_POST['delka']);
            $this->setPoradi($_POST['poradi']);
            $this->setIdPisne($_POST['id_pisne']);
            $this->ulozitPisen();
        }
    }
    
    private function setNazevAlba($nazevAlba)
    {
        $this->nazevAlba = $nazevAlba;
    }
    
    private function setRokV($rokV)
    {
        $this->rokV = $rokV;
    }
    
    private function setIdAlba($idAlba)
    {
        $this->idAlba = $idAlba;
    }
    
    private function setNazevPisne($nazevPisne)
    {
        $this->nazevPisne = $nazevPisne;
    }
    
    private function setDelka($delka)
    {
        $this->delka = $delka;
    }
    
    private function setPoradi($poradi)
    {
        $this->poradi = $poradi;
    }
    
    public function setIdPisne($idPisne)
    {
        $this->idPisne = $idPisne;
    }
    
}
