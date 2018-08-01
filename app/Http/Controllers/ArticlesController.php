<?php

namespace App\Http\Controllers;

use App\Entities\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    public function index(){
        $articles = Article::orderBy('id','desk')->paginate(5);

        return view('index',['articles' => $articles]);
    }

    public function showArticle(int $id,$slug)
    {
        $article = Article::find($id);
        if(!$article){
            return abort(404);
        }

        return view('blog.article',['article' => $article]);

    }
}
