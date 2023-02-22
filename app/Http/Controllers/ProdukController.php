<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public  function index()
    {
        $produk = Produk::orderBy('id', 'DESC')->get();

        return view('app')->with([
            'produks' => $produk
        ]);
    }

    public function tamabahProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ]);

        $newProduk = new Produk([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        $newProduk->save();

        return redirect()->back()->with('success', 'Berhasil Menambahakan Data Baru.');
    }

    public function edit($id)
    {
        return Produk::find($id);
    }

    public function updateProduk($id, Request $request)
    {
        $produk = Produk::find($id);
        $produk->update($request->except(['_token','submit']));    

        return redirect()->back()->with('success', 'Berhasil Perbaharui Data.');
    }

    public function deleteProduk($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data.');
    }
}
