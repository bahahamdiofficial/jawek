<?php

session_start();

include "./database.php";

$error = "";

if (isset($_SESSION["user_id"])) {


    $sql = "SELECT * FROM user
            WHERE id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("id", $_SESSION["user_id"]);

    $stmt->execute();

    $user = $stmt->fetch();

    header("location: ./index.php");
}


if (isset($_POST["signup"])) {



    if (!empty($_POST["name"])) {
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            if (strlen($_POST["password"]) > 8) {

                if (preg_match("/[a-z]/i", $_POST["password"])) {

                    if (preg_match("/[0-9]/", $_POST["password"])) {

                        $name = $_POST["name"];
                        $username = $_POST["username"];
                        $phone = $_POST["phone"];
                        $email = $_POST["email"];
                        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);


                        $sql = "SELECT * FROM user
                                WHERE email = :email
                                ";

                        $stmt = $conn->prepare($sql);

                        $stmt->bindParam("email", $email);

                        $stmt->execute();

                        if ($stmt->rowCount() == 0) {
                            $sql = "INSERT INTO user 
                                SET 
                                name = :name ,
                                username = :username ,
                                phone = :phone ,
                                email = :email ,
                                password_hash = :password";

                            $stmt = $conn->prepare($sql);

                            $stmt->bindParam("name", $name);
                            $stmt->bindParam("username", $username);
                            $stmt->bindParam("phone", $phone);
                            $stmt->bindParam("email", $email);
                            $stmt->bindParam("password", $password);

                            if ($stmt->execute()) {

                                header("location: ./connexion.php");
                            } else {

                                header("location: ./inscription.php?error=Impossible de vous inscrire");
                            }
                        } else {

                            header("location: ./inscription.php?error=Un compte avec cette adresse e-mail existe déjà");
                        }
                    } else {

                        $error = "Le mot de passe doit contenir au moins un chiffre";
                    }
                } else {
                    $error = "Le mot de passe doit contenir au moins une lettre";
                }
            } else {

                $error = "Le mot de passe doit contenir au moins une lettre";
            }
        } else {

            $error = "L'adresse email est requise";
        }
    } else {
        $error = "Le nom est obligatoire";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawek.tn | Site vente et achat en ligne tunisie </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <link rel="stylesheet" href="<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="/js/validation.js" defer></script>


</head>

<body class="body_back">
    <header1>
        <a href="index.php">
            <img src="Photos/logos/logo.png" alt="" class="logo_cc">
        </a>

    </header1>

    <center>
        <div class="register-card">
            <h2>Inscription</h2>
            <h3>Créer un nouveau compte</h3>

            <?php if (!empty($error)) : ?>

                <div style="margin-bottom: 10px;" class="note error">
                    <span class="material-symbols-outlined">error</span>
                    <?php echo $error ?>
                </div>

            <?php endif ?>

            <form action="inscription.php" method="post" id="signup" class="register-form" novalidate>
                <input type="text" id="name" name="name" placeholder="Nom Complet">
                <input type="text" id="username" name="username" placeholder="Nom d'utilisateur">
                <input type="tel" id="phone" name="phone" placeholder="Numéro de tél">
                <input type="email" id="email" name="email" placeholder="Adresse email">
                <input type="password" id="password" name="password" placeholder="Mot de passe">
                <!-- <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe"> -->
                <button name="signup" type="submit">S’inscrire</button>
            </form>
            <div class="new-signup ">
                <span></span><a class="signup-link" href="connexion.php">Vous avez déjà un compte ?</a>
            </div>
        </div>
    </center>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>


</body>

</html>