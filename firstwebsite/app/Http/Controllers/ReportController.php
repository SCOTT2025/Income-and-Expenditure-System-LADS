<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function monthly(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $start = Carbon::parse($month . '-01')->startOfMonth();
        $end = Carbon::parse($month . '-01')->endOfMonth();

        $incomes = Income::with('category')
            ->whereBetween('entry_date', [$start, $end])
            ->get();

        $expenses = Expense::with('category')
            ->whereBetween('entry_date', [$start, $end])
            ->get();

        return view('reports.monthly', compact('month', 'incomes', 'expenses'));
    }
}
