<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {

        try {
            $input['name'] = $request->name;
            $input['provider'] = 'facebook';
            $input['provider_id'] = $request->provider_id;
            $input['provider_token'] = $request->provider_token;
            $authUser = $this->findOrCreate($input);


            return response(["status"=>"success", "data"=>$authUser, "message"=>"ok"]);


        } catch (\Illuminate\Database\QueryException $ex) {

            return response(["status"=>"error", "data"=>null, "message"=>$ex->getMessage()]);


        }

        // return status, userID
    }

    public function findOrCreate($input){
        $checkIfExist = User::where('provider',$input['provider'])
            ->where('provider_id',$input['provider_id'])
            ->first();

        if($checkIfExist){
            return $checkIfExist;
        }

        return User::create($input);
    }
}
