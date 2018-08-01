<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Article;
use App\Entities\Category;
use App\Entities\CategoryArticle;
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
        return view('admin.articles.add',['categories' => $categories]);
    }

    public function addRequestArticle(Request $request)
    {
//        dd($request);
        $objArticle = new Article();
        $objCategoryArticle = new CategoryArticle();

        $objArticle = $objArticle->create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'short_text' => $request->input('short_text'),
            'full_text' => $request->input('full_text')
        ]);

        if ($objArticle) {
            foreach ($request->input('categories') as $category_id) {
                $objCategoryArticle->create([
                    'category_id' => $category_id,
                    'article_id' => $objArticle->id
                ]);
            }

            return redirect(route('articles'))->with('success', 'Статья успешно добавлена');
        }

        return back()->with('error', 'Что-то пошло не так, не удалось добавить статью');

    }

    public function editArticle(int $id)
    {
        $article = Article::find($id);


        $categories = Category::get();

        if (!$article) {
            return abort(404);
        }

        $categoriesInArticle = $article->categories;
        $idCategories = [];

        foreach ($categoriesInArticle as $category) {
            $idCategories[] = $category->id;
        }

        return view('admin.articles.edit', [
            'article' => $article,
            'categories' => $categories,
            'idCategories' => $idCategories
        ]);
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
            CategoryArticle::where('article_id',$objArticle->id)->delete();

            foreach ($request->input('categories') as $category_id) {
                CategoryArticle::create([
                    'category_id' => $category_id,
                    'article_id' => $objArticle->id
                ]);
            }

            return redirect(route('articles'))->with('success', 'Статья успешно изменена');
        }

        return back()->with('error', 'Не удалось изменить статью');
    }

    public function deleteArticle(int $id)
    {
        $article = Article::find($id);
        if ($article->delete()) {
            CategoryArticle::where('article_id',$article->id)->delete();
            return redirect(route('articles'))->with('success', 'Статья успешно удалена');
        }
        return redirect(route('articles'))->with('error', 'Не удалось удалить статью');
    }
}
