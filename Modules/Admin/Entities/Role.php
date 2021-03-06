<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Sentinel;
use Collective\Html\HtmlFacade;
use Wildside\Userstamps\Userstamps;

class Role extends EloquentRole
{

    use Userstamps;

    protected $appends = ['actions'];

    /**
     * ------------------------------------------------------------------------
     * MODEL VALIDATION RULES
     * ------------------------------------------------------------------------
     */
    public static function getValidationRules(FormRequest $request){
        return [
            'name' => 'required',
            'slug' => 'required',
            'permissions' => 'required|array',
        ];
    }

    /**
     * ------------------------------------------------------------------------
     * ACCESSORS
     * ------------------------------------------------------------------------
     */
    public function getActionsAttribute(){
        $actions_html = '';

//        if (Sentinel::hasAccess('read-roles')) {
//            $actions_html .= HtmlFacade::link(
//                route('admin.roles.show', ['role' => $this->id]),
//                app('laravel-font-awesome')->icon('fa-search'),
//                ['title' => 'Roles Detail'],
//                false,
//                false
//            );
//        }

        if (Sentinel::hasAccess('edit-roles')){
            $actions_html .= modal_anchor(
                route('admin.roles.edit', ['role' => $this->id]),
                app('laravel-font-awesome')->icon('fa-pencil'),
                ['class' => 'edit' , 'title' => 'Edit Roles']
            );
        }

        $dtDropdownListItems = [];

        if (Sentinel::hasAccess('delete-roles')) {
            $dtDropdownListItems[] = HtmlFacade::link(
                '#',
                'Delete',
                [
                    'data-id'=> $this->id,
                    'data-action' => 'delete-confirmation',
                    'data-action-url' => route('admin.roles.destroy', $this->id),
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


}
