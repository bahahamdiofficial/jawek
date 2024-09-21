<?php

session_start();

include "./database.php";

$user = [];


if (isset($_SESSION["user_id"])) {


    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $conn->query($sql);

    $user = $result->fetch();
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




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawek.tn | Privacy Policy for Jawek </title>
    <meta name="description" content="site vente et achat en ligne tunisie">
    <meta name="keywords" content="Location, Vente, Achat, Tunisie, e-commerce, services, cava.tn, tayara.tn">
    <link rel="stylesheet" href="css/style.css?=1">
    <link rel="stylesheet" href="css/recentes.css?v=1">
    <script src="https://kit.fontawesome.com/eee7d68921.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Photos/icons/icon.png">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="./js/script.js" defer></script>
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9867407934959822"
     crossorigin="anonymous"></script>

</head>






<header>
    <a href="index.php">
        <img src="Photos/logos/logo.png" alt="" class="logo">
    </a>
    <div class="navbar">
        <div class="searchBox">
            <input type="text" placeholder="Recherchez dans Jawek..." />
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
        <?php else : ?>
            <div class="main">
            <spann class="fa fa-sign-out"></spann>
            <p><a href="connexion.php">Connexion</a><a href="inscription.php">Inscription</a></p>
            </div>
        <?php endif; ?>
    </div>







</header>
<body>

<div class="privacy-policy">

<h1>Privacy Policy for Jawek</h1>

<p>At Jawek, accessible from https://jawek.tn/, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Jawek and how we use it.</p>

<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>

<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Jawek. This policy is not applicable to any information collected offline or via channels other than this website.</p>

<h2>Consent</h2>

<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

<h2>Information we collect</h2>

<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

<h2>How we use your information</h2>

<p>We use the information we collect in various ways, including to:</p>

<ul>
<li>Provide, operate, and maintain our website</li>
<li>Improve, personalize, and expand our website</li>
<li>Understand and analyze how you use our website</li>
<li>Develop new products, services, features, and functionality</li>
<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
<li>Send you emails</li>
<li>Find and prevent fraud</li>
</ul>

<h2>Log Files</h2>

<p>Jawek follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p>

<h2>Cookies and Web Beacons</h2>

<p>Like any other website, Jawek uses "cookies". These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>

<h2>Google DoubleClick DART Cookie</h2>

<p>Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to www.website.com and other sites on the internet. However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL – <a href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a></p>


<h2>Advertising Partners Privacy Policies</h2>

<P>You may consult this list to find the Privacy Policy for each of the advertising partners of Jawek.</p>

<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Jawek, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>

<p>Note that Jawek has no access to or control over these cookies that are used by third-party advertisers.</p>

<h2>Third Party Privacy Policies</h2>

<p>Jawek's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>

<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>

<p>Under the CCPA, among other rights, California consumers have the right to:</p>
<p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
<p>Request that a business delete any personal data about the consumer that a business has collected.</p>
<p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

<h2>GDPR Data Protection Rights</h2>

<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
<p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
<p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
<p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
<p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
<p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
<p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

<h2>Children's Information</h2>

<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

<p>Jawek does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>

<h2>Changes to This Privacy Policy</h2>

<p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately, after they are posted on this page.</p>

<p>Our Privacy Policy was created with the help of the <a href="https://www.termsfeed.com/privacy-policy-generator/">Privacy Policy Generator</a>.</p>

<h2>Contact Us</h2>

<p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.</p>

</div>

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