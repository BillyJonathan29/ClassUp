<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Laravel\Sanctum\HasApiTokens;

class Culture extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['name', 'description', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function createCulture($request)
    {
        $request['created_by'] = auth()->id();
        return self::create($request);
    }

    public function updateCulture($request)
    {
        $this->update($request);
        return $this;
    }

    public function destroyCulture()
    {
        $this->removeCulturePhoto();
        return $this->delete();
    }

    public function cultureFilePath()
    {
        return storage_path('app/public/culture/'.$this->image);
    }

    public function isHasCulturePhoto()
    {
        if(empty($this->image)) return false;
        return File::exists($this->cultureFilePath());
    }

    public function removeCulturePhoto()
    {
        if($this->isHasCulturePhoto()){
            File::delete($this->cultureFilePath());
            $this->update([
                'image' => null
            ]);
        }
    }

    public function saveFile($request)
    {
        if($request->hasFile('image')){
            $this->removeCulturePhoto();
            $file = $request->file('image');
            $fileName = time(). '.' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/culture'), $fileName);
            $this->update([
                'image' => $fileName
            ]);
        }
        return $this;
    }

    public static function dataTable($request)
    {
        $data = self::select(['cultures.*']);
        return datatables()->eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
					<div class="dropdown">
						<button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pilih Aksi
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item edit" href="javascript:void(0);" data-edit-href="' . route('culture.update', $data->id) . '" data-get-href="' . route('culture.get', $data->id) . '">
								<i class="fas fa-pencil-alt mr-1"></i> Edit
							</a>
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?" data-delete-href="' . route('culture.destroy', $data->id) . '">
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
