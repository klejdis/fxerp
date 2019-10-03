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

               $menu->dropdown('Product', function ($sub) {

                   if (Sentinel::hasAccess('browse-product')){
                       $sub->route(
                           'admin.products.index',
                           __('admin::admin.Products'),
                           null,
                           ['icon' => 'fa fa-product-hunt']
                       )->order(2);
                   }

                   if (Sentinel::hasAccess('browse-product-category')){
                       $sub->route(
                           'admin.products-category.index',
                           __('admin::admin.Products Category'),
                           null,
                           ['icon' => 'fa fa-chevron-right']
                       )->order(2);
                   }

                   if (Sentinel::hasAccess('browse-product-brand')){
                       $sub->route(
                           'admin.products-brand.index',
                           __('admin::admin.Products Brand'),
                           null,
                           ['icon' => 'fa fa-chevron-right']
                       )->order(2);
                   }
               }, 3);



               if (Sentinel::hasAccess('browse-clients')){
                   $menu->route(
                       'admin.clients.index',
                       __('admin::admin.Clients'),
                       null,
                       ['icon' => 'fa fa-database']
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
