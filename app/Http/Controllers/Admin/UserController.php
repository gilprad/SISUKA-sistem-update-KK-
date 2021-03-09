<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UsersDataTable;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $usersDataTable)
    {
        return $usersDataTable->render('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.user.detail', compact('user', 'roles'));
    }

}
