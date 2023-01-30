<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with('kategori')->orderBy('id')->paginate(5);
        $categories = Category::all();
        return view('Item.index', compact('categories', 'items'));
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
            'category_id' => 'required',
            'name' => 'required|max:100|unique:items',
            'price' => 'required',
            'stock' => 'required',
        ],[
            'name.max' => 'Maksimal 100 Huruf',
            'name.required' => 'Wajib Diisi',
            'price.required' => 'Wajib Diisi',
            'stock.required' => 'Wajib Diisi',
        ]);

        Item::create($validatedData);
        return redirect()->route('item.index')->with('success', 'Berhasil Menambah Item Baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            'category_id' => 'required',
            'name' => 'required|max:100',
            'price' => 'required',
            'stock' => 'required',
        ],[
            'name.max' => 'Maksimal 100 Huruf',
            'name.required' => 'Wajib Diisi',
            'name.unique' => 'Item Telah Ada',
            'price.required' => 'Wajib Diisi',
            'stock.required' => 'Wajib Diisi',
        ]);

        Item::where('id', $id)->update($validatedData);
        return redirect()->route('item.index')->with('success', 'Berhasil Meng-update Item Baru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect()->route('item.index')->with('success', 'Berhasil Menghapus Data');
    }
}
