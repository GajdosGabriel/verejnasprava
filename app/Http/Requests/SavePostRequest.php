<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePostRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'contact_id' => 'required|integer|exists:contacts,id',
            'name' => 'required|string|min:3',
            'price' => 'required|numeric',
            'filename.*' => 'mimes:jpeg,jpg,bmp,png,pdf,doc,docx,txt,svg|max:9024',
        ];

    }

    public function messages()
    {
        $messages = [
          'price.required' => 'Fakturovaná cena musí byť číslo.  Miesto desatinnej čiarky píšte bodku!',
          'name.required' => 'Popis dokladu je povinný.',
        ];

        return $messages;
    }

}
