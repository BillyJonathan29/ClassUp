<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        return view('article.index', [
            'title' => 'Berita',
            'breadcrumbs' => [
                [
                    'title' => 'Berita',
                    'link' => route('article')
                ]
            ]
        ]);
    }
    public function store(Request $request) {}

    public function get(Article $article) {}
    public function update(Article $article) {}

    public function destroy(Article $article) {}
}
