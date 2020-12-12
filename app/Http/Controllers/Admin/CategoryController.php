<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Entities\Proposal;
use App\Entities\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|string|max:255'
        ]);
        Category::create($data);
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Категория успешна создана');
    }

    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $this->validate($request, [
            'title' => 'required|string|max:255'
        ]);
        $category->update($data);
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Категория была успешно обновлена');
    }

    public function destroy(Category $category)
    {
        foreach ($category->proposals()->get() as $proposal) {
            unlink(public_path('photos/before/'.$proposal->photo_before));
            if ($proposal->photo_after) {
                unlink(public_path('photos/after/'.$proposal->photo_after));
            }
        }
        $category->delete();
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Категория была успешно удалена');
    }
}
