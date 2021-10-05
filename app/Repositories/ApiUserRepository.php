<?php

namespace App\Repositories;

use App\Models\ApiUser;
use App\Models\User;
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
    public function getFilteredApiUsers(array $params): ?Collection
    {
        $needed = $params['needed'] ?? '';
        $sort = $params['sort'] ?? 'created_at';
        $limit = $params['limit'] ?? 10;
        $offset = $params['offset'] ?? 0;
        $order = $params['order'] ?? 'asc';

        $query = DB::table('api_users')
            ->where('first_name', 'like', '%'."$needed".'%')
            ->orWhere('email', 'like', '%'."$needed".'%')
            ->orderBy("$sort", "$order")
            ->offset($offset)
            ->limit($limit);

        $result = $query->get();

        if ($result) {
            return $result;
        }

        return null;
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
    public function findApiUser($id): ?User
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
    public function softDeleteApiUser(string $id): ?int
    {
//        $result = DB::table('users')
//            ->where('id', '=', $id)
//            ->delete();

         $result = ApiUser::destroy($id);

        if (isset($result)) {
            return $result;
        }

        return null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function forceDeleteApiUser($id): ?int
    {
        $result = DB::table('users')
            ->where('id', '=', $id)
            ->delete();

        if (isset($result)) {
            return $result;
        }

        return null;
    }
}
