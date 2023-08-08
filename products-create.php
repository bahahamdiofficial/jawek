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

<?php

if(isset($_POST['add_product'])){

  $product_name = $_POST['product_name'];
  $product_category = $_POST['product_category'];
  $product_subcategory = $_POST['product_subcategory'];
  $product_location = $_POST['product_location'];
  $product_price = $_POST['product_price'];
  $product_image = $_FILES['product_image']['name'];
  $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
  $product_image_folder = 'uploaded_img/'.$product_image;

  if(empty($product_name) || empty($product_price) || empty($product_category) || empty($product_subcategory) || empty($product_location) || empty($product_image)){
     $message[] = 'Veuillez remplir tout';
  }else{
     $insert = "INSERT INTO products(name, price, category, subcategory, location, image) VALUES('$product_name', '$product_price', '$product_category', '$product_subcategory', '$product_location', '$product_image')";
     $upload = mysqli_query($mysqli,$insert);
     if($upload){
        move_uploaded_file($product_image_tmp_name, $product_image_folder);
        $message[] = 'Un nouveau produit a été ajouté';
     }else{
        $message[] = 'Impossible ajouter le produit';
     }
  }

};

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  mysqli_query($mysqli, "DELETE FROM products WHERE id = $id");
  header('location:products-create.php');
};



?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawek.tn | Créer une annonce </title>
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
    <script>
        $(document).ready(function(){

            $('#category').on('change',function(){
              var categoryID = $(this).val();
              if(categoryID){
                $.get(
                  "ajax.php",
                  {category: categoryID},
                  function(data){
                    $('#subcategory').html(data);
                  }
                );
              }else{
                $('#subcategory').html('<option>Sous-catégorie</option>');
              }

            })
        });
    </script>

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
        
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

            <div class="input_field">
                    <label>Importation de photos</label><br>
                    <input type="file" name="product_image" class="input" value="Ajouter des photos">
                </div>
                <div class="input_field">
                    <label>Choisir une catégorie</label>
                    <div class="column">
                        <div class="select-box">
                            <select id="category" name="product_category">
                                <option disabled selected>Catégorie</option>
                                <?php
                                include ('database.php');
                                $query = "SELECT * FROM category";
                                $do = mysqli_query($mysqli, $query);
                                while($row = mysqli_fetch_array($do)){
                                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                                ?>

                            </select>
                        </div>
    
                    </div>
                    <div class="input_field">
                    <label>Choisir une sous-catégorie</label>
                    <div class="column">
                        <div class="select-box">
                            <select id="subcategory" name="product_subcategory">
                                <option disabled selected>Sous-catégorie</option>
                                <?php
                                include ('database.php');
                                $query = "SELECT * FROM subcategory";
                                $do = mysqli_query($mysqli, $query);
                                while($row = mysqli_fetch_array($do)){
                                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                                ?>

                            </select>
                        </div>
    
                    </div>
                </div>
                <div class="input_field">
                    <label>Titre de l'annonce</label>
                    <input type="text" class="input" name="product_name"  >
                </div>

                <div class="input_field">
                    <label>Description</label>
                    <textarea name="product_description" id="Description" cols="30" rows="10"></textarea>
                </div>

                <div class="input_field">
                    <label>Prix (DT)</label>
                    <input type="number" class="input" placeholder="Entrez le prix" name="product_price">
                    <!-- <div class="dt">DT</div> -->
                </div>

                <div class="input_field">
                    <label>Governerat :</label>
                    <div class="column">
                        <div class="select-box">
                            <select id="location " name="product_location">
                                <option disabled selected>Selectionnez votre governerat</option>
                                <?php
                                include ('database.php');
                                $query = "SELECT * FROM Location";
                                $do = mysqli_query($mysqli, $query);
                                while($row = mysqli_fetch_array($do)){
                                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
    
                    </div>
                </div>

                <div class="input_field">
                    <label>Ville :</label>
                    <div class="column">
                        <div class="select-box">
                            <select id="location " name="product_location">
                                <option disabled selected>Selectionnez votre ville</option>
                                <?php
                                include ('database.php');
                                $query = "SELECT * FROM Location";
                                $do = mysqli_query($mysqli, $query);
                                while($row = mysqli_fetch_array($do)){
                                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
    
                    </div>
                </div>

                <div class="input_field">
                    <input type="submit" name="add_product" value="Publier" class="btn-create">
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