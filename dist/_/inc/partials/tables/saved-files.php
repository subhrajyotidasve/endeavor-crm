<?php if (!empty($samples)) { ?>

    <div class="card mb-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table mb-0 table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>First Name</th>
                            <th>Size(bytes)</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Open</th>
                            <th>Delete</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // foreach ($samples as $sample) {
                        ?>
                        <tr>
                            <td class="align-middle">
                                
                            </td>
                            <td class="align-middle">
                            </td>
                            <td class="align-middle">
                            </td>
                            <td class="align-middle">
                            </td>
                            <td class="align-middle">
                            </td>
                            <td class="align-middle">
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