<!-- additional contacts -->
<div class="card border-2 mb-4">
    <div class="card-header">Additional Contacts</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6">
                    <p class="pt-2" style="color: #eb2440;">No additional contacts for this client</p>
                </div>

                <div class="col-lg-6">
                </div>

            </div>

        </div>
    </form>

</div>
<!-- / additional contacts -->


<!-- add additional contact -->
<div class="card border-2 mb-0">
    <div class="card-header">Add Additional Contact</div>

    <form action="" method="post" id="_form">
        <div class="card-body text-dark">

            <div class="row">

                <div class="col-lg-6">

                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <select class="form-select valid" id="title" name="title" aria-invalid="false">
                            <option value="Mr" selected="">Mr</option>
                            <option value="Mrs" selected="">Mrs</option>
                            
                        </select>
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
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="customer_country_name" placeholder="Country" value="">
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Post/Zip Code</label>
                        <input type="text" class="form-control" id="zip_code" name="customer_zip_code" placeholder="Post/Zip Code" value="">
                    </div>

                    
                   

                </div>

                <div class="col-lg-6">
                     <div class="mb-3">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="customer_telephone" placeholder="Telephone" value="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="customer_email" placeholder="Email" value="">
                    </div>
                    <div class="mb-3">
                        <label for="clinic_name" class="form-label">Clinic/Medical Organisation</label>
                        <input type="text" class="form-control" id="clinic_name" name="customer_clinic_name" placeholder="Clinic/Medical Organisation" value="">
                    </div>
                     <div class="mb-3">
                       <label for="clinic_name" class="form-label pt-2">What relationship does this person have to the client?</label>
                        <input type="text" class="form-control" id="relationship" name="customer_relationship" placeholder="Relationship" value="">
                        
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" placeholder="Type notes here..." rows="16"></textarea>
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
<!-- / add additional contact -->