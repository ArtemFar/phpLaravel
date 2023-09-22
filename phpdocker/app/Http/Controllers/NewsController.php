<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    //use NewsTrait;

    public function index()
    {
        $news = DB::table('news')->get();
/*        $news = DB::table('news')
            ->join('categories', 'categories.id', 'news.category_id')
            ->select('news.*', 'categories.title as categoryTitle')
            ->toSql();*/


        return view('news.index')->with([
            'newsList' => $news
        ]);
    }

    public function show(int $id)
    {
        $news = DB::table('news')->find($id);

        return view('news.show')->with([
            'news' => $news
        ]);
    }
}
