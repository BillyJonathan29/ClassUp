<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Laravel\Sanctum\HasApiTokens;

class Tour extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'latitude',
        'longitude',
        'category',
        'price',
        'start_time',
        'end_time',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function createTour($request)
    {
        $request['created_by'] = auth()->id();
        return self::create($request);
    }

    public function updateTour($request)
    {
        $this->update($request);
        return $this;
    }

    public function tourFilePath()
    {
        return storage_path('app/public/tour_photo/' . $this->image);
    }

    public function isHasTourPhoto()
    {
        if (empty($this->image)) return false;
        return File::exists($this->tourFilePath());
    }

    public function removeTourPhoto()
    {
        if ($this->isHasTourPhoto()) {
            File::delete($this->tourFilePath());
            $this->update([
                'image' => null
            ]);
        }
        return $this;
    }

    public function tourDestroy()
    {
        $this->removeTourPhoto();
        return $this->delete();
    }

    public function saveFile($request)
    {
        if ($request->hasFile('image')) {
            $this->removeTourPhoto();
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/tour_photo/'), $filename);
            $this->update([
                'image' => $filename,
            ]);
        }

        return $this;
    }

    public static function dataTable($request)
    {
        $data = self::select(['tours.*']);
        return datatables()->eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
					<div class="dropdown">
						<button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pilih Aksi
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item edit" href="javascript:void(0);" data-edit-href="' . route('tour.update', $data->id) . '" data-get-href="' . route('tour.get', $data->id) . '">
								<i class="fas fa-pencil-alt mr-1"></i> Edit
							</a>
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?" data-delete-href="' . route('tour.destroy', $data->id) . '">
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
