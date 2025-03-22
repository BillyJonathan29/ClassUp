<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users =  User::all();

        return view('user.user', [
            'users' => $users,
            'title' => 'User',
            'breadcrumbs' => [[
                'title' => 'User',
                'link' => route('user')
            ]]

        ]);
    }


    public function create()
    {
        return view('user.create');
    }
}
