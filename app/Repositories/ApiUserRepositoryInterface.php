<?php

namespace App\Repositories;

use App\Helpers\Requests\CreateApiUserCommand;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ApiUserRepositoryInterface {

    public function getFilteredApiUsers(array $params);

    public function findAllApiUsers(): ?Collection;

    public function findApiUser($id): ?User;

    public function createApiUser(array $data): ?string;

    public function updateApiUser(array $data): ?int;

    public function softDeleteApiUser(string $id): ?int;

    public function forceDeleteApiUser($id): ?int;
}
