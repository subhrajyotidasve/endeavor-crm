<?php
$pageTitle = 'Leads | Edit Lead';
$menuItem1 = 'leads';
$menuItem2 = 'edit-lead';

require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.header.inc.php");
$lead = DB::run('SELECT * FROM leads WHERE id =?', [$_GET['id']])->fetch();
?>

<!-- breadcrumb -->
<div class="container-fluid g-0">
    <div class="row g-0">

        <div class="col-6 page-breadcrumb d-none d-sm-flex align-items-center mb-2 text-left">
            <div class="breadcrumb-title pe-3">
                <a href="/<?= ADMIN_FOLDER ?>/leads/new-requests/">Leads</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Edit Lead</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-6 align-items-center mb-3">
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


<form action="" method="post" id="add_lead_form">
    <div class="card">
        <div class="card-body">

            <!-- contact details -->
            <h6 class="">Contact Details</h6>
            <div class="row mb-4">

                <div class="col-lg-12">
                    <div class="border border-2 p-4 rounded h-100">
                        <div class="row">

                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label class="form-label" for="customer_title">Title</label>
                                    <select class="form-select valid" id="customer_title" name="customer_title" aria-invalid="false">
                                        <option value="" selected="">Please select...</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="customer_first_name" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="customer_first_name" name="customer_first_name" placeholder="First name" value="<?= $lead['customer_first_name'] ?>" required="">
                                </div>

                                <div class="mb-3">
                                    <label for="customer_last_name" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="customer_last_name" name="customer_last_name" placeholder="Last name" value="<?= $lead['customer_last_name'] ?>" required="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="brand">Brand</label>
                                    <select class="form-select valid" id="brand" name="brand" aria-invalid="false">
                                        <option value="">Please select...</option>
                                        <option value="Endeavor" selected="">Endeavor</option>
                                        <option value="NewCo">NewCo</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="customer_tel_mobile" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" id="customer_tel_mobile" name="customer_tel_mobile" placeholder="Telephone" value="<?= $lead['customer_tel_mobile'] ?>" required="">
                                </div>

                                <div class="mb-3">
                                    <label for="customer_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Email" value="<?= $lead['customer_email'] ?>" required="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="contact_method">Contact Method</label>
                                    <select class="form-select valid" id="contact_method" name="contact_method" aria-invalid="false">
                                        <option value="" selected="">Please select...</option>
                                        <option>Call</option>
                                        <option>eBay order</option>
                                        <option>Email</option>
                                        <option>Facebook</option>
                                        <option>Failed payment</option>
                                        <option>Have us call you</option>
                                        <option>Livechat</option>
                                        <option>Order attempt</option>
                                        <option>Referral</option>
                                        <option>Voicemail</option>
                                        <option>Walk-in</option>
                                        <option <?php echo ($lead['contact_method'] == 'Web order') ? 'selected' : '' ?>>Web order</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="customer_address1" class="form-label">Address 1</label>
                                    <input type="text" class="form-control" id="customer_address1" name="customer_address1" placeholder="Address 1" value="<?= $lead['customer_address1'] ?>" required="">
                                </div>

                                <div class="mb-3">
                                    <label for="customer_address2" class="form-label">Address 2</label>
                                    <input type="text" class="form-control" id="customer_address2" name="customer_address2" placeholder="Address 2" value="<?= $lead['customer_address2'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="customer_city" class="form-label">Town</label>
                                    <input type="text" class="form-control" id="customer_city" name="customer_city" placeholder="Town" value="<?= $lead['customer_city'] ?>" required="">
                                </div>

                                <div class="mb-3">
                                    <label for="customer_county" class="form-label">County/State</label>
                                    <input type="text" class="form-control" id="customer_county" name="customer_county" placeholder="County/State" value="<?= $lead['customer_county'] ?>" required="">
                                </div>

                                <div class="mb-3">
                                    <label for="customer_postcode" class="form-label">Post/Zip Code</label>
                                    <input type="text" class="form-control" id="customer_postcode" name="customer_postcode" placeholder="Post/Zip Code" value="<?= $lead['customer_postcode'] ?>" required="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="customer_country">Country</label>
                                    <select class="form-select valid" id="customer_country" name="customer_country" aria-invalid="false">
                                        <option value="" selected="">Select country...</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IT">Italy</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                        <option value="ES">Spain</option>
                                        <option value="">----------</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua And Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia And Herzegowina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote Divoire</option>
                                        <option value="HR">Croatia (local Name: Hrvatska)</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="TP">East Timor</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FX">France, Metropolitan</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard And Mc Donald Islands</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IL">Israel</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea</option>
                                        <option value="KR">Korea</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libyan Arab Jamahiriya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MD">Moldova</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="KN">Saint Kitts And Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="VC">Saint Vincent,The Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome And Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="PM">St. Pierre And Miquelon</option>
                                        <option value="GS">Sth Georgia/Sandwich Isles</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard,Jan Mayen Isles</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad And Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks,Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UM">US Minor Outlying Islands</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VA">Vatican City State</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands GB</option>
                                        <option value="VI">Virgin Islands US</option>
                                        <option value="WF">Wallis,Futuna Islands</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="YU">Yugoslavia</option>
                                        <option value="ZR">Zaire</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>

                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save Changes</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- / contact details -->


            <!-- notes -->
            <h6 class="">Notes</h6>
            <div class="row mb-4">

                <div class="col-lg-12">
                    <div class="border border-2 p-4 rounded h-100">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="lead_action" class="form-label">Action</label>
                                    <input type="text" class="form-control" id="customer_postcode" name="customer_postcode" placeholder="Post/Zip Code" value="<?= $lead['customer_postcode'] ?>" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Details</label>
                                    <textarea class="form-control border border-2" id="notes" name="notes" placeholder="Notes..." rows="6"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Previous notes</label>
                                    <div class="border border-2 p-4 rounded h-100">
                                        
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save Changes</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- / notes -->


            <!-- actions -->
            <h6 class="">Actions</h6>
            <div class="row">

                <div class="col-lg-12">
                    <div class="border border-2 p-4 rounded h-100">

                        <label class="form-label">Move to...</label>

                        <div class="row mb-3">

                            <div class="col-lg-3">
                                <div class=" d-grid gap-2">
                                    <button type="submit" class="btn btn-info btn-block"><i class="bx bx-redo"></i> New Requests</button>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class=" d-grid gap-2">
                                    <button type="submit" class="btn btn-info btn-block"><i class="bx bx-redo"></i> Future Follow-Up</button>
                                </div>
                            </div>


                            <div class="col-lg-3">
                                <div class=" d-grid gap-2">
                                    <button type="submit" class="btn btn-info btn-block"><i class="bx bx-redo"></i> Concluded</button>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class=" d-grid gap-2">
                                    <button type="submit" class="btn btn-info btn-block"><i class="bx bx-redo"></i> Order Processed</button>
                                </div>
                            </div>

                        </div>

                        <label class="form-label">Link to..</label>

                        <div class="row">

                        </div>

                    </div>
                </div>

            </div>
            <!-- / actions -->

        </div>
    </div>
</form>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.footer.inc.php"); ?>