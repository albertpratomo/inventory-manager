<?php

namespace App\Http\Requests\InventoryMovements;

use App\Models\InventoryMovement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'quantity' => [
                'required',
                'integer',
                'numeric',
                'not_in:0',
                function ($attribute, $value, $fail) {
                    if ($value < 0) {
                        $quantityAvailable = InventoryMovement::available()->sum('remaining_quantity');

                        if ($quantityAvailable < abs($value)) {
                            $fail("Only $quantityAvailable units available.");
                        }
                    }
                },
            ],
            'unit_price' => [
                Rule::requiredIf(fn () => $this->quantity > 0),
                'integer',
                'numeric',
                'min:1',
                'nullable',
            ],
        ];
    }
}
