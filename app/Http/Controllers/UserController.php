<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use View;
use Input;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return View::make('admin.users.list', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return View::make('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'confirmed|min:6',
        ];

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }
        if($request->status == null || !isset($request->status)){
           $request->merge([
               'status' => 0,
           ]);
        }
        $user->update($request->all());

        Session::flash('message', trans('user.success_edit'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $current_user = Auth::user();
        $users = User::all()->count();

        if($users <= 1){
            Session::flash('error', trans('user.no_enough_users'));
            return back();
        }
        elseif($current_user == $user){
            Session::flash('error', trans('user.cant_delete_self'));
            return back();
        }else{
            $user->delete();
            Session::flash('message', trans('user.delete_confirmation'));
            return redirect(route('admin.user.index'));
        }
    }
}
