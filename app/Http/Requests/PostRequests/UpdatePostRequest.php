<?php

namespace App\Http\Requests\PostRequests;

use App\Rules\ValidPublishDate;
use App\Rules\ValidSlug;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
    
    /**
     * Prepare the data for validation.
     * 
     * @return void
     */
    protected function prepareForValidation(){
    
    $this->merge([
                'body'              => Str::lower($this->body),
                'meta_description'  => Str::ucfirst($this->meta_description),
                ]);
    

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules=[
            'title'            => ['nullable','string','max:255'],
            'body'             => ['nullable','string','max:255'],
            'meta_description' => ['nullable','string','max:160'],
            'tags'             => ['nullable','string','regex:/^([A-Za-z0-9_-]+)(,\s*[A-Za-z0-9_-]+)*$/','max:255'],
            'slug'             => ['nullable','string',Rule::unique('posts')->ignore($this->route('post')), new ValidSlug()],
            'is_published'     => ['nullable','boolean'],
            'publish_date'     => ['nullable','date']
        ];
        if(!$this->is_published){
            $rules['publish_date'] = ['nullable','date', new ValidPublishDate()];
        }
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
            'title.max'             => 'لا يجوز أن يكون طول العنوان أكثر من 255 حرف',
            'body.max'              => 'لا يجوز أن يكون طول المحتوى أكثر من 255 حرف',
            'meta_description.max'  => 'لا يجوز أن يكون طول الوصف أكثر من 160 حرف',
            'tags.regex'            => 'صيغة الوسوم غير صحيحة ',
            'tags.max'              => 'لا يجوز أن يكون طول الوسوم أكثر من 255 محرف',
            'slug.unique'           => 'يجب أن يكون المعرّف (الرابط المخصص) فريد وغير مكرر',
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
            'title'             => 'العنوان',
            'body'              => 'المحتوى',
            'meta_description'  => 'الوصف',
            'tags'              => 'الوسوم',
            'publish_date'      => 'تاريخ النشر',
            'slug'              => 'المعرّف (الرابط المخصص)',
            ];
    }

    /**
     * Handle a passed validation attempt.
     * 
     */
    protected function passedValidation(): void{
        //event(new UserDataValidationSuccefly($this->validated()));
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

