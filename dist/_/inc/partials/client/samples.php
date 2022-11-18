
<div class="card border-2 mb-4">
    <div class="card-header">Current Sample</div>

    <div class="card-body text-dark">
        <?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/tables/samples.php"); ?>
            <div class="table-responsive mt-2">
                <table class="table">
                  <thead class="table-light">
                    <tr>
                      <td width="170" scope="col" class="border-end border-white">Relationship</td>
                      <td width="190" scope="col" class="border-end border-white">Name</td>
                      <td width="120" scope="col" class="border-end border-white">DOB</td>
                      <td width="120" scope="col" class="border-end border-white">Gender</td>
                      <td width="309" scope="col" class="border-end border-white">Notes</td>
                      <td width="190" scope="col" class="border-end border-white">Type</td>
                      <td width="110" scope="col" class="border-end border-white">Added Date</td>
                      <td width="110"scope="col" class="border-end border-white">Added By</td>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <td width="170"></td>
                      <td width="190"></td>
                      <td width="120"></td>
                      <td width="120"></td>
                      <td width="309"></td>
                      <td width="190"></td>
                      <td width="110"></td>
                      <td width="110"></td>
                    </tr>     -->              
                </tbody>
                </table>
            </div>
    </div>

</div>
<!-- / current sample -->


<!-- link expiration -->
<div class="card border-2 mb-4">
    <div class="card-header">Link Expiration</div>
    
    <div class="card-body text-dark">
    <div class="row">
        <div class="col-lg-3 bg-light border-end border-white">
            <span class="d-flex text-dark my-auto py-2">Is Expired?</span>
        </div>
        <div class="col-lg-3 bg-light border-end border-white">
            <p class="d-flex text-dark my-auto py-2">No</p>
        </div>
        <div class="col-lg-3 bg-light border-end border-white" >
            <p class="d-flex text-dark my-auto py-2">Renew(hours)</p>
        </div>
        <div class="col-lg-3 bg-light border-end border-white">
            

            <div class="row">
                <div class="col-lg-3 mt-2">
                    <select class="form-select valid py-0 my-auto" id="renewhours" name="renewhours" aria-invalid="false">
                        <option value="0" selected>0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        
                    </select>
                </div>
                <div class="col-lg-9">
                    <button type="button" class="btn btn-sm border">Renew</button>
                </div>
            </div>
            
            
        </div>
    </div>
  </div>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
    </div>


</div>
<!-- / link expiration -->


<!-- result email input -->
<div class="card border-2 mb-4">
    <div class="card-header">Result Email Input</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6 bg-light border-end border-white">
                     
                        <span class="d-flex text-dark my-auto py-2">Email Input by client</span>
                    
                </div>

                <div class="col-lg-6 bg-light border-end border-white">
                </div>

            </div>

            <!-- <div class="row mt-2">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Update</button>
                </div>
            </div> -->

        </div>
    </form>

</div>
<!-- / result email input -->


<!-- sample details -->
<div class="card border-2 mb-4">
    <div class="card-header">Sample Details: Participant Samples Details</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6 mb-3">
                    <div class="mb-3">
                        <label class="form-label" for="relationship">Relationship</label>
                        <select class="form-select valid" id="relationship" name="relationship" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="text" class="form-control" id="dob" name="dob" placeholder="Date of Birth" value="" required="">
                     </div> 
                     <div class="mb-3">
                         <label for="date_shipped" class="form-label">Date Shipped</label>
                        <input type="text" class="form-control" id="date_shipped" name="date_shipped" placeholder="Date Shipped" value="" required="">
                     </div>    
                     <div class="mb-3">
                          <label for="Notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" placeholder="Type notes here..." rows="6"></textarea>
                     </div>
                    
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="customer_name" placeholder="Name" value="" required="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gender">Gender</label>
                        <select class="form-select valid" id="Gender" name="gender" aria-invalid="false">
                            <option value="" selected>Please select...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            
                        </select>
                    </div>

                   

                    <div class="mb-3">
                        <label class="form-label" for="sample_type">Sample Type</label>
                        <select class="form-select valid" id="sample_type" name="sample_type" aria-invalid="false">
                            <option value="" selected>Please select...</option>
                        </select>
                    </div>

                    

                </div>

                
                

            </div>

            <div class="row mt-2">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save</button>
                </div>
            </div>

        </div>
    </form>

</div>
<!-- / sample details -->


<!-- animal test samples -->
<div class="card border-2 mb-0">
    <div class="card-header">Animal Test Samples: Pet Sample Detail <small>(for pet tests only)</small></div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6 mb-3">
                    <div class="mb-3">
                        <label for="dob" class="animal_name">Name</label>
                        <input type="text" class="form-control" id="animal_name" name="animal_name" placeholder="Animal Name" value="" required="">
                     </div> 
                    <div class="mb-3">
                        <label class="form-label" for="animal_type">Animal Type</label>
                        <select class="form-select valid" id="animal_type" name="animal_type" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                            <option value="">Type 1</option>
                            <option value="">Type2</option>
                            <option value="">Type3</option>
                        </select>
                     </div>
                     
                     <div class="mb-3">
                         <label for="animal_date_shipped" class="form-label">Date Shipped</label>
                        <input type="text" class="form-control" id="animal_date_shipped" name="animal_date_shipped" placeholder="Date Shipped" value="" required="">
                     </div>    
                     <div class="mb-3">
                          <label for="Notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" placeholder="Type notes here..." rows="6"></textarea>
                     </div>
                    
                </div>

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label" for="animal_gender">Gender</label>
                        <select class="form-select valid" id="animal_gender" name="animal_gender" aria-invalid="false">
                            <option value="" selected>Please select...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            
                        </select>
                    </div>

                   

                    <div class="mb-3">
                        <label class="form-label" for="animal_sample_type">Sample Type</label>
                        <select class="form-select valid" id="animal_sample_type" name="animal_sample_type" aria-invalid="false">
                            <option value="" selected>Please select...</option>
                        </select>
                    </div>

                    

                </div>

            </div>

            <div class="row mt-2">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save</button>
                </div>
            </div>

        </div>
    </form>

</div>
