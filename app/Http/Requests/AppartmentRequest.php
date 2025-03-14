<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => ['required'],
            'description' => ['required'],
            'surface' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'piece' => ['required', 'integer'],
            'bedroom' => ['required', 'integer'],
            'floor' => ['required', 'integer'],
            'address' => ['required'],
            'city' => ['required'],
            'postal_code' => ['required', 'min:5', 'max:5'],
            'is_sell' => [],
            'options' => ['array', 'exists:options,id'],
            'images' => ['array'],
            'images.*' => ['image', 'max:2000'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_sell' => $this->input('is_sell') === "on" ? 1 : 0,
        ]);
    }
}
