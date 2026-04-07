<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expance;
use App\Services\GeminiService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function monthlyReport(Request $request, GeminiService $gemini)
    {
        $selectedMonth = $request->month;
        [$year, $month] = explode('-', $selectedMonth);
        // return "Year: $year, Month: $month";
        $expenses = Expance::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->where('user_id', auth()->id())
                    ->get();
        // return $expenses;

        if ($expenses->isEmpty()) {
            $formattedMonth = Carbon::parse($request->month)->format('F');
            return redirect()->back()->with([
                "type" => 'error',
                "message" => "No expenses found for month {$formattedMonth} {$year}."
            ]);
        }

        $totalSpent = $expenses->sum('amount');
        // return $totalSpent;

        $totalTransactions = $expenses->count();
        // return $totalTransactions;

        $topSpendindCategoryId = $expenses->groupBy('category_id')
            ->map(function ($group) {
                return $group->sum('amount');
            })
            ->sortDesc()
            ->keys()
            ->first();
        // return $topSpendindCategoryId;

        $topSpendindCategory = Category::where('id', $topSpendindCategoryId)->first('name');
        // return $topSpendindCategory;

        $categoryBreakdown = $expenses->groupBy('category_id')
            ->map(function($group) use ($totalSpent) {
                $category = Category::where('id', $group->first()->category_id)->first('name');

                return [
                    'category_name' => $category,
                    'amount' => $group->sum('amount'),
                    'percent' => $totalSpent > 0 ? round(($group->sum('amount') / $totalSpent) * 100, 1) : 0,
                ];
            }
        )->values();

        // return $categoryBreakdown;

        $recentTransaction = Expance::with('category')
                                ->whereYear('created_at', $year)
                                ->whereMonth('created_at', $month)
                                ->where('user_id', auth()->id())
                                ->orderByDesc('id')
                                ->take(4)
                                ->get();
        // return $recentTransaction;

        $formattedMonth = Carbon::parse($request->month)->format('M');

        $prompt = "
        You are an AI financial assistant.
        Analyze the user's monthly spending and generate exactly 3 insights.

        DATA:
        Total Spent: $totalSpent
        Total Transactions: $totalTransactions
        Category Breakdown: " . json_encode($categoryBreakdown) . "

        REQUIREMENTS:
        - Output must contain ONLY the 3 insights, each as a separate short paragraph.
        - Do NOT include any title, bullets, numbering, headings, or introductory phrases.
        - Do NOT say phrases like 'Here are your insights', 'Based on your data', etc.
        - Just write the insights directly.
        - Keep tone simple, friendly, and human.
        - Do NOT repeat exact numbers given in the input.
        ";

        $insights = $gemini->generateInsights($prompt);

        session(['monthly_insights_'.$selectedMonth => $insights]);
            
        return view('reports.monthly_report', compact(
            'selectedMonth',
            'formattedMonth',
            'year',
            'expenses',
            'totalSpent',
            'totalTransactions',
            'topSpendindCategory',
            'categoryBreakdown',
            'recentTransaction',
            'insights'
        ));
    }

    public function downloadPDF($selectedMonth)
    {
        [$year, $month] = explode('-', $selectedMonth);

        $expenses = Expance::with('category')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('user_id', auth()->id())
            ->get();

        if ($expenses->isEmpty()) {
            return back()->with('error', 'No expenses found for this month.');
        }

        $totalSpent = $expenses->sum('amount');
        $totalTransactions = $expenses->count();

        $topSpendindCategoryId = $expenses->groupBy('category_id')
            ->map(fn($group) => $group->sum('amount'))
            ->sortDesc()
            ->keys()
            ->first();

        $topSpendindCategory = Category::find($topSpendindCategoryId);

        $categoryBreakdown = $expenses->groupBy('category_id')
            ->map(function ($group) use ($totalSpent) {
                $category = Category::find($group->first()->category_id);

                return [
                    'category_name' => $category->name,
                    'amount' => $group->sum('amount'),
                    'percent' => $totalSpent > 0 ? round(($group->sum('amount') / $totalSpent) * 100, 1) : 0,
                ];
            })->values();

        $recentTransaction = $expenses
            ->sortByDesc('id')
            ->take(4);

        $formattedMonth = Carbon::create($year, $month)->format('F');

        $insights = session('monthly_insights_'.$selectedMonth, 'No insights available.');

        $pdf = Pdf::loadView('reports.pdf_template', compact(
            'formattedMonth',
            'year',
            'expenses',
            'totalSpent',
            'totalTransactions',
            'topSpendindCategory',
            'categoryBreakdown',
            'recentTransaction',
            'insights'
        ))->setPaper('a4');

        return $pdf->download("Expense-Report-{$formattedMonth}-{$year}.pdf");
    }

}
