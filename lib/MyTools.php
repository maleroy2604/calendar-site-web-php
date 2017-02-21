<?php


class MyTools {
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
        $datehtml = substr_replace($date, "T", 10, 1);
        return $datehtml;
    }
    public static function lastWeekNumberOfYear($annee){
  
   
    $week_count = date('W', strtotime($annee . '-12-31'));
    if ($week_count == '01'){
        $week_count = date('W', strtotime($annee . '-12-24'));
    }
    return intval($week_count);
}

}
