<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\stockLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboarController extends Controller
{
    public function index(){
        $countUser = User::count();
        return view('pages.dashboard', compact("countUser"));
    }

    // User
    public function user(){
        $userAccounts = User::paginate(10);
        return view('pages.user.index', compact("userAccounts"));
    }

    public function editUser($id){
        $user = User::find($id);
        return view('pages.user.edit', compact('user'));
    }

    public function addUser(Request $request) {
        $request->validate([
            "name" => 'required',
            "username" => 'required',
            "email" => 'required|email',
            "password" => 'required',
            "role" => 'required' 
        ]);
    
        $user = User::create([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => strtoupper($request->role) 
        ]);
    
        return redirect('/dashboard/user')->with('success');
    }

    public function updateUser(Request $request, $id) {
        $user = User::find($id);
        
        $request->validate([
            "name" => 'required',
            "username" => 'required',
            "email" => 'required|email',
            "password" => 'required',
            "role" => 'required' 
        ]);

        $user->update([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => strtoupper($request->role) 
        ]);

        return redirect('/dashboard/user')->with('success', 'Data berhasil ditambahkan');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return back()->with('success', 'User deleted successfully.');
        } else {
            return back()->route('dashboard.dataUser')->with('error', 'User not found.');
        }
    }

    public function viewProduk() {
        $stock = Stock::paginate(10);
        return view("page.stock");
    }

    // stock

    public function viewStock() {
        $stockList = Stock::paginate(10);
        return view("pages.stock.index", compact('stockList'));
    }

    public function createStock(Request $request) {
        $request->validate([
            "product_name" => "required",
            "price" => "required",
            "stock" => "required"
        ]);

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

}
