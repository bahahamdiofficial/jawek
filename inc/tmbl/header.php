



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawek.tn | Site vente et achat en ligne tunisie </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Jawek, Jawek tn, Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="css/style.css?=1">
    <link rel="stylesheet" href="css/recentes.css?v=2">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;700;800&display=swap" rel="stylesheet">

    <script src="./js/script.js?v=1" defer></script>
    
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
            <input type="text" id="nav-search-text" placeholder="Recherchez dans Jawek..." />

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