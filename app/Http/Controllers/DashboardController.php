<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expance;
use App\Models\MonthlyLimit;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard() //: View
    {
        $user = auth()->user();
        // return $user;
        $monthlyLimit = MonthlyLimit::where('user_id', $user->id)->first();
        // return $monthlyLimit;

        $month = now()->month;
        $year = now()->year;

        $expenses = Expance::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('user_id', auth()->id())
            ->get();
        //   return $expenses;

        $totalSpent = $expenses->sum('amount') ?? 0;

        // return $totalSpent;

        $topSpendindCategoryId = $expenses->groupBy('category_id')
            ->map(function ($group) {
                return $group->sum('amount');
            })
            ->sortDesc()
            ->keys()
            ->first();

        // return $topSpendindCategoryId;

        $topSpendindCategory = Category::where('id', $topSpendindCategoryId)->value('name') ?? 'N/A';
        // return $topSpendindCategory;

        $recentTransaction = Expance::with('category')
                                // ->whereYear('created_at', $year)
                                // ->whereMonth('created_at', $month)
                                ->where('user_id', auth()->id())
                                ->orderByDesc('id')
                                ->take(4)
                                ->get();
        // return $recentTransaction;

        return view('dashboard', compact('monthlyLimit', 'totalSpent', 'topSpendindCategory', 'recentTransaction'));
    }

    public function ajaxMonthlyExpenseChart(){
        $userId = auth()->id();

        $start = now()->startOfMonth()->subMonths(5);
        $end   = now()->startOfMonth();

        $result = [];

        while ($start <= $end) {

            $total = \App\Models\Expance::where('user_id', $userId)
                ->whereYear('created_at', $start->year)
                ->whereMonth('created_at', $start->month)
                ->sum('amount');

            $result[] = [
                'month' => $start->format('M'),
                'total' => $total,
                'is_current' => $start->isSameMonth(now()),
            ];

            $start->addMonth();
        }

        return response()->json($result);

    }

}
