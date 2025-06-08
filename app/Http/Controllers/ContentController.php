<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\JobVacancy;
use App\Models\Restaurant;
use App\Models\Tour;
use App\MyClass\Response;
use Exception;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function getContent(Request $request)
    {
        $category = strtolower($request->query('category'));

        try {
            switch ($category) {
                case 'wisata':
                    $data = Tour::all()->map(function ($item) {
                        $item->image = url('storage/tour_photo/' . $item->image);
                        return $item;
                    });
                    break;

                case 'restorant':
                    $data = Restaurant::all()->map(function ($item) {
                        $item->image = url('storage/restaurant/' . $item->image);
                        return $item;
                    });
                    break;

                case 'jobs':
                    $data = JobVacancy::all()->map(function ($item) {
                        $item->image = url('storage/job_vacancy/' . $item->image);
                        return $item;
                    });
                    break;

                case 'report':
                    $data = Article::all()->map(function ($item) {
                        $item->image = url('storage/article/' . $item->image);
                        return $item;
                    });
                    break;

                default:
                    return response()->json([
                        'message' => 'Kategori tidak ditemukan',
                    ], 404);
            }

            return Response::success([
                'message' => 'Data kategori: ' . $category,
                'data' => $data, 
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}
