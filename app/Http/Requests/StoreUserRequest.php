<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'email'    => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'class_id' => [
                'required',
            ],
            'roles.*'  => [
                'integer',
            ],
            'roles'    => [
                'required',
                'array',
            ],

        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}
