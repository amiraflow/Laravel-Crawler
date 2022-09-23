<?php

namespace App\Http\Controllers;

use App\Observer;
use Spatie\Crawler\Crawler;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use App\Http\Controllers\Controller;
use App\Models\Crawler as CrawlerModel;
use Spatie\Crawler\CrawlProfiles\CrawlInternalUrls;


class LinkController extends Controller
{
    public function get(){
        return view('home')->with('items', []);
    }

    public function store(Request $request){
        $url = $request->url;
        Crawler::create()
        ->ignoreRobots()
        ->setCrawlObserver(new Observer)
        ->startCrawling($url);
        $items = CrawlerModel::where('source', $url)->get();
        //dd($url, $items);


        return view('home')->with('items', $items);

    }
}
