        <!-- contact details -->
        <div class="card border-2 mb-4">
            <div class="card-header">Contact Details</div>

            <form action="" method="post" id="update_lead_form">
                <div class="card-body text-dark">

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="customer_title">Title</label>
                                        <select class="form-select valid" id="customer_title" name="customer_title" aria-invalid="false">
                                            <option value="" selected="">Please select...</option>
                                            <?php foreach ($titles as $title) { ?>
                                                <option value="<?= $title['title'] ?>" <?php echo ($lead['customer_title'] == $title['title']) ? 'selected' : ''; ?>><?= $title['title'] ?></option>
                                            <?php } ?>
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
                                            <option value="Endeavor" <?php echo ($lead['brand'] == 'Endeavor') ? 'selected' : ''; ?>>Endeavor</option>
                                            <option value="NewCo" <?php echo ($lead['brand'] == 'NewCo') ? 'selected' : ''; ?>>NewCo</option>
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
                                            <?php foreach ($contact_methods as $contact_method) { ?>
                                                <option value="<?= $contact_method['name'] ?>" <?php echo ($lead['contact_method'] == $contact_method['name']) ? 'selected' : ''; ?>><?= $contact_method['name'] ?></option>
                                            <?php } ?>
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
                                        <input type="text" class="form-control" id="customer_city" name="customer_city" placeholder="Town" value="<?= $lead['customer_city'] ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="customer_county" class="form-label">County/State</label>
                                        <input type="text" class="form-control" id="customer_county" name="customer_county" placeholder="County/State" value="<?= $lead['customer_county'] ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="customer_postcode" class="form-label">Post/Zip Code</label>
                                        <input type="text" class="form-control" id="customer_postcode" name="customer_postcode" placeholder="Post/Zip Code" value="<?= $lead['customer_postcode'] ?>" required="">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="customer_country">Country</label>
                                        <select class="form-select valid" id="customer_country" name="customer_country" aria-invalid="false">
                                            <option value="" selected="">Select country...</option>
                                            <option value="GB" <?php echo ($lead['customer_country'] == 'GB') ? 'selected' : ''; ?>>United Kingdom</option>
                                            <option value="US" <?php echo ($lead['customer_country'] == 'US') ? 'selected' : ''; ?>>United States</option>
                                            <option value="IE" <?php echo ($lead['customer_country'] == 'IE') ? 'selected' : ''; ?>>Ireland</option>
                                            <option value="IT" <?php echo ($lead['customer_country'] == 'IT') ? 'selected' : ''; ?>>Italy</option>
                                            <option value="FR" <?php echo ($lead['customer_country'] == 'FR') ? 'selected' : ''; ?>>France</option>
                                            <option value="DE" <?php echo ($lead['customer_country'] == 'DE') ? 'selected' : ''; ?>>Germany</option>
                                            <option value="ES" <?php echo ($lead['customer_country'] == 'ES') ? 'selected' : ''; ?>>Spain</option>
                                            <option value="">----------</option>
                                            <option value="AF" <?php echo ($lead['customer_country'] == 'AF') ? 'selected' : ''; ?>>Afghanistan</option>
                                            <option value="AL" <?php echo ($lead['customer_country'] == 'AL') ? 'selected' : ''; ?>>Albania</option>
                                            <option value="DZ" <?php echo ($lead['customer_country'] == 'DZ') ? 'selected' : ''; ?>>Algeria</option>
                                            <option value="AS" <?php echo ($lead['customer_country'] == 'AS') ? 'selected' : ''; ?>>American Samoa</option>
                                            <option value="AD" <?php echo ($lead['customer_country'] == 'AD') ? 'selected' : ''; ?>>Andorra</option>
                                            <option value="AO" <?php echo ($lead['customer_country'] == 'AO') ? 'selected' : ''; ?>>Angola</option>
                                            <option value="AI" <?php echo ($lead['customer_country'] == 'AI') ? 'selected' : ''; ?>>Anguilla</option>
                                            <option value="AQ" <?php echo ($lead['customer_country'] == 'AQ') ? 'selected' : ''; ?>>Antarctica</option>
                                            <option value="AG" <?php echo ($lead['customer_country'] == 'AG') ? 'selected' : ''; ?>>Antigua And Barbuda</option>
                                            <option value="AR" <?php echo ($lead['customer_country'] == 'AR') ? 'selected' : ''; ?>>Argentina</option>
                                            <option value="AM" <?php echo ($lead['customer_country'] == 'AM') ? 'selected' : ''; ?>>Armenia</option>
                                            <option value="AW" <?php echo ($lead['customer_country'] == 'AW') ? 'selected' : ''; ?>>Aruba</option>
                                            <option value="AU" <?php echo ($lead['customer_country'] == 'AU') ? 'selected' : ''; ?>>Australia</option>
                                            <option value="AT" <?php echo ($lead['customer_country'] == 'AT') ? 'selected' : ''; ?>>Austria</option>
                                            <option value="AZ" <?php echo ($lead['customer_country'] == 'AZ') ? 'selected' : ''; ?>>Azerbaijan</option>
                                            <option value="BS" <?php echo ($lead['customer_country'] == 'BS') ? 'selected' : ''; ?>>Bahamas</option>
                                            <option value="BH" <?php echo ($lead['customer_country'] == 'BH') ? 'selected' : ''; ?>>Bahrain</option>
                                            <option value="BD" <?php echo ($lead['customer_country'] == 'BD') ? 'selected' : ''; ?>>Bangladesh</option>
                                            <option value="BB" <?php echo ($lead['customer_country'] == 'BB') ? 'selected' : ''; ?>>Barbados</option>
                                            <option value="BY" <?php echo ($lead['customer_country'] == 'BY') ? 'selected' : ''; ?>>Belarus</option>
                                            <option value="BE" <?php echo ($lead['customer_country'] == 'BE') ? 'selected' : ''; ?>>Belgium</option>
                                            <option value="BZ" <?php echo ($lead['customer_country'] == 'BZ') ? 'selected' : ''; ?>>Belize</option>
                                            <option value="BJ" <?php echo ($lead['customer_country'] == 'BJ') ? 'selected' : ''; ?>>Benin</option>
                                            <option value="BM" <?php echo ($lead['customer_country'] == 'BM') ? 'selected' : ''; ?>>Bermuda</option>
                                            <option value="BT" <?php echo ($lead['customer_country'] == 'BT') ? 'selected' : ''; ?>>Bhutan</option>
                                            <option value="BO" <?php echo ($lead['customer_country'] == 'BO') ? 'selected' : ''; ?>>Bolivia</option>
                                            <option value="BA" <?php echo ($lead['customer_country'] == 'BA') ? 'selected' : ''; ?>>Bosnia And Herzegowina</option>
                                            <option value="BW" <?php echo ($lead['customer_country'] == 'BW') ? 'selected' : ''; ?>>Botswana</option>
                                            <option value="BV" <?php echo ($lead['customer_country'] == 'BV') ? 'selected' : ''; ?>>Bouvet Island</option>
                                            <option value="BR" <?php echo ($lead['customer_country'] == 'BR') ? 'selected' : ''; ?>>Brazil</option>
                                            <option value="IO" <?php echo ($lead['customer_country'] == 'IO') ? 'selected' : ''; ?>>British Indian Ocean Territory</option>
                                            <option value="BN" <?php echo ($lead['customer_country'] == 'BN') ? 'selected' : ''; ?>>Brunei Darussalam</option>
                                            <option value="BG" <?php echo ($lead['customer_country'] == 'BG') ? 'selected' : ''; ?>>Bulgaria</option>
                                            <option value="BF" <?php echo ($lead['customer_country'] == 'BF') ? 'selected' : ''; ?>>Burkina Faso</option>
                                            <option value="BI" <?php echo ($lead['customer_country'] == 'BI') ? 'selected' : ''; ?>>Burundi</option>
                                            <option value="KH" <?php echo ($lead['customer_country'] == 'KH') ? 'selected' : ''; ?>>Cambodia</option>
                                            <option value="CM" <?php echo ($lead['customer_country'] == 'CM') ? 'selected' : ''; ?>>Cameroon</option>
                                            <option value="CA" <?php echo ($lead['customer_country'] == 'CA') ? 'selected' : ''; ?>>Canada</option>
                                            <option value="CV" <?php echo ($lead['customer_country'] == 'CV') ? 'selected' : ''; ?>>Cape Verde</option>
                                            <option value="KY" <?php echo ($lead['customer_country'] == 'KY') ? 'selected' : ''; ?>>Cayman Islands</option>
                                            <option value="CF" <?php echo ($lead['customer_country'] == 'CF') ? 'selected' : ''; ?>>Central African Republic</option>
                                            <option value="TD" <?php echo ($lead['customer_country'] == 'TD') ? 'selected' : ''; ?>>Chad</option>
                                            <option value="CL" <?php echo ($lead['customer_country'] == 'CL') ? 'selected' : ''; ?>>Chile</option>
                                            <option value="CN" <?php echo ($lead['customer_country'] == 'CN') ? 'selected' : ''; ?>>China</option>
                                            <option value="CX" <?php echo ($lead['customer_country'] == 'CX') ? 'selected' : ''; ?>>Christmas Island</option>
                                            <option value="CC" <?php echo ($lead['customer_country'] == 'CC') ? 'selected' : ''; ?>>Cocos (keeling) Islands</option>
                                            <option value="CO" <?php echo ($lead['customer_country'] == 'CO') ? 'selected' : ''; ?>>Colombia</option>
                                            <option value="KM" <?php echo ($lead['customer_country'] == 'KM') ? 'selected' : ''; ?>>Comoros</option>
                                            <option value="CG" <?php echo ($lead['customer_country'] == 'CG') ? 'selected' : ''; ?>>Congo</option>
                                            <option value="CK" <?php echo ($lead['customer_country'] == 'CK') ? 'selected' : ''; ?>>Cook Islands</option>
                                            <option value="CR" <?php echo ($lead['customer_country'] == 'CR') ? 'selected' : ''; ?>>Costa Rica</option>
                                            <option value="CI" <?php echo ($lead['customer_country'] == 'CI') ? 'selected' : ''; ?>>Cote Divoire</option>
                                            <option value="HR" <?php echo ($lead['customer_country'] == 'HR') ? 'selected' : ''; ?>>Croatia (local Name: Hrvatska)</option>
                                            <option value="CU" <?php echo ($lead['customer_country'] == 'CU') ? 'selected' : ''; ?>>Cuba</option>
                                            <option value="CY" <?php echo ($lead['customer_country'] == 'CY') ? 'selected' : ''; ?>>Cyprus</option>
                                            <option value="CZ" <?php echo ($lead['customer_country'] == 'CZ') ? 'selected' : ''; ?>>Czech Republic</option>
                                            <option value="DK" <?php echo ($lead['customer_country'] == 'DK') ? 'selected' : ''; ?>>Denmark</option>
                                            <option value="DJ" <?php echo ($lead['customer_country'] == 'DJ') ? 'selected' : ''; ?>>Djibouti</option>
                                            <option value="DM" <?php echo ($lead['customer_country'] == 'DM') ? 'selected' : ''; ?>>Dominica</option>
                                            <option value="DO" <?php echo ($lead['customer_country'] == 'DO') ? 'selected' : ''; ?>>Dominican Republic</option>
                                            <option value="TP" <?php echo ($lead['customer_country'] == 'TP') ? 'selected' : ''; ?>>East Timor</option>
                                            <option value="EC" <?php echo ($lead['customer_country'] == 'EC') ? 'selected' : ''; ?>>Ecuador</option>
                                            <option value="EG" <?php echo ($lead['customer_country'] == 'EG') ? 'selected' : ''; ?>>Egypt</option>
                                            <option value="SV" <?php echo ($lead['customer_country'] == 'SV') ? 'selected' : ''; ?>>El Salvador</option>
                                            <option value="GQ" <?php echo ($lead['customer_country'] == 'GQ') ? 'selected' : ''; ?>>Equatorial Guinea</option>
                                            <option value="ER" <?php echo ($lead['customer_country'] == 'ER') ? 'selected' : ''; ?>>Eritrea</option>
                                            <option value="EE" <?php echo ($lead['customer_country'] == 'EE') ? 'selected' : ''; ?>>Estonia</option>
                                            <option value="ET" <?php echo ($lead['customer_country'] == 'ET') ? 'selected' : ''; ?>>Ethiopia</option>
                                            <option value="FK" <?php echo ($lead['customer_country'] == 'FK') ? 'selected' : ''; ?>>Falkland Islands</option>
                                            <option value="FO" <?php echo ($lead['customer_country'] == 'FO') ? 'selected' : ''; ?>>Faroe Islands</option>
                                            <option value="FJ" <?php echo ($lead['customer_country'] == 'FJ') ? 'selected' : ''; ?>>Fiji</option>
                                            <option value="FI" <?php echo ($lead['customer_country'] == 'FI') ? 'selected' : ''; ?>>Finland</option>
                                            <option value="FX" <?php echo ($lead['customer_country'] == 'FX') ? 'selected' : ''; ?>>France, Metropolitan</option>
                                            <option value="GF" <?php echo ($lead['customer_country'] == 'GF') ? 'selected' : ''; ?>>French Guiana</option>
                                            <option value="PF" <?php echo ($lead['customer_country'] == 'PF') ? 'selected' : ''; ?>>French Polynesia</option>
                                            <option value="TF" <?php echo ($lead['customer_country'] == 'TF') ? 'selected' : ''; ?>>French Southern Territories</option>
                                            <option value="GA" <?php echo ($lead['customer_country'] == 'GA') ? 'selected' : ''; ?>>Gabon</option>
                                            <option value="GM" <?php echo ($lead['customer_country'] == 'GM') ? 'selected' : ''; ?>>Gambia</option>
                                            <option value="GE" <?php echo ($lead['customer_country'] == 'GE') ? 'selected' : ''; ?>>Georgia</option>
                                            <option value="DE" <?php echo ($lead['customer_country'] == 'DE') ? 'selected' : ''; ?>>Germany</option>
                                            <option value="GH" <?php echo ($lead['customer_country'] == 'GH') ? 'selected' : ''; ?>>Ghana</option>
                                            <option value="GI" <?php echo ($lead['customer_country'] == 'GI') ? 'selected' : ''; ?>>Gibraltar</option>
                                            <option value="GR" <?php echo ($lead['customer_country'] == 'GR') ? 'selected' : ''; ?>>Greece</option>
                                            <option value="GL" <?php echo ($lead['customer_country'] == 'GL') ? 'selected' : ''; ?>>Greenland</option>
                                            <option value="GD" <?php echo ($lead['customer_country'] == 'GD') ? 'selected' : ''; ?>>Grenada</option>
                                            <option value="GP" <?php echo ($lead['customer_country'] == 'GP') ? 'selected' : ''; ?>>Guadeloupe</option>
                                            <option value="GU" <?php echo ($lead['customer_country'] == 'GU') ? 'selected' : ''; ?>>Guam</option>
                                            <option value="GT" <?php echo ($lead['customer_country'] == 'GT') ? 'selected' : ''; ?>>Guatemala</option>
                                            <option value="GN" <?php echo ($lead['customer_country'] == 'GN') ? 'selected' : ''; ?>>Guinea</option>
                                            <option value="GW" <?php echo ($lead['customer_country'] == 'GW') ? 'selected' : ''; ?>>Guinea-bissau</option>
                                            <option value="GY" <?php echo ($lead['customer_country'] == 'GY') ? 'selected' : ''; ?>>Guyana</option>
                                            <option value="HT" <?php echo ($lead['customer_country'] == 'HT') ? 'selected' : ''; ?>>Haiti</option>
                                            <option value="HM" <?php echo ($lead['customer_country'] == 'HM') ? 'selected' : ''; ?>>Heard And Mc Donald Islands</option>
                                            <option value="HN" <?php echo ($lead['customer_country'] == 'HN') ? 'selected' : ''; ?>>Honduras</option>
                                            <option value="HK" <?php echo ($lead['customer_country'] == 'HK') ? 'selected' : ''; ?>>Hong Kong</option>
                                            <option value="HU" <?php echo ($lead['customer_country'] == 'HU') ? 'selected' : ''; ?>>Hungary</option>
                                            <option value="IS" <?php echo ($lead['customer_country'] == 'IS') ? 'selected' : ''; ?>>Iceland</option>
                                            <option value="IN" <?php echo ($lead['customer_country'] == 'IN') ? 'selected' : ''; ?>>India</option>
                                            <option value="ID" <?php echo ($lead['customer_country'] == 'ID') ? 'selected' : ''; ?>>Indonesia</option>
                                            <option value="IR" <?php echo ($lead['customer_country'] == 'IR') ? 'selected' : ''; ?>>Iran</option>
                                            <option value="IQ" <?php echo ($lead['customer_country'] == 'IQ') ? 'selected' : ''; ?>>Iraq</option>
                                            <option value="IL" <?php echo ($lead['customer_country'] == 'IL') ? 'selected' : ''; ?>>Israel</option>
                                            <option value="JM" <?php echo ($lead['customer_country'] == 'JM') ? 'selected' : ''; ?>>Jamaica</option>
                                            <option value="JP" <?php echo ($lead['customer_country'] == 'JP') ? 'selected' : ''; ?>>Japan</option>
                                            <option value="JO" <?php echo ($lead['customer_country'] == 'JO') ? 'selected' : ''; ?>>Jordan</option>
                                            <option value="KZ" <?php echo ($lead['customer_country'] == 'KZ') ? 'selected' : ''; ?>>Kazakhstan</option>
                                            <option value="KE" <?php echo ($lead['customer_country'] == 'KE') ? 'selected' : ''; ?>>Kenya</option>
                                            <option value="KI" <?php echo ($lead['customer_country'] == 'KI') ? 'selected' : ''; ?>>Kiribati</option>
                                            <option value="KP" <?php echo ($lead['customer_country'] == 'KP') ? 'selected' : ''; ?>>Korea</option>
                                            <option value="KW" <?php echo ($lead['customer_country'] == 'KW') ? 'selected' : ''; ?>>Kuwait</option>
                                            <option value="KG" <?php echo ($lead['customer_country'] == 'KG') ? 'selected' : ''; ?>>Kyrgyzstan</option>
                                            <option value="LA" <?php echo ($lead['customer_country'] == 'LA') ? 'selected' : ''; ?>>Lao</option>
                                            <option value="LV" <?php echo ($lead['customer_country'] == 'LV') ? 'selected' : ''; ?>>Latvia</option>
                                            <option value="LB" <?php echo ($lead['customer_country'] == 'LB') ? 'selected' : ''; ?>>Lebanon</option>
                                            <option value="LS" <?php echo ($lead['customer_country'] == 'LS') ? 'selected' : ''; ?>>Lesotho</option>
                                            <option value="LR" <?php echo ($lead['customer_country'] == 'LR') ? 'selected' : ''; ?>>Liberia</option>
                                            <option value="LY" <?php echo ($lead['customer_country'] == 'LY') ? 'selected' : ''; ?>>Libyan Arab Jamahiriya</option>
                                            <option value="LI" <?php echo ($lead['customer_country'] == 'LI') ? 'selected' : ''; ?>>Liechtenstein</option>
                                            <option value="LT" <?php echo ($lead['customer_country'] == 'LT') ? 'selected' : ''; ?>>Lithuania</option>
                                            <option value="LU" <?php echo ($lead['customer_country'] == 'LU') ? 'selected' : ''; ?>>Luxembourg</option>
                                            <option value="MO" <?php echo ($lead['customer_country'] == 'MO') ? 'selected' : ''; ?>>Macau</option>
                                            <option value="MK" <?php echo ($lead['customer_country'] == 'MK') ? 'selected' : ''; ?>>Macedonia</option>
                                            <option value="MG" <?php echo ($lead['customer_country'] == 'MG') ? 'selected' : ''; ?>>Madagascar</option>
                                            <option value="MW" <?php echo ($lead['customer_country'] == 'MW') ? 'selected' : ''; ?>>Malawi</option>
                                            <option value="MY" <?php echo ($lead['customer_country'] == 'MY') ? 'selected' : ''; ?>>Malaysia</option>
                                            <option value="MV" <?php echo ($lead['customer_country'] == 'MV') ? 'selected' : ''; ?>>Maldives</option>
                                            <option value="ML" <?php echo ($lead['customer_country'] == 'ML') ? 'selected' : ''; ?>>Mali</option>
                                            <option value="MT" <?php echo ($lead['customer_country'] == 'MT') ? 'selected' : ''; ?>>Malta</option>
                                            <option value="MH" <?php echo ($lead['customer_country'] == 'MH') ? 'selected' : ''; ?>>Marshall Islands</option>
                                            <option value="MQ" <?php echo ($lead['customer_country'] == 'MQ') ? 'selected' : ''; ?>>Martinique</option>
                                            <option value="MR" <?php echo ($lead['customer_country'] == 'MR') ? 'selected' : ''; ?>>Mauritania</option>
                                            <option value="MU" <?php echo ($lead['customer_country'] == 'MU') ? 'selected' : ''; ?>>Mauritius</option>
                                            <option value="YT" <?php echo ($lead['customer_country'] == 'YT') ? 'selected' : ''; ?>>Mayotte</option>
                                            <option value="MX" <?php echo ($lead['customer_country'] == 'MX') ? 'selected' : ''; ?>>Mexico</option>
                                            <option value="FM" <?php echo ($lead['customer_country'] == 'FM') ? 'selected' : ''; ?>>Micronesia</option>
                                            <option value="MD" <?php echo ($lead['customer_country'] == 'MD') ? 'selected' : ''; ?>>Moldova</option>
                                            <option value="MC" <?php echo ($lead['customer_country'] == 'MC') ? 'selected' : ''; ?>>Monaco</option>
                                            <option value="MN" <?php echo ($lead['customer_country'] == 'MN') ? 'selected' : ''; ?>>Mongolia</option>
                                            <option value="MS" <?php echo ($lead['customer_country'] == 'MS') ? 'selected' : ''; ?>>Montserrat</option>
                                            <option value="MA" <?php echo ($lead['customer_country'] == 'MA') ? 'selected' : ''; ?>>Morocco</option>
                                            <option value="MZ" <?php echo ($lead['customer_country'] == 'MZ') ? 'selected' : ''; ?>>Mozambique</option>
                                            <option value="MM" <?php echo ($lead['customer_country'] == 'MM') ? 'selected' : ''; ?>>Myanmar</option>
                                            <option value="NA" <?php echo ($lead['customer_country'] == 'NA') ? 'selected' : ''; ?>>Namibia</option>
                                            <option value="NR" <?php echo ($lead['customer_country'] == 'NR') ? 'selected' : ''; ?>>Nauru</option>
                                            <option value="NP" <?php echo ($lead['customer_country'] == 'NP') ? 'selected' : ''; ?>>Nepal</option>
                                            <option value="NL" <?php echo ($lead['customer_country'] == 'NL') ? 'selected' : ''; ?>>Netherlands</option>
                                            <option value="AN" <?php echo ($lead['customer_country'] == 'AN') ? 'selected' : ''; ?>>Netherlands Antilles</option>
                                            <option value="NC" <?php echo ($lead['customer_country'] == 'NC') ? 'selected' : ''; ?>>New Caledonia</option>
                                            <option value="NZ" <?php echo ($lead['customer_country'] == 'NZ') ? 'selected' : ''; ?>>New Zealand</option>
                                            <option value="NI" <?php echo ($lead['customer_country'] == 'NI') ? 'selected' : ''; ?>>Nicaragua</option>
                                            <option value="NE" <?php echo ($lead['customer_country'] == 'NE') ? 'selected' : ''; ?>>Niger</option>
                                            <option value="NG" <?php echo ($lead['customer_country'] == 'NG') ? 'selected' : ''; ?>>Nigeria</option>
                                            <option value="NU" <?php echo ($lead['customer_country'] == 'NU') ? 'selected' : ''; ?>>Niue</option>
                                            <option value="NF" <?php echo ($lead['customer_country'] == 'NF') ? 'selected' : ''; ?>>Norfolk Island</option>
                                            <option value="MP" <?php echo ($lead['customer_country'] == 'MP') ? 'selected' : ''; ?>>Northern Mariana Islands</option>
                                            <option value="NO" <?php echo ($lead['customer_country'] == 'NO') ? 'selected' : ''; ?>>Norway</option>
                                            <option value="OM" <?php echo ($lead['customer_country'] == 'OM') ? 'selected' : ''; ?>>Oman</option>
                                            <option value="PK" <?php echo ($lead['customer_country'] == 'PK') ? 'selected' : ''; ?>>Pakistan</option>
                                            <option value="PW" <?php echo ($lead['customer_country'] == 'PW') ? 'selected' : ''; ?>>Palau</option>
                                            <option value="PA" <?php echo ($lead['customer_country'] == 'PA') ? 'selected' : ''; ?>>Panama</option>
                                            <option value="PG" <?php echo ($lead['customer_country'] == 'PG') ? 'selected' : ''; ?>>Papua New Guinea</option>
                                            <option value="PY" <?php echo ($lead['customer_country'] == 'PY') ? 'selected' : ''; ?>>Paraguay</option>
                                            <option value="PE" <?php echo ($lead['customer_country'] == 'PE') ? 'selected' : ''; ?>>Peru</option>
                                            <option value="PH" <?php echo ($lead['customer_country'] == 'PH') ? 'selected' : ''; ?>>Philippines</option>
                                            <option value="PN" <?php echo ($lead['customer_country'] == 'PN') ? 'selected' : ''; ?>>Pitcairn</option>
                                            <option value="PL" <?php echo ($lead['customer_country'] == 'PL') ? 'selected' : ''; ?>>Poland</option>
                                            <option value="PT" <?php echo ($lead['customer_country'] == 'PT') ? 'selected' : ''; ?>>Portugal</option>
                                            <option value="PR" <?php echo ($lead['customer_country'] == 'PR') ? 'selected' : ''; ?>>Puerto Rico</option>
                                            <option value="QA" <?php echo ($lead['customer_country'] == 'QA') ? 'selected' : ''; ?>>Qatar</option>
                                            <option value="RE" <?php echo ($lead['customer_country'] == 'RE') ? 'selected' : ''; ?>>Reunion</option>
                                            <option value="RO" <?php echo ($lead['customer_country'] == 'RO') ? 'selected' : ''; ?>>Romania</option>
                                            <option value="RU" <?php echo ($lead['customer_country'] == 'RU') ? 'selected' : ''; ?>>Russian Federation</option>
                                            <option value="RW" <?php echo ($lead['customer_country'] == 'RW') ? 'selected' : ''; ?>>Rwanda</option>
                                            <option value="KN" <?php echo ($lead['customer_country'] == 'KN') ? 'selected' : ''; ?>>Saint Kitts And Nevis</option>
                                            <option value="LC" <?php echo ($lead['customer_country'] == 'LC') ? 'selected' : ''; ?>>Saint Lucia</option>
                                            <option value="VC" <?php echo ($lead['customer_country'] == 'VC') ? 'selected' : ''; ?>>Saint Vincent,The Grenadines</option>
                                            <option value="WS" <?php echo ($lead['customer_country'] == 'WS') ? 'selected' : ''; ?>>Samoa</option>
                                            <option value="SM" <?php echo ($lead['customer_country'] == 'SM') ? 'selected' : ''; ?>>San Marino</option>
                                            <option value="ST" <?php echo ($lead['customer_country'] == 'ST') ? 'selected' : ''; ?>>Sao Tome And Principe</option>
                                            <option value="SA" <?php echo ($lead['customer_country'] == 'SA') ? 'selected' : ''; ?>>Saudi Arabia</option>
                                            <option value="SN" <?php echo ($lead['customer_country'] == 'SN') ? 'selected' : ''; ?>>Senegal</option>
                                            <option value="SC" <?php echo ($lead['customer_country'] == 'SC') ? 'selected' : ''; ?>>Seychelles</option>
                                            <option value="SL" <?php echo ($lead['customer_country'] == 'SL') ? 'selected' : ''; ?>>Sierra Leone</option>
                                            <option value="SG" <?php echo ($lead['customer_country'] == 'SG') ? 'selected' : ''; ?>>Singapore</option>
                                            <option value="SK" <?php echo ($lead['customer_country'] == 'SK') ? 'selected' : ''; ?>>Slovakia</option>
                                            <option value="SI" <?php echo ($lead['customer_country'] == 'SI') ? 'selected' : ''; ?>>Slovenia</option>
                                            <option value="SB" <?php echo ($lead['customer_country'] == 'SB') ? 'selected' : ''; ?>>Solomon Islands</option>
                                            <option value="SO" <?php echo ($lead['customer_country'] == 'SO') ? 'selected' : ''; ?>>Somalia</option>
                                            <option value="ZA" <?php echo ($lead['customer_country'] == 'ZA') ? 'selected' : ''; ?>>South Africa</option>
                                            <option value="LK" <?php echo ($lead['customer_country'] == 'LK') ? 'selected' : ''; ?>>Sri Lanka</option>
                                            <option value="SH" <?php echo ($lead['customer_country'] == 'SH') ? 'selected' : ''; ?>>St. Helena</option>
                                            <option value="PM" <?php echo ($lead['customer_country'] == 'PM') ? 'selected' : ''; ?>>St. Pierre And Miquelon</option>
                                            <option value="GS" <?php echo ($lead['customer_country'] == 'GS') ? 'selected' : ''; ?>>Sth Georgia/Sandwich Isles</option>
                                            <option value="SD" <?php echo ($lead['customer_country'] == 'SD') ? 'selected' : ''; ?>>Sudan</option>
                                            <option value="SR" <?php echo ($lead['customer_country'] == 'SR') ? 'selected' : ''; ?>>Suriname</option>
                                            <option value="SJ" <?php echo ($lead['customer_country'] == 'SJ') ? 'selected' : ''; ?>>Svalbard,Jan Mayen Isles</option>
                                            <option value="SZ" <?php echo ($lead['customer_country'] == 'SZ') ? 'selected' : ''; ?>>Swaziland</option>
                                            <option value="SE" <?php echo ($lead['customer_country'] == 'SE') ? 'selected' : ''; ?>>Sweden</option>
                                            <option value="CH" <?php echo ($lead['customer_country'] == 'CH') ? 'selected' : ''; ?>>Switzerland</option>
                                            <option value="SY" <?php echo ($lead['customer_country'] == 'SY') ? 'selected' : ''; ?>>Syrian Arab Republic</option>
                                            <option value="TW" <?php echo ($lead['customer_country'] == 'TW') ? 'selected' : ''; ?>>Taiwan</option>
                                            <option value="TJ" <?php echo ($lead['customer_country'] == 'TJ') ? 'selected' : ''; ?>>Tajikistan</option>
                                            <option value="TZ" <?php echo ($lead['customer_country'] == 'TZ') ? 'selected' : ''; ?>>Tanzania</option>
                                            <option value="TH" <?php echo ($lead['customer_country'] == 'TH') ? 'selected' : ''; ?>>Thailand</option>
                                            <option value="TG" <?php echo ($lead['customer_country'] == 'TG') ? 'selected' : ''; ?>>Togo</option>
                                            <option value="TK" <?php echo ($lead['customer_country'] == 'TK') ? 'selected' : ''; ?>>Tokelau</option>
                                            <option value="TO" <?php echo ($lead['customer_country'] == 'TO') ? 'selected' : ''; ?>>Tonga</option>
                                            <option value="TT" <?php echo ($lead['customer_country'] == 'TT') ? 'selected' : ''; ?>>Trinidad And Tobago</option>
                                            <option value="TN" <?php echo ($lead['customer_country'] == 'TN') ? 'selected' : ''; ?>>Tunisia</option>
                                            <option value="TR" <?php echo ($lead['customer_country'] == 'TR') ? 'selected' : ''; ?>>Turkey</option>
                                            <option value="TM" <?php echo ($lead['customer_country'] == 'TM') ? 'selected' : ''; ?>>Turkmenistan</option>
                                            <option value="TC" <?php echo ($lead['customer_country'] == 'TC') ? 'selected' : ''; ?>>Turks,Caicos Islands</option>
                                            <option value="TV" <?php echo ($lead['customer_country'] == 'TV') ? 'selected' : ''; ?>>Tuvalu</option>
                                            <option value="UG" <?php echo ($lead['customer_country'] == 'UG') ? 'selected' : ''; ?>>Uganda</option>
                                            <option value="UA" <?php echo ($lead['customer_country'] == 'UA') ? 'selected' : ''; ?>>Ukraine</option>
                                            <option value="AE" <?php echo ($lead['customer_country'] == 'AE') ? 'selected' : ''; ?>>United Arab Emirates</option>
                                            <option value="UY" <?php echo ($lead['customer_country'] == 'UY') ? 'selected' : ''; ?>>Uruguay</option>
                                            <option value="UM" <?php echo ($lead['customer_country'] == 'UM') ? 'selected' : ''; ?>>US Minor Outlying Islands</option>
                                            <option value="UZ" <?php echo ($lead['customer_country'] == 'UZ') ? 'selected' : ''; ?>>Uzbekistan</option>
                                            <option value="VU" <?php echo ($lead['customer_country'] == 'VU') ? 'selected' : ''; ?>>Vanuatu</option>
                                            <option value="VA" <?php echo ($lead['customer_country'] == 'VA') ? 'selected' : ''; ?>>Vatican City State</option>
                                            <option value="VE" <?php echo ($lead['customer_country'] == 'VE') ? 'selected' : ''; ?>>Venezuela</option>
                                            <option value="VN" <?php echo ($lead['customer_country'] == 'VN') ? 'selected' : ''; ?>>Viet Nam</option>
                                            <option value="VG" <?php echo ($lead['customer_country'] == 'VG') ? 'selected' : ''; ?>>Virgin Islands GB</option>
                                            <option value="VI" <?php echo ($lead['customer_country'] == 'VI') ? 'selected' : ''; ?>>Virgin Islands US</option>
                                            <option value="WF" <?php echo ($lead['customer_country'] == 'WF') ? 'selected' : ''; ?>>Wallis,Futuna Islands</option>
                                            <option value="EH" <?php echo ($lead['customer_country'] == 'EH') ? 'selected' : ''; ?>>Western Sahara</option>
                                            <option value="YE" <?php echo ($lead['customer_country'] == 'YE') ? 'selected' : ''; ?>>Yemen</option>
                                            <option value="YU" <?php echo ($lead['customer_country'] == 'YU') ? 'selected' : ''; ?>>Yugoslavia</option>
                                            <option value="ZR" <?php echo ($lead['customer_country'] == 'ZR') ? 'selected' : ''; ?>>Zaire</option>
                                            <option value="ZM" <?php echo ($lead['customer_country'] == 'ZM') ? 'selected' : ''; ?>>Zambia</option>
                                            <option value="ZW" <?php echo ($lead['customer_country'] == 'ZW') ? 'selected' : ''; ?>>Zimbabwe</option>

                                        </select>
                                    </div>

                                    <!-- hidden fields -->
                                    <input type="hidden" class="form-control" id="lead_id" name="lead_id" value="<?= $lead['id'] ?>">

                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save Lead</button>
                                </div>
                            </div>


                        </div>
                    </div>




                </div>
            </form>

        </div>
        <!-- end contact details -->

        <!-- notes -->
        <div class="card border-2 mb-4">
            <div class="card-header">Notes</div>

            <form action="" method="post" id="add_lead_notes_form">
                <div class="card-body text-dark">

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Added by</label><br />
                                <?= $_SESSION['customer']['first_name'] . ' ' . $_SESSION['customer']['last_name'] ?>
                            </div>
                            <div class="mb-3">
                                <label for="action_id" class="form-label">Action</label>
                                <select class="form-select valid" name="action_id" aria-invalid="false">
                                    <option value="" selected="">Please select...</option>
                                    <?php foreach ($lead_note_actions as $action) { ?>
                                        <option value="<?= $action['id'] ?>"><?= $action['name'] ?></option>
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
                            <div class="row mb-3">
                                <label for="gdpr_check" class="form-label">GDPR Verification Check</label><br />

                                <div class="col-lg-6">
                                    <input type="checkbox" id="gdpr_check[]" name="gdpr_check[]" value="Full Name">
                                    <label class="checkbox-label">Full Name</label><br>
                                    <input type="checkbox" id="gdpr_check[]" name="gdpr_check[]" value="Case Reference Number">
                                    <label class="checkbox-label">Case Reference Number</label><br>
                                    <input type="checkbox" id="gdpr_check[]" name="gdpr_check[]" value="Telephone Number">
                                    <label class="checkbox-label">Telephone Number</label><br>
                                </div>
                                <div class="col-lg-6">
                                    <input type="checkbox" id="gdpr_check[]" name="gdpr_check[]" value="Email Address">
                                    <label class="checkbox-label">Email Address</label><br>
                                    <input type="checkbox" id="gdpr_check[]" name="gdpr_check[]" value="Post Code">
                                    <label class="checkbox-label">Post Code</label><br>
                                    <input type="checkbox" id="gdpr_check[]" name="gdpr_check[]" value="Password">
                                    <label class="checkbox-label">Password</label><br>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Details</label>
                                <textarea class="form-control" id="content" name="content" placeholder="Type notes here..." rows="6"></textarea>
                            </div>
                        </div>

                        <!-- previous notes -->
                        <div class="col-lg-6">
                            <label class="form-label">Previous notes</label>
                            <div class="row mb-3 h-100" style="position:relative;">

                                <div class="col-lg-12" style="height:100%;position: absolute;top: 0;bottom: 0;right: 0;overflow-y: auto;width: 100%;">
                                    <?php
                                    foreach ($lead_notes as $note) {
                                        $author = Lead::getLeadNoteAuthor($note['user_id']);
                                    ?>
                                        <div class="alert alert-warning" role="alert">
                                            <small><?= date('d/m/Y @ H:i', strtotime($note['created_at'])) ?> by <?= $author['first_name'] ?></small><br />
                                            <?= $note['content'] ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- hidden fields -->
                    <input type="hidden" class="form-control" name="lead_id" value="<?= $lead['id'] ?>">
                    <input type="hidden" class="form-control" name="user_id" value="<?= $_SESSION['customer']['id'] ?>">

                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary"><i class="bx bx-list-check"></i> Save Notes</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
        <!-- end notes -->

        <!-- actions -->
        <div class="card border-2 mb-0">
            <div class="card-header">Actions</div>
            <div class="card-body text-dark">


                <div class="row">

                    <div class="col-lg-12">

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


        </div>
        <!-- end actions -->