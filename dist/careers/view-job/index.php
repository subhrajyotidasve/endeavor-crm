<?php
$currentPage = 'careers';
$pageTitle = 'We are currently looking for a Stores Person';
$metaDes = 'Work with us at Jay-Be&reg;, we are currently looking for a Stores Person';
include("../../_/inc/header.inc.php");
$job = Post::get($_GET['id']);
?>

<div class="outer-wrap outer-wrap--btm-margin banner banner--the-position">
        <h1 class="banner__h1"><?= $job['post_title'] ?><span class="banner__h1--date">Date posted: <?= date('F d, Y', strtotime($job['post_date'])) ?></span></h1>
    </div>

    <main role="main" id="main-content">

        <section class="row generic-copy">


            <article class="generic__article">
                <?= $job['post_content'] ?>
            </article>



        </section>

    </main>

<?php include("../../_/inc/footer.inc.php"); ?>
