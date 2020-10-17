<?php

namespace App\Http\Requests;

use App\Enums\ContributionMethodEnum;
use BenSampo\Enum\Rules\EnumValue;
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
      "contributions.*.person" => "required|exists:people,id",
      "contributions.*.pledge" => "required|exists:pledges,id",
      "contributions.*.amount" => "required|regex:/^\d+(\.\d{1,2})?$/",
      "contributions.*.method" => ["required", new EnumValue(ContributionMethodEnum::class, false)],
      "contributions.*.date" => "required|date|date_format:Y-m-d",
    ];
  }
}
