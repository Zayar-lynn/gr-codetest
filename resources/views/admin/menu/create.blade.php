@extends('admin.appcomponent.app')
@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('create')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Menu Create</h1>
        </div>

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="col-xl-6 offset-3 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form id="submit" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input id="photo" type="file" name="photo" value="" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value=""
                                    required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="sub_name" class="form-label">Sub Name</label>
                                <input id="sub_name" type="text" class="form-control" name="sub_name" value=""
                                    required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="Appetizer">Appetizer</option>
                                    <option value="Soups">Soups</option>
                                    <option value="Entree">Entree</option>
                                    <option value="Curry">Curry</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="desc" id="desc" cols="10" rows="5" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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
        $(document).ready(function() {
            $("#submit").on("submit", function(event) {
                event.preventDefault();
                var form = document.getElementById('submit');
                var formData = new FormData(form);
                $.ajax({
                    url: "http://127.0.0.1:8000/menu",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 'success') {
                            console.log(response.data);
                            alert('Success.');
                            window.location.href = "http://127.0.0.1:8000/menu";
                        }
                    },
                    error: function(xhr, textStatus, error) {
                        alert('Your form was not sent successfully.');
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
