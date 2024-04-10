@extends('layout.dashboard')
@section('title', 'Pembelian')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Stok</h1>
    </div>
</section>
@if (session('success'))
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b>Success:</b>
        {{ session('success') }}
    </div>
</div>
@endif
@if (session('fail'))
<div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b>Fail:</b>
        {{ session('fail') }}
    </div>
</div>
@endif
@if (session('err'))
<div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b>Error:</b>
        {{ session('err') }}
    </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="customer_name">Customer <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="customer_name" id="customer_name">
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="number">Number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="number" id="number">
                        </div>
                        <div class="form-group col-md-12 col-12">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


            <div class="card">
                <div class="card-body p-4">
                    <h5 class="text-dark">Produk</h5>
                    <div id="productInputs">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="product">Select Product</label>
                                <select class="form-control" name="product[]" id="product">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->code }}">{{ $product->namaProduk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="jumlah">Jumlah</label>
                                <input class="form-control" type="text" name="jumlah[]" required>
                            </div>
                            <div class="form-group col-12">
                                <button type="button" class="btn btn-danger" onclick="removeProductInput(this)">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-info add-product"> + Add Product</button>
                        <button type="submit" class="btn btn-success ml-1 add-product"> Submit </button>
                    </div>
                </div>
            </div>
        </div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productInputs = document.getElementById('productInputs');
        const addProductButton = document.querySelector('.add-product');
        const cancelProductButtons = document.querySelectorAll('.cancel-product');

        addProductButton.addEventListener('click', function() {
            const newRow = productInputs.firstElementChild.cloneNode(true);
            productInputs.appendChild(newRow);
        });

        cancelProductButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (productInputs.children.length > 1) {
                    productInputs.removeChild(button.parentNode.parentNode);
                }
            });
        });
    });
</script>

@endsection

@section('scripts')
<script>
    function addProductInput() {
        var productInputs = document.getElementById('productInputs');
        var newProductInputs = productInputs.cloneNode(true); // Clone the entire div with id "productInputs"
        productInputs.parentElement.appendChild(newProductInputs); // Append the cloned div to its parent
        newProductInputs.querySelectorAll('input').forEach(function(input) {
            input.value = ''; // Clear input values in the cloned div
        });
    }

    function removeProductInput(button) {
        var card = button.closest('.row');
        card.remove();
    }
</script>
@endsection