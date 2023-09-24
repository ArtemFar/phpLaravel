<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NewsController extends Controller
{
    //use NewsTrait;

    public function index()
    {
        $news = News::query()->paginate(6);

       // $news = DB::table('news')->get();
/*        $news = DB::table('news')
            ->join('categories', 'categories.id', 'news.category_id')
            ->select('news.*', 'categories.title as categoryTitle')
            ->toSql();*/


        return view('news.index')->with([
            'newsList' => $news
        ]);
    }

    public function show(News $news): view
    {
       // $news = DB::table('news')->find($id);

       // $news = News::find($id);

        return view('news.show')->with([
            'news' => $news
        ]);
    }
}
