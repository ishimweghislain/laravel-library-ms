<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }
    
    public function create()
    {
        return view('suppliers.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        Supplier::create($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully');
    }
    
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }
    
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $supplier->update($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }
    
    public function destroy(Supplier $supplier)
    {
        try {
            DB::table('books')->where('supplier_id', $supplier->id)->delete();
            $supplier->delete();
            return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('error', 'Failed to delete supplier: ' . $e->getMessage());
        }
    }
}