<?php

namespace App\Http\Controllers\Rest;

use App\Article;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;

class ArticleController
{
    // method to returned success status ( 200 )
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    // get all articles
    public function getArticles()
    {


        $articles = DB::table('articles')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id');
            })
            ->select(
                'articles.id',
                'articles.publish_date',
                'articles.title',
                'articles.body',
                'articles.description',
                'articles.publish_date',
                'users.name',
                'users.email'
            )
            ->orderBy('articles.publish_date', 'desc')
            ->get();


        return $this->sendResponse($articles, 'Articles retrieved successfully.');
    }

    // update article
    public function updateArticle(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:10',
                'description' => 'required|min:10',
                'body' => 'required|min:10',
                'publish_date' => 'date_format:Y-m-d H:i:s'
            ]);

            if ($validator->fails()) {
                return Response::json(['errors' => $validator->errors()], 400);
            }

            $article = Article::where('id', $id)->first();
            $article->title = $request->title;
            $article->description = $request->description;
            $article->body = $request->body;
            $article->user_id = $request->user_id;
            $article->publish_date = $request->publish_date;
            $article->save();

            return $this->sendResponse($article, 'Articles was saved successfully.');
        } catch (Exception $e) {
            return Response::json(['errors' => 'Bad Request'], 400);
        }
    }

    // show article by id
    public function showArticle($id)
    {
        $article = DB::table('articles')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id');
            })
            ->select(
                'articles.id',
                'articles.publish_date',
                'articles.title',
                'articles.body',
                'articles.description',
                'articles.publish_date',
                'users.name',
                'users.email'
            )
            ->where('articles.id', '=', $id)
            ->get();

        return $this->sendResponse($article, 'success');
    }

    // create article
    public function createArticle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:10',
            'description' => 'required|min:10',
            'body' => 'required|min:10',
            'publish_date' => 'date_format:Y-m-d H:i:s'
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 400);
        }

        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->body = $request->body;
        $article->publish_date = $request->publish_date;
        $article->user_id = $request->user_id;
        $article->save();

        return $this->sendResponse($article, 'The article was created successfully');
    }

    // delete article by id
    public function deleteArticle($id)
    {
        $article = Article::where('id', $id)->delete();
        return $this->sendResponse($article, 'The article was deleted successfully');
    }

    // method for show articles by filter
    public function articleByFilter(Request $request)
    {
        $filter = $request->get('title');

        $articles_by_filter = Article::where('title', 'like', "%{$filter}%")
            ->orWhere('body', 'like', "%{$filter}%")
            ->orWhere('description', 'like', "%{$filter}%")
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id');
            })
            ->select(
                'articles.id',
                'articles.publish_date',
                'articles.title',
                'articles.body',
                'articles.description',
                'articles.publish_date',
                'users.name',
                'users.email'
            )
            ->get(['title']);

        return $this->sendResponse($articles_by_filter, 'The article/s was successfully showed');
    }

    // show articles by paginate
    public function getArticlesByPagination(Request $request)
    {
        $paginate = $request->get('paginate');

        $articles = DB::table('articles')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id');
            })
            ->select(
                'articles.id',
                'articles.publish_date',
                'articles.title',
                'articles.body',
                'articles.description',
                'articles.publish_date',
                'users.name',
                'users.email'
            )
            ->orderBy('articles.publish_date', 'desc')
            ->paginate($paginate);

        return $this->sendResponse($articles, 'Articles retrieved successfully.');
    }
}
