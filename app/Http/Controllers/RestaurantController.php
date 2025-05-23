<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Restaurant::dataTable($request);
        }
        return view('restaurant.index', [
            'title' => 'Restoran',
            'breadcrumbs' => [
                [
                    'title' => 'Restoran',
                    'link' => route('restaurant')
                ]
            ]
        ]);
    }
    public function store(Request $request)
    {
        Validations::validateRestaurant($request);
        DB::beginTransaction();
        try {
            $restaurant = Restaurant::create($request->all());
            $restaurant->saveFile($request);
            DB::commit();
            return Response::success([
                'message' => 'Data restoran berhasil ditambahkan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function get(Restaurant $restaurant)
    {
        try {
            return Response::success([
                'restaurant' => $restaurant
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
    public function update(Request $request, Restaurant $restaurant)
    {
        Validations::validateUpdateRestaurant($request);
        DB::beginTransaction();
        try {
            $restaurant->updateRestaurant($request->except('image'));
            $restaurant->saveFile($request);
            DB::commit();
            return Response::update([
                'message' => 'Data restoran berhasil diupdate'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function destroy(Restaurant $restaurant)
    {
        DB::beginTransaction();
        try {
            $restaurant->destroyRestaurant();
            DB::commit();
            return Response::delete([
                'message' => 'Data restoran berhasil dihapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
}
