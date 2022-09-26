<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductWithLocalizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['unique:products', 'required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'localizations.*.name' => ['required', 'string', 'max:255'],
            'localizations.*.description' => ['required', 'string', 'max:700'],
        ];
    }
}
