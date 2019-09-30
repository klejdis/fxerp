<?php

namespace Modules\Admin\Http\Middleware;

use Modules\Admin\Entities\Presenters\AdminMenuPresenter;
use Modules\Admin\Events\AdminMenuCreated;
use Nwidart\Menus\Facades\Menu;
use Sentinel;
use Closure;
use Illuminate\Http\Request;

class AdminMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
           // Setup the admin menu
           Menu::create('AdminMenu', function ($menu) {

               $menu->setPresenter(AdminMenuPresenter::class);
               $menu->style('adminlte');



               if (Sentinel::hasAccess('browse-dashboard')){
                   // Dashboard
                   $menu->route(
                       'admin.dashboard.index',
                       __('admin::admin.Dashboard'),
                       null,
                       ['icon' => 'fa fa-desktop']
                   )->order(0);
               }


               if (Sentinel::hasAccess('browse-teacher')){
                   $menu->route(
                       'admin.teachers.index',
                       __('admin::admin.Teachers'),
                       null,
                       ['icon' => 'fa fa-user']
                   )->order(2);
               }

               if (Sentinel::hasAccess('browse-student')){
                   $menu->route(
                       'admin.students.index',
                       __('admin::admin.Student'),
                       null,
                       ['icon' => 'fa fa-user']
                   )->order(2);
               }

               if (Sentinel::hasAccess('browse-course')){
                   $menu->route(
                       'admin.courses.index',
                       __('admin::admin.Course'),
                       null,
                       ['icon' => 'fa fa-road']
                   )->order(2);
               }

               if (Sentinel::hasAccess('browse-batch')){
                   $menu->route(
                       'admin.batches.index',
                       __('admin::admin.Batches'),
                       null,
                       ['icon' => 'fa fa-cubes']
                   )->order(2);
               }

               if (Sentinel::hasAccess('browse-users')){
                   $menu->route(
                       'admin.users.index',
                       __('admin::admin.All Users'),
                       null,
                       ['icon' => 'fa fa-circle']
                   )->order(20);
               }


               if (Sentinel::hasAccess('browse-roles')){
                   $menu->route(
                       'admin.roles.index',
                       __('admin::admin.Roles'),
                       null,
                       ['icon' => 'fa fa-users']
                   )->order(20);
               }


               if (Sentinel::hasAccess('browse-permissions')){
                   $menu->route(
                       'admin.users.index',
                       __('admin::admin.Permissions'),
                       null,
                       ['icon' => 'dot fa fa-circle']
                   )->order(20);
               }


               if (Sentinel::hasAccess('browse-settings')){
                   $menu->route(
                       'admin.setting.index',
                       __('admin::admin.Settings'),
                       null,
                       ['icon' => 'fa fa-wrench']
                   )->order(30);
               }



                // Fire the event to extend the menu
                event(new AdminMenuCreated($menu));
        });

        return $next($request);
    }
}
