<?php

namespace App\Repositories;

use App\Models\ApiUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ApiUserRepository implements ApiUserRepositoryInterface
{
    private ApiUser $apiUser;

    public function __construct(ApiUser $apiUser)
    {
        $this->apiUser = $apiUser;
    }

    /**
     * @return mixed
     */
    public function getFilteredApiUsers(...$params)
    {
        // TODO: Implement getFilteredApiUsers() method.
    }

    /**
     * @return ?Collection
     */
    public function findAllApiUsers(): ?Collection
    {
        return $this->apiUser::all();
    }

    /**
     * @return mixed
     */
    public function findApiUser($id)
    {
        $query = DB::table('api_users')
            ->where('id', '=', $id);

        $result = $query->first();

        if ($result) {
            return $result;
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function createApiUser(array $data): ?string
    {
        // Почему не могу испольовать create?
        // ApiUser::create...
        $id = DB::table('api_users')->insertGetId($data);

        if ($id) {
            return $id;
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function updateApiUser($data): ?int
    {
        $affected = DB::table('api_users')
            ->where('id', '=', $data['id'])
            ->update($data);

        if ($affected) {
            return $affected;
        }

        return null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function softDeleteApiUser($id = 'b17298b8-009e-3815-a0c7-dacf2179c70e')
    {
        $result = DB::table('users')
            ->where('id', '=', $id)
            ->delete();

//        ApiUser::destroy($id);

        if (isset($result)) {
            return $result;
        }

        return null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function forceDeleteApiUser($id)
    {
        // TODO: Implement forceDeleteApiUser() method.
    }
}
