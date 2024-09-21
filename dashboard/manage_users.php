<?php include "./includes/header-start.php";

include "./includes/db.php";

$users = [];

$sql  = "SELECT * FROM user";

$stmt = $conn->prepare($sql);

$stmt->execute();

if ($stmt->rowCount() >= 1) {
    $users = $stmt->fetchAll();
}


if (isset($_GET["activate"]) && isset($_GET["user"])) {


    $sql = "UPDATE user 
            SET is_active = 1
            WHERE 
            id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("user_id", $_GET["user"]);

    if ($stmt->execute()) {

        header("location: ./manage_users?success=User activated");
    } else {
        header("location: ./manage_users?error=Unable to activate user");
    }
}

if (isset($_GET["deactivate"]) && isset($_GET["user"])) {


    $sql = "UPDATE user 
            SET is_active = 0
            WHERE 
            id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("user_id", $_GET["user"]);

    if ($stmt->execute()) {

        header("location: ./manage_users?success=User deactivated");
    } else {
        header("location: ./manage_users?error=Unable to deactivate user");
    }
}





if (isset($_GET["delete_user"]) && isset($_GET["user"])) {

    $sql = "DELETE FROM user WHERE id = :user_id";

    $stmt =  $conn->prepare($sql);

    $stmt->bindParam("user_id", $_GET["user"]);

    if ($stmt->execute()) {

        header("location: ./manage_users.php?success=User deleted");
    } else {

        header("location: ./manage_users.php?error=Unable to delete user");
    }
}


?>
<?php include "./includes/header-end.php" ?>


<?php if (count($users) >= 1) { ?>

    <div class="heading">
        <h1>Users</h1>
    </div>

    <div class="table-container">
        <table>
            <caption>
                Viewing <?php echo count($users)  ?> users
            </caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Names</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>


                <?php $index = 1;
                foreach ($users as $user) : ?>

                    <tr>
                        <td><?php echo $index  ?></td>
                        <td><?php echo $user->name ?></td>
                        <td><?php echo $user->email ?></td>
                        <th>
                            <?php if ($user->is_active) : ?>
                                <span class="clr-green">Active</span>
                            <?php else : ?>
                                <span class="clr-red">Inactive</span>
                            <?php endif ?>
                        </th>
                        <td>
                            <div class="table-actions">
                                <div class="label">
                                    <span class="material-symbols-outlined expand">
                                        expand_more
                                    </span>
                                    actions
                                </div>

                                <div class="drop-down">
                                    <?php if ($user->is_active) : ?>

                                        <a href="./manage_users.php?deactivate&user=<?php echo $user->id ?>">
                                            <span class="material-symbols-outlined">
                                                toggle_off
                                            </span>
                                            Deactivate user
                                        </a>

                                    <?php else : ?>

                                        <a href="./manage_users.php?activate&user=<?php echo $user->id ?>">
                                            <span class="material-symbols-outlined">
                                                toggle_on
                                            </span>
                                            Activate user
                                        </a>

                                    <?php endif ?>
                                    <a href="./manage_users.php?delete_user&user=<?php echo $user->id ?>">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                        delete user
                                    </a>
                                </div>
                            </div>
                        </td>
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
        No user data available
    </div>
<?php } ?>


<?php include "./includes/footer-start.php" ?>

<script src="./js/table_actions.js"></script>

<?php include "./includes/footer-end.php" ?>;