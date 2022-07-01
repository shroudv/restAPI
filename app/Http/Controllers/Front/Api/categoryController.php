<?php

namespace App\Http\Controllers\Front\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $categories=Category::whereNull('parent_id')->where('status',0)->get()->map(function($category){
        //     return [
        //         'id'=>$category->id,
        //         'title'=>$category->title,
        //         'content'=>$category->content,
        //         'icon'=>$category->icon,
        //         'slug'=>$category->slug,
        //         'status'=>$category->status,
        //         'children'=>$category->descendants 
        //     ];
        // });
        if ($request->type == 'tree') {
            $categories = Category::where('status', 0)->get()->toTree();
        } else {
            $categories = Category::where('status', 0)->get();
        }
        return response($categories, 200)->header('Content-Type', 'text/json');
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
        $category = Category::where('slug', $slug)->where('status', 0)->first();
        return response($category, 200)->header('Content-Type', 'text/json');
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
