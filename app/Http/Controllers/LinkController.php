<?php

namespace App\Http\Controllers;

use App\Observer;
use Spatie\Crawler\Crawler;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use App\Http\Controllers\Controller;
use Spatie\Crawler\CrawlProfiles\CrawlInternalUrls;

class LinkController extends Controller
{
    public function get(){
        return view('home')->with('items', []);
    }

    public function store(Request $request){
        $url = $request->url;
        $items = Crawler::create()
        ->ignoreRobots()
        ->setCrawlObserver(new Observer)
        ->startCrawling($url)->get();


        return view('home')->with('items', $items);

    }
}
