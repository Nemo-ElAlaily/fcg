<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => 'required',
            "phone" => 'required',
            "address" => 'required',
            "welcome_phrase" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'  => 'Title is required',
            'phone.required'  => 'Phone is required',
            'address.required'  => 'Address is required',
            'welcome_phrase.required'  => 'Welcome Phrase is required',
        ];
    } // end of messates
}
