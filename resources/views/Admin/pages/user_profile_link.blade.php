<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body {
        background-color: black;
    }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 col-lg-12">
                <h2 class="text-white" style="color: #03b0f5 !important;font-weight: 800;font-size: 40px !important;"><i class="fa fa-user"></i> {{$leads->name ?? ''}}</h2><br>
                <p class="text-white" style="font-weight:bold;font-size:18px">
                Add this in above sharable form
                This is just a Google form. Please fill it out carefully, as the same information will be manually entered by our representative on the physical bank application form. Any errors may lead to delays in processing your loan.
                </p>
            </div>

            <form id="edit_loginform_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$leads->id ?? ''}}" text>
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <div class="form-group">
                            <label class="control-label text-light">Qualifiaction</label>
                            <select name="qualification" class="form-control" id="statusSelect">
                                <option value="" disabled <?php echo empty($leads->qualification) ? 'selected' : ''; ?>>
                                    Select</option>
                                <option value="10th" <?php echo $leads->qualification === '10th' ? 'selected' : ''; ?>>
                                    10th</option>
                                <option value="12th" <?php echo $leads->qualification === '12th' ? 'selected' : ''; ?>>
                                    12th</option>
                                <option value="Graduate"
                                    <?php echo $leads->qualification === 'Graduate' ? 'selected' : ''; ?>>Graduate
                                </option>
                                <option value="Master"
                                    <?php echo $leads->qualification === 'Master' ? 'selected' : ''; ?>>Master</option>
                                <option value="Phd" <?php echo $leads->qualification === 'Phd' ? 'selected' : ''; ?>>Phd
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <!-- <div class="form-group">
                            <label class="control-label text-light">Pan card Number</label>
                            <input type="text" name="pan_card_no" value="{{$leads->pan_card_no ?? ''}}"
                                class="form-control">
                        </div> -->
                        <!-- <div class="form-group">
                            <label class="control-label text-light">SALARY ACCOUNT BANK
                                NAME</label>
                            <div class="controls">
                                <select name="product_id" class="form-control" data-placeholder="Choose a Category"
                                    tabindex="1">
                                    <option disabled="true" selected="true">Select Product</option>
                                    @php
                                    $products = DB::table('tbl_product')->orderBy('id', 'desc')->get();
                                    @endphp
                                    @foreach($products as $item)
                                    <option value="{{ $item->id }}"
                                        {{ isset($leads->product_id) && $leads->product_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->product_name ?? '' }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->

                    </div>
                    <div class="col-md-6 col-lg-3">
                        <!-- <div class="form-group">
                            <label class="control-label text-light">DOB</label>
                            <input type="date" name="dob" value="{{$leads->dob ?? ''}}" class="form-control">
                        </div> -->
                        <!-- <div class="form-group">
                            <label class="control-label text-light">Account Number</label>
                            <input type="text" name="account_no" value="{{$leads->account_no ?? ''}}"
                                class="form-control">
                        </div> -->
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <!-- <div class="form-group">
                            <label class="control-label text-light">Father Name</label>
                            <input type="text" name="father_name" value="{{$leads->father_name ?? ''}}"
                                class="form-control">
                        </div> -->
                        <!-- <div class="form-group">
                            <label class="control-label text-light">IFSC Code</label>
                            <input type="text" name="ifsc_code" value="{{$leads->ifsc_code ?? ''}}"
                                class="form-control">
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">MOTHER NAME</label>
                            <input type="text" name="mother_name" value="{{$leads->mother_name ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">MARITAL STATUS</label>
                            <select name="marital_status" class="form-control" id="marital_status">
                                <option value="" disabled
                                    <?php echo empty($leads->marital_status) ? 'selected' : ''; ?>>Select</option>
                                <option value="Single"
                                    <?php echo $leads->marital_status === 'Single' ? 'selected' : ''; ?>>Single</option>
                                <option value="Married"
                                    <?php echo $leads->marital_status === 'Married' ? 'selected' : ''; ?>>Married
                                </option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3" id="spouseNameDiv" style="display:none;">
                        <div class="form-group">
                            <label class="control-label text-light">SPOUSE NAME</label>
                            <input type="text" name="spouse_name" value="{{$leads->spouse_name ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3" id="spouseDobDiv" style="display:none;">
                        <div class="form-group">
                            <label class="control-label text-light">SPOUSE DOB</label>
                            <input type="text" name="spouse_dob" id="spouse_dob" placeholder="DD-MM-YYYY"
                                value="{{$leads->spouse_dob ?? ''}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label text-light">CURRENT ADDRESS</label>
                            <textarea name="current_address"
                                class="form-control">{{$leads->current_address ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label text-light">CURRENT ADDRESS
                                LANDMARK</label>
                            <textarea class="form-control"
                                name="current_address_landmark">{{$leads->current_address_landmark ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">CURRENT ADDRESS
                                TYPE</label>
                            <select class="form-control" name="current_address_type" id="currentAddressType">
                                <option value="" disabled
                                    <?php echo empty($leads->current_address_type) ? 'selected' : ''; ?>>Select</option>
                                <option value="Owned"
                                    <?php echo $leads->current_address_type === 'Owned' ? 'selected' : ''; ?>>Owned
                                </option>
                                <option value="Rented"
                                    <?php echo $leads->current_address_type === 'Rented' ? 'selected' : ''; ?>>Rented
                                </option>
                                <option value="Company Provided"
                                    <?php echo $leads->current_address_type === 'Company Provided' ? 'selected' : ''; ?>>
                                    Company Provided</option>
                            </select>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">CURRENT ADDRESS
                                PROOF</label>

                            <select class="form-control" name="current_address_proof" id="currentAddressType">
                                <option value="" disabled
                                    <?php echo empty($leads->current_address_proof) ? 'selected' : ''; ?>>Select
                                </option>
                                <option value="Aadhar"
                                    <?php echo $leads->current_address_proof === 'Aadhar' ? 'selected' : ''; ?>>Aadhar
                                </option>
                                <option value="Utility Bill"
                                    <?php echo $leads->current_address_proof === 'Utility Bill' ? 'selected' : ''; ?>>
                                    Utility Bill</option>
                                <option value="Rental Agreement"
                                    <?php echo $leads->current_address_proof === 'Rental Agreement' ? 'selected' : ''; ?>>
                                    Rental Agreement</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">NUMBER OF YEARS LIVING
                                IN
                                CURRENT ADDRESS</label>
                            <input type="number" name="living_current_address_year"
                                value="{{$leads->living_current_address_year ?? '' }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">NUMBER OF YEARS LIVING
                                IN
                                CURRENT CITY</label>
                            <input type="number" name="living_current_city_year"
                                value="{{$leads->living_current_city_year ?? '' }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label text-light">PERMANENT
                                ADDRESS</label>
                            <textarea class="form-control"
                                name="permanent_address">{{$leads->permanent_address ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label text-light">PERMANENT ADDRESS
                                LANDMARK</label>
                            <textarea class="form-control"
                                name="permanent_address_landmark">{{$leads->permanent_address_landmark ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">COMPANY NAME</label>
                            <input type="text" name="company_name" value="{{$leads->company_name}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">YOUR DESIGNATION</label>
                            <input type="text" name="designation" value="{{$leads->designation ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">YOUR DEPARTMENT</label>
                            <input type="text" name="department" value="{{$leads->department ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">DOJ IN CURRENT
                                COMPANY</label>
                            <input type="text" name="current_company" id="current_company" placeholder="DD-MM-YYYY"
                                value="{{$leads->current_company ?? ''}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">CURRENT WORK
                                EXPEIRINCE</label>
                            <input type="text" name="current_work_experience"
                                value="{{$leads->current_work_experience ?? ''}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">TOTAL WORK
                                EXPERINCE</label>
                            <input type="text" name="total_work_experience"
                                value="{{$leads->total_work_experience ?? ''}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">PERSONAL EMAIL</label>
                            <input type="email" name="personal_email" value="{{$leads->personal_email ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">work EMAIL</label>
                            <input type="email" name="work_email" value="{{$leads->work_email ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label text-light">office ADDRESS</label>
                            <textarea class="form-control"
                                name="office_address">{{$leads->office_address ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label text-light">office ADDRESS
                                LANDMARK</label>
                            <textarea class="form-control"
                                name="office_address_landmark">{{$leads->office_address_landmark ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h5 style="color: #03b0f5 !important;">1st Reference</h5>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">REFERENCE NAME</label>
                            <input type="text" name="reference_name1" value="{{$leads->reference_name1 ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">REFERENCE mobile
                                number</label>
                            <input type="number" name="reference_mobile1" value="{{$leads->reference_mobile1 ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">REFERENCE
                                RELATION</label>
                            <select class="form-control" name="reference_relation1" id="currentAddressType">
                                <option value="" disabled
                                    <?php echo empty($leads->reference_relation1) ? 'selected' : ''; ?>>Select</option>
                                <option value="Friend"
                                    <?php echo $leads->reference_relation1 === 'Friend' ? 'selected' : ''; ?>>Friend
                                </option>
                                <option value="Relative"
                                    <?php echo $leads->reference_relation1 === 'Relative' ? 'selected' : ''; ?>>Relative
                                </option>
                                <option value="Colleague"
                                    <?php echo $leads->reference_relation1 === 'Colleague' ? 'selected' : ''; ?>>
                                    Colleague</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">REFERENCE
                                ADDRESS</label>
                            <textarea class="form-control"
                                name="reference_address1">{{$leads->reference_address1 ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h5 style="color: #03b0f5 !important;">2nd Reference</h5>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">REFERENCE NAME</label>
                            <input type="text" name="reference_name2" value="{{$leads->reference_name2 ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">REFERENCE mobile
                                number</label>
                            <input type="number" name="reference_mobile2" value="{{$leads->reference_mobile2 ?? ''}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">REFERENCE
                                RELATION</label>
                            <select class="form-control" name="reference_relation2" id="currentAddressType">
                                <option value="" disabled
                                    <?php echo empty($leads->reference_relation2) ? 'selected' : ''; ?>>Select</option>
                                <option value="Friend"
                                    <?php echo $leads->reference_relation2 === 'Friend' ? 'selected' : ''; ?>>Friend
                                </option>
                                <option value="Relative"
                                    <?php echo $leads->reference_relation2 === 'Relative' ? 'selected' : ''; ?>>Relative
                                </option>
                                <option value="Colleague"
                                    <?php echo $leads->reference_relation2 === 'Colleague' ? 'selected' : ''; ?>>
                                    Colleague</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="control-label text-light">REFERENCE
                                ADDRESS</label>
                            <textarea class="form-control"
                                name="reference_address2">{{$leads->reference_address2 ?? ''}}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn_loginform_submit bg-success text-light mb-4">Save</button>
            </form>
        </div>
    </div>

    <!-- js Start Here  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- DD-MM-YYYY spouse_dob,current_company -->
    <script>
    document.querySelectorAll("#spouse_dob, #current_company").forEach(function(input) {
        input.addEventListener("input", function(e) {
            let value = e.target.value.replace(/\D/g, ""); // Sirf numbers allow karega (0-9)
            if (value.length > 8) {
                value = value.substring(0, 8); // Maximum 8 digits allow karega
            }
            let formattedValue = "";
            // Date validation (DD should be 01-31)
            if (value.length >= 2) {
                let day = parseInt(value.substring(0, 2));
                if (day < 1) day = "01";
                if (day > 31) day = "31";
                formattedValue += day.toString().padStart(2, "0") + "-"; // Ensure two-digit format
            } else {
                formattedValue += value;
            }
            // Month validation (MM should be 01-12)
            if (value.length >= 4) {
                let month = parseInt(value.substring(2, 4));
                if (month < 1) month = "01";
                if (month > 12) month = "12";
                formattedValue += month.toString().padStart(2, "0") + "-"; // Ensure two-digit format
            } else if (value.length > 2) {
                formattedValue += value.substring(2, 4);
            }
            // Year (YYYY)
            if (value.length > 4) {
                formattedValue += value.substring(4, 8);
            }
            e.target.value = formattedValue; // Final formatted value set karega
        });
    });
    </script>
    <!-- DD-MM-YYYY spouse_dob,current_company -->


    <!-- Marital Status Single ke Case me Spouse name and dob hide rhenge  -->
    <script>
    $(document).ready(function() {
        var maritalStatus = $("#marital_status").val();
        if (maritalStatus === 'Single') {
            $("#spouseNameDiv").hide();
            $("#spouseDobDiv").hide();
        }
        $("#marital_status").change(function() {
            toggleSpouseFields();
        });

        function toggleSpouseFields() {
            var maritalStatus = $("#marital_status").val();
            if (maritalStatus === 'Married') {
                $("#spouseNameDiv").show();
                $("#spouseDobDiv").show();
            } else {
                $("#spouseNameDiv").hide();
                $("#spouseDobDiv").hide();
            }
        }
    });
    </script>

    <script>
    // Edit Login Form Start here
    $("#edit_loginform_form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{url('/updateLoginFormLink')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            encode: true,
            success: function(data) {
                console.log(data.success);
                if (data.success == 'success') {
                    // Redirect Then Current Page Close Bacause Not Press Back Button
                    swal("Form Save Successful", "", "success").then(() => {
                        var thankYouPage = window.open("{{url('/thankyou')}}", "_blank");
                        setTimeout(() => {
                            window.open('', '_self');
                            window.close();
                        }, 1000);
                    });
                } else {
                    swal("Form Not Save!", "", "error");
                    $(".btn_loginform_submit").prop('disabled', false);
                }
            },
            error: function(errResponse) {
                swal("Somthing Went Wrong!", "", "error");
                $(".btn_loginform_submit").prop('disabled', false);
            }
        });
    });
    </script>
</body>

</html>