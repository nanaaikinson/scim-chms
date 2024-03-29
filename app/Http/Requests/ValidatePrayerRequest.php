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
      "name" => "required",
      "subject" => "required",
      "email" => "nullable|email",
      "telephone" => "nullable|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10",
      "request" => "required"
    ];
  }

  public function messages(): array
  {
    return [
      "telephone.regex" => "The telephone number entered is invalid",
      "telephone.not_regex" => "The telephone number must contain only numbers and must be an international format if possible",
    ];
  }
}
