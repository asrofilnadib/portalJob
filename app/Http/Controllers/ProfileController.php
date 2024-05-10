<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use function Laravel\Prompts\password;

class ProfileController extends Controller
{
  /**
   * Display the user's profile form.
   */
  public function edit(Request $request): View
  {
    return view('profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }

  public function profileSeeker()
  {
    return view('seeker.profile');
  }

  public function uploadResume(Request $request)
  {
    $this->validate($request, [
      'resume' => 'required|mimes:pdf,doc,docx',
    ]);

    if ($request->hasFile('resume')){
      $resume = $request->file('resume')->store('resume', 'public');
      User::find(auth()->user()->id)->update(['resume' => $resume]);

      return back()->with('success', 'Your resume has been successfully updated!');
    }
  }

  public function changePassword(Request $request): RedirectResponse
  {
    $validated = $request->validateWithBag('updatePassword', [
      'current_password' => ['required', 'current_password'],
      'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $request->user()->update([
      'password' => Hash::make($validated['password']),
    ]);

    $user = auth()->user();
    if (!Hash::check($validated['current_password'], $user->password)) {
      return back()->with('error', 'Current password is incorrect!');
    }

    $user->password = Hash::make($request->password);
    $user->save();
//      dd($validatedData['current_password']);

    return back()->with('success', 'Your password has been updated.');
  }
}
