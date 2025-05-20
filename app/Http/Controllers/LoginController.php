<?php

namespace App\Http\Controllers;

use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        Validations::login($request);
        DB::beginTransaction();
        try {
            $credentials = $request->only(['username', 'password']);
            if (Auth::attempt($credentials)) {
                $user = $request->user();
                // $tokenResult = $user->createToken('Token login');
                // $token  = $tokenResult->plainToken;
                DB::commit();
                return Response::success([
                    'message' => 'Login berhasil',
                    // 'data' => [
                    //     'token' => $token
                    // ]
                ]);
            } else {
                return Response::invalid([
                    'message' => 'Username atau password salah',
                    // 'code' => 422
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Logout berhasil');
    }
}
