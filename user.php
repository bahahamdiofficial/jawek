

<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

}else{
  header("location:connexion.php");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawek.tn | Mon Compte </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">    <link rel="stylesheet" href="<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


</head>

<header>
    <a href="index.php">
        <img src="Photos/logos/logo.png" alt="" class="logo">
        </a>
    <div class="navbar">
        <div class="searchBox">
            <input type="text" placeholder="Recherche de produits ..."  />
            <span class="fas fa-search" id="searchIcon"></span>
            
        </div>
    </div>
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
            <a href="user.php">
            <div class="user-info">
              <img src="photos/avatar/default_profile.jpg">

              <h3><?= htmlspecialchars($user["name"]) ?></h3>
            </div>
          </a>
            <hr>
            
            <a href="user.php" class="sub-menu-link">
              <img src="img/profile.png" alt="">
              <p>Profil</p>
              <span class="material-symbols-outlined">chevron_right</span>            
            </a>

            <a href="edit-profile.php" class="sub-menu-link">
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
            <span class="fa fa-sign-out"></span>
            <p><a href="connexion.php">Connexion</a><a href="inscription.php">Inscription</a></p>
            </div>
        <?php endif; ?>
    
       
</header>
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
          <img src="photos/avatar/default_profile.jpg" alt="Baha Hamdi" />
          <span></span>
        </div>
       


        <h2><?= htmlspecialchars($user["name"]) ?> <i class="fa-solid fa-circle-check" style="  siza: 1px;  font-size: 16px;  color: #0093ff; top: 3px;"></i></h2>
        <!-- <h4>@<?= htmlspecialchars($user["name"]) ?></h4> -->

        <p>Welcome to my profile</p>


    
        <div class="info-nbr">
            
            <div class="nbr-follow">
                1787 abonnés
            </div>
            |
            <div class="nbr-pub">
                4 publications
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
            <li data-cont=".mes_achats">Mes achats</li>

          </ul>
        </nav>

        <div class="main-wrapper">
          <div class="container">
              <div class="mes_produits">
                
                  <div class = "item">
                      <div class = "item-img">
                          <img src = "Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                      </div>
                      <div class = "item-detail">
                          <div class = "item-price">
                              <span class = "new-price">22 220.000 DT</span>
                              <span class = "old-price">23 275.60 DT</span>
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

              <div class="mes_favoires">
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

              <div class="mes_pause">
               
                <div class = "item">
                        <div class = "item-img">
                            <img src = "Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">

                        </div>
                        <div class = "item-detail">
                            <div class = "item-price">
                                <span class = "new-price">22 220.000 DT</span>
                                <span class = "old-price">23 275.60 DT</span>
                            </div>
                            <a href = "#" class = "item-name">Z750</a>
                            <a href = "#" class = "item-location">Bizerte</a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim consectetur cum?</p>
                            <button type = "button" class = "add-btn">add to cart</button>
                        </div>
                    </div>


                    
              </div>

              <div class="mes_ventes">
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

              <div class="mes_achats">
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
          <br><br>
      </div>

      </div>
      <br><br><br><br><br>
    </div>
<script>

  let subMenu = document.getElementById("subMenu");

  function toggleMenu(){
    subMenu.classList.toggle("open-menu");
  }
  
</script>
<script src="js/main.js"></script>
  
    
</body>
</html>