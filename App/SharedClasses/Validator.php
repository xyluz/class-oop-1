<?php namespace App\SharedClasses;

use App\SharedClasses\Enums\Constraints;
use App\SharedClasses\Enums\Rules;
use App\SharedClasses\Enums\StatusCode;
use App\SharedClasses\Objects\ResultObject;
use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\UserRequestObject;;
use Exception;

//TODO: a way to validate checkboxes, true or false.
//TODO: Confirm password validation
//TODO: implement 'might'

class Validator
{
    /**
     * @var array<ResultObject>
     */
    public array $errors;
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

        foreach ($this->rulesCollection->rules as $field => $rule) {

            if (!isset($this->inputObject->{$field})) {
                continue;
            }

            $isError = $this->applyValidationRuleToField($rule, $this->inputObject->{$field});

            $this->errors[$field] = count($isError) > 0 ? $isError : null;

        }

        return $this->cleanError();
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
                Rules::MIN() => $this->applyMinCheck($input, $value),
                Rules::MAX() => $this->applyMaxCheck($input, $value),
                Rules::MUST() => $this->applyMustConstraint($input, $value),
                Rules::NOT() => $this->applyNotConstraint($input, $value),
                Rules::SHOULD() => $this->applyShouldConstraint($input, $value),
                default => throw new Exception("{$rule} is invalid rule"),
            };

            if ( $check->isFailure() ) {
                $key = $law . ':' . $value;
                $singleInputError[$key] = $check->getSummary();
            }
        }

        return $singleInputError;

    }

    private function applyMaxCheck(string $input, int $value): ResultObject
    {

         if(strlen($input) > $value){
             return new ResultObject(message: "{$input} must not exceed  {$value} characters", statusCode: StatusCode::VALIDATION_ERROR);
         }

         return new ResultObject(message: '', statusCode: StatusCode::SUCCESS);
    }

    private function applyMinCheck(string $input, int $value): ResultObject
    {

        if(strlen($input) < $value){
            return new ResultObject(message: "{$input} must be at least {$value} characters", statusCode: StatusCode::VALIDATION_ERROR);
        }

        return new ResultObject(message: '', statusCode: StatusCode::SUCCESS);

    }

    private function applyMustConstraint(string $input, string $value): ResultObject
    {
        if($this->doMustConstraintCheck($value, $input)){
            return new ResultObject(message: 'pass', statusCode: StatusCode::SUCCESS);
        }

        return new ResultObject(message: "{$input} must be of type {$value}", statusCode: StatusCode::VALIDATION_ERROR);
    }

    private function applyNotConstraint(mixed $input, string $constraint): ResultObject
    {
        if(! $this->doMustConstraintCheck($constraint, $input)){
            return new ResultObject(message: 'pass', statusCode: StatusCode::SUCCESS);
        }

        return new ResultObject(message: "{$input} must not be of type {$constraint}", statusCode: StatusCode::VALIDATION_ERROR);

    }

    private function checkHasSpecialCharacter($passwordToArray): bool{
         return preg_match('/[^a-zA-Z0-9\s]/',  $passwordToArray);
    }

    private function applyShouldConstraint(int|string $input, string $value): ResultObject
    {
        if($this->doShouldConstraintCheck($value, $input)){
            return new ResultObject(message: 'pass', statusCode: StatusCode::SUCCESS);
        }

        return new ResultObject(message: "{$input} should have type {$value}", statusCode: StatusCode::VALIDATION_ERROR);

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

    /**
     * @param string $value
     * @param string $input
     * @return bool
     */
    public function doMustConstraintCheck(string $value, string $input): bool
    {
        return match ($value) {
            Constraints::ALPHA() => ctype_alpha($input),
            Constraints::NUMERIC() => ctype_digit($input),
            Constraints::ALPHA_NUMERIC() => ctype_alnum($input),
            Constraints::ARRAY() => is_array($input),
            Constraints::LOWERCASE() => ctype_lower($input),
            Constraints::UPPERCASE() => ctype_upper($input),
            Constraints::SYMBOL() => !ctype_alnum($input),
            default => false,
        };
    }

    /**
     * @param string $value
     * @param int|string $input
     * @return bool|int
     */
    public function doShouldConstraintCheck(string $value, int|string $input): int|bool
    {
        return match ($value) {
            Constraints::ALPHA() => $this->shouldHaveAlpha($input),
            Constraints::NUMERIC() => $this->shouldHaveNumeric($input),
            Constraints::LOWERCASE() => $this->shouldHaveLowercase($input),
            Constraints::UPPERCASE() => $this->shouldHaveUppercase($input),
            Constraints::SPECIAL_CHARACTER() => $this->checkHasSpecialCharacter($input),
            default => false,
        };
    }

    public function hasErrors():bool{
        return count($this->cleanError()) > 0;
    }

    public function getErrors():array{
        return $this->cleanError();
    }

    public function cleanError(): array
    {
        return array_filter($this->errors);
    }

}