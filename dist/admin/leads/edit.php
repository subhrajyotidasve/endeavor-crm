<?php
$pageTitle = 'Leads | Edit Lead';
$menuItem1 = 'leads';
$menuItem2 = 'edit-lead';

require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.header.inc.php");
$lead = DB::run('SELECT * FROM leads WHERE id =?', [$_GET['lead_id']])->fetch();
$titles = DB::run("SELECT * FROM customer_titles WHERE language = 'EN'")->fetchAll();
$contact_methods = DB::run('SELECT * FROM contact_methods')->fetchAll();
$lead_note_actions = Lead::getLeadActions();
$lead_note_categories = Lead::getLeadCategories();
$lead_notes = Lead::getLeadNotes($_GET['lead_id']);
$lead_status = Lead::getLeadStatus($lead['lead_status_id']);
$lead_statuses = Lead::getLeadStatuses();
// var_dump($lead['lead_status_id']);
// var_dump($lead_status);
?>

<div id="sticky_tabs">

    <!-- breadcrumb -->
    <div class="container-fluid g-0">
        <div class="row g-0">

            <div class="col-lg-9 page-breadcrumb d-none d-sm-flex align-items-center mb-2 text-left">
                <div class="breadcrumb-title pe-3">
                    <a href="/<?= ADMIN_FOLDER ?>/leads/new-requests/"><?= $lead['customer_first_name'] . ' ' . $lead['customer_last_name'] ?></a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page"><span>Case ref:</span> <?= $lead['case_reference'] ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Status:</span> <?= $lead_status ?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-lg-3 align-items-center mb-3">
                <div class="btn-group float-end">
                    <a href="/<?= ADMIN_FOLDER ?>/leads/add.php" type="button" class="btn btn-primary"><i class="bx bx-list-plus"></i> New Lead</a>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/<?= ADMIN_FOLDER ?>/leads/add.php">Action</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
    <!-- end breadcrumb -->


    <!-- tabs -->
    <ul class="nav nav-pills nav-fill mb-3">
        <li class="nav-item">
            <a class="nav-link active" id="view-tab" data-bs-toggle="tab" data-bs-target="#view" type="button" role="tab" aria-controls="view" aria-selected="true">View</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab" aria-controls="edit" aria-selected="false">Edit</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="samples-tab" data-bs-toggle="tab" data-bs-target="#samples" type="button" role="tab" aria-controls="samples" aria-selected="false">Samples</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab" aria-controls="payments" aria-selected="false">Payments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="results-tab" data-bs-toggle="tab" data-bs-target="#results" type="button" role="tab" aria-controls="results" aria-selected="false">Results</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="results-tab" data-bs-toggle="tab" data-bs-target="#notestab" type="button" role="tab" aria-controls="notestab" aria-selected="false">Notes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="email-log-tab" data-bs-toggle="tab" data-bs-target="#email-log" type="button" role="tab" aria-controls="email-log" aria-selected="false">Email Log</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="status-history-tab" data-bs-toggle="tab" data-bs-target="#status-history" type="button" role="tab" aria-controls="status-history" aria-selected="false">Status History</a>
        </li>
    </ul>
    <!-- end tabs -->

</div>

<div id="tab_content">

    <!-- tab content -->
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="view" role="tabpanel" aria-labelledby="view-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/view.php"); ?>
        </div>

        <div class="tab-pane fade show" id="edit" role="tabpanel" aria-labelledby="edit-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/edit.php"); ?>
        </div>

        <div class="tab-pane fade" id="samples" role="tabpanel" aria-labelledby="samples-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/samples.php"); ?>
        </div>

        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/contacts.php"); ?>
        </div>

        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/documents.php"); ?>
        </div>

        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/payments.php"); ?>
        </div>

        <div class="tab-pane fade" id="results" role="tabpanel" aria-labelledby="results-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/results.php"); ?>
        </div>

        <div class="tab-pane fade" id="notestab" role="tabpanel" aria-labelledby="notes-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/notes.php"); ?>
        </div>

        <div class="tab-pane fade" id="email-log" role="tabpanel" aria-labelledby="email-log-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/email-log.php"); ?>
        </div>

        <div class="tab-pane fade" id="status-history" role="tabpanel" aria-labelledby="status-history-tab">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/client/status-history.php"); ?>
        </div>

    </div>
    <!-- end tab content -->

</div>


<?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.footer.inc.php"); ?>