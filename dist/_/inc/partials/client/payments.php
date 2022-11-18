<!-- payments processed -->
<div class="card border-2 mb-4">
    <div class="card-header">Payments Processed</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/tables/payments-processed.php"); ?>
        </div>
    </form>

</div>
<!-- / payments processed -->


<!-- add new payment -->
<div class="card border-2 mb-0">
    <div class="card-header">Add New Payment</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6">

                    <div class="mb-3">
                        <label class="form-label" for="test_service">Test / Service</label>
                        <select class="form-select valid" id="test_service" name="test_service" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="payment_received">Payment Received</label>
                        <select class="form-select valid" id="payment_received" name="payment_received" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                        </select>
                    </div>

                    <div class="mb-3">

                        <label for="payment_date" class="form-label">Payment Date</label>
                        <input type="date" class="form-control" id="payment_date" name="payment_date" placeholder="Payment date" value="">
                    </div>

                    <div class="mb-3">
                         <div class="row">
                            <div class="col-lg-4 mt-2">
                                <label for="payment_amount" class="form-label">Payment Amount</label>
                                <input type="text" class="form-control" id="payment_amount" name="payment_amount" placeholder="Payment amount" value="">
                            </div>
                            <div class="col-lg-8 mt-2">
                                <label class="form-label" for="amounttype"></label>
                                <select class="form-select valid mt-2" id="amounttype" name="amounttype" aria-invalid="false">
                                    <option value="" selected="">Please select...</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="express_kit">Express Kit</label>
                        <select class="form-select valid" id="express_kit" name="express_kit" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="result_post">Result by Post</label>
                        <select class="form-select valid" id="result_post" name="result_post" aria-invalid="false">
                            <option value="" selected>Please select...</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="express_test">Express Test</label>
                        <select class="form-select valid" id="express_test" name="express_test" aria-invalid="false">
                           <option value="" selected>Please select...</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="mb-3">
                        <label for="tax_rate" class="form-label">Tax Rate (%)</label>
                        <input type="text" class="form-control" id="tax_rate" name="tax_rate" placeholder="Tax rate (%)" value="">
                    </div>

                    <div class="mb-3">
                        <label for="payment_reference" class="form-label">Payment Reference</label>
                        <input type="text" class="form-control" id="payment_reference" name="payment_reference" placeholder="Payment reference" value="">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="payment_method">Payment Method</label>
                        <select class="form-select valid" id="payment_method" name="payment_method" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="payment_notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="payment_notes" name="payment_notes" placeholder="Type notes here..." rows="11"></textarea>
                    </div>

                </div>

                <div class="row mt-2">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save Payment</button>
                    </div>
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / add new payment -->