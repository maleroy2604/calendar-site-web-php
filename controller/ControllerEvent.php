<?php

require_once 'model/Calendar.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/User.php';
require_once 'model/Event.php';

class ControllerEvent extends Controller {

    public function index() {

        $user = $this->get_user_or_redirect();
        $calendars = $user->get_calendar();
        $events = [];
        $calendar='';
        foreach ($calendars as $calendar) {
            $event = Calendar::get_event($calendar);
            foreach ($event as $eventx) {

                $events[] = $eventx;
            }
        }
        usort($events, function ($a, $b) {

            $ad = new DateTime($a->dateStart, new DateTimeZone('Europe/Paris'));
            $bd = new DateTime($b->dateStart, new DateTimeZone('Europe/Paris'));

            if ($ad == $bd) {
                return 0;
            }
            return $ad < $bd ? -1 : 1;
        });



        (new View("event"))->show(array("events" => $events, "user" => $user, "calendar" => $calendar));
    }

    public function create() {
        $user = $this->get_user_or_redirect();
        $calendars = $user->get_calendar();
        (new View("create"))->show(array("calendars" => $calendars));
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
                $this->redirect("event");
            } else {
                (new View("error"))->show(array("errors" => $errors));
            }
        }
    }

    public function edit() {
        $user = $this->get_user_or_redirect();
        $idevent = $_GET["id"];
        $calendars = $user->get_calendar();
        $event = Event::get_event($idevent);
        (new View("update"))->show(array("calendars" => $calendars, "event" => $event));
    }

    public function update() {




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

            $this->redirect("event");
        }else{
            (new View("error"))->show(array("errors" => $errors));
        }
    }

    public function delete() {
        $idevent = $_GET["id"];
        Event::delete_event($idevent);
        $this->redirect("event");
    }

    public function cancel() {
        $this->redirect("event");
    }

}
