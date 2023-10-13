<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('categories.index', [
            'categories' => Category::all(),
        ]);
    }

    public function show(int $id): View
    {
        return view('categories.show', [
            'categories' => Category::find($id),
            'newsList' => News::where('category_id', $id)->get(),
        ]);
    }
}
