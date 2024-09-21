<?php

session_start();

include_once "./database.php";


function fetchProduct($product_id)

{

    include "./database.php";


    $sql = "SELECT * FROM products WHERE product_id = :product_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $product_id);

    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        return $stmt->fetch();
    } else {
        return false;
    }
}

if (isset($_SESSION["user_id"])) {
    if (fetchProduct($_GET["product"])->user_id == $_SESSION["user_id"]) {
        header("location: ./products-details.php?product=" . $_GET["product"]);
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
            header("location: ./product-details.php?product=" . $_GET["product"] . "&success=vendeur suivi");
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
            header("location: ./product-details.php?product=" . $_GET["product"] . "&Vous n'avez plus suivi ce vendeur");
        }
    } else {
        header("location: ./connexion.php");
    }
}

if (isset($_GET["mark_favourite"]) && isset($_GET["product"])) {

    if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {

        if (checkIsFavourite($_GET["product"]) == false) {
            $favourite_id = rand(100000, 999999);

            $product_id = trim(htmlspecialchars($_GET["product"]));

            $sql = "INSERT INTO favourites
                SET 
                favourite_id = :favourite_id,
                product_id = :product_id,
                user_id = :user_id ";

            $stmt =  $conn->prepare($sql);

            $stmt->bindParam("favourite_id", $favourite_id);

            $stmt->bindParam("product_id", $product_id);

            $stmt->bindParam("user_id", $_SESSION["user_id"]);


            if ($stmt->execute()) {
                header("location: ./product-details.php?product=" . $_GET["product"] . "&success=Produit ajouté aux favoris");
            } else {
                header("location: ./product-details.php?product=" . $_GET["product"] . "&error=Impossible d'ajouter des produits aux favoris");
            }
        }
    } else {
        header("location: ./connexion.php");
    }
}
if (isset($_GET["mark_unfavourite"]) && isset($_GET["product"])) {

    if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {

        if (checkIsFavourite($_GET["product"]) == true) {


            $product_id = trim(htmlspecialchars($_GET["product"]));

            $sql = "DELETE FROM favourites
                    where                     
                    product_id = :product_id
                    AND
                    user_id = :user_id ";

            $stmt =  $conn->prepare($sql);


            $stmt->bindParam("product_id", $product_id);

            $stmt->bindParam("user_id", $_SESSION["user_id"]);


            if ($stmt->execute()) {
                header("location: ./product-details.php?product=" . $_GET["product"] . "&success=Produit supprimé des favoris");
            } else {
                header("location: ./product-details.php?product=" . $_GET["product"] . "&error=Impossible de supprimer l'élément");
            }
        }
    } else {
        header("location: ./connexion.php");
    }
}



function checkIsFavourite($product_id)
{

    include "./database.php";



    $sql = "SELECT * FROM favourites 
            WHERE 
            product_id = :product_id
            AND 
            user_id = :user_id";

    $stmt =  $conn->prepare($sql);


    $stmt->bindParam("product_id", $product_id);

    $stmt->bindParam("user_id", $_SESSION["user_id"]);

    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        return true;
    } else {
        return false;
    }
}


if (isset($_SESSION["user_id"])) {

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $conn->query($sql);

    $user = $result->fetch();
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

function getPostedTimeAgo($postDateTime)
{
    $currentTime = time();
    $postTime = strtotime($postDateTime);

    $timeDiff = $currentTime - $postTime;
    $secondsPerMinute = 60;
    $secondsPerHour = 60 * $secondsPerMinute;
    $secondsPerDay = 24 * $secondsPerHour;
    $secondsPerWeek = 7 * $secondsPerDay;
    $secondsPerMonth = 30 * $secondsPerDay; // Approximate
    $secondsPerYear = 365 * $secondsPerDay; // Approximate

    if ($timeDiff < $secondsPerMinute) {
        return "Publié à l'instant";
    } elseif ($timeDiff < $secondsPerHour) {
        $minutesAgo = floor($timeDiff / $secondsPerMinute);
        return "Publié il y a $minutesAgo minute" . ($minutesAgo > 1 ? "s" : "");
    } elseif ($timeDiff < $secondsPerDay) {
        $hoursAgo = floor($timeDiff / $secondsPerHour);
        return "Publié il y a $hoursAgo heure" . ($hoursAgo > 1 ? "s" : "");
    } elseif ($timeDiff < $secondsPerWeek) {
        $daysAgo = floor($timeDiff / $secondsPerDay);
        return "Publié il y a $daysAgo jour" . ($daysAgo > 1 ? "s" : "");
    } elseif ($timeDiff < $secondsPerMonth) {
        $weeksAgo = floor($timeDiff / $secondsPerWeek);
        return "Publié il y a $weeksAgo semaine" . ($weeksAgo > 1 ? "s" : "");
    } elseif ($timeDiff < $secondsPerYear) {
        $monthsAgo = floor($timeDiff / $secondsPerMonth);
        return "Publié il y a $monthsAgo mois" . ($monthsAgo > 1 ? "s" : "");
    } else {
        $yearsAgo = floor($timeDiff / $secondsPerYear);
        return "Publié il y a $yearsAgo an" . ($yearsAgo > 1 ? "s" : "");
    }
}

function fetchUser($user_id)
{

    include "./database.php";

    $sql = "SELECT * FROM user where id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("user_id", $user_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        return $stmt->fetch();
    } else {
        return false;
    }
}


function fetchLocation($location_id)
{

    include "./database.php";

    $sql = "SELECT * FROM location where id = :location_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("location_id", $location_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

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


function fetchCity($city_id)
{

    include "./database.php";

    $sql = "SELECT * FROM city where id = :city_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("city_id", $city_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        return $stmt->fetch();
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


<link rel="stylesheet" href="./css/product-details.css">

<link rel="stylesheet" href="./libraries/owlcarousel/assets/owl.carousel.css">
<link rel="stylesheet" href="./libraries/owlcarousel/assets/owl.theme.green.css">

<body>
    <div class="container-details">
        <?php

        $product = fetchProduct($_GET["product"]);


        if ($product != false) :


        ?>

            <div class="box-details">
                <div class="product-img-container">
                    <div class="main-img">

                        <?php if (fetchProductImages($product->product_id)) :

                            $images = fetchProductImages($product->product_id);

                            $img = reset($images);

                        ?>

                            <img src="./uploaded_img/<?php echo $img->image ?>" alt="">

                        <?php else : ?>

                            <img src="./Photos/def-product-img.jpg" alt="">

                        <?php endif ?>
                    </div>

                    <div class="product-imgs owl-carousel owl-theme">


                        <?php if (fetchProductImages($product->product_id)) :

                            $images = fetchProductImages($product->product_id);


                        ?>
                            <?php foreach ($images as $image) : ?>


                                <div class="img">
                                    <img src="./uploaded_img/<?php echo $image->image ?>" alt="">
                                </div>

                            <?php endforeach ?>



                        <?php endif ?>


                    </div>
                </div>
                <div class="basic-info">
                    <?php if ($product->is_paused) : ?>
                        <h2 style="color: red;">En attente</h2>
                    <?php endif ?>
                    <?php if ($product->is_sold) : ?>
                        <h2 style="color: red;">Vendu</h2>
                    <?php endif ?>
                    <h1><?php echo $product->name ?></h1>
                    <div class="price">
                        <span class="new-price"><?php echo $product->price ?> DT</span>
                        <!--<span class="old-price">-->
                        <!--    <?php-->
                        <!--    echo (0.2 * $product->price) + $product->price-->
                        <!--    ?> DT-->
                        <!--</span>-->
                    </div>
                    <div class="date-location">
                        <d class="item-time"><?php echo getPostedTimeAgo($product->created_at)  ?></d> , <a class="item-location">
                            <?php
                            echo fetchLocation($product->location)->name
                            ?>
                        </a>
                    </div>
                    <!-- <h2 style="padding-top: 20px;">Informations de vendeur</h2> -->

                    <div class="user-info" style="padding-bottom: 20px;">
                        <a href="./user.php?seller=<?php echo $product->user_id ?>" class="user-profile">
                            <div class="profile-img">
                                <img src="./Photos/avatar/default_profile.jpg">
                            </div>
                            <div class="profile-name"><?php echo fetchUser($product->user_id)->name ?></div>
                            <?php if (fetchIdentity($product->user_id) != false && fetchIdentity($product->user_id)->is_verified) : ?>

                                <i class="fa-solid fa-circle-check" style="   font-size: 16px;  color: #0093ff; top: 3px;"></i>
                            <?php endif ?>
                        </a>

                        <div class="user-actions">

                            <?php if (!isset($_SESSION["user_id"])) : ?>
                                <a href="./connexion.php" class="follow-seller">Suivre</a>
                            <?php else : ?>

                                <?php if (fetchFollow($product->user_id, $_SESSION["user_id"]) != false) : ?>

                                    <a href="./product-details.php?unfollow_seller&seller=<?php echo $product->user_id ?>&product=<?php echo $product->product_id ?>" class="follow-seller">Suivi</a>

                                <?php else : ?>

                                    <a href="./product-details.php?follow_seller&seller=<?php echo $product->user_id ?>&product=<?php echo $product->product_id ?>" class="follow-seller">Suivre</a>

                                <?php endif ?>

                            <?php endif ?>


                            <a href="./chat.php?seller=<?php echo $product->user_id ?>&product=<?php echo $product->product_id ?>" class="message">Envoyer un message</a>

                            <?php if (isset($_SESSION["user_id"])) : ?>

                                <?php if (checkIsFavourite($product->product_id, $_SESSION["user_id"]) == true) : ?>

                                    <a class="favourite is-marked" href="./product-details.php?mark_unfavourite&product=<?php echo $product->product_id ?>">
                                        <span class="material-symbols-rounded">
                                            bookmark
                                        </span>
                                    </a>


                                <?php else : ?>

                                    <a class="favourite" href="./product-details.php?mark_favourite&product=<?php echo $product->product_id ?>">
                                        <span class="material-symbols-outlined">
                                            bookmark
                                        </span>
                                    </a>

                                <?php endif ?>

                            <?php else : ?>

                                <a class="favourite" href="./connexion.php">
                                    <span class="material-symbols-outlined">
                                        bookmark
                                    </span>
                                </a>

                            <?php endif ?>
                        </div>

                        <div class="infos">

                            <?php if ($product->alt_phone_number != null  && !empty($product->alt_phone_number)) : ?>

                                <span>Numéro de vendeur</span>

                                <span><?php echo $product->alt_phone_number ?></span>

                            <?php elseif (fetchUser($product->user_id)->phone != null && !empty(fetchUser($product->user_id)->phone)) : ?>


                                <span>Numéro de vendeur</span>
                                <span><?php echo fetchUser($product->user_id)->phone ?></span>


                            <?php endif ?>



                        </div>
                        <div class="infos">

                            <?php if ($product->product_condition != null  && !empty($product->product_condition)) :  ?>
                                <span>État du produit</span>
                                <span><?php echo str_replace("_", " ", $product->product_condition) ?></span>
                            <?php endif ?>



                        </div>

                    </div>
                    <div class="description">
                        <h2>Détails</h2>
                        <p>
                            <?php echo $product->description ?>
                        </p>

                    </div>



                </div>



            </div>

        <?php else : ?>

            <div class="note error">
                <span class="material-symbols-outlined">
                    error
                </span>

                Please select a <a href="./index.php">product</a> to proceed
            </div>

        <?php endif ?>
    </div>











    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="./libraries/owlcarousel/owl.carousel.js"></script>

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

    <script src="js/main.js"></script>
    <script src="./js/products-details.js"></script>
</body>

</html>