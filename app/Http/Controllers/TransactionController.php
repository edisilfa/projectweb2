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

    public function history(){
        $history = transaction::with('details.product')->latest()->get();
        return view('transactions.history', compact('history'));
    }

    public function store(Request $request){
        //Validasi INput
        $request->validate(
            [
                'product_id'=>'required|exists:products,id',
                'qty'=> 'required|numeric|min:1'
            ]
        );
        //ambil product
        $product = product::findOrFail($request->product_id);

        //cek apakah stok mencukupi
        //jika tidak maka akan mengirim pesan (qty)error
        if($product->stok < $request->qty){
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
                'product_id'=>$product->id,
                'qty'=>$request->qty,
                'harga_satuan'=>$product->harga,
                'subtotal'=>$subtotal,
            ]);
            //Potong Stok
            $product->decrement('stok',$request->qty);

           
        });
         //Arahkan kembali ke halaman form
            return redirect()->route('transactions.index')->with('success','Transaksi berhasil di simpan!');
    }
}
