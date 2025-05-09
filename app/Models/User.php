<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'role'
    ];

        // const ROLE_ADMIN = 'Admin';
        // const ROLE_USER = 'User';

        // public function isAdmin()
        // {
        //     return $this->role == self::ROLE_ADMIN;
        // }

        // public function isUser()
        // {
        //     return $this->role == self::ROLE_USER;
        // }

    public function setPassword($password)
    {
        $this->update([
            'password' => Hash::make($password)
        ]);
        return $this;
    }

    public static function createUser($request)
    {
        $user = self::create($request);
        $user->setPassword($request['password']);
        return $user;
    }

    public function updateUser($request)
    {
        $this->update($request->except(['password']));
        if (!empty($request->password)) {
            $this->setPassword($request['password']);
        }
        return $this;
    }

    public function deleteUser()
    {
        return $this->delete();
    }

    public static function dataTable($request)
    {
        $data = self::select(['users.*']);
        return datatables()->eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
					<div class="dropdown">
						<button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pilih Aksi
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="' . route('user.edit', $data->id) . '">
								<i class="fas fa-pencil-alt mr-1"></i> Edit
							</a>
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?" data-delete-href="' . route('user.destroy', $data->id) . '">
								<i class="fas fa-trash mr-1"></i> Hapus
							</a>
						</div>
					</div>';
                return $action;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
