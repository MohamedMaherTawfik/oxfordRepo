<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = [];

    protected $casts = [
        'balance' => 'decimal:2',
        'total_earned' => 'decimal:2',
        'total_withdrawn' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class, 'user_id', 'user_id');
    }

    public function addBalance($amount, $description = null, $referenceType = null, $referenceId = null, $createdBy = null)
    {
        $this->balance += $amount;
        $this->total_earned += $amount;
        $this->save();

        WalletTransaction::create([
            'wallet_id' => $this->id,
            'type' => 'credit',
            'amount' => $amount,
            'description' => $description,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'created_by' => $createdBy,
        ]);

        return $this;
    }

    public function deductBalance($amount, $description = null, $referenceType = null, $referenceId = null, $createdBy = null)
    {
        $this->balance -= $amount;
        $this->total_withdrawn += $amount;
        $this->save();

        WalletTransaction::create([
            'wallet_id' => $this->id,
            'type' => 'debit',
            'amount' => $amount,
            'description' => $description,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'created_by' => $createdBy,
        ]);

        return $this;
    }
}
