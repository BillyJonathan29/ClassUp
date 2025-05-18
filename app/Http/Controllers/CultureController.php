<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\MyClass\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MyClass\Validations;
use Exception;

class CultureController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Culture::dataTable($request);
        }
        return view('culture.index', [
            'title' => 'Budaya',
            'breadcrumbs' => [
                [
                    'title' => 'Budaya',
                    'link' => route('culture')
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        Validations::validateCulture($request);
        DB::beginTransaction();
        try {
            $culture = Culture::createCulture($request->all());
            $culture->saveFile($request);
            DB::commit();
            return Response::success([
                'message' => 'Data budaya berhasil di tambahkan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function get() {}

    public function update(Request $request, Culture $culture) {}

    public function destroy() {}
}
