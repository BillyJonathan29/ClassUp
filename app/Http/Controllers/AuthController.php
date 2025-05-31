<?php

namespace App\Http\Controllers;

// use Illuminate\Http\RedirectResponse;

use App\Models\User;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use App\MyClass\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        Validations::register($request);
        DB::beginTransaction();
        try {
            $user = User::createUser($request->all());
            DB::commit();
            return Response::success([
                'message' => 'User berhasil di tambahkan',
                'data' => [
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => $request->password,
                    'role' => $request->role
                ],
                'code' => 200
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }


    public function login(Request $request)
    {
        Validations::login($request);
        DB::beginTransaction();
        try {
            $credentials = $request->only(['username', 'password']);
            if (Auth::attempt($credentials)) {
                $user = $request->user();
                $token = $user->createToken('Token Login')->plainTextToken;
                DB::commit();

                return Response::success([
                    'message' => 'Login berhasil',
                    'data' => [
                        'token' => $token
                    ]
                ]);
            } else {
                return Response::invalid([
                    'message' => 'username atau password salah',
                    'code' => 422
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }



    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return Response::success([
                'message' => 'Logout berhasil'
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}
