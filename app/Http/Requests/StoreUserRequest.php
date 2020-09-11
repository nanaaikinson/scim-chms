<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      "first_name" => "required",
      "last_name" => "required",
      "email" => "required|email|unique:users,email,NULL,id",
      "role" => "required|exists:roles,id",
      "telephone" => "nullable|min:10|numeric",
    ];
  }

  public function messages()
  {
    return [
      "email.unique" => "The email provided is already associated with an account",
      "role.exists" => "The role provided does not exist"
    ];
  }
}
