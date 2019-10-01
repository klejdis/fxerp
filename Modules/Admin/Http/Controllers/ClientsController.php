<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Modules\Admin\Entities\Client;
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
    public function generalInfoTab(Request $request, User $user){
        $roles = Role::pluck('name', 'id');
        $activate = (Activation::completed($user)) ? true : false;

        return View::make('admin::users.general-info',compact('user','roles','activate'))->render();
    }

    /**
     * Show the specified tab.
     * @return mixed
     */
    public function changePasswordTab(Request $request,  User $user){
        return View::make('admin::users.change-password-tab', compact('user'))->render();
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
    public function edit(User $user, PermissionRepository $permissionRepository){
        $roles = Role::pluck('name', 'id');
        $permissions = $permissionRepository->getPermissionsGroupped();
        $activate = (Activation::completed($user)) ? true : false;
        $selected_permissions = collect($user->getPermissions())->map(function($p,$k){
            return $k;
        });

        return view('admin::users.edit', compact('user','roles','permissions','activate','selected_permissions'));
    }

    public function quickUpdate(UpdateUserRequest $request, User $user){

        $activate = $request->has('activate') ? true : false;

        $user->update($request->except(['password', 'password_confirmation']));

        $user->roles()->sync($request->roles);

        if ($request->permissions) {
            $user->permissions = $this->permissionRepository->getPermissionsFromGroup($request->permissions);
            $user->save();
        }

        if ($request->password) {
            Sentinel::update($user , $request->only('email','password'));//if password changes
        }

        if ($activate == true){
            $user_activation = Activation::where('user_id',$user->id)->first();
            /*dd($user_activation);*/
            if ($user_activation){
                $user_activation->completed = true;
                $user_activation->update();
            }else{
                $activation = Activation::create($user);
                $complete = Activation::complete($user, $activation->code);
                if ($complete){
                    $activation = Activation::completed($user);
                }
            }
        }else if ($activate == false){
            $user_activation = Activation::where('user_id',$user->id)->first();
            if ($user_activation){
                $user_activation->completed = 0;
                $user_activation->update();
            }
        }

        return response()->json([
            'success' => true,
            'newData' => $user
        ]);
    }

    /**
     * Update user
     * @return Response
     */
    public function update(UpdateUserRequest $request, User $user){
        $activate = $request->has('activate') ? true : false;

        $user->update($request->except(['password', 'password_confirmation']));

        $user->roles()->sync($request->roles);

        if ($request->permissions) {
            $user->permissions = $this->permissionRepository->getPermissionsFromGroup($request->permissions);
            $user->save();
        }

        if ($request->password) {
            Sentinel::update($user , $request->only('email','password'));//if password changes
        }

        if ($activate == true){
            $user_activation = Activation::where('user_id',$user->id)->first();
            /*dd($user_activation);*/
            if ($user_activation){
                $user_activation->completed = true;
                $user_activation->update();
            }else{
                $activation = Activation::create($user);
                $complete = Activation::complete($user, $activation->code);
                if ($complete){
                    $activation = Activation::completed($user);
                }
            }
        }else if ($activate == false){
            $user_activation = Activation::where('user_id',$user->id)->first();
            if ($user_activation){
                $user_activation->completed = 0;
                $user_activation->update();
            }
        }

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
            $user = User::find($request->input('id'));
            $user->delete();
        }

        return response()->json([
            'success' => 'success',
        ]);
    }
}
