<?php

namespace App\Http\Controllers;

use App\Mail\ShortlistMail;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
  use AuthorizesRequests;
  public function index()
  {
    $listings = Listing::latest()->withCount('users')->where('user_id', auth()->user()->id)->get();

    return view('applicant.index', [
      'listings' => $listings,
    ]);
//    $records = DB::table('listing_user')->whereIn('listing_id', $listings->pluck('id'))->get();
//    dd($records);
  }

  public function show(Listing $listing)
  {
    $this->authorize('view', $listing);
    $listing = Listing::latest()->with('users')->where('slug', $listing->slug)->firstOrFail();

    return view('applicant.show', compact('listing'));
  }

  public function shortlisted($listingId, $userId)
  {
    $listing = Listing::find($listingId);
    $user = User::find($userId);
    if ($listing) {
      $listing->users()->updateExistingPivot($userId, ['shortlisted' => true]);

      Mail::to($user->email)->queue(new ShortlistMail($user->name, $listing->title));
      return back()->with('success', 'User is shorted list successfully');
    }

    return back();
  }

  public function apply($listingId)
  {
    $user = auth()->user();
    $user->listings()->syncWithoutDetaching($listingId);
    return back()->with('success', 'Your Application was successfully submited');
  }
}
