<?php
require_once 'model/User.php';
require_once 'framework/Controller.php';
require_once 'framework/View.php';
class ControllerMain extends Controller{
   public function index() {
        if($this->user_logged()){
           $this->redirect("user","welcome");
         
        }else{
            (new View("index"))->show();
        }
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
        $email='';
        $fullname='';
        $errors = [];

        if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password_confirm'])&& isset($_POST['email']) && isset($_POST['fullname']) ) {
            $pseudo = trim($_POST['pseudo']);
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $email=$_POST['email'];
            $fullname=$_POST['fullname'];

            $errors = User::validate($pseudo, $password, $password_confirm);

            if (count($errors) == 0) {
                $user = new User($pseudo, Tools::my_hash($password),$email,$fullname);
                User::add_User($user);
                $this->log_user($user);
            }
        }
        (new View("signup"))->show(array("pseudo" => $pseudo, "password" => $password, "password_confirm" => $password_confirm,"email"=>$email ,"fullname"=>$fullname,"errors" => $errors));
    }
    
}
