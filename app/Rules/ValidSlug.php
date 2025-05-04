<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidSlug implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * 
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-z0-9-]+$/',$value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message():string
    {
        return 'تنسيق المعرّف (الرابط المخصص) غير صحيح يجب أن يحتوي على أحرف صغيرة وأرقام وواصلات فقط';
    }
}
