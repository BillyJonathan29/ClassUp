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

    public function get(Tour $tour)
    {
        try {
            return Response::success([
                'tour' => $tour
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function update(Request $request, Tour $tour)
    {
        Validations::validateUpdateTour($request);
        try {
            DB::beginTransaction();
            $tour->updateTour($request->except('image'));
            $tour->saveFile($request);
            DB::commit();
            return Response::update([
                'message' => 'Data wisata berhasil di update'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function destroy(Tour $tour)
    {
        DB::beginTransaction();
        try {
            $tour->tourDestroy();
            DB::commit();

            return Response::delete([
                'message' => 'Data wisata berhasil di hapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }


    public function getTour()
    {
        try {
            $tours = Tour::all()->map(function ($tour) {
                $tour->image = asset('storage/tour_photo/' . $tour->image);
                return $tour;
            });
            return Response::success([
                'message' => 'Data semua wisata',
                'tours' => $tours
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}
