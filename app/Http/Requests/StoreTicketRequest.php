<?php

namespace App\Http\Requests;

use App\Enums\TicketTagEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
      "tag" => ["required", new EnumValue(TicketTagEnum::class, false)],
      "image" => "nullable|image|mimes:jpeg,jpg,png|max:2048"
    ];
  }
}
