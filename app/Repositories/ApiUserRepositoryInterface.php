<?php

namespace App\Repositories;

use App\Helpers\Requests\CreateApiUserCommand;

interface ApiUserRepositoryInterface {

    public function getFilteredApiUsers(...$params);

    public function findAllApiUsers();

    public function findApiUser($id);

    public function createApiUser(array $data);

    public function updateApiUser(array $data);

    public function softDeleteApiUser($id);

    public function forceDeleteApiUser($id);
}
