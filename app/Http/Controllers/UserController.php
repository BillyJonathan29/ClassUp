<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // $users =  User::all();

        // return view('user.user', [
        //     'users' => $users,
        //     'title' => 'User',
        //     'breadcrumbs' => [[
        //         'title' => 'User',
        //         'link' => route('user')
        //     ]]

        // ]);

        $users = User::all();

        return response()->json([
            'message' => 'List User',
            'users' => $users
        ]);
    }


    public function create()
    {
        return view('user.create');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User tidak di temukan'
            ], 404);
        }

        $validated =  $request->validate([
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

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'User berhasil diupdate',
            'data' => $user
        ]);
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

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return response()->json([
            'message' => 'User berhasil ditambahkan',
            'data' => $user
        ], 201);
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }
}
