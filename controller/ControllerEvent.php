<?php

require_once 'model/Calendar.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/User.php';
require_once 'model/Event.php';

class ControllerEvent extends Controller {

    public function index() {
        $user = $this->get_user_or_redirect();
        $calendars= $user->get_calendar();
        $events= Event::get_events($user);
        $colors=[];
        foreach ($events as $event) {
            $idcalendars[] = Event::get_idcalendar($event);
        }

        foreach ($idcalendars as $idcalendar) {
            $colors[] = Calendar::get_color($idcalendar);
        }
        (new View("event"))->show(array("events" => $events, "user" => $user, "colors" => $colors));
    }

    public function create() {
        $user = $this->get_user_or_redirect();
        $calendars = $user->get_calendar();
        (new View("create"))->show(array("calendars" => $calendars));
        
    }

    public function previous() {



        $this->redirect("event");
    }

    public function next() {

        if (isset($_POST["next"])) {
            $debut = $cpt;
           
            for ($i = $debut; $i < sizeof($eventm); ++$i) {

            if ($debut < sizeof($eventm)) {
                $a = intval(substr(substr($eventm[$i]->dateStart, 0, 10), -2));
                $b = intval(substr(substr($eventm[$debut]->dateStart, 0, 10), -2) + 5);
                if ($a < $b) {
                    $events[] = $eventm[$i];
                    
                }
            }
        }
        }

        //$this->redirect("event");
    }

    public function add() {
        $idcalendar = '';
        $description = '';
        $wholeday = '';
        $start = '';
        $finish = '';
        $title = '';
        $errors = [];

        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['start']) && isset($_POST['finish'])) {
            if (isset($_POST['wholeday'])) {
                $wholeday = 1;
            } else {
                $wholeday = 0;
            }
            $title = trim($_POST['title']);
            $description = $_POST['description'];
            $idcalendar = $_POST['calendar'];
            $start = str_replace("T", " ", $_POST['start']);
            $finish = str_replace("T", " ", $_POST['finish']);
            $errors = Event::validate($start, $finish, $title, $description);

            if (count($errors) == 0) {
                $event = new Event(-1, $start, $finish, $wholeday, $title, $description, $idcalendar);
                Event::add_Event($event);
            }
        }
        $this->redirect("event");
    }

    public function edit() {
        $user = $this->get_user_or_redirect();
        $idevent = $_GET["id"];
        $calendars = $user->get_calendar();
        (new View("update"))->show(array("calendars" => $calendars, "idevent" => $idevent));
    }

    public function update() {

        if (isset($_POST['update'])) {

            $idevent = $_GET["id"];
            $description = '';
            $title = '';
            $start = '';
            $finish = '';
            $wholeday = '';
            $idcalendar = '';
            $errors = [];
            if (isset($_POST['wholeday'])) {
                $wholeday = 1;
            } else {
                $wholeday = 0;
            }
            $idcalendar = $_POST['calendar'];
            $title = trim($_POST['title']);
            $description = $_POST['description'];
            $start = str_replace("T", " ", $_POST['start']);
            $finish = str_replace("T", " ", $_POST['finish']);
            $errors = Event::validate($start, $finish, $title, $description);
            if (count($errors) == 0) {

                if (Event::get_idcalendar($idevent) == $idcalendar) {
                    $event = new Event($idevent, $start, $finish, $wholeday, $title, $description, $idcalendar);
                    Event::update_event($event);
                } else {
                    $event = new Event($idevent, $start, $finish, $wholeday, $title, $description, $idcalendar);
                    Event::delete_event($idevent);
                    Event::add_Event($event);
                }
            }
        }

        $this->redirect("event");
    }

    public function deletevent() {
        $idevent = $_GET["id"];
        (new View("deletevent"))->show(array("idevent" => $idevent));
    }

    public function remove_event() {
        if (isset($_POST['cancel'])) {
            $this->redirect("event");
        } else if (isset($_POST['confirm'])) {
            $idevent = $_GET["id"];
            Event::delete_event($idevent);
            $this->redirect("event");
        }
    }

}
