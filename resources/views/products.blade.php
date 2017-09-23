@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mx-auto">
        <form id="productForm">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" name="name" class="form-control" id="productName" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="productQuantity">Product Quantity</label>
                <input type="text" name="quantity" class="form-control" id="productQuantity" placeholder="Enter quantity">
            </div>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
            </div>
        </form>
    </div>
</div>
<div class="row products">
    @foreach($products as $product)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto product" data-id="{{ $product['dateTime'] }}">
            <div class="row pb-4">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 field"
                     contenteditable="true"
                     data-name="name"
                     role="input"
                     data-id="{{ $product['dateTime'] }}">{{ $product['name'] }}</div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 field"
                     contenteditable="true"
                     data-name="quantity"
                     data-id="{{ $product['dateTime'] }}">{{ $product['quantity'] }}</div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 field"
                     contenteditable="true"
                     data-name="price"
                     data-id="{{ $product['dateTime'] }}">{{ $product['price'] }}</div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <button class="btn btn-danger d-inline deleteBtn" data-id="{{ $product['dateTime'] }}">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row text-center">
    <p>
        <strong>Total: </strong> {{ $total }}
    </p>
</div>
@endsection