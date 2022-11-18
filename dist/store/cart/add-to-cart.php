<div class="viewer__info-box">
    <div class="viewer__info-box__order-box">
        <div class="viewer__info-box__order-box__quanity">
            <label class="viewer__info-box__order-box__quanity--label">Quantity</label>

            <div class="viewer__info-box__order-box__quanity__quantity-box">
                <div class="viewer__info-box__order-box__quanity__quantity-box--item">
                    <button class="viewer__info-box__order-box__quanity__quantity-box--subtract subtract-quantity" type="button" onclick="minusQuantity()"></button>
                </div>
                <div class="viewer__info-box__order-box__quanity__quantity-box--item">
                    <div class="quantity-amount" id="quantity-amount">1</div>
                    <input id="product-quantity" type="hidden" value="1">
                </div>
                <div class="viewer__info-box__order-box__quanity__quantity-box--item">
                    <button class="viewer__info-box__order-box__quanity__quantity-box--add add-quantity" type="button" onclick="plusQuantity()"></button>
                </div>
            </div>
        </div>

        <div class="viewer__info-box__order-box--size">

            <?php if ($category['type'] == 'SIZES') { ?>

                <?php if ((count($products)) > 1) { ?><label class="viewer__info-box__order-box--size--label">Size</label> <?php } ?>
                <select name="product_size" id="size" class="viewer__info-box__order-box--size--selector" <?php if ((count($products)) == 1) {
                                                                                                                echo 'style="visibility: hidden;"';
                                                                                                            } ?>>

                    <?php foreach ($products as $product) { ?>
                        <option id="id_product_size" data-price="<?php echo $product['product_price']; ?>" data-was="<?php echo $product['product_was_price']; ?>" value="<?php echo $product['id']; ?>"><?php echo $product['size']; ?> (&pound;<?php echo $product['product_price']; ?>)</option>
                    <?php } ?>
                </select>

            <?php } else if ($category['type'] == 'COLOR') { ?>

                <label class="viewer__info-box__order-box--size--label">Fabric</label>
                <select name="product_size" id="size" class="viewer__info-box__order-box--size--selector">

                    <?php
                    $counter = 0;
                    foreach ($products as $product) {
                        if (!empty($product['color'])) {
                    ?>
                            <option id="id_product_size" value="<?php echo $product['id']; ?>"><?php echo $product['color']; ?></option>
                    <?php
                        }
                        $counter++;
                    }
                    ?>
                </select>

            <?php } else if ($category['type'] == 'MODEL') { ?>

                <label class="viewer__info-box__order-box--size--label">Model</label>
                <select name="product_size" id="size" class="viewer__info-box__order-box--size--selector">
                    <?php
                    foreach ($products as $product) {
                        if (!empty($product['model'])) {
                    ?>
                            <option id="id_product_size" data-price="<?php echo $product['product_price']; ?>" value="<?php echo $product['id']; ?>"><?php echo $product['model']; ?> (&pound;<?php echo $product['product_price']; ?>)</option>
                    <?php
                        }
                    }
                    ?>
                </select>

            <?php } ?>

        </div>
    </div>

    <div class="viewer__info-box">
        <div class="viewer__info-box__order-now">
            <svg aria-hidden="true" class="viewer__info-box__delivery-icon" viewBox="0 0 100 100">
                <use xlink:href="<?= $svg_sprite_url ?>#icon-delivery-van"></use>
            </svg>
            <?php
            if ($products[0]['in_stock'] == '1') {
                if ($products[0]['product_category'] == '3') {
            ?>
                    <span class="viewer__info-box__order-message">Made to order, ready for despatch in 4 to 6 weeks</span>
                    <?php } else { ?>
                    <span class="viewer__info-box__order-message">Order now and get it by <?= date('l jS F', strtotime(Dates::deliveryDate())) ?></span>
                <?php
                }
            } else { ?>
                <span class="viewer__info-box__order-message">This product is currently out of stock</span>
            <?php } ?>
        </div>
    </div>

    <div class="viewer__info-box">
        <input type="hidden" name="product_id" id="product_id" value="<?= $products[0]['id'] ?>" />
        <button class="viewer__add-to-cart-btn shop-btn-bg<?php if ($products[0]['in_stock'] == '0') {
                                                        echo ' shop-btn-bg--disabled';
                                                    } ?>" onclick="addItems()" <?php if ($products[0]['in_stock'] == '0') {
                                                                                    echo 'disabled';
                                                                                } ?>>Add to basket
                        <svg class="shop-btn-bg__icon" aria-hidden="true" viewBox="0 0 100 100">
                            <use xlink:href="<?=$svg_sprite_url?>#icon-cart"></use>     
                        </svg></button>
    </div>

    <input type="checkbox" name="wished_for" id="wished_for" hidden <?= $wished ? 'checked' : '' ?> />
    </form>