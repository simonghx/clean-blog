<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'confirmed',
            'password_confirmation' => 'required_with:password',
        ]; 
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
    public function messages()
    {
        return [
            'name.required' => trans('validation.champ-requis'),
            'email.required'  => trans('validation.champ-requis'),
            'password.confirmed' => 'Votre mot de passe doit être confirmé.'
        ];
    }
}
