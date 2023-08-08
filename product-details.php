

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
    <title>Product Details</title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="css/category.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/product-details.css">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">    
    <link rel="stylesheet" href="<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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
              <h3><?= htmlspecialchars($user["name"]) ?> </h3>
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
    <div class="container-details">
        <div class="box-details">
            <div class="images">
                <div class="img-holder active">
                    <img src="imgs/headphone.jpg">
                </div>
                <div class="img-holder">
                    <img src="imgs/ph1.jpg">
                </div>
                <div class="img-holder">
                    <img src="imgs/headphone.jpg">
                </div>
                <div class="img-holder">
                    <img src="imgs/headphone.jpg">
                </div>
            </div>
            <div class="basic-info">
                <h1>Headphone</h1>
                <div class="price">
                    <span>250 DT</span>
                    <span class="old-price">275.60 DT</span>
                </div>
                <div class="date-location">
                <a  class="item-time">Publié il y a 5 semaines </a> , <a  class="item-location">Bizerte</a>
                </div>
                <!-- <h2 style="padding-top: 20px;">Informations de vendeur</h2> -->

                <div class="user-info" style="padding-bottom: 20px;">
              <img src="photos/avatar/default_profile.jpg" style="width: 44px;">
              <h3><?= htmlspecialchars($user["name"]) ?> <i class="fa-solid fa-circle-check" style="    siza: 1px;    font-size: 16px;    color: #0093ff;    top: 3px;    "></i></h3>
              <button>Suivre</button>
              <button class="message">Envoyer un message</button>
              <button class="fav"><i class='fa fa-bookmark'></i></button>
              <!-- <button class="signal"><i class='fa-solid fa-circle-info'></i></button> -->
            </div>
             
                

               
            </div>
            <div class="description">
                <h2>Détails</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus temporibus corporis repudiandae, consectetur nostrum nisi commodi placeat rerum molestias numquam nihil accusantium deleniti! Enim, nesciunt a quis amet hic officia. Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae nemo accusantium tempora facere doloremque cum iusto, ut neque, fuga omnis libero laborum ullam. At dolorum qui atque labore illo dignissimos.</p>

                
            </div>


        </div>
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