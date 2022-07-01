<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class fTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



       

        // $product = new Product();
        // $product->title = 'Honor Choice Earbuds X (ALD-00) Night Black';
        // $product->content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,";
        // $product->brand = 'Honor';
        // $product->price = 99.99;
        // $product->quantity = 20;
        // $product->slug = Str::slug($product->title).'-'.rand(1000,99999);
        // $product->category = 43;
        // $product->thumb = 'https://irshad.az/resized/fit540x550/center/products/76603/1858.jpg';
        // $product->save();

        $gallery=ProductGallery::create([
            'src'=>'https://irshad.az/resized/fit540x550/center/products/76603/58585.jpg',
            'thumb'=>'https://irshad.az/resized/fit540x550/center/products/76603/58585.jpg',
            'productId'=>9, 
        ]);

        // $arr = [];

        // foreach ($arr as $ar) {
        //     $category = new Category();
        //     $category->title = $ar;
        //     $category->content = 'asas';
        //     $category->icon = '';
        //     $category->slug = Str::slug($category->title) . '-' . rand(100, 999);
        //     $category->parent_id='4';
        //     $category->save();
        // }
    }
}
