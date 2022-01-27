<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Transformers\Users\UserResource;

class UserController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {

            $user = $this->user->create($request->all());

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('user.store', null, $e);

        }

        return new UserResource($user, [
            'type'  => 'store',
            'route' => 'user.store'
        ]);
    }

      /**
     * Login the user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {

            $token = $this->user->login($credentials);

        } catch (\Throwable|\Exception $e) {
            
            return ResponseService::exception('user.login', null, $e);
        
        }

        return response()->json(compact('token'));
    }

    /**
     * Logout user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {

            $this->user->logout($request->input('token'));

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('user.logout', null, $e);

        }

        return response([
            'status' => true,
            'msg'    => 'Deslogado com sucesso'
        ], 200);
    }
}
