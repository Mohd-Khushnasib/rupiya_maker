@if(session()->get('admin_login'))
@extends('Admin.layouts.master')
@section('main-content')

<div class="container" id="main-container">
    <!-- Account Sidebar  Start Here-->
    @include('Admin.pages.account_setting')
    <!-- Account Sidebar End Here -->

    <div id="main-content">

        <div class="row">
            <div class="col-sm-12">
                <button id="AddDatacodeModal" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Datacode
                </button>
            </div>

            <div class="col-sm-12" style="margin-top: 20px;">
                <h5>All Datacode List</h5>
            </div>

            <div class="col-sm-12">
                <div class="table-responsive" style="border:0">
                    <table class="table table-advance" id="bank">
                        <thead>
                            <tr>
                                <th style="width:18px">#</th>
                                <th>Datacode Name</th>
                                <th>Datetime</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($datacodes->isEmpty())
                            @else
                            @php
                            $sr = 1;
                            @endphp
                            @foreach($datacodes as $item)
                            <tr class="table-flag-blue">
                                <td>{{ $sr }}</td>
                                <td>{{$item->datacode_name ?? ''}}</td>
                                <td>{{$item->date ?? ''}}</td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-danger delete small-btn"
                                        data-id="{{ $item->id }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>

                                    <a href="javascript:void(0);" class="btn btn-primary edit small-btn"
                                        data-datacode_name="{{$item->datacode_name}}" data-id="{{ $item->id }}">
                                        <i class="fa fa-pencil color-muted"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                            $sr++;
                            @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal  -->
<div id="AddDatacode" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: black;" id="modalTitle">Add Datacode</h4>
            </div>
            <div class="modal-body">
                <form id="add_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="datacode_name">Datacode Name</label>
                            <input type="text" name="datacode_name" id="datacode_name" placeholder="Datacode Name"
                                class="form-control">
                        </div>
                        <div class="col-sm-12 ">
                            <button class="btn btn-primary btn_submit" style="margin-top:15px"
                                type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Delete Start Here -->
<div id="deletemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: black;" id="exampleModalLabel">Delete Datacode</h4>
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
                <h4 class="modal-title" style="color: black;" id="editModalLabel">Edit Datacode Name</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="edit_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="edit_id" value="" class="form-control">
                        <div class="col-sm-12">
                            <label for="datacode_name">Datacode Name</label>
                            <input type="text" name="datacode_name" id="edit_datacode_name" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn_update" style="margin-top:15px; float:right;" type="submit">Update</button>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- JS Links End Here -->

<script>
// product_name add here
$("#add_form").submit(function(e) {
    var datacode_name = $("#datacode_name").val();
    if (datacode_name) {} else {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Datacode Name required');
        return;
    }
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/add_datacode')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                // Reset the form here
                document.getElementById("add_form").reset();
                $("#AddDatacode").modal("hide");
                swal("Datacode Name Added Successfully", "", "success");

                window.location.reload();
            } else {
                $(".btn_submit").prop("disabled", false);
                swal("Datacode Name Not Added", "", "error");
            }
        },
        error: function(err) {}
    });

});
// product_name end here

// delete
$(document).on('click', '.delete', function() {
    var id = $(this).data("id");
    $("#delete_id").val(id);
    $("#deletemodal").modal("show");
});

// delete here
$("#delete_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "{{url('/delete_datacode')}}",
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
                swal("Datacode Name Delete Successfully! ", "", "success");
                window.location.reload();
            } else {
                swal('Datacode Name Not Added', '', 'error');
                $(".btn_delete").prop("disabled", false);
            }
        },
        error: function(error) {
            swal('Something Went Wrong!', '', 'error');
            $(".btn_delete").prop("disabled", false);
        }
    });
});

// edit datacode modal
$(document).on('click', '.edit', function() {
    var id = $(this).data('id');
    var datacode_name = $(this).data('datacode_name');
    $("#edit_id").val(id);
    $("#edit_datacode_name").val(datacode_name);
    $("#editmodal").modal("show");
});

// update category
$("#edit_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/update_datacode')}}",
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
                swal("Datacode Name Updated Successfull", "", "success");
                window.location.reload();
            } else {
                swal("Datacode Name Not Update!", "", "error");
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
    var tableName = "tbl_datacode";
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
    $('#AddDatacodeModal').on('click', function() {
        $('#AddDatacode').modal('show');
    });

    $('#saveChangesBtn').on('click', function() {
        alert('Your changes have been saved!');
        $('#AddDatacode').modal('hide');
    });

    $('#AddDatacode').on('shown.bs.modal', function() {
        console.log('Modal is now fully visible!');
    });

    $('#AddDatacode').on('hidden.bs.modal', function() {
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