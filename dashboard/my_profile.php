<?php

include "./includes/header-start.php";
if (isset($_POST["update_profile"])) {

    $full_name = trim($_POST["full_name"]);

    $email = trim($_POST["email"]);
    $admin_id = trim($_POST["admin_id"]);

    $sql = "UPDATE admin SET full_name = :full_name,  email = :email WHERE id = :admin_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("full_name", $full_name);
    $stmt->bindParam("email", $email);
    $stmt->bindParam("admin_id", $admin_id);

    if ($stmt->execute()) {
        header("location: ./my_profile.php?success=Information updated");
    } else {
        header("location: ./my_profile.php?error=Unable to update information");
    }
}
if (isset($_POST["update_password"])) {

    $password = trim($_POST["password"]);
    $admin_id = trim($_POST["admin_id"]);

    $sql = "UPDATE admin SET password = :password  WHERE id = :admin_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("password", password_hash($password, PASSWORD_DEFAULT));
    $stmt->bindParam("admin_id", $admin_id);

    if ($stmt->execute()) {
        header("location: ./my_profile.php?success=Password updated");
    } else {
        header("location: ./my_profile.php?error=Unable to update password");
    }
}



?>

<link rel="stylesheet" href="./css/my_profile.css">

<?php include "./includes/header-end.php" ?>

<?php if (isset($_SESSION["admin_id"])) :
    $sql =  "SELECT * FROM admin WHERE id = :admin_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("admin_id", $_SESSION["admin_id"]);

    $stmt->execute();

    $admin = $stmt->fetch();
?>
    <div class="form-container">



        <form action="my_profile.php" class="acc-info-form" method="post">
            <h3>update your profile</h3>
            <div class="input-group">
                <label>First name</label>
                <input type="text" name="full_name" value="<?php echo $admin->full_name  ?>" id="first-name">
                <input type="hidden" name="admin_id" value="<?php echo $admin->id  ?>">

            </div>


            <div class="input-group">
                <label>Email</label>
                <input type="text" value="<?php echo $admin->email  ?>" name="email">
            </div>
            <button class="submit-btn" name="update_profile">Update profile</button>
        </form>
        <form action="my_profile.php" class="password-form" method="post">
            <h3>update your password</h3>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
                <input type="hidden" name="admin_id" value="<?php echo $admin->id  ?>">
            </div>
            <div class="input-group">
                <label>Repeat Password</label>
                <input type="password" name="password_repeat">
            </div>
            <button class="submit-password-btn" name="update_password">Update password</button>
        </form>
    </div>
<?php else : ?>

    <div class="note error">
        <span class="material-symbols-outlined">
            warning
        </span>

        Please <a href="./login">Login</a> to continue
    </div>

<?php endif ?>

<?php include "./includes/footer-start.php" ?>

<script>
    let submitBtn = document.querySelector(".submit-btn");
    let registerForm = document.querySelector(".acc-info-form")


    submitBtn.addEventListener("click", (e) => {

        let firstName = registerForm.elements["first_name"].value
        let lastName = registerForm.elements["last_name"].value
        let email = registerForm.elements["email"].value


        if (firstName == "") {

            Notiflix.Notify.failure("First name is empty")
            e.preventDefault()


        } else if (lastName == "") {

            Notiflix.Notify.failure("Last name is empty")
            e.preventDefault()


        } else if (email == "") {

            Notiflix.Notify.failure("Email is empty")
            e.preventDefault()


        } else if (password == "") {

            Notiflix.Notify.failure("Password is empty")
            e.preventDefault()


        } else if (password != passwordRepeat) {

            Notiflix.Notify.failure("Passwords do not match")
            e.preventDefault()


        }

    })

    let submitPasswordBtn = document.querySelector(".submit-password-btn");
    let passwordForm = document.querySelector(".password-form")



    submitPasswordBtn.addEventListener("click", (e) => {


        let password = passwordForm.elements["password"].value
        let passwordRepeat = passwordForm.elements["password_repeat"].value
        if (password == "") {

            Notiflix.Notify.failure("Password is empty")
            e.preventDefault()


        } else if (password != passwordRepeat) {

            Notiflix.Notify.failure("Passwords do not match")
            e.preventDefault()


        }

    })
</script>

<?php include "./includes/footer-end.php" ?>