<?php

$is_invalid = false;

session_start();


include_once "./database.php";

if (isset($_POST["login"])) {

    $email = trim(htmlspecialchars($_POST["email"]));
    $password = trim(htmlspecialchars($_POST["password"]));


    $sql = "SELECT * FROM user
                    WHERE email = :email ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("email", $email);

    $stmt->execute();

    if ($stmt->rowCount() == 1) {


        $user = $stmt->fetch();

        if ($user->is_active) {
            if (password_verify($password, $user->password_hash)) {

                session_regenerate_id();

                $_SESSION["user_id"] = $user->id;

                header("Location: index.php");
                exit;
            } else {
                $is_invalid = true;
            }
        } else {
            $is_invalid = true;
        }
    } else {
        $is_invalid = true;
    }
}


?>
<?php


if (isset($_SESSION["user_id"])) {


    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $conn->query($sql);

    $user = $result->fetch();

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
    <link rel="stylesheet" href="<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

</head>

<body class="body_back">
    <header1>
        <a href="index.php">
            <img src="Photos/logos/logo.png" alt="" class="logo_cc">
        </a>

    </header1>



    <center   margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;>
        <?php if ($is_invalid) : ?>
            <em style=" color: red;">Invalid login</em>
        <?php endif; ?>
        <div class="login-card">
            <h2>Connexion</h2>
            <h3>Entrez vos données d'identification</h3>

            <form method="post" class="login-form">
                <input type="text" name="email" id="email" placeholder="Adresse email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
                <a href="connexion/identify.php">Mot de passe oublié ?</a>
                <button type="submit" name="login" id="submit">Se connecter</button>

            </form>
            <div class="new-signup ">
                <span>Pas encore membre ?</span><a class="signup-link" href="inscription.php">cliquez ici</a>
            </div>
        </div>
    </center>

</body>

</html>