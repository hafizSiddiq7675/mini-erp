@extends('users.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" <blade
        ___scripts_1___ />
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

</head>

<body>
    @section('content')
        <!--alert -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-server" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p>{{ $message }}</p>
            </div>
        @endif
        <header>
            <!--- NavBar-->




        </header>
        <!--end of header-->

        <div style="padding-left:2px;padding-top:20px">
            <h2>Add New User</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id ?? '' }}" />

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="first_name" value="{{ $user->first_name ?? '' }}" class="form-control"
                        placeholder="First Name">
                    </div>
                </div><br><br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="last_name" value="{{ $user->last_name ?? '' }}" class="form-control"
                        placeholder="Last Name">
                    </div>
                </div><br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $user->email ?? '' }}" class="form-control"
                        placeholder="Email">
                    </div>
                </div><br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>User Image:</strong>
                    <input type="file" name="image"  class="form-control" placeholder="user Image">
                </div>
            </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Username:</strong>
                    <input type="text" name="username" value="{{ $user->username ?? '' }}" class="form-control"
                        placeholder="UserName">
                    </div>
                </div><br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" name="password" value="{{ $user->password ?? '' }}" class="form-control"
                        placeholder="Password">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                    <button type="submit" class="btn btn-primary" style="margin:35px">Submit</button>
                </div>
            </div>

        </form>
        <table id="table" class="table table-bordered">
            <thead class="bg-info text-white">
                <tr>
                    <th>No</th>
                    <th width="120px">First Name</th>
                    <th width="120px">Last Name.</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>

    </body>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'password',
                        name: 'password'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('body').on('click', '.deleteUser', function() {
                var user_id = $(this).data("id");
                var result = confirm("Are You sure want to delete !");
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('users.store') }}" + '/' + user_id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    </script>

    </html>
@endsection
