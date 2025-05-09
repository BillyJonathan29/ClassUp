<?php

namespace App\MyClass;

class Validations
{


    public static function login($request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
    }

    public static function register($request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|max:12',
            'role' => 'required|in:Admin,User',
        ], [
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Role tidak valid',
        ]);
    }

    public static function validateCreateUser($request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            // 'confirm_password' => 'required|same:password',
            'role' => 'required|in:Admin,User',
        ], [
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Role tidak valid',
        ]);
    }

    public static function validateUpdateUser($request, $userId)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users,email,' . $userId,
            'password' => 'nullable',
            'role' => 'required|in:Admin,User',
        ], [
            'username.required' => 'Nama wajib diisi',
            'email.required' => 'Nama wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Role tidak valid',
        ]);
    }

    public static function validateChangePassword($request, $userId)
    {
        $request->validate([
            'password' => ['required', new \App\Rules\ValidateUserPassword($userId)],
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ], [
            'password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'confirm_password.required' => 'Wajib diisi',
            'confirm_password.same' => 'Password baru yang dimasukkan tidak sama',
        ]);
    }

    public static function validateProfileSave($request, $userId)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $userId,
            'phone_number' => 'required',
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'phone_number.required' => 'Nomor telepon wajib diisi',
        ]);
    }
}
