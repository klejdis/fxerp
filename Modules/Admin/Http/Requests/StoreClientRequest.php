<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Entities\Client;
use Modules\Admin\Entities\Product;
use Modules\Admin\Entities\Role;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Client::getValidationRules($this);
    }
}
