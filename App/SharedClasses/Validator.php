<?php namespace App\SharedClasses;

use App\SharedClasses\Enums\Constraints;
use App\SharedClasses\Enums\Rules;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Support\PasswordHelper;
use Exception;


class Validator
{
    //TODO: create class for handling errors

    private array $errors = [];
    public function __construct(
        public array $rules,
        public UserRequestObject $inputObject
    )
    {
    }

    /**
     * @throws Exception
     */
    public function validateCustom(): array {

        foreach ($this->rules as $field => $ruleString) {

            if (!isset($this->inputObject->{$field})) {
                continue;
            }

            $isError = $this->applyValidationRuleToField($field, $ruleString, $this->inputObject->{$field});

            $this->errors[$field] = count($isError) > 0 ? $isError : null;

        }

        return array_filter($this->errors);
    }

    /**
     * Extracts the rules using the | and constraint using the :
     * example of request:
     *
     * 'firstname'=>'min:3|max:200|must:alpha|not:numeric',
     *
     * @throws Exception
     */
    private function applyValidationRuleToField(string $field, string $ruleString, string|int $input): array
    {

        $splitRuleString = explode('|',$ruleString);

        $singleInputError = [];

        foreach ($splitRuleString as $rule) {

            [$law, $value] = explode(':', $rule);
//            $law = $single[0];
//
//            $value = $single[1];

            $check = match($law) {
                Rules::MIN() => $this->applyMinCheck($input, $value) ? "{$field}: '{$input}' must be at least {$value} characters" : true ,
                Rules::MAX() => $this->applyMaxCheck($input, $value) ? "{$field}: '{$input}' must not exceed  {$value} characters" : true ,
                Rules::MUST() => $this->applyMustConstraint($input, $value) ? true : "{$field}: '{$input}' must be of type {$value}",
                Rules::NOT() => $this->applyNotConstraint($input, $value) ? "{$field}: '{$input}' must not be of type {$value}" : true,
                Rules::SHOULD() => $this->applyShouldConstraint($input, $value) ? true : "{$field}: '{$input}' should have type {$value}",
                default => throw new Exception("{$rule} is invalid rule"),
            };

            if ( is_string( $check ) ) {
                $key = $law . ':' . $value;
                $singleInputError[$key] = $check;
            }
        }

        return $singleInputError;

    }

    private function applyMaxCheck(string $input, int $value): bool
    {
        return strlen($input) >= $value;
    }

    private function applyMinCheck(string $input, int $value): bool
    {
        return  strlen($input) < $value;
    }

    private function applyMustConstraint(string $input, string $value): bool
    {
        return match($value) {
            Constraints::ALPHA() => ctype_alpha($input),
            Constraints::NUMERIC() => ctype_digit($input),
            Constraints::ALPHA_NUMERIC() => ctype_alnum($input),
            Constraints::ARRAY() => is_array($input),
            Constraints::LOWERCASE() => ctype_lower($input),
            Constraints::UPPERCASE() => ctype_upper($input),
            Constraints::SYMBOL() => ! ctype_alnum($input),
            default => false,
        };
    }

    private function applyNotConstraint(mixed $input, string $constraint): bool
    {
       return ! $this->applyMustConstraint($input,$constraint);
    }

    private function applyShouldConstraint(int|string $input, string $value): bool|int
    {
        return match($value) {
            Constraints::ALPHA() => PasswordHelper::shouldHaveAlpha($input),
            Constraints::NUMERIC() => PasswordHelper::shouldHaveNumeric($input),
            Constraints::LOWERCASE() => PasswordHelper::shouldHaveLowercase($input),
            Constraints::UPPERCASE() => PasswordHelper::shouldHaveUppercase($input),
            Constraints::SPECIAL_CHARACTER() => PasswordHelper::checkHasSpecialCharacter($input),
            default => false,
        };
    }

}