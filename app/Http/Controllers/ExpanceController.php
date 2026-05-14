<?php

namespace App\Http\Controllers;

use \Throwable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesCreateRequest;
use App\Http\Requests\ExpenseUpdateRequest;
use App\Models\Category;
use App\Models\Expance;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExpanceController extends Controller
{

    public function index() : View
    {
        $user_id = auth()->id();
        $expenses = Expance::where('user_id', $user_id)->with('category')->latest()
        ->paginate(5);
        // return $expenses;
        return view('expenses.list', compact('expenses'));
    }

    public function IndexFilter(){

    }


    public function create(): View
    {
        $categories = Category::where('is_system', true)
                ->orWhere('user_id', auth()->id())
                ->latest()
                ->get();

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

    public function edit(Expance $expance) : View
    {
        // return $expance;
        $categories = Category::all();
        return view('expenses.edit', compact('expance', 'categories'));
    }

    public function update(ExpenseUpdateRequest $request, Expance $expance)
    {
        // return $request;
        try {
            $validate = $request->validated();
            // return $validate;
            DB::transaction(function () use ($validate, $expance) {
                $expance->update([
                    'category_id' => $validate['category_id'],
                    'title' => $validate['title'],
                    'amount' => $validate['amount'],
                    'description' => $validate['description'],
                ]);
            });

            return redirect()->route('expenses.index')->with('success', 'Expense Updated Successfully.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update expense. Please try again.');
        }
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
