<?php

namespace App\Helpers\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class SearchApiUsersRequest extends FormRequest
{
    /** @var array|null */
    public ?array $errors = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'limit' => 'sometimes|integer',
            'offset' => 'sometimes|integer',
            'sort' => 'sometimes|in:id,first_name,last_name,phone,active,email,created_at,updated_at,deleted_at',
            'order' => 'sometimes|order',
            'needed' => 'sometimes|string',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $this->errors = Arr::flatten($validator->getMessageBag()->getMessages());
    }
}
