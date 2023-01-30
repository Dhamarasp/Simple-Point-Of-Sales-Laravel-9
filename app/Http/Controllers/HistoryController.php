<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Transaction::orderBy('created_at', 'desc')->paginate(5);
        return view('DetailTransaction.index', compact('details'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Transaction::where('id', $id)->with('user', 'detail', 'detail.item')->get()[0];

        foreach ($details['detail'] as $d) {
            $d['item']['price'] = $this->toRupiah($d['item']['price']);
        }

        $details['change'] = $this->toRupiah($details['pay_total'] - $details['total']);

        $details['total'] = $this->toRupiah($details['total']);
        $details['pay_total'] = $this->toRupiah($details['pay_total']);


        // return view('DetailTransaction.show', compact('details'));
        return response()->json($details);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toRupiah($nominal) {
        return "Rp. " . number_format($nominal,0,',','.');
    }
}
