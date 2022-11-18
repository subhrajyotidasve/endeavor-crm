<?php
$currentPage = 'careers';
$pageTitle = 'Work with us at Jay-Be&reg; the industry leader in Folding Guest Beds, Sofas, Sofa Beds and other Sleep Smart Products';
$metaDes = 'Work with us at Jay-Be&reg; the industry leader in Folding Guest Beds, Sofas, Sofa Beds and other Sleep Smart Products';
include("../_/inc/header.inc.php");
//require('../data/wp-blog-header.php'); 
$jobs = Post::all('job');
?>

<div class="outer-wrap outer-wrap--btm-margin banner banner--careers">
    <h1 class="banner__h1">Work with us</h1>
</div>

<main role="main" id="main-content">

    <section class="row generic">


        <article class="generic__article">

            <h3 class="generic__h3">Work with Jay-Be<sup>&reg;</sup></h3>
            <p class="generic__copy">Passion, design and innovation form the heart of Jay-Be<sup>&reg;</sup> and we are extremely proud to manufacture every one of our folding guest beds in our Yorkshire factory.</p>

            <p class="generic__copy">Jay-Be<sup>&reg;</sup> is growing at a fast but sustained rate and we are always on the look out for talented individuals at all levels to help strengthen our team. Working for Jay-Be<sup>&reg;</sup> you will be working in a warm friendly environment that's relaxed, passionate and professional. Are you just the right person for the following position(s)?</p>

            <h3 class="generic__h3">Application Form</h3>
            <p class="generic__copy"><a href="/_/docs/careers/jay-be-application-form.docx">Download</a> a copy of our Application Form.</p>

        </article>


        <?php                    
            if (!empty($jobs)) {
            foreach($jobs as $job) {
                ?>

                <article class="generic__article generic__article--narrow">
    
                    <h3 class="generic__h3 generic__h3--topPadd"><?= $job['post_title'] ?></h3>
                    <p class="generic__copy generic__copy--small-bottom-margin"><?= $job['post_excerpt'] ?></p>
                    <p class="generic__copy generic__copy--emphasise">Date posted: <?= date('F d, Y', strtotime($job['post_date'])) ?></p>
    
                    <a class="generic__button generic__button--margin-top" href="/careers/view-job/?id=<?= $job['id'] ?>">View this position</a>
    
                </article>

                <?php 
                } // end foreach

            } else {
        ?>

        <article class="generic__article generic__article--narrow">

            <h3 class="generic__h3 generic__h3--topPadd">Currently open positions</h3>
            <p class="generic__copy">Sorry, we don't currently have any positions available. Please check back in the near future as any new positions will be posted as soon as they become available.</p>

        </article>

        <?php
            } // end if $jobs not empty
        ?>

    </section>

</main>

<?php include("../_/inc/footer.inc.php"); ?>