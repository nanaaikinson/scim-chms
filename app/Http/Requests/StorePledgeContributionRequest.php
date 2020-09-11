<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePledgeContributionRequest extends FormRequest
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
      "contributions" => "required|array",
      "contributions.*.person" => "exists:people,id",
      "contributions.*.pledge" => "exists:pledges,id",
      "contributions.*.amount" => "required|regex:/^\d+(\.\d{1,2})?$/",
      "contributions.*.method" => "required",
      //"contributions.*.date" => "required|date|date_format:Y-m-d",
    ];
  }
}
