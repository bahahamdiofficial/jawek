<?php include "./includes/header-start.php" ?>
<?php include "./includes/header-end.php" ?>

<?php

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

        header("location: ./verification_requests?success=Identity revoked");
    } else {

        header("location: ./verification_requests?error=Unable to revoke Identity ");
    }
}



function fetchRequests()
{
    include "./includes/db.php";

    $sql = "SELECT * FROM identity_confirmation ic 
        LEFT JOIN user u 
        on ic.user_id = u.id
        ORDER BY
        is_verified = 1
        ASC";

    $stmt = $conn->query($sql);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll();
    } else {
        return false;
    }
}

?>


<div class="heading">
    <h1>Verification Requests</h1>



</div>

<?php if (fetchRequests() != false) :
    $requests = fetchRequests()
?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nom du membre</th>
                    <th>Document d'identité</th>
                    <th>Date d'envoi</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <?php foreach ($requests as $request) : ?>

                <tr>
                    <td><?php echo $request->name ?></td>
                    <td>
                        <a href="./view_identity_document?identity=<?php echo $request->identity_id ?>" class="view">
                            <span class="material-symbols-outlined">
                                visibility
                            </span>
                            Voir l'image d'identification
                        </a>
                    </td>
                    <td><?php echo $request->date_posted ?></td>

                    <td>
                        <div class="table-actions">
                            <div class="label">
                                <span class="material-symbols-outlined expand">
                                    expand_more
                                </span>
                                actions
                            </div>

                            <div class="drop-down">
                                <?php if ($request->is_verified) : ?>

                                    <a href="./view_identity_document?revoke_verification&identity=<?php echo $request->identity_id ?>">
                                        <span class="material-symbols-outlined">
                                            close
                                        </span>

                                        Annuler la vérification
                                    </a>

                                <?php else : ?>

                                    <a href="./verification_requests?verify_identity&identity=<?php echo $request->identity_id ?>">
                                        <span class="material-symbols-outlined">
                                            task_alt
                                        </span>

                                        Vérifiez
                                    </a>

                                <?php endif ?>
                            </div>
                        </div>
                    </td>
                </tr>

            <?php endforeach ?>
        </table>
    </div>
<?php else : ?>

    <div class="note error">
        <span class="material-symbols-outlined">
            warning
        </span>
        Vous avez 0 demande de confirmation d'identité
    </div>

<?php endif ?>


<?php include "./includes/footer-start.php" ?>

<script src="./js/table_actions.js"></script>

<?php include "./includes/footer-end.php" ?>