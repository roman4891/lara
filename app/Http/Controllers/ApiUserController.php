<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\Requests\CreateApiUserRequest;
use App\Helpers\Requests\DeleteApiUserRequest;
use App\Helpers\Requests\SearchApiUsersRequest;
use App\Helpers\Requests\UpdateApiUserRequest;
use App\Models\ApiUser;
use App\Repositories\ApiUserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ApiUserController extends Controller
{
    private ApiUserRepositoryInterface $apiUserRepository;

    /**
     * @param ApiUserRepositoryInterface $apiUserRepository
     */
    public function __construct(ApiUserRepositoryInterface $apiUserRepository)
    {
        $this->apiUserRepository = $apiUserRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $result = $this->apiUserRepository->findAllApiUsers();

        if ($result) {
            return response()->json([$result], 200);
        }

        return response()->json(['error' => $result], 402);
    }

    /**
     * @param SearchApiUsersRequest $request
     * @return JsonResponse
     */
    public function searchApiUsers(SearchApiUsersRequest $request): JsonResponse
    {
        if (isset($request->errors)) {
            return response()->json(['error' => $request->errors], 400);
        }

        $data = $request->validationData();

        $result = $this->apiUserRepository->getFilteredApiUsers($data);

        if ($result) {
            return response()->json($result, 200);
        }

        return response()->json([], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param Uuid $id
     * @return JsonResponse
     */
    public function show(Uuid $id): JsonResponse
    {
        $result = $this->apiUserRepository->findApiUser($id);

        if ($result) {
            return response()->json(['data' => $result], 200);
        }

        return response()->json(['error' => $result], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateApiUserRequest $request
     * @return JsonResponse
     */
    public function create(CreateApiUserRequest $request): JsonResponse
    {
        if (isset($request->errors)) {
            return response()->json(['error' => $request->errors], 400);
        }

        $data = $request->fillData($request);

        $result = $this->apiUserRepository->createApiUser($data);

        if ($result) {
            return response()->json(['data' => $data], 200);
        }

        return response()->json(['error' => $result], 400);
    }

    /**
     * @param UpdateApiUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateApiUserRequest $request): JsonResponse
    {
        if (isset($request->errors)) {
            return response()->json(['error' => $request->errors], 400);
        }

        $data = $request->innerValidated($request);

        $result = $this->apiUserRepository->updateApiUser($data);

        if ($result) {
            return response()->json(['data' => $data['id']], 200);
        }

        return response()->json(['data' => $result], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteApiUserRequest $request
     * @return JsonResponse
     */
    public function delete(DeleteApiUserRequest $request): JsonResponse
    {
        $result = 0;
        $data = $request->innerValidated();

        if (isset($request->errors)) {
            return response()->json(['error' => $request->errors], 400);
        }

        if (isset($data['type']) && $data['type'] === 'soft') {
            $result = $this->apiUserRepository->softDeleteApiUser($data['id']);
        }

        if (isset($data['type']) && $data['type'] === 'force') {
            $result = $this->apiUserRepository->forceDeleteApiUser($data['id']);
        }

        if ($result > 0) {
            return response()->json(['data' => ['User deleted!']], 200);
        }

        return response()->json(['data' => ['User was not deleted!']], 200);
    }
}
