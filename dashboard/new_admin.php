<?php include "./includes/header-start.php";



if (isset($_POST["add_admin"])) {

    $id = rand(100000, 999999);
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);


    $sql = "SELECT * FROM admin WHERE email = :email";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("email", $email);

    $stmt->execute();

    if ($stmt->rowCount() == 0) {



        $sql = "INSERT INTO admin(id, full_name, email, password) VALUES(:id, :full_name, :email, :password)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam("id", $id);
        $stmt->bindParam("full_name", $full_name);
        $stmt->bindParam("email", $email);
        $stmt->bindParam("password", password_hash($password, PASSWORD_DEFAULT));

        if ($stmt->execute()) {


            header("location: ./new_admin.php?success=Admin registered successfully");
        } else {

            header("location: ./new_admin.php?error=unable to register admin");
        }
    } else {
        header("location: ./new_admin.php?error=Admin already exists");
    }
}


?>
<?php include "./includes/header-end.php" ?>

<div class="heading">
    <h2>Nouvel administrateur</h2>
    <!--<a href="./manage_admins.php" class="back-btn">Manage admins</a>-->
</div>

<form action="new_admin.php" class="register-form" method="post">
    <h3>Entrez les informations</h3>
    <div class="input-group">
        <label>Nom</label>
        <input type="text" name="full_name">
    </div>
    <div class="input-group">
        <label>Adresse email professionnelle</label>
        <input type="text" name="email">
    </div>
    <div class="form-group">
        <div class="input-group">
            <label>Mot de passe</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <label>Répéter le mot de passe</label>
            <input type="password" name="password_repeat">
        </div>
    </div>

    <button class="submit-btn" name="add_admin">Ajouter</button>
</form>

<?php include "./includes/footer-start.php" ?>


<script>
    let submitBtn = document.querySelector(".submit-btn");
    let registerForm = document.querySelector(".register-form")

    submitBtn.addEventListener("click", (e) => {


        let firstName = registerForm.elements["first_name"].value
        let lastName = registerForm.elements["last_name"].value
        let email = registerForm.elements["email"].value
        let password = registerForm.elements["password"].value
        let passwordRepeat = registerForm.elements["password_repeat"].value

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
</script>

<?php include "./includes/footer-end.php" ?>