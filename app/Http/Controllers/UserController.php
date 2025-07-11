<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            return User::dataTable($request);
        }

        return view('user.index', [
            'title' => 'User',
            'breadcrumbs' => [
                [
                    'title' => 'User',
                    'link' => route('user')
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        Validations::validateCreateUser($request);
        DB::beginTransaction();
        try {
            $user = User::createUser($request->all());
            $user->setPassword($request['password']);
            DB::commit();
            // dd($user);

            return Response::success([
                'message' => 'User berhasil di tambahkan',
                'data' => [
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => $request->password,
                    'role' => $request->role
                ]
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return Response::error($e);
        }
    }


    public function create()
    {
        return view('user.create', [
            'title' => 'Tambah User',
            'breadcrumbs' => [
                [
                    'title' => 'User',
                    'link' => route('user')
                ],
                [
                    'title' => 'Tambah User',
                    'link' => route('user.create')
                ]
            ]
        ]);
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'title' => 'Edit user',
            'user' => $user,
            'breadcrumbs' => [
                [
                    'title' => 'User',
                    'link' => route('user')
                ],
                [
                    'title' => 'Edit user',
                    'link' => route('user.create')
                ]
            ]
        ]);
    }

    public function update(Request $request, User $user)
    {
        Validations::validateUpdateUser($request, $user->id);
        DB::beginTransaction();
        try {
            $user->updateUser($request);
            DB::commit();

            return Response::update();
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            $user->deleteUser();
            DB::commit();
            return Response::delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
}
