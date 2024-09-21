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

function fetchFollowers($user_id)
{

    include "./database.php";


    $sql = "SELECT * FROM followers
            WHERE 
            seller = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("user_id", $user_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        return  $stmt->fetchAll();
    } else {
        return false;
    }
}

function fetchFavourites($user_id)
{

    include "./database.php";


    $sql = "SELECT * FROM favourites
            WHERE 
            user_id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("user_id", $user_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        return  $stmt->fetchAll();
    } else {
        return false;
    }
}
function fetchProduct($product_id)
{

    include "./database.php";


    $sql = "SELECT * FROM products
            WHERE 
            product_id = :product_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $product_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        return  $stmt->fetch();
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


<body>
    <!--div class="container">
    
    <div class="container-profil">

    </div>
    <div class="container-profil-annonce">

    </div>

   </div-->
    <!--header></header-->
    <div class="header__wrapper">
        <div class="cols__container">
            <div class="left__col">
                <div class="img__container">
                    <img src="./Photos/<?php echo $user->profile_pic ?>" alt="Image of <?php echo $user->name ?> " />
                    <span></span>
                </div>



                <h2><?= htmlspecialchars($user->name) ?>
                    <?php if (fetchIdentity($user->id) != false && fetchIdentity($user->id)->is_verified) : ?>

                        <i class="fa-solid fa-circle-check" style="   font-size: 16px;  color: #0093ff; top: 3px;"></i>
                    <?php endif ?>
                </h2>

                <p><?php echo $user->bio != null ?  $user->bio : "Bienvenue sur mon profil" ?></p>



                <div class="info-nbr">

                    <div class="nbr-follow">
                        <?php echo fetchFollowers($user->id) != false  ? count(fetchFollowers($user->id)) : 0  ?> abonnés
                    </div>
                    |
                    <div class="nbr-pub">
                        <?php echo fetchProducts($user->id) != false ? count(fetchProducts($user->id)) : 0 ?>
                        publications
                    </div>
                </div>

                <a href="edit-profile.php"><button>Modifier profil</button></a>



            </div>
            <div class="right__col">
                <nav>
                    <ul class="tabs">
                        <li class="active" data-cont=".mes_produits">Mes produits</li>
                        <li data-cont=".mes_favoires">Mes favoires</li>
                        <li data-cont=".mes_pause">Mes En pause</li>
                        <li data-cont=".mes_ventes">Mes ventes</li>

                    </ul>
                </nav>

                <div class="main-wrapper">
                    <div class="container">
                        <div class="products mes_produits">

                            <?php

                            $products = fetchProducts($user->id);

                            if ($products != false) {
                                $products = array_filter($products, function ($product) {
                                    if ($product->is_sold == 0) {
                                        return $product;
                                    }
                                });
                            }

                            if ($products != false) : ?>

                                <?php foreach ($products as $product) : ?>

                                    <div class="item">
                                        <div class="item-img">

                                            <?php if (fetchProductImages($product->product_id)) :

                                                $images = fetchProductImages($product->product_id);

                                                $img = reset($images);

                                            ?>

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
                                    <span class="material-symbols-outlined">
                                        warning
                                    </span>
                                    Vous avez 0 produits
                                </div>
                            <?php endif ?>

                        </div>

                        <div class="products mes_favoires">



                            <?php

                            if (fetchFavourites($user->id) != false) : ?>

                                <?php foreach (fetchFavourites($user->id) as $favourite) : ?>

                                    <?php if (fetchProduct($favourite->product_id) != false) :

                                        $product = fetchProduct($favourite->product_id);
                                    ?>

                                        <div class="item">
                                            <div class="item-img">

                                                <?php if (fetchProductImages($product->product_id)) :

                                                    $images = fetchProductImages($product->product_id);

                                                    $img = reset($images);

                                                ?>

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

                                    <?php else : ?>

                                        <div class="product-place-holder">
                                            <div class="holder-img">
                                                <img src="./Photos/product-not-found.svg" alt="">
                                            </div>
                                            <div class="product-content">
                                                Produit non trouvé
                                            </div>
                                        </div>

                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php else : ?>
                                <div class="note warning">
                                    <span class="material-symbols-outlined">
                                        warning
                                    </span>
                                    Vous avez 0 produits favoris
                                </div>
                            <?php endif ?>

                        </div>

                        <div class="products mes_pause">

                            <?php

                            $products = fetchProducts($user->id);

                            if ($products != false) {
                                $products = array_filter($products, function ($product) {
                                    if ($product->is_paused == 1) {
                                        return $product;
                                    }
                                });
                            }

                            ?>

                            <?php if ($products != false) :





                            ?>

                                <?php foreach ($products as $product) : ?>

                                    <div class="item">
                                        <div class="item-img">

                                            <?php if (fetchProductImages($product->product_id)) :

                                                $images = fetchProductImages($product->product_id);

                                                $img = reset($images);

                                            ?>

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
                                    <span class="material-symbols-outlined">
                                        warning
                                    </span>
                                    Vous avez 0 produits
                                </div>
                            <?php endif ?>

                        </div>

                        <div class="products mes_ventes">

                            <?php

                            $products = fetchProducts($user->id);

                            if ($products != false) {
                                $products = array_filter($products, function ($product) {
                                    if ($product->is_sold == 1) {
                                        return $product;
                                    }
                                });
                            }

                            ?>

                            <?php if ($products != false) :





                            ?>

                                <?php foreach ($products as $product) : ?>

                                    <div class="item">
                                        <div class="item-img">

                                            <?php if (fetchProductImages($product->product_id)) :

                                                $images = fetchProductImages($product->product_id);

                                                $img = reset($images);

                                            ?>

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
                                    <span class="material-symbols-outlined">
                                        warning
                                    </span>
                                    Vous avez 0 produits
                                </div>
                            <?php endif ?>

                        </div>


                    </div>
                    <br><br>
                </div>

            </div>
            <br><br><br><br><br>
        </div>
        <script>
            let subMenu = document.getElementById("subMenu");

            function toggleMenu() {
                subMenu.classList.toggle("open-menu");
            }
        </script>

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


</body>

</html>