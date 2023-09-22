<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NewsTrait;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    use NewsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        return view('admin.news.index', [
            'newsList' => $this->getNews(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {

        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //  dd($request->all());
        //$_SESSION['title'] = $request->title;
        $request->flash();
        return redirect()->route('admin.news.create');

       // return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
