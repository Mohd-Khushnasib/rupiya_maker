@if(session()->get('admin_login'))
@extends('Admin.layouts.master')
@section('main-content')
<style>
    .modal-header .close {
    margin-top: -20px;
}
</style>
<div class="container" id="main-container">
    <!-- Account Sidebar  Start Here-->
    @include('Admin.pages.account_setting')
    <!-- Account Sidebar End Here -->

    <div id="main-content">

        <div class="row">

            <!-- Search -->
            <div class="col-sm-6 d-flex align-items-center">
                <input type="text" class="form-control search_data me-2" style="width: 100%;" 
                    placeholder="Search Here" pattern="\d*" title="Please Search Here" />
            </div>
            <!-- Search Here -->

            <!-- Add Company Category Here -->
            <div class="col-sm-6">
            <button id="AddExcelModal" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Company Category
                </button>
            </div>
             <!-- Add Company Category Here -->


            <div class="col-sm-12" style="margin-top: 20px;">
                <h5>All Company Category List</h5>
            </div>

            <div class="col-sm-12">
                <div class="table-responsive" style="border:0">
                    <table class="table table-advance" id="myTable">
                        <thead>
                            <tr>
                                <th style="width:18px">#</th>
                                <th style="width:18px"><input type="checkbox"></th>
                                <th>ACTION</th>
                                <th>COMPANY NAME - CATEGORIES - BANK</th>
                                <!-- <th>CATEGORIES</th>
                                <th>BANK</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <!-- Pagination Start Here -->
                        <nav class="mt-2">
                            <ul id="pagination" class="pagination" style="display: flex;justify-content: center;">
                                <!-- Pagination links will be populated here -->
                            </ul>
                        </nav>
                    <!-- Pagination End Here -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add CSV Modal Start Here -->
<div id="AddExcel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTitle">Add Company Category</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="add_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-3" style="margin-bottom:10px">
                        <label class="form-label"><b>Upload File</b></label>
                        <input type="file" class="form-control" name="file_import"
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required />
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success add_btn">📤 Upload</button>
                        <button type="button" class="btn btn-secondary " id="downloadSample">
                            📥 Download Sample File
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add CSV Modal End Here -->

<!-- Delete Start Here -->
<div id="deletemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: black;" id="exampleModalLabel">Delete Bank</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p>Are you sure you want to delete this? This action cannot be undone.</p>
                <form id="delete_form" action="javascript:void(0);" method="post">
                    @csrf
                    <input type="hidden" name="id" id="delete_id" value="" class="form-control">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between" style="margin-top: 15px;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn_delete">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete End Here -->

<!-- Edit Start Here -->
<div id="editmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                <h4 class="modal-title" style="color: black;" id="editModalLabel">Edit Company Category</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="edit_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="edit_id" value="" class="form-control">
                        <div class="col-sm-12">
                            <label for="bank_name">Company Name</label>
                            <input type="text" name="company_name" id="edit_company_name" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="bank_name">Categories</label>
                            <input type="text" name="company_category" id="edit_company_category" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="bank_name">Bank</label>
                            <input type="text" name="company_bank" id="edit_company_bank" class="form-control">
                        </div>
                       
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn_update" style="margin-top:15px; float:right;"
                                type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit End Here -->





<!-- JS Links Start Here -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<!-- JS Links End Here -->
<!-- Sample CSV File Download Here -->
<script>
    document.getElementById("downloadSample").addEventListener("click", function() {
        window.location.href = "/Admin/company-category.csv"; // Adjusted path
    });
</script>
<!-- Sample CSV File Download Here -->

<script>
// Excel Import Satrt Here
    let currentPage = 1;
    var searchKeyword = '';

    $(document).ready(function() {
        $('.search_data').keyup(function() {
            var searchKeyword = $(this).val();
            if (searchKeyword.length >= 3) {
                currentPage = 1;
                view_enquiry_api(currentPage, searchKeyword);
            } else {
                view_enquiry_api(currentPage);
            }
        });
        view_enquiry_api();
    });

    // upload excel here 
    $("#add_form").submit(function(e) 
    {
        $(".add_btn").prop('disabled', true);
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{url('/add_company_category')}}",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            encode: true,
            success: function(data) {
                $(".add_btn").prop("disabled", false);
                if (data.success == 'success') {
                    document.getElementById("add_form").reset();
                    $("#AddExcel").modal("hide");
                    swal("Comapny Category Uploaded Successfully", "", "success");
                    view_enquiry_api(currentPage);
                } else if (data.success == 'error') {
                    $(".add_btn").prop('disabled', false);
                    swal("Error", data.message, "error");
                }
            },
            error: function() {}
        });
    });

    // Show here 
    function view_enquiry_api(page = 1, search = '') {
        var search_data = search || $(".search_data").val();

        $.ajax({
            url: "{{ url('/show_company_category') }}",
            type: 'POST',
            data: {
                search: search_data,
                page: page,
            },
            success: function(response) {
                var tbody = $('#myTable tbody');
                var pagination = $('#pagination');
                var result = response.data;
                tbody.empty();
                pagination.empty();
                var total_enquiries = response.total;
                var per_page = response.per_page;
                var start_serial_number = (page - 1) * per_page;

                result.forEach(function(data, index) {
                    var serial_number = start_serial_number + index + 1;
                    tbody.append(`
                    <tr>
                        <td>${serial_number}</td>
                        <td><input type="checkbox" class="checkbox" data-id="${data.id}"></td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="javascript:void(0);" class="edit btn btn-primary me-2" data-company_name="${data.company_name}" data-company_category="${data.company_category}" data-company_bank="${data.company_bank}" data-id="${data.id}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger delete" href="javascript:void(0);" data-id="${data.id}"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </td>
                         <td>${data.company_name} - ${data.company_category} - ${data.company_bank}</td>
                    </tr>
                `);
                });

                // Function to handle the pagination links with ellipsis (1 2 ... 7 8)
                function generatePaginationLinks(currentPage, lastPage, searchKeyword) {
                    let pagination = $('#pagination');
                    searchKeyword = searchKeyword || '';
                    pagination.html('');
                    if (currentPage > 3) {
                        pagination.append(`
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(1, '${searchKeyword}')">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(2, '${searchKeyword}'">2</a>
                            </li>
                            <li class="page-item disabled"><a class="page-link">...</a></li>
                        `);
                    }

                    // Show the current page and two pages before and after it
                    for (let i = Math.max(1, currentPage - 2); i <= Math.min(lastPage, currentPage + 2); i++) {
                        pagination.append(`
                            <li class="page-item ${i === currentPage ? 'active' : ''}">
                                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${i}, '${searchKeyword}')">${i}</a>
                            </li>
                        `);
                    }

                    // Show the last two pages
                    if (currentPage < lastPage - 2) {
                        pagination.append(`
                            <li class="page-item disabled"><a class="page-link">...</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${lastPage - 1}, '${searchKeyword}')">${lastPage - 1}</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${lastPage}, '${searchKeyword}')">${lastPage}</a>
                            </li>
                        `);
                    }
                }

                // Call this function where you handle pagination
                if (response.last_page > 1) {
                    generatePaginationLinks(response.current_page, response.last_page);
                }

                // switch status start
                $('.StatusSwitch').change(function() {
                    var isChecked = $(this).is(':checked');
                    var switchLabel = this.value;
                    var checkedVal = isChecked ? 1 : 0;
                    // Display SweetAlert confirmation dialog with both buttons
                    swal({
                        title: "Are you sure?",
                        text: "You are about to update the status.",
                        icon: "warning",
                        buttons: ["Cancel", "Yes, update it"],
                        dangerMode: true,
                    }).then((willUpdate) => {
                        if (willUpdate) {
                            var formData = new FormData();
                            formData.append('id', switchLabel);
                            formData.append('status', checkedVal);
                            formData.append('tableName', "sizes");

                            $.ajax({
                                type: "POST",
                                url: "{{ url('switch_status_update') }}/",
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType: 'json',
                                encode: true,
                                success: function(data) {
                                    swal("Status Updated Successfully", "", "success");
                                },
                                error: function(errResponse) {
                                    // Handle error if needed
                                }
                            });
                        } else {
                            // Revert the checkbox state if the user cancels
                            $(this).prop('checked', !isChecked);
                            swal("Status Update Cancelled", "", "info");
                        }
                    });
                });
                // switch status end 
            }
        });
    }

    // delete 
    $(document).on('click', '.delete', function() {
        var id = $(this).data("id");
        $("#delete_id").val(id);
        $("#deletemodal").modal("show");
    });

    // delete here 
    $("#delete_form").submit(function(e) {
        $(".btn_delete").prop('disabled', true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "{{url('/delete_company_category')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            encode: true,
            success: function(data) {
                if (data.success == 'success') {
                    $(".btn_delete").prop('disabled', false);
                    $("#deletemodal").modal("hide");
                    $("#delete_form")[0].reset();
                    swal("Company Category Delete Successfully! ", "", "success");
                    view_enquiry_api(); // call this search and pagination 
                } else {
                    swal('Company Category Not Added', '', 'error');
                    $(".btn_delete").prop("disabled", false);
                }
            },
            error: function(error) {
                swal('Something Went Wrong!', '', 'error');
                $(".btn_delete").prop("disabled", false);
            }
        });
    });

    // edit category modal 
    $(document).on('click', '.edit', function() {
        var id = $(this).data('id');
        var company_name = $(this).data('company_name');
        var company_category = $(this).data('company_category');
        var company_bank = $(this).data('company_bank');

        $("#edit_id").val(id);
        $("#edit_company_name").val(company_name);
        $("#edit_company_category").val(company_category);
        $("#edit_company_bank").val(company_bank);
        $("#editmodal").modal("show");

    });

    // update category 
    $("#edit_form").submit(function(e) {
        $(".btn_update").prop("disabled", true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{url('/update_company_category')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            encode: true,
            success: function(data) {
                if (data.success == 'success') {
                    $(".btn_update").prop("disabled", false);
                    $("#edit_form")[0].reset();
                    $("#editmodal").modal("hide");
                    swal("Company Category Updated Successfull", "", "success");
                    view_enquiry_api(); // call this search and pagination 
                } else {
                    swal("Company Category Not Update!", "", "error");
                    $(".btn_update").prop('disabled', false);
                }
            },
            error: function(errResponse) {
                swal("Somthing Went Wrong!", "", "error");
                $(".btn_update").prop('disabled', false);
            }
        });
    });
// Excel Import End Here 
</script>



<script>
$(document).ready(function() {
    $('#AddExcelModal').on('click', function() {
        $('#AddExcel').modal('show');
    });

    $('#saveChangesBtn').on('click', function() {
        alert('Your changes have been saved!');
        $('#AddExcel').modal('hide');
    });

    $('#AddExcel').on('shown.bs.modal', function() {
        console.log('Modal is now fully visible!');
    });

    $('#AddExcel').on('hidden.bs.modal', function() {
        console.log('Modal has been closed.');
    });
});
</script>
@endsection
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif
