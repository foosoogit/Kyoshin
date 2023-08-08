<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
            //'email' => 'required|unique:users,email',
            'email'=> [
                'required', // 必須
                'unique:users,email', // ユニーク制約で重複チェック
            ],
        ];
    }

    public function messages()
  {
    return [
      'email.unique' => 'そのアドレスは登録されています。',
    ];
  }
}
