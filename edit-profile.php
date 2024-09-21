<?php

session_start();


include "./database.php";

if (isset($_SESSION["user_id"])) {

  $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

  $result = $conn->query($sql);

  $user = $result->fetch();
} else {

  header("location: ./connexion.php");
}


if (isset($_POST["update_profile"])) {

  $name = trim(htmlspecialchars($_POST["name"]));
  $username = trim(htmlspecialchars($_POST["username"]));
  $email = trim(htmlspecialchars($_POST["email"]));
  $phone = trim(htmlspecialchars($_POST["phone"]));
  $bio = trim(htmlspecialchars($_POST["bio"]));

  $user_id = trim(htmlspecialchars($_POST["user_id"]));



  $sql = "UPDATE user 
          SET 
          name = :name,
          username = :username,
          email=  :email ,
          phone = :phone,
          bio = :bio
          WHERE 
          id = :user_id
          ";

  $stmt =  $conn->prepare($sql);

  $stmt->bindParam("name", $name);
  $stmt->bindParam("username", $username);
  $stmt->bindParam("email", $email);
  $stmt->bindParam("phone", $phone);
  $stmt->bindParam("bio", $bio);

  $stmt->bindParam("user_id", $user_id);

  if ($stmt->execute()) {

    if (updateProfilePic($_FILES["profile_pic"], $_POST["user_id"]) != false) {

      if ($_POST["prev_image"] != "default_profile.jpg") {

        if (file_exists("./Photos/" . $_POST["prev_image"])) {
          unlink("./Photos/" . $_POST["prev_image"]);
        }
      }


      header("location: ./edit-profile.php?success=Mise à jour du profil réussie");
    }

    header("location: ./edit-profile.php?success=Mise à jour du profil réussie");
  } else {

    header("location: ./edit-profile.php?error=impossible de mettre à jour le profil");
  }
}

if (isset($_POST["update_password"])) {

  $new_password = trim(htmlspecialchars($_POST["new_password"]));

  $old_password = trim(htmlspecialchars($_POST["old_password"]));

  $repeat_password = trim(htmlspecialchars($_POST["repeat_password"]));

  $user_id = trim(htmlspecialchars($_POST["user_id"]));

  $sql = "SELECT * FROM user
          WHERE 
          id = :user_id";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam("user_id", $user_id);

  $stmt->execute();

  $password_hash = $stmt->fetch()->password_hash;

  if (password_verify($old_password, $password_hash)) {

    if ($new_password == $repeat_password) {
      $sql = "UPDATE user 
          SET 
          password_hash = :password
          WHERE 
          id = :user_id";

      $stmt = $conn->prepare($sql);

      $stmt->bindParam("password", password_hash($new_password, PASSWORD_DEFAULT));
      $stmt->bindParam("user_id", $user_id);

      if ($stmt->execute()) {

        header("location: ./edit-profile.php?success=Mot de passe mis à jour");
      } else {
        header("location: ./edit-profile.php?error=Impossible de mettre à jour le mot de passe");
      }
    } else {
      header("location: ./edit-profile.php?error=Les mots de passe ne correspondent pas");
    }
  } else {
    header("location: ./edit-profile.php?error=Mot de passe incorrect");
  }
}




function updateProfilePic($profile_pic, $user_id)
{

  if (!empty($profile_pic)) {

    $fileExt = explode(".", $profile_pic["name"]);
    // MAKE SURE THE EXTENSION IS ALWAYS LOWER CASE
    $fileActualExt = strtolower(end($fileExt));

    $newFileName     = random_int(100000, 100000000) . "." . $fileActualExt;
    $fileDestination = "./Photos/" . $newFileName;



    if (move_uploaded_file($profile_pic["tmp_name"], $fileDestination)) {


      include "./database.php";

      $sql = "UPDATE user 
            SET 
            profile_pic = :profile_pic
            WHERE 
            id = :user_id";

      $stmt = $conn->prepare($sql);

      $stmt->bindParam("profile_pic", $newFileName);

      $stmt->bindParam("user_id", $user_id);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
    }
  } else {
    return false;
  }
}

if (isset($_POST["submit_identity"])) {

  $fileExt = explode(".", $_FILES["identity_document"]["name"]);
  // MAKE SURE THE EXTENSION IS ALWAYS LOWER CASE
  $fileActualExt = strtolower(end($fileExt));

  $newFileName     = random_int(100000, 100000000) . "." . $fileActualExt;
  $fileDestination = "./Photos/ids/" . $newFileName;



  if (move_uploaded_file($_FILES["identity_document"]["tmp_name"], $fileDestination)) {

    $identity_id = rand(100000, 999999);

    $user_id = $_SESSION["user_id"];

    $sql = "INSERT INTO 
            identity_confirmation 
            SET 
            identity_id = :identity_id,
            user_id = :user_id,
            document_image = :document_image,
            date_posted = NOW()";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("identity_id", $identity_id);

    $stmt->bindParam("user_id", $user_id);

    $stmt->bindParam("document_image", $newFileName);

    if ($stmt->execute()) {

      header("location: ./edit-profile.php?success=pièce d'identité reçue");
    } else {

      header("location: ./edit-profile.php?error=impossible de recevoir une pièce d'identité");
    }
  }
}

function fetchIdentity($user_id)
{

  include "./database.php";


  $sql = "SELECT * FROM identity_confirmation 
          WHERE user_id = :user_id";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam("user_id", $user_id);

  $stmt->execute();

  if ($stmt->rowCount() == 1) {
    return $stmt->fetch();
  } else {
    return false;
  }
}

?>

<?php include "./inc/tmbl/header.php" ?>

<link rel="stylesheet" href="./css/edit-profile.css">

<body style="background-color: #f6f5f7;">




  <section class="container-edit">
    <div class="side-nav">
      <a href="" data-section="profile-edit"><h3>Modifier le profil</h3></a>
      <a href="" data-section="password-edit"><h3>Modifier le mot de passe</h3></a>
      <a href="" data-section="identity-confirmation"><h3>Confirmation d'identité</h3></a>
    </div>

    <div class="inline-section  profile-edit active">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

        <div class="title">Modifier profil</div>

        <div class="input_field">
          <label>Modifier la photo de profil</label>
          <input type="file" name="profile_pic" class="input" value="Ajouter des photos">
          <input type="hidden" name="prev_image" value="<?php echo $user->profile_pic ?>">
          <input type="hidden" name="user_id" value="<?php echo $user->id ?>">
          <label>Image de profil actuelle</label>
          <div class="prev-img">
            <img src="./Photos/<?php echo $user->profile_pic ?>" alt="">
          </div>
        </div>

        <div class="input_field">
          <label>Nom</label>
          <input type="text" value="<?php echo $user->name ?>" class="input" name="name">
        </div>

        <div class="input_field">
          <label>Nom d'utilisateur</label>
          <input type="text" value="<?php echo $user->username ?>" class="input" name="username">
        </div>

        <div class="input_field">
          <label>Email</label>
          <input type="text" value="<?php echo $user->email ?>" class="input" name="email">
        </div>

        <div class="input_field">
          <label>Numéro de tél</label>
          <input type="phone" value="<?php echo $user->phone ?>" class="input" name="phone" placeholder="+216 ">
        </div>

        <div class="input_field">
          <label>Bio</label>
          <textarea name="bio" id="Description" cols="30" rows="10"><?php echo $user->bio ?></textarea>
        </div>



        <div class="input_field">
          <input type="submit" name="update_profile" value="Envoyer" class="btn-create">
        </div>

      </form>
    </div>

    <div class="inline-section password-edit">
      <form action="edit-profile.php" method="post">
        <div class="title">Mettre à jour le mot de passe</div>


        <div class="input_field">
          <label>Ancien mot de passe</label>
          <input type="hidden" name="user_id" value="<?php echo $user->id ?>">

          <input type="password" name="old_password">
        </div>
        <div class="input_field">
          <label>Nouveau mot de passe</label>
          <input type="hidden" name="user_id" value="<?php echo $user->id ?>">

          <input type="password" name="new_password">
        </div>
        <div class="input_field">
          <label>Retapez Nouveau mot de passe</label>
          <input type="hidden" name="user_id" value="<?php echo $user->id ?>">
          <input type="password" name="repeat_password">
        </div>

        <div class="input_field">
          <input type="submit" name="update_password" value="Envoyer" class="btn-create">
        </div>
      </form>
    </div>

    <div class="inline-section identity-confirmation">
      <?php if (fetchIdentity($_SESSION["user_id"]) != false) : ?>

        <?php if (fetchIdentity($_SESSION["user_id"])->is_verified == true) : ?>

          <div class="note success">
            <span class="material-symbols-outlined">
              done
            </span>

            Votre compte a été vérifié
          </div>

        <?php else : ?>

          <div class="note warning">
            <span class="material-symbols-outlined">
              pending
            </span>

            Vérification de l'identité en cours d'examen

          </div>


        <?php endif ?>

      <?php else : ?>

        <form action="edit-profile.php" method="post" enctype="multipart/form-data">
          <div class="title">Confirmation d'identité</div>


          <div class="input_field">

            <label>Copie de votre Passeport, Carte nationale d'identité ou Permis de conduire</label>
            <input type="hidden" name="user_id" value="<?php echo $user->id ?>">
            <input type="file" name="identity_document">

          </div>

          <div class="input_field">
            <input type="submit" name="submit_identity" value="Soumettre votre identitér" class="btn-create">
          </div>
        </form>

      <?php endif ?>
    </div>

  </section>
  <script src="./libraries/notiflix/dist/notiflix-aio-3.2.5.min.js"></script>
  <script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    if (urlParams.get("error") != "" && urlParams.get("error") != null) {

      Notiflix.Notify.failure(urlParams.get("error"))

    }
    if (urlParams.get("success") != "" && urlParams.get("success") != null) {

      Notiflix.Notify.success(urlParams.get("success"))

    }
  </script>
  <script src="./js/edit-profile.js"></script>
  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
      subMenu.classList.toggle("open-menu");
    }
  </script>
</body>

</html>