<?php

namespace Modules\Admin\Http\Controllers;

use DemeterChain\C;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Modules\Admin\Entities\Client;
use Modules\Admin\Entities\Product;
use Modules\Admin\Entities\Role;
use Modules\Admin\Entities\User;
use Modules\Admin\Http\Requests\StoreClientRequest;
use Modules\Admin\Http\Requests\StoreUserRequest;
use Modules\Admin\Http\Requests\UpdateUserRequest;
use Modules\Admin\Repositories\PermissionRepository;
use Sentinel;
use Activation;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    /**
     * Display a listing of the Client resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin::clients.index')->with([
            'panel' => [
                'name' => __('admin::admin.Clients')
            ]
        ]);
    }

    /**
     * Datatables server side rendering
     * @return mixed
     */
    public function datatable(){
        $clients = Client::query();
        $datatables = DataTables::of($clients);

        //EDIT COLUMNS
        $datatables->editColumn('created_at',function($client){ return Carbon::parse($client->created_at)->format(getDateTimeFormat()); });

        return $datatables->rawColumns(['actions'])->make();
    }

    /**
     * Show the specified resource.
     * @return mixed
     */
    public function show(Client $client){
        return view('admin::clients.show', compact('client'));
    }

    /**
     * Show the specified tab.
     * @return mixed
     */
    public function generalInfoTab(Request $request, Client $client){
        return View::make('admin::clients.general-info',compact('client'))->render();
    }

    /**
     * Show the specified tab.
     * @return mixed
     */
    public function products(Request $request, Client $client){
        return View::make('admin::clients.products',compact('client'))->render();
    }

    /**
     * Show the specified tab.
     * @return mixed
     */
    public function productsDatatable(Request $request, Client $client){
        $products = Product::query()->whereHas('client',function ($q) use ($client){
            return $q->where('id', $client->id);
        });
        $datatables = Datatables::of($products);

        //EDIT COLUMNS
        $datatables->editColumn('created_at',function($product){ return Carbon::parse($product->created_at)->format(getDateTimeFormat()); });

        //FILTERS
        return $datatables->rawColumns(['actions'])->make();
    }

    /**
     * Users quick create modal
     * @return mixed
     */
    public function create(Request $request){
        return View::make('admin::clients.quick-create')->render();
    }

    /**
     * Store user
     * @return Response
     */
    public function store(StoreClientRequest $request){
        try{
            $client = Client::create($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong'
            ]);
        }

        return response()->json([
            'success' => true,
            'newData' => $client
        ]);
    }

    /**
     * Edit user
     * @return mixed
     */
    public function edit(Client $client){
        return view('admin::clients.edit', compact('client'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function quickUpdate(StoreClientRequest $request, Client $client){
        try{
            $client->update($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong'
            ]);
        }

        $client = Client::find($client->id);

        return response()->json([
            'success' => true,
            'newData' => $client
        ]);
    }

    /**
     * Update Client
     * @return Response
     */
    public function update(StoreClientRequest $request, Client $client){
        try{
            $client->update($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong'
            ]);
        }

        $client = Client::find($client->id);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Delete user
     * @return Response
     */
    public function delete(Request $request){

        if ($request->input('id')){
            $client = Client::find($request->input('id'));
            $client->delete();

            return response()->json([
                'success' => 'success',
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
