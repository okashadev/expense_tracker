<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::where('is_system', true)
                ->orWhere('user_id', auth()->id())
                ->latest()
                ->paginate(8);

        return view('categories.list', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // return $request->all();
        try {
            $validate = $request->validated();
            DB::transaction(function () use ($validate) {
                Category::create([
                    'name' => $validate['name'],
                    'icon' => $validate['icon'],
                    'user_id' => auth()->id(),
                    'is_system' => false,
                ]);
            });

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()->with('error', 'Failed to create category. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            if ($category->is_system) {
                return redirect()
                    ->back()
                    ->with('error', 'System categories cannot be updated.');
            }

            $validate = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id . ',id,user_id,' . auth()->id(),
                'icon' => 'required|string',
            ]);

            $category->update([
                'name' => strtolower(trim($validate['name'])),
                'icon' => $validate['icon'],
            ]);

            return redirect()
                ->route('categories.index')
                ->with('success', 'Category updated successfully.');
                
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update category. Please try again.');
        }
    }


    public function destroy(Category $category)
    {
       if (is_null($category->user_id)) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Default categories cannot be deleted.');
        }

        if ($category->user_id !== auth()->id()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Unauthorized action.');
        }

        $category->delete();

        if ($category) {
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('categories.index')->with('error', 'Failed to delete category. Please try again.');
        }
    }
}
