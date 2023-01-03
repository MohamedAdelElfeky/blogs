@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Post</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                @csrf
                                @method('PUT')
                                <label class="label">Post Title: </label>
                                <input type="text" name="title" class="form-control" value="{{ $post->title }}"
                                    required />

                            </div>
                            <div class="form-group">
                                <label class="label">Post content: </label>
                                <textarea name="content" rows="10" class="form-control" required> {{ $post->content }} </textarea>

                            </div>
                            <div class="form-group">
                                <img src="{{ asset('/public/images/' . $post->image) }}" style="width: 50%; height: 50%;"
                                    alt="image" title="image" />

                                <input type="file" class="form-control" name="image" required />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
