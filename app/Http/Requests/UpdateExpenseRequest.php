<?php

namespace App\Http\Requests;

use App\Enums\ExpenseTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
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
      "comment" => "required",
      "date" => "required|date|date_format:Y-m-d",
      "type" => ["required", new EnumValue(ExpenseTypeEnum::class, false)],
      "amount" => "required|regex:/^\d+(\.\d{1,2})?$/"
    ];
  }
}
