<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Stock;
use App\Models\stockLog;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    /// Dashboard - dashboard information
    public function index()
    {
        $countUser = User::count();
        return view('pages.dashboard', compact("countUser"));
    }
    /// Dashboard - User
    public function user()
    {
        $userAccounts = User::paginate(10);
        return view('pages.user.index', compact("userAccounts"));
    }

    public function register()
    {
        return view("auth.register");
    }
    // User edit data
    public function editUser($id)
    {
        $user = User::find($id);
        return view('pages.user.edit', compact('user'));
    }
    // Create user (admin)
    public function addUser(Request $request)
    {
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
    // Update user
    public function updateUser(Request $request, $id)
    {
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
    // Delete user
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
    /// Dashboard - Produk/stock
    public function viewProduk()
    {
        $stock = Stock::paginate(10);
        return view("page.stock");
    }
    // Dashboard - View Stock 
    public function viewStock()
    {
        $stockList = Stock::paginate(10);
        return view("pages.stock.index", compact('stockList'));
    }
    // Create stock (post)
    public function createStock(Request $request)
    {
        $request->validate([
            "namaProduk" => "required",
            "harga" => "required",
            "stok" => "required"
        ]);

        $now = Carbon::now();
        $yearMonthDay = $now->format('y') . $now->format('m') . $now->format('d');
        $producutCount = Stock::count();
        $kode = false;

        if ($producutCount == 0) {
            $kode = "P" . $yearMonthDay . "1";
        } else {
            $kode = "P" . $yearMonthDay . ($producutCount + 1);
        }

        $product = Stock::create([
            "namaProduk" => $request->namaProduk,
            "harga" => $request->harga,
            "stok" => $request->stok,
            "kode" => $kode
        ]);

        return back()->with("success", "Berhasil menambah Product baru");
    }
    // Update stock - edit jumlah stock dan deskripsi
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            "stok" => "required"
        ]);

        if ($request->stok < 1) {
            return back()->with("err", "Gagal, isi input stock dengan benar!");
        }
        $stock = Stock::find($id);

        if ($request->status === 'out' && $request->stok > $stock->stok) {
            return back()->with("err", "Gagal, stock barang hanya sebanyak $stock->stok");
        }

        if ($request->status === 'in') {
            $stock->update([
                "stok" => $stock->stok + $request->stok
            ]);
        } else {
            $stock->update([
                "stok" => $stock->stok - $request->stok
            ]);
        }

        stockLog::create([
            'user_id' =>  Auth::user()->id,
            'product_id' => $stock->id,
            'total_stock' => $request->stok,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return back()->with("success", "Berhasil menambah Stock baru");
    }
    // Edit stock untuk edit nama produk atau harga produk
    public function editStock(Request $request, $id)
    {
        $request->validate([
            "namaProduk" => "required",
            "harga" => "required",
        ]);

        $stock = Stock::find($id);
        $stock->update([
            "namaProduk" => $request->namaProduk,
            "harga" => $request->harga,
        ]);

        return back()->with("success", "Berhasil merubah Produck");
    }
    // Dashboard / stock / history
    public function getHistoryStock()
    {
        $historys = stockLog::with(['user', 'stock'])->get();

        return view('pages.stock.history', compact('historys'));
    }
    // Dashboard - Pembelian
    public function getPembelian()
    {
        $products = Stock::all();
        return view('pages.pembelian.index', compact('products'));
    }
    // Create confirm payment session
    public function confirmPayment(Request $request)
    {
        $products = [];
        $kodes = $request->kode;
        $qtys = $request->jumlah;

        foreach ($kodes as $index => $kode) {
            $products[] = [
                "kode" => $kode,
                "qty" => $qtys[$index]
            ];
        }

        $kodeSearch = array_column($products, 'kode');
        $produks = Stock::whereIn('kode', $kodeSearch)->get();

        $errorMessage = [];

        foreach ($products as $product) {
            $locate = false;
            foreach ($produks as $produk) {
                if ($product['kode'] == $produk->kode) {
                    $locate = true;
                    if ($product['qty'] > $produk->stok) {
                        $errorMessage[] = "Stok barang " . $produk->namaProduk . "tidak mencukupi";
                    }
                    break;
                }
            }
            if (!$locate) {
                $errorMessage[] = $product["kode"];
            }
        }

        if (!empty($errorMessage)) {
            return back()->with('fail', $errorMessage);
        }

        $nama   = $request->nama;
        $telp   = $request->telp;
        $alamat = $request->alamat;
        session([
            "produk" => $products,
            "pelanggan" => [
                "nama"    => $nama,
                "telp"    => $telp,
                "alamat"  => $alamat
            ]
        ]);

        return view('pages.pembelian.confirmPayment', compact([
            "nama",
            "telp",
            "alamat",
            "products",
            "produks"
        ]));
    }

    public function pdfInvoice()
{
    $products = session("produk");
    $kodeSearch = array_column($products, 'kode');
    $items = Stock::whereIn('kode', $kodeSearch)->get();
    $total_price = 0;

    foreach ($items as $item) {
        foreach ($products as $product) {
            if ($product["kode"] == $item->kode) {
                $price = $product["qty"] * $item->harga;
                $total_price += $price;
            }
        }
    }

    $customers = session("pelanggan");
    $nama = $customers['nama'];
    $alamat = $customers['alamat'];
    $telp = $customers['telp'];

    return view('pages.pembelian.invoice', compact([
        "nama",
        "alamat",
        "telp",
        "products",
        "items",
        "total_price" 
    ]));
}

public function backToPembelian()
{
    $products = session("produk");
    $kodeSearch = array_column($products, 'kode');
    $items = Stock::whereIn('kode', $kodeSearch)->get();
    $total_price = 0;

    $customers = session("pelanggan");
    $nama = $customers['nama'];
    $alamat = $customers['alamat'];
    $telp = $customers['telp'];
    $customer = Pelanggan::create([
        "nama" => $nama,
        "telp" => $telp,
        "alamat" => $alamat
    ]);

    $penjualan = Penjualan::create([
        "id_pelanggan" => $customer->id,
        "tanggal" => now(),
        "harga_total" => $total_price,
        "id_user" => auth()->user()->id
    ]);

    foreach ($items as $item) {
        foreach ($products as $product) {
            if ($product["kode"] == $item->kode) {
                DetailPenjualan::create([
                    'id_penjualan' => $penjualan->id,
                    'id_stock' => $item->id,
                    'kuantitas' => $product["qty"],
                    'subtotal' => $item->harga * $product["qty"]
                ]);

                $productUpdate = Stock::find($item->id);
                $stock = $productUpdate->stok - $product["qty"];
                $productUpdate->update([
                    "stok" => $stock
                ]);

                stockLog::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $item->id,
                    'total_stock' => $product["qty"],
                    'status' => "out"
                ]);
            }
        }
    }

    return redirect('/dashboard/pembelian')->with('success', 'transaksi berhasil');
}



}
