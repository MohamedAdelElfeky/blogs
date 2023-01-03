<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Posts extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->except("_token", "_method", "image");
        if ($request->hasFile('image')) {
            $input['image'] = save_image($request->file('image'), 'public/images');
        }
        $input['date'] = date('Y-m-d H:i', strtotime(Carbon::now()));
        $input['user_id'] = auth()->user()->id;
        Post::create($input);
        return redirect()->route('posts.index')->with('success', 'Post Cerated successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if (is_null($post) || empty($post)) {
            return redirect()->back()->with('error', 'Post Not Found');
        }
        return view('post.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        // Check Record Exists
        $post =  Post::find($id);
        if (is_null($post) || empty($post)) {
            return redirect()->back();
        }
        $input = $request->except("_token", "_method", "image");
        if ($request->hasFile('image')) {
            $input['image'] = save_image($request->file('image'), 'public/images');
        }
        $input['user_id'] = auth()->user()->id;
        Post::where('id', $id)->update($input);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (is_null($post) || empty($post)) {
            return redirect()->back();
        }
        $comments = Comment::where('post_id', $id)->get();
        foreach ($comments as $comment) {
            Comment::find($comment->id)->delete();
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post Deleted successfully');
    }
}
