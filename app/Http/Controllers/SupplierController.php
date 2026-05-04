<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display all suppliers
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store new supplier
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'nullable'
        ]);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect()->back()->with('success', 'Supplier added successfully');
    }

    /**
     * Edit supplier
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update supplier
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated');
    }

    /**
     * Delete supplier
     */
    public function destroy($id)
    {
        Supplier::destroy($id);

        return redirect()->back()->with('success', 'Supplier deleted');
    }
}