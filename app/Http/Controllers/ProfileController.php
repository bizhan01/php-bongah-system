<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = Auth::id();
        $profile = User::find($id)->profile;

        return view('admin/profile/index')->with('profile', $profile);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'avatar' => 'image'
        ]);

        $user = Auth::user();
        $user->profile->first_name = $request['first_name'];
        $user->profile->last_name = $request['last_name'];
        $user->profile->phone_number = $request['phone_number'];
        $user->profile->designation = $request['designation'];
        $user->profile->gender = $request['gender'];
        $user->profile->NID = $request['NID'];
        $user->profile->education = $request['education'];
        $user->profile->permanent_address = $request['permanent_address'];
        $user->profile->description = $request['description'];


        if ($request->hasFile('avatar')) {

            if (!empty($user->profile->avatar)  and $user->profile->avatar !='upload/avatar/avatar.png' ) {
                unlink($user->profile->avatar); // Delete previous image file
            }

            $company_logo = $request->avatar;
            $temporaryName = time() . $company_logo->getClientOriginalName();
            $company_logo->move("upload/avatar", $temporaryName);
            $user->profile->avatar = 'upload/avatar/' . $temporaryName;
        }

        $user->profile->save();
        Session::flash('success', 'Successfully Updated');
        return redirect()->route('profile');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'OldPassword' => 'required',
            'NewPassword' => 'required|min:6',
            'NewPasswordConfirm' => 'required|min:6',
        ]);

        if ($request["NewPassword"] !== $request["NewPasswordConfirm"]) {
            Session::flash('error', 'Password and Confirm password does not match');
            return redirect()->back();
        }

        if (Hash::check($request["OldPassword"], Auth::user()->password)) {

            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request["NewPassword"]);
            $user->save();
            Session::flash('success', 'Password Successfully Update');
            return redirect()->back();

        } else {

            Session::flash('error', 'Old Password Incorrect?');
            return redirect()->back();
        }

    }
}
