<?php

$host = "localhost";
$user = "root";
$password = "";
$dbName = "login_db";

$dsn = "mysql:host=$host;dbname=$dbName";

$conn = new PDO($dsn, $user, $password);

$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

if (isset($_POST["fetch_subcategories"])) {


    $sql = "SELECT * FROM subcategory 
                WHERE 
                con_id = :id
                ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("id", $_POST["id"]);

    $stmt->execute();


    if ($stmt->rowCount() >= 1) {

        echo json_encode($stmt->fetchAll());
    } else {
        echo json_encode(false);
    }
}


if (isset($_POST["fetch_city"])) {


    $sql = "SELECT * FROM city 
            WHERE 
            loc_id = :loc_id
            AND
            name IS NOT NULL
            ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("loc_id", $_POST["loc_id"]);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        echo json_encode($stmt->fetchAll());
    } else {
        echo json_encode(false);
    }
}
