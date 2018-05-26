<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Profession;
use App\City;
use Illuminate\Http\Request;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use Image;

class UsersController extends Controller
{

    function __construct()
    {
        $this->middleware('auth', ['except' => ['show','create','store']]);
        $this->middleware('roles:admin,mod',['except' => ['edit','update', 'show', 'destroy','create','store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name','id');
        $profession = Profession::pluck('display_name','id');
        $city = City::pluck('name','id');
        return view('users.create',compact('roles','profession','city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUserRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create( $request->all());

        if($request->rolelegido == 3) {
            $user->profession_id = $request->localizacion;
        } else if ($request->rolelegido == 4){
            $user->city_id = $request->localizacion;
            $user->profession_id = $request->profesion;
        }

        $user->password = bcrypt($request->password);
        $user->save();
        $user->roles()->attach($request->rolelegido);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('edit',$user);

        $roles = Role::pluck('display_name','id');

        return view('users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize($user);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save (public_path('/uploads/'. $filename));
            $user->avatar=$filename;        
        } 

        $user->roles()->sync($request->role);
        $user->update($request->only('name','email'));
        
        $user->save();

        return back()->with('info','Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('destroy', $user);

        $user->delete();

        return back();
    }
}
