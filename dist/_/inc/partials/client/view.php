<!-- order status -->
<div class="card border-2 mb-4">
    <div class="card-header">Order Status</div>

    <form action="" method="post" id="lead_status_update_form">
        <div class="card-body text-dark">
            <div class="row">

                <div class="col-lg-3 bg-light border-end border-white">
                     
                        <span class="d-flex text-dark my-auto py-2">Status</span>
                    
                </div>

                <div class="col-lg-3 bg-light border-end border-white">
                    <span class="d-flex text-dark my-auto py-2">Waiting Office Confirmation</span>
                </div>
                <div class="col-lg-6 bg-light border-end border-white">
                    <span class="d-flex text-success my-auto py-2" style="text-decoration: underline;">Hide Status Update</span>
                    
                </div>

            </div>
            <div class="row">

                <div class="col-lg-6">

                    <div class="mb-3">
                        <label for="lead_status_id" class="form-label">New Status</label>
                        <select class="form-select valid" name="lead_status_id" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                            <?php foreach ($lead_statuses as $status) { ?>
                                <option value="<?= $status['id'] ?>"<?php echo ($lead['lead_status_id'] == $status['id']) ? 'selected' : ''; ?> ><?= $status['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select valid" name="category_id" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                            <?php foreach ($lead_note_categories as $category) { ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                     <div class="mb-3">
                        <label for="added_by" class="form-label">Added by</label>
                        <input type="text" readonly="" class="form-control" id="added_by" name="added_by" placeholder="" value="ABCD" required="">
                    </div>
                    <div class="mb-3">
                        <label for="date_time" class="form-label">Date / Time</label>
                        <input type="text" readonly="" class="form-control" id="date_time" name="date_time" placeholder="" value="<?php $ctti = date("Y-m-d h:i:sa"); echo $ctti; ?>" required="">
                    </div>

                </div>

                <!-- previous notes -->
                <div class="col-lg-6">

                    <div class="mb-3">
                        <label for="content" class="form-label">Details</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Type notes here..." rows="4"></textarea>
                    </div>


                </div>

            </div>

            <!-- hidden fields -->
            <input type="hidden" class="form-control" name="lead_id" value="<?= $lead['id'] ?>">
            <input type="hidden" class="form-control" name="user_id" value="<?= $_SESSION['customer']['id'] ?>">

            <div class="row mt-2">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Update Status</button>
                </div>
            </div>

        </div>
    </form>

</div>
<!-- end order status -->



<div class="card border-2 mb-4">
    <div class="card-header">Linked Cases &nbsp<a href="">Add Link</a></div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-3 bg-light border-end border-white">
                    <span class="d-flex text-dark my-auto py-2">Case Reference</span>
                </div>
                <div class="col-lg-3 bg-light border-end border-white">
                    <p class="d-flex text-dark my-auto py-2">Added on</p>
                </div>
                <div class="col-lg-3 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Added by</p>
                </div>
                <div class="col-lg-3 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Status</p>
                </div>

            </div>

        </div>
    </form>

</div>
<div class="card border-2 mb-4">
    <div class="card-header">Current Flags</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-3 bg-light border-end border-white">
                    <span class="d-flex text-dark my-auto py-2">Flag Type</span>
                </div>
                <div class="col-lg-3 bg-light border-end border-white">
                    <p class="d-flex text-dark my-auto py-2">Date On</p>
                </div>
                <div class="col-lg-3 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">On By</p>
                </div>
                <div class="col-lg-3 bg-light border-end border-white" >
                    <p class="d-flex text-dark my-auto py-2">Desc</p>
                </div>

            </div>

        </div>
    </form>

</div>
<!-- contact details -->
<div class="card border-2 mb-4">
    <div class="card-header">Personal & Contact Details</div>

    <form action="" method="post" id="update_lead_form">
        <div class="card-body text-dark">

             <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="agent">Agent</label>
                        
                    </div>
                    <div class="mb-3">
                       

                        <div class="row">
                            <div class="col-lg-4 mt-2">
                                <label class="form-label" for="title">Title</label>
                                 <p>Mr.</p>

                            </div>
                            <div class="col-lg-8 mt-2">
                                <label for="other" class="form-label">Other</label>
                                <input type="text" readonly class="form-control" id="other" name="other" placeholder="Other" value="">
                            </div>
                        </div>



                    </div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" readonly class="form-control" id="first_name" name="customer_first_name" placeholder="First Name" value="">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" readonly class="form-control" id="last_name" name="customer_last_name" placeholder="Last Name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="customer_dob" class="form-label">Date of Birth</label>
                        <input type="text" readonly class="form-control" id="customer_dob" name="customer_dob" placeholder="DOB" value="">
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input type="text" readonly class="form-control" id="telephone" name="customer_telephone" placeholder="Telephone" value="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" readonly class="form-control" id="email" name="customer_email" placeholder="Email" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact_method">Prefered contact method: </label> Telephone
                        
                    </div>

                    

                    
                   

                </div>

                <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand: </label> ABCD
                        
                    </div>
                    <div class="mb-3">
                        <label for="address_1" class="form-label">Address1</label>
                        <input readonly type="text" class="form-control" id="address_1" name="customer_address_one" placeholder="Address1" value="">
                    </div>

                    <div class="mb-3">
                        <label for="address_2" class="form-label">Address2</label>
                        <input readonly type="text" class="form-control" id="address_2" name="customer_address_two" placeholder="Address2" value="">
                    </div>

                    <div class="mb-3">
                        <label for="town" class="form-label">Town</label>
                        <input readonly type="text" class="form-control" id="town" name="customer_town_name" placeholder="Town" value="">
                    </div>

                    <div class="mb-3">
                        <label for="county" class="form-label">County / Province</label>
                        <input  readonly type="text" class="form-control" id="county" name="customer_county_name" placeholder="County / Province" value="">
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Post/Zip Code</label>
                        <input readonly type="text" class="form-control" id="zip_code" name="customer_zip_code" placeholder="Post/Zip Code" value="">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country: </label> UK
                        
                    </div>

                    
                    
                    
                    
                </div>
                <!-- <div class="row">
                    <div class="col-lg-6">
                         <label for="relationship" class="form-label pt-2">What relationship does this person have to the client?</label>
                        
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="relationship" name="customer_relationship" placeholder="Relationship" value="">
                    </div>
                </div> -->
                

            </div>



        </div>
    </form>

</div>
<!-- end contact details -->
<div class="card border-2 mb-4">
    <div class="card-header">Request Details</div>

    <form action="" method="post" id="update_lead_form">
        <div class="card-body text-dark">
            <div class="row">
                <div class="col-lg-12">
                     <div class="mb-3">
                        <label for="case_reference" class="form-label">Case Reference: </label>AFF2345444UK
                        
                    </div>
                </div>
            </div>
             <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="test_required">Test Required: </label> AAA
                        
                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_one">Additional Product #1: </label> ADD1
                        
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_two">Additional Product #2 : </label> Add2
                        
                        

                    </div>
                     <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_three">Additional Product #3: </label>
                        Add3
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_four">Additional Product #4: </label>
                        Add4
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_five">Additional Product #5: </label> Add5
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_six">Additional Product #6: </label> Add6
                        
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_seven">Additional Product #7: </label>
                        Add7
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal"  for="additional_product_eight">Additional Product #8: </label>
                        Add8
                        

                    </div>

                   
                             

                    
                   

                </div>

                <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="participent_number" class="form-label">Number of Participents to be tested: </label> 8
                       
                    </div>
                    <div class="mb-3">
                        <label for="requested_kit" class="form-label">Requested a kit before?:  </label> 7
                       
                    </div>

                    <div class="mb-3">
                        <label for="case_reference" class="form-label">Existing case reference: </label> Google
                        
                    </div>

                    <div class="mb-3">
                        <label for="tele_call" class="form-label">Telephone call request: </label> 78678
                        
                    </div>
                    <div class="mb-3">
                        <label for="referred_by" class="form-label">Referred by: </label>AAAA
                        
                    </div>

                    <div class="mb-3">
                        <label for="other_part" class="form-label">Other: </label> Testing
                       
                    </div>
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments: </label> Testing
                       
                    </div>
                    <div class="mb-3">
                        
                       <textarea class="form-control" id="comments_notes" name="comments_notes" placeholder="Type comments here..." rows="3"></textarea>
                    </div>

                    
                    
                    
                    
                </div>
                <!-- <div class="row">
                    <div class="col-lg-6">
                         <label for="relationship" class="form-label pt-2">What relationship does this person have to the client?</label>
                        
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="relationship" name="customer_relationship" placeholder="Relationship" value="">
                    </div>
                </div> -->
                

            </div>



        </div>
    </form>

</div>


<!-- actions -->
<div class="card border-2 mb-0">
    <div class="card-header">Additional Info</div>
    <div class="card-body text-dark">

        <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6 mb-3">
                    <div class="mb-3">
                        <label class="form-label" for="gender">Gender: </label> MAle
                        
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="ethnic_group">Ethnic Group: </label>Caucasian
                        
                     </div>
                     <div class="mb-3">
                        <label class="form-label" for="pickup_code">Pickup_code: </label>12323637832992992
                        
                     </div>
                     
                     <div class="mb-3">
                         <label for="traking_number" class="form-label">Traking Number: </label> 323445266727782
                     </div> 
                     <div class="mb-3">
                         <label for="traking_number" class="form-label">Shipment By: </label> AAAAAAAA
                     </div>  
                     <div class="mb-3">
                        <label for="bar_code" class="form-label">Barcode: </label>
                        
                    </div>   
                     
                    
                </div>

                <div class="col-lg-6">
                   
                   <div class="mb-3">
                        <label for="password" class="form-label">Password: </label>
                       
                     </div> 
                    
                    <div class="mb-3">
                        <label class="form-label" for="send_result">Send results by: </label>
                        
                    </div>

                   

                    

                    

                </div>

                
                

            </div>

            

        </div>
    </form>
        
    </div>


</div>
<!-- end actions -->