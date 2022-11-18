<nav class="my-account-nav">

    <ul class="my-account-nav__list">

        <li class="my-account-nav__list-item">
            <a class="my-account-nav__link" href="/account/dashboard" aria-label="View the dashboard">
                <svg aria-hidden="true" class="my-account-nav__icon" viewBox="0 0 100 100">
                    <use xlink:href="<?=$svg_sprite_url?>#icon-ca-overview"></use>
                </svg>
                Dashboard
            </a>
        </li>

        <li class="my-account-nav__list-item <?php if($accountSection == 'profile') {echo("my-account-nav__list-item--active"); } ?>">
            <a class="my-account-nav__link" href="/account/edit-profile" aria-label="Edit your profile">
                <svg aria-hidden="true" class="my-account-nav__icon" viewBox="0 0 100 100">
                    <use xlink:href="<?=$svg_sprite_url?>#icon-ca-profile"></use>
                </svg>
                Edit Profile
            </a>
        </li>

        <li class="my-account-nav__list-item <?php if($accountSection == 'address') {echo("my-account-nav__list-item--active"); } ?>">
            <a class="my-account-nav__link" href="/account/address-books" aria-label="Manage your addresses">
                <svg aria-hidden="true" class="my-account-nav__icon" viewBox="0 0 100 100">
                    <use xlink:href="<?=$svg_sprite_url?>#icon-ca-address"></use>
                </svg>
                Address Book
            </a>
        </li>

        <li class="my-account-nav__list-item <?php if($accountSection == 'order') {echo("my-account-nav__list-item--active"); } ?>">
            <a class="my-account-nav__link" href="/account/order-history" aria-label="View your order history">
                <svg aria-hidden="true" class="my-account-nav__icon" viewBox="0 0 100 100">
                    <use xlink:href="<?=$svg_sprite_url?>#icon-ca-order"></use>
                </svg>
                Order History
            </a>
        </li>

        <li class="my-account-nav__list-item <?php if($accountSection == 'guarantee') {echo("my-account-nav__list-item--active"); } ?>">
            <a class="my-account-nav__link" href="/account/register-product" aria-label="View or register your Jay-Be Guarantees">
                <svg aria-hidden="true" class="my-account-nav__icon" viewBox="0 0 100 100">
                    <use xlink:href="<?=$svg_sprite_url?>#icon-ca-register"></use>
                </svg>
                Your Guarantees
            </a>
        </li>

        <li class="my-account-nav__list-item <?php if($accountSection == 'wishlist') {echo("my-account-nav__list-item--active"); } ?>">
            <a class="my-account-nav__link" href="/account/wishlist" aria-label="Manage your wishlists">
                <svg aria-hidden="true" class="my-account-nav__icon" viewBox="0 0 100 100">
                    <use xlink:href="<?=$svg_sprite_url?>#icon-ca-wishlist"></use>
                </svg>
                Wishlist
            </a>
        </li>

        <li class="my-account-nav__list-item <?php if($accountSection == 'marketing') {echo("my-account-nav__list-item--active"); } ?>">
            <a class="my-account-nav__link" href="/account/marketing" aria-label="Manage your marketing preferences">
                <svg aria-hidden="true" class="my-account-nav__icon" viewBox="0 0 100 100">
                    <use xlink:href="<?=$svg_sprite_url?>#icon-ca-marketing"></use>
                </svg>
                Marketing
            </a>
        </li>

        <li class="my-account-nav__list-item">
            <a class="my-account-nav__link" href="/account/logout" aria-label="Logout">
                <svg aria-hidden="true" class="my-account-nav__icon" viewBox="0 0 100 100">
                    <use xlink:href="<?=$svg_sprite_url?>#icon-ca-logout"></use>
                </svg>
                Logout
            </a>
        </li>

    </ul>

</nav><!-- my-account-nav -->