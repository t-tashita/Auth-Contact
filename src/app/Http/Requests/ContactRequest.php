<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'integer', 'min:1', 'max:3'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tel_part1' => ['required', 'regex:/^\d{1,5}$/'],
            'tel_part2' => ['required', 'regex:/^\d{1,5}$/'],
            'tel_part3' => ['required', 'regex:/^\d{1,5}$/'],
            'address' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'building' => ['max:255'],
            'detail' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'tel_part1.required' => '電話番号を入力してください',
            'tel_part2.required' => '電話番号を入力してください',
            'tel_part3.required' => '電話番号を入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel.regex' => '電話番号は15桁までの数字で入力してください',
            'tel_part1.regex' => '電話番号は5桁までの数字で入力してください',
            'tel_part2.regex' => '電話番号は5桁までの数字で入力してください',
            'tel_part3.regex' => '電話番号は5桁までの数字で入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
