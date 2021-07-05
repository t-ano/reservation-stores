<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'name' => 'unique:plans, name, ' . $this->plan,
            'price' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'この予約プランは登録済みです。',
            'price.integer' => '料金を正しく入力してください。'
        ];
    }
}
