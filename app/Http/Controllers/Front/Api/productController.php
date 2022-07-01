<?php

namespace App\Http\Controllers\Front\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function childrenRecursive()
    {
        return $this->childs()->with('childrenRecursive');
    }


    public function index(Request $request)
    {
        $perData = 3; // Bir dəfəyə gələcək max data miqdarı
        $products = Product::where('status', 0); // Aktiv məhsulların gətirilməsi

        if ($request->id) {
            $products->whereIn('id', $request->id); // Məhsulun adına görə axtarış
        }

        if ($request->search) {
            $products->where('title', 'LIKE', '%%' . $request->search . '%%'); // Məhsulun adına görə axtarış
        }

        if ($request->category) {
            $category = Category::where('id', $request->category)->first();

            if ($category) {
                $products->whereIn('category', $category->descendantsAndSelf($category->id)->pluck('id'));
            } else {
                $products->whereIn('category', $category->descendantsAndSelf($category->id)->pluck('id'));
            }
        }

        if ($request->size) {
            // Databazada olan bütün modellər üzrə model parametri üzrə axtarış edib tapılan nəticələrdəki
            // idləri götürüb product idsi ilə equal olub olmadığını yoxlayır
            $productModels = ProductModel::whereIn('slug', $request->size)->pluck('productId');
            $products->whereIn('id', $productModels); // $productModels dəyişənində tapılan idləri products tablesində product id olaraq search edir
        }

        if ($request->min) {
            $products->where('price', '>=', $request->min);
        }

        if ($request->max) {
            $products->where('price', '<=', $request->max);
        }

        $paginate = $products->paginate($perData);
        $products = $products->paginate($perData)->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'content' => $product->content,
                'thumb' => $product->thumb,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'slug' => $product->slug,
                'status' => $product->status,
                'url' => ($product->getCategory->ancestors->map(function ($li) {
                    return '/' . $li->slug;
                })),
                'category' => $product->getCategory, // Məhsulun aid olduğu kategoriyanı gətirir
                'models' => $product->getModels->map(function ($model) {
                    return [
                        'id' => $model->id,
                        'title' => $model->title,
                        'slug' => $model->slug,
                        'content' => $model->content
                    ];
                }), // Məhsula aid olan modelləri gətirir
                'colors' => $product->getColors->map(function ($color) {
                    return [
                        'id' => $color->id,
                        'title' => $color->title,
                        'slug' => $color->slug,
                        'hex' => $color->hex,
                    ];
                })
            ];
        });
        // dd($paginate);

        return response(json_encode(['result' => $products, 'perPage' => $paginate->perPage(), 'onEachSide' => $paginate->onEachSide]), 200)->header('Content-Type', 'text/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 0)->first();
        $product->models = $product->getModels->map(function ($model) {
            return [
                'id' => $model->id,
                'title' => $model->title,
                'slug' => $model->slug,
                'content' => $model->content,
                'status' => $model->status
            ];
        });

        $product->gallery = $product->getGalleries->map(function ($model) {
            return [
                'id' => $model->id,
                'src' => $model->src,
                'thumb' => $model->thumb,
                'status' => $model->status
            ];
        });



        $product->colors = $product->getColors->map(function ($color) {
            return [
                'id' => $color->id,
                'title' => $color->title,
                'slug' => $color->slug,
                'hex' => $color->hex,
            ];
        });

        return response($product, 200)->header('Content-Type', 'text/json');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
