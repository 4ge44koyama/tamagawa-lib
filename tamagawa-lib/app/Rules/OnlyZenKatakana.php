<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OnlyZenKatakana implements Rule
{
    // 制御用変数
    private $onlyZenKatakanaValidator;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->onlyZenKatakanaValidator = true;
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
        
        if ($this->onlyZenKatakanaValidator) {

            $regexOfValidation = "/\A[ァ-ヾ]+\z/u"; // 全角カタカナ
            return preg_match($regexOfValidation, $value); //判定をboolで返す
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '魚種は全角カナで入力してください。';
    }
}
