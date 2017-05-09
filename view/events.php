<?php
    $json=array();
    $user= $_SESSION["user"];
    $events=$user->get_events();
    echo json_encode($events);

    
