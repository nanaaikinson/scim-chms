<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTitheRequest extends FormRequest
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
      "tithes" => "required|array",
      "tithes.*.person" => "exists:people,id",
      "tithes.*.amount" => "required|regex:/^\d+(\.\d{1,2})?$/",
      "tithes.*.date" => "required|date|date_format:Y-m-d",
      "tithes.*.frequency" => "required|in:weekly,monthly",
      "tithes.*.method" => "required",
    ];
  }

  public function messages()
  {
    return [
      "amount.regex" => "The amount provided must be valid money"
    ];
  }
}
