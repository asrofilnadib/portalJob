<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPostEditRequest;
use App\Http\Requests\JobPostFormRequest;
use App\Models\Listing;
use App\Post\JobPost;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class PostJobController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  use ValidatesRequests;

  protected $job;

  public function __construct(JobPost $job)
  {
    $this->job = $job;
  }

  public function index()
  {
    $jobs = Listing::where('user_id', auth()->user()->id)->get();
    return view('job.index', compact('jobs'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('job.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(JobPostFormRequest $request)
  {
//      dd($request->date);
    $this->job->storePost($request);

    return back()->with('postSuccess', 'New Post has been added!');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $listing = Listing::findOrFail($id);
    return view('job.edit', compact('listing'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update($id, JobPostEditRequest $request)
  {
    $this->job->updatePost($id, $request);

    return back()->with('successUpdate', 'Your post has been updated!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    Listing::find($id)->delete();
    return back()->with('successDelete-', 'Your job post successfully has been deleted!');
  }
}
