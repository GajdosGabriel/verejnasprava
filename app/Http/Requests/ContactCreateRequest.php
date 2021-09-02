<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactCreateRequest extends OrganizationFormRequest
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
            'name' => 'required|min:2|max:250',
            'ico' => 'max:8' ,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Firma musí obsahovať minimálne 2 znaky.',
            'ico.max' => 'IČO nesmie mať viac ako 8 znakov',
        ];
    }
}
