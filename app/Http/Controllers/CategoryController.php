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
                ->get();

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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
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
