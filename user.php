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

if (isset($_POST["report_user"])) {

  $reasons = [];

  $reasons = $_POST["pre_options"];
  $user_id = $_POST["user_id"];

  if (!empty($reasons)) {

    for ($i = 0; $i < count($reasons); $i++) {

      $report_id = rand(100000, 999999);

      $sql = "INSERT INTO reported_users 
              SET 
              report_id = :report_id,
              user_id = :user_id,
              report = :report,
              date_reported = NOW() 
              ";

      $stmt = $conn->prepare($sql);
      $stmt->bindValue("report_id", $report_id);
      $stmt->bindValue("user_id", $user_id);
      $stmt->bindValue("report", $reasons[$i]);

      $stmt->execute();

      if ($i == count($reasons) - 1) {
        header("location: ./user.php?seller=" . $user_id . "success=le vendeur a signalé");
      } else {
        header("location: ./user.php?seller=" . $user_id . "error=Oops. Une erreur est survenue");
      }
    }
  }
}


if (isset($_GET["follow_seller"]) && isset($_GET["seller"])) {

  if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {

    $follow_id = rand(100000, 999999);

    $sql = "INSERT INTO followers
            SET 
            follow_id = :follow_id,
            seller = :seller ,
            followed_by = :followed_by,
            date_followed = NOW()";

    $stmt =  $conn->prepare($sql);

    $stmt->bindParam("follow_id", $follow_id);

    $stmt->bindParam("seller", trim(htmlspecialchars($_GET["seller"])));

    $stmt->bindParam("followed_by", $_SESSION["user_id"]);

    if ($stmt->execute()) {
      header("location: ./user.php?seller=" . $_GET["seller"] . "&success=Vendeur suivi");
    }
  } else {
    header("location: ./connexion.php");
  }
}

if (isset($_GET["unfollow_seller"]) && isset($_GET["seller"])) {

  if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {


    $sql = "DELETE FROM  followers
                WHERE 
                seller = :seller
                AND 
                followed_by=:followed_by ";

    $stmt =  $conn->prepare($sql);

    $stmt->bindParam("seller", trim(htmlspecialchars($_GET["seller"])));

    $stmt->bindParam("followed_by", $_SESSION["user_id"]);

    if ($stmt->execute()) {
      header("location: ./user.php?seller=" . $_GET["seller"] . "&success=Vous n'avez plus suivi ce vendeur");
    }
  } else {
    header("location: ./connexion.php");
  }
}



function fetchSeller($seller_id)
{

  include "./database.php";

  $sql = "SELECT * FROM user 
          WHERE 
          id = :seller_id";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam("seller_id", $seller_id);

  $stmt->execute();

  if ($stmt->rowCount() == 1) {

    return $stmt->fetch();
  } else {

    return false;
  }
}


function fetchFollow($seller_id, $user_id)
{

  include "./database.php";

  $sql = "SELECT * FROM followers 
            WHERE seller = :seller_id
            AND 
            followed_by = :user_id";


  $stmt = $conn->prepare($sql);

  $stmt->bindParam("seller_id", $seller_id);

  $stmt->bindParam("user_id", $user_id);

  $stmt->execute();

  if ($stmt->rowCount() >= 1) {

    return $stmt->fetch();
  } else {
    return false;
  }
}
function fetchFollowers($seller_id)
{

  include "./database.php";

  $sql = "SELECT * FROM followers 
            WHERE seller = :seller_id
            ";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam("seller_id", $seller_id);


  $stmt->execute();

  if ($stmt->rowCount() >= 1) {

    return $stmt->fetchAll();
  } else {
    return false;
  }
}



function fetchProducts($user_id)
{

  include "./database.php";


  $sql = "SELECT * FROM products
            WHERE 
            user_id = :user_id";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam("user_id", $user_id);

  $stmt->execute();

  if ($stmt->rowCount() >= 1) {

    return $stmt->fetchAll();
  } else {
    return false;
  }
}



function fetchProductImages($product_id)
{

  include "./database.php";


  $sql = "SELECT * FROM product_images 
            WHERE
            
            product_id = :product_id";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam("product_id", $product_id);

  $stmt->execute();


  $stmt->bindParam("product_id", $product_id);

  if ($stmt->rowCount() >= 1) {

    return $stmt->fetchAll();
  } else {
    return false;
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
<link rel="stylesheet" href="./css/user.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<body>

  <?php if (fetchSeller($_GET["seller"]) != false) :


    $seller  = fetchSeller($_GET["seller"]);

  ?>

    <div class="popup report-seller">
      <!--<div class="close-popup-btn">-->
      <!--  <span class="material-symbols-outlined">-->
      <!--    close-->
      <!--  </span>-->
      <!--</div>-->

      <div class="popup-container">
        <h2>Signaler</h2>
        <p>
          Pourquoi signalez-vous ce compte ?
        </p>

        <form action="user.php" method="post">
          <div class="check-group">
            <div class="pretty p-default">
              <input name="pre_options[]" value="Prohibited items" type="checkbox" />
              <div class="state p-primary">
                <label>Produits interdits</label>
              </div>
            </div>
            <div class="pretty p-default">
              <input name="pre_options[]" value="Nudity" type="checkbox" />
              <div class="state p-primary">
                <label>Nudité</label>
              </div>
            </div>
            <div class="pretty p-default">
              <input name="pre_options[]" value="Theft" type="checkbox" />
              <div class="state p-primary">
                <label>Vol</label>
              </div>
            </div>
          </div>
          <div class="input_field">
            <label>Décrivez le problème que vous rencontrez de la manière la plus détaillée possible afin que nous puissions le traiter au mieux.</label>
            <input type="hidden" name="user_id" id="user-id">
            <textarea name="pre_options[]" id="" cols="30" rows="10" placeholder="Description du problème"></textarea>
          </div>
          <!--<button name="report_user">Report User</button>-->
        </form>


        <div class="popup-btn-group">
          <a href="" class="cancel">Annuler</a>
          <a href="" class="continue">Signaler</a>
        </div>
      </div>
    </div>

    <div class="header__wrapper">
      <div class="cols__container">
        <div class="left__col">
          <div class="img__container">
            <img src="./Photos/<?php echo $seller->profile_pic ?>" alt="Image of <?php echo $seller->name ?> " />
            <span></span>
          </div>
          <h2><?= htmlspecialchars($seller->name) ?>

            <?php if (fetchIdentity($seller->id) != false && fetchIdentity($seller->id)->is_verified) : ?>

              <i class="fa-solid fa-circle-check" style="   font-size: 16px;  color: #0093ff; top: 3px;"></i>
            <?php endif ?>
          </h2>


          <p><?php echo $seller->bio != null ?  $seller->bio : "Welcome to my bio" ?></p>

          <div class="info-nbr">

            <div class="nbr-follow">
              <?php if (fetchFollowers($seller->id) != false) : ?>
                <?php echo count(fetchFollowers($seller->id)) ?>
              <?php else : ?>
                0
              <?php endif ?>
              abonnés
            </div>
            |
            <div class="nbr-pub">

              <?php if (fetchProducts($_GET["seller"]) != false) : ?>
                <?php echo count(fetchProducts($_GET["seller"])) ?>
              <?php else : ?>
                0
              <?php endif ?>
              publications
            </div>
          </div>

          <div class="user-actions">

            <?php if (!isset($_SESSION["user_id"])) : ?>
              <a href="./connexion.php" class="follow-seller">Suivre</a>
            <?php else : ?>

              <?php if (fetchFollow($seller->id, $_SESSION["user_id"]) != false) : ?>

                <a href="./user.php?unfollow_seller&seller=<?php echo $seller->id ?>" class="follow-seller">Suivi</a>

              <?php else : ?>

                <a href="./user.php?follow_seller&seller=<?php echo $seller->id ?>" class="follow-seller">Suivre</a>

              <?php endif ?>

            <?php endif ?>


            <a href="chat.php?seller=<?php echo $seller->id ?>" class="message">Message</a>
            <a href="" data-user-id="<?php echo $seller->id ?>" class="report-seller signal"><i class="fa-solid fa-circle-exclamation"></i></a>
          </div>




        </div>
        <div class="right__col">
          <nav>
            <ul class="tabs">
              <li class="active" data-cont=".mes_produits">Annonces de <?= htmlspecialchars($seller->name) ?></li>


            </ul>
          </nav>

          <div class="main-wrapper">
            <div class="container">
              <div class="products mes_produits">

                <?php if (fetchProducts($seller->id) != false) : ?>

                  <?php foreach (fetchProducts($seller->id) as $product) : ?>

                    <div class="item">
                      <?php if ($product->is_sold) : ?>
                        <div class="sold-streak">Vendu</div>
                      <?php endif ?>
                      <div class="item-img">

                        <?php if (fetchProductImages($product->product_id)) :

                          $images = fetchProductImages($product->product_id);

                          $img = reset($images);

                        ?>
                          <a href="./product-details.php?product=<?php echo $product->product_id ?>" >
                          <img src="./uploaded_img/<?php echo $img->image ?>" alt="">

                        <?php else : ?>

                          <img src="./Photos/def-product-img.jpg" alt="">

                        <?php endif ?>


                      </div>
                      <div class="item-detail">
                        <div class="item-price">
                          <span class="new-price">
                            <?php
                            echo $product->price
                            ?> DT
                          </span>
                          <span class="old-price">
                            <?php
                            echo (0.2 * $product->price) + $product->price
                            ?> DT
                          </span>
                        </div>
                        <a target="_blank" href="./product-details.php?product=<?php echo $product->product_id ?>" class="item-name"> <?php echo substr($product->name, 0, 40) ?> </a>

                      </div>
                    </div>

                  <?php endforeach ?>

                <?php else : ?>
                  <div class="note warning">
                    <span class="material-symbols-outline">
                      warning
                    </span>
                    Vous avez 0 produits
                  </div>
                <?php endif ?>

              </div>


            </div>
          </div>
          <br><br>
        </div>

      </div>
      <br><br><br><br><br>
    </div>
  <?php else : ?>

    <div class="note warning">
      <span class="material-symbols-outline">
        error
      </span>
      User not available
    </div>

  <?php endif ?>


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

  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
      subMenu.classList.toggle("open-menu");
    }
  </script>
  <script src="js/main.js"></script>
  <script src="js/users.js"></script>


</body>

</html>