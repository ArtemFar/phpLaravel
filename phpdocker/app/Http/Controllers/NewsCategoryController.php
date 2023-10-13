<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class NewsCategoryController extends Controller
{

    public function index(): View
    {
        return \view("categories.news-categories", ["title" => "Категории новостей", "categories" => Category::query()->paginate(6)]);
    }

    public function show(string $url_slug): View
    {
        $current_category = Category::getOneByField('url_slug', $url_slug);
        return \view("categories.news-categories-detail", ['payload' => $current_category, 'title' => $current_category->title]);
    }
}
