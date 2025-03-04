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
            <div class="col-sm-12">
                <button id="AddExcelModal" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Excel Upload
                </button>
            </div>

            <div class="col-sm-12" style="margin-top: 20px;">
                <h5>All Excel List</h5>
            </div>

            <div class="col-sm-12">
                <div class="table-responsive" style="border:0">
                    <table class="table table-advance" id="bank">
                        <thead>
                            <tr>
                                <th style="width:18px">#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                            <td>1</td>
                            <td>Sameer</td>
                            <td>8989898989</td>
                            <td>Action</td>
                           </tr>
                        </tbody>
                    </table>
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
                <h5 class="modal-title" id="modalTitle">Add Excel</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_data_import" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-3" style="margin-bottom:10px">
                        <label class="form-label"><b>Upload Excel File</b></label>
                        <input type="file" class="form-control" name="file_import"
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required />
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">📤 Upload</button>
                        <button type="button" class="btn btn-secondary" id="downloadSample">
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
                <h4 class="modal-title" style="color: black;" id="editModalLabel">Edit Bank Name</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="edit_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="edit_id" value="" class="form-control">
                        <div class="col-sm-12">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" name="bank_name" id="edit_bank_name" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="">Image</label>
                            <img src="" id="edit_image" height="80px" width="80px"><br><br>
                            <input type="file" name="image" id="edit_image" class="form-control mb-2">
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
        window.location.href = "/Admin/sample-file.csv"; // Adjusted path
    });
</script>
<!-- Sample CSV File Download Here -->

<script>
// Excel Import Satrt Here
$("#form_data_import").submit(function (e) 
{
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "{{url('/import_excel')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        success: function (data) {
            if (data.success === "success") {
                document.getElementById("form_data_import").reset();
                $("#AddExcel").modal("hide");
                swal("Excel Uploaded Successfully", "", "success");
                window.location.reload();
            } else {
                swal("Excel Not Uploaded", data.message, "error"); // Show error message from server
            }
        },
        error: function (err) {
            console.log("Error:", err);
            swal("Something went wrong!", err.responseText, "error");
        }
    });
});

// Excel Import End Here

// delete
$(document).on('click', '.delete', function() {
    var id = $(this).data("id");
    $("#delete_id").val(id);
    $("#deletemodal").modal("show");
});

// delete here
$("#delete_form").submit(function(e) 
{
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "{{url('/delete_bank')}}",
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
                swal("Bank Name Delete Successfully! ", "", "success");
                window.location.reload();
            } else {
                swal('Bank Name Not Added', '', 'error');
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
    var bank_name = $(this).data('bank_name');
    var image = $(this).data('image');
    $("#edit_id").val(id);
    $("#edit_bank_name").val(bank_name);
    $("#edit_image").attr('src', image);
    $("#editmodal").modal("show");
});

// update category
$("#edit_form").submit(function(e)
{
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/update_bank')}}",
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
                swal("Bank Name Updated Successfull", "", "success");
                window.location.reload();
            } else {
                swal("Bank Name Not Update!", "", "error");
                $(".btn_update").prop('disabled', false);
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
            $(".btn_update").prop('disabled', false);
        }
    });
});


// switch start here
$('.StatusSwitch').change(function() {
    var isChecked = $(this).is(':checked');
    var switchLabel = this.value;
    var checkedVal = isChecked ? 1 : 0;
    // Display SweetAlert confirmation dialog with both buttons
    var tableName = "tbl_bank";
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
            $.ajax({
                type: "POST",
                url: "{{ url('switch_status_update') }}/" + tableName,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                encode: true,
                success: function(data) {
                    swal("Status Updated Successfully", "", "success");
                    window.location.reload();
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
// switch end here
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
