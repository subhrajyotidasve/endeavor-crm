<main role="main" id="main-content" class="customer-admin">
    <section class="row my-account">
        <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
        <nav class="my-account-breadcrumb">
        <ul class="my-account-breadcrumb__list">
				<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard/">Dashboard</a></li>
				<li class="my-account-breadcrumb__list-item">Wishlist</li>
			</ul>
		</nav>
        <div class="my-account-grid-wrap">
            <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>
            <!-- my-account-nav -->
            <section>
                <p class="my-account__copy">Your wishlist is currently empty.</p>
                <a class="my-account__button" href="/">Start Shopping</a>
            </section>
        </div><!-- my-account-grid-wrap -->
		<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
    </section><!-- my-account -->
</main>
<?php include("../../_/inc/footer.inc.php"); ?>