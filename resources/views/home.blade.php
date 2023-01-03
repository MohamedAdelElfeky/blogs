@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-header">
                        <a href="{{ route('posts.index') }}" class="btn btn-success" style="float: right">Posts</a>
                        <a href="{{ route('posts.create') }}" class="btn btn-success" style="float: left">Create Post</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($posts as $post)
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-center text-success"></h3>
                                            <br />
                                            <h2>{{ $post->title }}</h2>
                                            <p>
                                                {{ $post->content }}
                                            </p>
                                            <img src="{{ asset('public/images/' . $post->image) }}"
                                                style="width: 50%; height: 50%;" alt="image" title="image">
                                            <hr />
                                            <h4>Comments</h4>
                                            {{-- @include('post.comments') --}}
                                            @include('post.comments', [
                                                'comments' => $post->comments,
                                                'post_id' => $post->id,
                                            ])
                                            <hr />
                                            <h4>Add comment</h4>
                                            <form method="post" action="{{ route('comments.store') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea class="form-control" name="comment"></textarea>
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-success" value="Add Comment" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
