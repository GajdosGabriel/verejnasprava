<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveOrderRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'worker_id' => 'required|exists:workers,id',
            'payment' => 'required',
            'orderPublished' => 'required|date_format:Y-m-d',
            'itemName.*' => 'required',
            'quantity.*' => 'required',
            'price.*' => 'required|numeric'
        ];
    }
}
