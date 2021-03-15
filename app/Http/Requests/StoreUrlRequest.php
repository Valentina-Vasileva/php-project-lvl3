<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CorrectUrl;

class StoreUrlRequest extends FormRequest
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
            'url.name' => ['required', new CorrectUrl()]
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
            'url.name.required' => 'Некорректный URL'
        ];
    }
}
