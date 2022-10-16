<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'product_name' => 'required | max:255 | alpha_num',
            'price' => 'required | max:1000',
            'stock' => 'required | max:1000',
            'comment' => 'max:10000',
        ];
    }
    public function attributes() {
    return [
        'product_name' => '商品名',
        'company_name' => 'メーカー',
        'price' => '価格',
        'stock' => '在庫',
        'comment' => 'コメント',
    ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'company_name.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'stock.required' => ':attributeは必須項目です。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }

}
