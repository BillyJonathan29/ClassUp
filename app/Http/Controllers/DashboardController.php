<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Culture;
use App\Models\JobVacancy;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userPerMonth = User::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // Pie Chart: Kategori wisata
        $kategoriWisata = Tour::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');

        // Bar Chart: Loker berdasarkan jenis pekerjaan
        $jenisLoker = JobVacancy::select('job_type', DB::raw('count(*) as total'))
            ->groupBy('job_type')
            ->pluck('total', 'job_type');

        $totalUser = User::count();
        $totalWisata = Tour::count();
        $totalLoker = JobVacancy::count();
        $totalArticle = Article::count();
        $totalBudaya = Culture::count();

        // $pengunjungHariIni = LogAktivitas::whereDate('created_at', now())->count();

        return view('dashboard.index', compact(
            'totalUser',
            'totalWisata',
            'totalLoker',
            'totalArticle',
            'totalBudaya',
            'userPerMonth',
            'kategoriWisata',
            'jenisLoker'
        ));
    }
}
