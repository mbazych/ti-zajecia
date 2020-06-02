<?php  
    $polacz = new mysqli('localhost','root','','cdv_ti');

    if($polacz)
     echo "polaczenie z baza";
     else
     echo "polaczenie z baza nie udane";
?>