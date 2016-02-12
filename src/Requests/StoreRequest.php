<?php

namespace Smarch\Watchtower\Requests;

use App\Http\Requests\Request;

class StoreRequest extends Request
{

    /**
     * 
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

        $name = $this->route()->getName();
        $tbl = ( str_contains($name, 'role') ) ? 'roles' : 'permissions';

       return [
            'name' => 'required|unique:'.$tbl.'|max:255|min:4',
            'slug' => 'required|unique:'.$tbl.'|max:255|min:4',
        ];

    }
}
