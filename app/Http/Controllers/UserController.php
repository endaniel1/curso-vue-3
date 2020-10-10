<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Queries\UserFilter;
use Bouncer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserFilter $filters){

        $roles = Bouncer::role()->all();
        
        if ($request->ajax()) {
            if (isset($request->role)) {
                $users = User::query()
                        ->filterBy($filters, $request->only(['search', 'from', 'to']))
                        ->whereIs($request->role)
                        ->orderBy('id', 'ASC')
                        ->paginate(10);
                $users->each(function($user){
                    $user->roles;
                });
            } else {
                $users = User::query()
                        ->filterBy($filters, $request->only(['search', 'from', 'to']))
                        ->orderBy('id', 'ASC')
                        ->paginate(10);
                $users->each(function($user){
                    $user->roles;
                });
            }
            $users->appends($filters->valid());
            return $users;

        }
        return redirect("home");
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
     * @param  \App\Models\User  $thought
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){        
        $user->delete();
    }
}
