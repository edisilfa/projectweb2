<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    //
    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    public function product(){
        return $this->belongsTo(product::class,'product_id');
    }
}
