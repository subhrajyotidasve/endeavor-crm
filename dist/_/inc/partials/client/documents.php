<!-- standard documents -->
<div class="card border-2 mb-4">
    <div class="card-header">Standard Documents</div>

    <div class="card-body text-dark">
        <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/tables/standard-documents.php"); ?>
        
    </div>

</div>
<!-- / standard documents -->


<!-- swab acknowledgments -->
<div class="card border-2 mb-4">
    <div class="card-header">Swab Acknowledgments</div>

    <div class="card-body text-dark">
        <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/tables/swab-acknowledgments.php"); ?>
    </div>

</div>
<!-- / swab acknowledgments -->


<!-- saved files -->
<div class="card border-2 mb-4">
    <div class="card-header">Saved Files</div>

    <div class="card-body text-dark">
        <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/tables/saved-files.php"); ?>
    </div>

</div>
<!-- / saved files -->


<!-- other documents -->
<div class="card border-2 mb-4">
    <div class="card-header">Other Documents</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                 <div class="col-lg-2 bg-light border-end border-white">
                    <!-- <span class="d-flex text-dark my-auto py-2"><i class="fa-solid fa-file"></i></span> -->
                    <div class="font-35 text-dark text-center align-items-center"><i style="color: #e97a02;" type='solid' class="bx bx-folder"></i>
                    </div>
                </div>
                <div class="col-lg-10 bg-light">
                    <p class="my-auto py-3 text-success" style="text-decoration: underline;">Other standard letters and forms that are not show here can also be printed for this client</p>
                </div>



            </div>

        </div>
    </form>

</div>
<!-- / other documents -->


<!-- upload files -->
<div class="card border-2 mb-4">
    <div class="card-header">Upload Files</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6 mb-3">
                    <label for="file_description" class="form-label">File Description</label>
                    <input type="text" class="form-control" id="file_description" name="file_description" placeholder="File Description" value="">
                </div>

                <div class="col-lg-6">
                </div>

                <div class="col-lg-6">
                    <input id="image-uploadify" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
                </div>

                <div class="col-lg-6">
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / upload files -->


<!-- downloadable forms -->
<div class="card border-2 mb-0">
    <div class="card-header">Downloadable Forms</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                 <div class="col-lg-2 bg-light border-end border-white">
                    <!-- <span class="d-flex text-dark my-auto py-2"><i class="fa-solid fa-file"></i></span> -->
                    <div class="font-35 text-dark text-center align-items-center"><i style="color: #e97a02;" type='solid' class="bx bx-folder"></i>
                    </div>
                </div>
                <div class="col-lg-10 bg-light">
                    <p class="my-auto py-3 text-success" style="text-decoration: underline;">Use this list to create the PDF downloadable forms for cuatomers.</p>
                </div>



            </div>

        </div>
    </form>

</div>
<!-- / downloadable forms -->