<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Show categories and subcategories on one page
    public function index(Request $request)
    {
        $categories = Category::with('subcategories')
            ->orderBy('name')
            ->get();

        $editSubcategory = $request->filled('edit_subcategory')
            ? Subcategory::findOrFail($request->edit_subcategory)
            : null;

        return view('admin.categories', compact(
            'categories',
            'editSubcategory'
        ));
    }

    // Create category
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['slug'])) {
            return back()->withErrors([
                'name' => 'Please enter a valid category name.',
            ])->withInput();
        }

        if (Category::where('slug', $data['slug'])->exists()) {
            return back()->withErrors([
                'name' => 'This category already exists.',
            ])->withInput();
        }

        $data['is_active'] = true;
        $data['show_in_header'] = true;

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    // Create subcategory inside a category
    public function storeSubcategory(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['slug'])) {
            return back()->withErrors([
                'name' => 'Please enter a valid subcategory name.',
            ])->withInput();
        }

        if (
            $category->subcategories()
                ->where('slug', $data['slug'])
                ->exists()
        ) {
            return back()->withErrors([
                'name' => 'This subcategory already exists in this category.',
            ])->withInput();
        }

        $data['category_id'] = $category->id;
        $data['is_active'] = true;

        Subcategory::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Subcategory created successfully.');
    }

    // Open category edit page
    public function edit(Category $category)
    {
        return view('admin.categories-edit', compact('category'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['slug'])) {
            return back()->withErrors([
                'name' => 'Please enter a valid category name.',
            ])->withInput();
        }

        if (
            Category::where('slug', $data['slug'])
                ->where('id', '!=', $category->id)
                ->exists()
        ) {
            return back()->withErrors([
                'name' => 'This category already exists.',
            ])->withInput();
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // Update subcategory on the same page
    public function updateSubcategory(
        Request $request,
        Subcategory $subcategory
    ) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['slug'])) {
            return back()->withErrors([
                'name' => 'Please enter a valid subcategory name.',
            ])->withInput();
        }

        if (
            $subcategory->category->subcategories()
                ->where('slug', $data['slug'])
                ->where('id', '!=', $subcategory->id)
                ->exists()
        ) {
            return back()->withErrors([
                'name' => 'This subcategory already exists in this category.',
            ])->withInput();
        }

        $subcategory->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Subcategory updated successfully.');
    }

    // Delete category after checking related data
    public function destroy(Category $category)
    {
        if ($category->subcategories()->exists()) {
            return back()->withErrors([
                'category' => 'Delete this category’s subcategories first.',
            ]);
        }

        if ($category->news()->exists()) {
            return back()->withErrors([
                'category' => 'Reassign or remove this category’s news first.',
            ]);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    // Delete subcategory after checking related news
    public function destroySubcategory(Subcategory $subcategory)
    {
        if ($subcategory->news()->exists()) {
            return back()->withErrors([
                'subcategory' => 'Reassign or remove this subcategory’s news first.',
            ]);
        }

        $subcategory->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Subcategory deleted successfully.');
    }
}
