<?php

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pb1 = \Modules\Admin\Entities\ProductBrand::create([
            'name' => 'Brand 1',
            'description' => 'Brand 1',
        ]);

        $pb2 =  \Modules\Admin\Entities\ProductBrand::create([
            'name' => 'Brand 2',
            'description' => 'Brand 1',
        ]);

        $pb3 = \Modules\Admin\Entities\ProductBrand::create([
            'name' => 'Brand 3',
            'description' => 'Brand 1',
        ]);

        $pc1 = \Modules\Admin\Entities\ProductCategory::create([
            'name' => 'Category 1',
            'description' => 'Category 1',
        ]);

        $pc2 = \Modules\Admin\Entities\ProductCategory::create([
            'name' => 'Category 2',
            'description' => 'Category 2',
        ]);

        $pc3 = \Modules\Admin\Entities\ProductCategory::create([
            'name' => 'Category 3',
            'description' => 'Category 3',
        ]);

        $c1 =  \Modules\Admin\Entities\Client::create([
            'first_name' => 'Client 1',
            'last_name' => 'Client 1',
            'company_name' => 'Company for Client 1',
            'address' => 'Client 1 Address',
            'city'=> 'Client 1 City',
            'phone'=> '123123123',
            'website' => 'https://www.fxpro.com/'
        ]);

        $c2 =   \Modules\Admin\Entities\Client::create([
            'first_name' => 'Client 2',
            'last_name' => 'Client 2',
            'company_name' => 'Company for Client 2',
            'address' => 'Client 2 Address',
            'city'=> 'Client 2 City',
            'phone'=> '123123123',
            'website' => 'https://www.fxpro.com/'
        ]);

        \Modules\Admin\Entities\Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 Description',
            'product_category_id' => $pc1->id,
            'product_brand_id' => $pb1->id,
            'unit' => 'pc',
            'unit_price' => '1200',
            'purchase_price' => '1500',
            'freeshipping' => 1,
            'client_id' => $c1->id
        ]);

        \Modules\Admin\Entities\Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 Description',
            'product_category_id' => $pc2->id,
            'product_brand_id' => $pb2->id,
            'unit' => 'pc',
            'unit_price' => '1200',
            'purchase_price' => '1500',
            'freeshipping' => 1,
            'client_id' => $c2->id
        ]);

        \Modules\Admin\Entities\Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 Description',
            'product_category_id' => $pc3->id,
            'product_brand_id' => $pb3->id,
            'unit' => 'pc',
            'unit_price' => '1200',
            'purchase_price' => '1500',
            'freeshipping' => 1,
            'client_id' => $c2->id
        ]);

    }
}
