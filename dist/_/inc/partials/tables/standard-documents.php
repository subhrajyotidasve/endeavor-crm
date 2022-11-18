<?php if (!empty($samples)) { ?>

    <div class="card mb-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table mb-0 table-striped">
                    <thead class="table-light">
                        <tr>
                            <th width="250" class="border-end border-white">Ref</th>
                            <th >Title</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // foreach ($samples as $sample) {
                        ?>
                        <tr>
                            <td width="250" class="align-middle border-end border-white">
                            </td>
                            <td class="align-middle">
                            </td>
                            
                        </tr>
                        <?php // } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php Pagination::pageLinks(); ?>

<?php } else { ?>

    <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/alerts/nothing-found.php"); ?>

<?php }
?>