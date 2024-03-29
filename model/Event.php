<?php

require_once "framework/Model.php";

class Event extends Model {

    public $idevent = -1;
    public $dateStart;
    public $dateFinish;
    public $whole_day;
    public $title;
    public $description;
    public $idcalendar;

    public function __construct($idevent, $dateStart, $datefinish, $whole_day, $title, $description, $idcalendar) {
        $this->dateStart = $dateStart;
        $this->dateFinish = $datefinish;
        $this->idcalendar = $idcalendar;
        $this->idevent = $idevent;
        $this->title = $title;
        $this->whole_day = $whole_day;
        $this->description = $description;
    }

    public static function add_Event($event) {
        self::execute("INSERT INTO event (start,finish,whole_day,title,description,idcalendar)
                       VALUES(?,?,?,?,?,?)", array($event->dateStart, $event->dateFinish, $event->whole_day, $event->title, $event
            ->description, $event->idcalendar));
    }

    public static function validate($start, $finish, $title, $description) {
        $errors = [];
        $dat1 = new DateTime(trim($start), new DateTimeZone('Europe/paris'));
        $dat2 = new DateTime(trim($finish), new DateTimeZone('Europe/paris'));
        if ($title == '') {
            $errors[] = "le titre est obligatoire ! ";
        }
        if ($description == '') {
            $errors[] = " la description est obligatoire !";
        }
        if ($dat2 < $dat1) {
            $errors[] = "la date de debut est superieur à la date de fin ! ";
        }
        return $errors;
    }

    public static function update_event($event) {

        self::execute("UPDATE event SET start=? ,finish=?, whole_day=?,title=? ,description=?, idcalendar=? where idevent=?", array($event->dateStart, $event->dateFinish,
            $event->whole_day, $event->title, $event->description, $event->idcalendar, $event->idevent));
    }

    public static function get_events($user, $idcalendars) {
        $query = self::execute("SELECT * FROM event where idcalendar in (SELECT  idcalendar FROM calendar where iduser=? )", array($user->iduser));
        $data = $query->fetchAll();
        $events = [];
        foreach ($data as $row) {
            $events[] = new Event($row['idevent'], $row['start'], $row['finish'], $row['whole_day'], $row['title'], $row['description'], $row['idcalendar']);
        }
        
  
        foreach ($idcalendars as $idcalendar) {
            $query1 = self::execute("SELECT * FROM event where idcalendar=?", array($idcalendar));
            $rows = $query1->fetchAll();
            foreach ($rows as $row) {
                $events[] = new Event($row['idevent'], $row['start'], $row['finish'], $row['whole_day'], $row['title'], $row['description'], $row['idcalendar']);
            }
        }

        return $events;
    }
//    public static function get_events_date($user, $idcalendars,$start,$end) {
//        $query = self::execute("SELECT * FROM event where start=? AND finish=? AND idcalendar in (SELECT  idcalendar FROM calendar where iduser=? )", array($start,$end,$user->iduser));
//        $data = $query->fetchAll();
//        $events = [];
//        foreach ($data as $row) {
//            $events[] = new Event($row['idevent'], $row['start'], $row['finish'], $row['whole_day'], $row['title'], $row['description'], $row['idcalendar']);
//        }
//        
//  
//        foreach ($idcalendars as $idcalendar) {
//            $query1 = self::execute("SELECT * FROM event where idcalendar=? AND start=? AND finish=?", array($idcalendar,$start,$end));
//            $rows = $query1->fetchAll();
//            foreach ($rows as $row) {
//                $events[] = new Event($row['idevent'], $row['start'], $row['finish'], $row['whole_day'], $row['title'], $row['description'], $row['idcalendar']);
//            }
//        }

//        return $events;
//    }
    public static function delete_event($idevent) {
        self::execute("DELETE from event where idevent=?", array($idevent));
        return true;
    }

    public static function delete_events($calendar) {
        self::execute("DELETE from event where idcalendar=?", array($calendar->idcalendar));
    }

    public static function get_event($idevent) {
        $query = self::execute("SELECT * FROM event where idevent=?", array($idevent));
        $row = $query->fetch();
        $event = new Event($idevent, $row['start'], $row['finish'], $row['whole_day'], $row['title'], $row['description'], $row['idcalendar']);

        return $event;
    }
    

    public function get_color() {
        return Calendar::get_color($this->idcalendar);
    }

    public static function get_eventsByIdcalendar($idcalendar) {
        $query = self::execute("SELECT * FROM event where idcalendar=?", array($idcalendar));
        $data = $query->fetchAll();
        $events = [];
        foreach ($data as $row) {
            $events[] = new Event($row['idevent'], $row['start'], $row['finish'], $row['whole_day'], $row['title'], $row['description'], $row['idcalendar']);
        }
        return $events;
    }

}
