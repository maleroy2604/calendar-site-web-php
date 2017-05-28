<?php

require_once 'View.php';

class Tools {

    //nettoie le string donné
    public static function sanitize($var) {
        $var = stripslashes($var);
        $var = strip_tags($var);
        $var = htmlspecialchars($var);
        return $var;
    }

    //dirige vers la page d'erreur
    public static function abort($err) {
        (new View("error"))->show(array("error" => $err));
        die;
    }

    //renvoie le string donné haché.
    public static function my_hash($password) {
        $prefix_salt = "vJemLnU3";
        $suffix_salt = "QUaLtRs7";
        return md5($prefix_salt . $password . $suffix_salt);
    }

    public static function dayOfWeek($date) {

        $day = new DateTime($date, new DateTimeZone('Europe/Paris'));
        return $day->format('D');
    }

    public static function day($annee, $semaine) {
        $lundi = new DateTime();
        $lundi->setISOdate($annee, $semaine);
        $result = $lundi->format('d M Y');
        return $result;
    }

    public static function lastDay($annee, $numSem) {
        $lastDay = new DateTime();
        $lastDay->setISOdate($annee, $numSem,7);
        $result=$lastDay->format('d M Y');
        return $result;
    }

    public static function dateHtml($date) {
        return substr($date,0, 10);
    }
    public static function heureHtml($time){
        return substr($time, 11);
    }

}
