<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email OR username = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}


?>
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
    <title>Mot de passe oublié | Jawek.tn </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../Photos/icons/icon.png">
    <link rel="stylesheet" href="<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
</head>
<body class="body_back">
    <header1>
        <a href="../index.php">
            <img src="../Photos/logos/logo.png" alt="" class="logo_cc">
        </a>
        
    </header1>



    <center>
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
            <div class="login-card">
                <h2>Trouvez votre compte</h2>
                <h3>Veuillez entrer votre adresse e-mail ou votre numéro de mobile pour rechercher votre compte.</h3>

                <form action="process-code.php" method="post" class="login-form">
                    <input type="text" name="email" id="email" placeholder="Adresse email ou numéro de mobile" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
                    <button type="submit" id="submit">Rechercher</button>
                    
                </form>
                <div class="new-signup ">
                    <span>Annuler </span><a class="signup-link"  href="../connexion.php">cliquez ici</a>
                    </div>
            </div>
</center>

</body>
</html>