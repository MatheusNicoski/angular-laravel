<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $contactId = $this->route('id');

        return [
            'name' => [
                'required', 'min:3'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('contacts')->ignore($contactId)->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id)
                    ->whereNull('deleted_at');
                }) ?? null
            ],
            'phone' => [
                'required', 'telefone_com_ddd'
            ],
            'cpf' => [
                'required',
                'cpf',
                Rule::unique('contacts')->ignore($contactId)->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id)
                    ->whereNull('deleted_at');
                }) ?? null
            ]
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'statusCode' => 403,
                'error'    => $validator->errors(),
                'url'      => route('contact.store')
            ], 403));
       }
    }

}
