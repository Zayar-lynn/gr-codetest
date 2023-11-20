@extends('admin.appcomponent.app')
@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('list')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Menu List</h1>
        </div>

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('menu.create') }}" class="btn btn-primary">Add Menu</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Sub Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Sub Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <img src="http://127.0.0.1:8000/images/{{ $menu['photo'] }}" alt=""
                                                class="img-fluid" style="width: 100px">
                                        </td>
                                        <td>{{ $menu['name'] }}</td>
                                        <td>{{ $menu['sub_name'] }}</td>
                                        <td>{{ $menu['category'] }}</td>
                                        <td>{{ $menu['desc'] }}</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/menu/{{ $menu['id'] }}/edit"
                                                class="btn btn-sm btn-outline-info">Edit</a>
                                            <button id="menu_del" class="btn btn-outline-danger btn-sm"
                                                onclick="menu_del({{ $menu['id'] }})">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const menu_del = (id) => {
            $.ajax({
                url: `http://127.0.0.1:8000/menu/${id}`,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == 'success') {
                        alert('Success.');
                        window.location.href = "http://127.0.0.1:8000/menu";
                    }
                },
                error: function(xhr, textStatus, error) {
                    alert('Your form was not sent successfully.');
                    console.error(error);
                }
            });
        };
    </script>
@endsection
