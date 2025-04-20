<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $categories = ExpenseCategory::all();
        return view('expense_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('expense_categories.create');
    }




    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $expenseCategory = new ExpenseCategory();
        $expenseCategory->name = $request->name;
        $expenseCategory->save();
    
        return redirect()->route('expense-categories.index')
            ->with('success', 'Expense Category created successfully.');
    }




    public function show(ExpenseCategory $expenseCategory)
    {
        return view('expense_categories.show', compact('expenseCategory'));
    }





    public function edit(ExpenseCategory $expenseCategory)
    {
        return view('expense_categories.edit', compact('expenseCategory'));
    }





    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $expenseCategory->update($request->all());

        return redirect()->route('expense-categories.index')->with('success', 'Expense Category updated successfully.');
    }





    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();

        return redirect()->route('expense-categories.index')->with('success', 'Expense Category deleted.');
    }




    public function bulkDelete(Request $request)
    {
        ExpenseCategory::whereIn('id', $request->ids)->delete();
        return response()->json(['success' => true]);
    }
}
