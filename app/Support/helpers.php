<?php

use Illuminate\Support\Str;

if (! function_exists('array_keys_convert_case')) {
    /**
     * Converts the keys of an array to the specified case.
     *
     * @throws \Exception
     */
    function array_keys_convert_case(array $array, string $case): array
    {
        $cases = ['camel', 'kebab', 'snake', 'studly'];

        throw_if(
            ! in_array($case, $cases),
            Exception::class,
            "Case \"$case\" not supported",
        );

        $converted = [];

        foreach ($array as $key => $value) {
            $converted[Str::{$case}($key)] = is_array($value)
                ? array_keys_convert_case($value, $case)
                : $value;
        }

        return $converted;
    }
}
