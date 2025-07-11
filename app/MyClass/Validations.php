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
    public static function validateUpdateCulture($request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama wisata wajib diisi',
            'description.required' => 'Deskripsi wisata wajib diisi',
            // 'image.required' => 'Gambar budaya wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }

    public static function validateArticle($request)
    {
        $request->validate([
            'title' => 'required',
            'fill' => 'required',
            'source' => 'required',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Judul berita wajib diisi',
            'fill.required' => 'Isi berita wajib diisi',
            'source.required' => 'Sumber berita wajib diisi',
            'date.required' => 'Tanggal berita wajib diisi',
            'date.date_format' => 'Format tanggal berita tidak valid',
            'image.required' => 'Gambar budaya wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }
    public static function validateUpdateArticle($request)
    {
        $request->validate([
            'title' => 'required',
            'fill' => 'required',
            'source' => 'required',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Judul berita wajib diisi',
            'fill.required' => 'Isi berita wajib diisi',
            'source.required' => 'Sumber berita wajib diisi',
            'date.required' => 'Tanggal berita wajib diisi',
            'date.date_format' => 'Format tanggal berita tidak valid',
            // 'image.required' => 'Gambar budaya wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }

    public static function validateCompany($request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'contact' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama perusahaan wajib diisi',
            'category.required' => 'Kategori perusahaan wajib diisi',
            'contact.required' => 'Kontak perusahaan wajib diisi',
            'contact.numeric' => 'Kontak perusahaan harus berupa angka',
            'latitude.required' => 'Latitude perusahaan wajib diisi',
            'longitude.required' => 'Longitude perusahaan wajib diisi',
            'address.required' => 'Alamat perusahaan wajib diisi',
            'image.required' => 'Gambar perusahaan wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }
    public static function validateUpdateCompany($request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'contact' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama perusahaan wajib diisi',
            'category.required' => 'Kategori perusahaan wajib diisi',
            'contact.required' => 'Kontak perusahaan wajib diisi',
            'contact.numeric' => 'Kontak perusahaan harus berupa angka',
            'latitude.required' => 'Latitude perusahaan wajib diisi',
            'longitude.required' => 'Longitude perusahaan wajib diisi',
            'address.required' => 'Alamat perusahaan wajib diisi',
            // 'image.required' => 'Gambar perusahaan wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }

    public static function validateRestaurant($request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'contact' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'address' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama restoran wajib diisi',
            'category.required' => 'Kategori restoran wajib diisi',
            'contact.required' => 'Kontak restoran wajib diisi',
            'contact.numeric' => 'Kontak restoran harus berupa angka',
            'latitude.required' => 'Latitude restoran wajib diisi',
            'longitude.required' => 'Longitude restoran wajib diisi',
            'start_time.required' => 'Jam buka restoran wajib diisi',
            'start_time.date_format' => 'Format waktu mulai restoran tidak valid',
            'end_time.required' => 'Jam tutup restoran wajib diisi',
            'end_time.date_format' => 'Format waktu selesai restoran tidak valid',
            'address.required' => 'Alamat restoran wajib diisi',
            'description.required' => 'Deskripsi restoran wajib diisi',
            'image.required' => 'Gambar restoran wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }
    public static function validateUpdateRestaurant($request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'contact' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'address' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama restoran wajib diisi',
            'category.required' => 'Kategori restoran wajib diisi',
            'contact.required' => 'Kontak restoran wajib diisi',
            'contact.numeric' => 'Kontak restoran harus berupa angka',
            'latitude.required' => 'Latitude restoran wajib diisi',
            'longitude.required' => 'Longitude restoran wajib diisi',
            'start_time.required' => 'Jam buka restoran wajib diisi',
            'start_time.date_format' => 'Format waktu mulai restoran tidak valid',
            'end_time.required' => 'Jam tutup restoran wajib diisi',
            'end_time.date_format' => 'Format waktu selesai restoran tidak valid',
            'address.required' => 'Alamat restoran wajib diisi',
            'description.required' => 'Deskripsi restoran wajib diisi',
            // 'image.required' => 'Gambar restoran wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    }

    public static function validateJobVacancy($request)
    {
        $request->validate([
            'position' => 'required',
            'company' => 'required',
            'location' => 'required',
            'job_type' => 'required|in:Full-Time,Part-Time,Freelance,Internship',
            'description' => 'required',
            'qualifications' => 'required',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'application_deadline' => 'required|date',
            'contact' => 'required',
            'application_url' => 'nullable|url',
        ], [
            'position.required' => 'Posisi pekerjaan wajib diisi.',
            'company.required' => 'Nama perusahaan wajib diisi.',
            'location.required' => 'Lokasi pekerjaan wajib diisi.',
            'job_type.required' => 'Jenis pekerjaan wajib diisi.',
            'job_type.in' => 'Jenis pekerjaan tidak valid.',
            'description.required' => 'Deskripsi pekerjaan wajib diisi.',
            'qualifications.required' => 'Kualifikasi pekerjaan wajib diisi.',
            'salary_min.numeric' => 'Gaji minimum harus berupa angka.',
            'salary_min.min' => 'Gaji minimum tidak boleh negatif.',
            'salary_max.numeric' => 'Gaji maksimum harus berupa angka.',
            'salary_max.gte' => 'Gaji maksimum harus lebih besar atau sama dengan gaji minimum.',
            'application_deadline.required' => 'Batas waktu lamaran wajib diisi.',
            'application_deadline.date' => 'Format tanggal batas lamaran tidak valid.',
            'contact.required' => 'Kontak wajib diisi.',
            'application_url.url' => 'URL lamaran harus berupa tautan yang valid.',
        ]);
    }
    public static function validateUpdateJobVacancy($request)
    {
        $request->validate([
            'position' => 'required',
            'company' => 'required',
            'location' => 'required',
            'job_type' => 'required|in:Full-Time,Part-Time,Freelance,Internship',
            'description' => 'required',
            'qualifications' => 'required',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'application_deadline' => 'required|date',
            'contact' => 'required',
            'application_url' => 'nullable|url',
        ], [
            'position.required' => 'Posisi pekerjaan wajib diisi.',
            'company.required' => 'Nama perusahaan wajib diisi.',
            'location.required' => 'Lokasi pekerjaan wajib diisi.',
            'job_type.required' => 'Jenis pekerjaan wajib diisi.',
            'job_type.in' => 'Jenis pekerjaan tidak valid.',
            'description.required' => 'Deskripsi pekerjaan wajib diisi.',
            'qualifications.required' => 'Kualifikasi pekerjaan wajib diisi.',
            'salary_min.numeric' => 'Gaji minimum harus berupa angka.',
            'salary_min.min' => 'Gaji minimum tidak boleh negatif.',
            'salary_max.numeric' => 'Gaji maksimum harus berupa angka.',
            'salary_max.gte' => 'Gaji maksimum harus lebih besar atau sama dengan gaji minimum.',
            'application_deadline.required' => 'Batas waktu lamaran wajib diisi.',
            'application_deadline.date' => 'Format tanggal batas lamaran tidak valid.',
            'contact.required' => 'Kontak wajib diisi.',
            'application_url.url' => 'URL lamaran harus berupa tautan yang valid.',
        ]);
    }
}
