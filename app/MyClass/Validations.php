<?php

namespace App\MyClass;

class Validations
{


	public static function validateImport($request)
	{
		$request->validate([
			'file_excel' => 'required|file|mimes:xlsx,xls',
		], [
			'file_excel.required' => 'File excel wajib diisi',
			'file_excel.file' => 'Wajib bernilai file',
			'file_excel.mimes' => 'Hanya mendukung ekstensi .xlsx atau .xls',
		]);
	}

	public static function validateCreateUser($request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|unique:users,email',
			'password' => 'required',
			'confirm_password' => 'required|same:password',
			'role' => 'required|in:Staff,Owner',
		], [
			'name.required' => 'Nama wajib diisi',
			'email.required' => 'Nama wajib diisi',
			'email.unique' => 'Email sudah digunakan',
			'password.required' => 'Password wajib diisi',
			'confirm_password.required' => 'Wajib diisi',
			'confirm_password.same' => 'Password yang dimasukkan tidak sama',
			'role.required' => 'Role wajib diisi',
			'role.in' => 'Role tidak valid',
		]);
	}

	public static function validateEditUser($request, $userId)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|unique:users,email,' . $userId,
			'password' => 'nullable',
			'confirm_password' => 'nullable|same:password',
			'role' => 'required|in:Staff,Owner',
		], [
			'name.required' => 'Nama wajib diisi',
			'email.required' => 'Nama wajib diisi',
			'email.unique' => 'Email sudah digunakan',
			'confirm_password.same' => 'Password yang dimasukkan tidak sama',
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
