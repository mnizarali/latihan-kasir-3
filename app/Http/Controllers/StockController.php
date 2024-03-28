<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\stockLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function createStock (Request $request){
        $request->validate([
            "namaProduk" => 'required',
            "harga"      => 'required',
            "stock"      => 'required'
        ]);

        dd($request);
        
        $now = Carbon::now();
        $yearMonthDay = $now->format('y') . $now->format('m') . $now->format('d');
        $producutCount = Stock::count();
        $code = false;

        if ($producutCount == 0) {
            $code = "P".$yearMonthDay."1";
        } else {
            $code = "P" . $yearMonthDay . ($producutCount + 1);
        }   

        $product = Stock::create([
            "product_name" => $request->product_name,
            "price" => $request->price,
            "stock" => $request->stock,
            "code" => $code
        ]);

        stockLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'total_stock' => $product->stock,
            'description' => $request->description
        ]);

        return back()->with("success", "Berhasil menambah Product baru");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "product_name" => "required",
            "price" => "required",
            // "stock" => "required"
        ]);

        $stock = Stock::find($id);
        $stock->update([
            "product_name" => $request->product_name,
            "price" => $request->price,
            // "stock" => $request->stock
        ]);
        return back()->with("success", "Berhasil merubah Produck");
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            "stock" => "required"
        ]);

        if ($request->stock < 1) {
            return back()->with("err", "Gagal, isi input stock dengan benar!");
        }
        $stock = Stock::find($id);
        $stock->update([
            "stock" => $stock->stock + $request->stock
        ]);

        stockLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $stock->id,
            'total_stock' => $request->stock,
            'description' => $request->description
        ]);


        return back()->with("success", "Berhasil menambah Stock baru");
    }
}
