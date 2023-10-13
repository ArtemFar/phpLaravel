<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return \view('admin.users-list', ['h1' => 'Пользователи', 'users' => User::query()->paginate(25)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
//        dd($user);
        return \view('admin.edit-user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
       $request_data = $request->only('email', 'name', 'is_admin');
       $request_data['is_admin'] = isset($request_data['is_admin']) && $request_data['is_admin'] == 'on';
       $user->fill($request_data);
       if($user->save()){
           return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно изменен');
       }
        return back()->with('error', 'Не удалось отредактировать пользователя');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
