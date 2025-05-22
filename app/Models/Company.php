<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'category',
        'contact',
        'latitude',
        'longitude',
        'address',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function createCompany($request)
    {
        $request['created_by'] = auth()->id();
        return self::create($request);
    }
    public function companyUpdate($request)
    {
        $this->update($request);
        return $this;
    }
    public function companyDestroy()
    {
        $this->removePhotoCompany();
        return $this->delete();
    }

    public function companyFilePath()
    {
        return storage_path('app/public/company/' . $this->image);
    }
    public function isHasCompanyPhoto()
    {
        if (empty($this->image)) return false;
        return File::exists($this->companyFilePath());
    }

    public function removePhotoCompany()
    {
        if ($this->isHasCompanyPhoto()) {
            File::delete($this->companyFilePath());
            $this->update([
                'image' => null
            ]);
        }
    }

    public function saveFile($request)
    {
        if ($request->hasFile('image')) {
            $this->removePhotoCompany();
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/company/'), $fileName);
            $this->update([
                'image' => $fileName
            ]);
        }
        return $this;
    }

    public static function dataTable($request)
    {
        $data = self::select(['companies.*']);
        return datatables()->eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
					<div class="dropdown">
						<button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pilih Aksi
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item edit" href="javascript:void(0);" data-edit-href="' . route('company.update', $data->id) . '" data-get-href="' . route('company.get', $data->id) . '">
								<i class="fas fa-pencil-alt mr-1"></i> Edit
							</a>
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?" data-delete-href="' . route('company.destroy', $data->id) . '">
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
