<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $paginasi = 5;

        if(strlen($key)){
            $items = Item::doesntHave('cart')->where('name', 'like', "%$key%")->paginate($paginasi);
            $carts = Item::has('cart')->get();
        } else {
            $items = Item::doesntHave('cart')->with('kategori')->orderBy('id')->paginate($paginasi);
            $carts = Item::has('cart')->get();
        }

        return view('Transaction.index', compact('items', 'carts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required',
            'qty' => 'required'
        ]);

        Cart::create($validatedData);
        return redirect()->route('transaction.index')->with('status', 'Sukses Tambah Produk');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'pay_total' => 'required',
        ],[
            'pay_total.required' => 'Masukkan Nominal'
        ]);

        if($request->pay_total < $this->rupiahToInt($request->total)) {
            return redirect()->route('transaction.index')->with('uangKurang', 'Uang Tidak Cukup');
        }

        Transaction::create([
            'user_id' => $request->user_id,
            'date' => now(),
            'total' => $this->rupiahToInt($request->total),
            'pay_total' => $request->pay_total
        ]);

        $transaction_id = Transaction::latest()->first()->id;

        foreach(Cart::all() as $item){
            TransactionDetail::create([
                'transaction_id' => $transaction_id,
                'item_id' => $item->item_id,
                'qty' => $item->qty,
                'subtotal' => $item->price * $item->qty
            ]);
        }

        Cart::truncate();

        $details = Transaction::where('id', $transaction_id)->with('user', 'detail', 'detail.item')->get()[0];
        Session::flash('details', $details);
        
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'qty' => 'required'
        ]);

        Cart::where('id', $id)->update($validatedData);
        return redirect()->route('transaction.index')->with('statuscart', 'Sukses Update Item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::find($id)->delete();
        return redirect()->route('transaction.index')->with('statuscartdelete', 'Sukses Hapus Item');
    }

    public function rupiahToInt($nominal) {
        return str_replace(".", "", explode(' ', $nominal)[1]);
    }
}
