<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id')->paginate(5);
        return view('Category.index', compact('categories'));
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
            'name' => 'required|unique:categories'
        ],[
            'name.required' => 'Tidak Boleh Kosong',
            'name.unique' => 'Kategori Sudah Terdaftar'
        ]);

        Category::create($validatedData);
        return redirect()->route('category.index')->with('success', 'Berhasil Menambahkan Kategori Baru');
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
        $kategori = Category::where('id', $id)->first();
        return view('Category.edit', compact('kategori'));
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
            'name' => 'required|unique:categories'
        ],[
            'name.required' => 'Wajib Diisi',
            'name.unique' => 'Kategori Telah Ada'
        ]); 

            Category::where('id', $id)->update($validatedData);
            return redirect()->route('category.index')->with('success', 'Berhasil Update Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('category.index')->with('success', 'Berhasil Menghapus Data');
    }

    public function getDataModal(Category $category) {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Category',
            'data'    => $category  
        ]); 
    }
}
