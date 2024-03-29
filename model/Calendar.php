<?php

require_once "framework/Model.php";

class Calendar extends Model {

    public $description;
    public $color;
    public $iduser;
    public $idcalendar = -1;

    public function __construct($description, $color, $iduser, $idcalendar) {
        $this->description = $description;
        $this->color = $color;
        $this->iduser = $iduser;
        $this->idcalendar = $idcalendar;
    }

    public function add() {
        self::execute("INSERT INTO Calendar(description,color,iduser)
                       VALUES(?,?,?)", array($this->description, substr($this->color, 1), $this->iduser));
    }


    public function delete() {
        $this->delete_all_events();
        $this->deleteShare();
        self::execute("DELETE from calendar where idcalendar=?", array($this->idcalendar));
    }

    public function delete_all_events() {
        Event::delete_events($this);
    }

    public function update() {

        self::execute("UPDATE calendar SET description=?, color=? where idcalendar=?", array($this->description,
            substr($this->color, 1), $this->idcalendar));
    }

    public static function get_color($idcalendar) {
        $query = self::execute("SELECT color FROM calendar where idcalendar=?", array($idcalendar));
        $color = $query->fetch();

        return $color["color"];
    }

    public static function get($user) {
        $query = self::execute("SELECT * FROM calendar where iduser=?", array($user->iduser));
        $data = $query->fetchAll();
        $calendars = [];
        foreach ($data as $row) {
            $calendars[] = new Calendar($row['description'], "#" . $row['color'], $row['iduser'], $row['idcalendar']);
        }
        return $calendars;
    }

    public static function get_calendar($idcalendar) {
        $query = self::execute("SELECT * FROM calendar where idcalendar=?", array($idcalendar));
        $row = $query->fetch();
        $calendar = new Calendar($row['description'], "#" . $row['color'], $row['iduser'], $row['idcalendar']);
        return $calendar;
    }

    public static function get_calendars_and_calendar_share_ro($user, $idcalendars) {
        $calendars = self::get($user);
        foreach ($idcalendars as $idcalendar) {
            $query = self::execute("SELECT * FROM calendar where idcalendar=?", array($idcalendar));
            $row = $query->fetch();
            $calendars [] = new Calendar($row['description'], "#" . $row['color'], $row['iduser'], $row['idcalendar']);
        }
        return $calendars;
    }

    public static function it_is_my_calendar($user, $idcalendar) {
        $query = self::execute("SELECT * FROM calendar where iduser=? && idcalendar=?", array($user->iduser, $idcalendar));
        $row = $query->fetch();
        if(empty($row)){
            return FALSE;
        }else {
            return TRUE;
        }
    }

    public function deleteShare() {
        Share::delete($this);
    }
}
