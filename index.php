

<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

}

?>




    
<?php
include 'init.php';
?>


<body>



    <div class="img-presentation">
        <p>Jawek<p1>.</p1>tn Site Vente Et Achat En Ligne En Tunisie</p>
        <img src="photos/Présentation.svg">
    </div>



    <!-- <div include-html="allproduct.html" id="header-file"><</iframe>> -->








<div class="all-container">

    <div class="container-filter">
        <div class="product-filter">
            <h3>Filter Products</h3>
            <form>
              <div class="filter-section">
                <h4>Price Range</h4>
                <div class="filter-price">
                  <label for="price-min">Min:</label>
                  <input type="number" id="price-min" name="price-min" min="0">
                  <label for="price-max">Max:</label>
                  <input type="number" id="price-max" name="price-max" min="0">
                </div>
              </div>
              <div class="filter-section">
                <h4>Color</h4>
                <div class="filter-color">
                  <label><input type="checkbox" name="color" value="red">Red</label>
                  <label><input type="checkbox" name="color" value="blue">Blue</label>
                  <label><input type="checkbox" name="color" value="green">Green</label>
                </div>
              </div>
              <div class="filter-section">
                <h4>Size</h4>
                <div class="filter-size">
                  <label><input type="checkbox" name="size" value="small">Small</label>
                  <label><input type="checkbox" name="size" value="medium">Medium</label>
                  <label><input type="checkbox" name="size" value="large">Large</label>
                </div>
              </div>
              <div class="filter-section">
                <button type="submit">Apply Filters</button>
              </div>
            </form>
          </div>
    </div>

    <div class="container-recentes">
        <div class="itms-recentes">
            <nav>
                <ul>
                    <li>Annonces récentes</li>
                </ul>
            </nav>
            <div class="item-list-recentes">










                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="container-vehicules">
        <div class="itms-recentes">
            <nav>
                <ul>
                    <li>Véhicules</li>
                    <a href="vehicules.php">
                        <p>Voir plus</p>
                    </a>

                </ul>
            </nav>
            <div class="item-list-recentes">



                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-Immobilier">
        <div class="itms-recentes">
            <nav>
                <ul>
                    <li>Immobilier</li>
                    <a href="Immobilier.html">
                        <p>Voir plus</p>
                    </a>

                </ul>
            </nav>
            <div class="item-list-recentes">



                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>

                <div class="item">
                    <div class="item-img">
                        <img src="Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                    </div>
                    <div class="item-detail">
                        <div class="item-price">
                            <span class="new-price">220.000 DT</span>
                            <span class="old-price">275.60 DT</span>
                        </div>
                        <a href="#" class="item-name">Z750</a>
                        <a href="#" class="item-location">Bizerte</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis
                            delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim
                            consectetur cum?</p>
                        <button type="button" class="add-btn">add to cart</button>
                    </div>
                </div>
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
                    <?php if(isset($name_error)){
                        echo $user_error;
                    }?>

                    <div class="input-box">
                        <span class="icon">
                        </span>
                        <input type="text" name="name" id="name" required>
                        <label>Nom et Prénom</label>
                    </div>
                    <?php if(isset($email_error)){
                        echo $email_error;
                    }?>

                    <div class="input-box">
                        <span class="icon">
                        </span>
                        <input type="email" name="email" id="email" required>
                        <label>Email ou téléphone</label>
                    </div>

                    

                    <?php if(isset($pass_error)){
                        echo $pass_error;
                    }?>
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
    <script src="./js/script-btn-login.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9867407934959822"
        crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/include-html.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>

    let subMenu = document.getElementById("subMenu");
  
    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
    }
    
  </script>
</body>

</html>