<?php

namespace App\Http\Controllers;

use App\Models\AccountsPayablePayment;
use Illuminate\Http\Request;

class AccountsPayablePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AccountsPayablePayment::all();
        return view('dashboard.suppliers.payment.index', ['payments' =>  $data]);
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
            'accounts_payable_id' => 'required|exists:accounts_payable,id',
        ]);

        AccountsPayablePayment::create($request->all());

        return redirect()->route('payable.show', $request->accounts_payable_id)->with('success', "Your payment has been successfully processed");
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
        $data = AccountsPayablePayment::find($id);

        $instance = AccountsPayablePayment::with('accountsPayable')->where('accounts_payable_id', $data->accounts_payable_id);

        $loan = $instance->get()[0]->accountsPayable->amount;

        $totalPayed = $instance->sum('amount');

        $max_exp_amount = ($loan + $data->amount) - $totalPayed;

        return view('dashboard.suppliers.payment.edit', ['max_exp_amount' => $max_exp_amount, 'payment' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'accounts_payable_id' => 'required|exists:accounts_payable,id',
        ]);

        $data = AccountsPayablePayment::find($id);

        $data->update($request->all());

        return redirect()->route('accounts_payable.index')->with('success', "Your payment has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
