@extends('layout')


@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
                @else
                <div class="alert alert-success">
                    You are logged in!
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<br><br><br>

<div class="container">
    <table class="table table-bordered data-table">
        <button type="button float-right" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">ADD</button>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>address</th>
                <th>number</th>
                <th>Gender</th>
                <th>Hobby</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="crud" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="crud_id" id="crud_id" value="">
                    <!-- <input type="hidden" name="profile_pic_preview" id="profile_pic_preview"> -->
                    <div class="col-lg-12">
                        <label for="inputtitle1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        <span class="text-danger" id="name_error"></span>
                    </div>
                    <div class="col-lg-12">
                        <label for="inputtitle1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        <span class="text-danger" id="name_error"></span>
                    </div>
                    <div class="col-lg-12">
                        <label for="inputtitle1" class="form-label">Number</label>
                        <input type="number" class="form-control" id="number" name="number" placeholder="Enter Number">
                        <span class="text-danger" id="name_error"></span>
                    </div>
                    <div class="col-lg-12">
                        <label for="inputtitle1" class="form-label">Profile Pic</label>
                        <input type="file" class="form-control" id="profile_pic" name="profile_pic" placeholder="Enter Name">

                        <div class="profile-show">
                            <img src="" id="profile_pic_preview" alt="Profile Picture Preview" style="max-width: 200px; display: none;">
                        </div>

                        <span class="text-danger" id="name_error"></span>
                    </div>
                    <div class="col-lg-12">
                        <label for="message-text" class="col-form-label">Address:</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                    <div class="col-lg-12">
                        <label for="inputtitle1" class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
                            <label class="form-check-label">
                                Female
                            </label>
                        </div>
                        <span class="text-danger" id="name_error"></span>
                    </div>
                    <div class="col-lg-12">
                        <label for="message-text" class="col-form-label">Hobby</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="playing" id="hobby[]" name="hobby[]">
                            <label class="form-check-label" for="hobby">
                                Playing
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="reading" id="hobby[]" name="hobby[]">
                            <label class="form-check-label" for="hobby">
                                Reading
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="painting" id="hobby[]" name="hobby[]">
                            <label class="form-check-label" for="hobby">
                                Painting
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="cooking" id="hobby[]" name="hobby[]">
                            <label class="form-check-label" for="hobby">
                                Cooking
                            </label>
                        </div>
                        <span class="text-danger" id="name_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




@endsection

@section('script')
<script type="text/javascript">
    $(document).on('click', '.add-group-master', function() {
        $('#crud_id').val('');
        $("#crud")[0].reset();
        $('span[id$="_error"]').text('');
        $('.edit-form').hide();
    });

    var token = "{{ csrf_token() }}";
    var dataTable = $('.table').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        autoWidth: false,
        pageLength: 10,
        language: {
            search: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M17.5 17.5L13.875 13.875M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z" stroke="#5E5873" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            searchPlaceholder: "Search",
            oPaginate: {
                sNext: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                sPrevious: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            },
        },
        ajax: {
            url: "{{ route('index') }}",
            data: function(d) {

                d._token = token;
            },
            type: 'POST',
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'address',
                name: 'address'
            },
            {
                data: 'number',
                name: 'number'
            },
            {
                data: 'gender',
                name: 'gender'
            },
            {
                data: 'hobby',
                name: 'hobby'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
        drawCallback: function() {},
        initComplete: function(response) {}
    });


    $('#crud').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var csrftoken = $('meta[name="csrf-token"]').attr('content');
        $(".text-danger").text('');

        $.ajax({
            type: 'POST',
            url: "{{ url('insert') }}",
            headers: {
                'X-CSRF-Token': csrftoken,
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if (data.status == 200) {
                    $('#exampleModal').modal('hide');
                    if ($('#crud_id').val() == '') {
                        toastr.success("Group master added successfully.");
                        dataTable.draw();
                        // window.location.href = "{{ route('dashboard') }}";
                    } else {
                        toastr.success("Group master updated successfully.");
                        dataTable.draw();
                        // window.location.href = "{{ route('dashboard') }}";
                    }
                    // dataTable.draw();

                    // Reload the page after form submission
                    // window.location.reload(true);
                } else {
                    toastr.error(data.msg);
                }
            },
            error: function(response) {
                if (response.status === 422) {
                    var errors = $.parseJSON(response.responseText);
                    $.each(errors['errors'], function(key, val) {
                        console.log(key);
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            }
        });
    });

    function editGroupMaster(id) {
        $('span[id$="_error"]').text('');
        $.ajax({
            type: 'GET',
            url: "{{ url('get_crud') }}/" + id,
            headers: {
                'X-CSRF-Token': token,
            },
            dataType: "json",
            success: (data) => {
                $('.modal-title').text('Edit Data');
                $("#crud")[0].reset();
                // set edit value
                $('#crud_id').val(data.data.id);
                // console.log("crud_id", $('#crud_id').val());

                $('#name').val(data.data.name);
                $('#email').val(data.data.email);
                $('#number').val(data.data.number);
                $('#address').val(data.data.address);
                if (data.data.gender === 'male') {
                    $('#gender').prop('checked', true);
                } else if (data.data.gender === 'female') {
                    $('#gender').prop('checked', true);
                }

                var hobbies = data.data.hobby.split(',');

                hobbies.forEach(function(hobby) {
                    $('input[name="hobby[]"][value="' + hobby + '"]').prop('checked', true);
                });

                if (data.data.profile_pic) {
                    var profilePicUrl = "{{ asset('uploads') }}/" + data.data.profile_pic;
                    $('#profile_pic_preview').attr('src', profilePicUrl);
                    $('#profile_pic_preview').show();
                } else {
                    $('#profile_pic_preview').hide();
                }

                // Show edit modal
                $('#exampleModal').modal('show');
            },
            error: function(response) {
                toastr.error(response.msg);
            }
        });
    }

    function daletetabledata(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to be delete this data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, I am sure!",
            cancelButtonText: "No, cancel it!",
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with deletion
                var _data = {
                    id: id
                };
                $.ajax({
                    type: 'POST',
                    url: "{{ route('delete') }}",
                    headers: {
                        'X-CSRF-Token': token,
                    },
                    data: _data,
                    dataType: "json",
                    success: (data) => {
                        dataTable.draw();
                    },
                    error: function(response) {}
                });
            } else {
                // Cancelled
                Swal.fire("Cancelled", "Your data is safe :)", "error");
            }
        });
    }
</script>
@endsection