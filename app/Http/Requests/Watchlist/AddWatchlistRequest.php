<?php

namespace App\Http\Requests\Watchlist;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddWatchlistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //ovde dodamo Sanctum token proveru npr
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'isTitle' => ['required', 'bool'],
            'title' => ['required_without:ombd_id', 'string'],
            'ombd_id' => ['required_without:title', 'string']
        ];
    }
}
