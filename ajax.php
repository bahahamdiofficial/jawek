<?php

if(isset($_GET['category']) && !empty($_GET['category'])){
    include('database.php');

    $id = $_GET['category'];

    $query = "SELECT * FROM subcategory WHERE con_id='$id'";
    $do = mysqli_query($mysqli, $query);
    $count = mysqli_num_rows($do);

    if ($mysqli >0){
        while($row= mysqli_fetch_array($do)){
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }

    }else{
        echo '<option>Pas de sous-catégorie disponible</option>';
    }

    
}else{
    echo '<h1>Error</h1>';
}

?>