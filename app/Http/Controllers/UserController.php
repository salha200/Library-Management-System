<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller 
{
     protected $UserService;

 
    public function __construct(UserService $UserService)
    {    

        //$this->middleware('auth:api');
        //$this->middleware('is_admin');
        $this->UserService = $UserService;
    }

    /**
     * index  all user
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users=$this->UserService->getUser();
        return response()->json(['data'=>$users,"message"=>"get usersuccess"],200);
    }

    /**
     *  show specific  user
     * @param UserRequest $request
     * @return void
     */
    public function show(UserRequest $request)
    {
        // $data=$request->validated();
        // //Log::info('Creating book with data: ', $data);

        // $user=$this->UserService->createBook($data);
        // // Log::info('Creating book with data: ', $book);

        // return response()->json(['data'=>$user,"message"=>"add user success"],200);
    }
/**
 * store the user to database
 * @param UserRequest $request
 * @return mixed|\Illuminate\Http\JsonResponse
 * 
 */
  
    public function store(UserRequest $request)
    {
        
        $data=$request->validated();
        //Log::info('Creating book with data: ', $data);

        $user=$this->UserService->createUser($data);
       

        return response()->json(['data'=>$user,"message"=>"add user success"],200);
    }

    /**
     *  update the user
     * @param UserRequest $request
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();

        // تحديث الكتاب
        $user = $this->UserService->updateUser($id, $data);


        return response()->json(['data' => $user, 'message' => 'Book updated successfully'], 200);
    }

    /**
     * delete the user
     * @param User $user
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    { 
        $users=$this->UserService->deletUser($user);
        return response()->json(['data'=>$users,"message"=>"delete book success"],200);

    }
}
