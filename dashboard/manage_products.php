<?php include "./includes/header-start.php";

$products = [];

$sql = "SELECT * FROM products";

$stmt = $conn->prepare($sql);

$stmt->execute();

if ($stmt->rowCount() >= 1) {

    $products = $stmt->fetchAll();
}



?>
<?php include "./includes/header-end.php" ?>


<div class="heading">
    <h1>Les produits</h1>



</div>

<?php if (count($products) >= 1) { ?>


    <div class="table-container">

        <table>
            <caption>
                Afficher <?php echo count($products)  ?> produits
            </caption>
            <thead>
                <tr>
                    <th>Produit ID</th>
                    <th>Produit nom</th>
                    <th>Produit prix</th>
                    <th>Actions</th>
                </tr>

                <?php $index = 1;
                foreach ($products as $product) { ?>


                    <tr>

                        <td><?php echo $index ?></td>
                        <td><?php echo substr($product->name, 0, 40) ?>...</td>
                        <td><?php echo $product->price ?></td>
                        <td>

                            <div class="table-actions">
                                <div class="label">
                                    <span class="material-symbols-outlined expand">
                                        expand_more
                                    </span>
                                    actions
                                </div>

                                <div class="drop-down">
                                    <a href="./view_product.php?product=<?php echo $product->product_id ?>">

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        Voir le produit

                                    </a>


                                </div>
                            </div>

                        </td>

                    </tr>

                <?php

                    $index++;
                }
                ?>

            </thead>
        </table>
    </div>

<?php } else { ?>

    <div class="note error">
        <span class="material-symbols-outlined">
            warning
        </span>
        Vous n'avez pas de produits
    </div>

<?php } ?>




<?php include "./includes/footer-start.php" ?>

<script src="./js/table_actions.js"></script>

<?php include "./includes/footer-end.php" ?>