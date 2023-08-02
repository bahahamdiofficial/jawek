<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    header("location:index.php");
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
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <link rel="stylesheet" href="<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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

        <form action="process-signup.php" method="post" id="signup" class="register-form" novalidate>
            <input type="text" id="name" name="name" placeholder="Nom Complet">
            <input type="text" id="username" name="username" placeholder="Nom d'utilisateur">
            <input type="tel" id="phone" name="phone" placeholder="Numéro de tél">
            <input type="email" id="email" name="email" placeholder="Adresse email">
            <input type="password" id="password" name="password" placeholder="Nouveau mot de passe">
            <!-- <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe"> -->
            <button type="submit">S’inscrire</button>
        </form>
        <div class="new-signup ">
            <span></span><a class="signup-link"  href="Connexion.php">Vous avez déjà un compte ?</a>
            </div>
    </div>
    </center>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    
</body>
</html>