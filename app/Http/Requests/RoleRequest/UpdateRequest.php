<?php

declare(strict_types=1);

namespace App\Http\Requests\RoleRequest;

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
            'status' => 'required|in:approved,declined',
            'remarks' => 'required_if:status,declined',
        ];
    }
}
