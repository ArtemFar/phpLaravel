<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return  view('news.index', [
            'newsCategories' => Category::all(),
            'newsList' => News::all(),
        ]);
    }

    public function show(int $id, int $categoriesID): View
    {
        return view('news.show', [
            'news' => News::find($id),
            'categories' => Category::find($categoriesID),
        ]);
    }
}
