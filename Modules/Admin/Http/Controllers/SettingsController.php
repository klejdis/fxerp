<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    /**
     * @param null $tab
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($tab = null ){

        if ($tab == null || $tab == 'general'){

            $languages = Config::get('admin.langs');

            $logo_src = getPublicUrlFromPath(Setting::get('app-logo'));

            return view('admin::settings.general' , compact('languages', 'logo_src'));
        }

        if ($tab == 'auth'){
            return view('admin::settings.auth');
        }

        if ($tab == 'service'){
            return view('admin::settings.services');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        foreach ($request->except(['_token']) as $key => $value){

            switch ($key) {
                case 'activation-type':
                    Setting::set($key ,
                        [
                            'default'  => 'email',
                            'selected' => $value,
                            'options'  => [
                                'email' => 'Email',
                                'manual' => 'Manual'
                            ]
                        ]);
                    break;

                case 'app-logo':
                    if ($request->input($key)){
                        $path =  $this->_saveLogo($request->input($key));
                        Setting::set($key , $path);
                    }
                    break;

                default:
                    Setting::set($key , $value);
                    break;
            }
        }

        return redirect()->back()->with([
            'success_message' => 'Saved Succesfully'
        ]);
    }

    /**
     * @param null $base64_str
     * @return string
     */
    protected function _saveLogo($base64_str = null){
        //decode base64 string
        $image = getBase64ImageFromRequest($base64_str);

        $save_dir = 'admin/images/';

        $image_name = 'logo.png';

        Storage::disk('public')->put($save_dir.$image_name, $image);

        $path = $save_dir.$image_name;

        return $path;
    }

}
