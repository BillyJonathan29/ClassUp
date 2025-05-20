<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Laravel\Sanctum\HasApiTokens;

class Article extends Model
{
    use HasApiTokens, HasFactory;
    protected $fillable = [
        'title',
        'fill',
        'source',
        'date',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function createArticle($request)
    {
        $request['created_by'] = auth()->id();
        return self::create($request);
    }

    public function articleUpdate($request)
    {
        $this->update($request);
        return $this;
    }

    public function articleDestory()
    {
        $this->removeArticlePhoto();
        return $this->delete();
    }

    public function articleFilePath()
    {
        return storage_path('app/public/article/' . $this->image);
    }

    public function isHasArticlePhoto()
    {
        if (empty($this->image)) return false;
        return File::exists($this->articleFilePath());
    }

    public function removeArticlePhoto()
    {
        if ($this->isHasArticlePhoto()) {
            File::delete($this->articleFilePath());
            $this->update([
                'image' => null
            ]);
        }
        return $this;
    }

    public function saveFile($request)
    {
        if ($request->hasFile('image')) {
            $this->removeArticlePhoto();
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/article'), $fileName);
            $this->update([
                'image' => $fileName
            ]);
        }
        return $this;
    }

    public static function dataTable($request)
    {
        $data = self::select(['articles.*']);
        return datatables()->eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
					<div class="dropdown">
						<button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pilih Aksi
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item edit" href="javascript:void(0);" data-edit-href="' . route('article.update', $data->id) . '" data-get-href="' . route('article.get', $data->id) . '">
								<i class="fas fa-pencil-alt mr-1"></i> Edit
							</a>
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?" data-delete-href="' . route('article.destroy', $data->id) . '">
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
