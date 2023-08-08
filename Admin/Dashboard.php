


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawek.tn | Dashboard </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../Photos/icons/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">    <link rel="stylesheet" href="<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


</head>

<header>
    <a href="../index.php">
        <img src="../Photos/logos/logo.png" alt="" class="logo">
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



        <img src="../photos/avatar/default_profile.jpg" class="user-pic" onclick="toggleMenu()">
        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <a href="profile.php">
            <div class="user-infoo">
              <img src="../photos/avatar/default_profile.jpg">
              <h3>Baha Hamdi</h3>
            </div>
          </a>
            <hr>
            

            <a href="#" class="sub-menu-link">
              <img src="../img/setting.png" alt="">
              <p>Paramètres</p>
              <span class="material-symbols-outlined">chevron_right</span>            
            </a>

            <a href="logout.php" class="sub-menu-link">
              <img src="../img/logout.png" alt="">
              <p>Se déconnecter</p>
              <!-- <span>></span> -->
            </a>
          </div>
        </div>
    </div>
   
    
       
</header>

<body style="background-color: #f6f5f7;">

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>


<section class="container-create">
        <div class="title">Créer une annonce</div>
        

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

