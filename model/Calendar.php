<?php

class Calendar extends Model{

    public $description;
    public $color;
    public $iduser;
    
    public function __construct($description,$color, $iduser){
        $this->description=$description;
        $this->color=$color;
      
    }

    public static function get_calendar($user) {
        
        $query = self::execute("SELECT * FROM calendar where iduser= :iduser", array("iduser"=>$user->iduser));
        $data = $query->fetchAll();
        $calendars=[];
         foreach ($data as $row) {
            $calendars[] = new Calendar($row['description'],$row['color']);
        }
        return $calendars;
        
    }
   
    

   
   

    


}
