<?php

        require_once("./connect.php");

        $searchq = $POST_['search'];
        echo 1;
        echo $searchq;
        echo 2;
        $result = $conn->query("SELECT * FROM events WHERE name LIKE '%$searchq%' OR description LIKE '%$searchq%'") or die("could not search");

            while($row = $result->fetch_assoc()) {
                $name = $row['name'];
                $description = $row['description'];
                $photo_path = "../static/img/".$row['photo_path'];
                
                
      
                    echo "<div class='col-4 mb-3' >
                            <div class='card'>
                                <div class='card-header'>
                                <img class='card-img-top' src='./static/img/{$row['photo_path']}'>
                                        <div class='card-body'>
                                            <h5 class='card-title'> 
                                                {$row['name']}
                                            </h5>
                                            <p class='card-text'>
                                                {$row['description']}
                                            </p>
                                        </div>
                                </div>
                            </div>
                         </div>";

                
            
        }
    

?>