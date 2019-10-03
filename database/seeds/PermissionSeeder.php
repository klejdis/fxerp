<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        $permission = new \Modules\Admin\Repositories\PermissionRepository();

        $permission->createMultiple([
            [
                'name' => 'Browse Users',
                'slug' => 'browse-users',
                'module' => 'Users',
            ],

            [
                'name' => 'Read Users',
                'slug' => 'read-users',
                'module' => 'Users',
            ],

            [
                'name' => 'Edit Users',
                'slug' => 'edit-users',
                'module' => 'Users',
            ],

            [
                'name' => 'Add Users',
                'slug' => 'create-users',
                'module' => 'Users',
            ],

            [
                'name' => 'Delete Users',
                'slug' => 'delete-users',
                'module' => 'Users',
            ],

            [
                'name' => 'Browse Roles',
                'slug' => 'browse-roles',
                'module' => 'Roles',
            ],

            [
                'name' => 'Read Roles',
                'slug' => 'read-roles',
                'module' => 'Roles',
            ],

            [
                'name' => 'Edit Roles',
                'slug' => 'edit-roles',
                'module' => 'Roles',
            ],

            [
                'name' => 'Add Roles',
                'slug' => 'create-roles',
                'module' => 'Roles',
            ],

            [
                'name' => 'Delete Roles',
                'slug' => 'delete-roles',
                'module' => 'Roles',
            ],

            [
                'name' => 'Browse Settings',
                'slug' => 'browse-settings',
                'module' => 'Settings',
            ],

            [
                'name' => 'Edit Settings',
                'slug' => 'edit-settings',
                'module' => 'Settings',
            ],

            [
                'name' => 'Browse Dashboard',
                'slug' => 'browse-dashboard',
                'module' => 'Dashboard',
            ],

            [
                'name' => 'Read Dashboard',
                'slug' => 'read-dashboard',
                'module' => 'Dashboard',
            ],

            [
                'name' => 'Edit Dashboard',
                'slug' => 'edit-dashboard',
                'module' => 'Dashboard',
            ],

            [
                'name' => 'Add Dashboard',
                'slug' => 'create-dashboard',
                'module' => 'Dashboard',
            ],

            [
                'name' => 'Delete Dashboard',
                'slug' => 'delete-dashboard',
                'module' => 'Dashboard',
            ],

            [
                'name' => 'Browse Product',
                'slug' => 'browse-product',
                'module' => 'Product',
            ],

            [
                'name' => 'Read Product',
                'slug' => 'read-product',
                'module' => 'Product',
            ],

            [
                'name' => 'Edit Product',
                'slug' => 'edit-product',
                'module' => 'Product',
            ],

            [
                'name' => 'Add Product',
                'slug' => 'create-product',
                'module' => 'Product',
            ],

            [
                'name' => 'Delete Product',
                'slug' => 'delete-product',
                'module' => 'Product',
            ],

            [
                'name' => 'Browse Clients',
                'slug' => 'browse-clients',
                'module' => 'Clients',
            ],

            [
                'name' => 'Read Clients',
                'slug' => 'read-clients',
                'module' => 'Clients',
            ],

            [
                'name' => 'Edit Clients',
                'slug' => 'edit-clients',
                'module' => 'Clients',
            ],

            [
                'name' => 'Add Clients',
                'slug' => 'create-clients',
                'module' => 'Clients',
            ],

            [
                'name' => 'Delete Clients',
                'slug' => 'delete-clients',
                'module' => 'Clients',
            ],

            [
                'name' => 'Browse Product Brands',
                'slug' => 'browse-product-brand',
                'module' => 'Product Brands',
            ],

            [
                'name' => 'Read Product Brands',
                'slug' => 'read-product-brand',
                'module' => 'Product Brands',
            ],

            [
                'name' => 'Edit Product Brands',
                'slug' => 'edit-product-brand',
                'module' => 'Product Brands',
            ],

            [
                'name' => 'Add Product Brands',
                'slug' => 'create-product-brand',
                'module' => 'Product Brands',
            ],

            [
                'name' => 'Delete Product Brands',
                'slug' => 'delete-product-brand',
                'module' => 'Product Brands',
            ],

            [
                'name' => 'Browse Product Category',
                'slug' => 'browse-product-category',
                'module' => 'Product Category',
            ],

            [
                'name' => 'Read Product Category',
                'slug' => 'read-product-category',
                'module' => 'Product Category',
            ],

            [
                'name' => 'Edit Product Category',
                'slug' => 'edit-product-category',
                'module' => 'Product Category',
            ],

            [
                'name' => 'Add Product Category',
                'slug' => 'create-product-category',
                'module' => 'Product Category',
            ],

            [
                'name' => 'Delete Product Category',
                'slug' => 'delete-product-category',
                'module' => 'Product Category',
            ],
        ]);
    }
}
