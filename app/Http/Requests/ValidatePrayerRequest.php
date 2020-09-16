<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePrayerRequest extends FormRequest
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
      "name" => "required",
      "subject" => "required",
      "email" => "required|email",
      "telephone" => "regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10",
      "request" => "required"
    ];
  }

  public function messages()
  {
    return [
      "telephone.regex" => "The telephone number entered is invalid",
      "telephone.not_regex" => "The telephone number must contain only numbers",
    ];
  }
}
