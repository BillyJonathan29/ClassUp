<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobVacancyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return JobVacancy::dataTable($request);
        }
        return view('job-vacancy.index', [
            'title' => 'Lowongan Perkerjaan',
            'breadcrumbs' => [
                [
                    'title' => 'Lowongan Pekerjaan',
                    'link' => route('job-vacancy')
                ]
            ]
        ]);
    }

    public function create()
    {
        return view('job-vacancy.create', [
            'title' => 'Tambah Lowongan Pekerjaan',
            'breadcrumbs' => [
                [
                    'title' => 'Tambah Lowongan Pekerjaan',
                    'link' => route('job-vacancy.create')
                ]
            ]
        ]);
    }
    public function store(Request $request)
    {
        Validations::validateJobVacancy($request);
        DB::beginTransaction();
        try {
            JobVacancy::createJobVacancy($request->all());
            DB::commit();
            return Response::success([
                'message' => 'Data Lowongan Pekerjaan berhasil ditambahkan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function edit(JobVacancy $jobVacancy)
    {
        return view('job-vacancy.edit', [
            'title' => 'Edit Lowongan Pekerjaan',
            'jobVacancy' => $jobVacancy,
            'breadcrumbs' => [
                [
                    'title' => 'Lowongan Pekerjaan',
                    'link' => route('job-vacancy')
                ],
                [
                    'title' => 'Edit Lowongan Pekerjaan',
                    'link' => route('job-vacancy.edit', $jobVacancy->id)
                ]
            ]
        ]);
    }
    public function update(Request $request, JobVacancy $jobVacancy)
    {
        Validations::validateUpdateJobVacancy($request);
        DB::beginTransaction();
        try {
            $jobVacancy->updateJobVacancy($request->all());
            DB::commit();
            return Response::update([
                'message' => 'Data Lowongan Pekerjaan berhasil diupdate'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
    public function destroy(JobVacancy $jobVacancy)
    {
        DB::beginTransaction();
        try {
            $jobVacancy->destroyJobVacancy();
            DB::commit();
            return Response::delete([
                'message' => 'Data Lowongan Pekerjaan berhasil dihapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function getJobVacancy()
    {
        try {
            $jobVacancy = JobVacancy::all()->map(function ($jobVacancy) {
                $jobVacancy->image = asset('storage/job_vacancy/' . $jobVacancy->image);
                return $jobVacancy;
            });
            return Response::success([
                'message' => 'Data Semua lowongan pekerjaan',
                'jobVacancy' => $jobVacancy
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}
