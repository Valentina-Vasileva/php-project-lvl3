<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CorrectUrl implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $parsedUrl = parse_url($value);

        return array_key_exists('scheme', $parsedUrl) && array_key_exists('host', $parsedUrl);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Некорректный URL';
    }
}
