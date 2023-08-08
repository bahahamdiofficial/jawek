

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






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawek.tn | Immobilier </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/category.css">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">    <link rel="stylesheet" href="<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    

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
        <a href="Multimédias.php">
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
            <span class="fas fa-search" id="searchIcon"></span>

        </div>
    </div>



    <!-- <div class="store">
    <i class="fa-solid fa-shop" style="color: #ffffff;"></i>
    </div> -->



    <div class="btn-vendre">
        <img src="photos/ic_camera.svg" alt="">
        <a href="products-create.php">VENDRE</a>
    </div>

    
<?php if (isset($user)): ?>
        
        <div class="main">


            <div class="main-profill">
        <i class="fa-solid fa-envelope"></i>
        <!-- <a href="ma-compte.html">Profil</a> -->
        <i class="fa-solid fa-bell"></i>



        <img src="photos/avatar/default_profile.jpg" class="user-pic" onclick="toggleMenu()">
        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <a href="profile.php">
            <div class="user-info">
              <img src="photos/avatar/default_profile.jpg">
              <h3><?= htmlspecialchars($user["name"]) ?></h3>
            </div>
          </a>
            <hr>
            
            <a href="profile.php" class="sub-menu-link">
              <img src="img/profile.png" alt="">
              <p>Profil</p>
              <span class="material-symbols-outlined">chevron_right</span>            
            </a>

            <a href="#" class="sub-menu-link">
              <img src="img/setting.png" alt="">
              <p>Paramètres</p>
              <span class="material-symbols-outlined">chevron_right</span>            
            </a>

            <a href="#" class="sub-menu-link">
              <img src="img/help.png" alt="">
              <p>Aide et assistance</p>
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
        <?php else: ?>
            <div class="main">
            <spann class="fa fa-sign-out"></spann>
            <p><a href="connexion.php">Connexion</a><a href="inscription.php">Inscription</a></p>
            </div>
        <?php endif; ?>
        
    





</header>
<body>

    




    <div class="header__wrapper">
        <div class="cols__container">
          <div class="left__col">
            <div class="list-category">
                <h3>Tous les catégories</h3>
                <br>
                <ul>
                    <a href="vehicules.php"><li>Véhicules</li></a>
                    <a href="Immobilier.php"><li class="active-link">Immobilier</li></a>
                    <a href="emplois.php"><li>Emplois</li></a>
                    <a href="Multimédias.php"><li>Multimédias</li></a>
                    <a href="Animaux.php"><li>Animaux</li></a>
                    <a href="Telephones.php"><li>Telephones</li></a>
                    <a href="Meubles.php"><li>Meubles</li></a>
                    <a href="Mode.php"><li>Mode</li></a>
                    <a href="Services.php"><li>Services</li></a>
                    <a href="jeux.php"><li>Jeux</li></a>
                    <a href="autre.php"><li>Autre</li></a>
                </ul>
            </div>
            </di>
          </div>
          <div class="right__col">
            <nav>
              <ul>
                <li><a href="">Tous</a></li>
                <li><a href="">Voiture</a></li>
                <li><a href="">Moto</a></li>
                <li><a href="">Bateaux</a></li>
              </ul>
            </nav>
    
            <div class="main-wrapper">
              <div class="container">
                  <div class="main-title">
                  </div>
                  <div class="item-list">

                    <div class = "item">
                        <div class = "item-img">
                            <img src = "Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">
  
                        </div>
                        <div class = "item-detail">
                            <div class = "item-price">
                                <span class = "new-price">220.000 DT</span>
                                <span class = "old-price">275.60 DT</span>
                            </div>
                            <a href = "#" class = "item-name">Z750</a>
                            <a href = "#" class = "item-location">Bizerte</a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim consectetur cum?</p>
                            <button type = "button" class = "add-btn">add to cart</button>
                        </div>
                    </div>

                    <div class = "item">
                        <div class = "item-img">
                            <img src = "Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">
  
                        </div>
                        <div class = "item-detail">
                            <div class = "item-price">
                                <span class = "new-price">220.000 DT</span>
                                <span class = "old-price">275.60 DT</span>
                            </div>
                            <a href = "#" class = "item-name">Z750</a>
                            <a href = "#" class = "item-location">Bizerte</a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim consectetur cum?</p>
                            <button type = "button" class = "add-btn">add to cart</button>
                        </div>
                    </div>

                    <div class = "item">
                        <div class = "item-img">
                            <img src = "Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">
  
                        </div>
                        <div class = "item-detail">
                            <div class = "item-price">
                                <span class = "new-price">220.000 DT</span>
                                <span class = "old-price">275.60 DT</span>
                            </div>
                            <a href = "#" class = "item-name">Z750</a>
                            <a href = "#" class = "item-location">Bizerte</a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim consectetur cum?</p>
                            <button type = "button" class = "add-btn">add to cart</button>
                        </div>
                    </div>

                    <div class = "item">
                        <div class = "item-img">
                            <img src = "Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">
  
                        </div>
                        <div class = "item-detail">
                            <div class = "item-price">
                                <span class = "new-price">220.000 DT</span>
                                <span class = "old-price">275.60 DT</span>
                            </div>
                            <a href = "#" class = "item-name">Z750</a>
                            <a href = "#" class = "item-location">Bizerte</a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim consectetur cum?</p>
                            <button type = "button" class = "add-btn">add to cart</button>
                        </div>
                    </div>

                    <div class = "item">
                        <div class = "item-img">
                            <img src = "Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">
  
                        </div>
                        <div class = "item-detail">
                            <div class = "item-price">
                                <span class = "new-price">220.000 DT</span>
                                <span class = "old-price">275.60 DT</span>
                            </div>
                            <a href = "#" class = "item-name">Z750</a>
                            <a href = "#" class = "item-location">Bizerte</a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim consectetur cum?</p>
                            <button type = "button" class = "add-btn">add to cart</button>
                        </div>
                    </div>
                  </div>
                  </div>      
              </div>
              <br><br>
          </div>
          </div>
        </div>
      </div>
    


    

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