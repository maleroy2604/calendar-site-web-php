<?php

require_once "framework/Model.php";

class User extends Model {

    public $pseudo;
    public $hashed_password;
    public $email;
    public $fullName;
    public $iduser;

    public function __construct($pseudo, $password, $email, $fullName, $iduser) {
        $this->pseudo = $pseudo;
        $this->hashed_password = $password;
        $this->email = $email;
        $this->fullName = $fullName;
        $this->iduser = $iduser;
    }

    public static function validate_login($pseudo, $password) {
        $error = "";
        $user = User::get_user($pseudo);
        if ($user) {
            if (!self::check_password($password, $user->hashed_password)) {
                $error = "Wrong password. Please try again.";
            }
        } else {
            $error = "can't find a user Please sign up. ";
        }
        return $error;
    }

    private static function check_password($clear_password, $hash) {
        return $hash === Tools::my_hash($clear_password);
    }

    public static function get_user($pseudo) {
        $query = self::execute("SELECT * FROM user where pseudo=?", array($pseudo));
        $data = $query->fetch();
        if ($query->rowCount() == 0) {
            return false;
        } else {
            return new User($data["pseudo"], $data["password"], $data["email"], $data["full_name"], $data["iduser"]);
        }
    }

    public static function get_mail($mail) {
        $query = self::execute("SELECT * FROM user where email=?", array($mail));
        $data = $query->fetch();
        if ($query->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

   

    public static function validate($pseudo, $password, $password_confirm, $email) {
        $errors = [];
        $member = self::get_user($pseudo);
        $mail = self::get_mail($email);
        if ($mail) {
            $errors[] = "This email already exists.";
        }
        if ($member) {
            $errors[] = "This user already exists.";
        } if ($pseudo == '') {
            $errors[] = "Pseudo is required.";
        } if (strlen($pseudo) < 3 || strlen($pseudo) > 16) {
            $errors[] = "Pseudo length must be between 3 and 16.";
        } if (!preg_match("/^[a-zA-Z][a-zA-Z0-9]*$/", $pseudo)) {
            $errors[] = "Pseudo must start by a letter and must contain only letters and numbers.";
        } if (strlen($password) < 8 || strlen($password) > 16) {
            $errors[] = "Password length must be between 8 and 16.";
        } if (!((preg_match("/[A-Z]/", $password)) && preg_match("/\d/", $password) && preg_match("/['\";:,.\/?\\-]/", $password))) {
            $errors[] = "Password must contain one uppercase letter, one number and one punctuation mark.";
        } if ($password != $password_confirm) {
            $errors[] = "You have to enter twice the same password.";
        }
        return $errors;
    }

    public static function add_user($user) {
        self::execute("INSERT INTO User(pseudo,password,email,full_name)
                       VALUES(?,?,?,?)", array($user->pseudo, $user->hashed_password, $user->email, $user->fullName));
        return true;
    }

    public function get_id() {
        $query = self::execute("SELECT iduser FROM user where pseudo=?", $this->pseudo);
        $data = $query->fetch();
        return $data;
    }
     public  function get_calendar() {
        
        return Calendar::get($this);
       
        
    }
    public  function delete_calendar($calendar){
        $calendar->delete();
    }
    public function add_calendar($calendar){
        $calendar->add();
    }
    public function update_calendar($calendar){
        $calendar->update();
    }
    public function get_events(){
        return Event::get_events($this);
    }

}
