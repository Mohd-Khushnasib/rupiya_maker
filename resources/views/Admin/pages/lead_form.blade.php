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
        <input type="hidden" name="admin_id" id="admin_id" class="admin_id" value="{{$admin_login->id}}">
        <!-- BEGIN Main Content -->
        
        <!-- Tab Start Here  -->
        <div class="row">
            <div class="tabbable">
                <ul id="myTab1" class="nav nav-tabs">
                    <li class="active"><a href="#Alldata" data-toggle="tab"><i class="fa fa-user"></i>
                            All</a></li>
                    <li><a href="#ReAssignMent" data-toggle="tab"><i class="fa fa-user"></i>
                            ReAssignment</a></li>
                </ul>
                <div id="myTabContent1" class="tab-content">
                    <div  class="tab-pane fade in active all_tabs_bg" id="Alldata">
                               <!-- Start Here  -->
                               <div class="row" style="margin-top:10px">
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
                                                            <input class="form-control mobileInput" type="text" name="mobile" id="mobileInput"
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
                               <!-- End Here  -->
                    </div>
                    <div class="tab-pane fade all_tabs_bg" id="ReAssignMent">
                        <!-- Reassign History Start Here -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 style="color: white;">Admin Panel - Reassignment Requests</h4>
                                <table id="reassignHistory" class="table table-bordered text-white" style="background-color: black;">
                                    <thead style="background-color: #333; color: white;">
                                        <tr>
                                            <th>Mobile Number</th>
                                            <th>Current Agent</th>
                                            <th>Requesting Agent</th>
                                            <th>Lead Status</th>
                                            <!-- <th>Actions</th> -->
                                             @php 
                                             $loggedInRole = $admin_login->role;
                                             @endphp
                                            @if($loggedInRole === 'Admin')
                                            <th>Actions</th>
                                            @else
                                            <th>Requesting Status </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @php 
                                        $loggedInUserId = $admin_login->id;   // Logged-in user ki ID
                                        $loggedInUserRole = $admin_login->role; // Logged-in user ka Role
                                        $reassignhistory = DB::table('tbl_reassignment_lead')
                                            ->leftJoin('tbl_lead', 'tbl_lead.id', '=', 'tbl_reassignment_lead.lead_id') // Sirf lead_id match karega
                                            ->leftJoin('admin as lead_admin', 'lead_admin.id', '=', 'tbl_lead.admin_id') // Lead ka admin ka naam
                                            ->leftJoin('admin as sender_admin', 'sender_admin.id', '=', 'tbl_reassignment_lead.sender_id') // Sender ka naam
                                            ->select(
                                                'tbl_lead.*', 
                                                'tbl_reassignment_lead.*', 
                                                'lead_admin.name as lead_admin_name',  // Current Agent Name
                                                'sender_admin.name as sender_admin_name' // Requesting Agent (jo login kiya hai)
                                            );
                                        // Agar logged-in user admin nahi hai, toh sirf uske sender_id wale records dikhaye
                                        if ($loggedInUserRole !== 'Admin') {
                                            $reassignhistory->where('tbl_reassignment_lead.sender_id', $loggedInUserId);
                                        }
                                        $reassignhistory = $reassignhistory->get();
                                    @endphp

                                    @if($reassignhistory->isNotEmpty())
                                        @php $sr = 1; @endphp
                                        @foreach($reassignhistory as $item)
                                            <tr>
                                                <td>{{ $item->mobile ?? '' }}</td>
                                                <td>{{ $item->lead_admin_name ?? '' }}</td>
                                                <td>{{ $item->sender_admin_name ?? '' }}</td>
                                                <td>{{ $item->lead_status ?? '' }}</td>
                                                <td>
                                                    @if($loggedInUserRole === 'Admin')
                                                        @if($item->lead_request_status === 'Pending')
                                                            <button class="btn btn-success action-btn" 
                                                                data-lead-id="{{ $item->lead_id }}" 
                                                                data-sender-id="{{ $item->sender_id }}" 
                                                                data-action="Accept">Accept</button>

                                                            <button class="btn btn-danger action-btn" 
                                                                data-lead-id="{{ $item->lead_id }}" 
                                                                data-sender-id="{{ $item->sender_id }}" 
                                                                data-action="Reject">Reject</button>
                                                        @else
                                                            {{ $item->lead_request_status ?? '' }}
                                                        @endif
                                                    @else
                                                        {{ $item->lead_request_status ?? '' }}
                                                    @endif
                                                </td>
                                            </tr>
                                            @php $sr++; @endphp
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

        
                        <!-- Reassign History End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab End Here  -->


        




        <!-- Reassignment start -->
        <div class="row" id="reassignmentBox" style="display:none">
            <div class="col-sm-12">
                <div class="box" style="background: black; padding: 10px; border-radius: 5px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <p class="leads_list" style="color: white; margin: 0;">
                        This lead already exists in the CRM. Generate Reassignment Request?
                    </p>
                    <button id="reassignBtn" style="background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;">
                        Generate Reassignment Request
                    </button>
                </div>
            </div>
        </div>
        <!-- Reassignment end -->
        <!-- Reassignment table start -->
        <div class="row">
            <div class="col-sm-12">
                <table id="leadsTablenew" class="table table-advance leadsTablenew filterleadsTablenew" style="display:none">
                    <thead style="background-color: black;">
                        <tr>
                            <th>#</th>
                            <th>Team Name</th>
                            <th>Manager Name</th>
                            <th>TL</th>
                            <th>Agent</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Product</th>
                            <th>Pincode & City</th>
                            <th>Loan Amount</th>
                            <th>Company Name</th>
                            <th>Company Category</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                            <td>1</td>
                            <td>Team 1</td>
                            <td>Manager 1</td>
                            <td>XYZ</td>
                            <td>XYZ</td>
                            <td id="customer_name"></td>
                            <td id="date"></td>
                            <td id="lead_status"></td>
                            <td id="product_name"></td>
                            <td id="pincode"></td>
                            <td id="loan_amount"></td>
                            <td id="company_name"></td>
                            <td>Financial Services</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Reassignment table end -->

        <!-- Assign Me Start Here  -->
        <div class="row" id="assignMeBox" style="display:none">
            <div class="col-sm-12">
                <div class="box" style="background: black; padding: 10px; border-radius: 5px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <p class="leads_list" style="color: white; margin: 0;">
                        This lead is marked lost. Assign to Me?
                    </p>
                    <!-- Button me data-lead-id dynamically set hoga -->
                    <button id="assignMeBtn"
                        style="background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;">
                        Assign to Me
                    </button>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="lostleadsTablenew" class="table table-advance lostleadsTablenew filterlostleadsTablenew" style="display:none">
                    <thead style="background-color: black;">
                        <tr>
                            <th>#</th>
                            <th>Team Name</th>
                            <th>Manager Name</th>
                            <th>TL</th>
                            <th>Agent</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Product</th>
                            <th>Pincode & City</th>
                            <th>Loan Amount</th>
                            <th>Company Name</th>
                            <th>Company Category</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                            <td>1</td>
                            <td>Team 1</td>
                            <td>Manager 1</td>
                            <td>XYZ</td>
                            <td>XYZ</td>
                            <td id="lostlead_customer_name"></td>
                            <td id="lostlead_date"></td>
                            <td id="lostlead_status"></td>
                            <td id="lostlead_product_name"></td>
                            <td id="lostlead_pincode"></td>
                            <td id="lostlead_loan_amount"></td>
                            <td id="lostlead_company_name"></td>
                            <td>Financial Services</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Assign Me End Here  -->
        <!-- filesenttologin and remainingdays -->
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
<!-- AssignToMe Modal Start Here -->
<div id="assignModal" class="modal" style="display: none;">
    <div class="modal-content" style="background: white; padding: 20px; border-radius: 10px; width: 50%; margin: auto;">
        <span class="close" style="color: black; float: right; font-size: 20px; cursor: pointer;">&times;</span>
        <h3 style="color: black;">Assign to me Lead</h3>

        <input type="text" name="lead_id" id="modalLeadId" class="form-control" readonly style="margin-bottom: 10px;" placeholder="Lead ID">
        <input type="text" name="admin_id" id="modalLoginId" class="form-control" readonly style="margin-bottom: 10px;" placeholder="Login ID">


        <label for="assignTo" style="font-weight: bold; margin-bottom: 5px;">Select Campaign</label>
        <select name="campaign_id" id="campaign_id" data-placeholder="Choose Campaign"
                class="form-control chosen" tabindex="6">
                <option value="" selected disabled>-- Select Campaign --</option>
            <optgroup label="">
                @php
                $campaigns = DB::table('tbl_campaign')->orderBy('id', 'desc')->get();
                @endphp
                @foreach($campaigns as $item)
                <option value="{{ $item->id }}">
                    {{ $item->campaign_name ?? '' }}
                </option>
                @endforeach
            </optgroup>
        </select>
        <label for="assignTo" style="font-weight: bold; margin-bottom: 5px;">Select Datacode</label>
        <select name="data_code" id="data_code" data-placeholder="Chosse Datacode"
            class="form-control chosen" tabindex="6">
            <option value="" selected disabled>--  Select Datacode --</option>
            <optgroup label="Designation">
                @php
                $datacodes = DB::table('tbl_datacode')->orderBy('id', 'desc')->get();
                @endphp
                @foreach($datacodes as $item)
                <option value="{{ $item->id }}">
                    {{ $item->datacode_name ?? '' }}
                </option>
                @endforeach
            </optgroup>
        </select>
        <button id="assignNowBtn" style="background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer; margin-top: 10px;">
            Assign Me
        </button>
    </div>
</div>
<!-- AssignToMe Modal End Here -->







<!-- JS Links Start Here -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    $(document).ready(function () {
    $(document).on('click', '.action-btn', function () {
        var lead_id = $(this).data('lead-id'); // Lead ID from button
        var sender_id = $(this).data('sender-id'); // Sender ID from button
        var action = $(this).data('action'); // Accept or Reject
        // alert("lead id : "+lead_id + " => sender id : "+ sender_id + " => action : "+action);
        if (lead_id && sender_id && action) {
            $.ajax({
                url: "{{ url('accept-reject-request') }}",
                type: 'POST',
                data: {
                    lead_id: lead_id,
                    sender_id: sender_id,
                    action: action
                },
                success: function (response) {
                    if (response.success === "success") {
                        swal("Success", response.message, "success").then(() => {
                            window.location.reload(); 
                        });
                    }
                },
                error: function (xhr) {
                    swal("Error", xhr.responseJSON.message || "Something went wrong!", "error");
                }
            });
        } else {
            swal("Warning", "Missing required values!", "warning");
        }
    });
});

</script>


<!-- When Tab click old data reset here -->
<script>
$(document).ready(function () {
    $('#myTab1 a').on('click', function (e) {
        e.preventDefault(); 
        var target = $(this).attr('href'); 
        $('#leadsTablenew, #reassignmentBox, #lostleadsTablenew, #assignMeBox').hide();
        $(this).tab('show'); 
    });
});
</script>


<!-- Reassignment  -->
<script>
$(document).ready(function () {
    $(document).on('click', '#reassignBtn', function () {
        var sender_id = $('#admin_id').val(); // Logged-in User ID sender_id
        var lead_id = $(this).data('lead-id'); // Lead ID from button data attribute
        if (sender_id && lead_id) {
            $.ajax({
                url: "{{ url('generate_reassignment_request') }}",
                type: 'POST',
                data: {
                    lead_id: lead_id,
                    sender_id: sender_id
                },
                success: function (response) {
                    if (response.success === "exist") {
                        swal("Info", response.message, "info"); // Show info message if request already exists
                    } else if (response.success === "success") {
                        swal("Success", response.message, "success").then(() => {
                            window.location.reload(); // Reload only on successful insert
                        });
                    }
                },
                error: function (error) {
                    swal("Error", response.message, "error");
                }
            });
        } else {
        }
    });
});
function showReassignmentBox(lead_id) {
    $('#reassignBtn').data('lead-id', lead_id);
    $('#reassignmentBox').show();
}
// Close Modal on "×" Button Click
$(document).ready(function () {
    $(document).on('click', '.close', function () {
        $('#assignModal').hide();
    });
});
</script>


<!-- Assign me  -->
<script>
function AssignMeBox(lostlead_id) {
    $('#assignMeBtn').attr('data-lead-id', lostlead_id);
    $('#assignMeBox').show();
}
$(document).on('click', '#assignMeBtn', function () {
    var lead_id = $(this).attr('data-lead-id');         // lead id
    var login_id = $('input[name="admin_id"]').val();  // login id
    if (!lead_id) {
        swal("Error", "Lead ID is missing!", "error");
        return;
    }
    $('#modalLeadId').val(lead_id);
    $('#modalLoginId').val(login_id);
    $('#assignModal').show();
});

// Assign to me controller code here
$(document).on('click', '#assignNowBtn', function () {
    var lead_id = $('#modalLeadId').val(); // ✅ Lead ID from input field
    var admin_id = $('#modalLoginId').val(); // ✅ Admin ID from input field
    var campaign_id = $('#campaign_id').val(); // ✅ Selected Campaign
    var data_code = $('#data_code').val(); // ✅ Selected Data Code

    if (!lead_id || !admin_id || !campaign_id || !data_code) {
        swal("Error", "All fields are required!", "error");
        return;
    }

    // ✅ AJAX Request to AssignToMe
    $.ajax({
        url: "{{ url('assign-to-me') }}",
        type: 'POST',
        data: {
            lead_id: lead_id,
            admin_id: admin_id,
            campaign_id: campaign_id,
            data_code: data_code
        },
        success: function (response) {
            if (response.success === "success") {
                swal("Success", response.message, "success").then(() => {
                    window.location.reload();
                });
            }
        },
        error: function () {
            swal("Error", "Something went wrong!", "error");
        }
    });
});
</script>
<!-- Assign me  -->



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
            $('#mobileError').hide();
            $('#filesentloginmsg').hide();
            $('#remaining_days').hide();

            if (data.success === 'exists') {
                var remainingDays = '';

                // Pehli priority: Jab 'FILE SENT TO LOGIN' ho
                if (data.lead_status === 'FILE SENT TO LOGIN') {
                    var errorMessage = "This file is already logged in the system at " + data.date + "   ( " + data.existing_lead.lead_status + ", " + data.existing_lead.login_status + " )";
                    $('#filesentloginmsg').text(errorMessage).show();
                    return; // Is condition ke true hone par yahi return ho jaye
                }
                $('#mobileError').show();

                if (!data.lostleads) {
                // Dusri priority: Jab locking days 15 se kam ya barabar ho
                if (data.remaining_day && data.remaining_day > 0 && data.remaining_day <= 15) {
                    remainingDays += "This lead already exists in the CRM and " + data.remaining_day +
                                    " days locking. Not over yet and it is in active lead";
                    $('#remaining_days').text(remainingDays).show();
                    return; // Is case ke true hone par yahi return ho jaye
                }
                // Teesri priority: Jab locking days 15 se jyada ho
                if (data.remaining_day > 15) {
                    var id = data.existing_lead.id;
                    var customer_name = data.existing_lead.name;
                    var date = data.existing_lead.date;
                    var lead_status = data.existing_lead.lead_status;
                    var product_name = data.existing_lead.product_name;
                    var pincode = data.existing_lead.pincode;
                    var loan_amount = data.existing_lead.loan_amount;
                    var company_name = data.existing_lead.company_name;
                    var lead_request_status = data.existing_lead.lead_request_status;

                    $('#date').html(date);
                    $('#lead_status').html(lead_status);
                    $('#product_name').html(product_name);
                    $('#pincode').html(pincode);
                    $('#loan_amount').html(loan_amount);

                    if (lead_request_status === "Accept") {
                        $("#customer_name").html(`<a href="{{url('/user_profile/${id}')}}">${customer_name}</a>`);
                    } else {
                        $("#customer_name").html(`<span style="color: grey; cursor: not-allowed;">${customer_name}</span>`);
                    }

                    $('#company_name').html(company_name);
                    $('#leadsTablenew').show();
                    $('#reassignmentBox').show();
                    showReassignmentBox(id);
                }
                // assign to me start here
                }
                // 🔹 Agar 'lostleads' ka data available hai, toh uska section bhi dikhana hai
                if (data.lostleads) {
                    var lostlead_id = data.existing_lead.id;
                    var lostlead_customer_name = data.existing_lead.name;
                    var lostlead_date = data.existing_lead.date;
                    var lostlead_lead_status = data.existing_lead.lead_status;
                    var lostlead_product_name = data.existing_lead.product_name;
                    var lostlead_pincode = data.existing_lead.pincode;
                    var lostlead_loan_amount = data.existing_lead.loan_amount;
                    var lostlead_company_name = data.existing_lead.company_name;
                    var lostlead_request_status = data.existing_lead.lead_request_status;

                    $('#lostlead_date').html(lostlead_date);
                    $('#lostlead_status').html(lostlead_lead_status);
                    $('#lostlead_product_name').html(lostlead_product_name);
                    $('#lostlead_pincode').html(lostlead_pincode);
                    $('#lostlead_loan_amount').html(lostlead_loan_amount);

                    if (lostlead_request_status === "Accept") {
                        $("#lostlead_customer_name").html(`<a href="{{url('/user_profile/${lostlead_id}')}}">${lostlead_customer_name}</a>`);
                    } else {
                        $("#lostlead_customer_name").html(`<span style="color: grey; cursor: not-allowed;">${lostlead_customer_name}</span>`);
                    }
                    $('#lostlead_company_name').html(lostlead_company_name);
                    $('#lostleadsTablenew').show();
                    $('#assignMeBox').show();
                    AssignMeBox(lostlead_id);
                }
                // assign to me end here
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
// onkeyup
$('.mobileInput').on('keyup', function () {
    $('#leadsTablenew').hide();  // Mobile number change karne par table hide ho jaye
    $('#reassignmentBox').hide();  // Mobile number change karne par table hide ho jaye
    $('#lostleadsTablenew').hide();  // Mobile number change karne par lostleadsTablenew hide ho jaye
    $('#assignMeBox').hide();  // Mobile number change karne par assignMeBox
});
</script>

@endsection
@endforeach
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif
