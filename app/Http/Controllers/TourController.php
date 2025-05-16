<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Tour::dataTable($request);
        }
        return view('tour.index', [
            'title' => 'Wisata',
            'breadcrumbs' => [
                [
                    'title' => 'Wisata',
                    'link' => route('tour')
                ]
            ]
        ]);
    }


    public function store(Request $request)
    {
        Validations::validateTour($request);
        DB::beginTransaction();

        try {
            $tours = Tour::createTour($request->all());
            $tours->saveFile($request);
            DB::commit();

            return Response::success([
                'message' => 'Data wisata berhasil di tambahkan',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
}
