<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
            'name'      => ['required','string','max:255'],
            'email'     => ['required','email','unique:users','max:255'],
            'password'  => ['required','string','min:8','max:16','confirmed',
                            Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()
                            ]
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
            'name.required'            => 'الاسم ضروري من فضلك يجب إدخاله',
            'name.max'                 => 'لا يجوز أن يكون طول الاسم أكثر من 255 حرف',
            'email.required'           => 'الايميل ضروري من فضلك يجب إدخاله',
            'email.email'              => 'الرجاء التقيد بصيغة الايميل',
            'email.unique'             => ' يجب أن يكون الايميل فريد وغير مكرر الرجاء استخدام ايميل آخر',
            'email.max'                => 'لا يجوز أن يكون طول الايميل أكثر من 255 محرف',
            'password.required'        => 'كلمةالمرور ضرورية من فضلك',
            'password.min'             => 'يجب أن لا تقل كلمة المرور عن 8 رموز',
            'password.max'             => 'لا يجوز أن يكون طول كلمة المرور أكثر من 16 رمز',
            'password.confirmed'       => 'يجب تأكيد كلمة المرور',
            'password.letters'         => 'يجب أن تحتوي كلمة المرور على حرف واحد على الأقل  ',
            'password.mixed'           => 'يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل وحرف صغير واحد',
            'password.numbers'         => 'يجب أن تحتوي كلمة المرور على رقم واحد على الأقل',
            'password.symbols'         => 'يجب أن تحتوي كلمة المرور على رمز واحد على الأقل',
            'password.uncompromised'   => 'يجب اختيار كلمة المرور أكثر أماناَ',
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
            'name'      => 'اسم المستخدم',
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
