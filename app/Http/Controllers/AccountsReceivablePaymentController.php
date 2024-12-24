<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivablePayment;
use Illuminate\Http\Request;

class AccountsReceivablePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = AccountsReceivablePayment::all();
        return view('dashboard.customers.payment.index', ['payments' =>  $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'accounts_receivable_id' => 'required|exists:accounts_receivable,id',
        ]);

        AccountsReceivablePayment::create($request->all());

        return redirect()->route('receivable.show', $request->accounts_receivable_id)->with('success', "Your payment has been successfully processed");
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountsReceivablePayment $accountsReceivablePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountsReceivablePayment $accountsReceivablePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountsReceivablePayment $accountsReceivablePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountsReceivablePayment $accountsReceivablePayment)
    {
        //
    }
}
