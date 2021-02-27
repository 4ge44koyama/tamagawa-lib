<?php
// ArticleController store action

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\OnlyZenKatakana;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'fish_kind' => ['required', 'max:50', new OnlyZenKatakana], 
            'spot'      => ['required', 'max:100'], 
            'body'      => ['required', 'max:500'], 
            'img'       => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max: 1024'], 
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'fish_kind' => '魚種',
            'img'       => '画像',
            'spot'      => '釣った場所',
            'body'      => '本文',
        ];
    }
}
