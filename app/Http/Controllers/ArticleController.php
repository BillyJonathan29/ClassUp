<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\MyClass\Validations;
use App\MyClass\Response;
use Exception;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Article::dataTable($request);
        }
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

    public function store(Request $request)
    {
        Validations::validateArticle($request);
        DB::beginTransaction();
        try {
            $article = Article::createArticle($request->all());
            $article->saveFile($request);
            DB::commit();
            return Response::success([
                'message' => 'Data berita berhasil di tambahkan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function get(Article $article) {}
    public function update(Article $article) {}

    public function destroy(Article $article) {}
}
