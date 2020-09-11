<?php

namespace App\Http\Requests;

use App\Enums\ExpenseTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
      "expenses" => "required|array",
      "expenses.*.name" => "required",
      "expenses.*.date" => "required|date|date_format:Y-m-d",
      "expenses.*.type" => ["required", new EnumValue(ExpenseTypeEnum::class, false)],
      "expenses.*.amount" => "required|regex:/^\d+(\.\d{1,2})?$/"
    ];
  }
}
