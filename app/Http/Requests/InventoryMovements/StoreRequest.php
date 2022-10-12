<?php

namespace App\Http\Requests\InventoryMovements;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'quantity' => 'required|integer|numeric',
            'unit_price' => 'integer|numeric|nullable',
        ];
    }
}
