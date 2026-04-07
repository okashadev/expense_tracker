<?php

namespace App\Http\Controllers;

use \Throwable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesCreateRequest;
use App\Models\Category;
use App\Models\Expance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExpanceController extends Controller
{
    
    public function index() : View
    {
        $expenses = Expance::with('category')->get();
        // return $expenses;
        return view('expenses.list', compact('expenses'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('expenses.add', compact('categories'));
    }


    public function store(ExpensesCreateRequest $request)
    {
        // return $request;
        try {
            $validate = $request->validated();
            // return $validate;
            DB::transaction(function () use ($validate) {
                Expance::create([
                    'user_id' => auth()->id(),
                    'category_id' => $validate['category_id'],
                    'title' => $validate['title'],
                    'amount' => $validate['amount'],
                    'description' => $validate['description'],
                ]);
            });

            return redirect()->route('expenses.index')->with('success', 'Expense Added successfully.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Failed to add expense. Please try again.');
        }
    }


    public function show(Expance $expance)
    {
        //
    }

    public function edit(Expance $expance)
    {
        //
    }

    public function update(Request $request, Expance $expance)
    {
        //
    }

    public function destroy(Expance $expance)
    {
        $deleted = $expance->delete();
        if ($deleted) {
            return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
        } else {
            return redirect()->route('expenses.index')->with('error', 'Failed to delete expense. Please try again.');
        }   
    }
}
