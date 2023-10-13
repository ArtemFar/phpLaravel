<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\Create;
use App\Http\Requests\Admin\News\Edit;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use App\Services\Contracts\Upload;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.news.index', [
            'newsList' => News::query()->status()->with('category')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $sources = Source::all();

        return view( 'admin.news.create', [
            'categories' => $categories,
            'sources' => $sources,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Create $request)
    {
        $validatedData = $request->validated();

        if (!$request->hasFile('image')) {
            $validatedData['image'] = 'news/default.jpg';
        }
    
        $news = new News($validatedData);

        if($news->save()) {
            return redirect()->route('admin.news.index')->with('success', __('News was saved successfully'));
        }

        return back()->with('error', __('We can not save item, pleas try again'));
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        $sources = Source::all();

        return view( 'admin.news.edit', [
            'categories' => $categories,
            'sources' => $sources,
            'news' => $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Edit $request, News $news, Upload $upload)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $upload->create($request->file('image'));
        }

        $news = $news->fill($validated);

        if($news->save()) {
            return redirect()->route('admin.news.index')->with('success', __('News was saved successfully'));
        }

        return back()->with('error', __('We can not save item, pleas try again'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->delete()) {
            return redirect()->route('admin.news.index')->with('success', 'The record was deleted successfully');
        }

        return back()->with('error', 'Record not found');
    }
}
