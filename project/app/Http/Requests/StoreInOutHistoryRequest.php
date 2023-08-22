<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInOutHistoryRequest extends FormRequest
{
  //const HeaderSerial = "S_";
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
      //$target=self::HeaderSerial.$request->student_serial;
      return [
            'student_serial' => ['exists:students,serial_student'],
            //'student_serial' => ['exists:students,$target'],
        ];
    }

    public function messages()
    {
      return [
        'student_serial.exists' => '番号が登録されていません。',
      ];
    }

}
