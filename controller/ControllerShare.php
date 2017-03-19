<?php

require_once 'model/Share.php';
require_once 'model/Calendar.php';
require_once 'model/Event.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/User.php';

class ControllerShare extends Controller {

    public function index() {
        $user = $this->get_user_or_redirect();
        $users = $user->get_userShare();
        $idcalendar = $_POST["idcalendar"];
        $sharex = Share::get_share($idcalendar);
        $shares = [];
        foreach ($sharex as $share) {
            $pseudo = $user::get_pseudo($share->iduser);
            $idcalendar = $share->idcalendar;
            $read_only = $share->read_only;
            $checked = '';
            if ($read_only == 1) {
                $checked = 'checked="checked" ';
            }
            $shares[] = array("pseudo" => $pseudo, "idcalendar" => $idcalendar, "checked" => $checked);
        }
        (new View("share"))->show(array("users" => $users, "shares" => $shares, "idcalendar" => $idcalendar));
    }

    public function addShare() {
        $exist = FALSE;
        $iduser = '';
        $read_only = '';
        $errors = [];
        if (isset($_POST["share"])) {
            $idcalendar = $_POST["idcalendar"];
            if (isset($_POST['read_only'])) {
                $read_only = 1;
            } else {
                $read_only = 0;
            }
            $pseudo = $_POST['pseudo'];
            $iduser = User::get_idPseudo($_POST['pseudo']);
            $idcalendars = Share::get_idcalendars($iduser);
            foreach ($idcalendars as $idcalendarx) {
                if ($idcalendar == $idcalendarx) {
                    $exist = TRUE;
                }
            }
            if (!$exist) {
                $share = new Share($iduser, $idcalendar, $read_only);
                $share->add();
            }
        }
        $this->index();
    }

    public function editShare() {
        if (isset($_POST["editShare"])) {
            if ((isset($_POST['pseudoShare']))) {
                $idcalendar = $_POST["idcalendar"];
                if (isset($_POST['read_only'])) {
                    $read_only = 1;
                } else {
                    $read_only = 0;
                }
                $iduser = User::get_idPseudo($_POST['pseudoShare']);
                $share = new Share($iduser, $idcalendar, $read_only);
                $share->update();
            }
        }
        $this->index();
    }

    public function deleteShare() {
        if (isset($_POST["deleteShare"])) {
            $idcalendar = $_POST["idcalendar"];
            $pseudo = $_POST["pseudo"];
            $iduser = User::get_idPseudo($_POST['pseudo']);
            Share::delete_share($idcalendar, $iduser);
        }
        $this->index();
    }

}
