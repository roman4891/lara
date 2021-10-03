<?php

namespace App\Http\Controllers;

use App\Models\ApiUser;
use App\Repositories\ApiUserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiUserController extends Controller
{
    private ApiUserRepositoryInterface $apiUserRepository;

    public function __construct(ApiUserRepositoryInterface $apiUserRepository)
    {
        $this->apiUserRepository = $apiUserRepository;
    }


    public function list(Request $request)
    {
        $result = $this->apiUserRepository->findAllApiUsers();

//        var_dump($result);

        return response()->json($result);
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->apiUserRepository->findApiUser();

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
//        exit(var_export($request));

//        $request->toArray();

        $user = new ApiUser();
        $user->fill(['name' => 'Amsterdam to Frankfurt']);
        $user->save();

        return response()->json($request->toArray());
    }
}
