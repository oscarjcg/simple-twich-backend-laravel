<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $channels = Channel::all();

        // Base url
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.
        $url.= $_SERVER['HTTP_HOST'];


        // Add url to images
        foreach ($channels as $channel) {
            $channel->image = $url . "/storage/channel/" . $channel->image;
            $channel->preview = $url . "/storage/channel/" . $channel->preview;
        }

        return response()->json($channels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required',
            'preview' => 'required',
        ]);

        $channel = new Channel();

        $pathImage = $request->file('image')->store('public/channel');
        $pathPreview = $request->file('preview')->store('public/channel');
        $channel->name = $request->name;
        // Take generated image name
        $channel->image = substr($pathImage, strrpos($pathImage, '/') + 1);
        $channel->preview = substr($pathPreview, strrpos($pathPreview, '/') + 1);
        $channel->save();

        return response()->json($channel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($channel)
    {
        $channel = Channel::where('id', $channel)->first();

        // Base url
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.
        $url.= $_SERVER['HTTP_HOST'];

        // Add url to images
        $channel->image = $url . "/storage/channel/" . $channel->image;
        $channel->preview = $url . "/storage/channel/" . $channel->preview;

        return response()->json($channel);
    }

    public function showByName($channel_name)
    {
        $channel = Channel::where('name', $channel_name)->first();

        // Base url
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.
        $url.= $_SERVER['HTTP_HOST'];

        // Add url to images
        $channel->image = $url . "/storage/channel/" . $channel->image;
        $channel->preview = $url . "/storage/channel/" . $channel->preview;

        return response()->json($channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($channel)
    {
        $channel = Channel::find($channel);
        $channel->delete();

        return response()->json($channel);
    }
}
