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
        if($request->ajax()){
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
        //
    }

    public function get(Restaurant $restaurant)
    {
        //
    }
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
