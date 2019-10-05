<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
use Collective\Html\HtmlFacade;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{

    use Userstamps;

    protected $appends = ['actions'];

    public $fillable = [
        'name', 'description', 'product_category_id','product_brand_id','unit','unit_price', 'purchase_price','freeshipping','client_id','freeshipping'
    ];

    /**
     * ------------------------------------------------------------------------
     * MODEL VALIDATION RULES
     * ------------------------------------------------------------------------
     */

    public static function getValidationRules(){
        return [
            'name' => 'required',
            'description' => 'nullable',
        ];
    }

    /**
     * ------------------------------------------------------------------------
     * ACCESSORS
     * ------------------------------------------------------------------------
     */
    public function getActionsAttribute(){
        $actions_html = '';

        if (Sentinel::hasAccess('read-product')) {
            $actions_html .= HtmlFacade::link(
                route('admin.products.show', ['user' => $this->id]),
                app('laravel-font-awesome')->icon('fa-search'),
                ['title' => 'Roles Detail'],
                false,
                false
            );
        }

        if (Sentinel::hasAccess('edit-product')){
            $actions_html .= modal_anchor(
                route('admin.products.edit', ['user' => $this->id]),
                app('laravel-font-awesome')->icon('fa-pencil'),
                ['class' => 'edit' , 'title' => 'Edit Roles']
            );
        }

        $dtDropdownListItems = [];

        if (Sentinel::hasAccess('delete-product')) {
            $dtDropdownListItems[] = HtmlFacade::link(
                '#',
                'Delete',
                [
                    'data-id'=> $this->id,
                    'data-action' => 'delete-confirmation',
                    'data-action-url' => route('admin.products.destroy', $this->id),
                ],
                false,
                false
            );
        }

        $actions_html .= '<div class="dropdown">
								<a class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="caret"></span>
                                </a>
							 ';



        $actions_html .= HtmlFacade::ul( $dtDropdownListItems, [
            'class' => 'dropdown-menu',
            'aria-labelledby' => 'dropdownMenu1'
        ]);

        $actions_html .=  '</div>';

        return $actions_html;
    }

    /**
     * ------------------------------------------------------------------------
     * RELATIONS
     * ------------------------------------------------------------------------
     */

    public function client(){
        return $this->belongsTo('Modules\Admin\Entities\Client', 'client_id');
    }

    public function brand(){
        return $this->belongsTo('Modules\Admin\Entities\ProductBrand', 'product_brand_id');
    }



}
