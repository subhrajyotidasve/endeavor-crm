<header class="my-account-head">
    <h1 class="my-account-head__h1"><?php echo $accountTitle; ?></h1>

    <div class="my-account-head__avatar-wrap">
        <svg aria-hidden="true" class="my-account-head__avatar" viewBox="0 0 100 100">
            <title>Profile Avatar</title>
            <use xlink:href="<?=$svg_sprite_url?>#icon-ca-avatar"></use>
        </svg>
        <span class="my-account-head__name">Hello <? echo $_SESSION['customer']['first_name']; ?></span>
        <?php $customerId = $_SESSION['customer']['id']; ?>
    </div>
</header>