<?php

namespace App\MyClass;

use App\Rules\ValidateUserPassword;

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
            'password' => ['required', new ValidateUserPassword($userId)],
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
            'username' => 'required',
            'email' => 'required|unique:users,email,' . $userId,
            'role' => 'required|in:Admin, User',
        ], [
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Role tidak valid',
        ]);
    }

    public static function validateTour($request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama wisata wajib diisi',
            'description.required' => 'Deskripsi wisata wajib diisi',
            'location.required' => 'Lokasi wisata wajib diisi',
            'latitude.required' => 'Latitude wisata wajib diisi',
            'longitude.required' => 'Longitude wisata wajib diisi',
            'category.required' => 'Kategori wisata wajib diisi',
            'price.required' => 'Harga wisata wajib diisi',
            'price.numeric' => 'Harga wisata harus berupa angka',
            'start_time.required' => 'Waktu mulai wisata wajib diisi',
            'start_time.date_format' => 'Format waktu mulai wisata tidak valid',
            'end_time.required' => 'Waktu selesai wisata wajib diisi',
            'end_time.date_format' => 'Format waktu selesai wisata tidak valid',
            'image.required' => 'Gambar wisata wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }



    public static function validateUpdateTour($request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama wisata wajib diisi',
            'description.required' => 'Deskripsi wisata wajib diisi',
            'location.required' => 'Lokasi wisata wajib diisi',
            'latitude.required' => 'Latitude wisata wajib diisi',
            'longitude.required' => 'Longitude wisata wajib diisi',
            'category.required' => 'Kategori wisata wajib diisi',
            'price.required' => 'Harga wisata wajib diisi',
            'price.numeric' => 'Harga wisata harus berupa angka',
            'start_time.required' => 'Waktu mulai wisata wajib diisi',
            'start_time.date_format' => 'Format waktu mulai wisata tidak valid',
            'end_time.required' => 'Waktu selesai wisata wajib diisi',
            'end_time.date_format' => 'Format waktu selesai wisata tidak valid',
            // 'image.required' => 'Gambar wisata wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }


    public static function validateCulture($request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama wisata wajib diisi',
            'description.required' => 'Deskripsi wisata wajib diisi',
            'image.required' => 'Gambar budaya wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }
}
