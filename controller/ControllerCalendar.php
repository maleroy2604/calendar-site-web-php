<?php

require_once 'model/Calendar.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/User.php';

class ControllerCalendar extends Controller {

    public function index() {
        $user = $this->get_user_or_redirect();
        if (isset($_POST['color']) && isset($_POST['description']) && $_POST['description'] != '') {
            $this->add();
        }


        $calendars = $user->get_calendar();

        (new View("calendar"))->show(array("calendars" => $calendars, "user" => $user));
    }

    public function edit() {
        $idcalendar = $_GET["id"];
        $description = '';
        $color = '';
        $errors = [];
        $user = $this->get_user_or_redirect();
        $color = $_POST['color'];
        $description = $_POST['description'];
        $errors = calendar:: validate($description);
        if (count($errors) == 0) {
            $calendar = new Calendar($description, $color, $user->iduser, $idcalendar);
            Calendar::update_calendar($calendar);
            $this->redirect("calendar");
        }
    }

    public function add() {
        $description = '';
        $color = '';
        $errors = [];
        if (isset($_POST['description']) && isset($_POST['color'])) {
            $description = $_POST['description'];
            $color = $_POST['color'];
            $errors = calendar:: validate($description);
            $user = $this->get_user_or_redirect();
            if (count($errors) == 0) {
                $calendar = new Calendar($description, $color, $user->iduser, -1);
                Calendar::add_calendar($calendar);
            }
        }
    }

    public function delete() {
        $idcalendar = $_GET["id"];
       // (new View("delete"))->show(array("idcalendar" => $idcalendar));
        (new View("test"))->show(array());
    }

    public function remove_calendar() {
        if (isset($_POST['cancel'])) {
            $this->redirect("calendar");
        } else if (isset($_POST['confirm'])) {
            $idcalendar = $_GET["id"];
            Calendar::delete_calendar($idcalendar);
            $this->redirect("calendar");
        }
    }

}
