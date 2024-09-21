<div class="chat-content">
    <?php
    $messages = fetchMessages($_SESSION["user_id"]);

    if ($messages != false) : ?>

        <?php foreach ($messages as $message) : ?>

            <?php if ($message->from_user == $_SESSION["user_id"]) : ?>

                <?php if ($message->product_id != null) : ?>

                    <div class="message sender">

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
                                Product Unavailable
                            </div>
                        <?php endif ?>
                    </div>


                <?php else : ?>

                    <div class="message sender">
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

                    <div class="message reciever">

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
                                Product Unavailable
                            </div>
                        <?php endif ?>
                    </div>


                <?php else : ?>

                    <div class="message reciever">
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

</div>