<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Article;
use App\Entities\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::get();
        $count = 0;
        return view('admin.articles.index', ['articles' => $articles, 'count' => $count]);
    }

    public function addArticle()
    {
        $categories = Category::get();
        $count = 0;
        return view('admin.articles.add',['categories' => $categories,'count' => $count]);
    }

    public function addRequestArticle(Request $request)
    {
        $objArticle = new Article();
        $objArticle = $objArticle->create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'short_text' => $request->input('short_text'),
            'full_text' => $request->input('full_text')
        ]);

        if ($objArticle) {
            return redirect(route('articles'))->with('success', 'Статья успешно добавлена');
        }

        return back()->with('error', 'Что-то пошло не так, не удалось добавить статью');

    }

    public function editArticle(int $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return abort(404);
        }
        return view('admin.articles.edit', ['article' => $article]);
    }

    public function editRequestArticle(Request $request, int $id)
    {
        $objArticle = Article::find($id);
        if (!$objArticle) {
            return abort(404);
        }

        $objArticle->title = $request->input('title');
        $objArticle->author = $request->input('author');
        $objArticle->short_text = $request->input('short_text');
        $objArticle->full_text = $request->input('full_text');

        if ($objArticle->save()) {
            return redirect(route('articles'))->with('success', 'Статья успешно изменена');
        }

        return back()->with('error', 'Не удалось изменить статью');
    }

    public function deleteArticle(int $id)
    {
        $article = Article::find($id);
        if ($article->delete()) {
            return redirect(route('articles'))->with('success', 'Статья успешно удалена');
        }
        return redirect(route('articles'))->with('error', 'Не удалось удалить статью');
    }
}
