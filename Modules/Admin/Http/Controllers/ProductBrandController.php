<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\View;
use Modules\Admin\Entities\Product;
use Modules\Admin\Entities\ProductBrand;
use Modules\Admin\Http\Requests\StoreProductRequest;
use Sentinel;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the product resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        return view('admin::product-brand.index')->with([
            'panel' => [
                'name' => __('admin::admin.Product Brand')
            ]
        ]);
    }

    /**
     * Datatables server side rendering
     * @return mixed
     */
    public function datatable(){
        $productBrands = ProductBrand::query();
        $datatables = Datatables::of($productBrands);

        //EDIT COLUMNS
        $datatables->editColumn('created_at',function($product){ return Carbon::parse($product->created_at)->format(getDateTimeFormat()); });

        //FILTERS
        return $datatables->rawColumns(['actions'])->make();
    }

    /**
     * Quick Create Product Modal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quickCreate(Request $request){
        return view('admin::product-brand.quick_create' , compact(''));
    }

    /**
     * Store Product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(StoreProductRequest $request){

        try {
            $product = ProductBrand::create($request->all());
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
    public function edit(ProductBrand $productBrand){
        return view('admin::product-brand.edit', compact('productBrand'));
    }

    /**
     * Update Product
     * @return mixed
     */
    public function update(StoreProductRequest $request, ProductBrand $productBrand){
        try {
            $productBrand->update($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }

        $productBrand = ProductBrand::find($productBrand->id);
        return response()->json([
            'success' => true,
            'newData' => $productBrand
        ]);
    }

    /**
     * Delete Product
     * @return mixed
     */
    public function delete(ProductBrand $productBrand){

        $productBrand->delete();

        return response()->json([
            'success' => 'success',
        ]);
    }

}
