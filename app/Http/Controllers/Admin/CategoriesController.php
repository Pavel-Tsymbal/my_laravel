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
        return view('admin.categories.index');
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
                return back()->with('success', 'категория успешно добавлена');
            }

            return back()->with('error', 'Что-то пошло не так, не удалось добавить категорию');

        } catch (ValidationException $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function editCategory(int $id)
    {

    }

    public function deleteCategory(Request $request)
    {
        if ($request->ajax()) {

        }
    }
}
