<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Invoice - {{ now( )}}</title>
  <link rel="stylesheet" href="{{ asset('css/invoice.css')}}" media="all" />
</head>

<body>
  <header class="clearfix">
    <h1>Cashier invoice </h1>
    <div id="company" class="clearfix">
      <div>Toko Cashier</div>
      <div>STAFF : {{ auth()->user()->name}}</div>
    </div>
    <div id="project">
      <div><span>ClIENT :</span> {{ $nama}}</div>
      <div><span>ADDRESS :</span> {{ $alamat}}</div>
      <div><span>PHONE :</span> {{ $telp}}</div>
      <div><span>DATE : </span> {{ now()->format('d-m-Y')}}</div>
    </div>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <th class="no">NO</th>
          <th class="product">DESCRIPTION</th>
          <th>PRICE</th>
          <th>QTY</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        @php
        $total_price = 0;
        @endphp
        @foreach($items as $item)
          @foreach ($products as $product)
            @if ($product["kode"] == $item->kode)
            <tr>
              <td class="no">{{ $loop->iteration }}</td>
              <td class="product">{{ $item->namaProduk }}</td>
              <td class="unit">{{ $item->harga }}</td>
              <td class="qty">{{ $product["qty"] }}</td> <!-- Display the quantity -->
              <td class="total">{{ $item->harga * $product["qty"] }}</td>
            </tr>
            @php
                $price = $product['qty'] * $item->harga;
                $total_price += $price; // Accumulate the total price correctly
                @endphp
            @endif
          @endforeach
        @endforeach
        <tr>
          <td colspan="4" class="grand total">GRAND TOTAL</td>
          <td class="grand total"> Rp{{ number_format($total_price, 2, ',', '.') }}</td>
        </tr>
      </tbody>
    </table>
  </main>
  <footer>
    Invoice ini valid walau tanpa tanda tangan.
  </footer>
  <script>
    window.onload = function() {
      window.print();
      setTimeout(function() {
        window.close();
      }, 3000);
    }

    window.onafterprint = function() {
      window.close();
    }

    window.onbeforeunload = function() {
      window.close();
    }
  </script>
</body>

</html>