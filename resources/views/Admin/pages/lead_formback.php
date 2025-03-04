@if(session()->get('admin_login'))
@foreach(session()->get('admin_login') as $admin_login)
@extends('Admin.layouts.master')
@section('main-content')
<!-- Main Content Start Here  -->
<div class="container" id="main-container">
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title lead_page_title ">
            <div>
                <h3><i class="fa fa-file"></i> Lead From</h3>
            </div>
        </div>
        <!-- END Page Title -->
        <input type="hidden" name="admin_id" id="admin_id" value="{{$admin_login->id}}">
        <!-- BEGIN Main Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-sm-12 col-lg-12 controls">
                                <select name="product_id" id="productSelect" class="form-control"
                                    data-placeholder="Choose a Category" tabindex="1">
                                    <option disabled="true" selected="true">Select Product</option>
                                    @php
                                    $products = DB::table('tbl_product')->orderBy('id','desc')->get();
                                    @endphp
                                    @foreach($products as $item)
                                    <option value="{{ $item->id }}">{{ $item->product_name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="mobileInputContainer" style="display: none;">
                        <div class="form-group">
                            <div class="col-sm-12 col-lg-12 controls">
                                <div class="input-group">
                                    <span class="input-group-addon">Mobile Number</span>
                                    <input class="form-control" type="text" name="mobile" id="mobileInput"
                                        placeholder="##########" oninput="sendData()">
                                </div>
                                <!-- Mobile Number Allready Exist This Lead  -->
                                <span id="mobileError" style="color:red;display:none">Mobile number already exists for
                                    this lead</span>
                                    <!-- Mobile Number 10 Digits Only Allowed Message Here  -->
                                    <span id="mobileError10Digit" style="color:red;display:none"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 30px;display: flex;justify-content: center;">
                        <a style="display:none" href="#" class="addlead" onclick="redirectToAddLeads()">
                            <button class="btn btn-success"><i class="fa fa-plus"></i> Add Leads</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <p class="leads_list">If Leads are avilable then Show Here --- </p>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                <span id="filesentloginmsg" style="color: red;font-weight: bold;font-size: 26px;text-align: center;"></span>
                <span id="remaining_days" style="color: red;font-weight: bold;font-size: 26px;text-align: center;"></span>
                </div>
            </div>
    </div>
        <!-- END Main Content -->
    </div>
    <!-- END Content -->
</div>

<!-- Main Content End Here  -->


<!-- JS Links Start Here -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Mobile No Validate Only Digits Allowed Start Here -->
<script>
    $(document).ready(function () {
        $("#mobileInput").on("input", function () {
            let value = $(this).val();
            // Sirf 0-9 digits allow karega, baki sab remove karega (spaces, letters, symbols)
            let cleanedValue = value.replace(/[^0-9]/g, ''); 
            $(this).val(cleanedValue);
        });
    });
</script>
<!-- Mobile No Validate Only Digits Allowed End Here -->


<!-- Redirect to Lead Form Page Start Here  -->
<script>
function redirectToAddLeads() {
    const productSelect = document.getElementById('productSelect');
    const mobileInput = document.getElementById('mobileInput');
    const selectedProduct = productSelect.value;
    const mobileNumber = mobileInput.value;
    window.location.href = `/admin-leads?product_id=${selectedProduct}&mobile=${mobileNumber}`;
}
</script>
<!-- Redirect to Lead Form Page End Here  -->


<!-- after select mobile input box show  -->
<script>
$('#productSelect').on('change', function() {
    var mobileInputContainer = $('#mobileInputContainer');
    if ($(this).val()) {
        mobileInputContainer.show();
    } else {
        mobileInputContainer.hide();
    }
});
</script>

<!-- Mobile Number 10 Digits Allowed Only -->
<script>
    $('#mobileInput').on('input', function() {
    const mobileNumber = $(this).val(); 
    if (mobileNumber.length !== 10 && mobileNumber.length > 0) {
        $('#mobileError10Digit').show().text("Mobile number must be exactly 10 digits.");
    } else {
        $('#mobileError10Digit').hide();
    }
});
</script>
<!-- Mobile Number 10 Digits Allowed Only -->


<!-- Check Lead Already Exist -->
<script>
function sendData() {
    var admin_id = document.getElementById('admin_id').value;
    var mobile = document.getElementById('mobileInput').value;
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
            $('#mobileError').hide();       // mobileError
            $('#filesentloginmsg').hide(); // filesentloginmsg
            $('#remaining_days').hide();  // remaining_days
            if (data.success === 'exists') 
            {
                var remainingDays = '';  // remainign_days 
                // Show the error message with additional details
                if (data.lead_status === 'FILE SENT TO LOGIN') {
                    var errorMessage = "This file is already logged in the system";
                    errorMessage += " at " + data.date;
                }
                $('#filesentloginmsg').text(errorMessage).show();
                $('#mobileError').show();

                // Append remaining locking days only if greater than 0
                if (data.remaining_day && data.remaining_day > 0 && data.remaining_day <= 15) {
                    // This lead already exists in the CRM and 15 days locking. Not over yet and it is in active lead
                    remainingDays += "This lead already exists in the CRM and " + data.remaining_day + " days locking. Not over yet and it is in active lead";
                } else {
                    // Handle the else case (if remaining_day is greater than 15 or not set)
                    remainingDays += "The 15-day locking period is over.";
                }
                $('#remaining_days').text(remainingDays).show();
            } 
            else if (data.success === 'not_found') {
                const mobileInputValue = $('#mobileInput').val();
                if (mobileInputValue.length === 10) {
                    $('.addlead').css('display', 'block');
                } else {
                    $('.addlead').css('display', 'none');
                }
            }
        },
        error: function(err) {
            console.error(err);
            alert("An error occurred. Please try again later.");
        }
    });
}
</script>

@endsection
@endforeach
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif