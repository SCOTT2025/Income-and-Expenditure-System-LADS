<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomeCategories = IncomeCategory::all();
        return view('income_categories.index', compact('incomeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('income_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:income_categories',
        ]);

        IncomeCategory::create($request->only('name'));

        return redirect()->route('income_categories.index')->with('success', 'Income category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomeCategory $income_category)
    {
        return view('income_categories.show', compact('income_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeCategory $income_category)
    {
        return view('income_categories.edit', compact('income_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomeCategory $income_category)
    {
        $request->validate([
            'name' => 'required|unique:income_categories,name,' . $income_category->id,
        ]);

        $income_category->update($request->only('name'));

        return redirect()->route('income_categories.index')->with('success', 'Income category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomeCategory $income_category)
    {
        $income_category->delete();

        return redirect()->route('income_categories.index')->with('success', 'Income category deleted successfully.');
    }

    /**
     * Bulk delete selected income categories.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:income_categories,id',
        ]);

        IncomeCategory::whereIn('id', $request->ids)->delete();

        return response()->json(['success' => true]);
    }
}
