<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'total',
        'pay_total',
    ];
    protected $table = 'transactions';
    protected $guarded = [];

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function detail (){
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
