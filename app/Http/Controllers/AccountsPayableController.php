<?php

namespace App\Http\Controllers;

use App\Models\AccountsPayable;
use App\Models\AccountsPayablePayment;
use App\Models\Supplier;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class AccountsPayableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $loans = AccountsPayable::with('supplier')->get();

        return view('dashboard.suppliers.loans.index', ['loans' => $loans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $suppliers = Supplier::all();
        return view('dashboard.suppliers.loans.create', ['suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        AccountsPayable::create($request->all());

        return redirect()->route('payable.index')->with('success', 'Loan registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suppliers = Supplier::all();
        $data = AccountsPayable::find($id);
        $totalPayed = AccountsPayablePayment::with('accountsPayable')->where('accounts_payable_id', $data->id)->sum('amount');
        return view('dashboard.suppliers.loans.edit', ['data' => $data, 'totalPayed' => $totalPayed, 'suppliers' => $suppliers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:pending,paid,overdue',
        ]);

        $payable = AccountsPayable::find($id);

        $payable->update($request->all());

        return redirect()->route('payable.index')->with('success', 'Loan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
