<?php

namespace App\Helpers\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class DeleteApiUserRequest extends FormRequest
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
            'id' => 'required|string',
            'type' => 'sometimes|in:force,soft'
        ];
    }

    public function innerValidated(): array
    {
        return $this->validate($this->rules());
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
