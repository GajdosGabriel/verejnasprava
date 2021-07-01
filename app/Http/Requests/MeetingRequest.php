<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:250',
            'start_at' => 'required|date',
        ];
    }


    public function messages()
    {
        $messages = [
          'name.required' => 'Názov môže byť dlhý maximálne 250 znakov a minimálne 3 znaky!',
          'start_at.required' => 'Začiatok stupiteľstva neskorší ako dnes!',
        ];

        return $messages;
    }


}
