@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table id="channels-table" class="mb-0 table">
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
        @foreach($channels as $channel)
        <tr>
            <th scope="row">{{ $channel['id'] }}</th>
            <td>{{ $channel['name'] }}</td>
            <td>{{ $channel['image'] }}</td>
            <td>{{ $channel['created_at'] }}</td>
            <td>{{ $channel['updated_at'] }}</td>

        </tr>
        @endforeach

        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#channels-table').DataTable({
            "paging": true
        } );
    } );
</script>
@endsection
