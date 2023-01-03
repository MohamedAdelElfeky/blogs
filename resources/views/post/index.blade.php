@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Manage Posts</h1>
                <a href="{{ route('posts.create') }}" class="btn btn-success" style="float: right; margin-bottom: 10px">Create
                    Post</a>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table class="table table-bordered text-center">
                    <thead>
                        <th width="80px">Id</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th width="220px">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->content }}</td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                    <a data-toggle="modal" data-target="#delete_record{{ $post->id }}" href="#"
                                        class="btn btn-danger">Delete</a>
                                    <div class="modal fade" id="delete_record{{ $post->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete</h4>
                                                    <button class="close" data-dismiss="modal">x</button>
                                                </div>
                                                <div class="modal-body">
                                                    are you sure about that </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary btn-flat">Ok</button>
                                                        <button class="btn btn-warning btn-flat"
                                                            data-dismiss="modal">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
