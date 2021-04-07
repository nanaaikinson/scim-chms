<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRegistrationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(): array
  {
    return [
      "first_name" => "required",
      "last_name" => "required",
      "email" => "required|email|unique:users,email",
      "telephone" => "nullable|unique:members,telephone|min:10|numeric",
      "password" => "required|confirmed|min:6|max:20|alpha_num"
    ];
  }

  public function messages(): array
  {
    return [
      "email.unique" => "The email address entered is already associated with an account",
      "password.alpha_num" => "The password field must contain alphabets and numbers only"
    ];
  }
}
