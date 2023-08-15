<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInOutHistoryRequest extends FormRequest
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
            'student_serial' => ['exists:students,serial_student'],
        ];
    }

    public function messages()
    {
      return [
        'student_serial.exists' => '番号が登録されていません。',
      ];
    }

}
