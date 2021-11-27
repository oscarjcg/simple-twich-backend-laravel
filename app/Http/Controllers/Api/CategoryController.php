<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        // Add url to images
        foreach ($categories as $category)
            $category->image = Storage::disk('s3')->url('public/category/'. $category->image);

        return response()->json($categories);
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
            'image' => 'required'
        ]);

        $category = new Category();

        $path = $request->file('image')->store('public/category', 's3');
        Storage::disk('s3')->setVisibility($path,'public');

        $category->name = $request->name;
        // Take generated image name
        $category->image = substr($path, strrpos($path, '/') + 1);
        $category->save();

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByName($category_name)
    {
        $category = Category::where('name', $category_name)->first();

        // Add url to images
        $category->image = Storage::disk('s3')->url('public/category/'. $category->image);

        return response()->json($category);
    }

    public function show($id)
    {
        $category = Category::where('id', $id)->first();

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => ''
        ]);

        $category = Category::find($category);
        $category->name = $request->name;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('public/category', 's3');
            Storage::disk('s3')->setVisibility($path,'public');
            // Take generated image name
            $category->image = substr($path, strrpos($path, '/') + 1);
        }

        $category->save();

        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json($category);
    }

    public function channelsByName($name) {
        $category = Category::where('name', $name)->first();

        $channels = $category->channels()->get();

        // Add url to images
        foreach ($channels as $channel) {
            $channel->image = Storage::disk('s3')->url('public/channel/'. $channel->image);
            $channel->preview = Storage::disk('s3')->url('public/channel/'. $channel->preview);
        }

        return response()->json($channels);
    }
}
