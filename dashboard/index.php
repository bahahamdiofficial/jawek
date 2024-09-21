<?php include "./includes/header-start.php" ?>

<link rel="stylesheet" href="./css/index.css">

<?php include "./includes/header-end.php" ?>


<div class="logo">
    <img src="./img/logo-alt.png" alt="">
</div>

<div class="quick-links">
    <div class="link">
        <div class="link-img">
            <img src="./img/users.svg" alt="">
        </div>
        <div class="link-content">
            <h3>Les membres</h3>
            <a href="./manage_users.php">
                Voir plus

                <span class="material-symbols-outlined">
                    chevron_right
                </span>

            </a>
        </div>
    </div>
    <div class="link">
        <div class="link-img">
            <img src="./img/pending-users.svg" alt="">
        </div>
        <div class="link-content">
            <h3>Membres en attente</h3>
            <a href="./verification_requests">
                Voir plus

                <span class="material-symbols-outlined">
                    chevron_right
                </span>

            </a>
        </div>
    </div>
    <div class="link">
        <div class="link-img">
            <img src="./img/products.svg" alt="">
        </div>
        <div class="link-content">
            <h3>Produits</h3>
            <a href="./manage_products.php">
                Voir plus

                <span class="material-symbols-outlined">
                    chevron_right
                </span>

            </a>
        </div>
    </div>
</div>

<?php include "./includes/footer-start.php" ?>



<?php include "./includes/footer-end.php" ?>