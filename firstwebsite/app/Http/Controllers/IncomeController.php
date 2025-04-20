<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::with('category')->latest()->get();
        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        $categories = IncomeCategory::all();
        return view('incomes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'income_category_id' => 'required|exists:income_categories,id',
            'entry_date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Income::create($request->all());
        return redirect()->route('incomes.index')->with('success', 'Income added successfully.');
    }

    public function show(Income $income)
    {
        return view('incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        $categories = IncomeCategory::all();
        return view('incomes.edit', compact('income', 'categories'));
    }

    public function update(Request $request, Income $income)
    {
        $request->validate([
            'income_category_id' => 'required|exists:income_categories,id',
            'entry_date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $income->update($request->all());
        return redirect()->route('incomes.index')->with('success', 'Income updated successfully.');
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return back()->with('success', 'Income deleted.');
    }

    public function bulkDelete(Request $request)
    {
        Income::whereIn('id', $request->ids)->delete();
        return response()->json(['success' => true]);
    }
}
