<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreAccessRequest extends Request
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
            'name' => 'required|max:255',
            'host' => 'required|max:255',
            'login' => 'required|max:255',
            'password' => 'required|max:255',
        ];
    }
}
