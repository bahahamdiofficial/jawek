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
    <title>Jawek.tn | Paramètres </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
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
    
 
    <div class="main-profill">
        <i class="fa-solid fa-envelope"></i>
        <!-- <a href="ma-compte.html">Profil</a> -->
        <i class="fa-solid fa-bell"></i>



        <img src="photos/avatar/default_profile.jpg" class="user-pic" onclick="toggleMenu()">
        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <a href="profile.php">
            <div class="user-infoo">
              <img src="photos/avatar/default_profile.jpg">
              <h3>Baha Hamdi</h3>
            </div>
          </a>
            <hr>
            
            <a href="user.php" class="sub-menu-link">
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
   
    
       
</header>

<body style="background-color: #f6f5f7;">




<section class="container-edit">
        <div class="title">Modifier profil</div>
        
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">


            <div class="input_field">
                    <label>Modifier la photo de profil</label><br>
                    <input type="file" name="profile_pic" class="input" value="Ajouter des photos">
                </div>

                <div class="input_field">
                    <label>Nom</label>
                    <input type="text" class="input" name="name"  >
                </div>

                <div class="input_field">
                    <label>Nom d'utilisateur</label>
                    <input type="text" class="input" name="username"  >
                </div>

                <div class="input_field">
                    <label>Email</label>
                    <input type="text" class="input" name="email"  >
                </div>

                <div class="input_field">
                    <label>Numéro de tél</label>
                    <input type="phone" class="input" name="phone" placeholder="+216 " >
                </div>

                <div class="input_field">
                    <label>Bio</label>
                    <textarea name="bio" id="Description" cols="30" rows="10"></textarea>
                </div>



                <div class="input_field">
                    <input type="submit" name="add_product" value="Envoyer" class="btn-create">
                </div>

        </form>
        
</section>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script>

    let subMenu = document.getElementById("subMenu");
  
    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
    }
    
  </script>
</body>
</html>