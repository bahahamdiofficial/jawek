
<?php

include "./database.php";

session_start();

if (isset($_SESSION["user_id"])) {

    $user = [];

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $conn->query($sql);

    if ($result->rowCount() == 1) {
        $user = $result->fetch();
    }
} else {
    header("location:./connexion.php");
}


$categories = [];

$sql = "SELECT * FROM category";

$stmt = $conn->query($sql);

$stmt->execute();

$categories = $stmt->fetchAll();


$locations = [];

$sql = "SELECT * FROM location";

$stmt = $conn->query($sql);

$stmt->execute();

$locations = $stmt->fetchAll();


$cities = [];

$sql = "SELECT * FROM city";

$stmt = $conn->query($sql);

$stmt->execute();

$cities = $stmt->fetchAll();



function fetchProducts()
{

    include "./database.php";


    $sql = "SELECT * FROM products
            WHERE 
            is_active = 1 
     
            ";

    $stmt = $conn->query($sql);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        return $stmt->fetchAll();
    } else {
        return false;
    }
}
function searchProducts($search_text)
{

    include "./database.php";


    $sql = "SELECT * FROM products
            WHERE 
            name LIKE :search_term
            OR 
            description LIKE :search_term
            ";

    $stmt = $conn->prepare($sql);

    $search_term = "%" . $search_text . "%";

    $stmt->bindParam("search_term", $search_term);

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



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawek.tn | Jeux </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="css/style.css?=1">
    <link rel="stylesheet" href="css/recentes.css?v=1">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="./js/script.js" defer></script>
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9867407934959822"
     crossorigin="anonymous"></script>

</head>


<div class="category">
    <div class="flex-box">

        <a href="vehicules.php">
            <div class="box">
                <i class="fa-solid fa-car"></i>
                <p>Véhicules</p>
            </div>
        </a>

        <a href="Immobilier.php">
            <div class="box">
                <i class="fa-solid fa-home"></i>
                <p>Immobilier</p>
            </div>
        </a>

        <a href="Emplois.php">
            <div class="box">
                <i class="fa-solid fa-briefcase"></i>
                <p>Emplois</p>
            </div>
        </a>
        <a href="Multimedias.php">
            <div class="box">
                <i class="fa-solid fa-display"></i>
                <p>Multimédias</p>
            </div>
        </a>
        <a href="Animaux.php">
            <div class="box">
                <i class="fa-solid fa-paw"></i>
                <p>Animaux</p>
            </div>
        </a>
        <a href="Telephones.php">
            <div class="box">
                <i class="fa-solid fa-mobile-screen-button"></i>
                <p>Telephones</p>
            </div>
        </a>

        <a href="Meubles.php">
            <div class="box">
                <span class="material-symbols-outlined">
                    chair
                </span>
                <p>Meubles</p>
            </div>
        </a>

        <a href="Mode.php">
            <div class="box">
                <span class="material-symbols-outlined">
                    styler
                </span>
                <p>Mode</p>
            </div>
        </a>
        <a href="Services.php">
            <div class="box">
                <span class="material-symbols-outlined">
                    engineering
                </span>
                <p>Services</p>
            </div>
        </a>
        <a href="Jeux.php">
            <div class="box">
                <span class="material-symbols-outlined">
                    stadia_controller
                </span>
                <p>Jeux</p>
            </div>
        </a>


    </div>
</div>



<header>
    <a href="index.php">
        <img src="Photos/logos/logo.png" alt="" class="logo">
    </a>
    <div class="navbar">
        <div class="searchBox">
            <input type="text" placeholder="Recherchez dans Jawek..." />
            <span id="searchIcon" class="material-symbols-outlined">
                search
            </span>

        </div>
    </div>

    <div class="burger" class="toggle-menu">
        <i class="fa-solid fa-bars"></i>
    </div>



    <!-- <div class="store">
    <i class="fa-solid fa-shop" style="color: #ffffff;"></i>
    </div> -->



    <!-- <div class="btn-vendre">
        <img src="photos/ic_camera.svg" alt="">
        <a href="products-create.php">VENDRE</a>
    </div> -->

    <div class="right">
        <a class="sell" href="./products-create.php">
            <span class="material-symbols-outlined">
            <img src="Photos/ic_camera.svg" alt="">

            </span>
            VENRDE
        </a>
        <?php if (!empty($user) && isset($_SESSION["user_id"])) : ?>
            <div class="main">
                <div class="main-profill">
                    <a href="./chat.php"><i class="fa-solid fa-envelope"></i></a>
                    <!-- <a href="ma-compte.html">Profil</a> -->
                    <i class="fa-solid fa-bell"></i>
                    <img src="./Photos/<?php echo $user->profile_pic  ?>" class="user-pic" onclick="toggleMenu()">
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <a href="profile.php">
                                <div class="user-info">
                                    <img src="./Photos/<?php echo $user->profile_pic  ?>">
                                    <h3><?= htmlspecialchars($user->name) ?></h3>
                                </div>
                            </a>
                            <hr>
                            <a href="profile.php" class="sub-menu-link">
                                <img src="img/profile.png" alt="">
                                <p>Profil</p>
                                <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                            <a href="edit-profile.php" class="sub-menu-link">
                                <img src="img/setting.png" alt="">
                                <p>Paramètres</p>
                                <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                            <a href="privacy-policy.php" class="sub-menu-link">
                                <img src="img/help.png" alt="">
                                <p>Privacy & Terms</p>
                                <span class="material-symbols-outlined">
                                    chevron_right
                                </span>
                            </a>
                            <a href="logout.php" class="sub-menu-link">
                                <img src="img/logout.png" alt="">
                                <p>Se déconnecter</p>
                                <!-- <span>></span> -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="main">
            <spann class="fa fa-sign-out"></spann>
            <p><a href="connexion.php">Connexion</a><a href="inscription.php">Inscription</a></p>
            </div>
        <?php endif; ?>
    </div>







</header>
<body>


<br><br><br><br>


    <!-- <div include-html="allproduct.html" id="header-file"><</iframe>> -->








    <div class="all-container">

        <div class="filter-container">
            <div class="product-filter">
                <div class="filter-line"><h3>Filtres</h3></div>
                <form method="get" action="index.php">
                    <div class="filter-section">
                        <div class="filter-price">
                            <div class="input-group">
                                <label>Recherchez :</label>
                                <input type="text" value="<?php echo $_GET["search_text"] ?? '' ?>" id="search-text" name="search_text" placeholder="Recherchez dans Jawek.." min="0">
                            </div>
                            <div class="input-group">
                                <label>Catégorie :</label>
                                <div class="column">
                                    <div class="select-box">

                                        <?php if (!empty($categories)) : ?>

                                            <select name="category" id="category">

                                                <option value="" selected>Choisissez une catégorie</option>

                                                <?php foreach ($categories as $category) : ?>

                                                    <option value="<?php echo $category->id ?>">

                                                        <?php echo $category->name ?>

                                                    </option>

                                                <?php endforeach ?>

                                            </select>

                                        <?php endif ?>

                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Sous-catégorie :</label>
                                <div class="column">
                                    <div class="select-box">
                                        <select id="subcategory" name="subcategory">
                                            <option disabled selected>Choisissez une sous-catégorie</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="input-group">
                                <label>Ville :</label>
                                <div class="column">
                                    <div class="select-box">

                                        <?php if (!empty($locations)) : ?>

                                            <select name="location" id="location">

                                                <option value="" selected>Sélectionnez une ville</option>


                                                <?php foreach ($locations as $location) : ?>

                                                    <option value="<?php echo $location->id ?>">

                                                        <?php echo $location->name ?>

                                                    </option>

                                                <?php endforeach ?>

                                            </select>

                                        <?php endif ?>
                                    </div>

                                </div>
                            </div>
                            <div class="input-group">
                                <label>Gouvernorat :</label>
                                <div class="column">
                                    <div class="select-box">

                                        <?php if (!empty($categories)) : ?>

                                            <select name="city" id="city">

                                                <option value="">Sélectionnez un gouvernorat</option>

                                            </select>

                                        <?php endif ?>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                
                                <div class="input-group">
                                    
                                    <label for="price-min">Min :</label>
                                    <input type="number" value="<?php echo $_GET["price_min"] ?? '0' ?>" id="price-min" name="price_min" min="0">
                                </div>
                                <div class="input-group">
                                    <label for="price-max">Max :</label>
                                    <input type="number" value="<?php echo $_GET["price_max"] ?? '3000000' ?>" id="price-max" name="price_max" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="filter-section">
                        <button name="filter" type="submit">Appliquer le filtre</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="products-main-container">
            
            <div class="products-container">
                <nav>
                    <h3>Jeux</h3>
                </nav>
                <div class="products">
                    <?php
                    $products = fetchProducts();
                    $products =  array_filter($products, function ($product) {
                        if (
                            $product->category == 9
                        ) {
                            return $product;
                        }
                    });
                    if ($products != false) : ?>
                        <?php foreach ($products as $product) : ?>
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
                                    <a href="./product-details.php?product=<?php echo $product->product_id ?>" class="item-name"> <?php echo substr($product->name, 0, 40) ?> </a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="note warning">
                            <span class="material-symbols-outlined">
                                warning
                            </span>
                            0 produits disponibles
                        </div>
                    <?php endif ?>
                </div>
            </div>
          
        </div>






    </div>






















    <!-- <div class="flex-center">
        <div class="wrapper">
            <span class="icon-close">
                <ion-icon name="close"></ion-icon>
            </span>

            <div class="form-box login">
                <h2>Connexion</h2>
                <h3>Entrez vos données d'identification</h3>
                <form class="#">

                    <div class="input-box">
                        <span class="icon">
                        </span>
                        <input type="email" name="email" id="email" placeholder="" required>
                        <label>Email ou téléphone</label>
                    </div>

                    <div class="input-box">
                        <span class="icon">
                        </span>
                        <input type="password" name="password" id="password" placeholder="" required>
                        <label>Mot de passe</label>
                    </div>

                    <div class="remember-forgot">
                        <label><input type="checkbox">Souvenez-vous</label>
                        <a href="#">Mot de passe oublié ?</a>
                    </div>
                    <button type="submit" id="submit" class="btn">Se connecter</button>
                    <div class="login-register">
                        <p>Pas encore membre ?<a href="#" class="register-link">Inscription</a></p>
                    </div>
                </form>
            </div>

            <div class="form-box register">
                <h2>Inscription</h2>
                <h3>Créer un nouveau compte</h3>

                <form action="register_post.php" method="POST">
                    <?php if (isset($name_error)) {
                        echo $user_error;
                    } ?>

                    <div class="input-box">
                        <span class="icon">
                        </span>
                        <input type="text" name="name" id="name" required>
                        <label>Nom et Prénom</label>
                    </div>
                    <?php if (isset($email_error)) {
                        echo $email_error;
                    } ?>

                    <div class="input-box">
                        <span class="icon">
                        </span>
                        <input type="email" name="email" id="email" required>
                        <label>Email ou téléphone</label>
                    </div>

                    

                    <?php if (isset($pass_error)) {
                        echo $pass_error;
                    } ?>
                    <div class="input-box">
                        <span class="icon">
                        </span>
                        <input type="password" name="password" id="password" placeholder="" required>
                        <label>Nouveau mot de passe</label>
                    </div>

                    <div class="remember-forgot">
                        <label><input type="checkbox">J'accepte les termes et conditions</label>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn">Inscription</button>
                    <div class="login-register">
                        <p>Vous avez déjà un compte ?<a href="#" class="login-link">Connexion</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <!--<div class="fixadd">
    <center>
        <div class="hover-btn">
        <a href="connexion.html" class="btn"><span class="fa-solid fa-circle-plus" ></span>Ajouter une annonce </a>
        </div>
    </center>
    </div>-->

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
    <script src="./js/script-btn-login.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9867407934959822" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/include-html.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./js/index.js"></script>
    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>

</html>