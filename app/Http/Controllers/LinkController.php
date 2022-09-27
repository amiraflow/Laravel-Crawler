<?php

namespace App\Http\Controllers;

use App\Observer;
use Spatie\Crawler\Crawler;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use App\Http\Controllers\Controller;
use App\Models\Crawler as CrawlerModel;
use Spatie\Crawler\CrawlProfiles\CrawlInternalUrls;
use Illuminate\Support\Str;


class LinkController extends Controller
{
    public function get(){
        return view('home')->with(['internalItems' => null, 'externalItems' => null ]);
    }

    public function store(Request $request){
        $url = $request->url;
        $items = CrawlerModel::where('source', $url)->orderBy('url')->get();
        if(!is_null($items)){
            Crawler::create()
            ->ignoreRobots()
            ->setCrawlObserver(new Observer)
            ->startCrawling($url);
            $items = CrawlerModel::where('source', $url)->orderBy('url')->get();
        }

        $cleanUrl = preg_replace('/\s+/','', $url);
        $cleanUrl = str_replace('https://','', $cleanUrl); 
        $cleanUrl = str_replace('http://','', $cleanUrl); 
        $cleanUrl = str_replace('www.','', $cleanUrl); 

        $internalItems = $items->filter(function ($value, $key) use ($cleanUrl) {
            return Str::contains($value->url, $cleanUrl);
        })->all();

        $externalItems = $items->filter(function ($value, $key) use ($cleanUrl) {
            return !Str::contains($value->url, $cleanUrl);
        })->all();

        return view('home')->with(['url' => $url, 'internalItems' => $internalItems, 'externalItems' => $externalItems ]);

    }
}
