<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Yajra\DataTables\Facades\DataTables;

class JobVacancy extends Model
{
    use HasApiTokens, HasFactory;
    protected $fillable = [
        'position',
        'company',
        'location',
        'job_type',
        'description',
        'qualifications',
        'salary_min',
        'salary_max',
        'application_deadline',
        'contact',
        'application_url',
    ];

    // public static function dataTable()
    // {
    //     $data = self::select(['job_vacancies.*']);
    //     return DataTables::eloquent($data)
    //         ->addColumn('action', function ($data) {
    //             $action = '
    //             <div class="dropdown">
    //                 <button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                     Pilih Aksi
    //                 </button>
    //              <div class="dropdown-menu">
    //                     <a class="dropdown-item" href="' . route('incoming-goods.detail', $data->id) . '">
    // 						<i class="fas fa-search mr-1"></i> Detail
    // 					</a>
    //                     <a class="dropdown-item edit" href="' . route('incoming-goods.edit', $data->id) . '">
    //                         <i class="fas fa-pencil-alt mr-1"></i> Edit
    //                     </a>
    //                     <a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong> Data Ini </strong>?" data-delete-href="' . route('incoming-goods.destroy', $incomingGoods) . '">
    //                         <i class="fas fa-trash mr-1"></i> Hapus
    //                     </a>
    //                 </div>
    //             </div>
    //         ';
    //             return $action;
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }

    public static function createJobVacancy($request)
    {
        return self::create($request);
    }

    public function destroyJobVacancy()
    {
        return $this->delete();
    }
    public function updateJobVacancy($request)
    {
        return $this->update($request);
    }



    public static function dataTable($request)
    {
        $data = self::select(['job_vacancies.*']);
        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
					<div class="dropdown">
						<button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pilih Aksi
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="' . route('job-vacancy.edit', $data->id) . '">
								<i class="fas fa-pencil-alt mr-1"></i> Edit
							</a>
							<a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->position . '</strong>?" data-delete-href="' . route('job-vacancy.destroy', $data->id) . '">
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
