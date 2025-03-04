@if(session()->get('admin_login'))
@foreach(session()->get('admin_login') as $admin_login)
@extends('Admin.layouts.master')
@section('main-content')
<style>
input#tenure {
    position: relative;
}

datalist#tenureList {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
}
</style>

<!-- Main Content Start Here  -->
<div class="container" id="main-container">
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title lead_page_title ">
            <div>
                <h3><i class="fa fa-file"></i> Create Leads</h3>
            </div>
        </div>
        <!-- END Page Title -->
        <!-- Form Start Here -->
        <form id="add_form" action="javascript:void(0)" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>About</h3>
                        </div>
                        <input type="hidden" name="admin_id" id="admin_id" class="form-control"
                            value="{{$admin_login->id}}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Product Name</label>
                                <div class="controls">

                                    <!-- Disabled select field -->
                                    <select id="productSelect" class="form-control" disabled>
                                        <option disabled="true" selected="true">Select Product</option>
                                        @php
                                        $products = DB::table('tbl_product')->orderBy('id', 'desc')->get();
                                        @endphp
                                        @foreach($products as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($selectedProductId) && $selectedProductId == $item->id ? 'selected' : '' }}>
                                            {{ $item->product_name ?? '' }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- Hidden Input Field -->
                                    <input type="hidden" name="product_id" id="hiddenProductId"
                                        value="{{ $selectedProductId ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Campaign Name</label>
                                <div class="controls">
                                    <select required name="campaign_id" class="form-control"
                                        data-placeholder="Choose a Category" tabindex="1">
                                        <option disabled="true" selected="true">Select Campaign</option>
                                        @php
                                        $campaigns = DB::table('tbl_campaign')->orderBy('id','desc')->get();
                                        @endphp
                                        @foreach($campaigns as $item)
                                        <option value="{{ $item->id }}">{{ $item->campaign_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Data Code</label>
                                <div class="controls">
                                    <!-- <input type="text" name="data_code" id="data_code" placeholder="Enter Data Code ..."
                                        class="form-control"> -->
                                        <select name="data_code" id="data_code" class="form-control">
                                            <option selected="true" disabled="true">-- Choose Datacode --</option>
                                        @php
                                        $datacodes = DB::table('tbl_datacode')->orderBy('id','desc')->get();
                                        @endphp
                                        @foreach($datacodes as $item)
                                        <option value="{{ $item->id }}">{{ $item->datacode_name ?? '' }}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Customer Name</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" placeholder="First Name & Last Name"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Mobile Number</label>
                                <div class="controls">
                                    <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number ..."
                                        class="form-control" value="{{ $mobileNumber ?? '' }}" readonly>
                                    <!-- <span id="mobileError" style="color:red;display:none;"></span> -->
                                    <!-- 10 Digit Condition -->
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Alternate Mobile Number</label>
                                <div class="controls">
                                    <input oninput="sendData()" type="text" name="alternate_mobile"
                                        id="alternate_mobile" placeholder="Enter Alternate Mobile Number ..."
                                        class="form-control">
                                    <!-- Allready Mobile No In Lead -->
                                    <span id="mobileError" style="color:red;display:none">Mobile number already exists
                                        for
                                        this lead</span>
                                    <!-- Allready Mobile No In Lead -->
                                    <!-- Digit Check Max 10 -->
                                    <span id="alternatemobileError" style="color:red;display:none;"></span>
                                    <!-- 10 Digit Condition -->
                                    <!-- Error Message Display input alternate and match mobile no then message show -->
                                    <span id="altMobileError"></span>
                                    <!-- Error Message Display input alternate and match mobile no then message show -->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin-top:10px">
                            <div class="form-group">
                                <label class="text-light control-label">Pincode & City</label>
                                <div class="controls">
                                    <input type="text" name="pincode" id="pincode" placeholder="201301 , New Delhi"
                                        class="form-control" oninput="validatePincode()">
                                    <span id="pincodecheck" style="color: red; display: none;">Please enter a valid
                                        pincode format: 123456 , City</span>
                                </div>
                            </div>
                        </div>

                        <!-- How To Process Start Here -->

                        <!-- <div class="col-sm-12">
                            <h3>How To Process</h3>
                        </div> -->

                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Bank Name</label>
                                <div class="controls">
                                    <select name="bank_id" class="form-control bank-select"
                                        data-placeholder="Choose a Category" tabindex="1">
                                        <option disabled="true" selected="true">Select Bank</option>
                                        @php
                                        $banks = DB::table('tbl_bank')->orderBy('id','desc')->get();
                                        @endphp
                                        @foreach($banks as $item)
                                        <option value="{{ $item->id }}" data-logo="{{$item->image ?? '' }}">
                                            {{ $item->bank_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Product Need</label>
                                <div class="controls">
                                    <select name="product_need_id" class="form-control"
                                        data-placeholder="Choose a Category" tabindex="1">
                                        <option selected="true" disabled="true">Select Product Need</option>
                                        @php
                                        $product_needs = DB::table('tbl_product_need')->orderBy('id','desc')->get();
                                        @endphp
                                        @foreach($product_needs as $item)
                                        <option value="{{ $item->id }}">{{ $item->product_need ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Case Type</label>
                                <div class="controls">
                                    <select name="casetype_id" class="form-control" data-placeholder="Choose a Category"
                                        tabindex="1">
                                        <option selected="true" disabled="true">Select Case Type</option>
                                        @php
                                        $product_needs = DB::table('tbl_product_need')->orderBy('id','desc')->get();
                                        @endphp
                                        @foreach($product_needs as $item)
                                        <option value="{{ $item->id }}">{{ $item->product_need ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Loan Amount</label>
                                <div class="controls">
                                    <input type="text" name="loan_amount" id="loan_amount" placeholder="₹"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">REQUIRED TENURE</label>
                                <div class="controls">
                                    <input list="tenureList" name="tenure" id="tenure" class="form-control" placeholder="Select Months">
                                    <datalist id="tenureList">
                                        <option value="1 Month"></option>
                                        <option value="2 Months"></option>
                                        <option value="3 Months"></option>
                                        <option value="4 Months"></option>
                                        <option value="5 Months"></option>
                                        <option value="6 Months"></option>
                                        <option value="7 Months"></option>
                                        <option value="8 Months"></option>
                                        <option value="9 Months"></option>
                                        <option value="10 Months"></option>
                                        <option value="11 Months"></option>
                                        <option value="12 Months"></option>
                                        <option value="13 Months"></option>
                                        <option value="14 Months"></option>
                                        <option value="15 Months"></option>
                                        <option value="16 Months"></option>
                                        <option value="17 Months"></option>
                                        <option value="18 Months"></option>
                                        <option value="19 Months"></option>
                                        <option value="20 Months"></option>
                                        <option value="21 Months"></option>
                                        <option value="22 Months"></option>
                                        <option value="23 Months"></option>
                                        <option value="24 Months"></option>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Year</label>
                                <div class="controls">
                                    <input type="text" name="year" id="year" placeholder="Years" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="text-light control-label">How to Process</label>
                                <div class="controls">
                                    <textarea class="form-control" name="process" id="process"></textarea>
                                </div>
                            </div>
                        </div> -->
                        <!-- How To Process End Here -->
                        <div class="col-md-12" style="margin-top: 30px;display: flex;justify-content: center;">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Form End Here -->
    </div>
</div>
<!-- Main Content End Here  -->


<!-- JS Links Start Here -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var productSelect = document.getElementById("productSelect");
    var hiddenProductId = document.getElementById("hiddenProductId");

    // Select change hone par hidden input update ho
    productSelect.addEventListener("change", function() {
        hiddenProductId.value = this.value;
    });

    // Agar pehle se koi product selected hai to hidden input me set karein
    hiddenProductId.value = productSelect.value;
});
</script>
<!-- Check Lead Already Exist -->
<script>
function sendData() {
    var admin_id = document.getElementById('admin_id').value;
    var mobile = document.getElementById('alternate_mobile').value;
    var productId = document.getElementById('productSelect').value;
    var formData = new FormData();
    formData.append('admin_id', admin_id);
    formData.append('mobile', mobile);
    formData.append('product_id', productId);
    $.ajax({
        type: "POST",
        url: "{{url('/check_lead')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        success: function(data) {
            console.log(data);
            $('#mobileError').hide();
            if (data.success === 'exists') {
                $('#mobileError').show();
            }
        },
        error: function(err) {
            console.error(err);
            alert("An error occurred. Please try again later.");
        }
    });
}
</script>
<!-- Check Lead Already Exist -->

<!-- alternate_mobile and mobile both check then message show -->
<script>
$(document).ready(function() {
    $("#alternate_mobile").on("input", function() {
        let mainMobile = $("#mobile").val().trim();
        let alternateMobile = $(this).val().trim();
        if (alternateMobile === mainMobile) {
            $("#altMobileError").text("Alternate mobile number should be different").css("color",
                "red");
        } else {
            $("#altMobileError").text(""); // Error message hide karega agar valid hai
        }
    });
});
</script>
<!-- alternate_mobile and mobile both check then message show -->


<!-- Mobile No Validate Only Digits Allowed Start Here -->
<script>
$(document).ready(function() {
    $("#alternate_mobile").on("input", function() {
        let value = $(this).val();
        // Sirf 0-9 digits allow karega, baki sab remove karega (spaces, letters, symbols)
        let cleanedValue = value.replace(/[^0-9]/g, '');
        $(this).val(cleanedValue);
    });
});
</script>
<!-- Mobile No Validate Only Digits Allowed End Here -->


<!-- Check Pincode , Address Start Here -->
<script>
function validatePincode() {
    const inputField = document.getElementById('pincode');
    const errorMessage = document.getElementById('pincodecheck');
    let value = inputField.value.trim();

    // Allow only numeric characters for the first 6 digits
    const numericOnly = /^[0-9]*$/;

    // Agar 6 digits hain, aur koi comma nahi hai, toh comma add karo
    if (value.length === 6 && !value.includes(',')) {
        inputField.value = value + ", ";
    }

    // Regex for valid format: 6 digits followed by a comma and optional space
    const regex = /^(\d{6}),\s*/;

    // Restrict input to only numeric characters for the pincode
    if (!numericOnly.test(value.slice(0, 6))) {
        inputField.setCustomValidity("Please enter only numeric characters for the pincode.");
        errorMessage.style.display = 'inline';
        return;
    }

    // Check if the value is valid and does not contain alphabets
    const restrictedPattern = /^(?!878787$)\d{6}$/; // Check if not '878787'
    if (value.match(regex) && restrictedPattern.test(value.slice(0, 6))) {
        errorMessage.style.display = 'none';
        inputField.setCustomValidity("");
    } else if (value.length > 6) {
        inputField.value = value.slice(0, 6) + ", ";
        errorMessage.style.display = 'none';
    } else {
        inputField.setCustomValidity("Please enter a valid pincode format: 123456 , City");
        errorMessage.style.display = 'inline';
    }
}
</script>
<!-- Check Pincode , Address End Here -->


<!-- This is for years to year and month count here -->
<script>
document.getElementById("tenure").addEventListener("change", function() {
    const months = parseInt(this.value); // Get selected months
    const yearInput = document.getElementById("year");

    if (!isNaN(months)) {
        const years = Math.floor(months / 12); // Calculate years
        const remainingMonths = months % 12; // Calculate remaining months

        if (years > 0 && remainingMonths > 0) {
            yearInput.value =
                `${years}.${(remainingMonths / 12).toFixed(1).slice(2)} Years`; // Format as "1.6 Years"
        } else if (years > 0) {
            yearInput.value = `${years} Years`; // Format as "1 Year"
        } else {
            yearInput.value = `${remainingMonths} Months`; // Format as "6 Months"
        }
    } else {
        yearInput.value = ""; // Clear input if no selection
    }
});
</script>

<!-- Mobile And Alternate Mobile Number Both Check 10 Digits Start Here -->
<script>
function validateMobile() {
    const mobileInput = document.getElementById("mobile");
    const mobileError = document.getElementById("mobileError");
    // Get the entered value
    const mobileNumber = mobileInput.value;
    // Check if the length of the mobile number is not 10
    if (mobileNumber.length !== 10 && mobileNumber.length > 0) {
        mobileError.style.display = "block";
        mobileError.innerText = "Mobile number must be exactly 10 digits.";
    } else {
        mobileError.style.display = "none";
    }
}


// Check 10 Digits
$('#alternate_mobile').on('input', function() {
    const mobileNumber = $(this).val();
    if (mobileNumber.length !== 10 && mobileNumber.length > 0) {
        $('#alternatemobileError').show().text("Mobile number must be exactly 10 digits.");
    } else {
        $('#alternatemobileError').hide();
    }
});
</script>
<!-- Mobile And Alternate Mobile Number Both Check 10 Digits End Here -->


<!-- Add Lead Here -->
<script>
// add lead add here
// $("#add_form").submit(function(e) {
//     var campaign_id = $("select[name='campaign_id']").val();
//     var data_code = $("#data_code").val();
//     var name = $("#name").val();
//     var alternate_mobile = $("#alternate_mobile").val();
//     var pincode = $("#pincode").val();
//     if (campaign_id) {} else {
//         alertify.set('notifier', 'position', 'top-right');
//         alertify.error('Campaign Name required');
//         return;
//     }
//     if (data_code) {} else {
//         alertify.set('notifier', 'position', 'top-right');
//         alertify.error('Datacode required');
//         return;
//     }
//     if (name) {} else {
//         alertify.set('notifier', 'position', 'top-right');
//         alertify.error('Customer Name required');
//         return;
//     }
//     if (!alternate_mobile || alternate_mobile.length !== 10 || isNaN(alternate_mobile)) {
//         alertify.set('notifier', 'position', 'top-right');
//         alertify.error('Alternate Mobile Number must be exactly 10 digits');
//         return;
//     }
//     if (pincode) {} else {
//         alertify.set('notifier', 'position', 'top-right');
//         alertify.error('Pincode required');
//         return;
//     }


//     e.preventDefault();
//     var formData = new FormData(this);
//     $.ajax({
//         type: "post",
//         url: "{{url('/add_leads')}}",
//         data: formData,
//         dataType: "json",
//         contentType: false,
//         processData: false,
//         cache: false,
//         encode: true,
//         success: function(data) {
//             if (data.success == 'success') {
//                 document.getElementById("add_form").reset();
//                 swal("Lead Added Successfully", "", "success");
//                 // setTimeout(function() {
//                 //     window.location.reload();
//                 // }, 1000);
//                 window.location.href = "{{url('/admin-lead-form')}}";
//             } else if (data.success == 'exists') {
//                 swal(data.message, "", "warning");
//             } else {
//                 $(".btn_submit").prop("disabled", false);
//                 swal("Lead Not Added", "", "error");
//             }
//         },
//         error: function(err) {}
//     });
// });



$("#add_form").submit(function(e) 
{
    e.preventDefault();
    var campaign_id = $("select[name='campaign_id']").val();
    var data_code = $("#data_code").val();
    var name = $("#name").val();
    var mobile = $("#mobile").val();
    var alternate_mobile = $("#alternate_mobile").val();
    var pincode = $("#pincode").val();
    var product_id = $("select[name='product_id']").val(); // Get product_id

    if (!campaign_id) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Campaign Name required');
        return;
    }
    if (!data_code) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Datacode required');
        return;
    }
    if (!name) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Customer Name required');
        return;
    }
    if (!alternate_mobile || alternate_mobile.length !== 10 || isNaN(alternate_mobile)) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Alternate Mobile Number must be exactly 10 digits');
        return;
    }
    if (!pincode) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Pincode required');
        return;
    }
    if (mobile === alternate_mobile) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Mobile Number Already Exists');
        return;
    }

    // Check mobile existence before submitting form
    $.ajax({
        type: "POST",
        url: "{{ url('/check_mobile_existence') }}",
        data: {
            mobile: mobile,
            alternate_mobile: alternate_mobile,
            product_id: product_id
        },
        dataType: "json",
        success: function(response) {
            if (response.exists == true) {
                alertify.set('notifier', 'position', 'top-right');
                if (response.field === 'mobile') {
                    // alert("Mobile1 Alert");
                    alertify.error(response.message);
                } else if (response.field === 'alternate_mobile') {
                    // alert("Mobile2 ALert");
                    alertify.error(response.message);
                }
            } else {
                // alert("Wrong");
                var formData = new FormData($("#add_form")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ url('/add_leads') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    encode: true,
                    success: function(data) {
                        if (data.success == 'success') {
                            $("#add_form")[0].reset();
                            swal("Lead Added Successfully", "", "success");
                            window.location.href = "{{ url('/admin-lead-form') }}";
                        } else if (data.success == 'exists') {
                            swal(data.message, "", "warning");
                        } else {
                            $(".btn_submit").prop("disabled", false);
                            swal("Lead Not Added", "", "error");
                        }
                    },
                    error: function(err) {
                        console.log("Error:", err);
                    }
                });
            }
        },
        error: function(err) {
            console.log("Error:", err);
        }
    });
});

// add lead end here
</script>

@endsection
@endforeach
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif