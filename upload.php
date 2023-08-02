<?php 


if (isset($_POST['submit']) && isset($_FILES['image-product'])) {
    echo "heollo";
}else {
    header("Location: products-create.php");
}