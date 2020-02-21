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
            'name' => 'required|string|max:250',
            'email' => 'required|email',
            'street' => 'required|string|max:250',
            'psc' => 'required|string|max:6',
            'city' => 'required|string|max:50',
            'ico' => 'required|string|max:8',
            'dic' => 'required|string|max:20',
        ];
    }
}
