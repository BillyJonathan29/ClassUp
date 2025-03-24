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


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'role' => 'required|in:Admin,User',
        ], [
            'name.required' => 'Nama wajib di isi',
            'email.required' => 'Nama wajib di isi',
            'password.required' => 'Nama wajib di isi',
            'role.required' => 'Nama wajib di isi'
        ]);
        
    }
}
