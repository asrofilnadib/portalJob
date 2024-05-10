<?php

namespace App\Post;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPost
{
  protected $listing;
  public function __construct($listing)
  {
    $this->listing = $listing;
  }

  public function getImagePath(Request $data)
  {
    return $data->file('image')->store('image', 'public');
  }

  public function storePost( Request $data):void
  {
//    dd($data['image']);
    $imagePath = $this->getImagePath($data);
    $this->listing->title = $data['title'];
    $this->listing->slug = Str::slug($data['title'].'.'. Str::uuid());
    $this->listing->description = $data['description'];
    $this->listing->job_types = $data['job_types'];
    $this->listing->image = $imagePath;
    $this->listing->roles = $data['roles'];
    $this->listing->address = $data['address'];
    $this->listing->salary = $data['salary'];
    $this->listing->application_close_date = $data['date'];
    $this->listing->user_id = auth()->user()->id;
    $this->listing->save();
  }

  public function updatePost(int $id, Request $data):void
  {
    if ($data->hasFile('feature_image')) {
      $featureImage = $this->getImagePath($data);
      $this->listing->find($id)->update(['feature_image' => $featureImage ]);
    }
    $this->listing->find($id)->update($data->except('feature_image'));
  }
}

/*$imagePath = $request->file('image')->store('images', 'public');

$validatedData['image'] = $imagePath;
$validatedData['user_id'] = auth()->user()->id;
$validatedData['application_close_date'] = $request->date;
$validatedData['slug'] = Str::slug($request->title).'.'. Str::uuid();

Listing::create($validatedData);*/
