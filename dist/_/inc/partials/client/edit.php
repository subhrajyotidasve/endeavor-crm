<!-- contact details -->
<div class="card border-2 mb-4">
    <div class="card-header">Personal & Contact Details</div>

    <form action="" method="post" id="update_lead_form">
        <div class="card-body text-dark">

             <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="agent">Agent</label>
                        <select class="form-select valid" id="agent" name="agent" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                    </div>
                    <div class="mb-3">
                       

                        <div class="row">
                            <div class="col-lg-4 mt-2">
                                <label class="form-label" for="title">Title</label>
                                 <select class="form-select valid" id="title" name="title" aria-invalid="false">
                                    <option value="Mr" selected="">Mr</option>
                                    <option value="Mrs" selected="">Mrs</option>
                                    
                                 </select>

                            </div>
                            <div class="col-lg-8 mt-2">
                                <label for="other" class="form-label">Other</label>
                                <input type="text" class="form-control" id="other" name="other" placeholder="Other" value="">
                            </div>
                        </div>



                    </div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="customer_first_name" placeholder="First Name" value="">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="customer_last_name" placeholder="Last Name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="customer_dob" class="form-label">Date of Birth</label>
                        <input type="text" class="form-control" id="customer_dob" name="customer_dob" placeholder="DOB" value="">
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="customer_telephone" placeholder="Telephone" value="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="customer_email" placeholder="Email" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact_method">Prefered contact method</label>
                        <select class="form-select valid" id="contact_method" name="contact_method" aria-invalid="false">
                            <option value="" selected="">Please select</option>                          
                            
                        </select>
                    </div>

                    

                    
                   

                </div>

                <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand</label>
                        <select class="form-select valid" id="brand_name" name="brand_name" aria-invalid="false">
                            <option value="" selected="">Please select</option>                          
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address_1" class="form-label">Address1</label>
                        <input type="text" class="form-control" id="address_1" name="customer_address_one" placeholder="Address1" value="">
                    </div>

                    <div class="mb-3">
                        <label for="address_2" class="form-label">Address2</label>
                        <input type="text" class="form-control" id="address_2" name="customer_address_two" placeholder="Address2" value="">
                    </div>

                    <div class="mb-3">
                        <label for="town" class="form-label">Town</label>
                        <input type="text" class="form-control" id="town" name="customer_town_name" placeholder="Town" value="">
                    </div>

                    <div class="mb-3">
                        <label for="county" class="form-label">County / Province</label>
                        <input type="text" class="form-control" id="county" name="customer_county_name" placeholder="County / Province" value="">
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Post/Zip Code</label>
                        <input type="text" class="form-control" id="zip_code" name="customer_zip_code" placeholder="Post/Zip Code" value="">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select valid" id="country" name="country" aria-invalid="false">
                            <option value="" selected="">Please select</option>                          
                            
                        </select>
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
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save Contact</button>
                    </div>
                </div>

            </div>



        </div>
    </form>

</div>
<!-- end contact details -->

<!-- notes -->
<div class="card border-2 mb-4">
    <div class="card-header">Request Details</div>

    <form action="" method="post" id="update_lead_form">
        <div class="card-body text-dark">
            <div class="row">
                <div class="col-lg-12">
                     <div class="mb-3">
                        <label for="case_reference" class="form-label">Case Reference</label>
                        <input type="text" class="form-control" id="case_reference" name="case_reference" placeholder="Case Reference" value="AFF2345444UK">
                    </div>
                </div>
            </div>
             <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="test_required">Test Required</label>
                        <select class="form-select valid" id="agent" name="agent" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_one">Additional Product #1</label>
                        <select class="form-select valid" id="additional_product_one" name="additional_product_one" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_two">Additional Product #2</label>
                        <select class="form-select valid" id="additional_product_two" name="additional_product_two" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                        

                    </div>
                     <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_three">Additional Product #3</label>
                        <select class="form-select valid" id="additional_product_three" name="additional_product_three" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_four">Additional Product #4</label>
                        <select class="form-select valid" id="additional_product_four" name="additional_product_four" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_five">Additional Product #5</label>
                        <select class="form-select valid" id="additional_product_five" name="additional_product_five" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_six">Additional Product #6</label>
                        <select class="form-select valid" id="additional_product_six" name="additional_product_six" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal" for="additional_product_seven">Additional Product #7</label>
                        <select class="form-select valid" id="additional_product_seven" name="additional_product_seven" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                        

                    </div>
                    <div class="mb-3">
                       
                        <label class="form-label fst-italic fw-normal"  for="additional_product_eight">Additional Product #8</label>
                        <select class="form-select valid" id="additional_product_eight" name="additional_product_eight" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                        

                    </div>

                   
                             

                    
                   

                </div>

                <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="participent_number" class="form-label">Number of Participents to be tested</label>
                        <input type="text" class="form-control" id="participent_number" name="participent_number" placeholder="Number of participent to be tested" value="">
                    </div>
                    <div class="mb-3">
                        <label for="requested_kit" class="form-label">Requested a kit before? </label>
                        <select class="form-select valid" id="requested_kit" name="requested_kit" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="case_reference" class="form-label">Existing case reference</label>
                        <input type="text" class="form-control" id="case_reference" name="case_reference" placeholder="Case reference" value="">
                    </div>

                    <div class="mb-3">
                        <label for="tele_call" class="form-label">Telephone call request</label>
                        <select class="form-select valid" id="tele_call" name="tele_call" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="referred_by" class="form-label">Referred by</label>
                        <select class="form-select valid" id="referred_by" name="referred_by" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="other_part" class="form-label">Other</label>
                        <input type="text" class="form-control" id="other_part" name="other_part" placeholder="Other" value="">
                    </div>
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments</label>
                        <select class="form-select valid" id="comments" name="comments" aria-invalid="false">
                            <option value="" selected="">Please select</option>
                            
                            
                        </select>
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
<!-- end notes -->

<!-- actions -->
<div class="card border-2 mb-0">
    <div class="card-header">Additional Info</div>
    <div class="card-body text-dark">

        <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6 mb-3">
                    <div class="mb-3">
                        <label class="form-label" for="gender">Gender</label>
                        <select class="form-select valid" id="Gender" name="gender" aria-invalid="false">
                            <option value="" selected>Please select...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="ethnic_group">Ethnic Group</label>
                        <select class="form-select valid" id="ethnic_group" name="ethnic_group" aria-invalid="false">
                            <option value="" selected="">Please select...</option>
                        </select>
                     </div>
                     <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-4 mt-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="" required="">
                            </div>
                            <div class="col-lg-8 mt-2">
                                <label class="form-label" for="amounttype"></label><br>
                                <button type="button" class="btn btn-sm border mt-2">Generate</button>
                            </div>
                        </div>


                       
                     </div> 
                     <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-4 mt-2">
                                <label for="traking_number" class="form-label">Traking Number</label>
                                <input type="text" class="form-control" id="traking_number" name="traking_number" placeholder="Traking Number" value="">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label class="form-label" for="trakimg_item"></label>
                                <select class="form-select valid mt-2" id="trakimg_item" name="trakimg_item" aria-invalid="false">
                                    <option value="" selected="">Please select...</option>
                                </select>
                            </div>
                             <div class="col-lg-2 mt-2"><label class="form-label" for="trakimg_item"></label><br/><button type="button" class="btn btn-sm border mt-2">Add</button></div>
                        </div>
                     </div>    
                     
                    
                </div>

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label for="traking_number" class="form-label">Current Traking Number</label>
                        <p>Track1232536</p>
                    </div>
                    <div class="mb-3">
                        <label for="bar_code" class="form-label">Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" value="" required="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="send_result">Send results by</label>
                        <select class="form-select valid" id="send_result" name="send_result" aria-invalid="false">
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


</div>

<!-- end actions -->