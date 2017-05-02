<?php

require_once 'model/Share.php';
require_once 'model/Calendar.php';
require_once 'model/Event.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/User.php';

class ControllerCalendar extends Controller {

    public function index() {
        $user = $this->get_user_or_redirect();
        $calendarx = [];
        $calendars = $user->get_my_calendars();
        $shares = $user->get_share();
        foreach ($shares as $share) {
            $calendarx[] = Calendar::get_calendar($share->idcalendar);
        }
        (new View("calendar"))->show(array("calendars" => $calendars, "user" => $user, "calendarx" => $calendarx));
    }

    public function edit() {
        $user=$this->get_user_or_redirect();
        if (isset($_POST["editcalendar"])) {
            $idcalendar = $_GET["id"];
            if ((isset($_POST['description']) == '' || isset($_POST['description'])) && isset($_POST['color'])) {
                $color = $_POST['color'];
                $description = $_POST['description'];
                $calendar = new Calendar($description, $color, $user->iduser, $idcalendar);
                $user->update_calendar($calendar);
                $this->redirect("calendar");
            }
        }
    }

    public function add() {
        $user=$this->get_user_or_redirect();
        if (isset($_POST["addcalendar"])) {
            if ((isset($_POST['description']) == '' || isset($_POST['description'])) && isset($_POST['color'])) {
                $description = $_POST['description'];
                $color = $_POST['color'];
                $calendar = new Calendar($description, $color, $user->iduser, -1);
                $user->add_calendar($calendar);
                $this->redirect("calendar");
            }
        }
    }

    public function delete() {
        $user=$this->get_user_or_redirect();
        if (isset($_POST["delcalendar"])) {
            $idcalendar = $_GET["id"];
            (new View("delete"))->show(array("idcalendar" => $idcalendar));
        }
    }

    public function remove_calendar() {
        $user=$this->get_user_or_redirect();
        if (isset($_POST['cancel'])) {
            $this->redirect("calendar");
        } else if (isset($_POST['confirm'])) {
            $idcalendar = $_GET["id"];
            $calendar = Calendar::get_calendar($idcalendar);
            if($calendar::it_is_my_calendar($user,$idcalendar))
                $user->delete_calendar($calendar);
            $this->redirect("calendar");
        }
    }

}
