<?php

namespace Smarch\Watchtower\Requests;

use App\Http\Requests\Request;

class UpdateRequest extends Request
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

        $id = ( $this->route('permission') ) ?: $this->route('role');

        $tbl = str_plural( $this->route()->parameterNames()[0] );

        return [
            'slug' => 'required|unique:'.$tbl.',slug,'.$id.'|max:255|min:4',
            'name' => 'required|unique:'.$tbl.',name,'.$id.'|max:255|min:4',            
        ];

    }

}