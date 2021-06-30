@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table id="comments-table" class="mb-0 table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Channel</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Created</th>
            <th>Updated</th>

        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
        <tr>
            <th scope="row">{{ $comment['id'] }}</th>
            <td>{{ $comment['channel_id'] }}</td>
            <td>{{ $comment['author'] }}</td>
            <td>{{ $comment['comment'] }}</td>
            <td>{{ $comment['created_at'] }}</td>
            <td>{{ $comment['updated_at'] }}</td>

        </tr>
        @endforeach

        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#comments-table').DataTable({
            "paging": true
        } );
    } );
</script>
@endsection
