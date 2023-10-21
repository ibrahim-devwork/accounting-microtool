<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => Route::input('id'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match (Route::currentRouteName()) {
            'users.store'  => $this->createOrUpdate() + [
                'email'                 => ['bail', 'required', 'string', 'unique:users,email', 'email:rfc,dns', 'max:50'],
                'password'              => ['bail', 'required', 'min:8'],
                'password_confirmation' => ['bail', 'required', 'min:8', 'same:password'], 
            ],

            'users.update' => [
                'id'     => 'exists:users,id',
                'email'  => ['bail', 'required', 'string', 'unique:users,email,'.$this->id, 'email:rfc,dns', 'max:50'],

            ] + $this->createOrUpdate(),
        };
    }

    public function createOrUpdate() {
        return [
            'name'  => ['bail', 'required', 'string', 'max:50'],
        ];
    }
}