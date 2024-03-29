<?php

require_once 'model/User.php';
require_once 'framework/Controller.php';
require_once 'framework/View.php';

class ControllerMain extends Controller {

    public function index() {
        if ($this->user_logged()) {
            $this->redirect("main", "welcome");
        } else {
            (new View("index"))->show();
        }
    }
    public function pseudo_available_service() {
        $res = "false";
        if (isset($_POST["pseudo"]) && $_POST["pseudo"] !== "") {
            $user = User::pseudo_exist($_POST["pseudo"]);
            if ($user) {
                $res = "true";
            }
        }
        echo $res;
    }
     public function mail_available_service() {
        $res = "false";
        if (isset($_POST["email"]) && $_POST["email"] !== "") {
            $user = User::mail_exists($_POST["email"]);
            if ($user) {
                $res = "true";
            }
        }
        echo $res;
    }
     public function pseudo_Exist_service() {
          $res = "true";
         if (isset($_POST["pseudo"]) && $_POST["pseudo"] !== "") {
            $user = User::pseudo_exist($_POST["pseudo"]);
            if ($user) {
                $res = "false";
            }
        }
        echo $res;
     }
    
     

    public function login() {
        $pseudo = '';
        $password = '';
        $error = '';
        if (isset($_POST['pseudo']) && isset($_POST['password'])) {
            $pseudo = $_POST['pseudo'];
            $password = $_POST['password'];

            $error = User::validate_login($pseudo, $password);
            if ($error === "") {
                $this->log_user(User::get_User($pseudo));
            }
        }
        (new View("login"))->show(array("pseudo" => $pseudo, "password" => $password, "error" => $error));
    }

    public function signup() {
        $pseudo = '';
        $password = '';
        $password_confirm = '';
        $email = '';
        $fullname = '';
        $errors = [];

        if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['email']) && isset($_POST['fullname'])) {
            $pseudo = trim($_POST['pseudo']);
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];

            $errors = User::validate($pseudo, $password, $password_confirm, $email);

            if (count($errors) == 0) {
                $user = new User($pseudo, Tools::my_hash($password), $email, $fullname, -1);
                User::add_User($user);
                $user = User::get_user($pseudo);
                $this->log_user($user);
            }
        }
        (new View("signup"))->show(array("pseudo" => $pseudo, "password" => $password, "password_confirm" => $password_confirm, "email" => $email, "fullname" => $fullname, "errors" => $errors));
    }

    public function welcome() {
        $member = $this->get_user_or_redirect();
        if (isset($_GET["id"]) && $_GET["id"] !== "") {
            $member = User::get_user($_GET["id"]);
            
        }
        (new View("welcome"))->show(array("member" => $member));
    }

   

}
