<?php include "./includes/header-start.php"; ?>

<?php

$productInfo = [];

if (isset($_GET["product_id"])) {

    $sql = "SELECT * FROM products  WHERE product_id = :product_id ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $_GET["product_id"]);

    $stmt->execute();

    $productInfo = $stmt->fetch();
}



if (isset($_POST["edit_product"])) {


    $product_id = trim(htmlspecialchars($_POST["product_id"]));
    $product_name = trim(htmlspecialchars($_POST["product_name"]));
    $product_price = trim(htmlspecialchars($_POST["product_price"]));
    $product_description = trim(htmlspecialchars($_POST["product_description"]));

    $product_images = $_FILES["product_images"];

    $sql = "UPDATE products SET product_name = :product_name, product_price = :product_price, product_description = :product_description WHERE product_id = :product_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_name", $product_name);
    $stmt->bindParam("product_price", $product_price);
    $stmt->bindParam("product_description", $product_description);
    $stmt->bindParam("product_id", $product_id);

    if ($stmt->execute()) {


        uploadFile($product_images, $_POST["product_id"]);
        header("location: ./edit_product.php?success=Product information updated&product_id=" . $_POST["product_id"]);
    } else {
        header("location: ./edit_product.php?error=Unable to update information&product_id=" . $_POST["product_id"]);
    }
}

function uploadFile($files, $productId)
{
    include "./includes/db.php";




    for ($i = 0; $i < count($files["name"]); $i++) {

        $fileExt = explode(".", $files["name"][$i]);
        // MAKE SURE THE EXTENSION IS ALWAYS LOWER CASE
        $fileActualExt = strtolower(end($fileExt));

        $newFileName     = random_int(100000, 100000000) . "." . $fileActualExt;
        $fileDestination = "./product_images/" . $newFileName;



        if (move_uploaded_file($files["tmp_name"][$i], $fileDestination)) {

            $sql = "INSERT INTO product_images (product_id, image) VALUES(:product_id, :image)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam("product_id", $productId);

            $stmt->bindParam("image", $newFileName);

            $stmt->execute();
        }
    }
}


?>

<?php include "./includes/header-end.php" ?>

<div class="heading">
    <h1>Edit product</h1>

    <a href="./manage_products.php" class="back-btn">Manage products</a>
</div>

<form action="edit_product.php" class="form" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <label>Product name</label>
        <input type="text" value="<?php echo $productInfo->product_name ?>" name="product_name">
    </div>
    <div class="input-group">
        <label>Product price</label>
        <input type="text" name="product_price" value="<?php echo $productInfo->product_price ?>">
        <input type="hidden" name="product_id" value="<?php echo $productInfo->product_id ?>">
    </div>
    <div class="input-group">
        <label>Product description</label>
        <textarea name="product_description"><?php echo trim($productInfo->product_description) ?></textarea>
    </div>
    <div class="input-group">
        <label>Product images</label>
        <input type="file" multiple name="product_images[]">
    </div>

    <button name="edit_product" class="submit-btn">Add product</button>

</form>

<?php include "./includes/footer-start.php" ?>

<script>
    let submitBtn = document.querySelector(".submit-btn")



    let form = document.querySelector("form")


    submitBtn.addEventListener("click", (e) => {


        let productName = form.elements["product_name"].value
        let productPrice = form.elements["product_price"].value
        let productDescription = form.elements["product_description"].value
        let productImages = [...form.elements["product_images[]"].files]

        let allowedImageExtensions = ["png", "svg", "webp", "jpg", "jfif", "jpeg"]


        if (productName == "") {

            Notiflix.Notify.failure("Product name cannot be empty")

            e.preventDefault()


        } else if (productPrice == "") {

            Notiflix.Notify.failure("Product price cannot be empty")

            e.preventDefault()

        } else if (productDescription == "") {

            Notiflix.Notify.failure("Product description cannot be empty")

            e.preventDefault()
        } else if (productDescription.length < 10 || productDescription.length > 1000) {

            Notiflix.Notify.failure("Product description is too long or too short")

            e.preventDefault()
        } else {

            let isImageErr = false;

            productImages.forEach(img => {
                let imgExt = img.type.split("/")[1]



                if (!allowedImageExtensions.includes(imgExt) || imgExt == "") {

                    Notiflix.Notify.failure(` <b>${img.name}</b>  is not an allowed file`)
                    isImageErr = true;

                } else if (img.size / 1024 / 1024 >= 8) {

                    Notiflix.Notify.failure(` <b>${img.name}</b>  is too big`)
                    isImageErr = true;



                }


            })


            if (isImageErr == true) {
                e.preventDefault()
            }
        }



    })
</script>

<?php include "./includes/footer-end.php" ?>