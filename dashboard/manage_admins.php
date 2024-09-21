<?php include "./includes/header-start.php";

$admin = [];

$sql  = "SELECT * FROM admin";

$stmt = $conn->prepare($sql);

$stmt->execute();

if ($stmt->rowCount() >= 1) {
    $admin = $stmt->fetchAll();
}



if (isset($_GET["delete_admin"]) && isset($_GET["admin_id"])) {

    $sql = "DELETE FROM admin WHERE id = :id";

    $stmt =  $conn->prepare($sql);

    $stmt->bindParam("id", $_GET["admin_id"]);

    if ($stmt->execute()) {

        header("location: ./manage_admins.php?success=Admin deleted");
    } else {

        header("location: ./manage_admins.php?error=Unable to delete admin");
    }
}


?>
<?php include "./includes/header-end.php" ?>


<?php if (count($admin) >= 1) { ?>

    <div class="heading">
        <h2>admin</h2>

        <a href="./new_admin.php" class="back-btn">Nouvel administrateur</a>
    </div>

    <div class="table-container">
        <table>
            <caption>
                Afficher <?php echo count($admin)  ?> admins
            </caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email Pro</th>
                    <!--<th>Actions</th>-->
                </tr>


                <?php $index = 1;
                foreach ($admin as $user) : ?>

                    <tr>
                        <td><?php echo $index  ?></td>
                        <td><?php echo $user->full_name ?></td>
                        <td><?php echo $user->email ?></td>
                        <!--<td>-->
                        <!--    <div class="table-actions">-->
                        <!--        <div class="label">-->
                        <!--            <span class="material-symbols-outlined expand">-->
                        <!--                expand_more-->
                        <!--            </span>-->
                        <!--            actions-->
                        <!--        </div>-->

                        <!--        <div class="drop-down">-->
                        <!--            <a href="./manage_admins.php?delete_admin&admin_id=<?php echo $user->id ?>">-->
                        <!--                <span class="material-symbols-outlined">-->
                        <!--                    delete-->
                        <!--                </span>-->
                        <!--                delete admin-->
                        <!--            </a>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</td>-->
                    </tr>

                <?php $index++;
                endforeach ?>

            </thead>
        </table>
    </div>


<?php } else { ?>
    <div class="note error">
        <span class="material-symbols-outlined">
            warning
        </span>
        Aucune donnée d'administration disponible
    </div>
<?php } ?>


<?php include "./includes/footer-start.php" ?>

<script src="./js/table_actions.js"></script>



<?php include "./includes/footer-end.php" ?>;