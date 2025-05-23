<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'category',
        'contact',
        'latitude',
        'longitude',
        'start_time',
        'end_time',
        'address',
        'description',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function createRestaurant($request)
    {
        $request['created_by'] = auth()->id();
        return self::create($request);
    }

    public function updateRestaurant($request)
    {
        $this->update($request);
        return $this;
    }
    public function destroyRestaurant()
    {
        $this->removeRestaurant();
        return $this->delete();
    }

    public function restaurantFilePath()
    {
        return storage_path('app/public/restaurant/' . $this->image);
    }
    public function isHasRestaurant()
    {
        if (empty($this->image)) return false;
        return File::exists($this->restaurantFilePath());
    }
    public function removeRestaurant()
    {
        if ($this->isHasRestaurant()) {
            File::delete($this->restaurantFilePath());
            $this->update([
                'image' => null
            ]);
        }
    }
    public function saveFile($request)
    {
        if ($request->hasFile('image')) {
            $this->removeRestaurant();
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/restaurant/'), $fileName);
            $this->update([
                'image' => $fileName
            ]);
        }
        return $this;
    }


    public static function dataTable($request)
    {
        $data = self::select(['restaurants.*']);
        return datatables()->eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
					<div class="dropdown">
						<button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pilih Aksi
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item edit" href="javascript:void(0);" data-edit-href="' . route('restaurant.update', $data->id) . '" data-get-href="' . route('restaurant.get', $data->id) . '">
								<i class="fas fa-pencil-alt mr-1"></i> Edit
							</a>
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?" data-delete-href="' . route('restaurant.destroy', $data->id) . '">
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
}
