<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PledgeRequest extends FormRequest
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
      "title" => "required",
      "person_id" => "required|exists:people,id",
      "amount" => "required|regex:/^\d+(\.\d{1,2})?$/"
    ];
  }

  public function messages()
  {
    return [
      "amount.regex" => "The amount provided must be valid money"
    ];
  }
}
