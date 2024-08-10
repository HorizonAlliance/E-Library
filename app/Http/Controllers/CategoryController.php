<?php

namespace App\Http\Controllers;

use App\Models\category;
use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $category = category::latest()->paginate(10);
        return view('admin.category.category', compact('category'));
    }

    public function create(): View
    {
        return view('admin.category.add_category');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                ValidationRule::unique('categories')->where(function ($query) {
                    return $query->whereRaw('lower(name) = ?', [strtolower(request('name'))]);
                })
            ],
        ]);

        try {

            category::create($data);
            return redirect()->route('category.index')->with('success', 'Add Category Success');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function edit($id): View
    {
        $data = category::findOrFail($id);
        return view('admin.category.edit_category', compact('data'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $category = category::findOrFail($id);
        $category->update($data);
        return redirect()->route('category.index')->with('success', 'update category success');
    }

    public function destroy(string $id): RedirectResponse
    {
        $data = category::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'delete category success');
    }
}
