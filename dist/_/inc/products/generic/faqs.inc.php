<section class="row questions">

    <h2 class="questions__h2">Frequently Asked Questions</h2>
    <p class="questions__copy">Please find below our most popular questions relating to this product. To view our full list of FAQ's and to be able to post your own question you can always check out our dedicated <a href="/support/faqs/">FAQ page.</a> If this doesn't answer your question, you can alternatively <a href="/support/contact/">contact</a> the Jay-Be<sup>&reg;</sup> Customer Care team who will be more than happy to help you.</p>

    <div class="list questions__the-list">

        <?php
        $product_category = $products[0]['product_category'];
//        echo '<p>Category: '.$product_category.'</p>';
        $faqs = Faqs::getFaqs($product_category);
//        echo 'FAQs found: '.var_dump($faqs);

        foreach ($faqs as $faq) { ?>
        <div class="questions__accord-wrap mix all-prod">
            <button class="questions__accord-question"><?php echo $faq['question']; ?></button>
            <div class="questions__accord-content">
                <?php echo $faq['answer']; ?>

                <?php if (false) { ?>
                <aside class="questions__accord-tip">
                    <svg role="presentation" class="questions__accord-icon" viewBox="0 0 100 100">
                        <use xlink:href="<?=$svg_sprite_url?>#icon-bulb"></use></svg>
                    <div class="questions__accord-answer questions__accord-answer--tip"><span class="questions__accord-answer--tip--strong">Quick Tip!</span>
                        <?php the_field('tip'); ?></div>
                </aside>
                <?php } ?>

            </div>
        </div><!-- questions__accord-wrap -->
        <?php } ?>

    </div><!-- list -->

</section><!-- questions -->