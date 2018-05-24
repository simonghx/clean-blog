<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'titre' => 'required|max:255',
            'contenu' => 'required',
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
            'titre.required' => trans('validation.champ-requis'),
            'titre.max'=>'Le champs :attribute ne peut pas dépasser les 10 caractères',
            'contenu.required'  => trans('validation.champ-requis'),
        ];
    }

}