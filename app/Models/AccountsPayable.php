<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountsPayable extends Model
{
    use HasFactory;
    protected $table = 'accounts_payable';
    protected $fillable = ['amount', 'supplier_id', 'invoice_doc', 'status', 'due_date'];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function accountsPayablePayment(): HasMany
    {
        return $this->hasMany(AccountsPayablePayment::class, 'accounts_payable_id');
    }
}
