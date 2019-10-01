<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\View;
use Modules\Admin\Entities\Product;
use Modules\Admin\Http\Requests\StoreProductRequest;
use Sentinel;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the product resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        return view('admin::products.index')->with([
            'panel' => [
                'name' => __('admin::admin.Products')
            ]
        ]);
    }

    /**
     * Datatables server side rendering
     * @return mixed
     */
    public function datatable(){
        $products = Product::query();
        $datatables = Datatables::of($products);

        //EDIT COLUMNS
        $datatables->editColumn('created_at',function($product){ return Carbon::parse($product->created_at)->format(getDateTimeFormat()); });

        //FILTERS
        return $datatables->rawColumns(['actions'])->make();
    }

    /**
     * @param Request $request
     * @param Product $product
     */
    public function show(Request $request, Product $product){
        return view('admin::products.show', compact('product'));
    }

    /**
     * Show the specified tab.
     * @return mixed
     */
    public function generalInfoTab(Request $request, Product $product){
        return View::make('admin::products.general-info',compact('product'))->render();
    }

    /**
     * Quick Create Product Modal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quickCreate(Request $request){
        return view('admin::products.quick_create' , compact(''));
    }

    /**
     * Store Product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(StoreProductRequest $request){

        try {
            $product = Product::create($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }

        return response()->json([
           'success' => true,
            'newData' => $product
        ]);
    }

    /**
     * Edit Product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product){

        return view('admin::products.edit', compact('product'));
    }

    /**
     * Update Product
     * @return mixed
     */
    public function update(StoreProductRequest $request, Product $product){

        try {
            $product->update($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }

        $product = Product::find($product->id);
        return response()->json([
            'success' => true,
            'newData' => $product
        ]);
    }

    /**
     * Delete Product
     * @return mixed
     */
    public function delete(Product $product){

        $product->delete();

        return response()->json([
            'success' => 'success',
        ]);
    }

}
