<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'min:1'],
            'rate'   => ['required', 'numeric', 'min:0'],
            'months' => ['required', 'integer', 'min:1'],
            'type'   => ['required', 'in:annuity,differentiated'],
        ];
    }
}