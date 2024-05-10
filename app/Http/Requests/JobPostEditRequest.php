<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostEditRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'title' => 'required|min:10',
      'description' => 'required|min:10',
      'job_types' => 'required',
      'image' => 'mimes:jpg,jpeg,png|max:2048',
      'roles' => 'required',
      'address' => 'required',
      'salary' => 'required',
      'date' => 'required',
    ];
  }
}
