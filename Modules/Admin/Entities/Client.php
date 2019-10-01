<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
use Collective\Html\HtmlFacade;
use Wildside\Userstamps\Userstamps;

class Client extends Model
{

    use Userstamps;

    protected $appends = ['actions'];

    public $fillable = [
        'first_name', 'last_name','company_name','address','city','phone','website'
    ];

    /**
     * ------------------------------------------------------------------------
     * MODEL VALIDATION RULES
     * ------------------------------------------------------------------------
     */

    public static function getValidationRules(){
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'city' => 'nullable',
            'website' => 'nullable|url',
        ];
    }

    /**
     * ------------------------------------------------------------------------
     * ACCESSORS
     * ------------------------------------------------------------------------
     */
    public function getActionsAttribute(){
        $actions_html = '';

        if (Sentinel::hasAccess('read-clients')) {
            $actions_html .= HtmlFacade::link(
                route('admin.clients.show', ['client' => $this->id]),
                app('laravel-font-awesome')->icon('fa-search'),
                ['title' => 'Clients Detail'],
                false,
                false
            );
        }

        if (Sentinel::hasAccess('edit-clients')){
            $actions_html .= modal_anchor(
                route('admin.clients.edit', ['client' => $this->id]),
                app('laravel-font-awesome')->icon('fa-pencil'),
                ['class' => 'edit' , 'title' => 'Edit Clients']
            );
        }

        $dtDropdownListItems = [];

        if (Sentinel::hasAccess('delete-clients')) {
            $dtDropdownListItems[] = HtmlFacade::link(
                '#',
                'Delete',
                [
                    'data-id'=> $this->id,
                    'data-action' => 'delete-confirmation',
                    'data-action-url' => route('admin.clients.destroy', $this->id),
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
