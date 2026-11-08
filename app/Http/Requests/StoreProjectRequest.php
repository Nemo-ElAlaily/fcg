<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
     * Derive the slug the controller will store, so uniqueness can be validated.
     */
    protected function prepareForValidation()
    {
        $this->merge(['slug' => str_replace(characters(), '-', (string) $this->title)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['required', Rule::unique('projects', 'slug')->whereNull('deleted_at')],
            'category_id' => ['nullable', 'exists:categories,id'],
            'client_id'   => ['nullable', 'exists:clients,id'],
            'services'    => ['required', 'array'],
            'services.*'  => ['exists:services,id'],
            'image'       => ['nullable', 'image', 'max:10240'], // KB (10M); keep under PHP upload_max_filesize
            'gallery.*'   => ['nullable', 'image', 'max:10240'],
        ];
    }
}
