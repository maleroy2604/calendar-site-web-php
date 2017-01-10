<?php
require_once 'model/User.php';

require_once 'framework/View.php';
require_once 'framework/Controller.php';
class ControllerUser extends Controller {
    
    
    
    public function index() {
        
        $this->welcome();
    
    }
    public function welcome() {
        $user= $this->get_user_or_redirect();
        if (isset($_GET["id"]) && $_GET["id"] !== "") {
            $member = User::get_user($_GET["id"]);
        }
        (new View("welcome"))->show(array("user" => $user));
    }
}

