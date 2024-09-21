<title>Dashboard | Jawek.tn </title>
</head>

<body>

    <nav class="sidenav">

        <div class="logo">
            <img src="./img/logo-alt.png" alt="">
        </div>
        <ul class="nav-list">
            <li class="list-item">
                <a href="./" class="link">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    Dashboard
                </a>
            </li>

            <li class="list-item">

                <a href="./manage_products.php" class="link">
                    <span class="material-symbols-outlined">
                        package
                    </span>
                    Produits

                </a>


            </li>

            <li class="list-item">
                <a href="./verification_requests" class="link">
                    <span class="material-symbols-outlined">
                        verified
                    </span>
                    Verification requests
                </a>
            </li>

            <li class="list-item">
                <a href="./manage_users.php" class="link">
                    <span class="material-symbols-outlined">
                        group
                    </span>
                    Les utilisateurs
                </a>
            </li>

            <li class="list-item drop-btn">

                <a href="#" class="link">
                    <span class="material-symbols-outlined">
                        admin_panel_settings
                    </span>
                    Admin
                    <span class="material-symbols-outlined expand">
                        expand_more
                    </span>
                </a>

                <ul class="drop-down">
                    <li>
                        <a href="./new_admin.php">
                            <span class="material-symbols-outlined">
                                person_add
                            </span>
                            Nouvel administrateur
                        </a>
                    </li>

                    <li>
                        <a href="./manage_admins.php">
                            <span class="material-symbols-outlined">
                                groups
                            </span>
                            Les administrateurs
                        </a>
                    </li>

                </ul>
            </li>

        </ul>

    </nav>

    <main class="main-content-container">
        <nav class="topnav">

            <div class="burger">
                <span class="material-symbols-outlined">
                    menu
                </span>
            </div>

            <div class="user-profile drop">
                <div class="profile-name">
                    <?php echo $_SESSION["admin_name"] ?>
                </div>

                <span class="material-symbols-outlined expand">
                    expand_more
                </span>

                <div class="drop-down">

                    <a href="./my_profile.php" class="logout-btn">
                        Paramètres
                        <span class="material-symbols-outlined">
                            arrow_right_alt
                        </span>
                    </a>
                    <a href="./logout.php" class="logout-btn">
                        Déconnecter
                        <span class="material-symbols-outlined">
                            arrow_right_alt
                        </span>
                    </a>
                </div>
            </div>
        </nav>

        <div class="main-content">