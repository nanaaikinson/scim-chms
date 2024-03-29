<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralContributionRequest extends FormRequest
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
      "amount" => "required|regex:/^\d+(\.\d{1,2})?$/",
      "date" => "required|date|date_format:Y-m-d",
      "name" => "required"
    ];
  }
}
