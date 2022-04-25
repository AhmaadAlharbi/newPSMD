<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class onlyMewEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //to find mew.gov.kw in email string value
        if (strpos($value, '@mew.gov.kw') !== false) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Only Mew email is allowed.';
    }
}
