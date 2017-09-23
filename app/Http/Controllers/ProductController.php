<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    protected $products = [];

    public function __construct() {
        $this->products = json_decode(file_get_contents(app_path('Models/products.json')), true);
    }

    public function show() {
        $total = array_reduce($this->products, function ($carry, $item) {
            $carry += $item['quantity'];
            return $carry;
        });

        return view('products', ['products' => $this->products, 'total' => $total]);
    }

    public function createProduct(StoreProductRequest $request) {
        $product = $request->all();
        $product['dateTime'] = time();
        $this->products[] = $product;
        file_put_contents(app_path('Models/products.json'), json_encode($this->products));

        return response()->json($product);
    }

    public function updateProduct(UpdateProductRequest $request, $id) {
        $data = $request->all();

        $this->products = array_map(function (&$product) use($data, $id) {
            if ((int)$product['dateTime'] === (int)$id) {
                $product[array_keys($data)[0]] = array_values($data)[0];
            }

            return $product;
        }, $this->products);

        file_put_contents(app_path('Models/products.json'), json_encode($this->products));

        return response()->json([]);
    }

    public function removeProduct($id) {
        $this->products = array_filter($this->products, function ($product) use ($id) {
            return (int)$product['dateTime'] !== (int)$id;
        });

        file_put_contents(app_path('Models/products.json'), json_encode($this->products));

        return response('', 204);
    }
}
