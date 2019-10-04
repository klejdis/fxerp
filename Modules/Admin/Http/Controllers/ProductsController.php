<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\View;
use Modules\Admin\Entities\Client;
use Modules\Admin\Entities\Product;
use Modules\Admin\Entities\ProductBrand;
use Modules\Admin\Entities\ProductCategory;
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

        $clients = Client::all()->map(function ($c){
            return ['id' => $c->id , 'text' => $c->fullName];
        });

        $clients_filter = ['name' => 'client_id' , 'class' => 'w200', 'options' => array_prepend($clients->toArray(),['id'=>'','text'=>'-Client-'])];

        return view('admin::products.index', compact('clients','clients_filter'))->with([
            'panel' => [
                'name' => __('admin::admin.Products')
            ],
        ]);
    }

    /**
     * Datatables server side rendering
     * @return mixed
     */
    public function datatable(Request $request){
        $products = Product::query();

        if($request->input('client_id')){
            $products->whereHas('client',function ($q) use ($request){
                $q->where('id',$request->input('client_id'));
            });
        }

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
        $clients = Client::all()->pluck('first_name', 'id');
        $productCategories = ProductCategory::all()->pluck('name', 'id');
        $productBrands = ProductBrand::all()->pluck('name', 'id');

        return view('admin::products.quick_create' , compact('clients', 'productBrands', 'productCategories'));
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
                'message' => $exception->getMessage()
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
        $clients = Client::all()->pluck('first_name', 'id');
        $productCategories = ProductCategory::all()->pluck('name', 'id');
        $productBrands = ProductBrand::all()->pluck('name', 'id');

        return view('admin::products.edit', compact('product','clients', 'productBrands', 'productCategories'));
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
