<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Services\ResponseService;
use App\Transformers\Users\UserResource;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        return User::find(auth()->user()->id);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     */
    public function update(ProfileRequest $request)
    {
        $profile = User::whereNull('deleted_at')->find(auth()->user()->id);
        
        $data = $request->all();
        $password = Hash::make($request->all()['password']);
        $data['password'] = $password;

        try {
            
            $profile->update($data);

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('user.update', auth()->user()->id, $e);

        }

        return new UserResource($profile, [
            'type'  => 'update',
            'route' => 'user.update'
        ]);
    
    }
}
