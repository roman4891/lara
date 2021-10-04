<?php

namespace App\Helpers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

class CreateApiUserRequest extends FormRequest
{
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
            'last_name' => [],
            'phone' => [],
            'active' => [],
            // Check email!!!
            'email' => 'required|email|unique:api_users,email',
            'password' => [],
        ];
    }

    public function innerValidated(): array
    {
        $data = $this->validate($this->rules());
        $this->get('active', false);

        return Arr::add($data, 'id', Uuid::uuid4()->toString());
    }
}
