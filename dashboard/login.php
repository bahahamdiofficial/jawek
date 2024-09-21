<?php

include_once "./includes/db.php";

session_start();

// echo password_hash(123, PASSWORD_DEFAULT);

if (isset($_POST["login"])) {


    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);


    $sql = "SELECT * FROM admin WHERE email = :email";

    $stmt =  $conn->prepare($sql);

    $stmt->bindParam("email", $email);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        $admin = $stmt->fetch();

        if (password_verify($password, $admin->password)) {

            $_SESSION["admin_id"] = $admin->id;

            $_SESSION["admin_name"] = $admin->full_name;

            header("location: ./index.php");
        } else {
            header("location: ./login.php?error=Wrong email or password");
        }
    } else {
        header("location: ./login.php?error=Wrong email or password");
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="Photos/icons/favicon.png">
    <meta property="og:url" content="https://www.jawek.tn/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="./css/master.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Dashboard | Admin</title>
</head>

<body>
    

    <section class="login">
        <form action="login.php" method="post">
            <div class="form-heading">
                <div class="logo">
                    <img src="./img/logo-alt.png" alt="">
                </div>
                <h3>Entrez vos données d'identification</h3>
            </div>
            <div class="input-group">

                <input type="text" name="email" placeholder="Adresse email professionnelle" required>
            </div>
            <div class="input-group">

                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <button name="login">Se connecter</button>
        </form>
    </section>


    <script src="./libraries/notiflix/dist/notiflix-aio-3.2.5.min.js"></script>

    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);


        if (urlParams.get("error") != "" && urlParams.get("error") != null) {

            Notiflix.Notify.failure(urlParams.get("error"))

        }
    </script>

</body>

</html>