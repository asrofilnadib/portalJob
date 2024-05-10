<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function edit()
    {
      return view('profiles.index');
    }

  public function update(Request $request)
  {
    if ($request->hasFile('profile_pic')) {
      $pathImage = $request->file('profile_pic')->store('profile', 'public');
      User::find(auth()->user()->id)->update(['profile_pic' => $pathImage]);
    }
    return back()->with('successUpdate', 'Your profile has been successfully updated!');
  }


    public function destroy($id)
    {
      Listing::destroy($id);
      return back()->with('successDelete', 'Your account successfully been deleted, please create another one or login with different user');
    }
}
