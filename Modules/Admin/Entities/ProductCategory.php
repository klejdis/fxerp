<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
use Collective\Html\HtmlFacade;
use Wildside\Userstamps\Userstamps;

class ProductCategory extends Model
{
    use Userstamps;

    protected  $table = 'product_category';

    protected $appends = ['actions'];

    public $fillable = [
        'name', 'description'
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

        if (Sentinel::hasAccess('edit-product-category')){
            $actions_html .= modal_anchor(
                route('admin.products-category.edit', ['products-brand' => $this->id]),
                app('laravel-font-awesome')->icon('fa-pencil'),
                ['class' => 'edit' , 'title' => 'Edit products brand']
            );
        }

        $dtDropdownListItems = [];

        if (Sentinel::hasAccess('delete-product-category')) {
            $dtDropdownListItems[] = HtmlFacade::link(
                '#',
                'Delete',
                [
                    'data-id'=> $this->id,
                    'data-action' => 'delete-confirmation',
                    'data-action-url' => route('admin.products-brand.destroy', $this->id),
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

    public function products(){
        return $this->hasMany('Modules\Admin\Entities\Product', 'product_category_id');
    }



}
