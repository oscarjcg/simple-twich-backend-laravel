<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Channel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($name) {
        $categories = Category::where('name', 'LIKE', "%{$name}%")->get();
        $channels = Channel::where('name', 'LIKE', "%{$name}%")->get();

        // Base url
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.
        $url.= $_SERVER['HTTP_HOST'];

        // Add url to images. Add type
        foreach ($categories as $category) {
            $category->image = $url . "/storage/category/" . $category->image;
            $category->type = "category";
        }

        // Add url to images. Add type
        foreach ($channels as $channel) {
            $channel->image = $url . "/storage/channel/" . $channel->image;
            $channel->preview = $url . "/storage/channel/" . $channel->preview;
            $channel->type = "channel";
        }

        $result = array_merge($channels->toArray(), $categories->toArray());

        return response()->json($result);
    }
}
