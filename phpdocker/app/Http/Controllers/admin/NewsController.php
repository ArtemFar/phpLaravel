<?php

namespace App\Http\Controllers\Admin;

use App\Enums\News\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NewsTrait;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Http\Requests\Admin\News\EditRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;

class NewsController extends Controller
{
    use NewsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {

        //AR CRUD что это такое примеры

        //read
        //$news = new News()->find(1); $news->id()

        //update
        //$news->title = "Новый заголовок"
        //$news->save();

        //delete
        //$news->delete()

        //create
        //$news = new News(['title'=>'trext'])
        //$news->save()


        return view('admin.news.index', [
            // 'newsList' => DB::table('news')->orderByDesc('id')->get(),
            'newsList' => News::query()
                ->status() //with f=active
                ->with('category')
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        $categories = Category::all();

        return view('admin.news.create')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {

        $data = $request->only(['category_id', 'title', 'author', 'status', 'description', 'image']);

        $name = null;
        if ($request->file('image')) {
            $path = Storage::putFile('public/images/news', $request->file('image'));
            $name = Storage::url($path);
        }
        $data['image'] = $name;

        $news = new News($data);


        if ($news->save()) {
            return redirect()->route('admin.news.index')->with('success', 'Запись успешно сохранена');
        }

        return back()->with('error', 'Не удалось добавить запись');

        //  dd($request->all());
        //$_SESSION['title'] = $request->title;
        //$request->flash();


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
    public function edit(News $news): view
    {
        $categories = Category::all();
        return view('admin.news.edit', [
            'categories' => $categories,
            'news' => $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, News $news)
    {
        //$request->flash();
        //return redirect()->route('admin.news.edit', ['news' => $news]);


        $data = $request->only(['category_id', 'title', 'author', 'status', 'description', 'image']);

        if ($request->file('image')) {
            $request->validate([
                'image' => ['sometimes', 'image', 'mimes:jpeg,bmp,png|max:1500']
            ]);
            $path = Storage::putFile('public/images/news', $request->file('image'));
            $name = Storage::url($path);
            $data['image'] = $name;
            //TODO удалить файл со старым изображением
        }

        $news->fill($data);

        if ($news->save()) {
            return redirect()->route('admin.news.index')->with('success', 'Запись успешно изменена');
        }

        return back()->with('error', 'Не удалось обновить запись');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        {
            try {
                $news->delete();

                return response()->json('ok');

            } catch (\Exception $e) {
                Log::error($e->getMessage(), $e->getTrace());
                return response()->json('error', 400);
            }
        }
    }
}
