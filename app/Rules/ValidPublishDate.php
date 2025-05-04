<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidPublishDate implements Rule
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
        /*$current_date = Carbon::now();
        $publish_date = Carbon::createFromFormat('Y-m-d', $value);
        return $publish_date->gt($current_date);*/
        return Carbon::parse($value)->isAfter(now());
    }

    
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message():string
    {
        return 'لا يمكن أن يكون النشر بتاريخ قديم اختر تاريخ مستقبلي';
    }
}



