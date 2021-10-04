<?php

namespace App\Http\Controllers;

use App\Helpers\Requests\CreateApiUserRequest;
use App\Helpers\Requests\UpdateApiUserRequest;
use App\Models\ApiUser;
use App\Repositories\ApiUserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiUserController extends Controller
{
    private ApiUserRepositoryInterface $apiUserRepository;

    public function __construct(ApiUserRepositoryInterface $apiUserRepository)
    {
        $this->apiUserRepository = $apiUserRepository;
    }


    public function list(Request $request): JsonResponse
    {
        $result = $this->apiUserRepository->findAllApiUsers();

        if ($result) {
            return response()->json([$result], 200);
        }

        return response()->json([], 402);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateApiUserRequest $request
     * @return JsonResponse
     */
    public function create(CreateApiUserRequest $request): JsonResponse
    {
        $data = $request->innerValidated($request);

        $id = $this->apiUserRepository->createApiUser($data);

        if ($id) {
            return response()->json([$id], 200);
        }

        return response()->json([], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->apiUserRepository->findApiUser($id);

        if ($result) {
            return response()->json($result, 200);
        }

        return response()->json($result);
    }

    /**
     * @param UpdateApiUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateApiUserRequest $request): JsonResponse
    {
        $data = $request->innerValidated($request);

        $id = $this->apiUserRepository->updateApiUser($data);

        if ($id) {
            return response()->json(['id' => $data['id']], 200);
        }

        return response()->json([], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->apiUserRepository->softDeleteApiUser();

        $result = $this->apiUserRepository->findApiUser();
    }

    public function test(Request $request)
    {
        $user = new ApiUser();
        $user->fill(['name' => 'Amsterdam to Frankfurt']);
        $user->save();

        return response()->json($request->toArray());
    }
}
