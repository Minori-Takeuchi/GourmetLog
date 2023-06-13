<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
        return [
            'name' => 'required|max:20|string',
            'name_katakana' => 'required|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'category_ids' => 'required',
            'review' => 'required|integer|between:1,5',
            'tel' => 'nullable|regex:/^[0-9]+$/',
            'comment' => 'required|max:300',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店名を入力してください',
            'name.max' => '20文字以内で入力してください',
            'name.string' => '文字列で入力してください',
            'name_katakana.required' => 'フリガナを入力してください',
            'name_katakana.regex' => '全角カタカナのみ使用可能です',
            'category_ids.required' => '1つ以上のカテゴリーを選択してください',
            'review.required' => 'レビューを選択してください',
            'tel.regex' => 'ハイフンなしの半角数字で入力してください',
            'comment.required' => 'コメントを入力してください',
            'comment.max' => '300文字以内で入力してください',
        ];
    }
}
