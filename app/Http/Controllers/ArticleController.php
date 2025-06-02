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

    public function get(Article $article)
    {
        try {
            return Response::success([
                'article' => $article
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
    public function update(Request $request, Article $article)
    {
        Validations::validateUpdateArticle($request);
        DB::beginTransaction();
        try {
            $article->articleUpdate($request->except('image'));
            $article->saveFile($request);
            DB::commit();

            return Response::update([
                'message' => 'Data berita berhasil di update'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function destroy(Article $article)
    {
        DB::beginTransaction();
        try {
            $article->articleDestory();
            DB::commit();
            return Response::delete([
                'message' => 'Data berita berhasil di hapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function getArticle()
    {
        try {
            $articles = Article::all()->map(function ($article) {
                $article->image = asset('storage/article/' . $article->image);
                return $article;
            });
            return Response::success([
                'message' => 'Data semua berita',
                'articles' => $articles
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}
