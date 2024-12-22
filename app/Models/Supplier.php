<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['company', 'owner', 'email', 'phone', 'address'];

    public function accountsPayable(): HasMany
    {
        return $this->hasMany(AccountsPayable::class, 'supplier_id');
    }
}
