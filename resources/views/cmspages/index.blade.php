@extends('cmspages.layout')
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
            <h2>Add New Page</h2>
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

        <form action="{{ route('cmspages.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $page->id ?? '' }}" />

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" value="{{ $page->title ?? '' }}" class="form-control"
                            placeholder="Title">
                    </div>
                </div><br><br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Slug:</strong>
                        <input type="text" name="slug" value="{{ $page->slug ?? '' }}" class="form-control"
                            placeholder="Slug">
                    </div>
                </div><br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Content:</strong>
                        <input type="text" name="content" value="{{ $page->content ?? '' }}" class="form-control"
                            placeholder="Content">
                    </div>
                </div><br>

                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                    <button type="submit" class="btn btn-primary" style="margin:35px">Submit</button>
                </div>
            </div>

        </form>
        <table id="table" class="table table-bordered">
            <thead class="bg-info text-white">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Content</th>
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
                ajax: "{{ route('cmspages.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('body').on('click', '.deletePage', function() {
                var page_id = $(this).data("id");
                var result = confirm("Are You sure want to delete !");
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('cmspages.store') }}" + '/' + page_id,
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
