<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Culture;
use App\Models\Tour;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalTours' => Tour::count(),
            'totalCultures' => Culture::count(),
            'article' => Article::count(),
            // // 'todayVisitors' => VisitorLog::whereDate('created_at', now())->count(),
            // 'monthlyVisitors' => VisitorLog::whereMonth('created_at', now()->month)->count(),
            // 'totalTransactions' => Transaction::count(),
            // 'availableBoardings' => Room::where('is_available', true)->count(),
        ]);
    }
}
