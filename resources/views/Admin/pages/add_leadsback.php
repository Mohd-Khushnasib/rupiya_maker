@if(session()->get('admin_login'))
@extends('Admin.layouts.master')
@section('main-content')
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Product Name</label>
                                <div class="controls">
                                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="">Select Product</option>
                                        <option value="Category 1">PL & OD leads</option>
                                        <option value="Category 2">Home Loans</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Campaign Name</label>
                                <div class="controls">
                                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="">Select Product</option>
                                        <option value="Category 1">RUPIYA MAKER</option>
                                        <option value="Category 2">CRM DATA</option>
                                        <option value="Category 2">PERSONAL REFERENCE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Data Code</label>
                                <div class="controls">
                                    <input type="text" placeholder="Enter Data Code ..." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Customer Name</label>
                                <div class="controls">
                                    <input type="text" placeholder="Enter Customer Name ..." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Mobile Number</label>
                                <div class="controls">
                                    <input type="text" placeholder="Enter Mobile Number ..." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Alternate Mobile Number</label>
                                <div class="controls">
                                    <input type="text" placeholder="Enter Alternate Mobile Number ..."
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Pincode & City</label>
                                <div class="controls">
                                    <input type="text" placeholder="201301 , New Delhi" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h3>How To Process</h3>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Bank Name</label>
                                <div class="controls">
                                    <select class="form-control bank-select" data-placeholder="Choose a Category"
                                        tabindex="1">
                                        <option value="">Select Bank</option>
                                        <option value="hdfc" data-logo="hdfc.jpg">HDFC BANK</option>
                                        <option value="icici" data-logo="icici.jpg">ICICI BANK</option>
                                        <option value="kotak" data-logo="kotak-logo.png">KOTAK BANK</option>
                                        <option value="yes" data-logo="yes-logo.png">YES BANK</option>
                                        <option value="idfc" data-logo="idfc-logo.png">IDFC BANK</option>
                                        <option value="indusind" data-logo="indusind-logo.png">INDUSIND BANK
                                        </option>
                                        <option value="tata" data-logo="tata-logo.png">TATA CAPITAL</option>
                                        <option value="aditya" data-logo="aditya-logo.png">ADITYA BIRLA CAPITAL
                                        </option>
                                        <option value="bajaj" data-logo="bajaj-logo.png">BAJAJ FINANCE</option>
                                        <option value="fullertron" data-logo="fullertron-logo.png">FULLERTRON
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Product Need</label>
                                <div class="controls">
                                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="">Select Product</option>
                                        <option value="Category 1">PL Leads</option>
                                        <option value="Category 1">OD Leads</option>
                                        <option value="Category 2">Home Loans Leads</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">Case Type</label>
                                <div class="controls">
                                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="">Select Case Type</option>
                                        <option value="Category 1">FRESH LOAN NO BT</option>
                                        <option value="Category 2">ONLY BT</option>
                                        <option value="Category 2">BT WITH TOP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Loan Amount</label>
                                <div class="controls">
                                    <input type="text" placeholder="₹" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-light">REQUIRED TENURE</label>
                                <div class="controls">
                                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="">Select Months</option>
                                        <option value="1">1 Month</option>
                                        <option value="2">2 Months</option>
                                        <option value="3">3 Months</option>
                                        <option value="4">4 Months</option>
                                        <option value="5">5 Months</option>
                                        <option value="6">6 Months</option>
                                        <option value="7">7 Months</option>
                                        <option value="8">8 Months</option>
                                        <option value="9">9 Months</option>
                                        <option value="10">10 Months</option>
                                        <option value="11">11 Months</option>
                                        <option value="12">12 Months</option>
                                        <option value="13">13 Months</option>
                                        <option value="14">14 Months</option>
                                        <option value="15">15 Months</option>
                                        <option value="16">16 Months</option>
                                        <option value="17">17 Months</option>
                                        <option value="18">18 Months</option>
                                        <option value="19">19 Months</option>
                                        <option value="20">20 Months</option>
                                        <option value="21">21 Months</option>
                                        <option value="22">22 Months</option>
                                        <option value="23">23 Months</option>
                                        <option value="24">24 Months</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-light control-label">Year</label>
                                <div class="controls">
                                    <input type="text" placeholder="Years" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="text-light control-label">How to Process</label>
                                <div class="controls">
                                    <textarea class="form-control" name="" id=""></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 30px;display: flex;justify-content: center;">
                            <button class="btn  btn-success"> <i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Form End Here -->
    </div>
    <!-- END Content -->
</div>
<!-- Main Content End Here  -->
@endsection
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif