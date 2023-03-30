<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'         => 'string',
            'price'         => 'numeric',
            'description'   => 'string',
            'quantity'      => 'int',
        ];
    }
}