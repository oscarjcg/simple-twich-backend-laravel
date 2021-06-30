@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table id="categories-table" class="mb-0 table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Created</th>
                <th>Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category['id'] }}</th>
                    <td>{{ $category['name'] }}</td>
                    <td>{{ $category['image'] }}</td>
                    <td>{{ $category['created_at'] }}</td>
                    <td>{{ $category['updated_at'] }}</td>
                    <td>
                        <button class="btn btn-info btn-edit" onclick="edit({{ $category->id }})">Edit</button>
                        <button class="btn btn-danger btn-delete">Delete</button>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#categories-table').DataTable({
                "paging": true
            } );
        });


        function edit(id) {
            window.location.href = window.location.origin + "/categories/" + id + "/edit";
        }

        $(".delete").click(function () {
            alert("Delete");
            
            $.ajax({
                type: "POST",
                url: window.location.origin + "/api/categories/{{ $category->id }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function( msg ) {
                    console.log( msg );

                    // Success alert
                    $('#status').append(`
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> Category updated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);

                    var json = JSON.parse(xhr.responseText)
                    // Error alert
                    $('#status').append(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> ` + json.message + `
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`);
                }
            });
        });
    </script>
@endsection
