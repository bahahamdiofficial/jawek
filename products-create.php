<?php

session_start();


include "./database.php";

$error = "";


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


if (isset($_SESSION["user_id"])) {

  $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

  $result = $conn->query($sql);

  $user = $result->fetch();
} else {

  header("location: ./connexion.php");
}

?>

<?php

if (isset($_POST['add_product'])) {

  $name = trim(htmlspecialchars($_POST['name']));
  $category = trim(htmlspecialchars($_POST['category']));
  $subcategory = trim(htmlspecialchars($_POST['subcategory']));
  $product_condition = trim(htmlspecialchars($_POST['product_condition']));
  $location = trim(htmlspecialchars($_POST['location']));
  $city = trim(htmlspecialchars($_POST['city']));
  $price = trim(htmlspecialchars($_POST['price']));
  $description = trim(htmlspecialchars($_POST['description']));
  $alt_phone_number = trim(htmlspecialchars($_POST['alt_phone_number']));

  $images = $_FILES['product_images'];
  $productId = rand(100000, 999999);

  if (!empty($name) && !empty($category) && !empty($product_condition)  && !empty($product_condition) && !empty($subcategory) && !empty($location) && !empty($city) && !empty($price) && !empty($description)) {

    if (count($images["name"]) < 10 ||  $images["name"] > 1) {
      $sql = "INSERT INTO products 
          SET 
          product_id = :product_id,
          name = :name,
          price = :price,
          description = :description,
          category = :category,
          subcategory = :subcategory,
          product_condition = :product_condition,
          location = :location,
          city = :city,
          user_id = :user_id,
          alt_phone_number = :alt_phone_number,
          created_at = NOW()
          ";

      $stmt = $conn->prepare($sql);

      $stmt->bindParam("product_id", $productId);

      $stmt->bindParam("name", $name);
      $stmt->bindParam("price", $price);
      $stmt->bindParam("description", $description);
      $stmt->bindParam("category", $category);
      $stmt->bindParam("subcategory", $subcategory);
      $stmt->bindParam("product_condition", $product_condition);
      $stmt->bindParam("location", $location);
      $stmt->bindParam("city", $city);
      $stmt->bindParam("user_id", $_SESSION["user_id"]);
      $stmt->bindParam("alt_phone_number", $alt_phone_number);


      if ($stmt->execute()) {

        uploadFile($images, $productId);

        header("location: ./products-create.php?success=Un nouveau produit a été ajouté");
      } else {

        header("location: ./products-create.php?error=Impossible ajouter le produit");
      }
    } else {

      $error = "Le nombre d'images doit être compris entre 1 et 10";
    }
  } else {

    $error = "Information manquante";
  }
}

function uploadFile($files, $productId)
{
  for ($i = 0; $i < count($files["name"]); $i++) {


    $fileExt = explode(".", $files["name"][$i]);
    // MAKE SURE THE EXTENSION IS ALWAYS LOWER CASE
    $fileActualExt = strtolower(end($fileExt));

    $newFileName     = random_int(100000, 100000000) . "." . $fileActualExt;
    $fileDestination = "./uploaded_img/" . $newFileName;



    if (move_uploaded_file($files["tmp_name"][$i], $fileDestination)) {


      include "./database.php";

      $sql = "INSERT INTO product_images (image_id, product_id, image) VALUES(:image_id, :product_id, :image)";

      $stmt = $conn->prepare($sql);

      $stmt->bindParam("image_id", rand(100000, 999999));

      $stmt->bindParam("product_id", $productId);

      $stmt->bindParam("image", $newFileName);

      $stmt->execute();
    }
  }
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($mysqli, "DELETE FROM products WHERE id = $id");
  header('location:products-create.php');
};


?>



<?php include "./inc/tmbl/header.php" ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<link rel="stylesheet" href="./libraries/mklb/css/mklb.css">

<link rel="stylesheet" href="./css/products-create.css">


<body style="background-color: #f6f5f7;">

  <?php

  if (isset($message)) {
    foreach ($message as $message) {
      echo '<span class="message">' . $message . '</span>';
    }
  }

  ?>


  <section class="container-create">
    <div class="title">Créer une annonce</div>



    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

      <?php if (!empty($error)) : ?>
        <div class="note error">
          <span class="material-symbols-outlined">
            error
          </span>
          <?php echo $error ?>
        </div>
      <?php endif ?>

      <div class="input_field">
        <label>Importation de photos</label>
        <input type="file" multiple name="product_images[]" class="input" value="Ajouter des photos">
      </div>
      <div class="input_field">
        <label>Choisir une catégorie</label>
        <div class="column">
          <div class="select-box">

            <?php if (!empty($categories)) : ?>

              <select name="category" id="category">

                <option value="" selected>Sélectionnez et option</option>

                <?php foreach ($categories as $category) : ?>

                  <option value="<?php echo $category->id ?>">

                    <?php echo $category->name ?>

                  </option>

                <?php endforeach ?>

              </select>

            <?php endif ?>

          </div>
        </div>
      </div>
      <div class="input_field">
        <label>Choisir une sous-catégorie</label>
        <div class="column">
          <div class="select-box">
            <select id="subcategory" name="subcategory">
              <option disabled selected>Sous-catégorie</option>
            </select>
          </div>

        </div>
      </div>
      <div class="input_field">
        <label>État du produit</label>
        <div class="column">
          <div class="select-box">
            <select name="product_condition" id="">
              <option value="" selected>Sélectionnez et option</option>
              <option value="Neuf">Neuf</option>
              <option value="comme_neuf">D’occasion - comme neuf</option>
              <option value="good_condition">D’occasion - bon état</option>
              <option value="bon_état">D’occasion - bon état</option>
            </select>
          </div>
        </div>
      </div>

      <div class="input_field">
        <label>Titre de l'annonce</label>
        <input type="text" class="input" name="name">
      </div>

      <div class="input_field">
        <label>Description</label>
        <textarea name="description" id="Description" cols="30" rows="10"></textarea>
      </div>


      <div class="input_field">
        <label>Prix (DT)</label>
        <input type="number" class="input" placeholder="Entrez le prix" name="price">
        <!-- <div class="dt">DT</div> -->
      </div>

      <div class="input_field">
        <label>Governerat :</label>
        <div class="column">
          <div class="select-box">

            <?php if (!empty($locations)) : ?>

              <select name="location" id="location">

                <option value="" selected>Sélectionnez et option</option>


                <?php foreach ($locations as $location) : ?>

                  <option value="<?php echo $location->id ?>">

                    <?php echo $location->name ?>

                  </option>

                <?php endforeach ?>

              </select>

            <?php endif ?>
          </div>

        </div>
      </div>

      <div class="input_field">
        <label>Ville :</label>
        <div class="column">
          <div class="select-box">

            <?php if (!empty($categories)) : ?>

              <select name="city" id="city">

                <option value="">Sélectionnez une ville</option>

              </select>

            <?php endif ?>
          </div>

        </div>
      </div>
      <div class="input-field">
        <label>Utiliser le numéro de téléphone principal</label>
        <div class="pretty p-switch p-fill">
          <input id="is-number-checked" type="checkbox" checked />
          <div class="state">
            <label>Oui</label>
          </div>
        </div>
        <input id="alt-phone" type="text" placeholder="Autre numéro de téléphone" name="alt_phone_number">
      </div>
      
      <div class="btn-publier">
                <div class="input_field">
        <input type="submit" name="add_product" value="Publier" class="btn-create">
      </div>
      </div>


    </form>

  </section>



  <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
      subMenu.classList.toggle("open-menu");
    }
  </script>
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



  <script src="./libraries/jquery/jquery.js"></script>

  <script src="./libraries/mklb/js/mklb.js"></script>

  <script src="./js/products-create.js"></script>
</body>

</html>