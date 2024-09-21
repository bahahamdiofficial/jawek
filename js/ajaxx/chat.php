<?php


include "../database.php";

if (isset($_POST["fetch_user"])) {

    $sql = "SELECT * FROM user where id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("user_id", $_POST["user_id"]);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        echo json_encode($stmt->fetch());
    } else {
        echo json_encode(false);
    }
}



if (isset($_POST["fetch_chats"])) {



    $sql = "SELECT *
            FROM messages m 
            LEFT JOIN products p 
            ON m.product_id = p.product_id
            WHERE
            from_user = :from_user 
            AND 
            to_user = :to_user

            OR 

            from_user = :to_user
            AND 
            to_user = :from_user

            ORDER BY time_sent DESC
             ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("from_user", $_POST["id_1"]);

    $stmt->bindParam("to_user", $_POST["id_2"]);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        echo json_encode($stmt->fetchAll());
    } else {

        echo json_encode($stmt->fetchAll());
    }
}




if (isset($_POST["post_message"])) {
    $sql = "INSERT INTO messages 
            SET 
            from_user = :from_id,
            to_user = :to_id,
            msg = :message,
            product_id = :product_id, 
            time_sent = NOW()";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("from_id", $_POST["from_id"]);
    $stmt->bindParam("to_id", $_POST["to_id"]);
    $stmt->bindParam("message", $_POST["message"]);
    $stmt->bindParam("product_id", $_POST["product_id"]);

    if ($stmt->execute()) {

        echo json_encode(fetchMessage($conn->lastInsertId()));
    } else {
        json_encode(false);
    }
}

function fetchMessage($message_id)
{

    include "../database.php";


    $sql = "SELECT * FROM messages m 
            LEFT JOIN products p 
            ON 
            m.product_id = p.product_id 
            LEFT JOIN product_images pi 
            ON p.product_id = pi.product_id
            where msg_id = :message_id

            LIMIT 1
            ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("message_id", $message_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        return $stmt->fetch();
    } else {
        return false;
    }
}
