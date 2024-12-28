<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Supplier::all();
        return view('dashboard.suppliers.index', ['suppliers' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.suppliers.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'owner' => 'required',
            'email' => 'required|email|unique:suppliers',
            'phone' => 'required',
            'address' => 'required'
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Suppliers registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('dashboard.suppliers.edit', ['data' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'company' => 'required',
            'owner' => 'required',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone' => 'required',
            'address' => 'required'
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {

        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier has been deleted successfully');
    }
}
