<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class csvToOfxConversionRequest extends FormRequest
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
        return match (Route::currentRouteName()) {
                'process-list.store'  => [
                    'name'      => ['bail', 'required', 'max:80'],
                    'ofx_file'  => ['bail', 'required', 'file', 'mimes:ofx'],
                    'user_id'   => ['bail',
                        Rule::requiredIf(function () {
                            return auth()->user()->role === 'Admin';
                        }),
                    ]
                ],

            'process-list.search' => ['search' => ['bail', 'nullable']],
        };

    }
}
