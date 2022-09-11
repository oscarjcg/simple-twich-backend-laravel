<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'channel_id' => 'required',
            'author' => 'required|max:255',
            'comment' => 'required|max:1000'
        ]);

        $comment = new Comment();

        $comment->channel_id = $request->channel_id;
        $comment->author = $request->author;
        $comment->comment = $request->comment;

        $comment->save();

        // Send event new message to dispacher
        $response = Http::post('http://st-node.oscarcatarigutierrez.com/new-message', [
            'channel_id' => $request->channel_id
        ]);

        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($channel_id)
    {
        $channel = Channel::find($channel_id);
        $comments = $channel->comments;

        return response()->json($comments);
    }

    public function showByName($channel_name)
    {
        $channel = Channel::where('name', $channel_name)->first();
        $comments = $channel->comments;

        return response()->json($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $channel_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel_id)
    {
        $channel = Channel::find($channel_id);
        $comments = $channel->comments;

        foreach ($comments as $comment) {
            $comment->delete();
        }

        return response()->json($comments);
    }
}
