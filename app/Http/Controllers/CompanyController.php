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
            $company = Company::createCompany($request->all());
            $company->saveFile($request);
            DB::commit();
            return Response::success([
                'message' => 'Data bisnis berhasil ditambahkan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
    public function get(Company $company)
    {
        try {
            return Response::success([
                'company' => $company
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function update(Request $request, Company $company)
    {
        Validations::validateUpdateCompany($request);
        DB::beginTransaction();
        try {
            $company->companyUpdate($request->except('image'));
            $company->saveFile($request);
            DB::commit();
            return Response::update([
                'message' => 'Data bisnis berhasil diupdate'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function destroy(Company $company)
    {
        DB::beginTransaction();
        try {
            $company->companyDestroy();
            DB::commit();
            return Response::delete([
                'message' => 'Data bisnis berhasil dihapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
}
