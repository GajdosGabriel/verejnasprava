<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'email' => 'required|email',
            'street' => 'required|max:250',
            'psc' => 'required|max:6',
            'city' => 'required|max:50',
//            'email' => 'required|email|max:8|unique:organizations,email,' . $this->organization->id,
            'ico' => 'max:8|unique:organizations,ico,' ,
            'dic' => 'max:20',
        ];
    }
}
