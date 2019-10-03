<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Entities\Product;
use Modules\Admin\Entities\ProductBrand;
use Modules\Admin\Entities\ProductCategory;
use Modules\Admin\Http\Requests\StoreProductRequest;
use Sentinel;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the product resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        return view('admin::product-category.index')->with([
            'panel' => [
                'name' => __('admin::admin.Product Category')
            ]
        ]);
    }

    /**
     * Datatables server side rendering
     * @return mixed
     */
    public function datatable(){
        $productCategories = ProductCategory::query();
        $datatables = Datatables::of($productCategories);

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
        return view('admin::product-category.quick_create' , compact(''));
    }

    /**
     * Store Product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(StoreProductRequest $request){
        try {
            $product = ProductCategory::create($request->all());
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
    public function edit(ProductCategory $productCategory){
        return view('admin::product-category.edit', compact('productCategory'));
    }

    /**
     * Update Product
     * @return mixed
     */
    public function update(StoreProductRequest $request, ProductCategory $productCategory){
        try {
            $productCategory->update($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }

        $productCategory = ProductCategory::find($productCategory->id);
        return response()->json([
            'success' => true,
            'newData' => $productCategory
        ]);
    }

    /**
     * Delete Product
     * @return mixed
     */
    public function delete(ProductCategory $productCategory){

        $productCategory->delete();

        return response()->json([
            'success' => 'success',
        ]);
    }

}
