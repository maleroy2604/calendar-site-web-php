<?php

require_once 'model/Share.php';
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
        $colors = $this->colorEvents($eventm);
        $this->changeWeek($numSem, $annee);
        $day = MyTools::day($annee, $numSem);
        $lastDay = MyTools::lastDay($annee, $numSem);
        $events = $this->events($eventm, $numSem);
        (new View("event"))->show(array("events" => $events, "user" => $user, "colors" => $colors, "numSem" => $numSem,
            "day" => $day, "annee" => $annee, "lastDay" => $lastDay));
    }

    public function create() {
        $user = $this->get_user_or_redirect();
        $shares = $user->get_share();
        $calendars = $user->get_allcalendars_ro();
        if (isset($_POST["create"])) {
            if (sizeof($calendars) > 0) {
                (new View("create"))->show(array("calendars" => $calendars));
            } else {
                $errors = array("Vous devez d'abord crée un calendrier ! ");
                (new View("error"))->show(array("errors" => $errors));
            }
        }
    }

    public function add() {
        $this->get_user_or_redirect();
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST["calendar"]) && isset($_POST['start']) && isset($_POST['finish'])) {
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
        if (isset($_POST["update"])) {
            $idevent = $_POST["idevent"];
            $errors = [];
            $event = Event::get_event($idevent);
            $idcalendar = $event->idcalendar;
            if (!Calendar::it_is_my_calendar($user, $idcalendar)) {
                $shareEvent = Share::get_share($idcalendar);
                if ($shareEvent->read_only == 0) {
                    $errors[] = "cette evenement est en lecture seule";
                }
            }
            $calendars = $user->get_allcalendars_ro();
            if (count($errors) == 0) {
                $event = Event::get_event($idevent);
                (new View("update"))->show(array("calendars" => $calendars, "event" => $event));
            } else {
                (new View("error"))->show(array("errors" => $errors));
            }
        }
    }

    public function update() {
        $this->get_user_or_redirect();
        if (isset($_POST['update'])) {
            $idevent = $_GET["id"];
            if (isset($_POST['wholeday'])) {
                $wholeday = 1;
            } else {
                $wholeday = 0;
            }
            $idcalendar = $_POST['idcalendar'];
            $title = trim($_POST['title']);
            $description = $_POST['description'];
            $start = str_replace("T", " ", $_POST['start']);
            $finish = str_replace("T", " ", $_POST['finish']);
            $errors = Event::validate($start, $finish, $title, $description);
            if (count($errors) == 0) {
                $this->updateEvent($event = new Event($idevent, $start, $finish, $wholeday, $title, $description, $idcalendar));
            } else {
                (new View("error"))->show(array("errors" => $errors));
            }
        }
    }

    public function deletevent() {
        $this->get_user_or_redirect();
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

    private function updateEvent($event) {
        Event::update_event($event);
        $this->redirect("event");
    }

    private function events($eventm, $numSem) {
        $events = [];
        foreach ($eventm as $eventx) {

            $numSemainEvent = date('W', strtotime($eventx->dateStart));
            if ($numSemainEvent == $numSem) {
                $events[] = $eventx;
            }
        }
        return $events;
    }

    private function colorEvents($eventm) {
        $colors = [];
        foreach ($eventm as $event) {
            $colors[] = $event->get_color();
        }
        return $colors;
    }

    private function next(&$numSem, &$annee) {
        if ($numSem <= MyTools::lastWeekNumberOfYear($annee))
            ++$numSem;
        else {
            $numSem = 1;
            ++$annee;
        }
    }

    private function previous(&$numSem, &$annee) {
        if ($numSem == 1) {
            --$annee;
            $numSem = MyTools::lastWeekNumberOfYear($annee);
        } else {
            --$numSem;
        }
    }

    private function changeWeek(&$numSem, &$annee) {
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
        if (isset($_POST['next']) && isset($_POST['numSem'])) {
            $numSem = (int) $_POST['numSem'];
            $this->next($numSem, $annee);
        }
        if (isset($_POST['previous']) && isset($_POST['numSem'])) {
            $numSem = (int) $_POST['numSem'];
            $this->previous($numSem, $annee);
        }
    }

}
