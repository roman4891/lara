<?php

namespace App\Repositories;

use App\Models\User;

interface ApiUserRepositoryInterface {

    public function getFilteredApiUsers();

    public function findAllApiUsers();

    public function findApiUser();

    public function createApiUser();

    public function updateApiUser();

    public function softDeleteApiUser($id);

    public function forceDeleteApiUser($id);
}
