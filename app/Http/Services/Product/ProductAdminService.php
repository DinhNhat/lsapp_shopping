<?php

namespace App\Http\Services\Product;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    protected function isValidPrice($request)
    {
        $price = (int) $request->input('price');
        $priceSale = (int) $request->input('price_sale');
        if ($price  !== 0 && $priceSale !== 0 && $priceSale >= $price) {
            Session::flash('error', 'Sale price must be less than the original price.');
            return false;
        }

        if ($request->input('price_sale') !== 0 && (int)$request->input('price') === 0) {
            Session::flash('error', 'Please enter original price');
            return false;
        }

        return true;
    }

    public function insert($request)
    {
//        dd($request);
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $request->except('_token');
            Product::create($request->all());

            Session::flash('success', 'Store a product with success!!!');
        } catch (\Exception $err) {
            Session::flash('error', 'Store a product failed');
            \Log::info($err->getMessage());
            return  false;
        }

        return  true;
    }

    public function get()
    {
        return Product::with('menu')
            ->orderByDesc('id')->paginate(15);
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Update product successfully!');
        } catch (\Exception $err) {
            Session::flash('error', 'Update product failed. Please try again!!!');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }
}
