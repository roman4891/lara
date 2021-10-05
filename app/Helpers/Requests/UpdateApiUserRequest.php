<?php

namespace App\Helpers\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateApiUserRequest extends FormRequest
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
            'id' => 'bail|required|uuid|exists:App\Models\ApiUser,id',
            'first_name' => 'sometimes|string|min:2|max:16',
            'last_name' => 'sometimes',
            'phone' => 'sometimes|string|min:9|max:32',
            'active' => 'sometimes|boolean',
//            // Check email!!!
            'email' => 'sometimes|email',
        ];
    }

    public function innerValidated(): array
    {
        // TODO check email not exist
        // TODO check $requested properties !== Entity properties

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
