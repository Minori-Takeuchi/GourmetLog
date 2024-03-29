<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    // カテゴリートップ画面一覧表示
    public function index()
    {
        $categories = Category::paginate(10);
        
        return view('category/index', [
            'categories' => $categories,
        ]);
    }

    // カテゴリートップ画面検索
    public function search(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::query();

        if (!empty($search)) {
            $categories->where('name', 'LIKE', "%{$search}%");
        }

         $categories = $categories->paginate(10);

        return view('category/index', [
            'categories' => $categories,
        ]);
    }
    
    // 編集画面表示
    public function edit($id)
    {
        $category = Category::find($id);

        return view('category/form', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request)
    {
        if($request->input('back') == 'back') {
            return redirect('/category');
        }

        $userId = Auth::id();
        $category = Category::find($request->id);
        
        if ($category && $category->user_id === $userId) {
            $category->update([
            'name' => $request->name,
            ]);
        }   

        return redirect('/category');
    }

    // カテゴリー削除
    public function delete($id)
    {
        $userId = Auth::id();
        $category = Category::find($id);

        if ($category && $category->user_id === $userId) {
            $category->delete();
        }

        return back();
    }
}
