<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(News $news)
    {
        return view('news.index')->with('news', $news->getNews());
    }
    
    public function show($id, News $news)
    {
        return view('news.one')->with('news', $news->getNewsId($id));
    }
    
}
