<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Queries\UserFilter;
use Bouncer;
use Illuminate\Http\Request;
use App\Http\Requests\Users\{AdminCreateUserRequest, AdminUpdateUserRequest};
//use App\Http\Requests\AdminCreateUserRequest;

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
        
        //compruebo si vien algo por ajax o axios
        if ($request->ajax()) {
            if (isset($request->role)) {
                $users = User::query()
                        ->filterBy($filters, $request->only(['search', 'from', 'to']))
                        ->whereIs($request->role)
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
            } else {
                $users = User::query()
                        ->filterBy($filters, $request->only(['search', 'from', 'to']))
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
            }
            $users->appends($filters->valid());
            return response()->json([
                "users" => $this->getRolesUsers($users),
                "roles" => $roles
            ]);

        }
        return redirect("home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        if ($request->ajax()) {
            $roles = Bouncer::role()->all();
            $user = new User;
            return response()->json([
                "user" => $user,
                "roles" => $roles
            ]);
        }        
        return redirect("home");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateUserRequest $request, User $user){
        $request->createProfile($user);
        return "Usuario Creado Correctamente";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $thought
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user){
        //compruebo si vien algo por ajax o axios
        if ($request->ajax()) {
            $roles = Bouncer::role()->all();
            return response()->json([
                "user" => $user,
                "roles" => $roles
            ]);
        }
        return redirect("home");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateUserRequest $request, User $user){
        //compruebo si vien algo por ajax o axios
        if ($request->ajax()) {
            $request->updateProfile($user);
            return "Usuario Actualizado Correctamente";
        }
        return redirect("home");
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

    /**
     * Display a listing trashed of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        //compruebo si vien algo por ajax o axios
        if ($request->ajax()) {
            $users = User::onlyTrashed()->get();

            return $this->getRolesUsers($users);
        }
        return redirect("home");
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, int $id){
        //compruebo si vien algo por ajax o axios
        if ($request->ajax()) {
            $user = User::onlyTrashed()->where('id', $id)->first();

            $user->restore();

            return ;
        }

        return redirect("home");
    }

    /**
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id){
        //compruebo si vien algo por ajax o axios
        if ($request->ajax()) {
            $user = User::onlyTrashed()->where('id', $id)->first();

            $user->forceDelete();
            return ;
        }

        return redirect("home");
    }

    private function getRolesUsers($users){
        $users->each(function($user){
            $user->roles;
        });
        return $users;
    }
}
