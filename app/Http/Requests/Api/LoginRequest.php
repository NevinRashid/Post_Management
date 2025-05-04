<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
        $rules = [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:16'],
        ];
    
        return $rules;
    }

        /**
     *  Get the error messages for the defined validation rules.
     * 
     *  @return array<string, string>
     */
    public function messages():array
    {
        return[
            'email.required'           => 'الايميل ضروري من فضلك يجب إدخاله',
            'email.email'              => ' (example@gmail.com) الرجاء التقيد بصيغة الايميل',
            'email.max'                => 'لا يجوز أن يكون طول الايميل أكثر من 255 رمز',
            'password.required'        => 'كلمةالمرور ضرورية من فضلك',
            'password.min'             => 'يجب أن لا تقل كلمة المرور عن 8 رموز',
            'password.max'             => 'لا يجوز أن يكون طول كلمة المرور أكثر من 16 رمز',
        ];
    }

    /**
    * Get custom attributes for validator errors.
    *
    * @return array<string, string>
    */
    public function attributes(): array
    {
        return [
            'password'  => 'كلمة المرور',
            'email'     => 'الايميل'
            ];
    }

    /**
     * Handle a failed validation attempt.
     * 
     * @param  \Illuminate\Validation\Validator  $validator
     * 
     * @return void
     */
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json
            ([
                'success' => false,
                'message' => 'خطأ من التحقق من البيانات',
                'errors'  => $validator->errors()
            ] , 422));
    }
}
