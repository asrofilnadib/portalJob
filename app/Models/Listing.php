<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  public function users()
  {
    return $this->belongsToMany(User::class, 'listing_user', 'listing_id', 'user_id')
      ->withPivot('shortlisted')
      ->withTimestamps();
  }

  public function profile()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
