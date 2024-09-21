<?php

session_start();

include_once "./database.php";

if (isset($_GET["sold"]) && isset($_GET["product"])) {

    $sql = "UPDATE  products 
            SET is_sold = :is_sold
            WHERE product_id = :product_id ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("is_sold", $_GET["sold"]);

    $stmt->bindParam("product_id", $_GET["product"]);

    if ($stmt->execute()) {
        header("location: ./products-details.php?product=" . $_GET["product"] .  "&success=statut changé");
    } else {
        header("location: ./products-details.php?product=" . $_GET["product"] . "&error=impossible de changer de statut");
    }
}
if (isset($_GET["pause"]) && isset($_GET["product"])) {


    if ($_GET["pause"] == 1) {
        $sql = "UPDATE  products 
            SET is_paused = 1
            WHERE product_id = :product_id ";

        $stmt = $conn->prepare($sql);


        $stmt->bindParam("product_id", $_GET["product"]);

        if ($stmt->execute()) {
            header("location: ./products-details.php?product=" . $_GET["product"] .  "&success=statut changé");
        } else {
            header("location: ./products-details.php?product=" . $_GET["product"] . "&error=impossible de changer de statut");
        }
    } else if ($_GET["pause"] == 0) {
        $sql = "UPDATE  products 
            SET is_paused = 0
            WHERE product_id = :product_id ";

        $stmt = $conn->prepare($sql);


        $stmt->bindParam("product_id", $_GET["product"]);

        if ($stmt->execute()) {
            header("location: ./products-details.php?product=" . $_GET["product"] .  "&success=statut changé");
        } else {
            header("location: ./products-details.php?product=" . $_GET["product"] . "&error=impossible de changer de statut");
        }
    }
}

if (isset($_GET["delete_product"]) && isset($_GET["product"])) {

    $sql = "SELECT * FROM product_images 
            WHERE 
            product_id = :product_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $product_id);

    $stmt->execute();

    if ($stmt->execute()) {

        foreach ($stmt->fetchAll() as $image) {

            if (file_exists("./uploaded_img/" . $image->image)) {

                unlink("./uploaded_img/" . $image->image);
            }

            $sql = "DELETE * FROM product_images 
                    WHERE 
                    product_id = :product_id";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam("product_id", $product_id);

            $stmt->execute();
        }

        $sql = "DELETE FROM products
            WHERE product_id = :product_id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam("product_id", $_GET["product"]);

        if ($stmt->execute()) {

            header("location:./index.php?success=produit supprimé");
        } else {

            header("location:./products-details.php?product=" . $_GET["product"] . "&error=produit non supprimé");
        }
    }
}


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
    if (fetchProduct($_GET["product"]) != false) {
        if (fetchProduct($_GET["product"])->user_id != $_SESSION["user_id"]) {
            header("location: ./product-details.php?product=" . $_GET["product"]);
        }
    }
} else {
    header("location: ./connexion.php");
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
            header("location: ./products-details.php?product=" . $_GET["product"] . "&success=vendeur suivi");
        }
    } else {
        header("location: ./connexion.php");
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
        return "Publié il y a $monthsAgo mois" . ($monthsAgo > 1 ? "" : "");
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

<link rel="stylesheet" href="./css/product-details.css">

<link rel="stylesheet" href="./libraries/mklb/css/mklb.css">


<link rel="stylesheet" href="./libraries/owlcarousel/assets/owl.carousel.css">
<link rel="stylesheet" href="./libraries/owlcarousel/assets/owl.theme.green.css">


<body>
    <div class="container-details">
        <?php

        $product = fetchProduct($_GET["product"]);


        if ($product != false) :


        ?>

            <div class="popup confirm-delete">
                <!--<div class="close-popup-btn">-->
                <!--    <span class="material-symbols-outlined">-->
                <!--        close-->
                <!--    </span>-->
                <!--</div>-->

                <div class="popup-container">
                    <h2>Supprimer l'annonce</h2>
                    <div class="mini-product">
                        <div class="product-img">
                            <img src="" alt="">
                        </div>
                        <div class="product-name"></div>
                    </div>
                    <p>
                        Êtes-vous sûr de vouloir supprimer définitivement cette annonce ?
                    </p>




                    <div class="popup-btn-group">
                        <a href="" class="cancel">Annuler</a>
                        <a href="" class="continue">Oui je comprends</a>
                    </div>
                </div>
            </div>
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

                    <div class="hidden-imgs">


                        <?php if (fetchProductImages($product->product_id)) :

                            $images = fetchProductImages($product->product_id);


                        ?>
                            <?php foreach ($images as $image) : ?>


                                <img src=" ./uploaded_img/<?php echo $image->image ?>" alt="">

                            <?php endforeach ?>



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
                    <?php if ($product->is_sold) : ?>
                        <h2 style="color: red;">Vendu</h2>
                    <?php endif ?>
                    <?php if ($product->is_paused) : ?>
                        <h2 style="color: #fb8500;">En attente</h2>
                    <?php endif ?>
                    <h1><?php echo $product->name ?></h1>
                    <div class="price">
                        <span class="new-price"><?php echo $product->price ?> DT</span>
                        <!-- <span class="old-price">
                            <?php
                            echo (0.2 * $product->price) + $product->price
                            ?> DT
                        </span> -->
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
                        <div class="user-profile">
                            <div class="profile-img">
                                <img src="Photos/avatar/default_profile.jpg">
                            </div>
                            <div class="profile-name"><?php echo fetchUser($product->user_id)->name ?></div>

                            <div class="verification">
                                <?php if (fetchIdentity($product->user_id) != false && fetchIdentity($product->user_id)->is_verified) : ?>

                                    <i class="fa-solid fa-circle-check" style="   font-size: 16px;  color: #0093ff; top: 3px;"></i>
                                <?php endif ?>
                            </div>

                        </div>

                    </div>
                    <div class="description">
                        <h2>Détails</h2>
                        <p>
                            <?php echo $product->description ?>
                        </p>

                    </div>

                    <?php
                    $images = fetchProductImages($product->product_id);

                    $pImage = "";

                    if ($images != false) {
                        $pImage = reset($images);
                    }


                    ?>

                    <div class="etat">
                        <?php if (!$product->is_sold) : ?>
                            <div class="row">
                                <a href="./products-details.php?sold=1&product=<?php echo $product->product_id ?>" class="vendu">
                                    <span class="material-symbols-outlined">
                                        hourglass_top
                                    </span>
                                    Marquer comme vendu
                                </a>


                                <?php if (!$product->is_paused) : ?>
                                    <a href="./products-details.php?pause=1&product=<?php echo $product->product_id ?>" class="pause">
                                        <span class="material-symbols-outlined">
                                            pause
                                        </span>
                                        Marquer comme en attente
                                    </a>
                                <?php else : ?>
                                    <a href="./products-details.php?pause=0&product=<?php echo $product->product_id ?>" class="pause">
                                        <span class="material-symbols-outlined">
                                            pause
                                        </span>
                                        Marquer comme disponible
                                    </a>
                                <?php endif ?>

                            </div>



                            <div class="row">
                                <a href="./products-edit.php?product=<?php echo $product->product_id ?>" class="Edit">
                                    <span class="material-symbols-outlined">
                                        edit
                                    </span>
                                    Modifier l'annonce
                                </a>
                                <a href="./products-details.php?delete_product&product=<?php echo $product->product_id ?>" data-product-image="<?php echo ($pImage->image != "")  ? $pImage->image : '' ?>" data-product-name="<?php echo $product->name ?>" class="confirm-delete delete">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                    Supprimer l'annonce
                                </a>
                            </div>
                        <?php endif ?>
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


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script src="./libraries/mklb/js/mklb.js"></script>

    <script src="./libraries/owlcarousel/owl.carousel.js"></script>

    <script src="js/main.js"></script>
    <script src="./js/products-details.js"></script>
</body>

</html>