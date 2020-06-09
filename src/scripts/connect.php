<?php  
    // $conn = new mysqli('localhost','root','','cdv_ti');
    date_default_timezone_set("Europe/Berlin");
    $conn = new mysqli('database','event','secret','eventano', 3306);
    $conn->set_charset('utf8');
