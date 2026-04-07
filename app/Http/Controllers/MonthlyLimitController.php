<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonthlyLimitRequest;
use App\Models\MonthlyLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthlyLimitController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(MonthlyLimitRequest $request)
    {
        try {
            $validate = $request->validated();
            // return $validate;

            DB::transaction(function () use ($validate) {
                $monthlyLimit = new MonthlyLimit();
                $monthlyLimit->user_id = auth()->id();
                $monthlyLimit->limit_amount = $validate['limit'];
                $monthlyLimit->save();
            });

            return redirect()->back()->with('success', 'Monthly limit set successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to set monthly limit. Please try again.');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(MonthlyLimitRequest $request, MonthlyLimit $monthlyLimit)
    {
        try {
            $validate = $request->validated();
            // return $validate;

            DB::transaction(function () use ($validate) {
                $monthlyLimit = MonthlyLimit::where('user_id', auth()->id())->first();
                $monthlyLimit->limit_amount = $validate['limit'];
                $monthlyLimit->save();
            });

            return redirect()->back()->with('success', 'Monthly limit updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update monthly limit. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonthlyLimit $monthlyLimit)
    {
        //
    }
}
