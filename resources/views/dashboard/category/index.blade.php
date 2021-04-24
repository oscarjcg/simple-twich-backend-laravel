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
        } );
    </script>
@endsection
