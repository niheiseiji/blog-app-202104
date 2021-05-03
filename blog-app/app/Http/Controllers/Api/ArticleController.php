<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;


class ArticleController extends Controller
{
    /**
     * 記事一覧
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::all();
        return response()->json([
            'message' => 'ok',
            'data' => $data
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 記事詳細
     *
     * @param  App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response()->json([
            'message' => 'ok',
            'data' => $article
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

}
