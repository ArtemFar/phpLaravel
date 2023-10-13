<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resources\Create;
use App\Http\Requests\Admin\Resources\Edit;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.resources.index', [
            'resources' => Resource::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view( 'admin.resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Create $request)
    {
        $resource = new Resource($request->validated());

        if($resource->save()) {
            return redirect()->route('admin.resources.index')->with('success', __('The record was saved successfully'));
        }

        return back()->with('error', __('We can not save item, pleas try again'));
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
    public function edit(Resource $resource)
    {
        return view( 'admin.resources.edit', [
            'resource' => $resource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Edit $request, Resource $resource)
    {
        $resource->fill($request->validated());

        if($resource->save()) {
            return redirect()->route('admin.resources.index')->with('success', __('The record was saved successfully'));
        }

        return back()->with('error', __('The record was saved successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        if ($resource->delete()) {
            return redirect()->route('admin.resources.index')->with('success', __('The record was deleted successfully'));
        }

        return back()->with('error', 'Record not found');
    }
}
