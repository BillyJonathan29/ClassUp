<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyClass\Validations;
use App\Models\User;
use App\MyClass\Response;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function profile()
    {
        return view('setting.profile', [
            'title' => 'Ganti password',
            'breadcrumbs' => [
                [
                    'title' => 'Setting',
                    'link' => 'javascript:void(0);'
                ],
                [
                    'title' => 'Ganti password',
                    'link' => route('setting.change_password')
                ]
            ]
        ]);
    }

    public function savePassword(Request $request)
    {
        Validations::validateChangePassword($request, auth()->user()->id);
        DB::beginTransaction();
        try {
            auth()->user()->setPassword($request->new_password);
            DB::commit();
            return Response::success(
                [
                    'message' => 'Password behasil di ubah'
                ]
            );
        } catch (Exception $e) {
            DB::rollback();
            return Response::error($e);
        }
    }

    public function saveProfile() {}

    public function changePassword()
    {
        return view('setting.change_password', [
            'title' => 'Ganti password',
            'breadcrumbs' => [
                [
                    'title' => 'Setting',
                    'link' => 'javascript:void(0);'
                ],
                [
                    'title' => 'Ganti password',
                    'link' => route('setting.change_password')
                ]
            ]
        ]);
    }
}
