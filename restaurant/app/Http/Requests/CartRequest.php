<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'designation'=> 'required',
            'user_id'=> 'required',
            'tanks'=> 'required',
            'name_wifi'=> 'nullable',
            'password_wifi'=> 'nullable',
        ];
    }
}
