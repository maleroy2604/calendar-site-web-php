<?php

require_once 'model/User.php';
require_once 'model/Calendar.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerCalendar extends Controller {

    public function index() {


        $this->calendar();
    }

    public function calendar() {

        $user = $this->get_user_or_redirect();

        if (isset($_GET["id"]) && $_GET["id"] !== "") {
            $user = User::get_user($_GET["id"]);
        }


        $calendars = $user->get_calendar();

        (new View("calendar"))->show(array("calendars" => $calendars,"user"=>$user));
    }
    
    public function edit(){
        
    }
    public function add(){
        if (isset($_POST['description']) && $_POST['description'] != '')
            $description='description'
    }
    public function delete(){
        
    }

}
