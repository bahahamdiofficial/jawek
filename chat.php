
<?php

include "./database.php";

session_start();

if (isset($_SESSION["user_id"])) {

    $user = [];

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $conn->query($sql);

    if ($result->rowCount() == 1) {
        $user = $result->fetch();
    }
} else {
    header("location:./connexion.php");
}

function fetchMessages($from_user, $to_user)
{

    include "./database.php";



    $sql = "SELECT *
            FROM messages
            WHERE
            from_user = :from_user 
            AND 
            to_user = :to_user

            OR 

            from_user = :to_user
            AND 
            to_user = :from_user
            ORDER BY time_sent ASC
             ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("from_user", $from_user);

    $stmt->bindParam("to_user", $to_user);

    if ($stmt->execute()) {

        return $stmt->fetchAll();
    } else {

        return false;
    }
}
function fetchLastMessageByUser($user_id)
{

    include "./database.php";



    $sql = "SELECT *
            FROM messages
            WHERE
            from_user = :from_user 
            AND 
            to_user = :to_user

            OR 

            from_user = :to_user
            AND 
            to_user = :from_user
       
            ORDER BY time_sent DESC
            limit 1      
             ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("from_user", $_SESSION["user_id"]);

    $stmt->bindParam("to_user", $user_id);

    if ($stmt->execute()) {

        return $stmt->fetch();
    } else {

        return false;
    }
}

function fetchDistinctUsers($user_id)
{

    include "./database.php";



    $sql = " SELECT DISTINCT CASE 
                WHEN from_user = :userId THEN to_user
                WHEN to_user = :userId THEN from_user
            END AS other_user
            FROM messages
            WHERE from_user = :userId OR to_user = :userId
             ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("userId", $user_id);




    if ($stmt->execute()) {

        return $stmt->fetchAll();
    } else {

        return false;
    }
}

function fetchUser($user_id)
{

    include "./database.php";

    $sql = "SELECT * FROM user where id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("user_id", $user_id);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        return $stmt->fetch();
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


function fetchProduct($product_id)

{

    include "./database.php";


    $sql = "SELECT * FROM products WHERE product_id = :product_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam("product_id", $product_id);

    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        return $stmt->fetch();
    } else {
        return false;
    }
}



?>

<?php include "./inc/tmbl/header.php"; ?>




<link rel="stylesheet" href="./css/chat.css">

<body>



    <div class="chat-container">
        <div class="ongoing-chats">
            <h3>Boîte de réception</h3>
            <?php if (fetchDistinctUsers($_SESSION["user_id"]) != false) : ?>
                <?php foreach (fetchDistinctUsers($_SESSION["user_id"]) as $user) :

                ?>

                    <?php if (fetchUser($user->other_user) != false) :

                        $thisUser = fetchUser($user->other_user);


                    ?>
                        <?php if (fetchLastMessageByUser($thisUser->id) != false) : ?>

                            <a href="./chat.php?seller=<?php echo $thisUser->id ?>" class="chat">
                                <div class="user-profile-img">
                                    <img src="./Photos/<?php echo $thisUser->profile_pic ?>" alt="">
                                </div>
                                <div class="user-profile-details">
                                    <div class="user-name"><?php echo $thisUser->name ?></div>
                                    <!-- max words is 26 + elipsis -->
                                    <!-- <div class="chat-snippet">
                                        <?php echo substr(fetchLastMessageByUser($thisUser->id)->msg, 0, 26) ?> ...
                                    </div> -->
                                </div>
                            </a>
                        <?php endif ?>
                    <?php endif ?>

                <?php endforeach ?>
            <?php else : ?>

                <div class="note warning">
                    <span class="material-symbols-outlined">
                        warning
                    </span>

                    You have 0 messages
                </div>

            <?php endif ?>
        </div>
        <div class="chat-box">
            <div class="chat-content-header" id="header-user-profile">

            </div>

            <input type="hidden" id="user-id-get" value="<?php echo $_SESSION['user_id'] ?? '' ?>">

            <div class="chat-content">

                <?php if (isset($_GET["seller"])) : ?>

                    <?php
                    $messages = fetchMessages($_SESSION["user_id"], $_GET["seller"]);


                    if ($messages != false) : ?>

                        <?php foreach ($messages as $message) : ?>

                            <?php if ($message->from_user == $_SESSION["user_id"]) : ?>

                                <?php if ($message->product_id != null) : ?>

                                    <div data-message='<?php echo json_encode($message) ?>' class=" message sender">

                                        <div class="message-content"><?php echo $message->msg ?></div>

                                        <?php if (fetchProduct($message->product_id) != false) :
                                            $product = fetchProduct($message->product_id);
                                        ?>
                                            <a href="./product-details.php?product=<?php echo $product->product_id ?>" class="product-ref">
                                                <div class="product-img">
                                                    <?php if (fetchProductImages($message->product_id) != false) :
                                                        $images = fetchProductImages($message->product_id);

                                                        $img = reset($images);
                                                    ?>
                                                        <img src="./uploaded_img/<?php echo $img->image ?>" alt="">
                                                    <?php else : ?>
                                                        <img src="./Photos/def-product-img.jpg" alt="">

                                                    <?php endif ?>
                                                </div>
                                                <div class="product-content">
                                                    <?php echo substr($product->name, 0, 30) ?>
                                                </div>
                                            </a>

                                        <?php else : ?>
                                            <div class="minor-note error">
                                                Produit indisponible
                                            </div>
                                        <?php endif ?>
                                    </div>


                                <?php else : ?>

                                    <div data-message='<?php echo json_encode($message) ?>' class=" message sender">
                                        <div class="message-content"><?php echo $message->msg ?></div>
                                    </div>


                                <?php endif ?>


                                <?php

                                $messages = array_filter($messages, function ($thisMessage) use ($message) {
                                    return $thisMessage->from_user == 0;
                                })
                                ?>


                            <?php elseif ($message->to_user == $_SESSION["user_id"]) : ?>


                                <?php if ($message->product_id != null) : ?>

                                    <div data-message='<?php echo json_encode($message) ?>' class=" message reciever">

                                        <div data-message-id="<?php echo $message->msg_id ?>" class="message-content"><?php echo $message->msg ?></div>

                                        <?php if (fetchProduct($message->product_id) != false) :
                                            $product = fetchProduct($message->product_id);
                                        ?>
                                            <a href="./product-details.php?product=<?php echo $product->product_id ?>" class="product-ref">
                                                <div class="product-img">
                                                    <?php if (fetchProductImages($message->product_id) != false) :
                                                        $images = fetchProductImages($message->product_id);

                                                        $img = reset($images);
                                                    ?>
                                                        <img src="./uploaded_img/<?php echo $img->image ?>" alt="">
                                                    <?php else : ?>
                                                        <img src="./Photos/def-product-img.jpg" alt="">

                                                    <?php endif ?>
                                                </div>
                                                <div class="product-content">
                                                    <?php echo substr($product->name, 0, 30) ?>
                                                </div>
                                            </a>
                                        <?php else : ?>
                                            <div class="minor-note error">
                                                Produit indisponible
                                            </div>
                                        <?php endif ?>
                                    </div>


                                <?php else : ?>

                                    <div data-message='<?php echo json_encode($message) ?>' class=" message reciever">
                                        <div class="message-content"><?php echo $message->msg ?></div>
                                    </div>


                                <?php endif ?>



                            <?php endif ?>

                        <?php endforeach ?>






                    <?php else : ?>

                        <div class="note warning">
                            <span class="material-symbols-outlined">
                                warning
                            </span>

                            You have 0 messages
                        </div>

                    <?php endif ?>


                <?php else : ?>

                    <div class="no-message-selected">
                        <div class="img">
                            <img src="./Photos/no-messages.svg" alt="">
                        </div>
                        <div class="content">Commencez là où vous en étiez</div>
                    </div>

                <?php endif ?>


            </div>
            <div class="send-message-container">
                <?php if (isset($_GET["product"]) && !empty($_GET["product"])) : ?>
                    <div class="product" id="main-product">
                        <?php if (fetchProduct($_GET["product"]) != false) :

                            $product = fetchProduct($_GET["product"]);
                            $images = fetchProductImages($product->product_id);

                            $productImage = reset($images);

                        ?>

                            <div class="product-img">
                                <img src="./uploaded_img/<?php echo $productImage->image ?>" alt="">
                            </div>

                            <div class="product-content">
                                <div><?php echo $product->name ?></div>
                                <div><?php echo $product->price ?>DT</div>
                            </div>

                        <?php else : ?>

                            <div class="note error">
                                <span class="material-symbols-outlined">
                                    error
                                </span>

                                Product not fount
                            </div>

                        <?php endif ?>
                    </div>
                <?php endif ?>

                <input type="text" placeholder="Saisissez votre message" id="message-content">
                <input type="hidden" id="from-id" value="<?php echo $_SESSION["user_id"] ?>">
                <input type="hidden" id="to-id">
                <input type="hidden" id="product-id" value="
                <?php

                if (isset($_GET["product"])) {
                    echo $_GET["product"];
                } else {
                    echo "";
                }

                ?>">
                <button id="send-message">
                    <span class="material-symbols-outlined">
                        send
                    </span>

                </button>
            </div>
        </div>
    </div>


    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>
    <script src="js/main.js"></script>
    <script src="js/chat.js?v=1"></script>


</body>

</html>