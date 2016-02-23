<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Session;

class ProfileController extends Controller
{
    /**
     * Send authenticated users credentials to the view
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile')->with(compact('user'));
    }

    /**
     * Validates the users update request
     *
     * @param $id, @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'email'=>'required|email|unique:users,email,'.$id ,
            'password' => 'min:6|confirmed',
            'current_password' => 'required'
        ]);

        # Hash and validate current password with the present
        if (!Hash::check($request->current_password, $user->password))
        {
            return Redirect::back()->withErrors('Current password is wrong');
        }

        $input = $request->all();

        $user->fill($input)->save();

        Session::flash('flash_message', 'User successfully updated');

        return redirect()->back();
    }

}
