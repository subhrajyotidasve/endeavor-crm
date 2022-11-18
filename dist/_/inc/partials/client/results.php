<!-- test result files -->
<div class="card border-2 mb-4">
    <div class="card-header">Test Result Files</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6">
                    <p class="pt-2" style="color: #eb2440;">There are no file attatched to this case</p>
                </div>

                <div class="col-lg-6">
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / test result files -->


<!-- compare translated results -->
<div class="card border-2 mb-4">
    <div class="card-header">Compare Translated Results</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-3 bg-light border-end border-white">
                    <span class="d-flex text-dark my-auto py-2">Original File Name</span>
                </div>
                <div class="col-lg-2 bg-light border-end border-white">
                    <p class="d-flex text-dark my-auto py-2">Translated Filename</p>
                </div>
                <div class="col-lg-2 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Language</p>
                </div>
                <div class="col-lg-2 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Date Retrieved</p>
                </div>
                <div class="col-lg-3 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Language Convert</p>
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / compare translated results -->


<!-- results processed -->
<div class="card border-2 mb-4">
    <div class="card-header">Results Processed</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6">
                    <p class="pt-2" style="color: #eb2440;">No result sent to this client.</p>
                </div>

                <div class="col-lg-6">
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / results processed -->


<!-- add new results -->
<div class="card border-2 mb-4">
    <div class="card-header">Add New Results</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="date_sent">Date sent</label>
                       <input type="text" class="form-control" id="date_sent" name="date_sent" placeholder="Date Sent" value="" required="">
                     </div>
                    
                     <div class="mb-3">
                          <label for="notes" class="form-label">Notes /Comments</label>
                    <textarea class="form-control" id="notes" name="notes" placeholder="Type notes here..." rows="6"></textarea>
                     </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="sent_by">Sent By</label>
                        <select class="form-select valid" id="sent_by" name="sent_by" aria-invalid="false">
                            <option value="" selected>Please select...</option>
                            <option value="">ABCS</option>
                            <option value="">AVCD</option>
                            
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save</button>
                </div>
            </div>

            </div>

        </div>
    </form>

</div>
<!-- / add new results -->


<!-- results download approvals -->
<div class="card border-2 mb-4">
    <div class="card-header">Results Download Approvals</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-3 bg-light border-end border-white">
                    <span class="d-flex text-dark my-auto py-2">Filename</span>
                </div>
                <div class="col-lg-3 bg-light border-end border-white">
                    <p class="d-flex text-dark my-auto py-2">Download Status</p>
                </div>
                <div class="col-lg-3 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Approved/ Disapproved by</p>
                </div>
                <div class="col-lg-3 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Date</p>
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / results download approvals -->


<!-- client downloaded results email clicks -->
<div class="card border-2 mb-4">
    <div class="card-header">Client Downloaded Results (Email Link Clicks)</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6 bg-light border-end border-white">
                    <span class="d-flex text-dark my-auto py-2">Ip</span>
                </div>
                <div class="col-lg-6 bg-light border-end border-white">
                    <p class="d-flex text-dark my-auto py-2">Date</p>
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / client downloaded results email clicks -->


<!-- client downloaded results -->
<div class="card border-2 mb-0">
    <div class="card-header">Client Downloaded Results</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-4 bg-light border-end border-white">
                    <span class="d-flex text-dark my-auto py-2">Filename</span>
                </div>
                <div class="col-lg-4 bg-light border-end border-white">
                    <p class="d-flex text-dark my-auto py-2">Ip</p>
                </div>
                <div class="col-lg-4 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Date</p>
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / client downloaded results -->