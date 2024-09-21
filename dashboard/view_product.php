<?php include "./includes/header-start.php";


$productInfo = ["hello"];
$productImages = [];


if (isset($_GET["product"])) {

    $sql = "SELECT * FROM products  WHERE product_id = :product_id ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $_GET["product"]);

    $stmt->execute();

    $productInfo = $stmt->fetch();


    $sql = "SELECT * FROM product_images  WHERE product_id = :product_id ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $_GET["product"]);

    $stmt->execute();


    $productImages = $stmt->fetchAll();
}


if (isset($_GET["activate"]) && isset($_GET["product"])) {


    $sql = "UPDATE products 
            SET is_active = 1
            WHERE 
            product_id = :product_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $_GET["product"]);

    if ($stmt->execute()) {

        header("location: ./view_product?product=" . $_GET["product"] . "&success=Product activated");
    } else {
        header("location: ./view_product?product=" . $_GET["product"] . "&error=Unable to activate product");
    }
}

if (isset($_GET["deactivate"]) && isset($_GET["product"])) {


    $sql = "UPDATE products 
            SET is_active = 0
            WHERE 
            product_id = :product_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $_GET["product"]);

    if ($stmt->execute()) {

        header("location: ./view_product?product=" . $_GET["product"] . "&success=Product deactivated");
    } else {
        header("location: ./view_product?product=" . $_GET["product"] . "&error=Unable to deactivate product");
    }
}


?>


<link rel="stylesheet" href="./css/view_product.css">

<?php include "./includes/header-end.php" ?>


<div class="product-info">
    <?php if (count($productImages) >= 1) { ?>
        <div class="product-images">
            <?php foreach ($productImages as $image) { ?>
                <div class="img">
                    <div class="img-actual">

                        <img src="https://jawek.tn/uploaded_img/<?php echo $image->image ?>" alt="">

                    </div>


                </div>


            <?php } ?>


        </div>
    <?php } else { ?>

        <div class="note error">
            <span class="material-symbols-outlined">
                warning
            </span>
            Ce produit n'a pas d'images
        </div>

    <?php } ?>

    <div class="product-details">
        <div class="detail"><b>ID PRODUIT</b> : <?php echo $productInfo->product_id ?></div>
        <h2 class="detail"> <?php echo $productInfo->name ?></h2>
        <p class="detail">
            <?php echo $productInfo->description ?>

        </p>
    </div>

    <div class="product-controls">

        <?php if ($productInfo->is_active) : ?>

            <a class="delete" href="./view_product.php?deactivate&product=<?php echo $productInfo->product_id ?>">

                <span class="material-symbols-outlined">
                    toggle_off
                </span>

                Désactiver le produit

            </a>

        <?php else : ?>

            <a class="activate" href="./view_product.php?activate&product=<?php echo $productInfo->product_id ?>">

                <span class="material-symbols-outlined">
                    toggle_on
                </span>

                Activer le produit

            </a>

        <?php endif ?>
    </div>
</div>


<?php include "./includes/footer-start.php" ?>




<?php include "./includes/footer-end.php" ?>