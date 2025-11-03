<?php namespace App\SharedClasses;

use App\SharedClasses\Enums\Constraints;
use App\SharedClasses\Enums\Rules;
use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\UserRequestObject;
use Cassandra\Exception\UnpreparedException;
use Exception;
use http\Exception\InvalidArgumentException;


class Validator
{
    //TODO: create class for handling errors

    private array $errors = [];
    public function __construct(
        public RulesCollection        $rulesCollection,
        public UserRequestObject $inputObject
    )
    {
    }

    /**
     * @throws Exception
     */
    public function run(): array {

        if($this->inputObject->empty()){
            throw new InvalidArgumentException('Input cannot be empty');
        }

        foreach ($this->rulesCollection->rules as $field => $rule) {

            if (!isset($this->inputObject->{$field})) {
                continue;
            }

            $isError = $this->applyValidationRuleToField($rule, $this->inputObject->{$field});

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
    private function applyValidationRuleToField(string $rules, string|int $input): array
    {

        $splitRules = explode('|',$rules);

        $singleInputError = [];

        foreach ($splitRules as $rule) {

            $single = explode(':', $rule);
            $law = $single[0];

            $value = $single[1];

            $check = match($law) {
                Rules::MIN() => $this->applyMinCheck($input, $value) ? "{$input} must be at least {$value} characters" : true ,
                Rules::MAX() => $this->applyMaxCheck($input, $value) ? "{$input} must not exceed  {$value} characters" : true ,
                Rules::MUST() => $this->applyMustConstraint($input, $value) ? true : "{$input} must be of type {$value}",
                Rules::NOT() => $this->applyNotConstraint($input, $value) ? "{$input} must not be of type {$value}" : true,
                Rules::SHOULD() => $this->applyShouldConstraint($input, $value) ? true : "{$input} should have type {$value}",
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

    private function checkHasSpecialCharacter($passwordToArray): bool{
         return preg_match('/[^a-zA-Z0-9\s]/',  $passwordToArray);
    }

    private function applyShouldConstraint(int|string $input, string $value): bool|int
    {
        return match($value) {
            Constraints::ALPHA() => $this->shouldHaveAlpha($input),
            Constraints::NUMERIC() => $this->shouldHaveNumeric($input),
            Constraints::LOWERCASE() => $this->shouldHaveLowercase($input),
            Constraints::UPPERCASE() => $this->shouldHaveUppercase($input),
            Constraints::SPECIAL_CHARACTER() => $this->checkHasSpecialCharacter($input),
            default => false,
        };
    }

    private function shouldHaveAlpha($input): false|int
    {
        return  preg_match('/[a-zA-Z]/',  $input);
    }

    private function shouldHaveNumeric($input): false|int
    {
        return  preg_match('/\d/',  $input);
    }

    private function shouldHaveLowercase(int|string $input):bool
    {
        return  preg_match('/[a-z]/',  $input);
    }

    private function shouldHaveUppercase(int|string $input):bool
    {
        return  preg_match('/[A-Z]/',  $input);
    }

}