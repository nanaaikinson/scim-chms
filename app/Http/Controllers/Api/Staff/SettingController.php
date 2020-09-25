<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Setting;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  use ResponseTrait;

  public function currencies()
  {
    try {
      $currencies = Country::all()->map(function($country) {
        $currency = json_decode($country->currency);
        return [
          "code" => $currency->code,
          "symbol" => $currency->symbol,
          "country" => $country->name
        ];
      });

      return $this->dataResponse($currencies);
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function currency()
  {
    try {
      $currency = null;
      $setting = Setting::first();
      if (!$setting) {
        $tenantId = tenant("id");
        $branch = Branch::where("tenant_id", $tenantId)->firstOrFail();
        if (!$branch->country_id) {
          $setting = Setting::create(["currency" => 86]);
          $country = Country::find(86);
          $countryCurrency = json_decode($country->currency);
          $currency = [
            "code" => $countryCurrency->code,
            "symbol" => $countryCurrency->symbol,
            "country" => $country->name
          ];
        } else {
          $country = Country::find($branch->currency_id);
          $countryCurrency = json_decode($country->currency);
          $currency = [
            "code" => $countryCurrency->code,
            "symbol" => $countryCurrency->symbol,
            "country" => $country->name
          ];
        }
      } else {
        $country = Country::find($setting->currency);
        $countryCurrency = json_decode($country->currency);
        $currency = [
          "code" => $countryCurrency->code,
          "symbol" => $countryCurrency->symbol,
          "country" => $country->name
        ];
      }
      return $this->dataResponse($currency);
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    }
    catch (Exception $e) {
      return $this->errorResponse();
    }
  }

  public function updateCurrency(Request $request)
  {

  }
}
