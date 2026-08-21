<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\transaction_detail;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    //Tampilan form transaksi
    public function index(){
        $products = product::where([['stok','>',0]])->get();
        return view('transactions.index', compact('products'));
    }

    public function store(Request $request){
        request->validate(
            [
                'product_id'=>'required|exists:product,id',
                'qty'=> 'required|numeric|min:1'
            ]
        );
        //ambil product
        $product = product::findOrFail(request->product_id);


        if(product->stok < $request->qty){
            return back()->withErrors(['qty_error','Stok tidak mencukupi']);
        }

        DB::transaction(function() use ($request, $product){
            //create Data Transaksi
            $subtotal = $product->harga * $request->qty;
            $no_nota = 'TRX - '. strtoupper(uniqid());

            $transaction = transaction::create([
                'no_nota'=>$no_nota,
                'total_harga'=>$subtotal,
            ]);

            //create detail transactions
            transaction_detail::create([
                'transaction_id'=>$transaction->id,
                'product_id'=>$product_id,
                'qty'=>$request->qty,
                'harga_satuan'=>$product->harga,
                'subtotal'=>$subtotal,
            ]);
        });
    }
}
