@if(session('admin_login'))
@foreach(session()->get('admin_login') as $adminlogin)
@extends('Admin.layouts.master')
@section('main-content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">
                                <svg class="stroke-icon">
                                    <use href="{{asset('Admin/assets/svg/icon-sprite.svg#stroke-home')}}">
                                    </use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Admin</li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xxl-9 box-col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#AddSliderModal">
                                        Add Slider
                                    </button>
                                </h4>
                            </div>

                            <!-- Table start  -->
                            <div class="card-body">
                                <div class="table-responsive custom-scrollbar">
                                    <table class="display" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                                <th>Datetime</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($sliders->isEmpty())
                                            @else
                                            @php
                                            $sr = 1;
                                            @endphp
                                            @foreach($sliders as $item)
                                            <tr>
                                                <td>{{ $sr }}</td>
                                                <td>
                                                    @if($item->status == 1)
                                                    <label class='custom-switch'>
                                                        <input type='checkbox' name='custom-switch-checkbox'
                                                            class='custom-switch-input StatusSwitch'
                                                            value="{{$item->id}}" checked>
                                                        <span class='custom-switch-indicator'></span>
                                                    </label>
                                                    @else
                                                    <label class='custom-switch'>
                                                        <input type='checkbox' name='custom-switch-checkbox'
                                                            class='custom-switch-input StatusSwitch'
                                                            value="{{$item->id}}">
                                                        <span class='custom-switch-indicator'></span>
                                                    </label>
                                                    @endif
                                                </td>
                                                <td><img src="{{$item->image}}" style="height:80px;width:80px" /></td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-primary edit small-btn"
                                                        data-image="{{$item->image}}" data-id="{{ $item->id }}">
                                                        <i class="fa fa-pencil color-muted"></i>
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-danger delete small-btn"
                                                        data-id="{{ $item->id }}">
                                                        <i class="fa fa-close color-danger"></i>
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
                            <!-- Table end -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>



<!-- Add Modal Here -->

<!-- Modal -->
<div class="modal fade" id="AddSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Slider</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Slider Image</label>
                        <input type="file" name="image" class="form-control" data-height="100" id="image">
                    </div>
                    <button type="submit" class="float-right btn btn-primary btn_submit mt-4 mb-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Modal Here  -->

<!-- Delete Modal -->
<!-- <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Upi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="delete_form" action="javascript:void(0);" method="post">
                    @csrf
                    <input type="hidden" name="id" id="delete_id" value="" class="form-control"><br>
                    <button class="float-right btn btn-primary btn_delete">Delete</button>
                </form>
            </div>

        </div>
    </div>
</div> -->


<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p>Are you sure you want to delete this ? This action cannot be undone.</p>
                <form id="delete_form" action="javascript:void(0);" method="post">
                    @csrf
                    <input type="hidden" name="id" id="delete_id" value="" class="form-control">
                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn_delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="edit_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="id" id="edit_id" value="" class="form-control">

                    <div class="form-group">
                        <label for="">Slider Image</label>
                        <img src="" id="edit_image" height="80px" width="80px"><br><br>
                        <input type="file" name="image" id="edit_image" class="form-control mb-2">
                    </div>
                    <button type="submit" class="btn btn-primary float-end btn_update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->


<!-- JS Links Start Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
// category add here
$("#add_form").submit(function(e) {
    var image = $("#image").val();
    if (image) {} else {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Slider required');
        return;
    }
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/add_slider')}}",
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
                $("#AddSliderModal").modal("hide");
                swal("Slider Added Successfully", "", "success");

                window.location.reload();
            } else {
                $(".btn_submit").prop("disabled", false);
                swal("Slider Not Added", "", "error");
            }
        },
        error: function(err) {

        }
    });

});
// category end here


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
        url: "{{url('/delete_slider')}}",
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
                swal("Slider Delete Successfully! ", "", "success");
                // show data function call here
                window.location.reload();

            } else {
                swal('Slider Not Added', '', 'error');
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
    var image = $(this).data('image');
    $("#edit_id").val(id);
    $("#edit_image").attr('src', image);
    $("#editmodal").modal("show");
});

// update category
$("#edit_form").submit(function(e) {

    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/update_slider')}}",
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
                swal("Slider Updated Successfull", "", "success");
                // show data function call here
                window.location.reload();
            } else {
                swal("Slider Not Update!", "", "error");
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
    var tableName = "sliders";
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
@endsection
@endforeach
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif