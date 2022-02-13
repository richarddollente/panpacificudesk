<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTicketRequest extends FormRequest
{

    public function authorize()
    {
        return Gate::allows('ticket_access');
    }

    public function rules()
    {
        return [
            'subject' => [
                'required', 'string',
            ],
            'description' => [
                'required', 'string',
            ],
            'file' => [
                'string',
            ],

        ];
    }
}
