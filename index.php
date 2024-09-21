
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





<?php
include 'init.php';
?>


<body>



    <div class="img-presentation">
        <p>Jawek<p1>.</p1>tn Site Vente Et Achat En Ligne En Tunisie</p>
    </div>



    <!-- <div include-html="allproduct.html" id="header-file"><</iframe>> -->







    <div class="all-container">

        <div class="filter-container">
            <div class="product-filter">
                <div class="filter-line"><h3>
                    Filtres
                    <span class="close-filter material-symbols-outlined">
                        close
                    </span>
                    </h3>
                    </div>
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
                                <label>Délégation :</label>
                                <div class="column">
                                    <div class="select-box">

                                        <?php if (!empty($categories)) : ?>

                                            <select name="city" id="city">

                                                <option value="">Sélectionnez un délégation</option>

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
        

        <a href="" class="open-filter">
            <span>Filtres</span>
        </a>
      

        <div class="products-main-container">
            <div class="products-container">
                <nav>
                    <h3>Annonces récentes</h3>
                </nav>
                <div class="products">
                    <?php
                    $products = fetchProducts();
                    if (isset($_GET["filter"]) && isset($_GET["price_min"]) && isset($_GET["price_max"])) {
                        $products =  array_filter($products, function ($product) {
                            if (
                                $product->price >= $_GET["price_min"] &&
                                $product->price <= $_GET["price_max"]
                            ) {
                                return $product;
                            }
                        });
                    }
                    if (isset($_GET["filter"]) && isset($_GET["search_text"]) && !empty($_GET["search_text"])) {
                        $products =  searchProducts($_GET["search_text"]);
                    }
                    if (isset($_GET["filter"]) && isset($_GET["category"]) && !empty($_GET["category"])) {
                        $products =  array_filter($products, function ($product) {
                            if (
                                $product->category == $_GET["category"]
                            ) {
                                return $product;
                            }
                        });
                    }
                    if (isset($_GET["filter"]) && isset($_GET["subcategory"]) && !empty($_GET["subcategory"])) {
                        $products =  array_filter($products, function ($product) {
                            if (
                                $product->subcategory == $_GET["subcategory"]
                            ) {
                                return $product;
                            }
                        });
                    }
                    if (isset($_GET["filter"]) && isset($_GET["location"]) && !empty($_GET["location"])) {
                        $products =  array_filter($products, function ($product) {
                            if (
                                $product->location == $_GET["location"]
                            ) {
                                return $product;
                            }
                        });
                    }
                    if (isset($_GET["filter"]) && isset($_GET["city"]) && !empty($_GET["city"])) {
                        $products =  array_filter($products, function ($product) {
                            if (
                                $product->city == $_GET["city"]
                            ) {
                                return $product;
                            }
                        });
                    }
                    
                     $products =  array_splice($products, 0, 20);

                    
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
                                        <img src="./uploaded_img/<?php echo $img->image ?>" alt=""></a>
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
                                        <!--<span class="old-price">-->
                                        <!--    <?php-->
                                        <!--    echo (0.2 * $product->price) + $product->price-->
                                        <!--    ?> DT-->
                                        <!--</span>-->
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
                            0 products available
                        </div>
                    <?php endif ?>
                </div>
            </div>
            
            
            
            <div class="products-container">
                <nav>
                    <h3>Telephones</h3>
                    <!--<a href="Telephones.php">-->
                    <!--    <p>Voir plus</p>-->
                    <!--</a>-->
                </nav>
                <div class="products">
                    <?php
                    $products = fetchProducts();
                    $products =  array_filter($products, function ($product) {
                        if (
                            $product->category == 6
                        ) {
                            return $product;
                        }
                    });
                    
                     $products =  array_splice($products, 0, 8);
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
                                        <img src="./uploaded_img/<?php echo $img->image ?>" alt=""></a>
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
                            0 products available
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="products-container">
                <nav>
                    <h3>Voitures</h3>
                    <!--<a href="https://jawek.tn/index.php?search_text=&category=1&subcategory=1&location=&city=&price_min=0&price_max=3000000&filter=">-->
                    <!--    <p>Voir plus</p>-->
                    <!--</a>                    -->
                </nav>
                <div class="products">
                    <?php
                    $products = fetchProducts();
                    $products =  array_filter($products, function ($product) {
                        if (
                            $product->subcategory == 1
                        ) {
                            return $product;
                        }
                    });
                    
                    $products =  array_splice($products, 0, 8);

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
                                        <img src="./uploaded_img/<?php echo $img->image ?>" alt=""></a>
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
                            0 products available
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="products-container">
                <nav>
                    <h3>Motos</h3>
                    <!--<a href="https://jawek.tn/index.php?search_text=&category=1&subcategory=2&location=&city=&price_min=0&price_max=3000000&filter=">-->
                    <!--    <p>Voir plus</p>-->
                    <!--</a>  -->
                </nav>
                <div class="products">
                    <?php
                    $products = fetchProducts();
                    $products =  array_filter($products, function ($product) {
                        if (
                            $product->subcategory == 2
                        ) {
                            return $product;
                        }
                    });
                    
                    $products =  array_splice($products, 0, 8);

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
                                        <img src="./uploaded_img/<?php echo $img->image ?>" alt=""></a>
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
                            0 products available
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