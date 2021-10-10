<?php

declare(strict_types=1);

namespace App\Helpers\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

class CreateApiUserRequest extends FormRequest
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
            'first_name' => 'required|min:2|max:16',
            'last_name' => 'sometimes|string|min:2|max:16',
            'phone' => 'sometimes|string|min:2|max:16',
            'active' => 'sometimes|boolean',
            // Check email!!!
            'email' => 'required|email|unique:api_users,email',
            'password' => [],
        ];
    }

    /**
     * @return array
     */
    public function fillData(): array
    {
        $data = $this->validate($this->rules());

        return Arr::add($data, 'id', Uuid::uuid4()->toString());
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
