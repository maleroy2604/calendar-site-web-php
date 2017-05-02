<?php

require_once "framework/Model.php";

class Share extends Model {

    public $iduser;
    public $idcalendar;
    public $read_only;

    public function __construct($iduser, $idcalendar, $read_only) {
        $this->idcalendar = $idcalendar;
        $this->iduser = $iduser;
        $this->read_only = $read_only;
    }

    public static function get($user) {
        $query = self::execute("SELECT * FROM share where iduser=? ", array($user->iduser));
        $data = $query->fetchAll();
        $shares = [];
        foreach ($data as $row) {
            $shares[] = new Share($row['iduser'], $row['idcalendar'], $row['read_only']);
        }
        return $shares;
    }

    public function add() {
        self::execute("INSERT INTO share(iduser,idcalendar,read_only)
                       VALUES(?,?,?)", array($this->iduser, $this->idcalendar, $this->read_only));
    }

    public static function delete_share($idcalendar, $iduser) {
        self::execute("DELETE from share where idcalendar=? and iduser=?", array($idcalendar, $iduser));
        return true;
    }

    public static function delete($calendar) {
        self::execute("DELETE from share where idcalendar=?", array($calendar->idcalendar));
        return true;
    }

    public function update() {

        self::execute("UPDATE share SET idcalendar=?, read_only=? where iduser=? ", array($this->idcalendar, $this->read_only, $this->iduser));
    }

    public static function get_share($idcalendar) {
        $query = self::execute("SELECT * FROM share where  idcalendar=?", array($idcalendar));
        $row = $query->fetch();
           $share = new Share($row['iduser'], $row['idcalendar'], $row['read_only']);
        return $share;
    }
     public static function get_shares($idcalendar) {
        $query = self::execute("SELECT * FROM share where  idcalendar=?", array($idcalendar));
        $data = $query->fetchAll();
        $shares=[];
        foreach($data as $row){
           $shares[] = new Share($row['iduser'], $row['idcalendar'], $row['read_only']);
        }
        return $shares;
    }

    public static function get_idcalendars($iduser) {
        $query = self::execute("SELECT * FROM share where iduser=? ", array($iduser));
        $data = $query->fetchAll();
        $idcalendars = [];
        foreach ($data as $row) {
            $idcalendars[] = $row['idcalendar'];
        }
        return $idcalendars;
    }

    public static function get_idcalendars_ro($user) {
        $query = self::execute("SELECT * FROM share where iduser=? && read_only=? ", array($user->iduser, 1));
        $data = $query->fetchAll();
        $idcalendars = [];
        foreach ($data as $row) {
            $idcalendars[] = $row['idcalendar'];
        }
        return $idcalendars;
    }

}
