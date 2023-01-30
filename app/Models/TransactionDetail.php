<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'item_id',
        'qty',
        'subtotal'
    ];
    protected $table = 'transaction_details';
    protected $guarded = [];

    public function transaction (){
        return $this->belongsTo(Transaction::class);
    }

    public function item (){
        return $this->belongsTo(Item::class);
    }

    // public function insertDetail($data) {
    //     $this->transaction_id = $data->transaction_id;
    //     $this->item_id = $data->item_id;
    //     $this->qty = $data->qty;
    //     $this->subtotal = $data->subtotal;
    //     $this->save();
    // }
}
