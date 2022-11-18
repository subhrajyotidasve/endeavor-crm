<?php if (empty($payments)) { ?>

    <?php // foreach($payments as $payment) { 
    ?>
    <div class="alert alert-warning mb-0">
        <p><strong>Payment received for: <test_ref></strong></p>
        <div class="row table-responsive">
            <div class="col-lg-6">
                <table class="table mb-0 table-borderless table-nopadding">
                    <tbody>
                        <tr>
                            <th scope="row">Payment success</th>
                            <td>PAID</td>
                        </tr>
                        <tr>
                            <th scope="row">Date</th>
                            <td>22 September 2022</td>
                        </tr>
                        <tr>
                            <th scope="row">Amount (GBP)</th>
                            <td>159.00</td>
                        </tr>
                        <tr>
                            <th scope="row">Payment method</th>
                            <td>Stripe</td>
                        </tr>
                        <tr>
                            <th scope="row">Payment ref</th>
                            <td>9206-ikvnpidfvju0p3i45tvgj</td>
                        </tr>
                        <tr>
                            <th scope="row">Processed by</th>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th scope="row">Cardholder name</th>
                            <td>Caroline Jenkins</td>
                        </tr>
                        <tr>
                            <th scope="row">Tax Rate (%) (AU only)</th>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <label for="field_name text-dark" class="form-label">Details</label>
                <textarea class="form-control" id="field_name" name="field_name" placeholder="" rows="10" value="" disabled></textarea>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bx bx-edit"></i> Edit Payment</button>
        </div>
        <?php // } 
        ?>
    </div>

<?php } else { ?>

    <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/alerts/nothing-found.php"); ?>

<?php } ?>