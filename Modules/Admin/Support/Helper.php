<?php

namespace Modules\Admin\Support;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;
use Sentinel;

class Helper{

    /**
     * Get Previous Route
     *
     * @return Route
     */
    public static function getPreviusRoute(){
        return app('router')->getRoutes()->match(app('request')->create(URL::previous()));
    }

    /**
     * Get Previous Request
     *
     * @return Route
     */
    public static function getPreviusRequest(){
        return app('request')->create(URL::previous());
    }

    /**
     * Get Timezones
     * @return array
     */
    public static function getTimezones(){
        $tzlist = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $timezone_dropdown = [];

        foreach ($tzlist as $zone) {
            $timezone_dropdown[$zone] = $zone;
        }

        return $timezone_dropdown;
    }


}
