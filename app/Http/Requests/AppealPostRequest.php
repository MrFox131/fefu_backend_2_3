<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
class AppealPostRequest extends FormRequest
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
            'name' => ['required','string','max:20'],
            'surname' => ['required','string','max:40'],
            'patronymic' => ['nullable','string','max:20'],
            'age' =>[ 'required','integer','between:14,125'],
            'phone' => ['nullable', 'string','regex:/^(\+7|8|7)[0-9]{10}$/i', 'required_without:email'],
            'email' => ['nullable','string','max:100','regex:/^[a-zA-Zа-яА-Я0-9_]+@[a-zа-я0-9]+\.[a-zа-я0-9]{2,6}$/i', 'required_without:phone'],
            'message' => ['required','string','max:100'],
            'gender' => ['required','integer',new Rules\In([Gender::MALE, Gender::FEMALE])]
        ];
    }
}
