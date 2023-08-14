<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Teacher;
use Illuminate\Validation\Rule;

class StoreTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'OldPass' => ['min:4','required'],
            'NewPassword' => ['min:4','required','confirmed'],
            'NewPassword_confirmation' => ['min:4','required'],
        ];
    }

    public function messages()
    {
      return ['NewPassword.confirmed' => 'パスワードが一致しません。',];
    }
}
