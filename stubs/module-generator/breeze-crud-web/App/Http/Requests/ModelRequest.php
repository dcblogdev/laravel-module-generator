<?php

namespace Modules\{Module}\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {Model}Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ]
        ];
    }
}
