<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Users;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'role_id' => 'required|in:'.\App\Models\Role::query()->pluck('id')->implode(','),
            'email' => 'required|email|unique:users,email,'.$this->route('user')->id,
            'username' => 'required|unique:users,username,'.$this->route('user')->id,
            'password' => 'nullable|min:8|confirmed',
            'photo' => 'file|mimes:gif,jpeg,jpg,jpe,png',
            'photo_alt' => 'required_with:photo|max:255',
        ];
    }
}
