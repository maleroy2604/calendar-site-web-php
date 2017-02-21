<?php

require_once 'model/Calendar.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/User.php';
require_once 'model/Event.php';
require_once 'lib/MyTools.php';
class ControllerEvent extends Controller {

    public function index() {
        date_default_timezone_set('UTC');
        $user = $this->get_user_or_redirect();

        $eventm = $user->get_events();
        $colors = [];

        $events = [];
       
        

        foreach ($eventm as $event) {
            $colors[] = $event->get_color();
        }

        if (isset($_POST['numSem'])) {
            $numSem = (int) $_POST['numSem'];
        } else {
            $numSem = (int) date('W');
        }
         if (isset($_POST['annee'])) {
            $annee = (int) $_POST['annee'];
        } else {
            $annee = (int) date('Y');
        }
       
        if (isset($_POST['next']) && isset($_POST['numSem']) ) {
            $numSem = (int) $_POST['numSem'];
            
            if($numSem <= MyTools::lastWeekNumberOfYear($annee))
                ++$numSem;
            else {
                $numSem=1;
                ++$annee;
            }
        }
        
        if (isset($_POST['previous']) && isset($_POST['numSem']) ) {
            $numSem = (int) $_POST['numSem'];
            if ($numSem == 1) {
                --$annee;
                $numSem=MyTools::lastWeekNumberOfYear($annee);
                
            }else{
                --$numSem;
            }
        }
        $day = MyTools::day($annee, $numSem);
        $lastDay =MyTools::lastDay($annee, $numSem);

     




        foreach ($eventm as $eventx) {

            $numSemainEvent = date('W', strtotime($eventx->dateStart));

            if ($numSemainEvent == $numSem) {
                $events[] = $eventx;
            }
        }
        (new View("event"))->show(array("events" => $events, "user" => $user, "colors" => $colors, "numSem" => $numSem, "day" => $day, "annee"=>$annee,"lastDay" => $lastDay));
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
                $this->redirect("event");
            } else {
                (new View("error"))->show(array("errors" => $errors));
            }
        }
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

    public function cancel() {
        $this->redirect("event");
    }

}
