<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Carbon\Carbon;

class Comments extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $input = $request->except("_token", "_method");
        $input['date'] = date('Y-m-d H:i', strtotime(Carbon::now()));
        $input['user_id'] = auth()->user()->id;
        Comment::create($input);
        return back()->with('success','Comment Cerated successfully');
    }
}
