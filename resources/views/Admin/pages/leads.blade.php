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
                                    <select id="productSelect1" class="form-control" disabled>
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

                        <div class="col-sm-12">
                            <h3>Obligation</h3>
                        </div>

                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Salary</label>
                                <div class="controls">
                                    <input type="text" id="salary" name="salary" placeholder="₹" class="form-control" oninput="formatSalary(this)">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Yearly Bonus</label>
                                <div class="controls">
                                <input type="text" id="yearly_bonus" name="yearly_bonus"
                                  placeholder="₹" class="form-control" oninput="formatSalary(this)">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Loan amount Required</label>
                                <div class="controls">
                                <input type="text" id="loan_amount" name="loan_amount"
                                    placeholder="₹" class="form-control"
                                    oninput="formatSalary(this)">
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-11">
                            <div class="form-group">
                                <label class="control-label text-light">Company Name</label>
                                <div class="controls">
                                <input type="text" name="company_name" placeholder="Comapny Name" class="form-control">
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-1">
                            <div class="form-group">
                                <div class="controls">
                                <a style="margin-top: 23px;" href="https://www.zaubacorp.com/"
                                                target="_blank" class="btn">check</a>
                                </div>
                            </div>
                        </div> 

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-light">Company type</label>
                                <div class="controls">
                                    <select name="company_type" id="companyType" class="form-control"
                                        data-placeholder="Choose a Category" tabindex="1">
                                        <option selected="true" disabled="true" >--
                                            Company Type --</option>
                                        <option value="LLP FIRM">
                                            LLP FIRM</option>
                                        <option value="LIMITED FIRM">
                                            LIMITED FIRM</option>
                                        <option value="PRIVATE LIMITED FIRM">
                                            PRIVATE LIMITED FIRM</option>
                                        <option value="DEFENCE">
                                            DEFENCE</option>
                                        <option value="GOVERNMENT DOCTOR">
                                            GOVERNMENT DOCTOR</option>
                                        <option value="GOVERNMENT TEACHER">
                                            GOVERNMENT TEACHER</option>
                                        <option value="PARTENERSHIP FIRM">
                                            PARTENERSHIP FIRM</option>
                                        <option value="PROPRITER">
                                            PROPRITER</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-light">Company Category</label>
                                <div class="controls">
                                    <!-- Second Dropdown -->
                                    <select name="company_category_id" id="productSelect"
                                        class="form-control" data-placeholder="Choose a Category"
                                        tabindex="1">
                                        <option disabled="true" selected="true">-- Select Company
                                            Category --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label"> Obligation</label>
                                <div class="controls">
                                    <input type="text" name="obligation" id="obligation_section"
                                        readonly class="form-control" style="height:45px !important;font-weight: bold; font-size: 17px;background-color:red;color:white;">
                                    <!-- hidden  -->
                                    <input type="hidden" id="obligation_section_hidden" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label"> Bt Pos</label>
                                <div class="controls">
                                    <input type="text" name="pos" id="pos_section" readonly class="form-control"
                                        style="height:45px !important;font-weight: bold; font-size: 17px;background-color:green;color:white;">
                                    <!-- hidden -->
                                    <input type="hidden" id="pos_section_hidden" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label"> Cibil Score</label>
                                <div class="controls">
                                    <input type="text" name="cibil_score" id="cibil_score" class="form-control" maxlength="3">
                                </div>
                            </div>
                        </div>

                        <!-- Start Here  -->

                        <div class="table-responsive">
                            <table class="table table-advance" style="padding: 0px;">
                                <thead style="background-color: black;">
                                    <tr>
                                        <th>#</th>
                                        <th>Loan Type</th>
                                        <th>Bank Name</th>
                                        <th>Total Loan Amount</th>
                                        <th>Bt POS</th>
                                        <th>EMI</th>
                                        <th>BT OR Obligate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dynamicRows">
                                    <!-- Start Here Invoice -->
                                    <tr id="templateRow">
                                        <td>1</td>
                                        <td>
                                            <select name="product_idd[]" class="form-control product-select"
                                                tabindex="1">
                                                <option disabled="true" selected="true">Select Product
                                                </option>
                                                @php
                                                $productsdata = DB::table('tbl_product')->orderBy('id',
                                                'desc')->get();
                                                @endphp
                                                @foreach($productsdata as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->product_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bank_id[]" class="form-control bank-select"
                                                tabindex="1">
                                                <option disabled="true" selected="true">Select Bank</option>
                                                @php
                                                $banksdata = DB::table('tbl_bank')->orderBy('id',
                                                'desc')->get();
                                                @endphp
                                                @foreach($banksdata as $item)
                                                <option value="{{ $item->id }}">{{ $item->bank_name ?? '' }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="total_loan_amount[]"
                                                class="form-control"></td>
                                        <td><input type="text" name="bt_pos[]" class="form-control bt_pos"
                                                placeholder="" oninput="updateTotal()"></td>
                                        <td><input type="text" name="bt_emi[]" class="form-control bt_emi"
                                                placeholder=""></td>
                                        <td>
                                            <select name="bt_obligation[]" class="form-control" tabindex="1" required>
                                                <option value="" disabled selected>-- Select Category --</option>
                                                <option value="BT">BT</option>
                                                <option value="Obligation">Obligation</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success" id="addMore">Add
                                                More</button>
                                        </td>
                                    </tr>
                                    <!-- End Here Invoice -->     
                                </tbody>
                                    
                                <tr>
                                    <td class="total_text_table_footer" colspan="4">Total</td>
                                    <td class="total_text_table_footer" colspan="1">₹<span
                                            id="totalPos">0</span></td>
                                    <td class="total_text_table_footer" colspan="3">₹<span
                                            id="totalEmi">0</span></td>
                                </tr>
                            </table>
                        </div>
                        <!-- Start End  -->

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


<!-- Append Row Here Obligation -->
<script>
$(document).ready(function() {
    let rowCount = 1;
    // Add a new row
    $(document).on('click', '#addMore', function() {
        rowCount++;
        let newRow = $('#templateRow').clone();
        newRow.removeAttr('id');
        newRow.find('input[type="text"]').val('');
        newRow.find('select').prop('selectedIndex', 0);
        newRow.find('td:first').text(rowCount);

        newRow.find('#addMore')
            .removeAttr('id')
            .addClass('btn-danger removeRow')
            .removeClass('btn-success')
            .text('Remove');
        $('#dynamicRows').append(newRow);
        updateTotal();
    });

    // Remove a row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
        updateRowNumbers();
        updateTotal();
    });

    // This is for Updated Row Here 
    $(document).on('change', 'select[name="bt_obligation1[]"]', function() {
        var bt_obligation1 = $(this).val();
        var row1 = $(this).closest('tr');

        if (bt_obligation1 === 'BT') {
            // row.find('input[name="bt_emi[]"]').val(''); // Clear BT EMI input
            row1.css('background-color',
            'green'); // Change bg color of the entire row to green
        } else if (bt_obligation1 === 'Obligation') {
            // row.find('input[name="bt_pos[]"]').val(''); // Clear BT POS input
            row1.css('background-color',
            'red'); // Change bg color of the entire row to red
        }
        updateTotal();
    });

    // old here 
    $(document).on('change', 'select[name="bt_obligation[]"]', function() {
        var bt_obligation = $(this).val();
        var row = $(this).closest('tr');

        if (bt_obligation === 'BT') {
            // row.find('input[name="bt_emi[]"]').val(''); // Clear BT EMI input
            row.closest('tr').css('background-color',
            'green'); // Change bg color of the entire row to green
        } else if (bt_obligation === 'Obligation') {
            // row.find('input[name="bt_pos[]"]').val(''); // Clear BT POS input
            row.closest('tr').css('background-color',
            'red'); // Change bg color of the entire row to red
        }
        updateTotal();
    });
    // Recalculate totals when input values change
    $(document).on('input', 'input[name="bt_pos[]"], input[name="bt_emi[]"]', function() {
        updateTotal();
    });
    // Update row numbers
    function updateRowNumbers() {
        $('#dynamicRows tr').each(function(index, row) {
            if (!$(row).hasClass('total_text_table_footer')) {
                $(row).find('td:first').text(index + 1);
            }
        });
        rowCount = $('#dynamicRows tr').length;
    }
    // Update total calculation
    function updateTotal() {
        let totalPos = 0;
        let totalEmi = 0;
        $('#dynamicRows tr').each(function() {
            var bt_obligation = $(this).find('select[name="bt_obligation[]"]').val();

            var btPos = Math.floor($(this).find('input[name="bt_pos[]"]').val() || 0);
            var btEmi = Math.floor($(this).find('input[name="bt_emi[]"]').val() || 0);

            // Condition to only add BT POS if category is not 'Obligation'
            if (bt_obligation !== 'Obligation') {
                totalPos += btPos; // Add to total for BT POS
            }
            // Condition to only add Obligation EMI if category is not 'BT'
            if (bt_obligation !== 'BT') {
                totalEmi += btEmi; // Add to total for Obligation EMI
            }
        });
        // Update total amounts on the page
        let totalPosAmount = Math.floor(totalPos);
        let totalEmiAmount = Math.floor(totalEmi);

        $('#totalPos').text(totalPosAmount); // Update the total for BT POS
        $('#totalEmi').text(totalEmiAmount); // Update the total for Obligation EMI

        // Hidden values for additional sections
        let pos_section_hidden = Math.floor($('#pos_section_hidden').val() || 0);
        let TotalPosAmount = totalPosAmount + pos_section_hidden;

        let obligation_section_hidden = Math.floor($('#obligation_section_hidden').val() || 0);
        let TotalObligationAmount = totalEmiAmount + obligation_section_hidden;

        $('#pos_section').val('₹ ' + Math.floor(TotalPosAmount).toLocaleString('en-IN'));  
        $('#obligation_section').val('₹ ' + Math.floor(TotalObligationAmount).toLocaleString('en-IN'));  
    }
    // Update total on `pos_section` input changes
    $(document).on('input', '#pos_section', function() {
        updateTotal();
    });
    // Update total on `obligation_section` input changes
    $(document).on('input', '#obligation_section', function() {
        updateTotal();
    });
});
</script>
<!-- Append Row Here -->






<script>
    function formatSalary(input) {
    // Sirf numbers ko allow karna, ₹ aur commas ko handle karna
    let value = input.value.replace(/[^0-9]/g, ''); // Sirf numbers ko rakhenge
    if (value) {
        input.value = '₹ ' + new Intl.NumberFormat('en-IN').format(value); // ₹ aur commas laga rahe hain
    } else {
        input.value = '₹ ';
    }
}
</script>
<!-- Mobile No Validate Only Digits Allowed Start Here -->
<script>
$(document).ready(function() {
    $("#cibil_score").on("input", function() {
        let value = $(this).val();
        // Sirf 0-9 digits allow karega aur max 3 characters rakhega
        let cleanedValue = value.replace(/[^0-9]/g, '').slice(0, 3);
        $(this).val(cleanedValue);
    });
});
</script>
<!-- Mobile No Validate Only Digits Allowed End Here -->



<!-- Onchange Company type to company category  -->
<script>
$(document).ready(function() {
    $('#companyType').on('change', function() {
        let companyType = $(this).val();
        let validTypes = ['LLP FIRM', 'PARTENERSHIP FIRM', 'PROPRITER']; // Backend ke saath match kiya

        if (validTypes.includes(companyType)) {
            $('#productSelect').prop('disabled', false).show().empty().append(
                '<option disabled="true" selected="true">Loading...</option>'
            );
            $('#productSelect').closest('.form-group').closest('.col-sm-12').show();

            $.ajax({
                url: "/fetch-company-category", // Laravel route
                method: "POST",
                data: { company_type: companyType },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") // CSRF token added
                },
                success: function(response) {
                    $('#productSelect').empty().append(
                        '<option disabled="true" selected="true">Select Product</option>'
                    );

                    if (response.length > 0) {
                        response.forEach(function(item) {
                            $('#productSelect').append(
                                `<option value="${item.id}">${item.company_name} - ${item.company_category} - ${item.company_bank}</option>`
                            );
                        });
                    } else {
                        $('#productSelect').append('<option disabled="true">No Data Found</option>');
                    }
                },
                error: function(xhr) {
                    console.error("Error: ", xhr.responseText);
                    alert('Failed to fetch data. Please try again.');
                }
            });
        } else {
            $('#productSelect').prop('disabled', true).hide().empty().append(
                '<option disabled="true" selected="true">Select Product</option>'
            );
            $('#productSelect').closest('.form-group').closest('.col-sm-12').hide();
        }
    });

    // Handle case where value is already selected on page load
    let companyType = $('#companyType').val();
    let validTypes = ['LLP FIRM', 'PARTENERSHIP FIRM', 'PROPRITER'];
    if (!validTypes.includes(companyType)) {
        $('#productSelect').prop('disabled', true).hide().empty().append(
            '<option disabled="true" selected="true">Select Product</option>'
        );
        $('#productSelect').closest('.form-group').closest('.col-sm-12').hide();
    }
});
</script>


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