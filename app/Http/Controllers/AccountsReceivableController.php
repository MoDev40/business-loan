<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivable;
use App\Models\Customer;
use Illuminate\Http\Request;

class AccountsReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $loans = AccountsReceivable::with('customer')->get();
        return view('dashboard.customers.loans.index', ['loans' => $loans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customers = Customer::all();
        return view('dashboard.customers.loans.create', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'amount' => ['numeric', 'decimal:0', 'required'],
            'due_date' => 'required',
            'customer_id' => ['numeric', 'integer', 'required'],
        ]);

        AccountsReceivable::create($request->all());

        return redirect()->route('receivable.index')->with('success', 'Loan registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountsReceivable $accountsReceivable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountsReceivable $accountsReceivable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountsReceivable $accountsReceivable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountsReceivable $accountsReceivable)
    {
        //
    }
}
