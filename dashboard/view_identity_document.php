<?php include "./includes/header-start.php" ?>

<link rel="stylesheet" href="./css/identity.css">
<?php include "./includes/header-end.php" ?>

<?php

include "./includes/db.php";


if (isset($_GET["verify_identity"]) && isset($_GET["identity"])) {

    $sql = "UPDATE identity_confirmation 
            SET 
            is_verified = 1 
            WHERE  
            identity_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("id", $_GET["identity"]);

    if ($stmt->execute()) {

        header("location: ./verification_requests?success=Identity verified");
    } else {

        header("location: ./verification_requests?error=Unable to verify Identity ");
    }
}
if (isset($_GET["revoke_verification"]) && isset($_GET["identity"])) {

    $sql = "UPDATE identity_confirmation 
            SET 
            is_verified = 0 
            WHERE  
            identity_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("id", $_GET["identity"]);

    if ($stmt->execute()) {

        header("location: ./view_identity_document?identity=" . $_GET["identity"] .  "&success=Identity revoked");
    } else {

        header("location: ./view_identity_document?identity=" . $_GET["identity"] .  "&error=Unable to revoke Identity ");
    }
}

function fetchRequest($identity_id)
{
    include "./includes/db.php";

    $sql = "SELECT * FROM identity_confirmation ic 
        LEFT JOIN user u 
        on ic.user_id = u.id
        WHERE 
        identity_id = :identity_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("identity_id", $identity_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        return $stmt->fetch();
    } else {
        return false;
    }
}

?>


<?php if (isset($_GET["identity"])) : ?>

    <?php if (fetchRequest($_GET["identity"])) :

        $request = fetchRequest($_GET["identity"]);

    ?>

        <div class="heading">
            <h1>Document d'identité</h1>

            <a href="./verification_requests" class="back-btn">Retour</a>
        </div>

        <div class="identity-container">
            <div class="actions">
                <?php if ($request->is_verified) :  ?>

                    <a class="revoke" href="./view_identity_document?revoke_verification&identity=<?php echo $request->identity_id ?>">
                        <span class="material-symbols-outlined">
                            close
                        </span>

                        Annuler la vérification
                    </a>

                <?php else : ?>

                    <a class="verify" href="./view_identity_document?verify_identity&identity=<?php echo $request->identity_id ?>">
                        <span class="material-symbols-outlined">
                            task_alt
                        </span>

                        Vérifier
                    </a>
                <?php endif ?>
            </div>
            <div class="identity-img">
                <img src="https://jawek.tn/Photos/ids/<?php echo $request->document_image ?>" alt="">
            </div>

            <div class="identity-info">
                <div class="info">
                    <div class="title">Nom de l'utilisateur</div>
                    <div class="content"><?php echo $request->name ?></div>
                </div>
                <div class="info">
                    <div class="title">Date d'envoi</div>
                    <div class="content"><?php echo $request->date_posted ?></div>
                </div>
            </div>
        </div>

    <?php else : ?>

        <div class="note error">
            <span class="material-symbols-outlined">
                error
            </span>
            Identité introuvable <a href="./verification_requests">Retour</a>
        </div>

    <?php endif ?>


<?php else : ?>

    <div class="note error">
        <span class="material-symbols-outlined">
            error
        </span>
        Veuillez choisir une <a href="./verification_requests">identity</a> pour continuer
    </div>

<?php endif ?>

<?php include "./includes/footer-start.php" ?>
<?php include "./includes/footer-end.php" ?>