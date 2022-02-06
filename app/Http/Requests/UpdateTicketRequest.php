<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
            'status' => [
                'string',
            ],
            'priority' => [
                'string',
            ],
            'description' => [
                'required', 'string',
            ],
            'assgined_tech' => [
                'string',
            ],

        ];
    }
}

