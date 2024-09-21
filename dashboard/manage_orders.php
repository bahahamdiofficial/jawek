<?php include "./includes/header-start.php";

$orders = [];

$sql = "SELECT * FROM orders";

$stmt = $conn->prepare($sql);

$stmt->execute();

if ($stmt->rowCount() >= 1) {

    $orders = $stmt->fetchAll();
}

if (isset($_GET["delivery_status"]) && isset($_GET["order_id"])) {

    $sql = "UPDATE orders SET delivery_status = 1 WHERE order_id = :order_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("order_id", $_GET["order_id"]);

    if ($stmt->execute()) {
        header("location:./manage_orders.php?success=Order marked as delivered");
    } else {
        header("location:./manage_orders.php?error=Unable to process request");
    }
}
if (isset($_GET["delete_order"]) && isset($_GET["order_id"])) {

    $sql = "DELETE FROM orders WHERE order_id = :order_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("order_id", $_GET["order_id"]);

    if ($stmt->execute()) {
        header("location:./manage_orders.php?success=Order deleted");
    } else {
        header("location:./manage_orders.php?error=Unable to process request");
    }
}



?>
<?php include "./includes/header-end.php" ?>


<div class="heading">
    <h1>Orders</h1>


    <a href="./add_product.php" class="back-btn">Add product</a>
</div>

<?php if (count($orders) >= 1) { ?>


    <div class="table-container">

        <table>
            <caption>
                Viewing <?php echo count($orders)  ?> products
            </caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product </th>
                    <th>Product price </th>
                    <th>User</th>
                    <th>Delivery address</th>
                    <th>Delivery status</th>
                    <th>Actions</th>
                </tr>

                <?php $index = 1;
                foreach ($orders as $order) { ?>


                    <tr>

                        <?php

                        $product;

                        $sql = "SELECT * FROM products  WHERE product_id = :product_id ";

                        $stmt = $conn->prepare($sql);

                        $stmt->bindParam("product_id", $order->product_id);

                        $stmt->execute();

                        $product = $stmt->fetch();
                        ?>

                        <td><?php echo $index ?></td>
                        <td><?php echo $product->product_name ?></td>
                        <td><?php echo $product->product_price ?></td>

                        <?php

                        $user;

                        $sql = "SELECT * FROM users  WHERE user_id = :user_id ";

                        $stmt = $conn->prepare($sql);

                        $stmt->bindParam("user_id", $order->user_id);

                        $stmt->execute();

                        $user = $stmt->fetch();
                        ?>

                        <td><?php echo $user->first_name . " " . $user->last_name ?></td>
                        <td><?php echo $order->delivery_address ?></td>
                        <td>
                            <?php if ($order->delivery_status == 0) { ?>
                                <span class="clr-primary">Pending delivery</span>
                            <?php } else { ?>
                                <span class="clr-accent">Delivered</span>
                            <?php } ?>
                        </td>
                        <td>

                            <div class="table-actions">
                                <div class="label">
                                    <span class="material-symbols-outlined expand">
                                        expand_more
                                    </span>
                                    actions
                                </div>

                                <div class="drop-down">
                                    <?php if ($order->delivery_status == 0) { ?>
                                        <a href="manage_orders.php?delivery_status&order_id=<?php echo $order->order_id ?>">

                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>

                                            Mark deliverd

                                        </a>
                                    <?php } ?>
                                    <a href="manage_orders.php?delete_order&order_id=<?php echo $order->order_id ?>">

                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>

                                        Delete

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
        You have no orders
    </div>

<?php } ?>




<?php include "./includes/footer-start.php" ?>

<script src="./js/table_actions.js"></script>

<?php include "./includes/footer-end.php" ?>