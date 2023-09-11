<?php

declare(strict_types=1);

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category) {
        return view('news.categories')
            ->with('categories', $category->getCategories());
    }

    public function show(News $news, Category $category, $slug) {
        return view('news.category')
            ->with('news', $news->getNewsByCategorySlug($slug))
            ->with('category', $category->getCategoryNameBySlug($slug));
    }
}
