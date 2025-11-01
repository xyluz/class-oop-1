<?php namespace App\SharedClasses;

use App\SharedClasses\Enums\Constraints;
use App\SharedClasses\Enums\Rules;
use App\SharedClasses\Objects\RulesObject;
use App\SharedClasses\Objects\UserRequestObject;
use Exception;


class Validator
{
    //TODO: Make class for input Object
    //TODO: make class for rules (in addition to Enum)
    //TODO: create class for handling errors

    private array $errors = [];
    public function __construct(public RulesObject $rules, public UserRequestObject $inputObject)
    {
        //TODO: implement data cleanup
    }

    /**
     * @throws Exception
     */
    public function validateCustom(): array {

        //TODO: Fix the rules to array and use the correct rule format

        foreach ($this->rules->toArray() as $column => $rule) {
            if (!isset($this->inputObject->{$column})) {
                continue;
            }

            $isError = $this->applySingleInputValidation($rule, $this->inputObject->{$column});

            $this->errors[$column] = count($isError) > 0 ? $isError : null;

        }

        return array_filter($this->errors);
    }

    private function makeArrayFromString(string $separator, string $string):array{
        return explode($separator, $string);
    }
    /**
     * @throws Exception
     */
    private function applySingleInputValidation(mixed $rule, mixed $input): array
    {
//        Rules::MUST
// { name: MUST, value: 'must'}


        $splitRules = $this->makeArrayFromString('|',$rule);
        $singleInputError = [];

        foreach ($splitRules as $rule) {
            $single = explode(':', $rule);
            $law = $single[0];
            $value = $single[1];

            if (! $law instanceof Rules) {
                throw new Exception($rule . 'is invalid' . ' Only allowed rules are: ' . Rules::toString());
            }

            $check = match($law) {
                Rules::MIN() => $this->applyMinCheck($input, $value) ? true : "{$input} must be at least {$value} characters",
                Rules::MAX() => $this->applyMaxCheck($input, $value) ? true : "{$input} must not exceed  {$value} characters",
                Rules::MUST() => $this->applyMustConstraint($input, $value) ? true : "{$input} must be of type {$value}",
                Rules::NOT() => $this->applyNotConstraint($input, $value) ? true : "{$input} must not be of type {$value}",
                default => throw new Exception("{$rule} is invalid rule"),
            };
            if (! $check ) {
                $singleInputError["$law:$value"] = $check;
            }
        }
        return $singleInputError;

    }

    private function applyMaxCheck(mixed $input, string $value): bool
    {
        return is_int($input) ?  $input <= $value : strlen($input) <= $value;
    }

    private function applyMinCheck(mixed $input, string $value): bool
    {
        return is_int($input) ?  $input >= $value : strlen($input) >= $value;
    }

    private function applyMustConstraint(mixed $input, Constraints $constraint): bool
    {
        return match($constraint) {
            Constraints::ALPHA => ctype_alpha($input),
            Constraints::NUMERIC => ctype_digit($input),
            Constraints::ALPHA_NUMERIC => ctype_alnum($input),
            Constraints::ARRAY => is_array($input),
            Constraints::LOWERCASE => ctype_lower($input),
            Constraints::SYMBOL => ctype_space($input),
            default => false,
        };
    }

    private function applyNotConstraint(mixed $input, Constraints $constraint): bool
    {
       return ! $this->applyMustConstraint($input,$constraint);
    }

}