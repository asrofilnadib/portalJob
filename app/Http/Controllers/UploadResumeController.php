<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class UploadResumeController extends Controller
{
  public function store(Request $request)
  {
    if ($request->hasFile('file')){
      $file = $request->file('file')->store('resume', 'public');
      User::where('id', auth()->user()->id)->update([
        'resume' => $file
      ]);

      return json_encode(['success' => true]);
    }

    return json_encode(['error' => 'error']);
  }
}
