<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Users;

use App\Models\Role;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|in:' . Role::query()->pluck('id')->implode(','),
            'photo' => 'file|mimes:gif,jpeg,jpg,jpe,png',
            'photo_alt' => 'required_with:photo|max:255',
        ];
    }
}
