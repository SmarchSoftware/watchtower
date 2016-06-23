<?php

namespace EliteTelecom\Watchtower\Requests;

use App\Http\Requests\Request;

class UserUpdateRequest extends Request
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
            'login' => 'required|unique:users,login,'.$this->user,
            'password' => 'confirmed|min:6',
        ];

    }

}