<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role === User::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST': {
                return [
                    'name' => 'required|min:5',
                    'description' => 'required|min:30',
                    'price' => 'required',
                    'image' => 'required|image|mimes:jpg,jpeg,png',
                ];
            }
            case 'PUT': {
                return [
                    'name' => 'required|min:5',
                    'description' => 'required|min:30',
                    'price' => 'required',
                    'image' => 'sometimes|image|mimes:jpg,jpeg,png',
                ];
            }
        }
    }
}
