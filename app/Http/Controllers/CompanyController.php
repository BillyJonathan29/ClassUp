<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Company::dataTable($request);
        }
        return view('company.index', [
            'title' => 'Bisnis',
            'breadcrumbs' => [
                [
                    'title' => 'Bisnis',
                    'link' => route('company')
                ]
            ]
        ]);
    }
    public function store(Request $request)
    {
        Validations::validateCompany($request);
        DB::beginTransaction();
        try {
            $companies = Company::createCompany($request->all());
            $companies->saveFile($request);
            DB::commit();
            return Response::success([
                'message' => 'Data bisnis berhasil ditambahkan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
    public function update(Company $company) {}
    public function get(Company $company) {}
    public function destroy(Company $company) {}
}
