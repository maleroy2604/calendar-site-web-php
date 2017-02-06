<?php
require_once "framework/Model.php";
require_once 'model/Event.php';
class Calendar extends Model{

    public $description;
    public $color;
    public $iduser=-1;
    public $idcalendar=-1;
    
    public function __construct($description,$color, $iduser,$idcalendar){
        $this->description=$description;
        $this->color=$color;
        $this->iduser=$iduser;
        $this->idcalendar=$idcalendar;
      
    }

    public static function get_calendar($user) {
        
        $query = self::execute("SELECT * FROM calendar where iduser= :iduser", array("iduser"=>$user->iduser));
        $data = $query->fetchAll();
        $calendars=[];
         foreach ($data as $row) {
            $calendars[] = new Calendar($row['description'],"#".$row['color'],$row['iduser'],$row['idcalendar']);
        }
       
        return $calendars;
        
    }
    public static function add_calendar($calendar) {
       
        self::execute("INSERT INTO Calendar(description,color,iduser)
                       VALUES(?,?,?)", array($calendar->description, substr($calendar->color,1),$calendar->iduser));
        
        return true;
    }
   
    public static function delete_calendar($idcalendar){
         Event::delete_all($idcalendar);
        self::execute(" DELETE from calendar where idcalendar=?" ,array($idcalendar));
        return true;
    }
    public static function update_calendar($calendar){
        
        self::execute("UPDATE calendar SET description=?, color=? where idcalendar=?",array($calendar->description,
            substr($calendar->color,1),$calendar->idcalendar));
        
    }
     
    public static  function get_event($calendar){
        
        $query =self::execute("SELECT * FROM event where idcalendar=?",array($calendar->idcalendar));
        $data=$query->fetchAll();
        $events=[];
        foreach($data as $row){
            $events[]=new Event($row['idevent'],$row['start'],$row['finish'],$row['whole_day'],$row['title'],$row['description'],$row['idcalendar']); 
        }
        
        return $events;
        
    }
     public static  function validate($description){
         $errors=[];
            if ($description==''){
                $erros=" la description ne doit pas etre un champs vide !";
            }
         return $errors;
     }
    
   
    
   

    


}
