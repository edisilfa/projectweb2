<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
class TransactionController extends Controller
{
    //Tampilan form transaksi
    public function index(){
        $products = product::where([['stok','>',0]])->get();
        return view('transactions.index', compact('product'));
    }
}
