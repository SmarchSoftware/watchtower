<?php

namespace Elite-telecom\Watchtower\Requests;

use App\Http\Requests\Request;

class UserStoreRequest extends Request
{

    public function all() {
        $atts = parent::all();
        
        if ($atts['password'] === $atts['password_confirmation']) {
            $crypted = bcrypt( $atts['password'] );
            $atts['password'] = $crypted;
            $atts['password_confirmation'] = $crypted;
        }
        
        return $atts;
    }

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
  
       return [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
