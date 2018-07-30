<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $count = 0;
        return view('admin.categories.index', ['categories' => $categories, 'count' => $count]);
    }

    public function addCategory()
    {
        return view('admin.categories.add');
    }

    public function addRequestCategory(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string|min:4',
                'description' => 'required'
            ]);

            $objCategory = new Category();
            $objCategory = $objCategory->create([
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);

            if ($objCategory) {
                return redirect(route('categories'))->with('success', 'категория успешно добавлена');
            }

            return back()->with('error', 'Что-то пошло не так, не удалось добавить категорию');

        } catch (ValidationException $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function editCategory(int $id)
    {
        $category = Category::find($id);
        if(!$category){
            return abort(404);
        }
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function editRequestCategory(Request $request,int $id)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string|min:4',
                'description' => 'required'
            ]);

            $objCategory = Category::find($id);
            if(!$objCategory){
                return abort(404);
            }

            $objCategory->title = $request->input('title');
            $objCategory->description = $request->input('description');

            if ($objCategory->save()) {
                return redirect(route('categories'))->with('success', 'категория успешно изменена');
            }

            return back()->with('error', 'не удалось изменить категорию');

        } catch (ValidationException $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteCategory(int $id)
    {
        $category = Category::find($id);
        if($category->delete()){
            return redirect(route('categories'))->with('success', 'категория успешно удалена');
        }
        return redirect(route('categories'))->with('error', 'не удалось удалить категорию');
    }
}
