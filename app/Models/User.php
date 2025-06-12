<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
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
        'role',
        'avatar',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class, 'created_by');
    }

    public function cultures()
    {
        return $this->hasMany(Culture::class, 'created_by');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'created_by');
    }
    public function companies()
    {
        return $this->hasMany(Company::class, 'created_by');
    }
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'created_by');
    }
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
        // $user = self::create($request);
        // $user->setPassword($request['password']);
        // return $user;

        $data = $request;

        if (!isset($data['role']) || empty($data['role'])) {
            $data['role'] = 'User';
        }

        $data['password'] = Hash::make($data['password']);

        return self::create($data);
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

    public function comparePassword($password)
    {
        return Hash::check($password, $this->password);
    }

    // avatar
    public function isHasAvatar()
    {
        if (empty($this->avatar)) return false;
        return File::exists($this->avatarPath());
    }

    public function avatarPath()
    {
        return storage_path('app/public/avatars/' . $this->avatar);
    }

    public function avatarLink()
    {
        if ($this->isHasAvatar()) {
            return url('storage/avatars/' . $this->avatar);
        }

        return url('img/default-avatar.jpg');
    }

    public function setAvatar($request)
    {
        if (!empty($request->upload_avatar)) {
            $this->removeAvatar();
            $file = $request->file('upload_avatar');
            $filename = date('YmdHis_') . $file->getClientOriginalName();
            $file->move(storage_path('app/public/avatars'), $filename);
            $this->update([
                'avatar' => $filename,
            ]);
        }

        return $this;
    }

    public function removeAvatar()
    {
        if ($this->isHasAvatar()) {
            File::delete($this->avatarPath());
            $this->update([
                'avatar' => null,
            ]);
        }

        return $this;
    }



    // end avatar

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
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->username . '</strong>?" data-delete-href="' . route('user.destroy', $data->id) . '">
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
