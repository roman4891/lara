<?php

namespace App\Repositories;

use App\Models\ApiUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ApiUserRepository implements ApiUserRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getFilteredApiUsers()
    {
        // TODO: Implement getFilteredApiUsers() method.
    }

    /**
     * @return ?Collection
     */
    public function findAllApiUsers(): ?Collection
    {
        return $this->userModel::all();
    }

    /**
     * @return mixed
     */
    public function findApiUser($id = 'b17298b8-009e-3815-a0c7-dacf2179c70e')
    {
//        ApiUser::firstOrCreate

        $query = DB::table('api_users')
            ->where('id', '=', $id);

        $result = $query->first();

        if($result) {
            return $result;
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function createApiUser()
    {
        // TODO: Implement createApiUser() method.
    }

    /**
     * @return mixed
     */
    public function updateApiUser()
    {
        // TODO: Implement updateApiUser() method.
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
